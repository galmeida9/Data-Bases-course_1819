-- Drop all tables
drop table if exists local_publico cascade;
drop table if exists item cascade;
drop table if exists anomalia cascade;
drop table if exists anomalia_traducao cascade;
drop table if exists duplicado cascade;
drop table if exists utilizador cascade;
drop table if exists utilizador_qualificado cascade;
drop table if exists utilizador_regular cascade;
drop table if exists incidencia cascade;
drop table if exists proposta_de_correcao cascade;
drop table if exists correcao cascade;

-- Create all tables
create table local_publico (
    latitude float not null,
    longitude float not null,
    nome varchar(50) not null,
    constraint pk_latitude_longitude primary key(latitude, longitude)
);

create table item (
    id serial,
    descricao varchar(200) not null,
    localizacao varchar(50) not null,
    latitude float not null,
    longitude float not null,
    constraint pk_item_id primary key(id),
    constraint fk_latitude foreign key(latitude, longitude) references local_publico(latitude, longitude) on delete cascade
);

create table anomalia (
    id serial,
    zona box not null,
    imagem varchar(512) not null,
    lingua varchar(20) not null,
    ts timestamp(0) not null,
    descricao varchar(200) not null,
    tem_anomalia_redacao boolean,
    constraint pk_anomalia_id primary key(id)
);

create table anomalia_traducao (
    id serial,
    zona2 box not null,
    lingua2 varchar(20) not null,
    constraint pk_anomalia_traducao_id primary key(id),
    constraint fk_anomalia_traducao_id foreign key(id) references anomalia(id) on delete cascade
);

create table duplicado (
    item1 serial,
    item2 serial check(item1 < item2),
    constraint pk_item_ids primary key(item1, item2),
    constraint fk_item1 foreign key(item1) references item(id) on delete cascade,
    constraint fk_item2 foreign key(item2) references item(id) on delete cascade
);

create table utilizador (
    email varchar(40) not null,
    psw varchar(15) not null,
    constraint pk_utilizador_email primary key(email)
);

create table utilizador_qualificado (
    email varchar(40) not null,
    constraint pk_utilizador_qualificado_email primary key(email),
    constraint fk_utilizador_qualificado_email foreign key(email) references utilizador(email) on delete cascade
);

create table utilizador_regular (
    email varchar(40) not null,
    constraint pk_utilizador_regular_email primary key(email),
    constraint fk_utilizador_regular_email foreign key(email) references utilizador(email) on delete cascade
);

create table incidencia (
    anomalia_id serial,
    item_id serial,
    email varchar(40) not null,
    constraint pk_incidencia primary key(anomalia_id),
    constraint fk_anomalia_id foreign key(anomalia_id) references anomalia(id) on delete cascade,
    constraint fk_item_id foreign key(item_id) references item(id) on delete cascade,
    constraint fk_incidencia_email foreign key(email) references utilizador(email) on delete cascade
);

create table proposta_de_correcao (
    email varchar(40) not null,
    nro serial,
    data_hora timestamp not null,
    texto varchar(200) not null,
    constraint pk_email_nro primary key(email, nro),
    constraint fk_proposta_de_correcao_email foreign key(email) references utilizador_qualificado(email) on delete cascade
);

create table correcao (
    email varchar(40) not null,
    nro integer not null,
    anomalia_id integer not null,
    constraint pk_email_nro_anomalia_id primary key(email, nro, anomalia_id),
    constraint pk_correcao_email foreign key(email, nro) references proposta_de_correcao(email, nro) on delete cascade,
    constraint pk_correcao_anomalia_id foreign key(anomalia_id) references incidencia(anomalia_id) on delete cascade
);

-- Triggers and Procedures
-- RI-1
DROP TRIGGER IF EXISTS overlap_trigger ON anomalia_traducao;
DROP FUNCTION IF EXISTS overlap_trigger_proc();

CREATE FUNCTION overlap_trigger_proc() RETURNS trigger
AS $overlap_trigger_proc$
DECLARE
        zona box;
BEGIN
        SELECT anomalia.zona INTO zona FROM anomalia WHERE id=NEW.id;
    IF (zona && NEW.zona2) THEN
        RAISE EXCEPTION 'A segunda zona não se pode sobrepor à primeira.';
    END IF;
    RETURN NEW;
END;
$overlap_trigger_proc$ LANGUAGE plpgsql;

CREATE TRIGGER overlap_trigger
BEFORE INSERT ON anomalia_traducao
FOR EACH ROW 
EXECUTE PROCEDURE overlap_trigger_proc();

-- RI-4
DROP TRIGGER IF EXISTS email_utilizador_trigger ON utilizador;
DROP FUNCTION IF EXISTS email_utilizador_trigger_proc();

CREATE FUNCTION email_utilizador_trigger_proc() RETURNS trigger 
AS $email_utilizador_trigger_proc$
BEGIN
    IF NOT EXISTS (
        SELECT email
        FROM utilizador_qualificado 
        WHERE email=NEW.email
    ) AND NOT EXISTS (
        SELECT email
        FROM utilizador_regular           
        WHERE email=NEW.email
    ) THEN
        DELETE FROM utilizador
        WHERE email=NEW.email;
        RAISE EXCEPTION 'email de utilizador tem de figurar em utilizador_qualificado ou utilizador_regular.';
    END IF;
    RETURN NEW;
END;
$email_utilizador_trigger_proc$ LANGUAGE plpgsql;

CREATE TRIGGER email_utilizador_trigger
AFTER INSERT ON utilizador
FOR EACH ROW 
EXECUTE PROCEDURE email_utilizador_trigger_proc();

-- RI-5
DROP TRIGGER IF EXISTS qualif_user_trigger ON utilizador_qualificado;
DROP FUNCTION IF EXISTS qualif_user_trigger_proc();

CREATE FUNCTION qualif_user_trigger_proc() RETURNS trigger 
AS $qualif_user_trigger_proc$
BEGIN
    IF EXISTS (
        SELECT email
        FROM utilizador_regular 
        WHERE email=NEW.email
    ) THEN
        RAISE EXCEPTION 'email não pode figurar em utilizador_regular.';
    END IF;
    RETURN NEW;
END;
$qualif_user_trigger_proc$ LANGUAGE plpgsql;

CREATE TRIGGER qualif_user_trigger
BEFORE INSERT ON utilizador_qualificado
FOR EACH ROW 
EXECUTE PROCEDURE qualif_user_trigger_proc();

-- RI-6
DROP TRIGGER IF EXISTS reg_user_trigger ON utilizador_regular;
DROP FUNCTION IF EXISTS reg_user_trigger_proc();

CREATE FUNCTION reg_user_trigger_proc() RETURNS trigger 
AS $reg_user_trigger_proc$
BEGIN
    IF EXISTS (
        SELECT email
        FROM utilizador_qualificado 
        WHERE email=NEW.email
    ) THEN
        RAISE EXCEPTION 'email não pode figurar em utilizador_qualificado.';
    END IF;
    RETURN NEW;
END;
$reg_user_trigger_proc$ LANGUAGE plpgsql;

CREATE TRIGGER reg_user_trigger
BEFORE INSERT ON utilizador_regular
FOR EACH ROW 
EXECUTE PROCEDURE reg_user_trigger_proc();

