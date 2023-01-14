-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 14 jan. 2023 à 17:44
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `dev_movies_ticket_`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'action', 'film action', '2023-01-01 17:11:49', NULL),
(4, 'comedy', 'desc comedy', '2023-01-06 23:00:00', NULL),
(5, 'anime', 'desc anime', '2023-01-09 23:00:00', NULL),
(19, 'Drame', 'desc drama', NULL, '2023-01-11 15:51:43'),
(20, 'test category', 'desc', '2023-01-14 07:55:27', '2023-01-14 07:55:27');

-- --------------------------------------------------------

--
-- Structure de la table `films`
--

CREATE TABLE `films` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `duree` varchar(255) NOT NULL,
  `anne` varchar(255) NOT NULL,
  `projection` tinyint(1) NOT NULL,
  `categories_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(100) NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `films`
--

INSERT INTO `films` (`id`, `name`, `description`, `duree`, `anne`, `projection`, `categories_id`, `image`, `created_at`, `updated_at`) VALUES
(29, 'Dune', 'The story of the Czech hero Zizka, also called Jan Zizka of Trocnov, his relationship with a local heiress and his fight against a rival king. A revered military tactician who defeated the armies of the Teutonic Order and the Holy Roman Empire,', '120', '2021', 1, 1, 'https://www.themoviedb.org/t/p/w600_and_h900_bestv2/d5NXSklXo0qyIYkgV94XAgMIckC.jpg', '2020-10-21', '2023-01-11 13:35:31'),
(30, 'Lion', 'L\'histoire du héros tchèque Zizka, aussi appelé Jan Zizka de Trocnov, sa relation avec une héritière locale et son combat contre un roi rival. Tacticien militaire vénéré qui a vaincu les armées de l\'ordre teutonique et du Saint-Empire romain germanique, i', '120', '2016', 1, 19, 'https://www.themoviedb.org/t/p/w1280/kCELJH1tCmaRLqvwIgKDb09aEaw.jpg', '2016-11-25', '2023-01-11 15:48:30'),
(31, 'Eternals', 'L\'histoire du héros tchèque Zizka, aussi appelé Jan Zizka de Trocnov, sa relation avec une héritière locale et son combat contre un roi rival. Tacticien militaire vénéré qui a vaincu les armées de l\'ordre teutonique et du Saint-Empire romain germanique, i', '160', '2021', 1, 1, 'https://www.themoviedb.org/t/p/w1280/bcCBq9N1EMo3daNIjWJ8kYvrQm6.jpg', NULL, '2023-01-11 15:58:37'),
(32, 'Death on the Nile', 'L\'histoire du héros tchèque Zizka, aussi appelé Jan Zizka de Trocnov, sa relation avec une héritière locale et son combat contre un roi rival. Tacticien militaire vénéré qui a vaincu les armées de l\'ordre teutonique et du Saint-Empire romain germanique, i', '150', '2022', 0, 1, 'https://www.themoviedb.org/t/p/w1280/oT4vRVzulbN72602tTPFCwotl7a.jpg', NULL, '2023-01-11 16:05:13'),
(33, 'One Shot', 'The story of the Czech hero Zizka, also called Jan Zizka of Trocnov, his relationship with a local heiress and his fight against a rival king. A revered military tactician who defeated the armies of the Teutonic Order and the Holy Roman Empire,', '140', '2021', 1, 1, 'https://www.themoviedb.org/t/p/w1280/3OXiTjU30gWtqxmx4BU9RVp2OTv.jpg', NULL, '2023-01-11 16:07:17'),
(34, 'Medieval', 'L\'histoire du héros tchèque Zizka, aussi appelé Jan Zizka de Trocnov, sa relation avec une héritière locale et son combat contre un roi rival. Tacticien militaire vénéré qui a vaincu les armées de l\'ordre teutonique et du Saint-Empire romain germanique, i', '120', '2022', 1, 1, 'https://www.themoviedb.org/t/p/original/eeUNWsdoiOijOZAMaWFDA5Pb1n8.jpg', '2023-01-13', '2023-01-13 20:58:27'),
(35, 'Medieval', 'The story of the Czech hero Zizka, also called Jan Zizka of Trocnov, his relationship with a local heiress and his fight against a rival king. A revered military tactician who defeated the armies of the Teutonic Order and the Holy Roman Empire', '130', '2022', 0, 1, 'https://www.themoviedb.org/t/p/original/eeUNWsdoiOijOZAMaWFDA5Pb1n8.jpg', '2023-01-13', '2023-01-13 20:59:45'),
(36, 'My Name Is Vendetta', 'Entre ses matchs de hockey, un sport dans lequel elle excelle, et ses leçons de conduite hors route, Sofia mène une vie d\'adolescente tranquille. Jusqu\'au jour où, désobéissant à Santo, son père, elle le prend secrètement en photo et publie le cliché sur ', '100', '2022', 0, 1, 'https://www.themoviedb.org/t/p/original/7l3war94J4tRyWUiLAGokr3ViF2.jpg', '2023-01-13', '2023-01-13 22:20:39'),
(37, 'Peaky Blinders', 'En 1919, à Birmingham, soldats, révolutionnaires politiques et criminels combattent pour se faire une place dans le paysage industriel de l\'après-Guerre. et criminels combattent pour se faire et criminels combattent pour se faire Le Parlement s\'attend à u', '120', '2013', 1, 1, 'https://www.themoviedb.org/t/p/original/vUUqzWa2LnHIVqkaKVlVGkVcZIW.jpg', '2023-01-14', '2023-01-14 00:17:34'),
(38, 'Baby Boss Le Bonus de Noel', 'The story of the Czech hero Zizka, also called Jan Zizka of Trocnov, his relationship with a local heiress and his fight against a rival king. A revered military tactician who defeated the armies of the Teutonic Order and the Holy Roman Empire,', '150', '2022', 1, 1, 'https://www.themoviedb.org/t/p/original/9HO86wbLOmwkYd1SxUiJ2lPR5ag.jpg', '2023-01-14', '2023-01-14 00:19:48'),
(39, 'A l\'ouest rien de nouveau', 'The story of the Czech hero Zizka, also called Jan Zizka of Trocnov, his relationship with a local heiress and his fight against a rival king. A revered military tactician who defeated the armies of the Teutonic Order and the Holy Roman Empire,', '130', '2022', 1, 1, 'https://www.themoviedb.org/t/p/original/qS6lVMc53jiEtlOAFSRxFGSa5pN.jpg', '2023-01-14', '2023-01-14 00:23:55'),
(40, 'The Batman', 'The story of the Czech hero Zizka, also called Jan Zizka of Trocnov, his relationship with a local heiress and his fight against a rival king. A revered military tactician who defeated the armies of the Teutonic Order and the Holy Roman Empire . A revered', '150', '2021', 1, 1, 'https://www.themoviedb.org/t/p/original/t9JGg10CW1DzXEdWL54ewkUko6N.jpg', '2023-01-14', '2023-01-14 00:26:32'),
(41, 'Filiere criminelle', 'L\'histoire du héros tchèque Zizka, aussi appelé Jan Zizka de Trocnov, sa relation avec une héritière locale et son combat contre un roi rival. Tacticien militaire vénéré qui a vaincu les armées de l\'ordre teutonique et du Saint-Empire romain germanique', '140', '2022', 0, 1, 'https://www.themoviedb.org/t/p/original/dWIcHswussFS5ntobBytmYg0trN.jpg', '2023-01-14', '2023-01-14 00:28:11'),
(42, 'Alice In Borderland', 'The story of the Czech hero Zizka, also called Jan Zizka of Trocnov, his relationship with a local heiress and his fight against a rival king. Revered military tactician who defeated the armies of the Teutonic Order and the Holy Roman Empire', '150', '2022', 0, 1, 'https://www.themoviedb.org/t/p/original/217V9dhelgjELLZGawTmRJ0NNb7.jpg', '2023-01-14', '2023-01-14 00:30:05'),
(43, 'Blowback', 'The story of the Czech hero Zizka, also called Jan Zizka of Trocnov, his relationship with a local heiress and his fight against a rival king. A revered military tactician who defeated the armies of the Teutonic Order and the Holy Roman Empire,', '120', '2022', 0, 1, 'https://www.themoviedb.org/t/p/original/fHQHC32dhom8u0OxC2hs2gYQh0M.jpg', '2023-01-14', '2023-01-14 00:32:37'),
(44, 'Rick et Morty', 'The story of the Czech hero Zizka, also called Jan Zizka of  Trocnov, his relationship with a local heiress and his fight  against a rival king. A revered military tactician who defeated  the armies of the Teutonic Order and the Holy Roman Empire', '120', '2013', 1, 1, 'https://www.themoviedb.org/t/p/original/s11re4xQLZ6pRPv2sqXnK8CCvGn.jpg', '2023-01-14', '2023-01-14 07:53:57');

-- --------------------------------------------------------

--
-- Structure de la table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_card` varchar(255) NOT NULL,
  `number_card` varchar(255) NOT NULL,
  `expiry_date` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `programmes`
