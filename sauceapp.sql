-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 28 mars 2025 à 22:29
-- Version du serveur : 9.1.0
-- Version de PHP : 8.4.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `sauceapp`
--

-- --------------------------------------------------------

--
-- Structure de la table `cache`
--

DROP TABLE IF EXISTS `cache`;
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel_cache_manon.kleinpol12@gmail.com|127.0.0.1:timer', 'i:1742979291;', 1742979291),
('laravel_cache_manon.kleinpol12@gmail.com|127.0.0.1', 'i:1;', 1742979291);

-- --------------------------------------------------------

--
-- Structure de la table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_03_18_132254_create_sauces_table', 1);

-- --------------------------------------------------------

--
-- Structure de la table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('manon.kleinpol12@gmail.com', '$2y$12$RgcLiUCQjR8GmxfJ3iXfQe2fCV1JkZO6PAzMUhvPJT5cgsTMstgnC', '2025-03-24 12:07:08');

-- --------------------------------------------------------

--
-- Structure de la table `sauces`
--

DROP TABLE IF EXISTS `sauces`;
CREATE TABLE IF NOT EXISTS `sauces` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `userId` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `manufacturer` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `mainPepper` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `imageUrl` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `heat` int NOT NULL,
  `likes` int NOT NULL DEFAULT '0',
  `dislikes` int NOT NULL DEFAULT '0',
  `usersLiked` json DEFAULT NULL,
  `usersDisliked` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `sauces`
--

INSERT INTO `sauces` (`id`, `userId`, `name`, `manufacturer`, `description`, `mainPepper`, `imageUrl`, `heat`, `likes`, `dislikes`, `usersLiked`, `usersDisliked`, `created_at`, `updated_at`) VALUES
(1, 1, 'Ghost Pepper Inferno', 'Spicy Co.', 'Une sauce ultra-piquante à base de piment fantôme.', 'Ghost Pepper', 'images/1742905904.webp', 10, 15, 3, '[\"2\", \"3\", \"4\"]', '[\"5\", 1]', '2025-03-18 14:43:53', '2025-03-25 11:31:44'),
(2, 1, 'Jalapeño Delight', 'Green Heat', 'Une sauce douce et savoureuse avec une touche de jalapeño.', 'Jalapeño', 'images/1742907599.jpg', 4, 8, 2, '[\"1\", \"3\"]', '[\"5\", 2]', '2025-03-18 14:43:53', '2025-03-25 11:59:59'),
(3, 1, 'Caribbean Fire', 'Tropical Spice', 'Un mélange de piments habanero et de mangue pour une saveur sucrée-épicée.', 'Habanero', 'images/1742906022.webp', 7, 20, 3, '[\"1\", \"2\", \"5\"]', '[\"4\"]', '2025-03-18 14:43:53', '2025-03-25 11:33:42'),
(4, 1, 'Classic Buffalo', 'Buffalo Sauce Co.', 'Une sauce buffalo traditionnelle parfaite pour les ailes de poulet.', 'Cayenne', 'images/1742842094.jpg', 5, 12, 1, '[\"3\", \"4\"]', '[5]', '2025-03-18 14:43:53', '2025-03-24 19:02:09'),
(5, 1, 'Extreme Carolina Reaper', 'Burning Hot', 'Une sauce extrême pour les amateurs de sensations fortes avec du Carolina Reaper.', 'Carolina Reaper', 'images/1742906145.jpg', 10, 25, 5, '[\"1\", \"2\", \"3\", \"4\", \"5\"]', '[\"6\"]', '2025-03-18 14:43:53', '2025-03-25 11:35:45'),
(19, 8, '🔥La sauce mega ultra piquante🔥', 'moi', 'sa pik for🔥🌶️🔥🌶️🔥🌶️🔥🌶️', 'piment d\'espelette🌶️', 'images/1742905731.jpg', 10, 2, 0, '[8, 1]', '[]', '2025-03-25 08:22:04', '2025-03-26 07:54:42'),
(9, 2, 'Sriracha', 'Huy Fong Foods', 'A popular Thai-style hot sauce made with chili, garlic, sugar, and vinegar.', 'Chili peppers', 'images/1742907397.webp', 5, 1, 1, '[3]', '[5]', '2025-03-24 19:48:32', '2025-03-25 11:56:37'),
(10, 2, 'Tabasco', 'McIlhenny Company', 'One of the most well-known hot sauces worldwide, offering a tangy heat with a vinegar base.', 'Tabasco peppers', 'images/1742846246.jpg', 7, 0, 2, '[]', '[3, 5]', '2025-03-24 19:48:32', '2025-03-24 19:02:23'),
(11, 3, 'Frank\'s RedHot', 'McCormick & Company', 'A staple for buffalo wings, it has a tangy, buttery flavor with a moderate heat.', 'Cayenne pepper', 'images/1742846391.jpg', 5, 2, 0, '[3, 5]', '[]', '2025-03-24 19:48:32', '2025-03-24 19:02:15'),
(12, 3, 'Cholula', 'Cholula Food Company', 'A Mexican hot sauce known for its balanced flavor of spice and tang.', 'Arbol and Piquin peppers', 'images/1742906687.webp', 3, 1, 0, '[3]', '[]', '2025-03-24 19:48:32', '2025-03-25 11:44:48'),
(13, 4, 'La Costeña', 'La Costeña', 'A versatile Mexican hot sauce with a nice blend of heat and vinegar.', 'Jalapeño', 'images/1742907986.jpg', 5, 1, 0, '[3]', '[]', '2025-03-24 19:48:32', '2025-03-25 12:06:26'),
(14, 4, 'Tapatío', 'Tapatío Foods', 'A Mexican sauce offering a blend of spices and heat perfect for tacos and more.', 'Red chili peppers', 'images/1742908393.jpg', 7, 1, 1, '[5]', '[3]', '2025-03-24 19:48:32', '2025-03-25 12:13:13'),
(15, 5, 'Caribbean Choice (Scotch Bonnet)', 'Various brands', 'A hot Caribbean sauce made from scotch bonnet peppers, known for its fiery heat and fruity flavor.', 'Scotch bonnet pepper', 'images/1742908213.jpg', 9, 0, 1, '[]', '[5]', '2025-03-24 19:48:32', '2025-03-25 12:10:13'),
(16, 5, 'Habanero Sauce', 'Various brands', 'Made from the intensely hot habanero pepper, this sauce brings a strong kick of heat and a fruity, floral flavor.', 'Habanero', 'images/1742981154.jpg', 9, 2, 0, '[5, 8]', '[]', '2025-03-24 19:48:32', '2025-03-26 08:25:54'),
(17, 3, 'Blair\'s Ultra Death Sauce', 'Blair\'s Sauces & Snacks', 'Known for its incredibly intense heat, this sauce is one of the hottest commercially available.', 'Habanero and Pepper Extract', 'images/1742846331.jpg', 10, 1, 0, '[5]', '[]', '2025-03-24 19:48:32', '2025-03-24 19:04:13'),
(18, 4, 'Mad Dog 357', 'The Sauce Crafters, Inc.', 'A super-hot sauce made from the world\'s hottest peppers, including pepper extracts for an extreme level of heat.', 'Habanero, Pepper Extract', 'images/1742846084.jpg', 10, 1, 0, '[5]', '[]', '2025-03-24 19:48:32', '2025-03-24 19:02:43');

