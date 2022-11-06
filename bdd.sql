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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cargo`
--

LOCK TABLES `cargo` WRITE;
/*!40000 ALTER TABLE `cargo` DISABLE KEYS */;
INSERT INTO `cargo` VALUES (1,'SUBGERENTE NACIONAL DE AUDITORÍA INTERNA','2022-10-18 03:05:05','2022-11-01 18:21:03',1,1,4),(2,'AUDITOR INTERNO II','2022-10-18 03:05:05','2022-10-31 03:17:08',1,1,4),(3,'SUBGERENTE NACIONAL DE ASESORÍA LEGAL','2022-10-18 03:05:05',NULL,1,1,2),(4,'SUBGERENTE NACIONAL DE GESTIÓN DE RIESGOS','2022-10-18 03:05:05','2022-11-01 20:04:24',1,1,1),(5,'JEFE DE SISTEMAS','2022-10-30 19:03:30','2022-11-01 20:04:24',1,1,3);
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empleado`
--

LOCK TABLES `empleado` WRITE;
/*!40000 ALTER TABLE `empleado` DISABLE KEYS */;
INSERT INTO `empleado` VALUES (1,'PEDRO','CANEDO','VILLA','123456','CB','1234585','1245','pcanedo@gmail.com','pcanedo','bd369eba942cd7419e9c2693010cb6cc','jefe','2022-10-18 03:05:53','2022-10-31 06:01:17',1,1,1),(2,'ROMEL','GOMEZ','CHAVARRIA','253456','CH','2544585','2245','rgomez@gmail.com','rgomez','cf19c77fddf7683b2b9873618f0c966a','ejecutor','2022-10-18 03:05:53','2022-10-31 08:20:46',1,1,2),(3,'ROBERTO','MAMANI','','45789521','CB','7584952','5486','rmamani@gmail.com','rmamani','b85df6f28f99b35967d5073c3ba60674','auditado','2022-10-18 03:41:19','2022-10-19 11:38:23',1,1,3),(4,'MARCELA','GALLARDO','CABRERA','7584926','CB','548795455','5489','mgallardo@gmail.com','mgallardo','94e30380c7d073682ba0a82546975a2e','ejecutor','2022-10-27 17:08:32',NULL,1,1,2),(5,'MARCELO','CLAURE','VISCARRA','6587944','CH','','','mclaure@gmail.com','mclaure','3905ccbca4063bef4eea9f48b23ecb03','ejecutor','2022-10-30 22:23:50','2022-10-31 08:23:11',1,1,2);
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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hallazgo`
--

LOCK TABLES `hallazgo` WRITE;
/*!40000 ALTER TABLE `hallazgo` DISABLE KEYS */;
INSERT INTO `hallazgo` VALUES (1,'Observación 1','ALTA','Acción Correctiva 3','2022-11-30','SNGR','6.xlsx',1,'2022-10-18 03:47:47','2022-10-19 11:33:02',1,3,6,2),(2,'Observación 2','BAJA','Este es una prueba ','2022-10-30','SNGR','7.xlsx',1,'2022-10-18 03:48:48','2022-10-27 11:02:33',1,3,7,3),(3,'Observación 2','BAJA','','0000-00-00','','7.xlsx',1,'2022-10-18 03:54:35',NULL,1,1,7,3),(4,'Observación 1000','ALTA','','0000-00-00','','9.xlsx',1,'2022-10-18 22:33:54',NULL,1,1,9,3),(5,'Observación 5001','ALTA','','0000-00-00','','Sin Anexo',1,'2022-10-18 23:33:12',NULL,1,1,14,3),(6,'Observación 5001','MEDIA','','0000-00-00','','15.xlsx',1,'2022-10-18 23:33:47',NULL,1,1,15,3),(7,'Observacion 10000','BAJA','','0000-00-00','','Sin Anexo',1,'2022-10-19 00:16:50',NULL,1,3,17,3),(8,'Observacion 10000','BAJA','','0000-00-00','','Sin Anexo',1,'2022-10-19 00:16:59',NULL,1,3,17,3),(9,'Observación 1','ALTA','Acción Correctiva 2','2022-11-20','RR HH','Sin Anexo',1,'2022-10-19 04:45:49','2022-10-19 11:17:21',1,3,19,3),(10,'Observación 2','ALTA','Acción Correctiva 3','2022-10-23','USI','Sin Anexo',1,'2022-10-19 04:46:09','2022-10-19 11:17:51',1,3,20,2),(11,'Observación 6','BAJA','Acción Correctiva 6','2023-01-21','OSI','Sin Anexo',1,'2022-10-19 05:45:21','2022-10-19 11:47:30',1,1,21,3),(12,'Observación 151000','MEDIA','Accion Correctiva 3','2022-10-29','USI','23.xlsx',1,'2022-10-19 14:33:48','2022-10-19 20:35:03',1,1,23,3),(13,'Observacion 500000','MEDIA','Este es una prueba de acción correctiva','2022-10-29','RRHH','Sin Anexo',1,'2022-10-19 23:02:15','2022-10-27 10:23:54',1,3,23,3),(14,'Observacion 50','MEDIA','','0000-00-00','','Sin Anexo',1,'2022-10-25 01:54:21',NULL,1,1,18,3);
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
  `estadoProceso` tinyint NOT NULL DEFAULT '1',
  `estadoPrograma` tinyint NOT NULL DEFAULT '1',
  `estadoRequerimiento` tinyint NOT NULL DEFAULT '1',
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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `memorandumplanificacion`
--

LOCK TABLES `memorandumplanificacion` WRITE;
/*!40000 ALTER TABLE `memorandumplanificacion` DISABLE KEYS */;
INSERT INTO `memorandumplanificacion` VALUES (1,'UAI-P001/2022',2,1,2,1,1,'2022-10-18 03:09:09','2022-11-02 20:09:34',1,1),(2,'UAI-P002/2022',2,2,4,4,1,'2022-10-18 03:09:09','2022-10-29 04:45:51',1,1),(5,'UAI-005/2022',2,3,1,1,1,'2022-10-19 04:40:42','2022-11-01 21:41:50',1,1),(6,'UAI-010/2022',2,4,1,1,1,'2022-10-25 01:52:19','2022-10-27 18:17:42',1,1),(7,'UAI-006/2022',1,5,1,1,1,'2022-10-27 19:13:48','2022-10-31 19:14:28',1,1),(10,'UAI-011/2022',1,6,1,1,1,'2022-10-28 18:52:11',NULL,1,1),(12,'UAI-P015/2022',4,7,1,1,1,'2022-10-31 12:26:45',NULL,1,1),(13,'UAI-P016/2022',2,10,4,4,1,'2022-10-31 13:33:58','2022-11-02 19:50:31',1,1);
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
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `plananualtrabajo`
--

LOCK TABLES `plananualtrabajo` WRITE;
/*!40000 ALTER TABLE `plananualtrabajo` DISABLE KEYS */;
INSERT INTO `plananualtrabajo` VALUES (1,'Revisión de la Gestión del Riesgo de Liquidez','Cumplimiento de la normativa ASFI','L03T09C02 6 7-p','2022-01-03','2022-01-13','Alta',1,'2022-10-17 23:08:17','2022-10-31 20:46:25',1,'Sin Informe',1),(2,'Revisión de la Gestión del Riesgo Operativo','Cumplimiento de la normativa ASFI','L03T06C01S04 4','2022-01-03','2022-01-13','Alta',3,'2022-10-17 23:08:17','2022-10-29 00:45:51',1,'Sin Informe',1),(3,'Revisión de la Gestión del Riesgo Crediticio','Cumplimiento de la normativa ASFI','L03T07C02S12 1','2022-01-03','2022-01-03','Baja',1,'2022-10-17 23:08:17','2022-10-28 22:50:40',1,'3.pdf',1),(4,'Informar sobre las pruebas realizadas a los planes de contingencia tecnológicas y de continuidad del negocio.','Cumplimiento de la normativa ASFI','L03T07C02S12 1','2022-01-10','2022-01-27','Baja',1,'2022-10-17 23:08:17','2022-10-27 14:17:42',1,'Sin Informe',1),(5,'Revisión de la administración de Activos Fijos','Cumplimiento de la normativa ASFI','L02T02C08 7 2','2022-01-24','2022-01-27','Media',1,'2022-10-17 23:08:17','2022-10-28 02:28:33',1,'Sin Informe',1),(6,'Revisión de la Gestión de Seguridad de Información','Cumplimiento de la normativa ASFI','L05T02C03S04 2 ','2022-01-24','2022-01-27','Baja',1,'2022-10-17 23:08:17',NULL,1,'Sin Informe',1),(7,'Cumplimiento de tarifas máximas para órdenes electrónicas de transferencia de fondos','Evaluar el cumplimiento de RD 49/2018 del BCB ','Resolución de directorio del BCB N° 49/2018','2022-02-02','2022-02-18','Media',1,'2022-10-17 23:08:17','2022-10-31 05:47:11',0,'Sin Informe',1),(9,'Seguimiento a Contribuciones o aportes a fines sociales, culturales y gremiales.','Verificar si se cumple normativa de la ASFI','L02T07C02 3 2','2022-02-07','2022-02-24','Baja',2,'2022-10-17 23:08:17','2022-10-31 16:03:49',1,'Sin Informe',1),(10,'LGI y/o FT, asi como medidas contra el FPADM (UIF).','Revisar los reportes e informes emitidos','ii. LD/LGI (Artículo 9° del Decreto Supremo N° 910 de 15 de junio de 2011)','2022-02-03','2022-02-24','Alta',3,'2022-10-17 23:08:17','2022-11-02 15:50:31',1,'Sin Informe',1),(11,'Revisar el  cumplimiento del reglamento de encaje legal','Evaluar el cumplimiento del reglamento','L02T02C08 7 2','2022-02-15','2022-02-24','Media',2,'2022-10-17 23:08:17','2022-10-31 16:28:12',1,'Sin Informe',1),(12,'Cumplimiento de obligaciones contractuales contrato FIPOREGA','Revisar los reportes y documentación de carpetas','Contrato con fiporega y su reglamento','2022-03-04','2022-03-15','Baja',2,'2022-10-17 23:08:17',NULL,1,'Sin Informe',1),(13,'Evaluar el cumplimiento del Plan Estratégico.','Verificar el cumplimiento del Plan Estratégico para la gestión 2021','L03T09C02 6 7','2022-02-21','2022-03-29','Alta',2,'2022-10-17 23:08:17','2022-11-02 14:54:42',0,'Sin Informe',1),(17,'Revisar el  cumplimiento del reglamento de encaje legal','Evaluar el cumplimiento del reglamento','L02T02C08 7 2','2022-03-03','2022-03-29','Baja',2,'2022-10-17 23:08:17',NULL,1,'Sin Informe',1),(18,'Análisis financiero trimestral de los estados financieros. ','Efectuar un análisis financiero de los EEFF de ','L03T09C02 6 7-p','2022-04-04','2022-04-13','Media',2,'2022-10-17 23:08:17',NULL,1,'Sin Informe',1),(19,'Revisión de las pólizas de caución de directores, fiscalizador interno y ejecutivos.','Verificar si cumple normativa ASFI','L02T05C03 3 2','2022-04-04','2022-04-13','Baja',2,'2022-10-17 23:08:17',NULL,1,'Sin Informe',1),(20,'Presentar informes trimestrales sobre el cumplimiento del PAT al Comité de Auditoria.','Reportar sobre los resultados del trabajo de UAI','L03T09C02 6 7-q','2022-04-04','2022-04-13','Baja',2,'2022-10-17 23:08:17',NULL,1,'Sin Informe',1),(21,'Revisar el  cumplimiento del reglamento de encaje legal','Evaluar el cumplimiento del reglamento','L02T02C08 7 2','2022-04-18','2022-04-28','Alta',2,'2022-10-17 23:08:17',NULL,1,'Sin Informe',1),(22,'Refrendar Anexo Cobertura de Depósitos con Activos de Primera Calidad.','Evaluar el cumplimiento de normativa relacionada','L05T02C03S04 2 ','2022-04-18','2022-04-28','Media',2,'2022-10-17 23:08:17',NULL,1,'Sin Informe',1),(23,'Informe sobre Puntos de Reclamo.','Verificar el cumplimiento de la normativa en vigencia','L04T01C01 4 2','2022-04-04','2022-04-28','Baja',2,'2022-10-17 23:08:17',NULL,1,'Sin Informe',1),(25,'Revisión de sueldos y salarios','Revisar el correcto abono de sueldos y salarios','Ley general de trabajo, y normativa interna','2022-11-01','2022-11-30','Media',2,'2022-10-31 00:31:07',NULL,1,'Sin Informe',1);
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proceso`
--

