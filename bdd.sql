CREATE DATABASE  IF NOT EXISTS `bdauditoriainterna` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_bin */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `bdauditoriainterna`;
-- MySQL dump 10.13  Distrib 8.0.28, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: bdauditoriainterna
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
INSERT INTO `cargo` VALUES (1,'SUBGERENTE NACIONAL DE AUDITORÍA INTERNA','2022-09-27 00:21:04',NULL,1,1,4),(2,'AUDITOR INTERNO II','2022-09-27 00:21:04',NULL,1,1,4),(3,'SUBGERENTE NACIONAL DE ASESORÍA LEGAL','2022-09-27 00:21:04',NULL,1,1,2),(4,'SUBGERENTE NACIONAL DE GESTIÓN DE RIESGOS','2022-09-27 00:21:04',NULL,1,1,1);
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empleado`
--

LOCK TABLES `empleado` WRITE;
/*!40000 ALTER TABLE `empleado` DISABLE KEYS */;
INSERT INTO `empleado` VALUES (1,'PEDRO','CANEDO','VILLA','123456','CB','1234585','1245','pcanedo@gmail.com','pcanedo','bd369eba942cd7419e9c2693010cb6cc','jefe','2022-09-27 04:06:43','2022-09-28 01:26:34',1,1,1),(2,'ROMEL','GOMEZ','CHAVARRIA','253456','CH','2544585','2245','rgomez@gmail.com','rgomez','cf19c77fddf7683b2b9873618f0c966a','ejecutor','2022-09-27 04:06:43','2022-09-28 00:38:44',1,1,2);
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hallazgo`
--

