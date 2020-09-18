CREATE DATABASE  IF NOT EXISTS `db_locadora` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */;
USE `db_locadora`;
-- MySQL dump 10.13  Distrib 8.0.15, for Win64 (x86_64)
--
-- Host: localhost    Database: db_locadora
-- ------------------------------------------------------
-- Server version	8.0.15

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `tbl_ator`
--

DROP TABLE IF EXISTS `tbl_ator`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tbl_ator` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome_ator` varchar(45) NOT NULL,
  `detalhes` text NOT NULL,
  `imagem` varchar(45) NOT NULL,
  `destaque` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_ator`
--

LOCK TABLES `tbl_ator` WRITE;
/*!40000 ALTER TABLE `tbl_ator` DISABLE KEYS */;
INSERT INTO `tbl_ator` VALUES (2,'Will Smithhh','1Willard Carroll “Will” Smith Jr. (Filadélfia, 25 de setembro de 1968)[1] é um ator, rapper, produtor cinematográfico, produtor musical e produtor de televisão estadunidense. É filho do ator e humorista Willard Carroll Smith Sr. e da cantora Caroline Bright. Ele é mais conhecido pelas atuações em Bad Boys, Bad Boys II, Independence Day, I, Robot, I Am Legend, Hancock, Men in Black, Men in Black II e Men in Black III. Smith já foi duas vezes indicado ao Oscar de melhor ator pelas atuações em Ali e The Pursuit of Happyness. Will também é um dos atores mais bem sucedidos quando se fala em bilheteria no cinema, sendo que uma boa parte de seus filmes tiveram faturamento enorme em todo o mundo. Alguns críticos menos conhecidos, e também outros conhecidos, apontam esse sucesso, dentre outras causas, pelo seu carisma, demostrado desde The Fresh Prince of Bel-Air (Um Maluco no Pedaço). Will Smith está classificado como o astro mais rentável em todo o mundo pela revista Forbes. Até 2014, 17 dos 21 filmes em que ele tev','8b43c0a65f2beb5bc3cbe4ac9a3c1618.jpg',1),(3,'123','1Willard Carroll “Will” Smith Jr. (Filadélfia, 25 de setembro de 1968)[1] é um ator, rapper, produtor cinematográfico, produtor musical e produtor de televisão estadunidense. É filho do ator e humorista Willard Carroll Smith Sr. e da cantora Caroline Bright. Ele é mais conhecido pelas atuações em Bad Boys, Bad Boys II, Independence Day, I, Robot, I Am Legend, Hancock, Men in Black, Men in Black II e Men in Black III. Smith já foi duas vezes indicado ao Oscar de melhor ator pelas atuações em Ali e The Pursuit of Happyness. Will também é um dos atores mais bem sucedidos quando se fala em bilheteria no cinema, sendo que uma boa parte de seus filmes tiveram faturamento enorme em todo o mundo. Alguns críticos menos conhecidos, e também outros conhecidos, apontam esse sucesso, dentre outras causas, pelo seu carisma, demostrado desde The Fresh Prince of Bel-Air (Um Maluco no Pedaço). Will Smith está classificado como o astro mais rentável em todo o mundo pela revista Forbes. Até 2014, 17 dos 21 filmes em que ele tev Lorem Ipsum é simplesmente uma simulação de texto da indústria tipográfica e de impressos, e vem sendo utilizado desde o século XVI, quando um impressor desconhecido pegou uma bandeja de tipos e os embaralhou para fazer um livro de modelos de tipos. Lorem Ipsum sobreviveu não só a cinco séculos, como também ao salto para a editoração eletrônica, permanecendo essencialmente inalterado. Se popularizou na década de 60, quando a Letraset lançou decalques contendo passagens de Lorem Ipsum, e mais recentemente quando passou a ser integrado a softwares de editoração eletrônica como Aldus PageMaker.Lorem Ipsum é simplesmente uma simulação de texto da indústria tipográfica e de impressos, e vem sendo utilizado desde o século XVI, quando um impressor desconhecido pegou uma bandeja de tipos e os embaralhou para fazer um livro de modelos de tipos. Lorem Ipsum sobreviveu não só a cinco séculos, como também ao salto para a editoração eletrônica, permanecendo essencialmente inalterado. Se popularizou na década de 60, quando a Letraset lançou decalques contendo passagens de Lorem Ipsum, e mais recentemente quando passou a ser integrado a softwares de editoração eletrônica como Aldus PageMaker.','72a24672aa91146e27dd47b32585c02b.jpg',0),(4,'123','1Willard Carroll “Will” Smith Jr. (Filadélfia, 25 de setembro de 1968)[1] é um ator, rapper, produtor cinematográfico, produtor musical e produtor de televisão estadunidense. É filho do ator e humorista Willard Carroll Smith Sr. e da cantora Caroline Bright. Ele é mais conhecido pelas atuações em Bad Boys, Bad Boys II, Independence Day, I, Robot, I Am Legend, Hancock, Men in Black, Men in Black II e Men in Black III. Smith já foi duas vezes indicado ao Oscar de melhor ator pelas atuações em Ali e The Pursuit of Happyness. Will também é um dos atores mais bem sucedidos quando se fala em bilheteria no cinema, sendo que uma boa parte de seus filmes tiveram faturamento enorme em todo o mundo. Alguns críticos menos conhecidos, e também outros conhecidos, apontam esse sucesso, dentre outras causas, pelo seu carisma, demostrado desde The Fresh Prince of Bel-Air (Um Maluco no Pedaço). Will Smith está classificado como o astro mais rentável em todo o mundo pela revista Forbes. Até 2014, 17 dos 21 filmes em que ele tev Lorem Ipsum é simplesmente uma simulação de texto da indústria tipográfica e de impressos, e vem sendo utilizado desde o século XVI, quando um impressor desconhecido pegou uma bandeja de tipos e os embaralhou para fazer um livro de modelos de tipos. Lorem Ipsum sobreviveu não só a cinco séculos, como também ao salto para a editoração eletrônica, permanecendo essencialmente inalterado. Se popularizou na década de 60, quando a Letraset lançou decalques contendo passagens de Lorem Ipsum, e mais recentemente quando passou a ser integrado a softwares de editoração eletrônica como Aldus PageMaker.Lorem Ipsum é simplesmente uma simulação de texto da indústria tipográfica e de impressos, e vem sendo utilizado desde o século XVI, quando um impressor desconhecido pegou uma bandeja de tipos e os embaralhou para fazer um livro de modelos de tipos. Lorem Ipsum sobreviveu não só a cinco séculos, como também ao salto para a editoração eletrônica, permanecendo essencialmente inalterado. Se popularizou na década de 60, quando a Letraset lançou decalques contendo passagens de Lorem Ipsum, e mais recentemente quando passou a ser integrado a softwares de editoração eletrônica como Aldus PageMaker.','abe1d49d0110f37530c43266ff500e9f.jpg',0);
/*!40000 ALTER TABLE `tbl_ator` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_fale_conosco`
--

