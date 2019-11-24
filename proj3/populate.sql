-- Locais Publicos
insert into local_publico values (38.737003, -9.138694, 'Instituto Superior Tecnico');
insert into local_publico values (38.767960, -9.097086, 'Vasco da Gama');
insert into local_publico values (37.736111, -9.140838, 'Ali Baba Kebab Haus');

-- Items
insert into item values (1, 'menu', 'Lisboa', 37.736111, -9.140838);
insert into item values (2, 'letreiro', 'Lisboa', 38.737003, -9.138694);
insert into item values (3, 'letreiro', 'Lisboa', 38.737003, -9.138694);

-- Anomalia TODO: VER COMO SE INSERE A ZONA E A IMAGEM
insert into anomalia values (1, 'zona1', 'imagem1.jpg', 'portugues', now(), 'Letreiro mal escrito', true);
insert into anomalia values (2, 'zona1', 'imagem2.jpg', 'ingles', now(), 'menu com erro ortografico', false);

-- Anomalia de traducao
insert into anomalia_traducao values (2, 'zona2', 'portugues');

-- Duplicado
insert into duplicado values (2, 3);

-- Utilizador
insert into utilizador values ('gabriel.almeida@tecnico.ulisboa.pt', '12345');
insert into utilizador values ('marcelo.rebelo.sousa@gmail.com', 'fdksjhfj');

-- Utilizador Qualificado
insert into utilizador_qualificado values ('marcelo.rebelo.sousa@gmail.com');

-- Utilizador Regular
insert into utilizador_regular values ('gabriel.almeida@tecnico.ulisboa.pt');

-- Incidencia
insert into incidencia values (1, 2, 'gabriel.almeida@tecnico.ulisboa.pt');
insert into incidencia values (2, 1, 'marcelo.rebelo.sousa@gmail.com');

-- Proposta de Correcao
insert into proposta_de_correcao values ('marcelo.rebelo.sousa@gmail.com', 1, now(), 'Em vez de otorrinoleringlogista deveria ser otorrinolaringologista');

-- Correcao
insert into correcao values ('marcelo.rebelo.sousa@gmail.com', 1, 1);