-- Adminer 4.8.1 MySQL 8.1.0 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `content`;
CREATE TABLE `content` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `image` varchar(255) DEFAULT NULL,
  `tag` enum('CONTENT','IMAGE') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'IMAGE',
  `link` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `content` (`id`, `title`, `text`, `image`, `tag`, `link`) VALUES
(1,	'Web',	'Naše firma je špičkovým partnerem pro vytváření webových stránek, které osloví vaši cílovou skupinu. S naším týmem zkušených webdesignerů a vývojářů máte jistotu, že vaše webové stránky budou nejen vizuálně atraktivní, ale také plně funkční a optimalizované pro vyhledávače. Vytvoříme pro vás moderní a responzivní webové stránky, které zaujmou a poutají pozornost vašich návštěvníků. Navíc se postaráme o uživatelskou přívětivost, což znamená, že budou stránky snadno navigovatelné a přístupné na různých zařízeních. Nezáleží na tom, zda potřebujete firemní prezentaci, nebo osobní blog – naše dovednosti a kreativita zajistí, že vaše webové stránky budou plnit vaše cíle a poskytovat vynikající uživatelský zážitek.',	NULL,	'CONTENT',	NULL),
(2,	'Grafika',	'Jsme připraveni přinést vaší webové stránce nejen funkcionalitu, ale také jedinečný vizuální styl. S naším týmem talentovaných grafických designérů jsme ochotni vytvořit pro vaši stránku kreativní a poutavý design, který přesně odpovídá vašim potřebám a cílovému publiku. Navíc jsme schopni vyvinout pro vás originální logo. Důkladně posloucháme vaše představy a společně s vámi pracujeme na vytvoření designu a loga, které vám pomůžou vyniknout a zanechají trvalý dojem. Vaše webová stránka s naším designem a logem bude nejen profesionální, ale také unikátní a zapamatovatelná.',	NULL,	'CONTENT',	NULL),
(3,	'Game dev',	'Nejsme jen odborníkem na vytváření webových stránek a designu, ale také se okrajově věnujeme hernímu developmentu. Máme hrstku amatérských herních vývojářů, kteří jsou připraveni poskytnout pomoc při realizaci vašeho herního projektu. Můžeme vás podpořit od prvních kroků konceptu a designu hry až po programování a testování. Bez ohledu na to, zda jde o mobilní aplikaci, online hru nebo jiný herní projekt, naše znalosti a zkušenosti v oblasti herního vývoje vám pomohou dosáhnout vašich cílů a vytvořit zábavný a inovativní produkt. Podporujeme Unreal Engine a Godot.',	NULL,	'CONTENT',	NULL),
(4,	'Michal Plaček',	'Nadějný mladý profesionál s vášní pro informační technologie a tvorbu webových stránek a aplikací. V roce 2023 úspěšně dokončil Střední odbornou školu podnikání a mediální tvorby v Kolíně, kde získal maturitu v oboru Informační technologie a webové aplikace. Tento úspěch mu otevřel cestu k dalšímu studiu na Fakultě Informačních technologií v Pardubicích. Michal je zaujatý a oddaný svému oboru a aktivně se věnuje tvorbě webových stránek a aplikací. S jeho znalostmi a vášní pro technologie bude bezpochyby přinášet inovativní a kreativní přístup do vašich webových stránek.',	NULL,	'CONTENT',	NULL),
(5,	'Jakub Vávrů',	'Talentovaný mladý profesionál, jehož vášeň patří informačním technologiím a tvorbě webových stránek a aplikací. V roce 2023 úspěšně absolvoval Střední odbornou školu podnikání a mediální tvorby v Kolíně, kde dosáhl maturitní zkoušky v oboru Informační technologie a webové aplikace. Téhož roku se rozhodl pokračovat ve svém vzdělávání a začal studovat na Fakultě Informačních technologií v Pardubicích. Jakubova odbornost zahrnuje tvorbu webových stránek a aplikací, a zároveň je zkušeným webdesignérem. Navíc se občas věnuje i tvorbě a designu her.',	NULL,	'CONTENT',	NULL),
(6,	'Michal Plaček',	'<p>E-mail: placek.nafu@gmail.com</p>\n<p><a href=\"https://www.instagram.com/georgino.png/\"><img src=\"/style/images/instagram.svg\" alt=\"instagram\">@georgino.png</a></p>\n<p><a href=\"https://github.com/Georgino7\"><img src=\"/style/images/git.svg\" alt=\"github\">Georgino7</a></p>',	NULL,	'CONTENT',	NULL),
(7,	'Jakub Vávrů',	'<p>E-mail: vavru.nafu@gmail.com</p>\n<p><a href=\"https://www.instagram.com/vavrujakub/\"><img src=\"/style/images/instagram.svg\" alt=\"instagram\">@vavrujakub</a></p>\n<p><a href=\"https://github.com/Campercat3\"><img src=\"/style/images/git.svg\" alt=\"github\">Campercat3</a></p>',	NULL,	'CONTENT',	NULL),
(8,	'Platební údaje',	'<p>IČ: 19718756</p>\n<p>DIČ: CZ0311110833</p>\n\n',	NULL,	'CONTENT',	NULL),
(9,	'test3',	NULL,	'upload/no-image.jpeg',	'IMAGE',	'https://www.apple.com/'),
(10,	'test2',	NULL,	'images/banner-redimensionat.jpeg',	'IMAGE',	'https://www.apple.com/'),
(11,	'test1',	NULL,	'images/stazeny-soubor.jpeg',	'IMAGE',	'https://www.youtube.com/');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1,	'Michal',	'$2y$10$YsvHkUBxxe6JA2s7mGQMYu23rpKEIcivYshujO7kOynWiqYcfmf.C',	'admin'),
(2,	'Campercat3',	'$2y$10$UdGYUUvJB/Uc.6P0klVCE.ExJH8/K9FjDlykSS/lM.THa1ffpCS42',	'admin');

-- 2023-10-16 10:58:06