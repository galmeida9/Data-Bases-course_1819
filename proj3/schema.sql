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
    latitude float(6) not null,
    longitude float(6) not null,
    nome varchar(50) not null,
    constraint pk_latitude_longitude primary key(latitude, longitude),
    unique(latitude),
	unique(longitude)
);

create table item (
    id decimal(5) not null check(id > 0),
    descricao varchar(200) not null,
    localizacao varchar(50) not null,
    latitude float(6) not null,
    longitude float(6) not null,
    constraint pk_item_id primary key(id),
    constraint fk_latitude foreign key(latitude) references local_publico(latitude),
    constraint fk_longitude foreign key(longitude) references local_publico(longitude)
);

create table anomalia (
    id decimal(5) not null check(id > 0),
    zona varchar(50) not null,
    imagem varchar(50) not null,
    lingua varchar(20) not null,
    ts timestamp not null,
    descricao varchar(200) not null,
    tem_anomalia_redacao boolean,
    constraint pk_anomalia_id primary key(id)
);

create table anomalia_traducao (
    id decimal(5) not null check(id > 0),
    zona2 varchar(50) not null,
    lingua2 varchar(20) not null,
    constraint pk_anomalia_traducao_id primary key(id),
    constraint fk_anomalia_traducao_id foreign key(id) references anomalia(id)
);

create table duplicado (
    item1 decimal(5) not null,
    item2 decimal(5) not null check(item1 < item2),
    constraint pk_item_ids primary key(item1, item2),
    constraint fk_item1 foreign key(item1) references item(id),
    constraint fk_item2 foreign key(item2) references item(id)
);

create table utilizador (
    email varchar(40) not null,
    psw varchar(15) not null,
    constraint pk_utilizador_email primary key(email)
);

create table utilizador_qualificado (
    email varchar(40) not null,
    constraint pk_utilizador_qualificado_email primary key(email),
    constraint fk_utilizador_qualificado_email foreign key(email) references utilizador(email)
);

create table utilizador_regular (
    email varchar(40) not null,
    constraint pk_utilizador_regular_email primary key(email),
    constraint fk_utilizador_regular_email foreign key(email) references utilizador(email)
);

create table incidencia (
    anomalia_id decimal(5) not null,
    item_id decimal(5) not null,
    email varchar(40) not null,
    constraint pk_incidenecia primary key(anomalia_id),
    constraint fk_anomalia_id foreign key(anomalia_id) references anomalia(id),
    constraint fk_item_id foreign key(item_id) references item(id),
    constraint fk_incidencia_email foreign key(email) references utilizador(email)
);

create table proposta_de_correcao (
    email varchar(40) not null,
    nro decimal(5) not null,
    data_hora timestamp not null,
    texto varchar(200) not null,
    constraint pk_email_nro primary key(email, nro),
    constraint fk_proposta_de_correcao_email foreign key(email) references utilizador_qualificado(email)
);

create table correcao (
    email varchar(40) not null,
    nro decimal(5) not null,
    anomalia_id decimal(5) not null,
    constraint pk_email_nro_anomalia_id primary key(email, nro, anomalia_id)
);