-- --------------------------------------------------------

--
-- Structure de la table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('NrXdltE4mJLKgj98A5BNDT7aKSAb3gHt6lOpgroE', NULL, '127.0.0.1', 'PostmanRuntime/7.43.2', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUWF1QzB5VUg0QkU2dVhHRTdjQzZCTmlHTm00MXhNSUt0NUhGU21JZyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODA4MC9teS1zYXVjZXMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1743173419),
('xX8qsfgvzGXL3AIeYZeYC2uQeQWwatJXrGsuDiU6', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiSElBRE5ncWtrZVVTU0FxaUMwQW1QZndYNGUzeFZlV2duYUdEckZxViI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly9sb2NhbGhvc3Q6ODA4MC9zYXVjZXM/cGFnZT0xIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjQ6ImF1dGgiO2E6MTp7czoyMToicGFzc3dvcmRfY29uZmlybWVkX2F0IjtpOjE3NDMxNzE4MjQ7fX0=', 1743173876);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Jane Doe', 'janedoe@gmail.com', NULL, '$2y$12$UjD9wPgLuTSD.wduReSV/ejK561IOlARQGa3YtqtX0tqwW6xFEO.m', '', '2025-03-18 13:30:48', '2025-03-18 13:30:48'),
(8, 'Edgar', 'emartin022@iutbayonne.univ-pau.fr', NULL, '$2y$12$yIUzrhRsdXPYly3TJWCUR.o5pmbLCS9Ges8Kk2rXHsPVu/iYJDXlO', NULL, '2025-03-25 08:17:30', '2025-03-25 08:17:30'),
(2, 'Yamada Hana', 'yamadahana@gmail.com', NULL, '$2y$12$xWIab63CnC/UVFZOySMyju71zn4/sSkLc2.SfKFlBKpi4Il3UM5i.', NULL, '2025-03-24 18:30:55', '2025-03-24 18:30:55'),
(3, 'John Doe', 'johndoe@gmail.com', NULL, '$2y$12$thAgsnXppUGncDv/HhHZ8./R1KylLZf/2hUj4wqzTKA0572LzSQPC', NULL, '2025-03-24 18:43:04', '2025-03-24 18:43:04'),
(5, 'Erika Mustermann', 'erikamustermann@gmail.com', NULL, '$2y$12$geDoROLzy8trpAjQM4vyouKSO.TWKZ1rx/8qtmulZq1kuBCKK.D66', NULL, '2025-03-24 18:38:21', '2025-03-24 18:38:21'),
(4, 'Pierre Dupont', 'pierredupont@gmail.com', NULL, '$2y$12$74Acd85vJm7qnTbwVzeITO/CqvpWMbbXi9knHzhVNcdS.L2EGoTRK', NULL, '2025-03-24 18:39:44', '2025-03-24 18:39:44'),
(9, 'lea', 'lea@gmail.com', NULL, '$2y$12$Ed0sgsilaNPU1LxbdTmcqOpOODI9rHwOa0RAyNyCFYE9E62pczcW2', NULL, '2025-03-26 08:32:21', '2025-03-26 08:32:21');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
