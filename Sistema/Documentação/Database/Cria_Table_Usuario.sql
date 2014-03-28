use fotografia;

CREATE TABLE IF NOT EXISTS `usuarios` ( `nome` varchar(100) NOT NULL, `usuario` varchar(50) NOT NULL, `senha` varchar(50) NOT NULL, UNIQUE KEY `usuario` (`usuario`) ) CHARACTER SET utf8 COLLATE utf8_general_ci