LOCK TABLES `proceso` WRITE;
/*!40000 ALTER TABLE `proceso` DISABLE KEYS */;
INSERT INTO `proceso` VALUES (1,'GESTIÓN DEL RIESGO DE LIQUIDEZ','2022-10-18 03:09:52','2022-11-01 01:22:21',1,1,6,1),(2,'GESTIÓN DEL RIESGO DE OPERATIVO','2022-10-18 03:09:52',NULL,1,2,1,2),(3,'GESTIÓN DEL RIESGO CREDITICIO','2022-10-18 03:09:52','2022-11-01 05:52:05',1,1,5,3),(5,'ACCIONES JUDICIALES','2022-10-18 03:09:52','2022-11-01 05:42:33',1,1,2,3),(7,'ENCAJE LEGAL DE CAJA DE AHORROS','2022-10-31 15:48:08',NULL,1,1,6,11),(8,'ADMINISTRACIÓN DE ACTIVOS FIJOS','2022-10-31 19:30:54','2022-11-01 00:48:24',1,1,7,5),(9,'ENCAJE LEGAL DE DPF','2022-11-01 00:01:19',NULL,1,1,6,17),(10,'ENCAJE LEGAL DE DPF','2022-11-01 00:08:24',NULL,1,1,6,17),(11,'ENCAJE LEGAL DE CAJA DE AHORROS','2022-11-01 00:09:41',NULL,1,1,6,17),(12,'ENCAJE LEGAL DE DPF','2022-11-01 00:11:19',NULL,1,1,6,21);
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
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `programatrabajo`
--

