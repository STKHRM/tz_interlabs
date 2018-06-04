-- MySQL dump 10.13  Distrib 5.6.38, for Win64 (x86_64)
--
-- Host: localhost    Database: tz
-- ------------------------------------------------------
-- Server version	5.6.38

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `app_users`
--

DROP TABLE IF EXISTS `app_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_users`
--

LOCK TABLES `app_users` WRITE;
/*!40000 ALTER TABLE `app_users` DISABLE KEYS */;
INSERT INTO `app_users` VALUES (1,'admin','827ccb0eea8a706c4c34a16891f84e7b','admin@admin.admin');
/*!40000 ALTER TABLE `app_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `data_users`
--

DROP TABLE IF EXISTS `data_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `data_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sort` int(11) DEFAULT '100',
  `full_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_users`
--

LOCK TABLES `data_users` WRITE;
/*!40000 ALTER TABLE `data_users` DISABLE KEYS */;
INSERT INTO `data_users` VALUES (1,11,'Недельский Антип Евграфович','Tojajind@mail.ru','город Владикавказ, улица Пьянкова, дом 10'),(2,12,'Яблоновский Матвей Якубович','Yogor@mail.ru','город Владимир, улица Зууфин, дом 100'),(3,13,'Дуркина Ульяна Елисеевна','Maunris@mail.ru','город Волгоград, улица Старкова, дом 85'),(4,14,'Чекин Фадей Тарасович','Starbringer@mail.ru','город Волгодонск, улица Пугачёва, дом 90'),(5,15,'Якунова Светлана Романовна','Mibei@mail.ru','город Волжск, улица Коваленко, дом 50'),(6,16,'Ядренникова Евгения Петровна','Thosida@mail.ru','город Волжский, улица Квартина, дом 13'),(7,17,'Яговенко Илья Дмитриевич','Nilbine@mail.ru','город Вологда, улица Распутина, дом 62'),(8,18,'Снетков Вениамин Евгениевич','Maulkree@mail.ru','город Вольск, улица Деменока, дом 88'),(9,19,'Гнусарева Инна Игнатиевна','Shajas@mail.ru','город Воркута, улица Рыбьякова, дом 67'),(10,20,'Дорофеева Светлана Игоревна','Centrigas@mail.ru','город Воронеж, улица Макарова, дом 32'),(11,21,'Яблочкина Лада Павеловна','Madi@mail.ru','город Воскресенск, улица Ошуркова, дом 29'),(12,22,'Куксюк Моисей Назарович','Kajim@mail.ru','город Воткинск, улица Малафеева, дом 58'),(13,23,'Смелоча Ника Евгениевна','Voodoolrajas@mail.ru','город Всеволожск, улица Хабибуллина, дом 74'),(14,24,'Сайтахметова Маргарита Никитевна','Granirn@mail.ru','город Выборг, улица Сай, дом 98'),(15,25,'Яночкин Всеслав Владиславович','Pe@mail.ru','город Выкса, улица Слобожанина, дом 56'),(16,26,'Шевелёка Эвелина Мефодиевна','Kirilanim@mail.ru','город Вязьма, улица Зефирова, дом 75'),(17,27,'Картавый Ефросиния Ипполитовна','Gardazragore@mail.ru','город Гатчина, улица Мазурина, дом 70'),(18,28,'Катаева Лиана Геннадиевна','Redmaster@mail.ru','город Геленджик, улица Хесмана, дом 41'),(19,29,'Кузьмич Филимон Куприянович','Mnegamand@mail.ru','город Георгиевск, улица Ящина, дом 92'),(20,30,'Сластникова Инга Глебовна','Drelarim@mail.ru','город Глазов, улица Листунова, дом 09'),(21,31,'Осенныха Нина Николаевна','Kulari@mail.ru','город Горно-Алтайск, улица Квакина, дом 20'),(22,32,'Енотов Евстигней Евлампиевич','Dikinos@mail.ru','город Ковров, улица Толмачёва, дом 96'),(23,33,'Ясакова Агафья Феликсовна','Gavinradi@mail.ru','город Губкин, улица Мичурина, дом 39'),(24,34,'Диденкова Агния Елизаровна','Arinrad@mail.ru','город Краснокамск, улица Крючкова, дом 53'),(25,35,'Набиуллин Якуб Елисеевич','Dawyn@mail.ru','город Гуково, улица Хоботилова, дом 72'),(26,36,'Бочарова Татьяна Павеловна','Kazrarn@mail.ru','город Гусь-Хрустальный, улица Чилаева, дом 92'),(27,37,'Есенина Агафья Данииловна','Vojinn@mail.ru','город Дербент, улица Фролова, дом 72'),(28,38,'Александрова Ирина Семеновна','Lalmeena@mail.ru','город Дзержинск, улица Путятина, дом 17'),(29,39,'Каржаубаев Валентин Артемиевич','Bloodsinger@mail.ru','город Димитровград, улица Коленко, дом 72'),(30,40,'Должикова Юлия Тихоновна','Keron@mail.ru','город Дмитров, улица Каде, дом 63'),(31,41,'Мартюшов Мстислав Александрович','Jozel@mail.ru','город Долгопрудный, улица Гачева, дом 75'),(32,42,'Агейкина Эльвира Тимуровна','Galmaran@mail.ru','город Домодедово, улица Шепелева, дом 70'),(33,43,'Кондраков Порфирий Богданович','Kezil@mail.ru','город Донской, улица Авдиенко, дом 41'),(34,44,'Шипеев Михаил Тарасович','Siraswyn@mail.ru','город Дубна, улица Клименко, дом 92'),(35,45,'Рыбакова Тамара Емельяновна','Cozel@mail.ru','город Евпатория, улица Мукосеева, дом 09'),(36,46,'Иканов Антип Яковович','Bragrinn@mail.ru','город Егорьевск, улица Низамутдинов, дом 20'),(37,47,'Цыганов Роман Онисимович','Thofym@mail.ru','город Ейск, улица Ланцова, дом 96'),(38,48,'Ткач Бронислав Аполлинариевич','Tejind@mail.ru','город Екатеринбург, улица Мышелова, дом 39'),(39,49,'Казанцева Анфиса Емельяновна','Sharan@mail.ru','город Елабуга, улица Агейкина, дом 53'),(40,50,'Караева Марина Потаповна','Shaktikazahn@mail.ru','город Елец, улица Капралова, дом 72'),(41,51,'Брынскиха Эмилия Никитевна','Felolmeena@mail.ru','город Ессентуки, улица Тяпичева, дом 92'),(42,52,'Кувыкин Родион Викентиевич','Conjunaya@mail.ru','город Железногорск (Красноярский край), улица Крайнева, дом 72'),(43,53,'Палюлин Якуб Данилевич','Malolanim@mail.ru','город Железногорск (Курская область), улица Пашина, дом 17'),(44,54,'Астрединов Данила Артемович','Molar@mail.ru','город Жигулевск, улица Шапошникова, дом 72'),(45,55,'Другаль Назар Аникитевич','Anamath@mail.ru','город Жуковский, улица Менде, дом 63'),(46,56,'Кобелева Алиса Ефимовна','Axecliff@mail.ru','город Заречный, улица Репина, дом 123'),(47,57,'Терёшина Елизавета Всеволодовна','Miraginn@mail.ru','город Зеленогорск, улица Белозерова, дом 1 '),(48,58,'Кошкова Дарья Федотовна','Nuarne@mail.ru','город Зеленодольск, улица Блатова, дом 54'),(49,59,'Шевелёка Инга Анатолиевна','Akikree@mail.ru','город Златоуст, улица Шамило, дом 19'),(50,60,'Казаков Парфен Измаилови','Ianlmeen@mail.ru','город Иваново, улица Минкина, дом 37');
/*!40000 ALTER TABLE `data_users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-06-04 10:21:40
