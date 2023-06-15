-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : gift.db
-- Généré le : mar. 13 juin 2023 à 07:41
-- Version du serveur : 10.11.3-MariaDB-1:10.11.3+maria~ubu2204
-- Version de PHP : 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `archi`
--

-- --------------------------------------------------------

--
-- Structure de la table `box`
--

CREATE TABLE `box` (
  `id` varchar(128) NOT NULL,
  `author_id` varchar(50) NOT NULL,
  `token` varchar(64) NOT NULL,
  `libelle` varchar(128) NOT NULL,
  `description` text NOT NULL,
  `montant` decimal(12,2) NOT NULL DEFAULT 0.00,
  `kdo` tinyint(4) NOT NULL DEFAULT 0,
  `message_kdo` text NOT NULL DEFAULT '',
  `statut` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Déchargement des données de la table `box`
--

INSERT INTO `box` (`id`, `author_id`, `token`, `libelle`, `description`, `montant`, `kdo`, `message_kdo`, `statut`, `created_at`, `updated_at`) VALUES
('360bb4cc-e092-3f00-9eae-774053730cb2', 'user1@mail.com', 'twmyDtNlmtC0hsxZ6fEw0+maTTfrDEqNH0gjBhTo3BI=', 'détente', 'Ceci est une Box prédéfini de détente', 110.00, 1, 'Détente', 6, '2023-06-13 07:38:51', '2023-04-07 14:27:32'),
('6cc74b9f-43bc-3f63-a9c4-9158ad83f379', 'user1@mail.com', 'vjNlzSOpOgARgrwgZ4U39uMdDjhutIdXeHaazdZpAVA=', 'sport', 'Ceci est une Box prédéfini de sport', 168.00, 1, 'Sport', 6, '2023-06-13 07:38:51', '2023-04-07 14:27:32'),
('24fc3203-dbd0-3b61-801f-2f552b50603f', 'user1@mail.com', 'HPUEAIaDIc/lNpuo5qe6LlJaJzQ3DFTu1WRV/EQJaDI=', 'culture', 'Ceci est une Box prédéfini de culture', 48.00, 1, 'Culture', 6, '2023-06-13 07:38:51', '2023-04-07 14:27:32'),
('673d04b1-4878-38cf-9204-adbe6474a9a4', '0', '', 'et repudiandae ut', 'Consequatur doloremque quod non eveniet natus placeat. Accusantium necessitatibus id aliquid tenetur facere. Similique dolor est commodi alias enim beatae id incidunt. Eius eius eligendi ab magni ut impedit voluptatem.', 424.00, 0, '', 5, '2023-04-07 14:27:32', '2023-04-07 14:27:32'),
('06acee62-6b8f-33b4-b67f-76a11c45b111', '0', '', 'reprehenderit possimus nemo', 'Quia sequi est similique corrupti ab perspiciatis repellendus. Sit quibusdam enim libero blanditiis nostrum ducimus. Ea rem dolorem magnam veritatis. Necessitatibus qui occaecati iusto ut pariatur assumenda sit sunt. Eum itaque et est rerum eum perferendis fuga possimus.', 112.00, 0, '', 5, '2023-04-07 14:27:32', '2023-04-07 14:27:32'),
('f4002ad4-1151-38b8-a584-48c4fb5d7a5a', '0', 'EltjqTsjUGpLt4043NBP99ccIc+SFfQXitoHauxW1aA=', 'et autem placeat', 'Est ipsa autem esse labore qui inventore in. Laudantium enim facere sunt ea amet quae. Eum consequatur fuga ut a.', 244.00, 0, '', 3, '2023-04-07 14:27:32', '2023-04-07 14:27:32'),
('74ecb7c6-3375-3044-a1f3-fd27d931c9af', '0', 'mjre56n/LnCrwUwiq4ZJuJOrFHhPCZi6oCQ2whAtljE=', 'magnam delectus voluptate', 'Inventore omnis aut deserunt labore aut id. Et eum rem harum modi omnis officia eum. Veniam numquam iste autem et qui possimus sunt animi.', 174.00, 0, '', 2, '2023-04-07 14:27:32', '2023-04-07 14:27:32'),
('1e7bab49-ddb5-301b-9fd1-5f2c2f499052', '0', 'YMllERSG9L/JFH02Dw2oB69nQoHGHsqWSvQSu94mgSc=', 'officiis qui sint', 'Deleniti dolor quae repellat et. Ducimus voluptates rerum sequi omnis fuga aspernatur. Non praesentium sunt qui voluptatem omnis. Dolorem vitae eum ad nemo est odio.', 197.00, 0, '', 4, '2023-04-07 14:27:32', '2023-04-07 14:27:32'),
('1d2b0679-bde9-313a-aab8-47618b21219b', '0', 'kCqQ1Vbd0cSlVtN+kmmOmuF8iC29Ylf4AlUXIzK3LqM=', 'reiciendis est quasi', 'Autem non nulla saepe. Consequatur amet est saepe est dignissimos. Temporibus quasi harum repudiandae atque excepturi quo.', 505.00, 0, '', 2, '2023-04-07 14:27:32', '2023-04-07 14:27:32'),
('085c7346-25c4-3fe1-b485-34482c28badd', '0', 'yuGnXxfjEFzPzZLaSPIUQbY0rvz3sXTXG9uliZKrsHs=', 'ab exercitationem modi', 'Sed illo porro natus excepturi maiores. Architecto saepe occaecati ea tenetur ratione culpa doloribus. Et aliquam aut vel soluta.', 171.00, 1, 'Saepe explicabo ut non aut quibusdam et. Quasi facere ab qui assumenda dolorem. Modi est ut praesentium.', 2, '2023-04-07 14:27:32', '2023-04-07 14:27:32'),
('ee8c1097-7737-35ba-aee7-a01d623f00c9', '0', 'qT8jbUwPmXInAW7icvHn63k6msS5TUUUOnRb6IUa+qk=', 'velit minus nihil', 'Voluptatem cupiditate asperiores dolorem sunt illum. Asperiores minus error vel ut nulla.', 532.00, 0, '', 5, '2023-04-07 14:27:32', '2023-04-07 14:27:32'),
('fa359b10-322a-3f5d-94d2-9b4309d17bed', '0', 'McNnLT1AuCyERcxOGG3K8WUeHsnh+gc1jhL37Oxf+o4=', 'sunt molestiae ut', 'Dignissimos maxime eligendi quibusdam aspernatur quisquam occaecati. Odio et voluptatem perspiciatis asperiores. Totam vel eos nam est.', 448.00, 0, '', 4, '2023-04-07 14:27:32', '2023-04-07 14:27:32'),
('6508685e-f50f-3f28-b2a0-5c8f89ccc6da', '0', 'HDJmnQaMUvq5JxcdXVw1yByHUSx4uVb+3QvhbGa9CtE=', 'ea nihil ad', 'Doloremque officia eum libero modi id. Animi voluptas sunt sit laboriosam autem repudiandae. Sint ex a quia tempore et aspernatur commodi.', 310.00, 0, '', 3, '2023-04-07 14:28:37', '2023-04-07 14:28:37'),
('cc1e57ad-6088-3c76-a549-3ffd91584e8c', '0', 'azILq200m6DFANy4uFuck2CsGCmGXRzU78XyU4enBVs=', 'unde itaque fuga', 'Commodi cumque qui distinctio alias accusamus autem. Consequatur quod qui sed sint illo. Ut beatae eum perspiciatis nesciunt nulla quia ea. Perferendis ut omnis sunt autem.', 195.00, 1, 'Id voluptatem possimus provident ut et. Sequi consequuntur eaque commodi quo reiciendis minima sequi. Laboriosam aperiam voluptate et aut distinctio iure. Quidem dolor sed et earum.', 1, '2023-04-07 14:28:37', '2023-04-07 14:28:37'),
('91ffe968-97d3-3f41-a01c-20a5b10578ca', '0', 'iTx3URmDgd8lH4toWJfUH9XTfUrXXhzhS5HgiK2U9aU=', 'repudiandae incidunt qui', 'Soluta dicta eos corrupti est eveniet fuga qui beatae. Qui qui iure libero maiores. Dolor qui voluptate a nisi magnam fugiat nobis delectus.', 63.00, 1, 'Eos odit est eum vitae esse. Ex fugit et harum est molestias. Accusantium aperiam facere molestias dolores hic. Voluptatem omnis totam iure sint esse.', 5, '2023-04-07 14:28:37', '2023-04-07 14:28:37'),
('084197a0-1297-3a87-815d-368ef3262c41', '0', '9eZYVii3cbH1l4tJm4gQq416xpy4cbKY5b94EmVA52A=', 'velit repellendus fugiat', 'Ea beatae ad at culpa vel. Est rem est fugit sed laborum. Illo quidem maxime culpa eligendi praesentium et.', 120.00, 0, '', 3, '2023-04-07 14:28:37', '2023-04-07 14:28:37'),
('652f39a2-2b18-322e-a4fb-240c6eb95474', '0', '/c+T0cm+O9GRftyTQKoPatH+iEvELfvvXl1J663s4zw=', 'officiis et sunt', 'Amet eligendi sed sint culpa consequatur rerum fugiat. Dolorem officiis maxime neque et commodi sint omnis et.', 329.00, 0, '', 3, '2023-04-07 14:28:37', '2023-04-07 14:28:37'),
('40754dbc-edda-30c0-ba73-856668e210fc', '0', 'bK5rpyBhLc4shd6p7v5CtFrNjf5n1t7ybdhcPUgWGN4=', 'omnis similique necessitatibus', 'Sint est aspernatur recusandae officia vel temporibus incidunt unde. Quibusdam est minus quia recusandae facilis ut laborum. Minima tempore rerum sed fugiat reiciendis officiis aut. Ipsa odio et provident ipsum qui eos et.', 191.00, 1, 'Quam sed nobis nobis sint quaerat. Similique aut quis explicabo praesentium voluptas qui quia quasi.', 4, '2023-04-07 14:28:37', '2023-04-07 14:28:37'),
('a35af8c0-8d9d-3a76-bae0-23fec63f9ede', '0', 'IU8FuBpwCEH5KQ3++eAWmYHTkj8VG16qpCH3ONBaebw=', 'ut id blanditiis', 'Quia molestiae assumenda dolores et illum qui. Laboriosam dignissimos culpa magnam accusantium. Et provident explicabo deserunt eius odio.', 147.00, 1, 'Quo dicta ullam quia dolore hic temporibus. Quaerat doloribus nemo debitis dolor pariatur.', 4, '2023-04-07 14:28:37', '2023-04-07 14:28:37'),
('99257e49-5346-3e2a-a544-57bc2d203e99', '0', 'Vrtk9CtV5cspNps++KSePuwSqs2k9hiU41hsQnvrFyA=', 'unde corrupti non', 'Animi vel ea rem sed vel. Quas accusantium quibusdam in dolorem asperiores veniam magni. Deserunt qui quis sunt.', 250.00, 1, 'Consequuntur natus nemo amet ipsum. Quaerat quo qui vero qui incidunt ipsam culpa. Est ipsam dolorum voluptatem mollitia. Inventore occaecati est ipsum rem adipisci repellat ab quae.', 5, '2023-04-07 14:28:37', '2023-04-07 14:28:37'),
('1ca33455-6c2c-3980-9860-d30f660f8e84', '0', 'UL/6teWxGluzyMaZfYYY4RLtd3uVnRwcBfpfaLbwvUA=', 'vel adipisci aut', 'Rerum dicta architecto enim maxime ea. Laborum officia dignissimos amet qui. Culpa provident cupiditate eaque iste cum non.', 46.00, 0, '', 1, '2023-04-07 14:28:37', '2023-04-07 14:28:37'),
('d407e6f6-5520-3803-95ad-ed77c86757a3', '0', 'dY9nek1mwd6NtHy53gJYtSuJwTTtTt+fdlXiIvmxfUY=', 'consectetur inventore eaque', 'Doloribus est porro neque explicabo quidem perferendis. Blanditiis libero rerum voluptas sit quis ut atque corrupti. Et libero nobis pariatur reprehenderit. Soluta quis qui aliquid eius nihil.', 390.00, 0, '', 5, '2023-04-07 14:28:37', '2023-04-07 14:28:37'),
('244898ea-6eb0-3146-aa70-e06f8236ad05', '0', 'UD+2h4uvh21ClLbN0ZMRm1whEGylxSMKqvtakozimPs=', 'eos occaecati ut', 'Sed nihil id possimus tenetur labore id enim. Consequatur molestiae dignissimos assumenda eveniet eos velit voluptatem. Quas vero placeat dolorem aperiam.', 155.00, 1, 'Et deleniti molestiae nam rerum quo. Laboriosam accusamus eligendi officiis assumenda distinctio. Enim culpa dolorem explicabo ex ex animi.', 1, '2023-04-07 14:28:37', '2023-04-07 14:28:37'),
('2903170b-963c-3836-ad51-12732309f360', '0', 'fphoLEPK+4xwuy8lu1z7zX1ZMZzozjjSorQMSg1hTJE=', 'perferendis sapiente qui', 'Hic nihil cupiditate et quo ut omnis et cum. Assumenda modi animi et quia. In et expedita voluptatem pariatur a.', 114.00, 0, '', 5, '2023-04-07 14:28:37', '2023-04-07 14:28:37'),
('aaf4d59a-f362-4fb8-b630-943409da57be', '0', '+tZranMUl2+CzT+ebU1UDZk7UsWBJbYS3lOdN3rVOts=', 'testbox', 'une box de test classique', 0.00, 0, '', 2, '2023-06-13 07:35:29', '2023-06-13 07:35:29');

-- --------------------------------------------------------

--
-- Structure de la table `box2presta`
--

CREATE TABLE `box2presta` (
  `box_id` varchar(128) NOT NULL,
  `presta_id` varchar(128) NOT NULL,
  `quantite` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Déchargement des données de la table `box2presta`
--

INSERT INTO `box2presta` (`box_id`, `presta_id`, `quantite`, `date`) VALUES
('360bb4cc-e092-3f00-9eae-774053730cb2', '4cca8b8e-0244-499b-8247-d217a4bc542d', 2, '2023-06-12'),
('360bb4cc-e092-3f00-9eae-774053730cb2', '14872d96-97d6-4a9f-8a28-463886fea622', 1, '2023-06-12'),
('6cc74b9f-43bc-3f63-a9c4-9158ad83f379', '14872d96-97d6-4a9f-8a28-463886fea622', 1, '2023-06-12'),
('6cc74b9f-43bc-3f63-a9c4-9158ad83f379', '95a72f23-2ee7-4cbe-98d0-3d372102fcae', 1, '2023-06-12'),
('24fc3203-dbd0-3b61-801f-2f552b50603f', '991fef91-944d-4993-bbde-ee9a74fe2f36', 3, '2023-06-12'),
('aaf4d59a-f362-4fb8-b630-943409da57be', '14c4c6d1-d4a4-408a-acd7-a130b5e529da', 1, '2023-06-13'),
('aaf4d59a-f362-4fb8-b630-943409da57be', '85ec08bf-ebbf-4d4c-bf7f-a9280817ce51', 1, '2023-06-13'),
('aaf4d59a-f362-4fb8-b630-943409da57be', '1fde0834-f834-49ea-89ba-26c7695a04e0', 1, '2023-06-13');

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id` int(11) NOT NULL,
  `libelle` varchar(128) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id`, `libelle`, `description`) VALUES
(1, 'restauration', 'restaurant, en cas, sur le pouce, livré ... toutes les façons de manger.'),
(2, 'hébergement', 'hôtel, chambre d\'hôte, cabane dans les bois, appart\'hotel, ...'),
(3, 'attention', 'les petits plus qui font la différence : fleurs, chocolats, souvenirs'),
(4, 'activité', 'culture, sport, bien être, détente, visite ... toutes les activités sont là.');

-- --------------------------------------------------------

--
-- Structure de la table `prestation`
--

CREATE TABLE `prestation` (
  `id` varchar(128) NOT NULL,
  `libelle` varchar(128) NOT NULL,
  `description` text NOT NULL,
  `url` varchar(256) DEFAULT NULL,
  `unite` varchar(128) DEFAULT NULL,
  `tarif` decimal(10,2) NOT NULL,
  `img` varchar(128) NOT NULL,
  `cat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Déchargement des données de la table `prestation`
--

INSERT INTO `prestation` (`id`, `libelle`, `description`, `url`, `unite`, `tarif`, `img`, `cat_id`) VALUES
('4cca8b8e-0244-499b-8247-d217a4bc542d', 'Champagne', 'Bouteille de champagne + flutes + jeux à gratter', NULL, '1 bouteille, 4 flutes, 4 jeux', 20.00, 'champagne.jpg', 3),
('14872d96-97d6-4a9f-8a28-463886fea622', 'Musique', 'Partitions de piano à 4 mains', NULL, '2 partitions', 25.00, 'musique.jpg', 3),
('63cdce06-cd63-4fbe-9695-885d3cb64c7b', 'Exposition', 'Visite guidée de l’exposition ‘REGARDER’ à la galerie Poirel', NULL, 'visite pour 1 personne', 14.00, 'poirelregarder.jpg', 4),
('74af082e-4ed4-4c63-9fd3-602a5349c442', 'Goûter', 'Goûter au FIFNL', NULL, 'gouter pour 1 personne', 20.00, 'gouter.jpg', 1),
('b15503a1-9694-485d-a336-874860a3b664', 'Projection', 'Projection courts-métrages au FIFNL', NULL, '1 entree categorie A', 10.00, 'film.jpg', 3),
('a277c67f-eb06-40a3-bc06-0d067159e886', 'Bouquet', 'Bouquet de roses et Mots de Marion Renaud', NULL, NULL, 16.00, 'rose.jpg', 3),
('8854b992-aa48-4ef7-9048-2d92a8f1a1bb', 'Diner Stanislas', 'Diner à La Table du Bon Roi Stanislas (Apéritif /Entrée / Plat / Vin / Dessert / Café / Digestif)', NULL, NULL, 60.00, 'bonroi.jpg', 1),
('991fef91-944d-4993-bbde-ee9a74fe2f36', 'Origami', 'Baguettes magiques en Origami en buvant un thé', NULL, NULL, 12.00, 'origami.jpg', 4),
('01d57b87-8c0f-4ef1-8ce5-b6b82d4a8ec5', 'Livres', 'Livre bricolage avec petits-enfants + Roman', NULL, NULL, 24.00, 'bricolage.jpg', 3),
('95a72f23-2ee7-4cbe-98d0-3d372102fcae', 'Diner  Grand Rue ', 'Diner au Grand’Ru(e) (Apéritif / Entrée / Plat / Vin / Dessert / Café)', NULL, NULL, 59.00, 'grandrue.jpg', 1),
('faa3b035-4d22-4a13-a1a7-3b6e19883bd7', 'Visite guidée', 'Visite guidée personnalisée de Saint-Epvre jusqu’à Stanislas', NULL, NULL, 11.00, 'place.jpg', 4),
('a5cecbd8-d64f-4146-8770-2fa3d63edbf3', 'Bijoux', 'Bijoux de manteau + Sous-verre pochette de disque + Lait après-soleil', NULL, NULL, 29.00, 'bijoux.jpg', 3),
('b8559a26-74e1-47e6-8028-aa6ded071d86', 'Opéra', 'Concert commenté à l’Opéra', NULL, NULL, 15.00, 'opera.jpg', 4),
('17834c03-5aab-41ab-85c1-05e12290b1d0', 'Thé Hotel de la reine', 'Thé de debriefing au bar de l’Hotel de la reine', NULL, NULL, 5.00, 'hotelreine.gif', 1),
('3508f806-45ec-4092-9546-4bcdd26533c0', 'Jeu connaissance', 'Jeu pour faire connaissance', NULL, NULL, 6.00, 'connaissance.jpg', 4),
('1fde0834-f834-49ea-89ba-26c7695a04e0', 'Diner', 'Diner (Apéritif / Plat / Vin / Dessert / Café)', NULL, NULL, 40.00, 'diner.jpg', 1),
('773ea293-a779-4047-ae52-af2edac531ff', 'Cadeaux individuels', 'Cadeaux individuels sur le thème de la soirée', NULL, NULL, 13.00, 'cadeaux.jpg', 3),
('af272cf7-6e6b-4978-9e9d-8c40e989bf6c', 'Animation', 'Activité animée par un intervenant extérieur', NULL, NULL, 9.00, 'animateur.jpg', 4),
('85ec08bf-ebbf-4d4c-bf7f-a9280817ce51', 'Jeu contacts', 'Jeu pour échange de contacts', NULL, NULL, 5.00, 'contact.png', 4),
('f60320cb-68d2-48b3-b5a2-a6d67ce0cb23', 'Cocktail', 'Cocktail de fin de soirée', NULL, NULL, 12.00, 'cocktail.jpg', 1),
('162c527f-1e2f-4d91-ac84-3311a2085c09', 'Star Wars', 'Star Wars - Le Réveil de la Force. Séance cinéma 3D', NULL, NULL, 12.00, 'starwars.jpg', 4),
('badf0dcb-5a93-4ed7-9eb1-feeb46020617', 'Concert', 'Un concert à Nancy', NULL, NULL, 17.00, 'concert.jpg', 4),
('14c4c6d1-d4a4-408a-acd7-a130b5e529da', 'Appart Hotel', 'Appart’hôtel Coeur de Ville, en plein centre-ville', NULL, NULL, 56.00, 'apparthotel.jpg', 2),
('38888d1e-d408-4e01-a0e6-05a966e348ea', 'Hôtel d\'Haussonville', 'Hôtel d\'Haussonville, au coeur de la Vieille ville à deux pas de la place Stanislas', NULL, NULL, 169.00, 'hotel_haussonville_logo.jpg', 2),
('0abe4736-88ca-457a-b58f-a8234569b5fe', 'Boite de nuit', 'Discothèque, Boîte tendance avec des soirées à thème & DJ invités', NULL, NULL, 32.00, 'boitedenuit.jpg', 4),
('e8785174-b670-4c8b-ba0a-b779aa69b4c1', 'Planètes Laser', 'Laser game : Gilet électronique et pistolet laser comme matériel, vous voilà équipé.', NULL, NULL, 15.00, 'laser.jpg', 4),
('6ad840b8-62df-49fe-8220-0b840f8c3d9e', 'Fort Aventure', 'Découvrez Fort Aventure à Bainville-sur-Madon, un site Accropierre unique en Lorraine ! Des Parcours Acrobatiques pour petits et grands, Jeu Mission Aventure, Crypte de Crapahute, Tyrolienne, Saut à l\'élastique inversé, Toboggan géant... et bien plus encore.', NULL, NULL, 25.00, 'fort.jpg', 4);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`email`, `password`, `nom`, `prenom`) VALUES
('tbrin@mail.com', '$2y$10$3yAtW2VlNZpjY.ZtsyG4aegJHjODavb6cZUWbrVleIj3z5HwmdVdO', 'Brindejonc', 'Timothée'),
('user1@mail.com', '$2y$10$SmuvlqS0tpa4qpiUlRq7Ku9cCR5iEH4c/AJPucKy0YsC3gVCoGcSS', 'nom_user1', 'prenom_user1');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
