-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : ocadesbgedo.mysql.db:3306
-- Généré le : sam. 18 nov. 2023 à 14:16
-- Version du serveur : 5.7.42-log
-- Version de PHP : 8.1.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ocadesbgedo`
--

-- --------------------------------------------------------

--
-- Structure de la table `activites`
--

CREATE TABLE `activites` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `libelle` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_realisation` date NOT NULL,
  `validate` tinyint(1) NOT NULL DEFAULT '0',
  `quantite_realise` int(11) DEFAULT NULL,
  `cout_total_realisation` double NOT NULL,
  `bene_d_homme` int(11) DEFAULT NULL,
  `bene_d_femme` int(11) DEFAULT NULL,
  `activite_previsionnelle_id` bigint(20) UNSIGNED NOT NULL,
  `paroisse_id` bigint(20) UNSIGNED NOT NULL,
  `domaine_id` bigint(20) UNSIGNED NOT NULL,
  `agent` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `observation` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unite_physique` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contrib_beneficiaire` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_beneficiaire` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `activite_previsionnelles`
--

CREATE TABLE `activite_previsionnelles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `libelle` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantite` int(11) NOT NULL DEFAULT '0',
  `cout` double DEFAULT NULL,
  `projet_previsionnel_id` bigint(20) UNSIGNED NOT NULL,
  `agent` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `date_realisation` date DEFAULT NULL,
  `bene_d_homme` int(11) DEFAULT NULL,
  `bene_d_femme` int(11) DEFAULT NULL,
  `region_id` bigint(20) UNSIGNED DEFAULT NULL,
  `domaine_id` bigint(20) UNSIGNED DEFAULT NULL,
  `observation` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unite_physique` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contrib_beneficiaire` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_beneficiaire` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `activite_prev_objectifs`
--

CREATE TABLE `activite_prev_objectifs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `activite_prev_id` bigint(20) UNSIGNED NOT NULL,
  `objectif_specifique_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `activite_views`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `activite_views` (
`id` bigint(20) unsigned
,`libelle` varchar(191)
,`date_realisation` date
,`unite_physique` varchar(191)
,`validate` tinyint(1)
,`quantite_realise` int(11)
,`cout_total_realisation` double
,`contrib_beneficiaire` varchar(191)
,`bene_d_homme` int(11)
,`bene_d_femme` int(11)
,`activite_previsionnelle_id` bigint(20) unsigned
,`paroisse_id` bigint(20) unsigned
,`domaine_id` bigint(20) unsigned
,`agent` bigint(20) unsigned
,`deleted_at` timestamp
,`created_at` timestamp
,`updated_at` timestamp
,`commune_id` bigint(20) unsigned
,`region_id` bigint(20) unsigned
,`province_id` bigint(20) unsigned
);

-- --------------------------------------------------------

--
-- Structure de la table `communes`
--

CREATE TABLE `communes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `commune` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `province_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `communes`
--

