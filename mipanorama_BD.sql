/*
Navicat MySQL Data Transfer

Source Server         : 127.0.0.1_3306
Source Server Version : 50505
Source Host           : 127.0.0.1:3306
Source Database       : mipanorama

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2018-04-07 19:38:57
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for categorias
-- ----------------------------
DROP TABLE IF EXISTS `categorias`;
CREATE TABLE `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of categorias
-- ----------------------------
INSERT INTO `categorias` VALUES ('1', 'Cines');
INSERT INTO `categorias` VALUES ('2', 'Conciertos');
INSERT INTO `categorias` VALUES ('3', 'Deportes');
INSERT INTO `categorias` VALUES ('4', 'Entretención');
INSERT INTO `categorias` VALUES ('5', 'Museos');
INSERT INTO `categorias` VALUES ('6', 'Teatros');
INSERT INTO `categorias` VALUES ('7', 'Fantasilandia');

-- ----------------------------
-- Table structure for eventos
-- ----------------------------
DROP TABLE IF EXISTS `eventos`;
CREATE TABLE `eventos` (
  `id` varchar(200) NOT NULL,
  `nombreEvento` varchar(200) DEFAULT NULL,
  `categoria` int(11) DEFAULT NULL,
  `fecha` varchar(50) DEFAULT NULL,
  `hora` varchar(50) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `precio` varchar(20) DEFAULT NULL,
  `linkBtnEvento` varchar(255) DEFAULT NULL,
  `descripcion` text,
  `infoAdicionalTxt` text,
  `infoAdicionalLink` varchar(255) DEFAULT NULL,
  `imgPrincipal` varchar(200) DEFAULT NULL,
  `timestam` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of eventos
-- ----------------------------
INSERT INTO `eventos` VALUES ('1DQU454F3PGTS9T', 'gertwertwert', '2', '2018-03-27', '15:00', 'los lagos', '9800', 'https://www.youtube.com/', 'asdasdasdasd', '', '', 'RVG43J4BN1.jpg', '2018-03-24 19:18:57');
INSERT INTO `eventos` VALUES ('2JCW4AT8SFP6JJX', 'ghfghdfghd', '2', '2018-03-31', '15:00', 'MOVISTAR ARENA', '-', 'https://www.youtube.com/', 'asdasdasd', 'qweqw: 400\r\nsddfs: 150', '', '9H16L04IBL.png', '2018-03-28 17:35:47');
INSERT INTO `eventos` VALUES ('9XOTI20YZRV3DU5', 'HARRY STYLES EN TOUR 25 DE MAYO DE 2018', '1', '2018-03-26', '17:00', 'VALDIVIAa', '9000', 'https://es.ccm.net/faq/537-php-como-direccionar-a-otra-pagina-web', 'Debido a la abrumadora demanda, Harry Styles ha añadido 56 nuevas fechas de shows para el 2018 a su agotado tour mundial. La primera etapa de Harry Styles Live On Tour comenzará en septiembre de 2017 visitando lugares íntimos de todo el mundo. Las fechas recién añadidas comenzarán en marzo de 2018 en Basilea, Suiza y concluirán en Los Ángeles, California en julio. El álbum debut homónimo de Harry Styles fue lanzado el 12 de mayo y se disparó a la cima de las listas de todo el mundo. En Estados Unidos encabezó la lista de álbumes Billboard 200, con más de 230.000 unidades de discos equivalentes vendidos y 193.000 álbumes tradicionales vendidos, haciendo historia como la mayor semana de ventas de estreno del primer álbum completo de un artista masculino del Reino Unido desde que Nielsen Music empezó a registrar las ventas en 1991. El debut de su álbum en Estados Unidos viene muy cerca del enorme éxito internacional de Harry, donde el disco entró en el número 1 en más de 20 países, incluyendo Estados Unidos, Reino Unido, Irlanda, Canadá, Australia, Holanda, Bélgica y en Asia Sudoriental y Medio Este. Harry Styles se presentará en nuestro país el próximo 25 de mayo de 2018 en Movistar Arena. Los tickets estarán disponibles a partir del lunes 19 de junio (11am). Máximo 4 tickets por transacción. ', '', 'https://www.facebook.com/', 'HM3PATGW8D.jpg', '2018-03-22 22:39:50');
INSERT INTO `eventos` VALUES ('APY32P0NPN7C8BH', 'probando 2', '1', '2018-03-22', '17:00', 'valdivia', '6000', 'https://www.youtube.com/', 'descripcion', 'Asdasda: 5.000\r\nDfgdfgdg: 5.000 – 7.000\r\nGfhfhdfh: 3.500\r\n', '', 'UP826W7I1I.jpg', '2018-03-15 18:01:43');
INSERT INTO `eventos` VALUES ('BYTNR150PIJFHVC', 'hfghjfghj', '4', '2018-04-01', '18:00', 'MOVISTAR ARENA', '7800', 'https://www.youtube.com/', 'dfghwetwertsdfg', 'asda: 500\r\nwtdfg: 400\r\n', null, 'A3ZFPRLB4L.jpg', '2018-03-28 17:37:01');
INSERT INTO `eventos` VALUES ('GFFL2EIPCU1Y6DA', 'test', '2', '2018-03-29', '15:00', 'valdivia', '7000', 'https://www.youtube.com/', 'asdasdasdasd', '', 'VXEJLP9FY.gif', 'PYUBCHMCNA.jpg', '2018-03-26 17:03:23');
INSERT INTO `eventos` VALUES ('PEYS7DJWZADFO3Y', 'TEST 2', '2', '2018-03-30', '18:00', 'MOVISTAR ARENA', '-', 'https://www.puntoticket.com/laura-pausini', 'Con una carrera de más de 25 años, la cantante italiana Laura Pausini regresa a Movistar Arena el sábado 18 de agosto para cantarnos todos los éxitos de su premiada carrera internacional. Ya están a la venta las entradas para este imperdible show en www.puntoticket.com\r\n\r\nEl nuevo proyecto musical de la reconocida artista italiana Laura Pausini, dará inicio los primeros meses del año con el estreno en enero de su nuevo sencillo, seguido por el lanzamiento de su nuevo álbum de estudio cuyo lanzamiento está planeado para el primer trimestre de 2018.\r\n\r\nTras su exitosa gira mundial la cual agotó todos los boletos en 2016, Laura ha anunciado que su regreso a los escenarios se llevará a cabo a partir de julio de 2018, comenzando con dos conciertos en Italia los días 21 y 22 en el Circo Massimo (Circus Maximus) en la ciudad eterna de su querida tierra italiana: Roma.\r\n\r\nHasta el momento solo legendarios artistas como Rolling Stones y Bruce Springsteen se han presentado en el magno lugar, por lo que Laura se convierte en la primera mujer en actuar en el Circus Maximo en dos veladas históricas para la música italiana. Luego de estos conciertos, Laura recorrerá las principales ciudades de Europa, Estados Unidos y Latinoamérica, donde esta noche triunfò como entrenador de La Voz Mexico llevando Luiz Adriàn Cruz Ramoz a la victoria.\r\n\r\nLaura volverá como protagonista a partir de enero, cuando se estrene el nuevo sencillo, la carta de presentación de su nuevo álbum compuesto de temas inéditos.“No puedo esperar más, estoy lista ahora. Y el compromiso que me espera es, una vez más, un desafío emocionante. La música es mi vida y pronto me haré sentir con mi voz, mis pensamientos y mi corazón. Más fuerte que nunca”. Expresó Laura.\r\n\r\nCon millones de discos vendidos, Laura es la cantante italiana más importantes y admiradas en el ámbito musical en el mundo durante los últimos 25 años. Laura estará en Estados Unidos durante el mes de febrero para promocionar su nuevo sencillo y gira mundial.', '', '', '4PQN4DSX5K.jpg', '2018-03-27 22:35:28');

-- ----------------------------
-- Table structure for imagenes
-- ----------------------------
DROP TABLE IF EXISTS `imagenes`;
CREATE TABLE `imagenes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idEvento` varchar(200) DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of imagenes
-- ----------------------------
INSERT INTO `imagenes` VALUES ('32', 'APY32P0NPN7C8BH', 'UP826W7I1I.jpg', '2018-03-19 18:01:43');
INSERT INTO `imagenes` VALUES ('36', '9XOTI20YZRV3DU5', 'HM3PATGW8D.jpg', '2018-03-23 19:04:42');
INSERT INTO `imagenes` VALUES ('37', '9XOTI20YZRV3DU5', '6F99UCY1HP.jpg', '2018-03-23 19:04:42');
INSERT INTO `imagenes` VALUES ('38', '1DQU454F3PGTS9T', 'RVG43J4BN1.jpg', '2018-03-24 19:18:57');
INSERT INTO `imagenes` VALUES ('39', 'GFFL2EIPCU1Y6DA', 'PYUBCHMCNA.jpg', '2018-03-26 17:03:23');
INSERT INTO `imagenes` VALUES ('40', 'GFFL2EIPCU1Y6DA', '9LG9WNLWSM.jpg', '2018-03-26 17:03:23');
INSERT INTO `imagenes` VALUES ('41', 'PEYS7DJWZADFO3Y', '4PQN4DSX5K.jpg', '2018-03-27 22:35:28');
INSERT INTO `imagenes` VALUES ('42', 'PEYS7DJWZADFO3Y', 'BIY9TIY27U.jpg', '2018-03-27 22:35:28');
INSERT INTO `imagenes` VALUES ('43', '2JCW4AT8SFP6JJX', '9H16L04IBL.png', '2018-03-28 17:35:47');
INSERT INTO `imagenes` VALUES ('44', 'BYTNR150PIJFHVC', 'A3ZFPRLB4L.jpg', '2018-03-28 17:37:01');

-- ----------------------------
-- Table structure for intereses
-- ----------------------------
DROP TABLE IF EXISTS `intereses`;
CREATE TABLE `intereses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idUsuario` int(11) DEFAULT NULL,
  `categoria` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of intereses
-- ----------------------------
INSERT INTO `intereses` VALUES ('6', '72', '1');
INSERT INTO `intereses` VALUES ('7', '72', '2');
INSERT INTO `intereses` VALUES ('8', '72', '3');

-- ----------------------------
-- Table structure for usuarios
-- ----------------------------
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `encuesta_inicio` int(11) DEFAULT '0',
  `admin` int(11) DEFAULT '0',
  `fecha_registro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of usuarios
-- ----------------------------
INSERT INTO `usuarios` VALUES ('72', 'Alex', 'asd@asd.com', '123', '1', '1', '2018-02-07 22:20:15');
