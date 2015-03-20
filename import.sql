-- phpMyAdmin SQL Dump
-- version 4.2.10
-- http://www.phpmyadmin.net
--
-- Client :  localhost:8889
-- Généré le :  Ven 20 Mars 2015 à 02:42
-- Version du serveur :  5.5.38
-- Version de PHP :  5.5.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `symfony`
--

-- --------------------------------------------------------

--
-- Structure de la table `Category`
--

CREATE TABLE `Category` (
`id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `Category`
--

INSERT INTO `Category` (`id`, `name`) VALUES
(1, 'Shonen'),
(2, 'Shojo'),
(3, 'Seinen'),
(4, 'Yaoi');

-- --------------------------------------------------------

--
-- Structure de la table `Comment`
--

CREATE TABLE `Comment` (
`id` int(11) NOT NULL,
  `author` int(11) DEFAULT NULL,
  `id_spoil` int(11) DEFAULT NULL,
  `parent` int(11) DEFAULT NULL,
  `date` datetime NOT NULL,
  `text` longtext COLLATE utf8_unicode_ci NOT NULL,
  `nb_like` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `Comment`
--

INSERT INTO `Comment` (`id`, `author`, `id_spoil`, `parent`, `date`, `text`, `nb_like`) VALUES
(1, 4, 22, NULL, '2015-03-19 17:57:53', 'Il est trop CUTE le chat !', 0),
(2, 4, 21, NULL, '2015-03-19 17:59:11', 'Non sérieux ???? :O', 1),
(3, 4, 32, NULL, '2015-03-19 18:00:49', 'Pourrait-on avoir des vrais spoils please ???...', 0),
(4, 3, 21, NULL, '2015-03-19 18:02:38', 'Dommage...', 1),
(5, 3, 26, NULL, '2015-03-19 18:03:43', 'SANS BLAGUE ???', 0);

-- --------------------------------------------------------

--
-- Structure de la table `Manga`
--

CREATE TABLE `Manga` (
`id` int(11) NOT NULL,
  `category` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `Manga`
--

INSERT INTO `Manga` (`id`, `category`, `name`) VALUES
(1, 1, 'Love Hina'),
(2, 1, 'Judge'),
(3, 2, 'Ayashi No Ceres'),
(4, 2, 'Fruits Basket'),
(5, 2, 'Fushigi yugi - Gembu Kaiden'),
(6, 1, 'Death Note'),
(8, 2, 'Sailor Moon'),
(9, 1, 'Détective Conan'),
(10, 3, 'King''s game'),
(11, 1, 'Naruto'),
(12, 1, 'One piece'),
(13, 2, 'Lovely complex'),
(14, 4, 'Fuyu no semi'),
(15, 4, 'Ikoku irokoi romantan'),
(16, 4, 'Antique Bakery'),
(17, 4, 'Haru Wo Daiteita'),
(18, 4, 'Koi Suru Boukun'),
(19, 4, 'Tight rope'),
(20, 4, 'Sekaiichi Hatsukoi'),
(21, 1, 'Dragon-Ball-z'),
(23, 1, 'Blue exorciste'),
(24, 1, 'Berserk'),
(25, 1, 'Parasyte '),
(26, 1, 'Bakemonogatari '),
(27, 1, 'La légende des 12 royaumes '),
(28, 3, 'Prophecy '),
(29, 3, 'Basilisk '),
(30, 3, 'Vampire chronicle'),
(31, 3, 'Akira '),
(32, 1, 'Fairy tail'),
(33, 3, 'Monster'),
(34, 3, 'Planetes '),
(35, 3, 'Gto'),
(36, 1, 'Pandora hearts'),
(37, 3, 'Code guess'),
(38, 1, 'Pokemon'),
(40, 3, 'Nicky larson '),
(41, 1, 'Cat''s Eye '),
(42, 2, 'Sakura card captor'),
(43, 2, 'Nana'),
(44, 3, 'Doubt'),
(45, 3, 'Shinsekai yori'),
(46, 1, 'Bleach'),
(47, 1, 'Mirai Nikki'),
(48, 3, 'chobit');

-- --------------------------------------------------------

--
-- Structure de la table `project_user`
--

CREATE TABLE `project_user` (
`id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `locked` tinyint(1) NOT NULL,
  `expired` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  `confirmation_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `credentials_expired` tinyint(1) NOT NULL,
  `credentials_expire_at` datetime DEFAULT NULL,
  `cover` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `project_user`
--

INSERT INTO `project_user` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`, `cover`) VALUES
(1, 'Icethii', 'icethii', 'ng.thi90@gmail.com', 'ng.thi90@gmail.com', 1, '83rjbz5k0lwcg4cs00cok4s8ggs0s88', 'NCbQ7PWf/gGDfbF6fTFvk5FHmxrobMX+gSP5L2rHNKNpRzDL2fMt/DSQJKNKmXpF1MwgCCLxnBNLNe9kFPuqsw==', '2015-03-20 02:36:27', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:10:"ROLE_ADMIN";}', 0, NULL, 'thi.jpg'),
(3, 'Jordan', 'jordan', 'jordan.desjardin@gmail.com', 'jordan.desjardin@gmail.com', 1, 'ozmpleue8tcgscccsgk488sgc448wc8', 'KcTb2Y1zGxS5ZgZt/CkCAGkcChAqeWgV2E5TqYQ5tjEjU2MFNgupYzZHSVJjt6Y63i21WKQWEG14y449esRPlQ==', '2015-03-19 18:01:26', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, 'jordan.jpg'),
(4, 'Siham', 'siham', 'sihamrguibi@gmail.com', 'sihamrguibi@gmail.com', 1, '8rgsros1i1gckg8sgk0gckwcskgsscg', 'Xow/UjFSXxBeNpuI7XVCTWofuzZFvuUqrHDBxLFca16x6JQVruO4i50iB3KhmthwBQTmUYxyuraFCS7TOW0Few==', '2015-03-19 17:20:00', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, 'siham.jpg'),
(5, 'Audrey', 'audrey', 'audreyboucher95@gmail.com', 'audreyboucher95@gmail.com', 1, '17slkj5w3ls00co0wsckg0oww08cwoo', 'OxF44NX6z1lk3DSAmyhpJVjYy7hQ8flrXhgGLuwk38NKxFD5fVLQ+3Wd+bJTnVPaCZLghGH0E6ELNzSB3CUSzA==', '2015-03-19 10:46:29', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, 'audrey.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `Spoil`
--

CREATE TABLE `Spoil` (
`id` int(11) NOT NULL,
  `manga` int(11) DEFAULT NULL,
  `author` int(11) DEFAULT NULL,
  `title` longtext COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `cover` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `nb_comments` int(11) NOT NULL,
  `nb_spoil` int(11) NOT NULL,
  `nb_fail` int(11) NOT NULL,
  `nb_fake` int(11) NOT NULL,
  `is_published` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `Spoil`
--

INSERT INTO `Spoil` (`id`, `manga`, `author`, `title`, `slug`, `cover`, `date`, `nb_comments`, `nb_spoil`, `nb_fail`, `nb_fake`, `is_published`) VALUES
(17, 1, 1, 'A la fin, Keitaro parvient enfin à rentrer à Todai.', 'a-la-fin-keitaro-parvient-enfin-a-rentrer-a-todai', 'lovehina-cover-1.jpg', '2015-03-19 00:00:00', 0, 1, 0, 1, 1),
(18, 1, 1, 'Su est en fait une cousine éloignée de Keitaro', 'Su-est-en-fait-une-cousine-eloigneeede-Keitaro', 'lovehina-cover-2.jpg', '2015-03-19 00:00:00', 0, 1, 0, 1, 1),
(19, 2, 1, 'Le créateur du jeu était en fait Hikari.', 'Le-createur-du-jeu-etait-en-fait-Hikari', 'judge.jpg', '2015-03-19 00:00:00', 0, 1, 0, 0, 1),
(20, 3, 1, 'Aki incarnait en fait le descendant du mari de Ceres.', 'aki-incarnait-en-fait-le-descendant-du-mari-de-ceres', 'ayashinoceres-cover-1.jpg', '2015-03-19 00:00:00', 0, 2, 0, 0, 1),
(21, 4, 1, 'Akito est en fait une femme.', 'Akito-est-en-fait-une-femme', 'fruitsbasket-cover-1.jpg', '2015-03-06 00:00:00', 2, 2, 0, 0, 1),
(22, 4, 1, 'La vraie transformation de Kyo est horrible et puante.', 'kyo-cachait-en-fait-que-sa-vraie-transformation-est-horrible-et-puante', 'fruitsbasket-cover-2.jpg', '2015-03-18 00:00:00', 1, 1, 0, 0, 1),
(23, 5, 1, 'Hargas est en fait une étoile de Genbu, et la partage avec son frère jumeau Tegu.', 'hargas-est-en-fait-une-etoile-de-gembu', 'fushigiyugi-cover-1.jpg', '2015-03-16 00:00:00', 0, 1, 0, 1, 1),
(24, 6, 1, 'Righto devient après sa mort un Dieu de la mort.', 'righto-devient-apres-sa-mort-un-dieu-de-la-mort', 'deathnote-cover.jpg', '2015-03-19 00:00:00', 0, 2, 1, 0, 1),
(25, 8, 1, 'Chibiusa est en fait la fille de sailor moon et du tuxedo mask, venant du futur.', 'chibiusa-est-en-fait-la-fille-de-sailor-moon-et-du-tuxedo-mask', 'sailormoon-cover.jpg', '2015-03-17 00:00:00', 0, 1, 1, 0, 1),
(26, 9, 1, 'Et en fait, Conan est un adulte qui s''appelle Shinichi.', 'Et-en-fait-Conan-est-un-adulte-qui-s-appelle-Shinichi', 'detectiveconan-cover.jpg', '2015-03-19 00:00:00', 1, 0, 1, 0, 1),
(27, 10, 1, 'A la fin tout le monde meurt sauf le personnage principal.', 'A-la-fin-tout-le-monde-meurt-sauf-le-personnage-principal', 'kingsgame-cover.jpg', '2015-03-20 00:00:00', 0, 0, 0, 0, 1),
(28, 11, 1, 'En vrai les cheveux de Sakura son bleus.', 'En-vrai-les-cheveux-de-Sakura-son-bleus', 'naruto-cover-1.jpg', '2015-03-19 00:00:00', 0, 0, 0, 0, 1),
(29, 12, 1, 'Ace meurt.', 'Ace-meurt', 'onepiece-cover-1.jpg', '2015-03-19 00:00:00', 0, 0, 0, 0, 1),
(30, 12, 1, 'Sabo n''est pas mort, il est dans l''armée révolutionnaire.', 'Sabo-n-est-pas-mort-il-est-dans-l-armee-revolutionnaire', 'onepiece-cover-2.jpg', '2015-03-19 00:00:00', 0, 1, 0, 0, 1),
(31, 12, 1, 'Sniper king en réalité c''est Usopp.', 'Sniper-king-en-realite-c-est-Usopp', 'onepiece-cover-3.jpg', '2015-03-03 00:00:00', 0, 0, 0, 0, 1),
(32, 13, 1, 'Les deux personnages principaux vont finir ensemble.', 'Les-deux-personnages-principales-vont-finir-ensemble', 'lovely-complex.png', '2015-03-19 00:00:00', 1, 0, 1, 0, 1),
(33, 13, 1, 'Koizumi va mourir.', 'Koizumi-va-mourir', 'lovely-complex-1.jpg', '2015-03-18 00:00:00', 0, 1, 0, 1, 1),
(34, 14, 4, 'A la fin Akizuki s''est suicidé, attristé par sa mort Kusaka la suivie dans la mort.', 'A-la-fin-Akizuki-s-est-suicide-atriste-par-sa-mort-Kusaka-suivie-dans-la-mort', 'Fuyu-no-semi.jpg', '2015-03-18 00:00:00', 0, 2, 1, 0, 1),
(35, 15, 4, 'Ranmaru se fait capturer pour être vendu comme esclave sexuel.', 'Ranmaru-se-fait-capturer-pour-etre-vendu-comme-esclave-sexuel', 'Ikoku-irokoi-romantan.jpg', '2015-03-19 00:00:00', 0, 1, 0, 0, 1),
(36, 16, 4, 'Tachibana s''est fait kidnapper et agresser quand il était jeune.', 'Tachibana-s-est-fait-kidnapper-et-agresser-quand-il-etait-jeune', 'antique-bakery.jpg', '2015-03-08 00:00:00', 0, 0, 0, 0, 1),
(37, 16, 4, 'Ono et Tachibana ne finissent pas ensemble.', 'Ono-et-Tachibana-ne-finissent-pas-ensemble', 'antique-bakery-1.jpg', '2015-03-23 00:00:00', 0, 1, 0, 0, 1),
(38, 17, 4, 'Yoji a trompé Kyosuke avec Kikuchi-san.', 'Yoji-a-tromper-Kyosuke-avec-Kikuchi-san', 'Haru-wo-daiteita.jpg', '2015-03-10 00:00:00', 0, 2, 1, 1, 1),
(39, 18, 4, 'Morinaga va mystérieusement disparaître.', 'Morinaga-va-mysterieusement-disparaitre', 'Koisuru-Boukun.jpg', '2015-03-19 00:00:00', 0, 0, 0, 0, 1),
(40, 19, 4, 'Nao s''est fait tiré dessus.', 'Nao-s-est-fait-tire-dessus', 'Tight-rope.jpg', '2015-03-19 00:00:00', 0, 1, 0, 0, 1),
(41, 19, 4, 'Nao va se faire kidnapper.', 'Nao-va-se-faire-kidnapper', 'Tight-rope-1.jpg', '2015-03-19 00:00:00', 0, 0, 0, 0, 1),
(42, 19, 4, 'Ryu devient le chef du clan des yakuzas.', 'Ryu-devient-le-chef-du-clan-des-yakuzas', 'Tight-rope-2.jpg', '2015-03-19 00:00:00', 0, 1, 0, 0, 1),
(43, 20, 4, 'Ritsu et Takano ne finissent pas ensemble.', 'Ritsu-et-Takano-ne-finissent-pas-ensemble', 'Sekaiichi-Hatsukoi.png', '2015-03-19 00:00:00', 0, 2, 0, 1, 1),
(44, 21, 1, 'Sangohan tue Cell avec un super kamehameha.', 'Sangohan-il-tue-Cell-avec-un-super-kamehameha', 'Dragon-Ball-z.jpg', '2015-03-19 00:00:00', 0, 1, 0, 0, 1),
(45, 21, 1, 'Songoku se transforme en super Sayen pendant que Freezer tue Krilin.', 'Son-goku-il-se-transforme-en-super-Sayen-quand-a-freezer-il-tue-krilin', 'Dragon-Ball-z-1.jpg', '2015-03-19 00:00:00', 0, 1, 0, 0, 1),
(46, 3, 1, 'Aki est le frère de Aya.', 'Aki-est-le-frere-de-Aya', 'ayashinoceres-cover-2.jpg', '2015-03-19 00:00:00', 0, 0, 0, 0, 1),
(47, 11, 1, 'A la fin, Sasuke vit dans un arbre.', 'A-la-fin-Sasuke-vit-dans-un-arbre', 'naruto-cover-2.jpg', '2015-03-20 00:00:00', 0, 0, 0, 0, 1),
(51, 11, 5, 'Kakachi cache derrière son masque des dents de lapin.', 'kakachi-cache-derriere-son-masque-des-dents-de-lapin', 'naruto-kakashi.jpg', '2015-03-20 00:00:00', 0, 1, 0, 0, 1),
(53, 11, 5, 'Pain (nagato) s''est suicidé', 'Pain-s-est-suicide', 'naruto-pain.jpg', '2015-03-25 00:00:00', 0, 0, 0, 1, 1),
(54, 11, 1, 'Conan a été tuée par tobi', 'conan-a-ete-tuee-par-tobi', 'naruto-konan.jpg', '2015-03-25 00:00:00', 0, 1, 0, 0, 1),
(55, 11, 5, 'Tobi est en fait Obito, l''ami mort de Kakashi sensei', 'tobi-est-en-fait-obito-l-ami-mort-de-kakashi-sensei', 'naruto-tobi.jpg', '2015-03-17 00:00:00', 0, 0, 0, 0, 1),
(56, 43, 3, 'Nana tombe enceinte de Takumi', 'nana-tombe-enceinte-de-takumi', 'nana-cover.jpg', '2015-03-20 00:00:00', 0, 1, 0, 1, 1),
(57, 37, 5, 'Lelouche se fait tuer par son meilleur ami.', 'lelouche-se-fait-tuer-par-son-meilleur-ami', 'naruto-jiraya.jpg', '2015-03-20 00:00:00', 0, 0, 0, 0, 1),
(58, 44, 5, 'En fait, c''est Rei Hazama la meurtrière. ', 'en-fait-c-est-rei-hazama-la-meurtriere ', 'doubt-cover.jpg', '2015-03-21 00:00:00', 0, 1, 0, 0, 1),
(59, 45, 4, 'Les hommes taupes sont en fait des humains sans pouvoir de télékynésie', 'les-hommes-taupes-sont-en-fait-des-humains-sans-pouvoir-de-telekynesie', 'shinsekaiyori-cover.jpg', '2015-03-27 00:00:00', 0, 0, 0, 0, 1),
(60, 46, 4, 'Le roi des esprits meurt.', 'le-roi-des-esprits-meurt', 'bleach-cover.jpg', '2015-03-23 00:00:00', 0, 1, 1, 0, 1),
(61, 47, 4, 'En fait, Yuno est morte.', 'en-fait-yuno-est-morte', 'mirainikki-cover.jpg', '2015-03-22 00:00:00', 0, 0, 0, 0, 0),
(62, 48, 1, 'Hideki fait le choix de l''aimer pour ce qu''elle est, et non pour son corp.', 'hideki-fait-le-choix-de-l-aimer', 'chobit-cover.jpg', '2015-03-20 00:00:00', 0, 2, 0, 0, 1),
(63, 23, 4, 'Rin est condamné à mort.', 'rin-est-condamne-a-mort', 'blue-exorciste.jpg', '2015-03-20 00:00:00', 0, 1, 0, 0, 1),
(64, 24, 4, 'Griphis fini par trahir ses amis et viole la copine de Guts', 'griphis-fini-par-trahir-ses-amis-et-viole-la-copine-du-hero', 'berserk.jpg', '2015-03-20 00:00:00', 0, 0, 0, 0, 1),
(65, 25, 4, 'À la fin tous les parasites sont morts et celui dans le bras d''un héro s''endort définitivement\r\n', 'a-la-fin-tous-les-parasites-sont-morts', 'parasyte.jpg', '2015-03-20 00:00:00', 0, 1, 0, 0, 1),
(66, 26, 1, 'Le hero est un vampire', 'le-hero-est-un-vampire', 'bakemonogatari.jpg', '2015-03-20 00:00:00', 0, 0, 0, 0, 1),
(67, 27, 4, 'La reine abolit les prosternations', 'la-reine-abolit-les-prosternations', 'La-legende-des-12-royaumes.jpg', '2015-03-20 00:00:00', 0, 1, 0, 0, 1),
(68, 29, 1, 'Ils crevent tous à la fin', 'ils-crevent-tous-a-la-fin', 'basilisk.jpg', '2015-03-20 00:00:00', 0, 0, 0, 1, 1),
(69, 30, 1, 'Le cygne noir représente en fait Stella et son enfant', 'le-cygne-noir-represente-en-fait-stella-et-son-enfant', 'vampire-chronicles.jpg', '2015-03-20 00:00:00', 0, 0, 0, 0, 1),
(70, 31, 4, 'Tetsuo forme le nouveau gouvernement japonais et gère le pays en sa mémoire', 'tetsuo-forme-le-nouveau-gouvernement-japonais-et-gere-le-pays-en-sa-memoire', 'akira.jpg', '2015-03-20 00:00:00', 0, 0, 0, 0, 1),
(71, 31, 1, 'Akira meurt à la fin', 'akira-meurt-a-la-fin', 'akira-cover-2.jpg', '2015-03-20 00:00:00', 0, 0, 0, 0, 1),
(72, 32, 4, 'Happy s est entraîné à ne pas manger de poisson. Il a échoué', 'happy-s-est-entraine-a-ne-pas-manger-de-poisson-il-a-echoue', 'fairy-tail.jpg', '2015-03-20 00:00:00', 0, 0, 0, 0, 1),
(73, 32, 5, 'Lisanna n''est pas morte', 'lisanna-n-est-pas-morte', 'fairy-tail-2.jpg', '2015-03-20 00:00:00', 0, 1, 0, 0, 1),
(74, 33, 1, 'Tenma fini par arrêter Johann sans le tuer et se fait acquitter', 'tenma-fini-par-arreter-johann-sans-le-tuer-et-se-fait-acquitter', 'monster.jpg', '2015-03-20 00:00:00', 0, 1, 0, 0, 1),
(75, 32, 4, 'Carla a prit forme humaine', 'carla-a-prit-forme-humaine', 'fairy-tail-3.jpg', '2015-03-20 00:00:00', 0, 1, 0, 0, 1),
(76, 34, 5, 'A la fin Hachimaki part pour Jupiter.', 'a-la-fin-hachimaki-part-pour-jupiter', 'planetes.jpg', '2015-03-20 00:00:00', 0, 1, 0, 1, 1),
(77, 35, 4, 'Onizuka fini par s''enfuir poursuivi par les flics', 'onizuka-fini-par-s-enfuir-poursuivi-par-les-flics', 'gto.jpg', '2015-03-20 00:00:00', 0, 0, 0, 0, 1),
(78, 36, 1, 'Oz est un démon qui se transforme en lapin', 'oz-est-un-demon-qui-se-transforme-en-lapin', 'pandora-heart.jpg', '2015-03-20 00:00:00', 0, 2, 1, 0, 1),
(79, 37, 4, 'Lelouche ne meurt pas et devient immortel à la place de C.C.', 'lelouche-ne-meurt-pas-et-devient-immortel-a-la-place-de-c-c', 'code-guess.jpg', '2015-03-20 00:00:00', 0, 2, 1, 0, 1),
(80, 38, 1, 'Et en fait, la team rocket s''envole vers d''autres cieuuuuuuux', 'et-en-fait-la-team-rocket-s-envole-vers-d-autres-cieuuuuuuux', 'pokemon.jpeg', '2015-03-20 00:00:00', 0, 1, 0, 0, 1),
(81, 38, 4, 'Et en fait pikachu c''est le chat de sacha', 'et-en-fait-pikachu-c-est-le-chat-de-sacha', 'pokemon-2.jpg', '2015-03-20 00:00:00', 0, 0, 0, 0, 1),
(82, 11, 1, 'Gold ranger est le père de Ace.', 'gold-ranger-est-le-pere-de-Ace', 'one-piece-gold.jpg', '2015-03-20 00:00:00', 0, 0, 1, 0, 1),
(83, 40, 1, 'Et en fait Nicky larson ne craint personne', 'et-en-fait-Nicky-larson-ne-craint-personne', 'nicky-larson.jpg', '2015-03-20 00:00:00', 0, 0, 1, 0, 1),
(84, 41, 1, 'Quentin découvre la vérité et quitte Tamara.', 'quentin-decouvre-la-verite-et-quitte-tamara', 'cat-s-eye.jpg', '2015-03-20 00:00:00', 0, 0, 0, 0, 1),
(85, 42, 1, 'Keiro est en fait le gardien des cartes', 'keiro-est-en-fait-le-gardien-des-cartes', 'sakura-card-captor.jpg', '2015-03-20 00:00:00', 0, 0, 0, 0, 0);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `Category`
--
ALTER TABLE `Category`
 ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Comment`
--
ALTER TABLE `Comment`
 ADD PRIMARY KEY (`id`), ADD KEY `IDX_5BC96BF0BDAFD8C8` (`author`), ADD KEY `IDX_5BC96BF04E5AFD2E` (`id_spoil`), ADD KEY `IDX_5BC96BF03D8E604F` (`parent`);

--
-- Index pour la table `Manga`
--
ALTER TABLE `Manga`
 ADD PRIMARY KEY (`id`), ADD KEY `IDX_B79BB10764C19C1` (`category`);

--
-- Index pour la table `project_user`
--
ALTER TABLE `project_user`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `UNIQ_B4021E5192FC23A8` (`username_canonical`), ADD UNIQUE KEY `UNIQ_B4021E51A0D96FBF` (`email_canonical`);

--
-- Index pour la table `Spoil`
--
ALTER TABLE `Spoil`
 ADD PRIMARY KEY (`id`), ADD KEY `IDX_611E931A765A9E03` (`manga`), ADD KEY `IDX_611E931ABDAFD8C8` (`author`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `Category`
--
ALTER TABLE `Category`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `Comment`
--
ALTER TABLE `Comment`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `Manga`
--
ALTER TABLE `Manga`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT pour la table `project_user`
--
ALTER TABLE `project_user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `Spoil`
--
ALTER TABLE `Spoil`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=86;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `Comment`
--
ALTER TABLE `Comment`
ADD CONSTRAINT `FK_5BC96BF03D8E604F` FOREIGN KEY (`parent`) REFERENCES `Comment` (`id`),
ADD CONSTRAINT `FK_5BC96BF04E5AFD2E` FOREIGN KEY (`id_spoil`) REFERENCES `Spoil` (`id`),
ADD CONSTRAINT `FK_5BC96BF0BDAFD8C8` FOREIGN KEY (`author`) REFERENCES `project_user` (`id`);

--
-- Contraintes pour la table `Manga`
--
ALTER TABLE `Manga`
ADD CONSTRAINT `FK_B79BB10764C19C1` FOREIGN KEY (`category`) REFERENCES `Category` (`id`);

--
-- Contraintes pour la table `Spoil`
--
ALTER TABLE `Spoil`
ADD CONSTRAINT `FK_611E931A765A9E03` FOREIGN KEY (`manga`) REFERENCES `Manga` (`id`),
ADD CONSTRAINT `FK_611E931ABDAFD8C8` FOREIGN KEY (`author`) REFERENCES `project_user` (`id`);