LOCK TABLES `hallazgo` WRITE;
/*!40000 ALTER TABLE `hallazgo` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `memorandumplanificacion`
--

LOCK TABLES `memorandumplanificacion` WRITE;
/*!40000 ALTER TABLE `memorandumplanificacion` DISABLE KEYS */;
INSERT INTO `memorandumplanificacion` VALUES (1,'UAI-P001/2022',1,2,1,'2022-09-27 19:33:21',NULL,1,1),(2,'UAI-002/2022',1,1,1,'2022-09-27 20:10:48',NULL,1,1),(3,'UAI-003/2022',1,3,1,'2022-09-27 20:33:19',NULL,1,1);
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
  `estadoEjecucion` tinyint NOT NULL,
  `fechaRegistro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fechaActualizacion` datetime DEFAULT NULL,
  `estado` tinyint NOT NULL DEFAULT '1',
  `docInforme` varchar(12) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'Sin Informe',
  `idUsuario` smallint NOT NULL,
  PRIMARY KEY (`idPlanAnualTrabajo`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `plananualtrabajo`
--

LOCK TABLES `plananualtrabajo` WRITE;
/*!40000 ALTER TABLE `plananualtrabajo` DISABLE KEYS */;
INSERT INTO `plananualtrabajo` VALUES (1,'Revisión de la Gestión del Riesgo de Liquidez','Cumplimiento de la normativa ASFI','L03T09C02 6 7-p','2022-01-03','2022-01-13','Alta',1,'2022-09-26 20:34:12',NULL,1,'Sin Informe',1),(2,'Revisión de la Gestión del Riesgo Operativo','Cumplimiento de la normativa ASFI','L03T06C01S04 4','2022-01-03','2022-01-13','Alta',1,'2022-09-26 20:34:12',NULL,1,'Sin Informe',1),(3,'Revisión de la Gestión del Reisgo Crediticio','Cumplimiento de la normativa ASFI','L03T07C02S12 1','2022-01-03','2022-01-13','Baja',1,'2022-09-26 20:34:12',NULL,1,'Sin Informe',1),(4,'Informar sobre las pruebas realizadas a los planes de contingencia tecnológicas y de continuidad del negocio.','Cumplimiento de la normativa ASFI','L03T07C02S12 1','2022-01-10','2022-01-27','Baja',1,'2022-09-26 20:34:12',NULL,1,'Sin Informe',1),(5,'Revisión de la administración de Activos Fijos','Cumplimiento de la normativa ASFI','L02T02C08 7 2','2022-01-24','2022-01-27','Media',1,'2022-09-26 20:34:12',NULL,1,'Sin Informe',1),(6,'Revisión de la Gestión de Seguridad de Información','Cumplimiento de la normativa ASFI','L05T02C03S04 2 ','2022-01-24','2022-01-27','Baja',1,'2022-09-26 20:34:12',NULL,1,'Sin Informe',1),(7,'Cumplimiento de tarifas máximas para órdenes electrónicas de transferencia de fondos','Evaluar el cumplimiento de RD 49/2018 del BCB ','Resolución de directorio del BCB N° 49/2018','2022-02-02','2022-02-15','Media',1,'2022-09-26 20:34:12',NULL,1,'Sin Informe',1),(8,'Revisar el cumplimiento de las diferentes instancias de  a sus normas, reglamentos, códigos y políticas relacionadas con gobierno corporativo.','Vigilar el cumplimiento de la normativa','L03T01C02S06 3','2022-02-07','2022-02-24','Media',1,'2022-09-26 20:34:12',NULL,1,'Sin Informe',1),(9,'Seguimiento a Contribuciones o aportes a fines sociales, culturales y gremiales.','Verificar si se cumple normativa de la ASFI','L02T07C02 3 2','2022-02-07','2022-02-24','Baja',1,'2022-09-26 20:34:12',NULL,1,'Sin Informe',1),(10,'LGI y/o FT, asi como medidas contra el FPADM (UIF).','Revisar los reportes e informes emitidos','ii. LD/LGI (Artículo 9° del Decreto Supremo N° 910 de 15 de junio de 2011)','2022-02-03','2022-02-24','Alta',1,'2022-09-26 20:34:12',NULL,1,'Sin Informe',1),(11,'Revisar el  cumplimiento del reglamento de encaje legal','Evaluar el cumplimiento del reglamento','L02T02C08 7 2','2022-02-15','2022-02-24','Media',1,'2022-09-26 20:34:12',NULL,1,'Sin Informe',1),(12,'Cumplimiento de obligaciones contractuales contrato FIPOREGA','Revisar los reportes y documentación de carpetas','Contrato con fiporega y su reglamento','2022-03-04','2022-03-15','Baja',1,'2022-09-26 20:34:12',NULL,1,'Sin Informe',1),(13,'Evaluar el cumplimiento del Plan Estratégico.','Verificar el cumplimiento del Plan Estratégico para la gestión 2021','L03T09C02 6 7','2022-02-21','2022-03-29','Alta',1,'2022-09-26 20:34:12',NULL,1,'Sin Informe',1),(14,'Refrendar el informe con carácter de declaración jurada de la Gerencia General, detallando los servicios de procesamiento de datos o ejecución de sistemas a cargo de terceros.','Verificar el cumplimiento de inciso f, Artículo 3º , sección 11, Cap. II, Tít. VII del Libro 3º.','L03T07C02 12 1-d','2022-03-07','2022-03-17','Media',1,'2022-09-26 20:34:12',NULL,1,'Sin Informe',1),(15,'Seguimiento al cumplimiento de disposiciones de Asamblea de Asociados, del Directorio y del Comité de Auditoría.','Verificar el cumplimiento de disposiciones para la gestión 2021','L03T09C02 6 7','2022-03-09','2022-03-29','Baja',1,'2022-09-26 20:34:12',NULL,1,'Sin Informe',1),(16,'Verificación del cumplimiento de las políticas y procedimientos relativos a la protección de datos en la nube.','Verificar el cumplimiento del Artículo 11º , sección 11, Cap. II, Tít. VII del Libro 3º.','L03T07C02 12 1-e','2022-03-09','2022-03-29','Media',1,'2022-09-26 20:34:12',NULL,1,'Sin Informe',1),(17,'Revisar el  cumplimiento del reglamento de encaje legal','Evaluar el cumplimiento del reglamento','L02T02C08 7 2','2022-03-03','2022-03-29','Baja',1,'2022-09-26 20:34:12',NULL,1,'Sin Informe',1),(18,'Análisis financiero trimestral de los estados financieros. ','Efectuar un análisis financiero de los EEFF de ','L03T09C02 6 7-p','2022-04-04','2022-04-13','Media',1,'2022-09-26 20:34:12',NULL,1,'Sin Informe',1),(19,'Revisión de las pólizas de caución de directores, fiscalizador interno y ejecutivos.','Verificar si cumple normativa ASFI','L02T05C03 3 2','2022-04-04','2022-04-13','Baja',1,'2022-09-26 20:34:12',NULL,1,'Sin Informe',1),(20,'Presentar informes trimestrales sobre el cumplimiento del PAT al Comité de Auditoria.','Reportar sobre los resultados del trabajo de UAI','L03T09C02 6 7-q','2022-04-04','2022-04-13','Baja',1,'2022-09-26 20:34:12',NULL,1,'Sin Informe',1),(21,'Revisar el  cumplimiento del reglamento de encaje legal','Evaluar el cumplimiento del reglamento','L02T02C08 7 2','2022-04-18','2022-04-28','Alta',1,'2022-09-26 20:34:12',NULL,1,'Sin Informe',1),(22,'Refrendar Anexo Cobertura de Depósitos con Activos de Primera Calidad.','Evaluar el cumplimiento de normativa relacionada','L05T02C03S04 2 ','2022-04-18','2022-04-28','Media',1,'2022-09-26 20:34:12',NULL,1,'Sin Informe',1),(23,'Informe sobre Puntos de Reclamo.','Verificar el cumplimiento de la normativa en vigencia','L04T01C01 4 2','2022-04-04','2022-04-28','Baja',1,'2022-09-26 20:34:12',NULL,1,'Sin Informe',1);
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proceso`
--

LOCK TABLES `proceso` WRITE;
/*!40000 ALTER TABLE `proceso` DISABLE KEYS */;
INSERT INTO `proceso` VALUES (1,'GESTIÓN DEL RIESGO DE LIQUIDEZ','2022-09-27 03:42:54',NULL,1,2,1,1),(2,'GESTIÓN DEL RIESGO DE OPERATIVO','2022-09-27 03:42:54',NULL,1,2,1,2),(3,'GESTIÓN DEL RIESGO CREDITICIO','2022-09-27 03:42:54',NULL,1,2,1,3),(4,'COLOCACIÓN','2022-09-27 03:42:54',NULL,1,2,5,3),(5,'ACCIONES JUDICIALES','2022-09-27 03:42:54',NULL,1,2,2,3),(6,'CASTIGOS DE CRÉDITOS','2022-09-27 03:42:54',NULL,1,2,5,3);
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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `programatrabajo`
--

LOCK TABLES `programatrabajo` WRITE;
/*!40000 ALTER TABLE `programatrabajo` DISABLE KEYS */;
INSERT INTO `programatrabajo` VALUES (1,'Actividad 1',0,'Sin Respaldo','2022-09-27 20:04:09',NULL,1,1,7,1),(2,'Actividad 2',0,'Sin Respaldo','2022-09-27 20:04:09',NULL,1,1,7,1),(3,'Revisar una muestra de reportes semanales de los flujos de caja proyectados enviados a la ASFI.',0,'Sin Respaldo','2022-09-27 20:16:08',NULL,1,1,6,2),(4,'Revisar una muestra de reportes semanales de los límites Internos de Liquidez',0,'Sin Respaldo','2022-09-27 20:16:08',NULL,1,1,6,2),(5,'Revisar los indicadores presentados al directorio de forma mensual por la unidad de gestión de riesgos',0,'Sin Respaldo','2022-09-27 20:16:08',NULL,1,1,6,2),(6,'Actividad 1',0,'Sin Respaldo','2022-09-27 20:18:55',NULL,1,1,3,2),(7,'Actividad 1',0,'Sin Respaldo','2022-09-27 20:20:12',NULL,1,1,7,1),(8,'Actividad 2',0,'Sin Respaldo','2022-09-27 20:20:12',NULL,1,1,7,1),(9,'Actividad 3',0,'Sin Respaldo','2022-09-27 20:20:12',NULL,1,1,7,1),(10,'Actividad 4',0,'Sin Respaldo','2022-09-27 20:20:12',NULL,1,1,7,1),(11,'Actividad 5',0,'Sin Respaldo','2022-09-27 20:20:12',NULL,1,1,7,1);
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
  `idProgramaTrabajo` int NOT NULL,
  `idUnidadNegocio` tinyint NOT NULL,
  PRIMARY KEY (`idRequerimientoInformacion`),
  KEY `fk_RequerimientoInformacion_Programa_Trabajo1_idx` (`idProgramaTrabajo`),
  KEY `fk_requerimiento_informacion_unidadnegocio1_idx` (`idUnidadNegocio`),
  CONSTRAINT `fk_requerimiento_informacion_unidadnegocio1` FOREIGN KEY (`idUnidadNegocio`) REFERENCES `unidadnegocio` (`idUnidadNegocio`),
  CONSTRAINT `fk_RequerimientoInformacion_Programa_Trabajo1` FOREIGN KEY (`idProgramaTrabajo`) REFERENCES `programatrabajo` (`idProgramaTrabajo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `requerimientoinformacion`
--

LOCK TABLES `requerimientoinformacion` WRITE;
/*!40000 ALTER TABLE `requerimientoinformacion` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subproceso`
--

LOCK TABLES `subproceso` WRITE;
/*!40000 ALTER TABLE `subproceso` DISABLE KEYS */;
INSERT INTO `subproceso` VALUES (1,'IDENTIFICACIÓN DEL RIESGO DE LIQUIDEZ','No Crírico','2022-09-27 03:57:40',NULL,1,2,1),(2,'MEDICIÓN DEL RIESGO DE LIQUIDEZ','Crítico','2022-09-27 03:57:40',NULL,1,2,1),(3,'MONITOREO DEL RIESGO DE LIQUIDEZ','No Crírico','2022-09-27 03:57:40',NULL,1,2,1),(4,'CONTROL DEL RIESGO DE LIQUIDEZ','No Crírico','2022-09-27 03:57:40',NULL,1,2,1),(5,'MITIGACIÓN DEL RIESGO DE LIQUIDEZ','No Crírico','2022-09-27 03:57:40',NULL,1,2,1),(6,'DIVULGACIÓN DEL RIESGO DE LIQUIDEZ','Crítico','2022-09-27 03:57:40',NULL,1,2,1),(7,'IDENTIFICACIÓN DEL RIESGO OPERATIVO','Crítico','2022-09-27 03:57:40',NULL,1,2,2),(8,'MEDICIÓN DEL RIESGO OPERATIVO','No Crírico','2022-09-27 03:57:40',NULL,1,2,2),(9,'MONITOREO DEL RIESGO OPERATIVO','No Crírico','2022-09-27 03:57:40',NULL,1,2,2),(10,'CONTROL DEL RIESGO OPERATIVO','No Crírico','2022-09-27 03:57:40',NULL,1,2,2),(11,'MITIGACIÓN DEL RIESGO OPERATIVO','No Crírico','2022-09-27 03:57:40',NULL,1,2,2),(12,'DIVULGACIÓN DEL RIESGO OPERATIVO','No Crírico','2022-09-27 03:57:40',NULL,1,2,2),(13,'MEDICIÓN DEL RIESGO CREDITICIO','No Crírico','2022-09-27 03:57:40',NULL,1,2,3),(14,'MONITOREO DEL RIESGO CREDITICIO','No Crírico','2022-09-27 03:57:40',NULL,1,2,3),(15,'CONTROL DEL RIESGO CREDITICIO','No Crírico','2022-09-27 03:57:40',NULL,1,2,3),(16,'MITIGACIÓN DEL RIESGO CREDITICIO','No Crírico','2022-09-27 03:57:40',NULL,1,2,3),(17,'DIVULGACIÓN DEL RIESGO CREDITICIO','No Crírico','2022-09-27 03:57:40',NULL,1,2,3),(18,'SELECCIÓN','Crítico','2022-09-27 03:57:40',NULL,1,2,4),(19,'EVALUACIÓN Y ANÁLISIS','No Crírico','2022-09-27 03:57:40',NULL,1,2,4),(20,'APROBACIÓN','Crítico','2022-09-27 03:57:40',NULL,1,2,4),(21,'CONTRATO','No Crírico','2022-09-27 03:57:40',NULL,1,2,4),(22,'DESEMBOLSO','No Crírico','2022-09-27 03:57:40',NULL,1,2,4),(23,'SEGUIMIENTO','No Crírico','2022-09-27 03:57:40',NULL,1,2,4),(24,'RECUPERACIÓN','No Crírico','2022-09-27 03:57:40',NULL,1,2,4),(25,'APROBACIÓN ACCIONES JUDICIALES','Crítico','2022-09-27 03:57:40',NULL,1,2,5),(26,'INICIO DE ACCIONES JUDICIALES','No Crírico','2022-09-27 03:57:40',NULL,1,2,5),(27,'CANCELACIÓN','No Crírico','2022-09-27 03:57:40',NULL,1,2,5),(28,'APROBACIÓN CASTIGO','Crítico','2022-09-27 03:57:40',NULL,1,2,6),(29,'ARCHIVO CASTIGO','No Crírico','2022-09-27 03:57:40',NULL,1,2,6);
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unidadnegocio`
--

LOCK TABLES `unidadnegocio` WRITE;
/*!40000 ALTER TABLE `unidadnegocio` DISABLE KEYS */;
INSERT INTO `unidadnegocio` VALUES (1,'UNIDAD DE GESTIÓN DE RIESGOS','2022-09-27 00:19:25',NULL,1,1),(2,'UNIDAD DE ASESORÍA LEGAL','2022-09-27 00:19:25',NULL,1,1),(3,'UNIDAD DE SISTEMAS','2022-09-27 00:19:25',NULL,1,1),(4,'UNIDAD DE AUDITORÍA INTERNA','2022-09-27 00:19:25',NULL,1,1),(5,'Servicios Financieros','2022-09-27 03:39:12',NULL,1,1);
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

-- Dump completed on 2022-09-27 17:22:02