INSERT INTO `communes` (`id`, `commune`, `description`, `province_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Bagassi', 'Commune de Bagassi', 1, NULL, '2022-11-30 06:15:30', '2022-11-30 06:15:30'),
(2, 'Bana', 'Commune de Bana', 1, NULL, '2022-11-30 06:16:03', '2022-11-30 06:16:03'),
(3, 'Bekuy', 'Commune de Bekuy', 5, NULL, '2022-11-30 06:16:40', '2022-11-30 06:16:40'),
(4, 'Béréba', 'Commune de Béréba', 5, NULL, '2022-11-30 06:17:38', '2022-11-30 06:17:38'),
(5, 'Bondokuy', 'Commune de Bondokuy', 2, NULL, '2022-11-30 06:17:52', '2022-11-30 06:17:52'),
(6, 'Boni', 'Commune de Boni', 5, NULL, '2022-11-30 06:18:33', '2022-11-30 06:18:33'),
(7, 'Boromo', 'Commune de Boromo', 1, NULL, '2022-11-30 06:19:01', '2022-11-30 06:19:01'),
(8, 'Dédougou', 'Commune de Dédougou', 2, NULL, '2022-11-30 06:19:37', '2022-11-30 06:19:37'),
(9, 'Di', 'Commune de Di', 4, NULL, '2022-11-30 06:20:08', '2022-11-30 06:20:08'),
(10, 'Douroula', 'Commune de Douroula', 2, NULL, '2022-11-30 06:20:39', '2022-11-30 06:20:39'),
(11, 'Fara', 'Commune de Fara', 1, NULL, '2022-11-30 06:21:21', '2022-11-30 06:21:21'),
(12, 'Founzan', 'Commune de Founzan', 5, NULL, '2022-11-30 06:21:44', '2022-11-30 06:21:44'),
(13, 'Gassan', 'Commune de Gassan', 3, NULL, '2022-11-30 06:22:11', '2022-11-30 06:22:11'),
(14, 'Gomboro', 'Commune de Gomboro', 4, NULL, '2022-11-30 06:22:43', '2022-11-30 06:22:43'),
(15, 'Gossina', 'Commune de Gossina', 3, NULL, '2022-11-30 06:23:09', '2022-11-30 06:23:09'),
(16, 'Houndé', 'Commune de Houndé', 5, NULL, '2022-11-30 06:23:36', '2022-11-30 06:23:36'),
(17, 'Kassoum', 'Commune de Kassoum', 4, NULL, '2022-11-30 06:24:06', '2022-11-30 06:24:06'),
(18, 'Kiembara', 'Commune de Kiembara', 4, NULL, '2022-11-30 06:24:27', '2022-11-30 06:24:27'),
(19, 'Kona', 'Commune de Kona', 2, NULL, '2022-11-30 06:24:54', '2022-11-30 06:24:54'),
(20, 'Koti', 'Commune de Koti', 5, NULL, '2022-11-30 06:25:16', '2022-11-30 06:25:16'),
(21, 'Kougny', 'Commune de Kougny', 3, NULL, '2022-11-30 06:25:47', '2022-11-30 06:25:47'),
(22, 'Koumbia', 'Commune de Koumbia', 5, NULL, '2022-11-30 06:26:06', '2022-11-30 06:26:06'),
(23, 'Lanfiéra', 'Commune de Lanfiéra', 4, NULL, '2022-11-30 06:26:30', '2022-11-30 06:26:30'),
(24, 'Lankoué', 'Commune de Lankoué', 4, NULL, '2022-11-30 06:26:49', '2022-11-30 06:26:49'),
(25, 'Ouarkoye', 'Commune de Ouarkoye', 2, NULL, '2022-11-30 06:27:10', '2022-11-30 06:27:10'),
(26, 'Oury', 'Commune de Oury', 1, NULL, '2022-11-30 06:27:32', '2022-11-30 06:27:32'),
(27, 'Pâ', 'Commune de Pâ', 1, NULL, '2022-11-30 06:27:57', '2022-11-30 06:27:57'),
(28, 'Pompoie', 'Commune de Pompoie', 1, NULL, '2022-11-30 06:28:26', '2022-11-30 06:28:26'),
(29, 'Poura', 'Commune de Poura', 1, NULL, '2022-11-30 06:28:56', '2022-11-30 06:28:56'),
(30, 'Safané', 'Commune de Safané', 2, NULL, '2022-11-30 06:29:25', '2022-11-30 06:29:25'),
(31, 'Sibi', 'Commune de Sibi', 1, NULL, '2022-11-30 06:29:54', '2022-11-30 06:29:54'),
(32, 'Tchériba', 'Commune de Tchériba', 2, NULL, '2022-11-30 06:30:14', '2022-11-30 06:30:14'),
(33, 'Toéni', 'Commune de Toéni', 4, NULL, '2022-11-30 06:30:36', '2022-11-30 06:30:36'),
(34, 'Toma', 'Commune de Toma', 3, NULL, '2022-11-30 06:31:00', '2022-11-30 06:31:00'),
(35, 'Tougan', 'Commune de Tougan', 4, NULL, '2022-11-30 06:31:22', '2022-11-30 06:31:22');

-- --------------------------------------------------------

--
-- Structure de la table `commune_prevesionnelle`
--

CREATE TABLE `commune_prevesionnelle` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `activite_previsionnelle_id` bigint(20) UNSIGNED NOT NULL,
  `commune_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `commune_views`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `commune_views` (
`id` bigint(20) unsigned
,`commune` varchar(191)
,`description` varchar(191)
,`province_id` bigint(20) unsigned
,`deleted_at` timestamp
,`created_at` timestamp
,`updated_at` timestamp
,`region_id` bigint(20) unsigned
);

-- --------------------------------------------------------

--
-- Structure de la table `configs`
--

CREATE TABLE `configs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nom` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adresse` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telephone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `configs`
--

INSERT INTO `configs` (`id`, `created_at`, `updated_at`, `nom`, `logo`, `site`, `email`, `adresse`, `telephone`) VALUES
(1, '2022-10-27 18:09:44', '2022-11-08 10:42:44', 'Suivi-évaluation de OCADES DDG', '2022_11_08_11_42_44_2022_09_19_11_02_24_ocades.gif', 'https://ocades-dedougou.org', 'sed@ocadesddg.ord', 'B.P. 35 DEDOUGOU', '70364667');

-- --------------------------------------------------------

--
-- Structure de la table `detail_financements`
--

CREATE TABLE `detail_financements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `montant` double NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `activite_id` bigint(20) UNSIGNED NOT NULL,
  `partenaire_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `directions`
--

CREATE TABLE `directions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom_dir` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `directions`
--

INSERT INTO `directions` (`id`, `nom_dir`, `created_at`, `updated_at`) VALUES
(1, 'Direction', '2022-10-27 18:09:44', '2022-10-27 18:09:44'),
(2, 'DSI', '2022-10-27 18:09:44', '2022-10-27 18:09:44');

-- --------------------------------------------------------

--
-- Structure de la table `documents`
--

CREATE TABLE `documents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `projet_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `document_activites`
--

CREATE TABLE `document_activites` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `activite_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `domaines`
--

CREATE TABLE `domaines` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `domaine` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `secteur_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `domaines`
--

INSERT INTO `domaines` (`id`, `domaine`, `description`, `deleted_at`, `created_at`, `updated_at`, `secteur_id`) VALUES
(1, 'Production', NULL, NULL, '2022-11-19 16:19:43', '2022-11-19 16:19:43', 1),
(2, 'Salaire', NULL, NULL, '2022-11-19 16:21:18', '2022-11-19 16:21:18', 15);

-- --------------------------------------------------------

--
-- Structure de la table `financement_prevesionnelle`
--

CREATE TABLE `financement_prevesionnelle` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `montant` double NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `activite_previsionnelle_id` bigint(20) UNSIGNED NOT NULL,
  `partenaire_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `found_views`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `found_views` (
`id` bigint(20) unsigned
,`libelle` varchar(191)
,`description` text
,`budget` decimal(20,2)
,`montantCharge` decimal(20,2)
,`montantEquipement` decimal(20,2)
,`totalRessFinanciere` decimal(20,2)
,`chefProjet` varchar(191)
,`debut` date
,`fin` date
,`depenseBeneficiaire` decimal(20,2)
,`montantTotalDepense` decimal(20,2)
,`projetprevisionnel_id` bigint(20) unsigned
,`agent` bigint(20) unsigned
,`created_at` timestamp
,`updated_at` timestamp
,`deleted_at` timestamp
,`secteur_id` bigint(20) unsigned
,`partenaire_id` bigint(20) unsigned
,`commune_id` bigint(20) unsigned
,`typepartenaire_id` bigint(20) unsigned
,`region_id` bigint(20) unsigned
,`province_id` bigint(20) unsigned
,`paroisse_id` bigint(20) unsigned
,`domaine_id` bigint(20) unsigned
);

-- --------------------------------------------------------

--
-- Structure de la table `historiques`
--

CREATE TABLE `historiques` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `motif` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `agent` bigint(20) UNSIGNED NOT NULL,
  `projet` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `indicateurprevs`
--

CREATE TABLE `indicateurprevs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `valeur` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `activite_previsionnelle_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `indicateurs`
--

CREATE TABLE `indicateurs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `valeur` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `activite_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2020_10_20_184116_create_roles_table', 1),
(2, '2020_10_22_103308_create_directions_table', 1),
(3, '2020_10_22_113442_create_users_table', 1),
(4, '2020_10_22_113912_create_role_user_table', 1),
(5, '2021_07_28_122925_create_programs_table', 1),
(6, '2021_07_28_153122_create_regions_table', 1),
(7, '2021_07_28_153552_create_typepartenaires_table', 1),
(8, '2021_07_28_154034_create_secteurs_table', 1),
(9, '2021_07_28_155247_create_partenaires_table', 1),
(10, '2021_07_28_155821_create_documents_table', 1),
(11, '2021_07_28_160002_create_projet_previsionnels_table', 1),
(12, '2021_07_28_161344_create_projet_previsionnel_partenaires_table', 1),
(13, '2021_07_28_161646_create_projets_table', 1),
(14, '2021_07_28_162541_create_projet_partenaire_table', 1),
(15, '2021_07_28_162832_create_projet_secteur_table', 1),
(16, '2021_07_28_200636_create_provinces_table', 1),
(17, '2021_07_28_200709_create_communes_table', 1),
(18, '2021_07_28_200734_create_paroisses_table', 1),
(19, '2021_07_28_200753_create_domaines_table', 1),
(20, '2021_07_28_200924_create_activite_previsionnelles_table', 1),
(21, '2021_07_28_200959_create_activites_table', 1),
(22, '2021_07_28_201016_create_document_activites_table', 1),
(23, '2021_07_28_201037_create_detail_financements_table', 1),
(24, '2021_08_15_131349_alter_domaine', 1),
(25, '2021_08_24_193708_alter_documents_table', 1),
(26, '2021_08_24_195656_alter_projets_table', 1),
(27, '2021_09_01_204104_create_historiques_table', 1),
(28, '2021_09_02_000118_create_projet_views_table', 1),
(29, '2021_09_02_003831_create_commune_views_table', 1),
(30, '2021_09_02_004911_create_paroisse_views_table', 1),
(31, '2021_09_02_005315_create_activite_views_table', 1),
(32, '2021_09_02_005737_create_partenaire_views_table', 1),
(33, '2021_09_02_010036_create_found_views_table', 1),
(34, '2021_09_07_114833_create_config', 1),
(35, '2021_10_09_110012_create_indicateurs', 1),
(36, '2021_10_10_095709_alter_activites_previsionnelle', 1),
(37, '2021_10_10_095717_alter_activites', 1),
(38, '2021_10_10_112057_alter_activites_2', 1),
(39, '2021_10_10_132951_alter_activites_add_type_beneficiaire', 1),
(40, '2021_12_06_141550_create_table_village', 1),
(41, '2022_01_17_100507_create_type_documents_table', 1),
(42, '2022_01_17_100716_create_vie_organisations_table', 1),
(43, '2022_01_17_100740_create_vie_organisation_documents_table', 1),
(44, '2022_08_15_164122_update_activite_prevesionnelle', 1),
(45, '2022_08_15_172538_create_financement_prevesionnelle', 1),
(46, '2022_08_15_172555_create_indicateur_prevesionnelle', 1),
(47, '2022_08_15_174358_create_province_prevesionnelle', 1),
(48, '2022_08_15_174409_create_commune_prevesionnelle', 1),
(49, '2022_08_15_174439_create_village_prevesionnelle', 1),
(50, '2022_08_21_142708_create_objectif_specifiques_table', 1),
(51, '2022_09_19_093941_create_activite_prev_objectifs_table', 1);

-- --------------------------------------------------------

--
-- Structure de la table `objectif_specifiques`
--

CREATE TABLE `objectif_specifiques` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `paroisses`
--

CREATE TABLE `paroisses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `paroisse` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `commune_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `paroisse_prevesionnelle`
--

CREATE TABLE `paroisse_prevesionnelle` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `activite_previsionnelle_id` bigint(20) UNSIGNED NOT NULL,
  `paroisse_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `paroisse_views`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `paroisse_views` (
`id` bigint(20) unsigned
,`paroisse` varchar(191)
,`description` varchar(191)
,`commune_id` bigint(20) unsigned
,`deleted_at` timestamp
,`created_at` timestamp
,`updated_at` timestamp
,`region_id` bigint(20) unsigned
,`province_id` bigint(20) unsigned
);

-- --------------------------------------------------------

--
-- Structure de la table `partenaires`
--

CREATE TABLE `partenaires` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telephone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adresse` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `typepartenaire_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `partenaire_views`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `partenaire_views` (
`id` bigint(20) unsigned
,`montant` double
,`description` varchar(191)
,`activite_id` bigint(20) unsigned
,`partenaire_id` bigint(20) unsigned
,`deleted_at` timestamp
,`created_at` timestamp
,`updated_at` timestamp
,`typepartenaire_id` bigint(20) unsigned
,`commune_id` bigint(20) unsigned
,`region_id` bigint(20) unsigned
,`province_id` bigint(20) unsigned
,`paroisse_id` bigint(20) unsigned
,`domaine_id` bigint(20) unsigned
);

-- --------------------------------------------------------

--
-- Structure de la table `programs`
--

CREATE TABLE `programs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agent` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `projets`
--

CREATE TABLE `projets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `libelle` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `budget` decimal(20,2) DEFAULT NULL,
  `montantCharge` decimal(20,2) DEFAULT NULL,
  `montantEquipement` decimal(20,2) DEFAULT NULL,
  `totalRessFinanciere` decimal(20,2) DEFAULT NULL,
  `chefProjet` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `debut` date NOT NULL,
  `fin` date NOT NULL,
  `depenseBeneficiaire` decimal(20,2) DEFAULT NULL,
  `montantTotalDepense` decimal(20,2) DEFAULT NULL,
  `projetprevisionnel_id` bigint(20) UNSIGNED NOT NULL,
  `agent` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `projet_partenaire`
--

CREATE TABLE `projet_partenaire` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `projet_id` bigint(20) UNSIGNED NOT NULL,
  `partenaire_id` bigint(20) UNSIGNED NOT NULL,
  `montant` decimal(20,2) NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `projet_previsionnels`
--

CREATE TABLE `projet_previsionnels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `debut` date NOT NULL,
  `fin` date NOT NULL,
  `objectSpecifique` text COLLATE utf8mb4_unicode_ci,
  `objectGeneral` text COLLATE utf8mb4_unicode_ci,
  `resultatAttendu` text COLLATE utf8mb4_unicode_ci,
  `montant` decimal(20,2) NOT NULL,
  `program_id` bigint(20) UNSIGNED NOT NULL,
  `agent` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `projet_previsionnel_partenaires`
--

CREATE TABLE `projet_previsionnel_partenaires` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `partenaire_id` bigint(20) UNSIGNED NOT NULL,
  `projet_previsionnel_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `projet_secteur`
--

CREATE TABLE `projet_secteur` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `projet_id` bigint(20) UNSIGNED NOT NULL,
  `secteur_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `projet_views`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `projet_views` (
`id` bigint(20) unsigned
,`libelle` varchar(191)
,`description` text
,`budget` decimal(20,2)
,`montantCharge` decimal(20,2)
,`montantEquipement` decimal(20,2)
,`totalRessFinanciere` decimal(20,2)
,`chefProjet` varchar(191)
,`debut` date
,`fin` date
,`depenseBeneficiaire` decimal(20,2)
,`montantTotalDepense` decimal(20,2)
,`projetprevisionnel_id` bigint(20) unsigned
,`agent` bigint(20) unsigned
,`created_at` timestamp
,`updated_at` timestamp
,`deleted_at` timestamp
,`secteur_id` bigint(20) unsigned
);

-- --------------------------------------------------------

--
-- Structure de la table `provinces`
--

CREATE TABLE `provinces` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `province` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `region_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `provinces`
--

INSERT INTO `provinces` (`id`, `province`, `description`, `region_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Ballés', 'Province des Ballés', 1, NULL, '2022-11-30 05:44:46', '2022-11-30 05:44:46'),
(2, 'Mouhoun', 'Province du Mouhoun', 1, NULL, '2022-11-30 05:45:22', '2022-11-30 05:45:22'),
(3, 'Nayala', 'Province du Nayala', 1, NULL, '2022-11-30 05:45:57', '2022-11-30 05:45:57'),
(4, 'Sourou', 'Province du Sourou', 1, NULL, '2022-11-30 05:46:24', '2022-11-30 05:46:24'),
(5, 'Tuy', 'Province du Tuy', 2, NULL, '2022-11-30 05:47:08', '2022-11-30 05:47:08');

-- --------------------------------------------------------

--
-- Structure de la table `regions`
--

CREATE TABLE `regions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `regions`
--

INSERT INTO `regions` (`id`, `nom`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Boucle du Mouhoun', 'Région de la Boucle du Mouhoun', '2022-11-30 05:43:21', '2022-11-30 05:43:21', NULL),
(2, 'Haut-Bassin', 'Région des Haut-Bassin', '2022-11-30 05:43:49', '2022-11-30 05:43:49', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'admin', '2022-10-27 18:09:44', '2022-10-27 18:09:44'),
(2, 'utilisateur', '2022-10-27 18:09:44', '2022-10-27 18:09:44'),
(3, 'gestionnaire', '2022-10-27 18:09:44', '2022-10-27 18:09:44');

-- --------------------------------------------------------

--
-- Structure de la table `role_user`
--

CREATE TABLE `role_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `role_user`
--

INSERT INTO `role_user` (`id`, `role_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 3, 2, NULL, NULL),
(3, 2, 3, NULL, NULL),
(4, 2, 4, NULL, NULL),
(5, 2, 5, NULL, NULL),
(6, 2, 6, NULL, NULL),
(7, 2, 7, NULL, NULL),
(8, 2, 8, NULL, NULL),
(9, 2, 9, NULL, NULL),
(10, 2, 10, NULL, NULL),
(11, 2, 11, NULL, NULL),
(12, 2, 12, NULL, NULL),
(13, 2, 13, NULL, NULL),
(14, 2, 14, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `secteurs`
--

CREATE TABLE `secteurs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `secteurs`
--

INSERT INTO `secteurs` (`id`, `nom`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Agriculture', NULL, '2022-11-19 14:49:42', '2022-11-19 14:49:42', NULL),
(2, 'Education', NULL, '2022-11-19 14:50:35', '2022-11-19 14:50:35', NULL),
(3, 'Elevage', NULL, '2022-11-19 14:51:06', '2022-11-19 14:51:06', NULL),
(4, 'Environnement', NULL, '2022-11-19 14:51:29', '2022-11-19 14:51:29', NULL),
(5, 'Humanitaire', NULL, '2022-11-19 14:51:45', '2022-11-19 14:51:45', NULL),
(6, 'Commerce-microfinance', NULL, '2022-11-19 14:53:09', '2022-11-19 14:53:09', NULL),
(7, 'Gouvernance', NULL, '2022-11-19 14:54:29', '2022-11-19 14:54:29', NULL),
(8, 'Eau potable', NULL, '2022-11-19 14:55:49', '2022-11-19 14:55:49', NULL),
(9, 'Hygiène-Assainissement', NULL, '2022-11-19 14:56:14', '2022-11-19 14:56:14', NULL),
(10, 'Energie', NULL, '2022-11-19 14:58:10', '2022-11-19 14:58:10', NULL),
(11, 'Communication et partenariat', NULL, '2022-11-19 15:24:19', '2022-11-19 15:24:19', NULL),
(12, 'Cohésion sociale', NULL, '2022-11-19 15:32:36', '2022-11-19 15:32:36', NULL),
(13, 'Artisanat', NULL, '2022-11-19 15:35:44', '2022-11-19 15:35:44', NULL),
(14, 'Santé', NULL, '2022-11-19 15:39:01', '2022-11-19 15:39:01', NULL),
(15, 'Fonctionnement', NULL, '2022-11-19 16:20:51', '2022-11-19 16:20:51', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `typepartenaires`
--

CREATE TABLE `typepartenaires` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `libelle` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `type_documents`
--

CREATE TABLE `type_documents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `libelle` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(191) NOT NULL,
  `avatar` varchar(191) NOT NULL DEFAULT 'user.svg',
  `state` tinyint(1) NOT NULL DEFAULT '1',
  `name` varchar(191) NOT NULL,
  `forname` varchar(191) NOT NULL,
  `password` varchar(191) NOT NULL,
  `code_dir` bigint(20) UNSIGNED NOT NULL,
  `owner` int(11) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `avatar`, `state`, `name`, `forname`, `password`, `code_dir`, `owner`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'user.svg', 1, 'Ocades', 'Dédougou', '$2y$10$DSDDHRyIdJMZRU1cNQyutukfIxV14bhBqBxhoPYd4qAUiH.VpptqO', 2, 0, NULL, '2022-10-27 18:09:44', '2022-11-08 10:43:13'),
(2, 'gestionnaire', 'user.svg', 1, 'SANFO', 'Alphonsee', '$2y$10$UtY111cIrJBgC72vnPl0QeXLDmMNROXwcnaFmu87/.YhC88LNvKPG', 1, 1, NULL, '2022-10-27 18:09:44', '2022-12-13 11:28:41'),
(3, 'utilisateur', 'user.svg', 1, 'Chargé', 'Projet', '$2y$10$K4NCkBvtLXDhWhrJjKutDuZaNPEwtf2LZueC3fTnH2WZOyQb..9vq', 1, 2, NULL, '2022-10-27 18:09:44', '2022-11-08 10:48:51'),
(4, 'pdi', 'user.svg', 1, 'Chargé', 'Projet', '$2y$10$.3hn/okOFKsdLIS7KunUleoUJYTI8DUWcAHDPY5c4Gy.csL7TI1Bq', 1, 1, NULL, '2022-11-09 13:12:29', '2022-11-09 13:12:37'),
(5, 'prcc', 'user.svg', 1, 'Chargé', 'Projet', '$2y$10$BmB4ZmzdX.u3CwGjOugbL.8nc90PgPGB3t./KucM0yIm0yDJRjCmi', 1, 1, NULL, '2022-11-09 13:13:17', '2022-11-09 13:13:25'),
(6, 'resicom', 'user.svg', 1, 'Chargé', 'Projet', '$2y$10$rqzrexKRSso/XMkcmxyrJel//RVe0T0FLrexBZYuZ3SNr3FyUzekq', 1, 1, NULL, '2022-11-11 07:31:40', '2022-11-11 07:31:53'),
(7, 'mae', 'user.svg', 1, 'Chargé', 'Projet', '$2y$10$kXubtRubKrcsRM1xMN2Hk.zOfkEV4PwHbCZOTBOU6xN2US/BOclna', 1, 1, NULL, '2022-11-11 07:32:25', '2022-11-11 07:32:34'),
(8, 'patec', 'user.svg', 1, 'Chargé', 'Projet', '$2y$10$3I0IICVJD3tnLWz9bnBN/.85uOz5UdLHTOXXQYV3P4T6ow/mr9dje', 1, 1, NULL, '2022-11-11 07:33:16', '2022-11-11 07:33:25'),
(9, 'fao', 'user.svg', 1, 'Chargé', 'Projet', '$2y$10$TZ/pxPaXt1fxgpKLxwHSb.o/4G53flYzU8H4a32YtsdG/qY0WSodq', 1, 1, NULL, '2022-11-11 07:34:04', '2022-11-11 07:34:11'),
(10, 'papac', 'user.svg', 1, 'Chargé', 'Projet', '$2y$10$PSYFkbaybttvkDPmxZ7ly.yWg.Q8Fv/.JCKEkHdhOhXeMQtvpKlha', 1, 1, NULL, '2022-11-11 07:34:48', '2022-11-11 07:34:54'),
(11, 'profap', 'user.svg', 1, 'Chargé', 'Projet', '$2y$10$5eUFYY5rTa80mqKXYP6E1e5nYWymS7DKvjAGadk7eiD1TgHsZvieq', 1, 1, NULL, '2022-11-11 07:35:33', '2022-11-11 07:35:55'),
(12, 'parsi', 'user.svg', 1, 'Chargé', 'Projet', '$2y$10$ddVZnjsqwEK013txxD5nZufD6i7ruzqRHfMJwgSQrdbki.ISR/A7m', 1, 1, NULL, '2022-11-11 07:36:55', '2022-11-11 07:37:04'),
(13, 'pacc', 'user.svg', 1, 'Chargé', 'Projet', '$2y$10$oirrEvz2KDuv8LRX04me1OzfbxmcRgEt8EbF7t3a/9Vovofcy5kUW', 1, 1, NULL, '2022-11-11 07:37:34', '2022-11-11 07:37:49'),
(14, 'pam', 'user.svg', 1, 'Chargé', 'Projet', '$2y$10$rg/9STUuZ0h7ItDOWB2Nx.7fzv5JYvtmA8VUP6HGMIBK9IwwHItwa', 1, 1, NULL, '2022-11-11 07:39:48', '2022-11-11 07:40:45');

-- --------------------------------------------------------

--
-- Structure de la table `vie_organisations`
--

CREATE TABLE `vie_organisations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `auteur` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nb_pages` int(11) NOT NULL,
  `resume` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_publication` date NOT NULL,
  `type_document_id` bigint(20) UNSIGNED NOT NULL,
  `agent` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `vie_organisation_documents`
--

CREATE TABLE `vie_organisation_documents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vie_organisation_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `villages`
--

CREATE TABLE `villages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `village` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paroisse_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `village_prevesionnelle`
--

CREATE TABLE `village_prevesionnelle` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `activite_previsionnelle_id` bigint(20) UNSIGNED NOT NULL,
  `village_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la vue `activite_views`
--
DROP TABLE IF EXISTS `activite_views`;

CREATE ALGORITHM=UNDEFINED DEFINER=`ocadesbgedo`@`%` SQL SECURITY DEFINER VIEW `activite_views`  AS SELECT `activites`.`id` AS `id`, `activites`.`libelle` AS `libelle`, `activites`.`date_realisation` AS `date_realisation`, `activites`.`unite_physique` AS `unite_physique`, `activites`.`validate` AS `validate`, `activites`.`quantite_realise` AS `quantite_realise`, `activites`.`cout_total_realisation` AS `cout_total_realisation`, `activites`.`contrib_beneficiaire` AS `contrib_beneficiaire`, `activites`.`bene_d_homme` AS `bene_d_homme`, `activites`.`bene_d_femme` AS `bene_d_femme`, `activites`.`activite_previsionnelle_id` AS `activite_previsionnelle_id`, `activites`.`paroisse_id` AS `paroisse_id`, `activites`.`domaine_id` AS `domaine_id`, `activites`.`agent` AS `agent`, `activites`.`deleted_at` AS `deleted_at`, `activites`.`created_at` AS `created_at`, `activites`.`updated_at` AS `updated_at`, `paroisse_views`.`commune_id` AS `commune_id`, `paroisse_views`.`region_id` AS `region_id`, `paroisse_views`.`province_id` AS `province_id` FROM (`activites` join `paroisse_views` on((`activites`.`paroisse_id` = `paroisse_views`.`id`))) ;

-- --------------------------------------------------------

--
-- Structure de la vue `commune_views`
--
DROP TABLE IF EXISTS `commune_views`;

CREATE ALGORITHM=UNDEFINED DEFINER=`ocadesbgedo`@`%` SQL SECURITY DEFINER VIEW `commune_views`  AS SELECT `communes`.`id` AS `id`, `communes`.`commune` AS `commune`, `communes`.`description` AS `description`, `communes`.`province_id` AS `province_id`, `communes`.`deleted_at` AS `deleted_at`, `communes`.`created_at` AS `created_at`, `communes`.`updated_at` AS `updated_at`, `provinces`.`region_id` AS `region_id` FROM (`communes` join `provinces` on((`communes`.`province_id` = `provinces`.`id`))) ;

-- --------------------------------------------------------

--
-- Structure de la vue `found_views`
--
DROP TABLE IF EXISTS `found_views`;

CREATE ALGORITHM=UNDEFINED DEFINER=`ocadesbgedo`@`%` SQL SECURITY DEFINER VIEW `found_views`  AS SELECT `projet_views`.`id` AS `id`, `projet_views`.`libelle` AS `libelle`, `projet_views`.`description` AS `description`, `projet_views`.`budget` AS `budget`, `projet_views`.`montantCharge` AS `montantCharge`, `projet_views`.`montantEquipement` AS `montantEquipement`, `projet_views`.`totalRessFinanciere` AS `totalRessFinanciere`, `projet_views`.`chefProjet` AS `chefProjet`, `projet_views`.`debut` AS `debut`, `projet_views`.`fin` AS `fin`, `projet_views`.`depenseBeneficiaire` AS `depenseBeneficiaire`, `projet_views`.`montantTotalDepense` AS `montantTotalDepense`, `projet_views`.`projetprevisionnel_id` AS `projetprevisionnel_id`, `projet_views`.`agent` AS `agent`, `projet_views`.`created_at` AS `created_at`, `projet_views`.`updated_at` AS `updated_at`, `projet_views`.`deleted_at` AS `deleted_at`, `projet_views`.`secteur_id` AS `secteur_id`, `partenaire_views`.`partenaire_id` AS `partenaire_id`, `partenaire_views`.`commune_id` AS `commune_id`, `partenaire_views`.`typepartenaire_id` AS `typepartenaire_id`, `partenaire_views`.`region_id` AS `region_id`, `partenaire_views`.`province_id` AS `province_id`, `partenaire_views`.`paroisse_id` AS `paroisse_id`, `partenaire_views`.`domaine_id` AS `domaine_id` FROM ((`projet_partenaire` join `partenaire_views` on((`projet_partenaire`.`partenaire_id` = `partenaire_views`.`partenaire_id`))) join `projet_views` on((`projet_partenaire`.`projet_id` = `projet_views`.`id`))) ;

-- --------------------------------------------------------

--
-- Structure de la vue `paroisse_views`
--
DROP TABLE IF EXISTS `paroisse_views`;

CREATE ALGORITHM=UNDEFINED DEFINER=`ocadesbgedo`@`%` SQL SECURITY DEFINER VIEW `paroisse_views`  AS SELECT `paroisses`.`id` AS `id`, `paroisses`.`paroisse` AS `paroisse`, `paroisses`.`description` AS `description`, `paroisses`.`commune_id` AS `commune_id`, `paroisses`.`deleted_at` AS `deleted_at`, `paroisses`.`created_at` AS `created_at`, `paroisses`.`updated_at` AS `updated_at`, `commune_views`.`region_id` AS `region_id`, `commune_views`.`province_id` AS `province_id` FROM (`paroisses` join `commune_views` on((`paroisses`.`commune_id` = `commune_views`.`id`))) ;

-- --------------------------------------------------------

--
-- Structure de la vue `partenaire_views`
--
DROP TABLE IF EXISTS `partenaire_views`;

CREATE ALGORITHM=UNDEFINED DEFINER=`ocadesbgedo`@`%` SQL SECURITY DEFINER VIEW `partenaire_views`  AS SELECT `detail_financements`.`id` AS `id`, `detail_financements`.`montant` AS `montant`, `detail_financements`.`description` AS `description`, `detail_financements`.`activite_id` AS `activite_id`, `detail_financements`.`partenaire_id` AS `partenaire_id`, `detail_financements`.`deleted_at` AS `deleted_at`, `detail_financements`.`created_at` AS `created_at`, `detail_financements`.`updated_at` AS `updated_at`, `partenaires`.`typepartenaire_id` AS `typepartenaire_id`, `activite_views`.`commune_id` AS `commune_id`, `activite_views`.`region_id` AS `region_id`, `activite_views`.`province_id` AS `province_id`, `activite_views`.`paroisse_id` AS `paroisse_id`, `activite_views`.`domaine_id` AS `domaine_id` FROM ((`detail_financements` join `activite_views` on((`detail_financements`.`activite_id` = `activite_views`.`id`))) join `partenaires` on((`detail_financements`.`partenaire_id` = `partenaires`.`id`))) ;

-- --------------------------------------------------------

--
-- Structure de la vue `projet_views`
--
DROP TABLE IF EXISTS `projet_views`;

CREATE ALGORITHM=UNDEFINED DEFINER=`ocadesbgedo`@`%` SQL SECURITY DEFINER VIEW `projet_views`  AS SELECT `projets`.`id` AS `id`, `projets`.`libelle` AS `libelle`, `projets`.`description` AS `description`, `projets`.`budget` AS `budget`, `projets`.`montantCharge` AS `montantCharge`, `projets`.`montantEquipement` AS `montantEquipement`, `projets`.`totalRessFinanciere` AS `totalRessFinanciere`, `projets`.`chefProjet` AS `chefProjet`, `projets`.`debut` AS `debut`, `projets`.`fin` AS `fin`, `projets`.`depenseBeneficiaire` AS `depenseBeneficiaire`, `projets`.`montantTotalDepense` AS `montantTotalDepense`, `projets`.`projetprevisionnel_id` AS `projetprevisionnel_id`, `projets`.`agent` AS `agent`, `projets`.`created_at` AS `created_at`, `projets`.`updated_at` AS `updated_at`, `projets`.`deleted_at` AS `deleted_at`, `projet_secteur`.`secteur_id` AS `secteur_id` FROM (`projet_secteur` join `projets` on((`projet_secteur`.`projet_id` = `projets`.`id`))) ;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `activites`
--
ALTER TABLE `activites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activites_activite_previsionnelle_id_foreign` (`activite_previsionnelle_id`),
  ADD KEY `activites_paroisse_id_foreign` (`paroisse_id`),
  ADD KEY `activites_domaine_id_foreign` (`domaine_id`),
  ADD KEY `activites_agent_foreign` (`agent`);

--
-- Index pour la table `activite_previsionnelles`
--
ALTER TABLE `activite_previsionnelles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activite_previsionnelles_projet_previsionnel_id_foreign` (`projet_previsionnel_id`),
  ADD KEY `activite_previsionnelles_agent_foreign` (`agent`),
  ADD KEY `activite_previsionnelles_region_id_foreign` (`region_id`),
  ADD KEY `activite_previsionnelles_domaine_id_foreign` (`domaine_id`);

--
-- Index pour la table `activite_prev_objectifs`
--
ALTER TABLE `activite_prev_objectifs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activite_prev_objectifs_objectif_specifique_id_foreign` (`objectif_specifique_id`),
  ADD KEY `activite_prev_objectifs_activite_prev_id_foreign` (`activite_prev_id`);

--
-- Index pour la table `communes`
--
ALTER TABLE `communes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `communes_province_id_foreign` (`province_id`);

--
-- Index pour la table `commune_prevesionnelle`
--
ALTER TABLE `commune_prevesionnelle`
  ADD PRIMARY KEY (`id`),
  ADD KEY `commune_prevesionnelle_activite_previsionnelle_id_foreign` (`activite_previsionnelle_id`),
  ADD KEY `commune_prevesionnelle_commune_id_foreign` (`commune_id`);

--
-- Index pour la table `configs`
--
ALTER TABLE `configs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `detail_financements`
--
ALTER TABLE `detail_financements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_financements_activite_id_foreign` (`activite_id`),
  ADD KEY `detail_financements_partenaire_id_foreign` (`partenaire_id`);

--
-- Index pour la table `directions`
--
ALTER TABLE `directions`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `documents_projet_id_foreign` (`projet_id`);

--
-- Index pour la table `document_activites`
--
ALTER TABLE `document_activites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `document_activites_activite_id_foreign` (`activite_id`);

--
-- Index pour la table `domaines`
--
ALTER TABLE `domaines`
  ADD PRIMARY KEY (`id`),
  ADD KEY `domaines_secteur_id_foreign` (`secteur_id`);

--
-- Index pour la table `financement_prevesionnelle`
--
ALTER TABLE `financement_prevesionnelle`
  ADD PRIMARY KEY (`id`),
  ADD KEY `financement_prevesionnelle_activite_previsionnelle_id_foreign` (`activite_previsionnelle_id`),
  ADD KEY `financement_prevesionnelle_partenaire_id_foreign` (`partenaire_id`);

--
-- Index pour la table `historiques`
--
ALTER TABLE `historiques`
  ADD PRIMARY KEY (`id`),
  ADD KEY `historiques_agent_foreign` (`agent`);

--
-- Index pour la table `indicateurprevs`
--
ALTER TABLE `indicateurprevs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `indicateurprevs_activite_previsionnelle_id_foreign` (`activite_previsionnelle_id`);

--
-- Index pour la table `indicateurs`
--
ALTER TABLE `indicateurs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `indicateurs_activite_id_foreign` (`activite_id`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `objectif_specifiques`
--
ALTER TABLE `objectif_specifiques`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `paroisses`
--
ALTER TABLE `paroisses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `paroisses_commune_id_foreign` (`commune_id`);

--
-- Index pour la table `paroisse_prevesionnelle`
--
ALTER TABLE `paroisse_prevesionnelle`
  ADD PRIMARY KEY (`id`),
  ADD KEY `paroisse_prevesionnelle_activite_previsionnelle_id_foreign` (`activite_previsionnelle_id`),
  ADD KEY `paroisse_prevesionnelle_paroisse_id_foreign` (`paroisse_id`);

--
-- Index pour la table `partenaires`
--
ALTER TABLE `partenaires`
  ADD PRIMARY KEY (`id`),
  ADD KEY `partenaires_typepartenaire_id_foreign` (`typepartenaire_id`);

--
-- Index pour la table `programs`
--
ALTER TABLE `programs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `programs_agent_foreign` (`agent`);

--
-- Index pour la table `projets`
--
ALTER TABLE `projets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `projets_agent_foreign` (`agent`),
  ADD KEY `projets_projetprevisionnel_id_foreign` (`projetprevisionnel_id`);

--
-- Index pour la table `projet_partenaire`
--
ALTER TABLE `projet_partenaire`
  ADD PRIMARY KEY (`id`),
  ADD KEY `projet_partenaire_projet_id_foreign` (`projet_id`),
  ADD KEY `projet_partenaire_partenaire_id_foreign` (`partenaire_id`);

--
-- Index pour la table `projet_previsionnels`
--
ALTER TABLE `projet_previsionnels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `projet_previsionnels_program_id_foreign` (`program_id`),
  ADD KEY `projet_previsionnels_agent_foreign` (`agent`);

--
-- Index pour la table `projet_previsionnel_partenaires`
--
ALTER TABLE `projet_previsionnel_partenaires`
  ADD PRIMARY KEY (`id`),
  ADD KEY `projet_previsionnel_partenaires_partenaire_id_foreign` (`partenaire_id`),
  ADD KEY `projet_previsionnel_partenaires_projet_previsionnel_id_foreign` (`projet_previsionnel_id`);

--
-- Index pour la table `projet_secteur`
--
ALTER TABLE `projet_secteur`
  ADD PRIMARY KEY (`id`),
  ADD KEY `projet_secteur_projet_id_foreign` (`projet_id`),
  ADD KEY `projet_secteur_secteur_id_foreign` (`secteur_id`);

--
-- Index pour la table `provinces`
--
ALTER TABLE `provinces`
  ADD PRIMARY KEY (`id`),
  ADD KEY `provinces_region_id_foreign` (`region_id`);

--
-- Index pour la table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`),
  ADD KEY `role_user_user_id_foreign` (`user_id`);

--
-- Index pour la table `secteurs`
--
ALTER TABLE `secteurs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `typepartenaires`
--
ALTER TABLE `typepartenaires`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `type_documents`
--
ALTER TABLE `type_documents`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD KEY `users_code_dir_foreign` (`code_dir`);

--
-- Index pour la table `vie_organisations`
--
ALTER TABLE `vie_organisations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vie_organisations_type_document_id_foreign` (`type_document_id`),
  ADD KEY `vie_organisations_agent_foreign` (`agent`);

--
-- Index pour la table `vie_organisation_documents`
--
ALTER TABLE `vie_organisation_documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vie_organisation_documents_vie_organisation_id_foreign` (`vie_organisation_id`);

--
-- Index pour la table `villages`
--
ALTER TABLE `villages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `villages_paroisse_id_foreign` (`paroisse_id`);

--
-- Index pour la table `village_prevesionnelle`
--
ALTER TABLE `village_prevesionnelle`
  ADD PRIMARY KEY (`id`),
  ADD KEY `village_prevesionnelle_activite_previsionnelle_id_foreign` (`activite_previsionnelle_id`),
  ADD KEY `village_prevesionnelle_village_id_foreign` (`village_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `activites`
--
ALTER TABLE `activites`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `activite_previsionnelles`
--
ALTER TABLE `activite_previsionnelles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `activite_prev_objectifs`
--
ALTER TABLE `activite_prev_objectifs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `communes`
--
ALTER TABLE `communes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT pour la table `commune_prevesionnelle`
--
ALTER TABLE `commune_prevesionnelle`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `configs`
--
ALTER TABLE `configs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `detail_financements`
--
ALTER TABLE `detail_financements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `directions`
--
ALTER TABLE `directions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `document_activites`
--
ALTER TABLE `document_activites`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `domaines`
--
ALTER TABLE `domaines`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `financement_prevesionnelle`
--
ALTER TABLE `financement_prevesionnelle`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `historiques`
--
ALTER TABLE `historiques`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `indicateurprevs`
--
ALTER TABLE `indicateurprevs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `indicateurs`
--
ALTER TABLE `indicateurs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT pour la table `objectif_specifiques`
--
ALTER TABLE `objectif_specifiques`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `paroisses`
--
ALTER TABLE `paroisses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `paroisse_prevesionnelle`
--
ALTER TABLE `paroisse_prevesionnelle`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `partenaires`
--
ALTER TABLE `partenaires`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `programs`
--
ALTER TABLE `programs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `projets`
--
ALTER TABLE `projets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `projet_partenaire`
--
ALTER TABLE `projet_partenaire`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `projet_previsionnels`
--
ALTER TABLE `projet_previsionnels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `projet_previsionnel_partenaires`
--
ALTER TABLE `projet_previsionnel_partenaires`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `projet_secteur`
--
ALTER TABLE `projet_secteur`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `provinces`
--
ALTER TABLE `provinces`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `regions`
--
ALTER TABLE `regions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `secteurs`
--
ALTER TABLE `secteurs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `typepartenaires`
--
ALTER TABLE `typepartenaires`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `type_documents`
--
ALTER TABLE `type_documents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `vie_organisations`
--
ALTER TABLE `vie_organisations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `vie_organisation_documents`
--
ALTER TABLE `vie_organisation_documents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `villages`
--
ALTER TABLE `villages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `village_prevesionnelle`
--
ALTER TABLE `village_prevesionnelle`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `activites`
--
ALTER TABLE `activites`
  ADD CONSTRAINT `activites_activite_previsionnelle_id_foreign` FOREIGN KEY (`activite_previsionnelle_id`) REFERENCES `activite_previsionnelles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `activites_agent_foreign` FOREIGN KEY (`agent`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `activites_domaine_id_foreign` FOREIGN KEY (`domaine_id`) REFERENCES `domaines` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `activites_paroisse_id_foreign` FOREIGN KEY (`paroisse_id`) REFERENCES `paroisses` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `activite_previsionnelles`
--
ALTER TABLE `activite_previsionnelles`
  ADD CONSTRAINT `activite_previsionnelles_agent_foreign` FOREIGN KEY (`agent`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `activite_previsionnelles_domaine_id_foreign` FOREIGN KEY (`domaine_id`) REFERENCES `domaines` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `activite_previsionnelles_projet_previsionnel_id_foreign` FOREIGN KEY (`projet_previsionnel_id`) REFERENCES `projet_previsionnels` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `activite_previsionnelles_region_id_foreign` FOREIGN KEY (`region_id`) REFERENCES `regions` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `activite_prev_objectifs`
--
ALTER TABLE `activite_prev_objectifs`
  ADD CONSTRAINT `activite_prev_objectifs_activite_prev_id_foreign` FOREIGN KEY (`activite_prev_id`) REFERENCES `activite_previsionnelles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `activite_prev_objectifs_objectif_specifique_id_foreign` FOREIGN KEY (`objectif_specifique_id`) REFERENCES `objectif_specifiques` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `communes`
--
ALTER TABLE `communes`
  ADD CONSTRAINT `communes_province_id_foreign` FOREIGN KEY (`province_id`) REFERENCES `provinces` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `commune_prevesionnelle`
--
ALTER TABLE `commune_prevesionnelle`
  ADD CONSTRAINT `commune_prevesionnelle_activite_previsionnelle_id_foreign` FOREIGN KEY (`activite_previsionnelle_id`) REFERENCES `activite_previsionnelles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `commune_prevesionnelle_commune_id_foreign` FOREIGN KEY (`commune_id`) REFERENCES `communes` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `detail_financements`
--
ALTER TABLE `detail_financements`
  ADD CONSTRAINT `detail_financements_activite_id_foreign` FOREIGN KEY (`activite_id`) REFERENCES `activites` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `detail_financements_partenaire_id_foreign` FOREIGN KEY (`partenaire_id`) REFERENCES `partenaires` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `documents`
--
ALTER TABLE `documents`
  ADD CONSTRAINT `documents_projet_id_foreign` FOREIGN KEY (`projet_id`) REFERENCES `projets` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `document_activites`
--
ALTER TABLE `document_activites`
  ADD CONSTRAINT `document_activites_activite_id_foreign` FOREIGN KEY (`activite_id`) REFERENCES `activites` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `domaines`
--
ALTER TABLE `domaines`
  ADD CONSTRAINT `domaines_secteur_id_foreign` FOREIGN KEY (`secteur_id`) REFERENCES `secteurs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `financement_prevesionnelle`
--
ALTER TABLE `financement_prevesionnelle`
  ADD CONSTRAINT `financement_prevesionnelle_activite_previsionnelle_id_foreign` FOREIGN KEY (`activite_previsionnelle_id`) REFERENCES `activite_previsionnelles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `financement_prevesionnelle_partenaire_id_foreign` FOREIGN KEY (`partenaire_id`) REFERENCES `partenaires` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `historiques`
--
ALTER TABLE `historiques`
  ADD CONSTRAINT `historiques_agent_foreign` FOREIGN KEY (`agent`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `indicateurprevs`
--
ALTER TABLE `indicateurprevs`
  ADD CONSTRAINT `indicateurprevs_activite_previsionnelle_id_foreign` FOREIGN KEY (`activite_previsionnelle_id`) REFERENCES `activite_previsionnelles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `indicateurs`
--
ALTER TABLE `indicateurs`
  ADD CONSTRAINT `indicateurs_activite_id_foreign` FOREIGN KEY (`activite_id`) REFERENCES `activites` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `paroisses`
--
ALTER TABLE `paroisses`
  ADD CONSTRAINT `paroisses_commune_id_foreign` FOREIGN KEY (`commune_id`) REFERENCES `communes` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `paroisse_prevesionnelle`
--
ALTER TABLE `paroisse_prevesionnelle`
  ADD CONSTRAINT `paroisse_prevesionnelle_activite_previsionnelle_id_foreign` FOREIGN KEY (`activite_previsionnelle_id`) REFERENCES `activite_previsionnelles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `paroisse_prevesionnelle_paroisse_id_foreign` FOREIGN KEY (`paroisse_id`) REFERENCES `paroisses` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `partenaires`
--
ALTER TABLE `partenaires`
  ADD CONSTRAINT `partenaires_typepartenaire_id_foreign` FOREIGN KEY (`typepartenaire_id`) REFERENCES `typepartenaires` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `programs`
--
ALTER TABLE `programs`
  ADD CONSTRAINT `programs_agent_foreign` FOREIGN KEY (`agent`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `projets`
--
ALTER TABLE `projets`
  ADD CONSTRAINT `projets_agent_foreign` FOREIGN KEY (`agent`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `projets_projetprevisionnel_id_foreign` FOREIGN KEY (`projetprevisionnel_id`) REFERENCES `projet_previsionnels` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `projet_partenaire`
--
ALTER TABLE `projet_partenaire`
  ADD CONSTRAINT `projet_partenaire_partenaire_id_foreign` FOREIGN KEY (`partenaire_id`) REFERENCES `partenaires` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `projet_partenaire_projet_id_foreign` FOREIGN KEY (`projet_id`) REFERENCES `projets` (`id`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `projet_previsionnels`
--
ALTER TABLE `projet_previsionnels`
  ADD CONSTRAINT `projet_previsionnels_agent_foreign` FOREIGN KEY (`agent`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `projet_previsionnels_program_id_foreign` FOREIGN KEY (`program_id`) REFERENCES `programs` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `projet_previsionnel_partenaires`
--
ALTER TABLE `projet_previsionnel_partenaires`
  ADD CONSTRAINT `projet_previsionnel_partenaires_partenaire_id_foreign` FOREIGN KEY (`partenaire_id`) REFERENCES `partenaires` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `projet_previsionnel_partenaires_projet_previsionnel_id_foreign` FOREIGN KEY (`projet_previsionnel_id`) REFERENCES `projet_previsionnels` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `projet_secteur`
--
ALTER TABLE `projet_secteur`
  ADD CONSTRAINT `projet_secteur_projet_id_foreign` FOREIGN KEY (`projet_id`) REFERENCES `projets` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `projet_secteur_secteur_id_foreign` FOREIGN KEY (`secteur_id`) REFERENCES `secteurs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `provinces`
--
ALTER TABLE `provinces`
  ADD CONSTRAINT `provinces_region_id_foreign` FOREIGN KEY (`region_id`) REFERENCES `regions` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_code_dir_foreign` FOREIGN KEY (`code_dir`) REFERENCES `directions` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `vie_organisations`
--
ALTER TABLE `vie_organisations`
  ADD CONSTRAINT `vie_organisations_agent_foreign` FOREIGN KEY (`agent`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `vie_organisations_type_document_id_foreign` FOREIGN KEY (`type_document_id`) REFERENCES `type_documents` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `vie_organisation_documents`
--
ALTER TABLE `vie_organisation_documents`
  ADD CONSTRAINT `vie_organisation_documents_vie_organisation_id_foreign` FOREIGN KEY (`vie_organisation_id`) REFERENCES `vie_organisations` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `villages`
--
ALTER TABLE `villages`
  ADD CONSTRAINT `villages_paroisse_id_foreign` FOREIGN KEY (`paroisse_id`) REFERENCES `paroisses` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `village_prevesionnelle`
--
ALTER TABLE `village_prevesionnelle`
  ADD CONSTRAINT `village_prevesionnelle_activite_previsionnelle_id_foreign` FOREIGN KEY (`activite_previsionnelle_id`) REFERENCES `activite_previsionnelles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `village_prevesionnelle_village_id_foreign` FOREIGN KEY (`village_id`) REFERENCES `villages` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