--

CREATE TABLE `programmes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `films_id` bigint(20) UNSIGNED NOT NULL,
  `salles_id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `prix` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `programmes`
--

INSERT INTO `programmes` (`id`, `films_id`, `salles_id`, `date`, `time`, `prix`, `created_at`, `updated_at`) VALUES
(10, 29, 1, '2023-01-14', '22:00:00', 100, '2023-01-12 19:49:54', '2023-01-12 19:49:54'),
(11, 29, 1, '2023-01-14', '17:40:00', 200, '2023-01-13 11:40:27', '2023-01-13 11:40:27'),
(12, 34, 3, '2023-01-14', '22:00:00', 200, '2023-01-13 21:04:24', '2023-01-13 21:04:24'),
(13, 40, 3, '2023-01-15', '04:00:00', 150, '2023-01-14 00:39:21', '2023-01-14 00:39:21'),
(14, 38, 3, '2023-01-15', '10:00:00', 100, '2023-01-14 00:40:13', '2023-01-14 00:40:13'),
(15, 39, 3, '2023-01-15', '06:00:00', 150, '2023-01-14 00:40:41', '2023-01-14 00:40:41'),
(16, 40, 3, '2023-01-15', '07:00:00', 200, '2023-01-14 00:41:08', '2023-01-14 00:41:08'),
(17, 44, 3, '2023-01-15', '00:00:00', 100, '2023-01-14 07:54:37', '2023-01-14 07:54:37');