LOCK TABLES `programatrabajo` WRITE;
/*!40000 ALTER TABLE `programatrabajo` DISABLE KEYS */;
INSERT INTO `programatrabajo` VALUES (1,'Actividad 1',0,'Sin Respaldo','2022-10-18 03:21:16',NULL,1,1,1,4),(2,'Actividad 2',0,'Sin Respaldo','2022-10-18 03:21:16',NULL,1,1,1,4),(3,'Actividad 3',0,'Sin Respaldo','2022-10-18 03:21:16',NULL,1,1,1,4),(4,'Actividad 4',0,'Sin Respaldo','2022-10-18 03:21:16',NULL,1,1,1,4),(5,'Actividad 5',1,'5.pdf','2022-10-18 03:21:49','2022-10-18 09:24:09',1,1,2,1),(6,'Actividad 6',3,'6.pdf','2022-10-18 03:21:49','2022-10-18 09:47:22',1,1,2,1),(7,'Actividad 7',2,'7.pdf','2022-10-18 03:21:49','2022-10-18 09:48:24',1,1,2,1),(8,'Actividad 8',1,'8.pdf','2022-10-18 03:21:49','2022-10-19 04:33:09',1,1,2,1),(9,'Actividad 10',2,'9.pdf','2022-10-18 03:23:49','2022-10-19 04:33:27',1,1,3,1),(10,'Actividad 11',3,'Sin Respaldo','2022-10-18 03:23:49','2022-10-25 02:16:30',1,1,3,1),(11,'Actividad 12',0,'Sin Respaldo','2022-10-18 03:23:49','2022-10-25 02:10:51',1,1,3,1),(12,'Actividad 13',0,'Sin Respaldo','2022-10-18 03:23:49','2022-10-25 02:10:46',1,1,3,1),(13,'Actividad 50',1,'Sin Respaldo','2022-10-18 23:32:15','2022-10-19 05:32:43',1,1,9,2),(14,'Actividad 51',3,'Sin Respaldo','2022-10-18 23:32:15','2022-10-19 05:32:49',1,1,9,2),(15,'Actividad 52',2,'15.pdf','2022-10-18 23:32:15','2022-10-19 05:33:24',1,1,9,2),(16,'Actividad 53',1,'Sin Respaldo','2022-10-18 23:32:15','2022-10-19 06:16:08',1,3,9,2),(17,'Actividad 54',1,'Sin Respaldo','2022-10-18 23:32:15','2022-10-25 07:53:21',1,1,9,2),(18,'Actividad 55',2,'Sin Respaldo','2022-10-18 23:32:15','2022-10-25 07:53:34',1,1,9,2),(19,'Actividad 6000',2,'Sin Respaldo','2022-10-19 04:44:30','2022-10-19 10:45:31',1,3,19,5),(20,'Actividad 60001',3,'Sin Respaldo','2022-10-19 04:44:30','2022-10-19 10:45:57',1,3,19,5),(21,'Actividad 60002',3,'Sin Respaldo','2022-10-19 04:44:30','2022-10-19 11:44:54',1,1,19,5),(22,'Actividad 60000',1,'22.pdf','2022-10-19 14:31:45','2022-10-20 05:01:35',1,1,13,5),(23,'Actividad 60001',3,'Sin Respaldo','2022-10-19 14:31:45','2022-10-20 05:01:46',1,1,13,5),(24,'Actividad 60002',1,'Sin Respaldo','2022-10-19 14:31:45','2022-10-20 05:02:22',1,1,13,5),(25,'Actividad 50',0,'Sin Respaldo','2022-11-02 14:47:52',NULL,1,1,4,1);
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
  `estadoRequerimiento` tinyint NOT NULL DEFAULT '1',
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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `requerimientoinformacion`
--

