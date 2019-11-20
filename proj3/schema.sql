-- Drop all tables
drop table local_publico cascade;
drop table item cascade;
drop table anomalia cascade;
drop table anomalia_traducao cascade;
drop table duplicado cascade;
drop table utilizador cascade;
drop table utilizador_qualificado;
drop table utilizador_regular;
drop table incidencia cascade;
drop table proposta_de_correcao cascade;
drop table correcao cascade;

-- Create all tables
create table local_publico (
    latitude float(6) not null,
    longitude float(6) not null,
    nome varchar(50) not null,
    constraint pk_latitude primary key(latitude),
    constraint pk_longitude primary key(longitude)
);

create table item (
    id decimal(5) not null check(id > 0),
    descricao varchar(200) not null,
    localizacao varchar(50) not null,
    latitude float(6) not null,
    longitude float(6) not null,
    constraint pk_id primary key(id),
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
    constraint pk_id primary key(id)
);

create table anomalia_traducao (
    id decimal(5) not null check(id > 0),
    zona2 varchar(50) not null,
    lingua2 varchar(20) not null,
    constraint pk_id primary key(id),
    constraint fk_id foreign key(id) references anomalia(id),
);

create table duplicado (
    item1 decimal(5) not null,
    item2 decimal(5) not null check(item1 < item2),
    constraint pk_item primary key(item1, item2),
    constraint fk_item1 foreign key(item1) references item(id);
    constraint fk_item2 foreign key(item2) references item(id);
);

create table utilizador (
    email varchar(40) not null,
    psw varchar(15) not null,
    constraint pk_email primary key(email)
);

create table utilizador_qualificado (
    email varchar(40) not null,
    constraint pk_email primary key(email),
    constraint fk_email foreign key(email) references utilizador(email)
);

create table utilizador_regular (
    email varchar(40) not null,
    constraint pk_email primary key(email),
    constraint fk_email foreign key(email) references utilizador(email)
);

create table incidencia (
    anomalia_id decimal(5) not null,
    item_id decimal(5) not null,
    email varchar(40) not null,
    -- constraint pk_anomalia_id
)