DROP TABLE IF EXISTS `tbl_fale_conosco`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tbl_fale_conosco` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `telefone` varchar(100) DEFAULT NULL,
  `celular` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `home_page` varchar(100) DEFAULT NULL,
  `facebook` varchar(100) DEFAULT NULL,
  `sugestao` text,
  `produto` varchar(100) DEFAULT NULL,
  `sexo` char(1) NOT NULL,
  `profissao` varchar(100) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_fale_conosco`
--

LOCK TABLES `tbl_fale_conosco` WRITE;
/*!40000 ALTER TABLE `tbl_fale_conosco` DISABLE KEYS */;
INSERT INTO `tbl_fale_conosco` VALUES (2,'asdjhasdj','','(12) 31231-2312','aksjdkja@asd.com','','','','','f','sei la'),(3,'asd','(12) 2222-2222','(22) 22222-2222','aksjdkja@asd.oa','','','','','f','sei la'),(4,'testea','(12) 2222-2222','(12) 31231-2312','teste@teste.com','teste','teste','ateste','teste','m','teste');
/*!40000 ALTER TABLE `tbl_fale_conosco` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_filme`
--

DROP TABLE IF EXISTS `tbl_filme`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tbl_filme` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome_filme` varchar(200) NOT NULL,
  `img_filme` varchar(255) NOT NULL,
  `descricao` varchar(200) NOT NULL,
  `preco` decimal(10,0) NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_filme`
--

LOCK TABLES `tbl_filme` WRITE;
/*!40000 ALTER TABLE `tbl_filme` DISABLE KEYS */;
INSERT INTO `tbl_filme` VALUES (1,'Pantera Negra','filmeteste.jpg','asdasd asdasd',250,1),(2,'Homem de Ferro 3','testeimg2.jpg','sei la sei la sei la sei la',300,1);
/*!40000 ALTER TABLE `tbl_filme` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_filme_mes`
--

DROP TABLE IF EXISTS `tbl_filme_mes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tbl_filme_mes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) NOT NULL,
  `imagem` varchar(300) NOT NULL,
  `conteudo` mediumtext NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_filme_mes`
--

LOCK TABLES `tbl_filme_mes` WRITE;
/*!40000 ALTER TABLE `tbl_filme_mes` DISABLE KEYS */;
INSERT INTO `tbl_filme_mes` VALUES (1,'Pantera Negra','pantera_negra.jpg','Após a morte do rei T\'Chaka (John Kani), o príncipe T\'Challa (Chadwick Boseman) retorna a Wakanda para a cerimônia de coroação. Nela são reunidas as cinco tribos que compõem o reino, sendo que uma delas, os Jabari, não apoia o atual governo. T\'Challa logo recebe o apoio de Okoye (Danai Gurira), a chefe da guarda de Wakanda, da irmã Shuri (Letitia Wright), que coordena a área tecnológica do reino, e também de Nakia (Lupita Nyong\'o), a grande paixão do atual Pantera Negra, que não quer se tornar rainha. Juntos, eles estão à procura de Ulysses Klaue (Andy Serkis), que roubou de Wakanda um punhado de vibranium, alguns anos atrás.',1);
/*!40000 ALTER TABLE `tbl_filme_mes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_nivel_usuario`
--

DROP TABLE IF EXISTS `tbl_nivel_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tbl_nivel_usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nivel` varchar(100) NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_nivel_usuario`
--

LOCK TABLES `tbl_nivel_usuario` WRITE;
/*!40000 ALTER TABLE `tbl_nivel_usuario` DISABLE KEYS */;
INSERT INTO `tbl_nivel_usuario` VALUES (1,'Administrador',1),(2,'Cataloguista',1),(3,'Operador Básico',1);
/*!40000 ALTER TABLE `tbl_nivel_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_nossas_lojas`
--

DROP TABLE IF EXISTS `tbl_nossas_lojas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tbl_nossas_lojas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `imagem1` varchar(300) NOT NULL,
  `imagem2` varchar(100) NOT NULL,
  `titulo` text NOT NULL,
  `conteudo` text NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_nossas_lojas`
--

LOCK TABLES `tbl_nossas_lojas` WRITE;
/*!40000 ALTER TABLE `tbl_nossas_lojas` DISABLE KEYS */;
INSERT INTO `tbl_nossas_lojas` VALUES (12,'63a8b825303680d029782970ddc2a4be.jpg','67743b7b5ac3a0f33c9985ba6a72dcae.jpg','titulo','Lorem Ipsum é simplesmente uma simulação de texto da indústria tipográfica e de impressos, e vem sendo utilizado desde o século XVI, quando um impressor desconhecido pegou uma bandeja de tipos e os embaralhou para fazer um livro de modelos de tipos. Lorem Ipsum sobreviveu não só a cinco séculos, como também ao salto para a editoração eletrônica, permanecendo essencialmente inalterado. Se popularizou na década de 60, quando a Letraset lançou decalques contendo passagens de Lorem Ipsum, e mais recentemente quando passou a ser integrado a softwares de editoração eletrônica como Aldus PageMaker.',1),(13,'1d6b671e607c2a3fc6840ba0163ccf04.jpg','a70ad766d0ddcfa3905a82f4c240913c.jpg',' sei la',' sei la   sei la sei la   sei la sei la   sei la sei la   sei la',1);
/*!40000 ALTER TABLE `tbl_nossas_lojas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_promocao`
--

DROP TABLE IF EXISTS `tbl_promocao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tbl_promocao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `promocao` decimal(10,0) DEFAULT NULL,
  `id_filme` int(11) DEFAULT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_filme_idx` (`id_filme`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_promocao`
--

LOCK TABLES `tbl_promocao` WRITE;
/*!40000 ALTER TABLE `tbl_promocao` DISABLE KEYS */;
INSERT INTO `tbl_promocao` VALUES (2,5,1,0),(3,50,1,1),(4,21,2,1);
/*!40000 ALTER TABLE `tbl_promocao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_sobre`
--

DROP TABLE IF EXISTS `tbl_sobre`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tbl_sobre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `conteudo` mediumtext NOT NULL,
  `imagem` varchar(300) NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_sobre`
--

LOCK TABLES `tbl_sobre` WRITE;
/*!40000 ALTER TABLE `tbl_sobre` DISABLE KEYS */;
INSERT INTO `tbl_sobre` VALUES (1,' Ipsum é simplesmente uma simulação de texto da indústria tipográfica e de impressos, e vem sendo utilizado desde o século XVI, quando um impressor desconhecido pegou uma bandeja de tipos e os embaralhou para fazer um livro de modelos de tipos. Lorem Ipsum sobreviveu não só a cinco séculos, como também ao salto para a editoração eletrônica, permanecendo essencialmente inalterado. Se popularizou na década de 60, quando a Letraset lançou decalques contendo passagens de Lorem Ipsum, e mais recentemente quando passou a ser integrado a softwares de editoração eletrônica como Aldus PageMaker.','d713354eb197694007aa210b8b086f4a.jpg',1);
/*!40000 ALTER TABLE `tbl_sobre` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_usuario`
--

DROP TABLE IF EXISTS `tbl_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tbl_usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `nivel` varchar(100) NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_nivel_idx` (`nivel`)
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_usuario`
--

LOCK TABLES `tbl_usuario` WRITE;
/*!40000 ALTER TABLE `tbl_usuario` DISABLE KEYS */;
INSERT INTO `tbl_usuario` VALUES (72,'oi','a2e63ee01401aaeca78be023dfbb8c59','oi','1',1),(73,'teste','698dc19d489c4e4db73e28a713eab07b','teste','2',0);
/*!40000 ALTER TABLE `tbl_usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-05-13 11:44:30
