INSERT INTO usuario (nome, sobrenome, email, usuario, senha, ativo) VALUES 
("Geovani", "Nieswald", "geovaninieswald@gmail.com", "geovani", "$2y$10$enouNLzFfi2nV3rQ2keBgOmtfAzh5BeDuq6X0W65zEk1csfaukC7.", TRUE), /*By6=o8*/
("Daniel", "Frey", "daniel._.frey@hotmail.com", "daniel", "$2y$10$WS/7o//60HbppyT4rvtyg.XzRt7OeB9QAY0RtMZf3DM9.6kAN4rrS", TRUE), /*Cy6=u8*/
("Rodrigo", "Zappe", "rodrigo_zappe@hotmail.com", "rodrigo", "$2y$10$gtFMaGU9.HeieTJ/E4frEORq6y0j/JwxcVyd17c9DfUcgKEybl4WS", TRUE); /*Gy6=r43|9*/

INSERT INTO permissao (codigo, nome) VALUES 
(1, 'adm'), 
(2, 'user');

INSERT INTO permissoes (id_usuario, codigo_permissao) VALUES 
(1, 1),
(2, 1),
(3, 1),
(1, 2),
(2, 2),
(3, 2);