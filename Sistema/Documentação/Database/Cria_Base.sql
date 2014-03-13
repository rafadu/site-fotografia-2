CREATE DATABASE fotografia CHARACTER SET utf8 COLLATE utf8_general_ci;

use fotografia;

CREATE TABLE IF NOT EXISTS fotografia.TipoImagem (
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	tipo VARCHAR(50) NOT NULL
) CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE IF NOT EXISTS fotografia.TipoPostagem (
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	tipo VARCHAR(50) NOT NULL
) CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE IF NOT EXISTS fotografia.Postagem (
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	titulo VARCHAR(50) NOT NULL,
	texto TEXT NOT NULL,
	dataCriacao DATETIME,
	isAtivo BOOLEAN,
	idTipoPostagem INT NOT NULL,
	CONSTRAINT FK_TipoPostagem_Postagem 
		FOREIGN KEY FK_TipoPostagem_Postagem (idTipoPostagem)
		REFERENCES fotografia.TipoPostagem (id)
) CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE IF NOT EXISTS fotografia.Imagem(
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	caminhoImagem varchar(150) NOT NULL,
	link VARCHAR(150),
	idTipoImagem INT NOT NULL,
	idPostagem INT,
	CONSTRAINT FK_TipoImagem_Imagem
		FOREIGN KEY FK_TipoImagem_Imagem (idTipoImagem)
		REFERENCES fotografia.TipoImagem (id),
	CONSTRAINT FK_Postagem_Imagem
		FOREIGN KEY FK_Postagem_Imagem (idPostagem)
		REFERENCES fotografia.Postagem (id)
	
) CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE IF NOT EXISTS fotografia.Tag(
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	tag VARCHAR(50) NOT NULL
	/*idPostagem INT NOT NULL
	CONSTRAINT FK_Postagem_Tag
		FOREIGN KEY FK_Postagem_Tag (idPostagem)
		REFERENCES fotografia.Postagem(id)*/
) CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE IF NOT EXISTS fotografia.PostagemTag(
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	idPostagem INT NOT NULL,
	idTag INT NOT NULL,
	CONSTRAINT FK_Postagem
		FOREIGN KEY FK_Postagem (idPostagem)
		REFERENCES fotografia.Postagem(id),
	CONSTRAINT FK_Tag
		FOREIGN KEY FK_Tag (idTag)
		REFERENCES fotografia.Tag(id)
) CHARACTER SET utf8 COLLATE utf8_general_ci;
/*CREATE  TABLE IF NOT EXISTS fotografia.comentario (
  idcomentario INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
  comentario VARCHAR(300) NOT NULL ,
  idPostagem INT(11) NOT NULL ,
  CONSTRAINT FK_Postagem_Comentario
    FOREIGN KEY FK_Postagem_Comentario(idPostagem)
    REFERENCES fotografia.postagem (id)
) CHARACTER SET utf8 COLLATE utf8_general_ci;*/