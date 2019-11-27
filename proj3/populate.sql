-- Locais Publicos
insert into local_publico values (38.737003, -9.138694, 'Instituto Superior Tecnico');
insert into local_publico values (38.767961, -9.097086, 'Vasco da Gama');
insert into local_publico values (37.736111, -9.140838, 'Ali Baba Kebab Haus');
insert into local_publico values (41.157306, -8.629528, 'Porto');
insert into local_publico values (40.203216, -8.407549, 'Coimbra');
insert into local_publico values (37.139168, -8.536958, 'Portimão');

-- Items
insert into item values (default, 'menu', 'Lisboa', 37.736111, -9.140838);
insert into item values (default, 'letreiro', 'Lisboa', 38.737003, -9.138694);
insert into item values (default, 'letreiro', 'Lisboa', 38.737003, -9.138694);
insert into item values (default, 'Cartaz', 'Porto', 41.157306, -8.629528);
insert into item values (default, 'Placar', 'Porto', 41.157306, -8.629528);
insert into item values (default, 'Cartaz', 'Portimão', 37.139168, -8.536958);
insert into item values (default, 'Cartaz', 'Coimbra', 40.203216, -8.407549);

-- Anomalia TODO: VER COMO SE INSERE A IMAGEM
insert into anomalia values (default, '((1,1), (2,2))', 'https://img.olx.com.br/images/39/397827025661247.jpg', 'portugues', now(), 'Letreiro mal escrito', true);
insert into anomalia values (default, '((1,2), (4,5))', 'https://images.squarespace-cdn.com/content/v1/5bf5c4a17e3c3a7cf4ed645a/1561670393341-26BPRXMXTWFW8541ODLS/ke17ZwdGBToddI8pDm48kAcJn0w-wU5dHBD60E0UZTV7gQa3H78H3Y0txjaiv_0fDoOvxcdMmMKkDsyUqMSsMWxHk725yiiHCCLfrh8O1z5QHyNOqBUUEtDDsRWrJLTmEavKLH_ZiDOy8D8MfZnX23QZJwCzR7IYgvsN_lJZxdc352eQAZNMyVB2nTgCZ2cR/COBrunch.png?format=2500w', 'ingles', now(), 'menu com erro ortografico', false);
insert into anomalia values (default, '((2,3), (3,4))', 'http://www.forcaportugal.com/fotos/galerias/loja-l-red-gra_43825865457569cf9b1a8c.jpg', 'portugues', now(), 'Foi escrito louja ao invés de loja', true);
insert into anomalia values (default, '((3,3), (3,4))', 'https://i.ytimg.com/vi/wvuxChUBrdY/maxresdefault.jpg', 'portugues', now(), 'Foi escrito ropa ao invés de roupa', true);
insert into anomalia values (default, '((4,3), (5,4))', 'https://www.tiendasquebarato.com/wp-content/uploads/2018/03/Que-Barato_logo-1x.png', 'portugues', now(), 'Foi escrito brato ao invés de barato', true);
insert into anomalia values (default, '((4,4), (5,5))', 'https://www.tiendasquebarato.com/wp-content/uploads/2018/03/Que-Barato_logo-1x.png', 'portugues', now(), 'Foi escrito barto ao invés de barato', true);

-- Anomalia de traducao
insert into anomalia_traducao values (2, '((10,10), (20,20))', 'portugues');

-- Duplicado
insert into duplicado values (2, 3);

-- Utilizador
insert into utilizador values ('gabriel.almeida@tecnico.ulisboa.pt', '12345');
insert into utilizador values ('marcelo.rebelo.sousa@gmail.com', 'fdksjhfj');
insert into utilizador values ('pgalhardo@me.com', '123');
insert into utilizador values ('daniel@me.com', '123');
insert into utilizador values ('admin', 'admin');

-- Utilizador Qualificado
insert into utilizador_qualificado values ('marcelo.rebelo.sousa@gmail.com');
insert into utilizador_qualificado values ('daniel@me.com');
insert into utilizador_qualificado values ('pgalhardo@me.com');
insert into utilizador_qualificado values ('admin');

-- Utilizador Regular
insert into utilizador_regular values ('gabriel.almeida@tecnico.ulisboa.pt');

-- Incidencia
insert into incidencia values (1, 2, 'gabriel.almeida@tecnico.ulisboa.pt');
insert into incidencia values (2, 1, 'marcelo.rebelo.sousa@gmail.com');
insert into incidencia values (3, 4, 'daniel@me.com');
insert into incidencia values (4, 4, 'daniel@me.com');
insert into incidencia values (5, 4, 'pgalhardo@me.com');
insert into incidencia values (6, 7, 'daniel@me.com');


-- Proposta de Correcao
insert into proposta_de_correcao values ('marcelo.rebelo.sousa@gmail.com', default, now(), 'Em vez de otorrinoleringlogista deveria ser otorrinolaringologista');

-- Correcao
insert into correcao values ('marcelo.rebelo.sousa@gmail.com', 1, 1);