LOCK TABLES `requerimientoinformacion` WRITE;
/*!40000 ALTER TABLE `requerimientoinformacion` DISABLE KEYS */;
INSERT INTO `requerimientoinformacion` VALUES (1,'Requerimiento 1',1,'2022-10-19 22:45:55',NULL,1,1,1,5),(2,'Requerimiento 2',1,'2022-10-19 22:45:55',NULL,1,1,1,5),(3,'Requerimiento 3',1,'2022-10-19 22:45:55',NULL,1,1,1,5),(4,'Requerimiento 4',1,'2022-10-19 22:45:55',NULL,1,1,1,5),(5,'Requerimiento 5',1,'2022-10-19 22:45:55',NULL,1,1,1,5),(6,'Requerimiento 6',1,'2022-10-19 22:45:55',NULL,1,1,2,5),(7,'Requerimiento 7',1,'2022-10-19 22:45:55',NULL,1,1,2,5),(8,'Requerimiento 8',1,'2022-10-19 22:46:32',NULL,1,1,1,5),(9,'Reque 100',1,'2022-10-19 23:04:23',NULL,1,1,1,5),(10,'Requ 6222',1,'2022-10-19 23:04:23',NULL,1,1,1,5),(11,'Requerimiento 10000',1,'2022-10-22 01:53:32',NULL,1,1,2,5),(12,'Requerimiento 10001',1,'2022-10-22 01:53:32',NULL,1,1,2,5),(13,'Requerimiento 30',1,'2022-10-22 01:53:32',NULL,1,1,1,5),(14,'kkljnpoj1 ',2,'2022-10-25 01:55:22',NULL,1,1,3,1),(15,'hgvhjgvc 2',2,'2022-10-25 01:55:22',NULL,1,1,3,1),(16,'Requerimiento Prueba de Calidad y Flujo',1,'2022-10-27 15:54:46',NULL,1,1,1,2),(17,'CALCE DE PLAZOS',2,'2022-11-01 15:12:55',NULL,1,1,6,1),(18,'Actas de comités de riesgos',1,'2022-11-01 15:17:29',NULL,1,1,5,5);
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
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subproceso`
--

LOCK TABLES `subproceso` WRITE;
/*!40000 ALTER TABLE `subproceso` DISABLE KEYS */;
INSERT INTO `subproceso` VALUES (1,'IDENTIFICACIÓN DEL RIESGO DE LIQUIDEZ','No Crírico','2022-10-18 03:12:11',NULL,1,2,1),(2,'MEDICIÓN DEL RIESGO DE LIQUIDEZ','Crítico','2022-10-18 03:12:11',NULL,1,2,1),(3,'MONITOREO DEL RIESGO DE LIQUIDEZ','No Crírico','2022-10-18 03:12:11',NULL,1,2,1),(4,'CONTROL DEL RIESGO DE LIQUIDEZ','No Crírico','2022-10-18 03:12:11',NULL,1,2,1),(5,'MITIGACIÓN DEL RIESGO DE LIQUIDEZ','No Crírico','2022-10-18 03:12:12',NULL,1,2,1),(6,'DIVULGACIÓN DEL RIESGO DE LIQUIDEZ','Crítico','2022-10-18 03:12:12','2022-11-01 05:57:18',1,1,1),(7,'IDENTIFICACIÓN DEL RIESGO OPERATIVO','Crítico','2022-10-18 03:12:12',NULL,1,2,2),(8,'MEDICIÓN DEL RIESGO OPERATIVO','No Crírico','2022-10-18 03:12:12',NULL,1,2,2),(9,'MONITOREO DEL RIESGO OPERATIVO','No Crírico','2022-10-18 03:12:12',NULL,1,2,2),(10,'CONTROL DEL RIESGO OPERATIVO','No Crírico','2022-10-18 03:12:12',NULL,1,2,2),(11,'MITIGACIÓN DEL RIESGO OPERATIVO','No Crírico','2022-10-18 03:12:12',NULL,1,2,2),(12,'DIVULGACIÓN DEL RIESGO OPERATIVO','No Crírico','2022-10-18 03:12:12',NULL,1,2,2),(13,'MEDICIÓN DEL RIESGO CREDITICIO','No Crírico','2022-10-18 03:12:12',NULL,1,2,3),(14,'MONITOREO DEL RIESGO CREDITICIO','No Crírico','2022-10-18 03:12:12',NULL,1,2,3),(15,'CONTROL DEL RIESGO CREDITICIO','No Crírico','2022-10-18 03:12:12','2022-11-01 05:52:56',1,1,3),(16,'MITIGACIÓN DEL RIESGO CREDITICIO','No Crírico','2022-10-18 03:12:12','2022-11-01 05:52:59',1,1,3),(17,'DIVULGACIÓN DEL RIESGO CREDITICIO','No Crírico','2022-10-18 03:12:12','2022-11-01 05:53:00',1,1,3),(18,'APROBACIÓN ACCIONES JUDICIALES','Crítico','2022-10-18 03:12:12',NULL,1,2,5),(19,'INICIO DE ACCIONES JUDICIALES','No Crírico','2022-10-18 03:12:12',NULL,1,2,5),(20,'CANCELACIÓN','Crítico','2022-10-18 03:12:12','2022-11-01 05:55:42',1,1,5),(21,'Toma física de activos fijos','No Crítico','2022-10-31 21:10:26','2022-11-01 02:39:40',1,1,8),(22,'Tom física de activos fijos','No Crítico','2022-10-31 21:21:29',NULL,1,1,8),(23,'Reporte de envío de cuadre diario de encaje legal al Banco Central de Bolivia','Crítico','2022-11-01 00:12:05','2022-11-01 05:12:34',1,1,12);
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unidadnegocio`
--

LOCK TABLES `unidadnegocio` WRITE;
/*!40000 ALTER TABLE `unidadnegocio` DISABLE KEYS */;
INSERT INTO `unidadnegocio` VALUES (1,'UNIDAD DE GESTIÓN DE RIESGOS.','2022-10-18 03:04:21','2022-10-30 23:06:46',1,1),(2,'UNIDAD DE ASESORÍA LEGAL','2022-10-18 03:04:22',NULL,1,1),(3,'UNIDAD DE SISTEMAS','2022-10-18 03:04:22','2022-10-30 21:55:06',1,1),(4,'UNIDAD DE AUDITORÍA INTERNA','2022-10-18 03:04:22','2022-10-30 20:10:08',1,1),(5,'UNIDAD DE SERVICIOS FINANCIEROS','2022-10-30 16:02:08','2022-10-30 21:55:07',1,1),(6,'UNIDAD DE FINAZAS','2022-10-30 17:08:59',NULL,1,1),(7,'UNIDAD DE ADMINISTRACIÓN','2022-10-31 19:30:16',NULL,1,1);
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

-- Dump completed on 2022-11-03 11:28:42
