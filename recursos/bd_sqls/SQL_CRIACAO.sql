DROP DATABASE IF EXISTS poligno_news;

CREATE DATABASE poligno_news CHARACTER SET utf8 COLLATE utf8_general_ci;
USE poligno_news;

CREATE TABLE usuario (
	id INT AUTO_INCREMENT, 
    nome VARCHAR(255) NOT NULL, 
    sobrenome VARCHAR(255) NOT NULL, 
    email VARCHAR(255) NOT NULL UNIQUE, 
    usuario VARCHAR(255) NOT NULL UNIQUE, 
    senha VARCHAR(255) NOT NULL,
    nascimento DATE,
    sexo VARCHAR(1),
    celular VARCHAR(20),
    imagem VARCHAR(255),
    cidade VARCHAR(255), 
    bio MEDIUMTEXT, 
    ativo TINYINT NOT NULL,
    
    PRIMARY KEY (id)
);

CREATE TABLE permissao (
	codigo INT NOT NULL, 
    nome VARCHAR(255) NOT NULL, 
    
	PRIMARY KEY (codigo)
);

CREATE TABLE permissoes (
	id_usuario INT NOT NULL,
    codigo_permissao INT NOT NULL, 
    
    PRIMARY KEY (id_usuario, codigo_permissao),
	CONSTRAINT fk_usuario_usuario FOREIGN KEY (id_usuario) REFERENCES usuario(id),
    CONSTRAINT fk_usuario_permissao FOREIGN KEY (codigo_permissao) REFERENCES permissao(codigo)
);

CREATE TABLE attempt (
	id INT AUTO_INCREMENT NOT NULL,
    ip VARCHAR(255) NOT NULL, 
    data_hora DATETIME NOT NULL, 
    
	PRIMARY KEY (id)
);

CREATE TABLE confirmation (
	id INT AUTO_INCREMENT NOT NULL,
    email VARCHAR(255) NOT NULL, 
    token TEXT NOT NULL, 
    
	PRIMARY KEY (id)
);

CREATE TABLE relacionamento (
	id_seguidor INT NOT NULL,
    id_seguido INT NOT NULL,
    
    PRIMARY KEY (id_seguidor, id_seguido),
    CONSTRAINT fk_usuario_seguidor FOREIGN KEY (id_seguidor) REFERENCES usuario(id),
    CONSTRAINT fk_usuario_seguido FOREIGN KEY (id_seguido) REFERENCES usuario(id)
);

CREATE TABLE publicacao (
	id INT AUTO_INCREMENT,
    id_usuario INT NOT NULL,
    data_hora DATETIME NOT NULL,
    conteudo MEDIUMTEXT,
    
    PRIMARY KEY (id),
    CONSTRAINT fk_usuario_publicacao FOREIGN KEY (id_usuario) REFERENCES usuario(id)
);

CREATE TABLE compartilhamento (
	id INT AUTO_INCREMENT,
    id_usuario INT NOT NULL, 
    id_criador INT NOT NULL, 
    id_publicacao INT NOT NULL,
    data_hora DATETIME NOT NULL,
    
    PRIMARY KEY (id),
    CONSTRAINT fk_usuario_compartilhamento FOREIGN KEY (id_usuario) REFERENCES usuario(id) ON DELETE CASCADE,
    CONSTRAINT fk_criador_compartilhamento FOREIGN KEY (id_criador) REFERENCES usuario(id) ON DELETE CASCADE,
    CONSTRAINT fk_publicacao_compartilhamento FOREIGN KEY (id_publicacao) REFERENCES publicacao(id) ON DELETE CASCADE
);

CREATE TABLE curtida (
	id INT AUTO_INCREMENT,
    id_usuario INT NOT NULL, 
    id_publicacao INT NOT NULL,
    
    PRIMARY KEY (id),
    CONSTRAINT fk_usuario_curtida FOREIGN KEY (id_usuario) REFERENCES usuario(id) ON DELETE CASCADE,
    CONSTRAINT fk_publicacao_curtida FOREIGN KEY (id_publicacao) REFERENCES publicacao(id) ON DELETE CASCADE
);