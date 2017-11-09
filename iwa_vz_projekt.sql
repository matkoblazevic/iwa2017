-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 26, 2017 at 08:22 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `iwa_vz_projekt`
--

-- --------------------------------------------------------

--
-- Table structure for table `kategorija`
--

CREATE TABLE `kategorija` (
  `kategorija_id` int(10) UNSIGNED NOT NULL,
  `korisnik_id` int(10) UNSIGNED NOT NULL,
  `naziv` varchar(100) DEFAULT NULL,
  `slika` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kategorija`
--

INSERT INTO `kategorija` (`kategorija_id`, `korisnik_id`, `naziv`, `slika`) VALUES
(1, 72, 'Juhe', 'http://food.fnr.sndimg.com/content/dam/images/food/fullset/2009/4/14/2/FNM060109WN014_s4x3.jpg.rend.hgtvcom.616.462.suffix/1382538959763.jpeg'),
(2, 5, 'Kruh i peciva', 'http://www.coolinarika.com/repository/images/_variations/f/f/ff174d80b06571f6f6554fb420ec53ee_header.jpg'),
(3, 30, 'Salate', 'http://www.coolinarika.com/repository/images/_variations/4/2/4224e77b679a2ce848532764a558a20f_header.jpg'),
(4, 63, 'Glavna jela', 'http://www.coolinarika.com/repository/images/_variations/5/6/5622a1cc751fe578fdf9ff666eb66269_header.jpg'),
(5, 71, 'Deserti', 'http://www.coolinarika.com/repository/images/_variations/c/e/cebc61c490f22b2c17f30a28f61d003c_header.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `komentar`
--

CREATE TABLE `komentar` (
  `komentar_id` int(10) UNSIGNED NOT NULL,
  `korisnik_id` int(10) UNSIGNED NOT NULL,
  `recept_id` int(10) UNSIGNED NOT NULL,
  `naslov` varchar(100) DEFAULT NULL,
  `tekst` varchar(200) DEFAULT NULL,
  `datum` datetime DEFAULT NULL,
  `ocjena` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `komentar`
--

INSERT INTO `komentar` (`komentar_id`, `korisnik_id`, `recept_id`, `naslov`, `tekst`, `datum`, `ocjena`) VALUES
(1, 24, 1, 'Odlično', 'Bilo je odlično, jedva čekam da opet to ponovim', '2012-05-29 11:45:04', 5),
(2, 29, 4, 'Moglo je i bolje', 'Dosta šturi opis recepta', '2012-05-29 11:45:04', 3),
(3, 29, 3, 'Svakako probati', 'Najbolji klipići ikad', '2012-05-29 11:45:04', 5),
(4, 34, 3, 'Savjet', 'Tajna je u ručnoj izradi', '2012-05-29 11:45:04', 5),
(5, 35, 9, 'Gdje je pivo', 'Nedostaje pivo u sastojcima', '2012-05-29 11:45:04', 4),
(6, 30, 3, 'Nije uspjelo :(', 'Nije tako jednostavno kako se čini', '2012-05-29 11:45:04', 3),
(31, 1, 10, 'Osvježavajuće', 'Ukusno za ljetne dane', '2013-06-20 16:57:54', 5),
(32, 1, 3, 'Great', 'I am very satisfied with these', '2017-10-26 01:15:07', 5);

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `korisnik_id` int(10) UNSIGNED NOT NULL,
  `tip_id` int(10) UNSIGNED NOT NULL,
  `korisnicko_ime` varchar(50) DEFAULT NULL,
  `lozinka` varchar(32) DEFAULT NULL,
  `ime` varchar(100) DEFAULT NULL,
  `prezime` varchar(100) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `slika` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`korisnik_id`, `tip_id`, `korisnicko_ime`, `lozinka`, `ime`, `prezime`, `email`, `slika`) VALUES
(1, 0, 'admin', 'foi', 'Administrator', '', '', 'korisnici/admin.jpg'),
(2, 2, 'moderator', '123456', 'moderator', '', '', 'korisnici/admin.jpg'),
(5, 1, 'qtarantino', '123456', 'Quentin', 'Tarantino', 'qtarantino@foi.hr', 'korisnici/qtarantino.jpg'),
(6, 2, 'mbellucci', '123456', 'Monica', 'Bellucci', 'mbellucci@foi.hr', 'korisnici/mbellucci.jpg'),
(7, 2, 'vmortensen', '123456', 'Viggo', 'Mortensen', 'vmortensen@foi.hr', 'korisnici/vmortensen.jpg'),
(8, 2, 'jgarner', '123456', 'Jennifer', 'Garner', 'jgarner@foi.hr', 'korisnici/jgarner.jpg'),
(9, 2, 'nportman', '123456', 'Natalie', 'Portman', 'nportman@foi.hr', 'korisnici/nportman.jpg'),
(10, 2, 'dradcliffe', '123456', 'Daniel', 'Radcliffe', 'dradcliffe@foi.hr', 'korisnici/dradcliffe.jpg'),
(11, 2, 'hberry', '123456', 'Halle', 'Berry', 'hberry@foi.hr', 'korisnici/hberry.jpg'),
(12, 2, 'vdiesel', '123456', 'Vin', 'Diesel', 'vdiesel@foi.hr', 'korisnici/vdiesel.jpg'),
(13, 2, 'ecuthbert', '123456', 'Elisha', 'Cuthbert', 'ecuthbert@foi.hr', 'korisnici/ecuthbert.jpg'),
(14, 2, 'janiston', '123456', 'Jennifer', 'Aniston', 'janiston@foi.hr', 'korisnici/janiston.jpg'),
(15, 2, 'ctheron', '123456', 'Charlize', 'Theron', 'ctheron@foi.hr', 'korisnici/ctheron.jpg'),
(16, 2, 'nkidman', '123456', 'Nicole', 'Kidman', 'nkidman@foi.hr', 'korisnici/nkidman.jpg'),
(17, 2, 'ewatson', '123456', 'Emma', 'Watson', 'ewatson@foi.hr', 'korisnici/ewatson.jpg'),
(18, 2, 'kdunst', '123456', 'Kirsten', 'Dunst', 'kdunst@foi.hr', 'korisnici/kdunst.jpg'),
(19, 2, 'sjohansson', '123456', 'Scarlett', 'Johansson', 'sjohansson@foi.hr', 'korisnici/sjohansson.jpg'),
(20, 2, 'philton', '123456', 'Paris', 'Hilton', 'philton@foi.hr', 'korisnici/philton.jpg'),
(21, 2, 'kbeckinsale', '123456', 'Kate', 'Beckinsale', 'kbeckinsale@foi.hr', 'korisnici/kbeckinsale.jpg'),
(22, 2, 'tcruise', '123456', 'Tom', 'Cruise', 'tcruise@foi.hr', 'korisnici/tcruise.jpg'),
(23, 2, 'hduff', '123456', 'Hilary', 'Duff', 'hduff@foi.hr', 'korisnici/hduff.jpg'),
(24, 2, 'ajolie', '123456', 'Angelina', 'Jolie', 'ajolie@foi.hr', 'korisnici/ajolie.jpg'),
(25, 2, 'kknightley', '123456', 'Keira', 'Knightley', 'kknightley@foi.hr', 'korisnici/kknightley.jpg'),
(26, 2, 'obloom', '123456', 'Orlando', 'Bloom', 'obloom@foi.hr', 'korisnici/obloom.jpg'),
(27, 2, 'llohan', '123456', 'Lindsay', 'Lohan', 'llohan@foi.hr', 'korisnici/llohan.jpg'),
(28, 2, 'jdepp', '123456', 'Johnny', 'Depp', 'jdepp@foi.hr', 'korisnici/jdepp.jpg'),
(29, 2, 'kreeves', '123456', 'Keanu', 'Reeves', 'kreeves@foi.hr', 'korisnici/kreeves.jpg'),
(30, 1, 'thanks', '123456', 'Tom', 'Hanks', 'thanks@foi.hr', 'korisnici/thanks.jpg'),
(31, 2, 'elongoria', '123456', 'Eva', 'Longoria', 'elongoria@foi.hr', 'korisnici/elongoria.jpg'),
(32, 2, 'rde', '123456', 'Robert', 'De', 'rde@foi.hr', 'korisnici/rde.jpg'),
(33, 2, 'jheder', '123456', 'Jon', 'Heder', 'jheder@foi.hr', 'korisnici/jheder.jpg'),
(34, 2, 'rmcadams', '123456', 'Rachel', 'McAdams', 'rmcadams@foi.hr', 'korisnici/rmcadams.jpg'),
(35, 2, 'cbale', '123456', 'Christian', 'Bale', 'cbale@foi.hr', 'korisnici/cbale.jpg'),
(36, 2, 'jalba', '123456', 'Jessica', 'Alba', 'jalba@foi.hr', 'korisnici/jalba.jpg'),
(37, 2, 'bpitt', '123456', 'Brad', 'Pitt', 'bpitt@foi.hr', 'korisnici/bpitt.jpg'),
(43, 2, 'apacino', '123456', 'Al', 'Pacino', 'apacino@foi.hr', 'korisnici/apacino.jpg'),
(44, 2, 'wsmith', '123456', 'Will', 'Smith', 'wsmith@foi.hr', 'korisnici/wsmith.jpg'),
(45, 2, 'ncage', '123456', 'Nicolas', 'Cage', 'ncage@foi.hr', 'korisnici/ncage.jpg'),
(46, 2, 'vanne', '123456', 'Vanessa', 'Anne', 'vanne@foi.hr', 'korisnici/vanne.jpg'),
(47, 2, 'kheigl', '123456', 'Katherine', 'Heigl', 'kheigl@foi.hr', 'korisnici/kheigl.jpg'),
(48, 2, 'gbutler', '123456', 'Gerard', 'Butler', 'gbutler@foi.hr', 'korisnici/gbutler.jpg'),
(49, 2, 'jbiel', '123456', 'Jessica', 'Biel', 'jbiel@foi.hr', 'korisnici/jbiel.jpg'),
(50, 2, 'ldicaprio', '123456', 'Leonardo', 'DiCaprio', 'ldicaprio@foi.hr', 'korisnici/ldicaprio.jpg'),
(51, 2, 'mdamon', '123456', 'Matt', 'Damon', 'mdamon@foi.hr', 'korisnici/mdamon.jpg'),
(52, 2, 'hpanettiere', '123456', 'Hayden', 'Panettiere', 'hpanettiere@foi.hr', 'korisnici/hpanettiere.jpg'),
(53, 2, 'rreynolds', '123456', 'Ryan', 'Reynolds', 'rreynolds@foi.hr', 'korisnici/rreynolds.jpg'),
(54, 2, 'jstatham', '123456', 'Jason', 'Statham', 'jstatham@foi.hr', 'korisnici/jstatham.jpg'),
(55, 2, 'enorton', '123456', 'Edward', 'Norton', 'enorton@foi.hr', 'korisnici/enorton.jpg'),
(56, 2, 'mwahlberg', '123456', 'Mark', 'Wahlberg', 'mwahlberg@foi.hr', 'korisnici/mwahlberg.jpg'),
(57, 2, 'jmcavoy', '123456', 'James', 'McAvoy', 'jmcavoy@foi.hr', 'korisnici/jmcavoy.jpg'),
(58, 2, 'epage', '123456', 'Ellen', 'Page', 'epage@foi.hr', 'korisnici/epage.jpg'),
(59, 2, 'mcyrus', '123456', 'Miley', 'Cyrus', 'mcyrus@foi.hr', 'korisnici/mcyrus.jpg'),
(60, 2, 'kstewart', '123456', 'Kristen', 'Stewart', 'kstewart@foi.hr', 'korisnici/kstewart.jpg'),
(61, 2, 'mfox', '123456', 'Megan', 'Fox', 'mfox@foi.hr', 'korisnici/mfox.jpg'),
(62, 2, 'slabeouf', '123456', 'Shia', 'LaBeouf', 'slabeouf@foi.hr', 'korisnici/slabeouf.jpg'),
(63, 1, 'ceastwood', '123456', 'Clint', 'Eastwood', 'ceastwood@foi.hr', 'korisnici/ceastwood.jpg'),
(64, 2, 'srogen', '123456', 'Seth', 'Rogen', 'srogen@foi.hr', 'korisnici/srogen.jpg'),
(65, 2, 'nreed', '123456', 'Nikki', 'Reed', 'nreed@foi.hr', 'korisnici/nreed.jpg'),
(66, 2, 'agreene', '123456', 'Ashley', 'Greene', 'agreene@foi.hr', 'korisnici/agreene.jpg'),
(67, 2, 'zdeschanel', '123456', 'Zooey', 'Deschanel', 'zdeschanel@foi.hr', 'korisnici/zdeschanel.jpg'),
(68, 2, 'dfanning', '123456', 'Dakota', 'Fanning', 'dfanning@foi.hr', 'korisnici/dfanning.jpg'),
(69, 2, 'tlautner', '123456', 'Taylor', 'Lautner', 'tlautner@foi.hr', 'korisnici/tlautner.jpg'),
(70, 2, 'rpattinson', '123456', 'Robert', 'Pattinson', 'rpattinson@foi.hr', 'korisnici/rpattinson.jpg'),
(71, 1, 'mblazevic', 'foi', 'Matko', 'Blazevic', 'mblazevic@foi.hr', 'korisnici/mblazevic.jpg'),
(72, 1, 'fallout', 'foi', 'vault', 'boy', 'fallout4@yahoo.com', 'korisnici/vault_boy1.png');

-- --------------------------------------------------------

--
-- Table structure for table `recept`
--

CREATE TABLE `recept` (
  `recept_id` int(10) UNSIGNED NOT NULL,
  `kategorija_id` int(10) UNSIGNED NOT NULL,
  `korisnik_id` int(10) UNSIGNED NOT NULL,
  `naslov` varchar(100) DEFAULT NULL,
  `slika` varchar(250) DEFAULT NULL,
  `tekst` varchar(1500) DEFAULT NULL,
  `odobren` int(10) UNSIGNED DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `recept`
--

INSERT INTO `recept` (`recept_id`, `kategorija_id`, `korisnik_id`, `naslov`, `slika`, `tekst`, `odobren`) VALUES
(1, 1, 9, 'Krem juha od poriluka i krumpira', 'http://free-st.t-com.hr/webproba/juha2.jpg', '1 Oprati i oďż˝istiti povrďż˝e 2 Narezati poriluk na tanke kolutiďż˝e, a krumpir i mrkvu na kockice te sve zajedno staviti u zdjelu. 3 Dodajte margarin narezan na komadiďż˝e, ďż˝licu usitnjenog perďż˝ina i 3-4 ďż˝lice vode. 4 Kuhati 10 minuta na laganoj vatri, zatim lagano posuti braďż˝nom, nekoliko trenutaka mijeďż˝ati. 5 Dodajte mlijeko i ponovno promjeďż˝ajte. 6 Ulijte 1 litru vode te pustite da kuha joďż˝ pola sata. 7 Dodajte kukuruz koji ste prethodno ocijedili i isprali, ostatak perďż˝ina te ako je potrebno joďż˝ malo vode. 8 Kuhati joďż˝ desetak minuta.  Dobar tek! :)', 1),
(2, 1, 9, 'Krem juha od graska', 'http://www.coolinarika.com/repository/images/_variations/7/c/7c1fe391525e2d222aeab310892e884d_header.jpg', '1 Prodinstajte nasjeckani luk na malo ulja, dodajte nasjeckanu mrkvu i joďż˝ malo prodinstajte. 2 Dodajte krumpire nasjeckane na kockice i graďż˝ak, podljite vodom, tako da pokrije povrďż˝e. 3 Dodajte perďż˝in, vegetu, sol i papar. 4 Ostavite da kuha dok povrďż˝e ne omekďż˝a, 20-ak minuta. 5 Maknite juhu s vatre, izmiksajte je ďż˝tapnim mikserom, dodajte vrhnje za kuhanje, te opet vratite na vatru da kratko prokuha. 6 Juhu posluďż˝ite ukraďż˝enu perďż˝inom i vrhnjem.', 1),
(3, 2, 12, 'Varazdinski klipici', 'http://www.coolinarika.com/repository/images/_variations/e/4/e4445ba7a71f3d2dfd8aff1b3a72567a_header.jpg', 'Kvasac razmutite s malo ďż˝eďż˝era u malo mlakog mlijeka neka se digneďż˝ 2 Dodajte u prosijano braďż˝no, u kojem je ulje, sol, u sredinu dignuti kvasacďż˝ 3 Mijesite lagano uz dodatak mlakog mlijeka koliko ga braďż˝no prima (tijesto treba biti dosta mekano i dobro istuďż˝eno)... 4 Napravite 21 hljepďż˝iďż˝ i pustite da se malo ďż˝odmoriďż˝.... Trgajte komadiďż˝e nauljenim rukama .... 5 Na lagano nauljenoj plohi razvaljate hljepďż˝iďż˝e i napravite klipiďż˝e, (kiflice), ne patite ako nisu svi pravilniďż˝ 6 Sloďż˝ite u protvanj (posudu za peďż˝enje), namaďż˝tite umuďż˝enim jajetom, posolite, pospite drugim posipom ili neďż˝im drugim po ukusu i pustite da malo diďż˝e...7 Pecite u zagrijanoj peďż˝nici na 200 C 30-tak minuta', 1),
(4, 5, 17, 'Palacinke', 'http://www.coolinarika.com/repository/images/_variations/a/5/a550411e556ec07d87a564f193f0b713_header.jpg', 'Mutiti jaje kao za tortu, dodati ulje mljeko i brasno i pomijeďż˝ati sve zajedno. Peďż˝i na zagrijanoj tavi sa 1-2 kapi ulje samo za prvu palacinku za ostale nema potrebe stavljati ulje na tavu. ', 1),
(5, 5, 19, 'Pametni kolac', 'http://www.coolinarika.com/repository/images/_variations/e/5/e5e9595f876a01c46c8a8d82805631c8_header.jpg', 'Margarin rastopite i ostavite da se ohladi. ďż˝umanjke pjenasto izmjeďż˝ajte sa ďż˝eďż˝erom. U smjesu sa ďż˝umanjcima dodajte prosijano braďż˝no, rastopljeni margarin,  ekstrakt vanilije i postepeno mlijeko. Smjesi lagano dodajte tuďż˝eni snijeg od bjelanjaka. Ulijte smjesu u dobro namaďż˝ďż˝enu i braďż˝nom posutu tepsiju veliďż˝ine 20x30 cm. Pekla sam 45 minuta na 160 stupnjeva (gornji + donji grijaďż˝) i joďż˝ 15 minuta na 140 stupnjeva.', 1),
(6, 4, 19, 'Pohani odrezak', 'http://www.coolinarika.com/repository/images/_variations/7/6/7603bf40fd4ac980efef19d1772e7105_header.jpg', '1 Pureće odreske potucite batom za meso, stavite u zdjelu, prelijte mlijekom i ostavite stajati oko 30 minuta. 2 Odreske ocijedite od mlijeka, posolite i popaprite. 3 Uvaljajte odreske u brašno, zatim u razmućena jaja, te na kraju u krušne mrvice. 4 Odreske pecite u široj tavi na zagrijanom ulju sa svake strane 5-7 minuta', 1),
(7, 4, 25, 'Zapeceni tortelini', 'http://www.coolinarika.com/repository/images/_variations/f/d/fd61e75dd4f2857f5f52ea322ba31cdf_header.jpg', 'Torteline skuhajte prema uputama na vrećici. Vatrostalnu posudu za pečenje premažite s maslacem, te u nju premjestite torteline. Prelijte umakom od rajčice, pa prekrijte mozzarellom narezanom na kockice, i na kraju pospite naribanim sirom. 2 Preostali maslac posložite po siru te stavite peći u zagrijanu pećnicu na 200 stupnjeva, 15 ak minuta, odnosno dok se sir ne rastopi.  3 Ovdje možete koristiti  domaći umak od rajčice.', 1),
(8, 4, 28, 'Sarene rolice', 'http://www.coolinarika.com/repository/images/_variations/6/f/6fa3b93897c91866564ef0235f16c945_header.jpg', 'Zagrijati peďż˝nicu na 180 stupnjeva.Pureďż˝e odreske potuďż˝i batom na prozirnoj foliji. Neka budu pribliďż˝no iste veliďż˝ine. Luk, mrkvu i perďż˝in nasjeckati u multipraktiku. Dodati komadiďż˝e mozzarelle, bjelanjak, zaďż˝ine i kruďż˝ne mrvice te pulsirati da se dobije kompaktna smjesa. Lim lagano namazati uljem (ili staviti papir za peďż˝enje). Na svaki odrezak stavljati po malo smjese te rolati. Na krajevima spojiti ďż˝aďż˝kalicom i stavljati ih u lim spojenom stranom prema dolje. Poprskati ih lagano maslinovim uljem i posuti crvenom paprikom. Peďż˝i oko 25-30 minuta.', 1),
(9, 4, 43, 'Pivski odresci', 'http://www.coolinarika.com/repository/images/_variations/0/d/0d228d145affdba8152140de2af6e1ed_header.jpg', 'Puretinu narežite na tanje odreske, pospite Vegetom, prelijte pivom i ostavite stajati na hladnom mjestu oko 2 sata. 2 Mariniranu puretinu popecite na roštilju ili na zagrijanom ulju u tavi sa svake strane oko 5 minuta.', 1),
(10, 3, 71, 'Waldorf salad', 'http://www.domacica.com/wp-content/uploads/2014/12/waldorf-salata1.jpg', '1. Napraviti majonezu od cijelih jaja,tj.\r\n\r\n1 jaje\r\n\r\n1 zlicica soli\r\n\r\n1 zlicica senfa\r\n\r\n1 zlicica limunovog soka\r\n\r\noko 200ml ulja\r\n\r\n  \r\n2. Napuniti salicu od 250ml jezgrama oraha.\r\n\r\nzatim orahe oprati i ocijediti.\r\n\r\nU zdjelici pomijesati secer,djindju i cayenne papar/biber.\r\n\r\nSada ocijedene orahe uvaljati u tu smjesu...posloziti na papir za pecenje i staviti u rernu da se osuse.\r\nOsusene grubo isjeci.\r\n\r\n3. Oprati 2 crvene i 2 zelene jabuke,ocistiti od sjemenki i grubih dijelova,rasjeci na cetvrtine i isjeckati u listice.\r\n\r\nTo isto uraditi sa stabljikom celera.\r\n\r\nPreliti narancinim sokom,lagano promijesati,ne gnjeciti,staviti u staklenu zdjleu i poklopiti,poklopcem ili prozirnom folijom.\r\n\r\n4. Ostaviti u frizider da se dobro ohladi.', 1),
(12, 3, 1, 'Meksicka salata', 'http://www.coolinarika.com/image/297470d3f3b236aab595ce8f67f56a47_header.jpg', '1. Crvenu i zelenu papriku i luk nareďż˝ite na manje trakice, moďż˝ete i kockice. Mladi luk na male kolutiďż˝e. Mrkvu na manje kockice.\r\n\r\nOstavite sa strane ... Idemo dalje :)i zelenu\r\n2.\r\nCrveni grah (uglavnom je najbolji crveni grah) ukoliko ste ga kupili gotovog, lagano ugrijte tako da bude topal, ne treba pretjerivati jer mu toplina sluďż˝i samo da se zaďż˝ini ďż˝to bolje prime. Kukuruz nije potrebno zagrijavati!\r\n\r\nGrah i kukuruz zaďż˝inite sa chili - tabasco po ďż˝elji tko kako voli. Kaďż˝u da papar NE IDE jer je samo CHILI dovoljan za ljutinu i prepoznatljiv okus ljutine no tko voli slobodno.\r\n\r\n3.\r\nKada ste povrďż˝e narezali a grah i kukuruz zaďż˝inili, vrijeme je da sve zajedno pomjeďż˝amo.\r\n\r\nPovrďż˝e stavite prvo a nakon toga gore stavite grah i kukuruz koje ste prethodno zaďż˝inili. Dodajte ulje i ocat. Dobro promjeďż˝ajte te probajte da vidite treba li joďż˝ ljutine.\r\n4.\r\nKada ste sve dobro izmjeďż˝ali i probali vrijeme je da salatu stavimo u hladnjak na najmanje 20-ak minuta. Kada je salata fino ohlaďż˝ena vrijeme je za jelo!', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sastojak`
--

CREATE TABLE `sastojak` (
  `sastojak_id` int(10) UNSIGNED NOT NULL,
  `naziv` varchar(100) DEFAULT NULL,
  `slika` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sastojak`
--

INSERT INTO `sastojak` (`sastojak_id`, `naziv`, `slika`) VALUES
(1, 'jaja', 'http://t0.gstatic.com/images?q=tbn:ANd9GcQAGQbuYO-gbNeoBue8WoePv4uJ5xVR5ksx3tJR-sr5hKkn5lpt'),
(2, 'brašno', 'http://t0.gstatic.com/images?q=tbn:ANd9GcRJuraN-53YqhZXuquIijdEx2rU14WoL2to88anPc5yr0DyeyGnNA'),
(3, 'šećer', 'http://t0.gstatic.com/images?q=tbn:ANd9GcQFYm6nz9OXSIVcQilFnKTEW-CmRI1WcDe8FdLpjRcSoWLNovXR'),
(4, 'sol', 'http://t2.gstatic.com/images?q=tbn:ANd9GcSQsZWB9X_gHB9i4Ah_VpTnFZTwKxpfz6lt6ODy8p1Wnoz3RFTJdw'),
(5, 'mlijeko', 'http://t3.gstatic.com/images?q=tbn:ANd9GcSCOAtVsHg8RzwNAqpwC3_g1SzhFRSGQ2N3okHKXjgOB5enCEajZQ'),
(6, 'poriluk', 'http://t3.gstatic.com/images?q=tbn:ANd9GcRRnsSxV-_H4hA7HTKBRUWrLEwRW31ybhXNBH6yW5uxtp5TW3UE'),
(7, 'krumpir', 'http://t1.gstatic.com/images?q=tbn:ANd9GcQB85X7DFLMAyWgS10QUWKoRp9Yyo6c8bvMvWS3EeucYypFc8Zp'),
(8, 'mrkva', 'http://t2.gstatic.com/images?q=tbn:ANd9GcT4y5TMOtvZcmDajIagIGUY_A61JL3nLu-oWY1NQm4jNv0fgCvS'),
(9, 'margarin', 'http://t3.gstatic.com/images?q=tbn:ANd9GcTLcpopmM7rP2xrBP4B216wzOUNo9uFrQKT_wpk3hmf5-Uhuoq6'),
(10, 'luk', 'http://t1.gstatic.com/images?q=tbn:ANd9GcQzh71XsEON5SrJh-FO6QSvMONJVoF0iunRVD1jZCXvlMhTWVvtMg'),
(11, 'grašak', 'http://t0.gstatic.com/images?q=tbn:ANd9GcSoCukwZEn3M2gb_a_W2roi1W9KcfIFey4gnbSxMEEY-6_kSQPi'),
(12, 'vrhnje za kuhanje', 'http://t2.gstatic.com/images?q=tbn:ANd9GcRSIU-x5dJG99QYcrw3doIzgETeR8ZcUazmAJyZJuiJgL3LDZ9m'),
(13, 'ulje', 'http://www.coolinarika.com/image/8fcef086d19be6a4ad2680a2e8dc927c_header.jpg'),
(14, 'kvasac', 'http://t2.gstatic.com/images?q=tbn:ANd9GcR5juMFaK4KFPoGGosFVbXA6zIHUzg2JwlMHWO0M303hmDpfjWmsg'),
(15, 'pureći odrezak', 'http://online.konzum.hr/images/products/024/02455498l.gif'),
(16, 'tortelini', 'http://t0.gstatic.com/images?q=tbn:ANd9GcSR86madtN8Xo9imlt8ski9l0XOBS1DHWNxIn9oY4mzdD_jbOOysA'),
(17, 'mozzarella', 'http://t1.gstatic.com/images?q=tbn:ANd9GcRfiPvasmSTgXvsHELSCN6SqV7AaSOLTgEr0v2SLu3VqTYrGskp'),
(18, 'rajčica', 'http://t3.gstatic.com/images?q=tbn:ANd9GcRsAMiBj8l38jlumXnAkyF7o7hfW502EVeHUDH52Wk1GzHqoy23'),
(19, 'sir', 'http://t0.gstatic.com/images?q=tbn:ANd9GcQkVVqJinrr8oCy3BpkCzmh8DiByjcS_vA6FBNowl9xRLDPvxNwMQ'),
(23, 'jagode', 'http://t0.gstatic.com/images?q=tbn:ANd9GcRnQuSlcT3ucDwgpzoPfKPE2oA6vDyhLo3_HQpEkK__9y5QF8ug'),
(56, 'orasi', 'http://t2.gstatic.com/images?q=tbn:ANd9GcSg05qWqpmr0M90YWyX1xRQMqHYjCchTQRF97m6lkYqP4p3quml'),
(57, 'jabuka', 'http://t3.gstatic.com/images?q=tbn:ANd9GcQ95rWW9ZNkZQnazkF4lQw-wZDOdttl5FquHtZ5MaRSLp_xFqYTJQ'),
(58, 'celer', 'http://t1.gstatic.com/images?q=tbn:ANd9GcSo6iDj5gWMaoa6RDLYV5oxt5ThNoEoECgNQ9WSZBKjl4phZcYjrw'),
(59, 'zelena salata', 'http://t2.gstatic.com/images?q=tbn:ANd9GcSBl7k65668BXgR4jXKLgiNb3ph2HjfqOTMKHfHtsZJGYOj15u9ew'),
(60, 'majoneza', 'http://t2.gstatic.com/images?q=tbn:ANd9GcQJ3kZop05GvMIcgGiG6fg-CYVJIUX51xv9GnuGl8rkt9a48sJVtA'),
(61, 'crvena paprika', 'http://t0.gstatic.com/images?q=tbn:ANd9GcT68YoF_slGW9kizl-6PoK1KAidC9efonGC8urrkR-pQoY5M36l'),
(62, 'zelena paprika', 'http://t1.gstatic.com/images?q=tbn:ANd9GcRKf81RitoUTzstn4a-Xcdg2gj4cHCfDYnbsuJawEJiLubjUTF0OQ'),
(63, 'crveni grah', 'http://t0.gstatic.com/images?q=tbn:ANd9GcR2UnBHc1Kd2h3auRx8HXqewOn454Uh0Fw1n-LcWfIfHr983ds0'),
(65, 'kukuruz', 'http://t2.gstatic.com/images?q=tbn:ANd9GcRpDP1-m-VveUvKU3svkeJwYEWb7zpvXuG5BL2YnEEtrfoXw2T55g'),
(66, 'chilli', 'http://t0.gstatic.com/images?q=tbn:ANd9GcS2xb2Dv9V6mtmeqn91FklC6TFLZVr1WGBzZ9yun27ujtOej4L7Fg'),
(69, 'pivo', 'http://t1.gstatic.com/images?q=tbn:ANd9GcQq3_AAkouNih2E__Zs9ODkWvQH5mGYyOLYyTzyOvwlOy1Vdyok-w');

-- --------------------------------------------------------

--
-- Table structure for table `sastojak_recepta`
--

CREATE TABLE `sastojak_recepta` (
  `recept_id` int(10) UNSIGNED NOT NULL,
  `sastojak_id` int(10) UNSIGNED NOT NULL,
  `kolicina` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sastojak_recepta`
--

INSERT INTO `sastojak_recepta` (`recept_id`, `sastojak_id`, `kolicina`) VALUES
(1, 2, '2 žlice'),
(1, 3, 'po želji'),
(1, 5, '1dl'),
(1, 6, '500g'),
(1, 7, '300g'),
(1, 9, '30g'),
(2, 3, 'po želji'),
(2, 7, '300g'),
(2, 8, '1'),
(2, 10, '1 glavica'),
(2, 11, '450 g'),
(2, 12, '200ml'),
(3, 2, '600g'),
(3, 3, 'malo'),
(3, 4, 'malo'),
(3, 5, '0.5l'),
(3, 13, '2dl'),
(3, 14, '40g'),
(4, 1, '3'),
(4, 2, '16 žlica'),
(4, 5, '500ml'),
(4, 13, '100ml'),
(5, 1, '8'),
(5, 2, '10 žlica'),
(5, 3, '300g'),
(5, 5, '1l'),
(5, 9, '250g'),
(6, 1, '3'),
(6, 2, '80g'),
(6, 5, '100ml'),
(6, 15, '600g'),
(7, 9, '100g'),
(7, 16, '500g'),
(7, 17, '200g'),
(7, 18, '300ml'),
(7, 19, '150g'),
(8, 1, '1'),
(8, 8, '2'),
(8, 10, '1'),
(8, 15, '500g'),
(8, 17, '1 kuglica'),
(9, 10, '150g'),
(9, 13, '4 žlice'),
(9, 15, '800g'),
(9, 18, '200g'),
(10, 3, '1 žlica'),
(10, 56, '1 šalica'),
(10, 57, '2 crvene'),
(10, 58, '2-3 stapke'),
(10, 59, '1/2 glavice'),
(10, 60, '1/3 šalice'),
(12, 6, '1 kom'),
(12, 8, '1 kom'),
(12, 61, '3 kom'),
(12, 62, '3 kom'),
(12, 63, '300 g'),
(12, 65, '100 g'),
(12, 66, 'po želji');

-- --------------------------------------------------------

--
-- Table structure for table `tip_korisnika`
--

CREATE TABLE `tip_korisnika` (
  `tip_id` int(10) UNSIGNED NOT NULL,
  `naziv` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tip_korisnika`
--

INSERT INTO `tip_korisnika` (`tip_id`, `naziv`) VALUES
(0, 'administrator'),
(1, 'moderator'),
(2, 'korisnik');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kategorija`
--
ALTER TABLE `kategorija`
  ADD PRIMARY KEY (`kategorija_id`),
  ADD KEY `kategorija_FKIndex1` (`korisnik_id`);

--
-- Indexes for table `komentar`
--
ALTER TABLE `komentar`
  ADD PRIMARY KEY (`komentar_id`),
  ADD KEY `komentar_FKIndex1` (`recept_id`),
  ADD KEY `komentar_FKIndex2` (`korisnik_id`);

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`korisnik_id`),
  ADD UNIQUE KEY `korisnik_index1780` (`korisnicko_ime`),
  ADD KEY `korisnik_FKIndex1` (`tip_id`);

--
-- Indexes for table `recept`
--
ALTER TABLE `recept`
  ADD PRIMARY KEY (`recept_id`),
  ADD KEY `recept_FKIndex1` (`korisnik_id`),
  ADD KEY `recept_FKIndex2` (`kategorija_id`);

--
-- Indexes for table `sastojak`
--
ALTER TABLE `sastojak`
  ADD PRIMARY KEY (`sastojak_id`);

--
-- Indexes for table `sastojak_recepta`
--
ALTER TABLE `sastojak_recepta`
  ADD PRIMARY KEY (`recept_id`,`sastojak_id`),
  ADD KEY `recept_has_sastojak_FKIndex1` (`recept_id`),
  ADD KEY `recept_has_sastojak_FKIndex2` (`sastojak_id`);

--
-- Indexes for table `tip_korisnika`
--
ALTER TABLE `tip_korisnika`
  ADD PRIMARY KEY (`tip_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategorija`
--
ALTER TABLE `kategorija`
  MODIFY `kategorija_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `komentar`
--
ALTER TABLE `komentar`
  MODIFY `komentar_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `korisnik_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `recept`
--
ALTER TABLE `recept`
  MODIFY `recept_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `sastojak`
--
ALTER TABLE `sastojak`
  MODIFY `sastojak_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kategorija`
--
ALTER TABLE `kategorija`
  ADD CONSTRAINT `kategorija_ibfk_1` FOREIGN KEY (`korisnik_id`) REFERENCES `korisnik` (`korisnik_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `komentar`
--
ALTER TABLE `komentar`
  ADD CONSTRAINT `komentar_ibfk_1` FOREIGN KEY (`recept_id`) REFERENCES `recept` (`recept_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `komentar_ibfk_2` FOREIGN KEY (`korisnik_id`) REFERENCES `korisnik` (`korisnik_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD CONSTRAINT `korisnik_ibfk_1` FOREIGN KEY (`tip_id`) REFERENCES `tip_korisnika` (`tip_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `recept`
--
ALTER TABLE `recept`
  ADD CONSTRAINT `recept_ibfk_1` FOREIGN KEY (`korisnik_id`) REFERENCES `korisnik` (`korisnik_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `recept_ibfk_2` FOREIGN KEY (`kategorija_id`) REFERENCES `kategorija` (`kategorija_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `sastojak_recepta`
--
ALTER TABLE `sastojak_recepta`
  ADD CONSTRAINT `sastojak_recepta_ibfk_1` FOREIGN KEY (`recept_id`) REFERENCES `recept` (`recept_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `sastojak_recepta_ibfk_2` FOREIGN KEY (`sastojak_id`) REFERENCES `sastojak` (`sastojak_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