-- --------------------------------------------------------

--
-- Structure de la table `reservations`
--

CREATE TABLE `reservations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `programmes_id` bigint(20) UNSIGNED NOT NULL,
  `users_id` bigint(20) UNSIGNED NOT NULL,
  `N_ticket` int(11) NOT NULL,
  `total_p` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `salles`
--

CREATE TABLE `salles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `place` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `salles`
--

INSERT INTO `salles` (`id`, `name`, `place`, `created_at`, `updated_at`) VALUES
(1, 'screan N1', 200, '2023-01-22 19:10:47', NULL),
(2, 'screan N2', 300, '2023-01-29 19:10:47', NULL),
(3, 'screan action', 159, '2023-01-10 19:10:47', NULL),
(6, 'screan action A', 311, '2023-01-05 15:32:27', '2023-01-05 15:32:27'),
(11, 'screan anime', 202, '2023-01-06 06:49:05', '2023-01-06 06:49:05'),
(13, 'screan comedy', 210, '2023-01-07 19:00:45', '2023-01-07 19:00:45'),
(14, 'dcrean test', 300, '2023-01-14 07:55:06', '2023-01-14 07:55:06');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `isAdmin` varchar(25) NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `isAdmin`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'hamza bekkaoui', 'bekkaouihamza86@gmail.com', NULL, 'password', 'admin', NULL, '2023-01-02 22:33:15', '2023-01-02 22:33:15'),
(5, 'test', 'khalid@bk.com', NULL, 'password', 'user', NULL, NULL, NULL),
(11, 'name', 'bekkaouihamza85@gmail.com', NULL, 'password', 'user', NULL, NULL, NULL),
(12, 'admin', 'admin@admin.com', NULL, 'password', 'user', NULL, NULL, NULL),
(13, 'user', 'user@gmail.com', NULL, 'password', 'user', NULL, NULL, NULL),
(14, 'walid el moumen', 'walidelmoumen2002@gmail.com', NULL, '123', 'user', NULL, NULL, NULL),
(15, 'walid', 'walid@gmail.com', NULL, 'password', 'user', NULL, NULL, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `films`
--
ALTER TABLE `films`
  ADD PRIMARY KEY (`id`),
  ADD KEY `films_categories_id_foreign` (`categories_id`);

--
-- Index pour la table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `programmes`
--
ALTER TABLE `programmes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `programmes_films_id_foreign` (`films_id`),
  ADD KEY `programmes_salles_id_foreign` (`salles_id`);

--
-- Index pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reservations_programmes_id_foreign` (`programmes_id`),
  ADD KEY `reservations_users_id_foreign` (`users_id`);

--
-- Index pour la table `salles`
--
ALTER TABLE `salles`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `films`
--
ALTER TABLE `films`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT pour la table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `programmes`
--
ALTER TABLE `programmes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `salles`
--
ALTER TABLE `salles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `films`
--
ALTER TABLE `films`
  ADD CONSTRAINT `films_categories_id_foreign` FOREIGN KEY (`categories_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `programmes`
--
ALTER TABLE `programmes`
  ADD CONSTRAINT `programmes_films_id_foreign` FOREIGN KEY (`films_id`) REFERENCES `films` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `programmes_salles_id_foreign` FOREIGN KEY (`salles_id`) REFERENCES `salles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_programmes_id_foreign` FOREIGN KEY (`programmes_id`) REFERENCES `programmes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservations_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
