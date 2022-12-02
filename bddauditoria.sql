CREATE DATABASE  IF NOT EXISTS `bdauditoriainterna` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_bin */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `bdauditoriainterna`;
-- MySQL dump 10.13  Distrib 8.0.28, for Win64 (x86_64)
--
-- Host: localhost    Database: bdauditoriainterna
-- ------------------------------------------------------
-- Server version	8.0.28

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cargo`
--

DROP TABLE IF EXISTS `cargo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cargo` (
  `idCargo` tinyint NOT NULL AUTO_INCREMENT,
  `denominacionCargo` varchar(150) NOT NULL,
  `fechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fechaActualizacion` timestamp NULL DEFAULT NULL,
  `estado` tinyint NOT NULL DEFAULT '1',
  `idUsuario` smallint NOT NULL,
  `idUnidadNegocio` tinyint NOT NULL,
  PRIMARY KEY (`idCargo`),
  KEY `fk_cargo_Unidad_Negocio1_idx` (`idUnidadNegocio`),
  CONSTRAINT `fk_cargo_Unidad_Negocio1` FOREIGN KEY (`idUnidadNegocio`) REFERENCES `unidadnegocio` (`idUnidadNegocio`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cargo`
--

LOCK TABLES `cargo` WRITE;
/*!40000 ALTER TABLE `cargo` DISABLE KEYS */;
INSERT INTO `cargo` VALUES (1,'SUBGERENTE NACIONAL DE AUDITORÍA INTERNA','2022-12-02 17:44:25',NULL,1,1,4),(2,'AUDITOR INTERNO II','2022-12-02 17:44:25',NULL,1,1,4),(3,'SUBGERENTE NACIONAL DE ASESORÍA LEGAL','2022-12-02 17:44:25',NULL,1,1,2),(4,'SUBGERENTE NACIONAL DE GESTIÓN DE RIESGOS','2022-12-02 17:44:25',NULL,1,1,1);
/*!40000 ALTER TABLE `cargo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empleado`
--

DROP TABLE IF EXISTS `empleado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `empleado` (
  `idEmpleado` smallint NOT NULL AUTO_INCREMENT,
  `nombres` varchar(100) NOT NULL,
  `primerApellido` varchar(30) NOT NULL,
  `segundoApellido` varchar(30) DEFAULT NULL,
  `ci` varchar(15) NOT NULL,
  `expedicion` varchar(2) NOT NULL,
  `celular` varchar(10) DEFAULT NULL,
  `telefonoInterno` varchar(5) DEFAULT NULL,
  `correoInstitucional` varchar(35) NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `contrasena` varchar(60) NOT NULL,
  `tipo` varchar(15) NOT NULL,
  `fechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fechaActualizacion` timestamp NULL DEFAULT NULL,
  `estado` tinyint NOT NULL DEFAULT '1',
  `idUsuariocud` tinyint NOT NULL,
  `idCargo` tinyint NOT NULL,
  PRIMARY KEY (`idEmpleado`),
  KEY `fk_empleado_cargo1_idx` (`idCargo`),
  CONSTRAINT `fk_empleado_cargo1` FOREIGN KEY (`idCargo`) REFERENCES `cargo` (`idCargo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empleado`
--

LOCK TABLES `empleado` WRITE;
/*!40000 ALTER TABLE `empleado` DISABLE KEYS */;
INSERT INTO `empleado` VALUES (1,'Pedro','Canedo','Villa','123456','CB','1234585','1245','pcanedo@gmail.com','pcanedo','bd369eba942cd7419e9c2693010cb6cc','jefe','2022-12-02 17:46:55',NULL,1,1,1),(2,'Romel','Gomez','Chavarria','253456','CH','2544585','2245','rgomez@gmail.com','rgomez','cf19c77fddf7683b2b9873618f0c966a','ejecutor','2022-12-02 17:46:55','2022-12-02 23:02:05',1,1,2),(3,'Roberto','Mamani','Llanos','658794','CH','65844123','6513','rmamani@gmail.com','rmamani','b85df6f28f99b35967d5073c3ba60674','auditado','2022-12-02 18:03:24',NULL,1,1,4);
/*!40000 ALTER TABLE `empleado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hallazgo`
--

DROP TABLE IF EXISTS `hallazgo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `hallazgo` (
  `idHallazgo` smallint NOT NULL AUTO_INCREMENT,
  `descripcionHallazgo` text NOT NULL,
  `prioridadAtencion` varchar(15) NOT NULL,
  `comentarioResponsable` text NOT NULL,
  `plazoAccionCorrectiva` date NOT NULL,
  `responsable` varchar(150) NOT NULL,
  `anexo` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT 'Sin Anexo',
  `estadoProceso` tinyint NOT NULL DEFAULT '1',
  `fechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fechaActualizacion` timestamp NULL DEFAULT NULL,
  `estado` tinyint NOT NULL DEFAULT '1',
  `idUsuario` smallint NOT NULL,
  `idProgramaTrabajo` int NOT NULL,
  `idEmpleado` smallint NOT NULL,
  PRIMARY KEY (`idHallazgo`),
  KEY `fk_hallazgo_programatrabajo1_idx` (`idProgramaTrabajo`),
  KEY `fk_hallazgo_empleado1_idx` (`idEmpleado`),
  CONSTRAINT `fk_hallazgo_empleado1` FOREIGN KEY (`idEmpleado`) REFERENCES `empleado` (`idEmpleado`),
  CONSTRAINT `fk_hallazgo_programatrabajo1` FOREIGN KEY (`idProgramaTrabajo`) REFERENCES `programatrabajo` (`idProgramaTrabajo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hallazgo`
--

LOCK TABLES `hallazgo` WRITE;
/*!40000 ALTER TABLE `hallazgo` DISABLE KEYS */;
INSERT INTO `hallazgo` VALUES (1,'Observación 1','MEDIA','Acción Correctiva 1','2022-12-03','3','Sin Anexo',1,'2022-12-02 18:17:20','2022-12-02 23:20:51',1,3,5,3),(2,'Observación 2','ALTA','Acción Correctiva 2','2022-12-31','3','Sin Anexo',1,'2022-12-02 18:17:46','2022-12-02 23:21:08',1,3,6,3);
/*!40000 ALTER TABLE `hallazgo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `memorandumplanificacion`
--

DROP TABLE IF EXISTS `memorandumplanificacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `memorandumplanificacion` (
  `idMemorandumPlanificacion` smallint NOT NULL AUTO_INCREMENT,
  `numeroInforme` varchar(15) NOT NULL,
  `idEmpleado` smallint NOT NULL,
  `idPlanAnualTrabajo` smallint NOT NULL,
  `estadoProceso` tinyint NOT NULL DEFAULT '0',
  `estadoPrograma` tinyint NOT NULL DEFAULT '1',
  `estadoRequerimiento` tinyint NOT NULL DEFAULT '1',
  `estadoHallazgo` tinyint NOT NULL DEFAULT '0',
  `fechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fechaActualizacion` timestamp NULL DEFAULT NULL,
  `estado` tinyint NOT NULL DEFAULT '1',
  `idUsuario` smallint NOT NULL,
  PRIMARY KEY (`idMemorandumPlanificacion`),
  KEY `fk_Memorandum_Planificacion_Plan_Anual_Trabajo1_idx` (`idMemorandumPlanificacion`),
  KEY `fk_memorandumplanificacion_empleado1_idx` (`idEmpleado`),
  KEY `fk_memorandumplanificacion_plananualtrabajo1_idx` (`idPlanAnualTrabajo`),
  CONSTRAINT `fk_memorandumplanificacion_empleado1` FOREIGN KEY (`idEmpleado`) REFERENCES `empleado` (`idEmpleado`),
  CONSTRAINT `fk_memorandumplanificacion_plananualtrabajo1` FOREIGN KEY (`idPlanAnualTrabajo`) REFERENCES `plananualtrabajo` (`idPlanAnualTrabajo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `memorandumplanificacion`
--

LOCK TABLES `memorandumplanificacion` WRITE;
/*!40000 ALTER TABLE `memorandumplanificacion` DISABLE KEYS */;
INSERT INTO `memorandumplanificacion` VALUES (1,'UAI-P001/2022',2,1,0,2,1,0,'2022-12-02 18:06:56','2022-12-02 23:11:04',1,2),(2,'UAI-P002/2022',2,2,4,4,4,1,'2022-12-02 18:07:07','2022-12-02 23:21:49',1,1);
/*!40000 ALTER TABLE `memorandumplanificacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `plananualtrabajo`
--

DROP TABLE IF EXISTS `plananualtrabajo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `plananualtrabajo` (
  `idPlanAnualTrabajo` smallint NOT NULL AUTO_INCREMENT,
  `informe` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `objetivo` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `normativa` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `fechaInicio` date NOT NULL,
  `fechaConclusion` date NOT NULL,
  `gradoPriorizacion` varchar(6) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `estadoEjecucion` tinyint NOT NULL DEFAULT '2',
  `fechaRegistro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fechaActualizacion` datetime DEFAULT NULL,
  `estado` tinyint NOT NULL DEFAULT '1',
  `docInforme` varchar(12) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'Sin Informe',
  `idUsuario` smallint NOT NULL,
  PRIMARY KEY (`idPlanAnualTrabajo`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `plananualtrabajo`
--

LOCK TABLES `plananualtrabajo` WRITE;
/*!40000 ALTER TABLE `plananualtrabajo` DISABLE KEYS */;
INSERT INTO `plananualtrabajo` VALUES (1,'Revisión de la Gestión del Riesgo de Liquidez','Cumplimiento de la normativa ASFI','L03T09C02 6 7-p','2022-12-10','2022-12-31','Alta',1,'2022-12-02 14:00:39',NULL,1,'Sin Informe',1),(2,'Revisión de la Gestión del Riesgo Operativo','Cumplimiento de la normativa ASFI','L03T06C01S04 4','2022-12-25','2022-12-31','Alta',3,'2022-12-02 14:00:39','2022-12-02 19:21:49',1,'Sin Informe',1),(3,'Revisión de la Gestión del Reisgo Crediticio','Cumplimiento de la normativa ASFI','L03T07C02S12 1','2023-01-02','2023-01-31','Baja',2,'2022-12-02 14:00:39',NULL,1,'Sin Informe',1),(4,'Revisión de la administración de Activos Fijos','Cumplimiento de la normativa ASFI','L02T02C08 7 2','2023-01-02','2023-01-31','Media',2,'2022-12-02 14:00:39',NULL,1,'Sin Informe',1),(5,'Revisión de la Gestión de Seguridad de Información','Cumplimiento de la normativa ASFI','L05T02C03S04 2 ','2023-01-02','2023-01-31','Baja',2,'2022-12-02 14:00:39',NULL,1,'Sin Informe',1),(6,'Revisar el  cumplimiento del reglamento de encaje legal','Evaluar el cumplimiento del reglamento','L02T02C08 7 2','2023-01-02','2023-01-31','Baja',2,'2022-12-02 14:00:39',NULL,1,'Sin Informe',1),(7,'Informe sobre Puntos de Reclamo.','Verificar el cumplimiento de la normativa en vigencia','L04T01C01 4 2','2023-01-02','2023-01-31','Baja',2,'2022-12-02 14:00:39',NULL,1,'Sin Informe',1);
/*!40000 ALTER TABLE `plananualtrabajo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proceso`
--

DROP TABLE IF EXISTS `proceso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `proceso` (
  `idProceso` smallint NOT NULL AUTO_INCREMENT,
  `descripcionProceso` varchar(100) NOT NULL,
  `fechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fechaActualizacion` timestamp NULL DEFAULT NULL,
  `estado` tinyint NOT NULL DEFAULT '1',
  `idUsuario` smallint NOT NULL,
  `idUnidadNegocio` tinyint NOT NULL,
  `idPlanAnualTrabajo` smallint NOT NULL,
  PRIMARY KEY (`idProceso`),
  KEY `fk_Procesos_Unidad_Negocio1_idx` (`idUnidadNegocio`),
  KEY `fk_Procesos_Plan_Anual_Trabajo1_idx` (`idPlanAnualTrabajo`),
  CONSTRAINT `fk_Procesos_Plan_Anual_Trabajo1` FOREIGN KEY (`idPlanAnualTrabajo`) REFERENCES `plananualtrabajo` (`idPlanAnualTrabajo`),
  CONSTRAINT `fk_Procesos_Unidad_Negocio1` FOREIGN KEY (`idUnidadNegocio`) REFERENCES `unidadnegocio` (`idUnidadNegocio`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proceso`
--

LOCK TABLES `proceso` WRITE;
/*!40000 ALTER TABLE `proceso` DISABLE KEYS */;
INSERT INTO `proceso` VALUES (1,'Gestión de Riesgos','2022-12-02 18:01:49',NULL,1,1,1,1),(2,'Gestión de Riesgos Operativo','2022-12-02 18:05:31',NULL,1,1,1,2);
/*!40000 ALTER TABLE `proceso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `programatrabajo`
--

DROP TABLE IF EXISTS `programatrabajo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `programatrabajo` (
  `idProgramaTrabajo` int NOT NULL AUTO_INCREMENT,
  `actividad` text NOT NULL,
  `verificacionActividad` tinyint NOT NULL DEFAULT '0',
  `respaldo` varchar(15) NOT NULL DEFAULT 'Sin Respaldo',
  `fechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fechaActualizacion` timestamp NULL DEFAULT NULL,
  `estado` tinyint NOT NULL DEFAULT '1',
  `idUsuario` smallint NOT NULL,
  `idSubProceso` smallint NOT NULL,
  `idMemorandumPlanificacion` smallint NOT NULL,
  PRIMARY KEY (`idProgramaTrabajo`),
  KEY `fk_programatrabajo_subproceso1_idx` (`idSubProceso`),
  KEY `fk_programatrabajo_memorandumplanificacion1_idx` (`idMemorandumPlanificacion`),
  CONSTRAINT `fk_programatrabajo_memorandumplanificacion1` FOREIGN KEY (`idMemorandumPlanificacion`) REFERENCES `memorandumplanificacion` (`idMemorandumPlanificacion`),
  CONSTRAINT `fk_programatrabajo_subproceso1` FOREIGN KEY (`idSubProceso`) REFERENCES `subproceso` (`idSubProceso`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `programatrabajo`
--

LOCK TABLES `programatrabajo` WRITE;
/*!40000 ALTER TABLE `programatrabajo` DISABLE KEYS */;
INSERT INTO `programatrabajo` VALUES (1,'Actividad 1',0,'Sin Respaldo','2022-12-02 18:09:56','2022-12-02 23:11:20',1,1,1,1),(2,'Actividad 2',0,'Sin Respaldo','2022-12-02 18:09:56',NULL,1,2,1,1),(3,'Actividad 3',0,'Sin Respaldo','2022-12-02 18:09:56',NULL,1,2,1,1),(4,'Actividad 1',1,'4.pdf','2022-12-02 18:10:46','2022-12-02 23:14:35',1,2,5,2),(5,'Actividad 2',3,'5.pdf','2022-12-02 18:10:46','2022-12-02 23:17:02',1,2,5,2),(6,'Actividad 3',2,'6.pdf','2022-12-02 18:10:46','2022-12-02 23:17:34',1,2,5,2);
/*!40000 ALTER TABLE `programatrabajo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `requerimientoinformacion`
--

DROP TABLE IF EXISTS `requerimientoinformacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `requerimientoinformacion` (
  `idRequerimientoInformacion` smallint NOT NULL AUTO_INCREMENT,
  `requerimientoInformacion` text NOT NULL,
  `fechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fechaActualizacion` timestamp NULL DEFAULT NULL,
  `estado` tinyint NOT NULL DEFAULT '1',
  `idUsuario` smallint NOT NULL,
  `idUnidadNegocio` tinyint NOT NULL,
  `idMemorandumPlanificacion` smallint NOT NULL,
  PRIMARY KEY (`idRequerimientoInformacion`),
  KEY `fk_requerimiento_informacion_unidadnegocio1_idx` (`idUnidadNegocio`),
  KEY `fk_requerimientoinformacion_memorandumplanificacion1_idx` (`idMemorandumPlanificacion`),
  CONSTRAINT `fk_requerimiento_informacion_unidadnegocio1` FOREIGN KEY (`idUnidadNegocio`) REFERENCES `unidadnegocio` (`idUnidadNegocio`),
  CONSTRAINT `fk_requerimientoinformacion_memorandumplanificacion1` FOREIGN KEY (`idMemorandumPlanificacion`) REFERENCES `memorandumplanificacion` (`idMemorandumPlanificacion`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `requerimientoinformacion`
--

LOCK TABLES `requerimientoinformacion` WRITE;
/*!40000 ALTER TABLE `requerimientoinformacion` DISABLE KEYS */;
INSERT INTO `requerimientoinformacion` VALUES (1,'Requerimiento 1','2022-12-02 18:12:47',NULL,1,1,1,2),(2,'Requerimiento 2','2022-12-02 18:12:47',NULL,1,1,1,2),(3,'Requerimiento 3','2022-12-02 18:12:47',NULL,1,1,1,2),(4,'Requerimiento 4','2022-12-02 18:12:47',NULL,1,1,1,2);
/*!40000 ALTER TABLE `requerimientoinformacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subproceso`
--

DROP TABLE IF EXISTS `subproceso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `subproceso` (
  `idSubProceso` smallint NOT NULL AUTO_INCREMENT,
  `descripcionSubProceso` varchar(255) NOT NULL,
  `clasificacionCriticidad` varchar(10) NOT NULL,
  `fechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fechaActualizacion` timestamp NULL DEFAULT NULL,
  `estado` tinyint NOT NULL DEFAULT '1',
  `idUsuario` smallint NOT NULL,
  `idProceso` smallint NOT NULL,
  PRIMARY KEY (`idSubProceso`),
  KEY `fk_SubProcesos_Procesos1_idx` (`idProceso`),
  CONSTRAINT `fk_SubProcesos_Procesos1` FOREIGN KEY (`idProceso`) REFERENCES `proceso` (`idProceso`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subproceso`
--

LOCK TABLES `subproceso` WRITE;
/*!40000 ALTER TABLE `subproceso` DISABLE KEYS */;
INSERT INTO `subproceso` VALUES (1,'Identificación','No Crítico','2022-12-02 18:04:10',NULL,1,1,1),(2,'Medición','No Crítico','2022-12-02 18:04:28',NULL,1,1,1),(3,'Monitoreo','Crítico','2022-12-02 18:04:57',NULL,1,1,1),(4,'Identificación','Crítico','2022-12-02 18:05:44',NULL,1,1,2),(5,'Medición','No Crítico','2022-12-02 18:05:59','2022-12-02 23:06:17',1,1,2);
/*!40000 ALTER TABLE `subproceso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `unidadnegocio`
--

DROP TABLE IF EXISTS `unidadnegocio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `unidadnegocio` (
  `idUnidadNegocio` tinyint NOT NULL AUTO_INCREMENT,
  `lineaNegocio` varchar(60) NOT NULL,
  `fechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fechaActualizacion` timestamp NULL DEFAULT NULL,
  `estado` tinyint NOT NULL DEFAULT '1',
  `idUsuario` smallint NOT NULL,
  PRIMARY KEY (`idUnidadNegocio`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unidadnegocio`
--

LOCK TABLES `unidadnegocio` WRITE;
/*!40000 ALTER TABLE `unidadnegocio` DISABLE KEYS */;
INSERT INTO `unidadnegocio` VALUES (1,'UNIDAD DE GESTIÓN DE RIESGOS','2022-12-02 17:42:31',NULL,1,1),(2,'UNIDAD DE ASESORÍA LEGAL','2022-12-02 17:42:31',NULL,1,1),(3,'UNIDAD DE SISTEMAS','2022-12-02 17:42:31',NULL,1,1),(4,'UNIDAD DE AUDITORÍA INTERNA','2022-12-02 17:42:31',NULL,1,1);
/*!40000 ALTER TABLE `unidadnegocio` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-12-02 14:29:19
