-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-10-2016 a las 01:31:10
-- Versión del servidor: 5.7.9
-- Versión de PHP: 5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `shymow`
--
CREATE DATABASE IF NOT EXISTS `shymow` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `shymow`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`id`, `name`, `active`, `created_at`, `updated_at`) VALUES
(1, 'Deportes', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(2, 'Restaurantes', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(3, 'Entretenimiento', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(4, 'Compras', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(5, 'Amistad', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(6, 'Música', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(7, 'Celebridad', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `category_posts`
--

DROP TABLE IF EXISTS `category_posts`;
CREATE TABLE IF NOT EXISTS `category_posts` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `category_posts`
--

INSERT INTO `category_posts` (`id`, `name`, `active`, `created_at`, `updated_at`) VALUES
(1, 'Bisutería', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(2, 'Casas de playa', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(3, 'Series de Tv y cine', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(4, 'Música', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(5, 'Videojuegos', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(6, 'Empresas', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(7, 'Movilidad y transporte', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `category_products`
--

DROP TABLE IF EXISTS `category_products`;
CREATE TABLE IF NOT EXISTS `category_products` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `category_products`
--

INSERT INTO `category_products` (`id`, `name`, `path`, `active`, `created_at`, `updated_at`) VALUES
(1, 'Productos', 'img/create_product/productos.png', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(2, 'Servicios', 'img/create_product/servicios.png', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(3, 'Inmuebles', 'img/create_product/inmuebles.png', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(4, 'Techno', 'img/create_product/techno.png', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(5, 'Otros', 'img/create_product/otros.png', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `celebrities`
--

DROP TABLE IF EXISTS `celebrities`;
CREATE TABLE IF NOT EXISTS `celebrities` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `profile_id` int(10) UNSIGNED NOT NULL,
  `apodo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `celebrities_profile_id_foreign` (`profile_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cities`
--

DROP TABLE IF EXISTS `cities`;
CREATE TABLE IF NOT EXISTS `cities` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `state_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `cities_state_id_index` (`state_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comment_images`
--

DROP TABLE IF EXISTS `comment_images`;
CREATE TABLE IF NOT EXISTS `comment_images` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `comment_post_id` int(10) UNSIGNED NOT NULL,
  `profil_id` int(10) UNSIGNED NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `comment_images_comment_post_id_foreign` (`comment_post_id`),
  KEY `comment_images_profil_id_foreign` (`profil_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comment_likes`
--

DROP TABLE IF EXISTS `comment_likes`;
CREATE TABLE IF NOT EXISTS `comment_likes` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `comment_post_id` int(10) UNSIGNED NOT NULL,
  `profil_id` int(10) UNSIGNED NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `comment_likes_comment_post_id_foreign` (`comment_post_id`),
  KEY `comment_likes_profil_id_foreign` (`profil_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comment_posts`
--

DROP TABLE IF EXISTS `comment_posts`;
CREATE TABLE IF NOT EXISTS `comment_posts` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `post_id` int(10) UNSIGNED NOT NULL,
  `profil_id` int(10) UNSIGNED NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `like` int(11) NOT NULL DEFAULT '0',
  `qualification` int(11) NOT NULL DEFAULT '0',
  `posts` int(11) NOT NULL DEFAULT '0',
  `share` int(11) NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `comment_posts_post_id_foreign` (`post_id`),
  KEY `comment_posts_profil_id_foreign` (`profil_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comment_qualifications`
--

DROP TABLE IF EXISTS `comment_qualifications`;
CREATE TABLE IF NOT EXISTS `comment_qualifications` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `comment_post_id` int(10) UNSIGNED NOT NULL,
  `profil_id` int(10) UNSIGNED NOT NULL,
  `qualification` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `comment_qualifications_comment_post_id_foreign` (`comment_post_id`),
  KEY `comment_qualifications_profil_id_foreign` (`profil_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comment_shares`
--

DROP TABLE IF EXISTS `comment_shares`;
CREATE TABLE IF NOT EXISTS `comment_shares` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `comment_post_id` int(10) UNSIGNED NOT NULL,
  `profil_id` int(10) UNSIGNED NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `comment_shares_comment_post_id_foreign` (`comment_post_id`),
  KEY `comment_shares_profil_id_foreign` (`profil_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `countries`
--

DROP TABLE IF EXISTS `countries`;
CREATE TABLE IF NOT EXISTS `countries` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `sortname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresas`
--

DROP TABLE IF EXISTS `empresas`;
CREATE TABLE IF NOT EXISTS `empresas` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `profile_id` int(10) UNSIGNED NOT NULL,
  `responsable` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_responsable` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `empresa` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alias` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dni` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `actividad_comercial` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `empresa_pais` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `empresa_provincia` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `empresa_municipio` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `empresas_profile_id_foreign` (`profile_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `first_spesifications`
--

DROP TABLE IF EXISTS `first_spesifications`;
CREATE TABLE IF NOT EXISTS `first_spesifications` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `type_product_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `first_spesifications_type_product_id_foreign` (`type_product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `first_spesifications`
--

INSERT INTO `first_spesifications` (`id`, `type_product_id`, `name`, `active`, `created_at`, `updated_at`) VALUES
(1, 1, 'Pantalla plana', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(2, 2, 'HD', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(3, 3, 'LCD HD', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(4, 6, 'Laptops', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(5, 7, 'Patios', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(6, 8, 'Arreglos florales', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(7, 11, 'Vidrio', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(8, 12, 'Metal', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(9, 13, 'Madera', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(10, 16, 'Rock', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(11, 16, 'Rap', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(12, 16, 'Electronica', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(13, 19, 'Ajenjo', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(14, 20, 'Pizarra electronica', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(15, 21, 'Frijoles', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `follow_posts`
--

DROP TABLE IF EXISTS `follow_posts`;
CREATE TABLE IF NOT EXISTS `follow_posts` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `perfil_id` int(10) UNSIGNED NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `follow_posts_perfil_id_foreign` (`perfil_id`),
  KEY `follow_posts_post_id_foreign` (`post_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `follow_posts`
--

INSERT INTO `follow_posts` (`id`, `perfil_id`, `post_id`, `active`, `created_at`, `updated_at`) VALUES
(10, 4, 3, 1, '2016-10-21 10:56:14', '2016-10-21 11:21:52'),
(11, 4, 2, 0, '2016-10-21 11:19:30', '2016-10-26 04:21:47'),
(12, 4, 1, 1, '2016-10-21 11:21:09', '2016-10-21 11:21:34');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `friends`
--

DROP TABLE IF EXISTS `friends`;
CREATE TABLE IF NOT EXISTS `friends` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user1` int(11) NOT NULL,
  `user2` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `friend` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `friends`
--

INSERT INTO `friends` (`id`, `user1`, `user2`, `active`, `friend`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 1, 0, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(2, 1, 3, 1, 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(3, 1, 4, 1, 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(4, 2, 3, 1, 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(5, 2, 4, 1, 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(6, 3, 4, 1, 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `images_posts`
--

DROP TABLE IF EXISTS `images_posts`;
CREATE TABLE IF NOT EXISTS `images_posts` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `images_posts_post_id_foreign` (`post_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `images_products`
--

DROP TABLE IF EXISTS `images_products`;
CREATE TABLE IF NOT EXISTS `images_products` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `images_products_product_id_foreign` (`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `interests`
--

DROP TABLE IF EXISTS `interests`;
CREATE TABLE IF NOT EXISTS `interests` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `categories_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `interests_categories_id_index` (`categories_id`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `interests`
--

INSERT INTO `interests` (`id`, `categories_id`, `name`, `active`, `created_at`, `updated_at`) VALUES
(1, 5, 'Acampar', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(2, 5, 'Compartir coche', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(3, 5, 'Objetos perdidos', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(4, 5, 'Party', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(5, 5, 'Idiomas', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(6, 5, 'Trueque de habilidades', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(7, 5, 'Infantil', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(8, 5, 'Pesca', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(9, 5, 'Cultura', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(10, 5, 'Ecologismo', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(11, 5, 'Intercambio de idioma', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(12, 5, 'Excursionismo', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(13, 5, 'Viajar', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(14, 5, 'Animales', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(15, 5, 'Aventura', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(16, 5, 'Voluntariado', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(17, 5, 'Jardinería', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(18, 5, 'Escribir', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(19, 3, 'Coleccionismo', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(20, 3, 'Moda', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(21, 3, 'Filosofía', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(22, 3, 'Lectura', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(23, 3, 'Anime', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(24, 3, 'Fotografía', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(25, 3, 'Pintar', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(26, 3, 'Teatro', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(27, 3, 'Videojuegos', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(28, 3, 'Informática', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(29, 3, 'Arte', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(30, 3, 'Bailar', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(31, 3, 'Ciencia', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(32, 3, 'Política', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(33, 3, 'Exposiciones', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(34, 6, 'Música', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(35, 6, 'Conciertos', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(36, 2, 'Cocina', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(37, 7, 'Serie', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(38, 7, 'Cine', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(39, 7, 'Belleza', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(40, 1, 'Salud', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(41, 1, 'Motor', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(42, 1, 'Juegos de mesa', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(43, 1, 'Deportes', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(44, 4, 'Compras', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(45, 4, 'Tecnología', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `last_spesifications`
--

DROP TABLE IF EXISTS `last_spesifications`;
CREATE TABLE IF NOT EXISTS `last_spesifications` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `first_spesification_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `last_spesifications_first_spesification_id_foreign` (`first_spesification_id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `last_spesifications`
--

INSERT INTO `last_spesifications` (`id`, `first_spesification_id`, `name`, `active`, `created_at`, `updated_at`) VALUES
(1, 1, 'Grande', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(2, 2, 'Pequeño', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(3, 4, 'Core i5', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(4, 4, 'Core i7', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(5, 4, 'Core i9', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(6, 5, 'Orden y restauracion', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(7, 6, 'Reestauración', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(8, 7, 'Tamaño familiar', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(9, 7, 'Mediano', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(10, 8, 'Tamaño familiar', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(11, 8, 'Mediano', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(12, 9, 'Tamaño familiar', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(13, 9, 'Mediano', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(14, 10, 'Exitos', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(15, 10, 'Populares', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(16, 11, 'Exitos', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(17, 11, 'Populares', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(18, 12, 'Exitos', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(19, 12, 'Populares', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(20, 14, 'Grande', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `like_posts`
--

DROP TABLE IF EXISTS `like_posts`;
CREATE TABLE IF NOT EXISTS `like_posts` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `post_id` int(10) UNSIGNED NOT NULL,
  `profil_id` int(10) UNSIGNED NOT NULL,
  `like` tinyint(1) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `like_posts_post_id_foreign` (`post_id`),
  KEY `like_posts_profil_id_foreign` (`profil_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_100000_create_password_resets_table', 1),
('2016_07_21_041521_create_friends_table', 1),
('2016_07_23_153401_create_empresas_table', 1),
('2016_07_28_035530_create_socials_table', 1),
('2016_07_30_020616_create_countries_table', 1),
('2016_07_30_020636_create_states_table', 1),
('2016_07_30_020650_create_cities_table', 1),
('2016_08_04_010928_create_categories_table', 1),
('2016_08_04_012212_create_interests_table', 1),
('2016_09_08_153621_create_perfils_table', 1),
('2016_09_08_155532_create_celebrities_table', 1),
('2016_09_08_160712_create_stores_table', 1),
('2016_09_08_161030_create_spesifications_table', 1),
('2016_09_08_162009_create_notification_settings_stores_table', 1),
('2016_09_08_162212_create_products_table', 1),
('2016_09_08_163811_create_category_products_table', 1),
('2016_09_08_170728_create_type_products_table', 1),
('2016_09_08_171650_create_first_spesifications_table', 1),
('2016_09_08_171756_create_last_spesifications_table', 1),
('2016_09_08_172214_create_notification_settings_table', 1),
('2016_09_08_173259_create_trends_table', 1),
('2016_09_08_174709_create_permissions_table', 1),
('2016_09_08_175753_create_images_posts_table', 1),
('2016_09_08_180004_create_posts_table', 1),
('2016_09_08_182016_create_category_posts_table', 1),
('2016_09_08_191256_create_qualification_posts_table', 1),
('2016_09_08_191608_create_like_posts_table', 1),
('2016_09_08_191635_create_share_posts_table', 1),
('2016_09_08_193440_create_comment_posts_table', 1),
('2016_09_08_193831_create_comment_images_table', 1),
('2016_09_08_193949_create_comment_qualifications_table', 1),
('2016_09_08_194037_create_comment_likes_table', 1),
('2016_09_08_194123_create_comment_shares_table', 1),
('2016_09_09_235857_create_post_trends_table', 1),
('2016_09_14_023351_create_type_send_products_table', 1),
('2016_09_14_040518_create_images_products_table', 1),
('2016_09_20_184524_create_orders_table', 1),
('2016_10_21_025740_create_follow_posts_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notification_settings`
--

DROP TABLE IF EXISTS `notification_settings`;
CREATE TABLE IF NOT EXISTS `notification_settings` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `perfil_id` int(10) UNSIGNED NOT NULL,
  `follow_notification` tinyint(1) NOT NULL,
  `follow_out_notification` tinyint(1) NOT NULL,
  `label_notification` tinyint(1) NOT NULL,
  `like_notification` tinyint(1) NOT NULL,
  `message_notification` tinyint(1) NOT NULL,
  `qualification_notification` tinyint(1) NOT NULL,
  `comments_notification` tinyint(1) NOT NULL,
  `new_product_notification` tinyint(1) NOT NULL,
  `trends_notification` tinyint(1) NOT NULL,
  `share_notification` tinyint(1) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `notification_settings_perfil_id_foreign` (`perfil_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notification_settings_stores`
--

DROP TABLE IF EXISTS `notification_settings_stores`;
CREATE TABLE IF NOT EXISTS `notification_settings_stores` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `store_id` int(10) UNSIGNED NOT NULL,
  `sound_notification` tinyint(1) NOT NULL,
  `sound_new_message` tinyint(1) NOT NULL,
  `sound_sale` tinyint(1) NOT NULL,
  `buy_notification` tinyint(1) NOT NULL,
  `label_notification` tinyint(1) NOT NULL,
  `like_notification` tinyint(1) NOT NULL,
  `share_notification` tinyint(1) NOT NULL,
  `message_notification` tinyint(1) NOT NULL,
  `qualification_notification` tinyint(1) NOT NULL,
  `comments_notification` int(11) NOT NULL,
  `email_notification` tinyint(1) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `notification_settings_stores_store_id_foreign` (`store_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` int(10) UNSIGNED NOT NULL,
  `perfil_id` int(10) UNSIGNED NOT NULL,
  `address_city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address_country` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address_status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address_street` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address_zip` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `business` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `handling_amount` decimal(5,2) NOT NULL,
  `item_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mc_currency` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payer_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payer_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payer_status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payment_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payment_status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `receiver_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `receiver_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `shipping` decimal(8,2) NOT NULL,
  `payment_fee` decimal(8,2) NOT NULL,
  `payment_gross` decimal(8,2) NOT NULL,
  `mc_fee` decimal(8,2) NOT NULL,
  `mc_gross` decimal(8,2) NOT NULL,
  `txn_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `orders_product_id_foreign` (`product_id`),
  KEY `orders_perfil_id_foreign` (`perfil_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfils`
--

DROP TABLE IF EXISTS `perfils`;
CREATE TABLE IF NOT EXISTS `perfils` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `birthdate` date NOT NULL,
  `genero` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pais` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `provincia` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `municipio` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `work` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` int(11) NOT NULL,
  `edad` int(11) NOT NULL,
  `img_profile` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'img/profile/default.png',
  `img_portada` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'img/profile/portada.jpg',
  `hobbies` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `redes` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `streamings` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `webs` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `blogs` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mi_frase` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '¡Bienvenid@ a Shymow!',
  `descripcion` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Edita tu descripción',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `perfils_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `perfils`
--

INSERT INTO `perfils` (`id`, `name`, `email`, `password`, `birthdate`, `genero`, `pais`, `provincia`, `municipio`, `work`, `phone`, `role`, `edad`, `img_profile`, `img_portada`, `hobbies`, `redes`, `streamings`, `webs`, `blogs`, `mi_frase`, `descripcion`, `active`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Wilmer gilberto', 'wilmer@gmail.com', '$2y$10$Hv7IhNNvxJBIjf7f0xTk4u6nnwtB1p4wqwt2.iXXhCAj8koRWnfPC', '1995-03-29', 'M', 'El Salvador', 'El refugio', 'La paz', '', '', 0, 22, 'img/profile/default.png', 'img/profile/portada.jpg', 'Musica, juegos, Economia', NULL, NULL, NULL, NULL, '¡Bienvenid@ a Shymow!', 'Edita tu descripción', 1, NULL, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(2, 'delmi solano', 'demi@gmail.com', '$2y$10$R17UCduue9GhoLdYxf7mge89wHgoF2h5kmN5cgKWtkJW1AIL/5KUm', '1995-03-29', 'F', 'El Salvador', 'El refugio', 'La paz', '', '', 0, 29, 'img/profile/default.png', 'img/profile/portada.jpg', 'Musica, juegos, Economia', NULL, NULL, NULL, NULL, '¡Bienvenid@ a Shymow!', 'Edita tu descripción', 1, NULL, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(3, 'Gisela lara', 'Gisela@gmail.com', '$2y$10$aSANKPkEUY8fy3bbvehdbuNB3vbPPjzv2/VBrEp7oGjX23lDf1vR6', '1995-03-29', 'F', 'El Salvador', 'El refugio', 'La paz', '', '', 0, 21, 'img/profile/default.png', 'img/profile/portada.jpg', 'Musica, juegos, Economia', NULL, NULL, NULL, NULL, '¡Bienvenid@ a Shymow!', 'Edita tu descripción', 1, NULL, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(4, 'Developer prueba', 'developer@gmail.com', '$2y$10$JTIqHgB9AjcdaYrxAb0zvugpaYtgKS9KfNTvHcb3UjiotzHhD/tiu', '1995-03-29', 'M', 'El Salvador', 'El refugio', 'La paz', '', '', 0, 21, 'img/profile/default.png', 'img/profile/portada.jpg', 'Musica, juegos, Economia', NULL, NULL, NULL, NULL, '¡Bienvenid@ a Shymow!', 'Edita tu descripción', 1, NULL, '2016-10-21 09:23:38', '2016-10-21 09:23:38');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `perfil_id` int(10) UNSIGNED NOT NULL,
  `permission` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `permissions_perfil_id_foreign` (`perfil_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category_post_id` int(10) UNSIGNED NOT NULL,
  `profil_id` int(10) UNSIGNED NOT NULL,
  `like` int(11) NOT NULL DEFAULT '0',
  `qualification` int(11) NOT NULL DEFAULT '0',
  `posts` int(11) NOT NULL DEFAULT '0',
  `share` int(11) NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `posts_category_post_id_foreign` (`category_post_id`),
  KEY `posts_profil_id_foreign` (`profil_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `posts`
--

INSERT INTO `posts` (`id`, `description`, `category_post_id`, `profil_id`, `like`, `qualification`, `posts`, `share`, `active`, `created_at`, `updated_at`) VALUES
(1, 'Buenos Días', 1, 4, 0, 4, 0, 2, 1, '2016-10-21 09:25:04', '2016-10-21 09:27:53'),
(2, ':D', 1, 4, 0, 0, 0, 0, 1, '2016-10-21 09:25:30', '2016-10-21 09:25:30'),
(3, 'XD', 1, 4, 0, 0, 0, 0, 1, '2016-10-21 09:27:53', '2016-10-21 09:27:53');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `post_trends`
--

DROP TABLE IF EXISTS `post_trends`;
CREATE TABLE IF NOT EXISTS `post_trends` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `post_id` int(10) UNSIGNED NOT NULL,
  `trend_id` int(10) UNSIGNED NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `post_trends_post_id_foreign` (`post_id`),
  KEY `post_trends_trend_id_foreign` (`trend_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `store_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(6,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `send_type` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `garantia` tinyint(1) NOT NULL,
  `category_product_id` int(10) UNSIGNED NOT NULL,
  `type_product_id` int(10) UNSIGNED NOT NULL,
  `first_spesification_id` int(10) UNSIGNED NOT NULL,
  `last_spesification_id` int(10) UNSIGNED NOT NULL,
  `qualification` int(11) NOT NULL DEFAULT '0',
  `like` int(11) NOT NULL DEFAULT '0',
  `share` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `products_store_id_foreign` (`store_id`),
  KEY `products_category_product_id_foreign` (`category_product_id`),
  KEY `products_type_product_id_foreign` (`type_product_id`),
  KEY `products_first_spesification_id_foreign` (`first_spesification_id`),
  KEY `products_last_spesification_id_foreign` (`last_spesification_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `qualification_posts`
--

DROP TABLE IF EXISTS `qualification_posts`;
CREATE TABLE IF NOT EXISTS `qualification_posts` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `post_id` int(10) UNSIGNED NOT NULL,
  `profil_id` int(10) UNSIGNED NOT NULL,
  `qualification` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `qualification_posts_post_id_foreign` (`post_id`),
  KEY `qualification_posts_profil_id_foreign` (`profil_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `qualification_posts`
--

INSERT INTO `qualification_posts` (`id`, `post_id`, `profil_id`, `qualification`, `active`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 4, 1, '2016-10-21 09:25:09', '2016-10-21 09:25:09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `share_posts`
--

DROP TABLE IF EXISTS `share_posts`;
CREATE TABLE IF NOT EXISTS `share_posts` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `post_id` int(10) UNSIGNED NOT NULL,
  `profil_id` int(10) UNSIGNED NOT NULL,
  `new_post_id` int(10) UNSIGNED NOT NULL,
  `new_profil_id` int(10) UNSIGNED NOT NULL,
  `description_old_post` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `share_posts_post_id_foreign` (`post_id`),
  KEY `share_posts_profil_id_foreign` (`profil_id`),
  KEY `share_posts_new_post_id_foreign` (`new_post_id`),
  KEY `share_posts_new_profil_id_foreign` (`new_profil_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `share_posts`
--

INSERT INTO `share_posts` (`id`, `post_id`, `profil_id`, `new_post_id`, `new_profil_id`, `description_old_post`, `active`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 2, 4, 'Buenos Días', 1, '2016-10-21 09:25:30', '2016-10-21 09:25:30'),
(2, 1, 4, 3, 4, 'Buenos Días', 1, '2016-10-21 09:27:53', '2016-10-21 09:27:53');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `socials`
--

DROP TABLE IF EXISTS `socials`;
CREATE TABLE IF NOT EXISTS `socials` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `profile_id` int(10) UNSIGNED NOT NULL,
  `provider` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `social_id` text COLLATE utf8_unicode_ci NOT NULL,
  `access_token` text COLLATE utf8_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `socials_profile_id_foreign` (`profile_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `spesifications`
--

DROP TABLE IF EXISTS `spesifications`;
CREATE TABLE IF NOT EXISTS `spesifications` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `store_id` int(10) UNSIGNED NOT NULL,
  `spesification` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `spesifications_store_id_foreign` (`store_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `states`
--

DROP TABLE IF EXISTS `states`;
CREATE TABLE IF NOT EXISTS `states` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `countrie_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `states_countrie_id_index` (`countrie_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stores`
--

DROP TABLE IF EXISTS `stores`;
CREATE TABLE IF NOT EXISTS `stores` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `profile_id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_store` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `further_office` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `store_close` tinyint(1) NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `stores_profile_id_foreign` (`profile_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trends`
--

DROP TABLE IF EXISTS `trends`;
CREATE TABLE IF NOT EXISTS `trends` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `type_products`
--

DROP TABLE IF EXISTS `type_products`;
CREATE TABLE IF NOT EXISTS `type_products` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_product_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `type_products_category_product_id_foreign` (`category_product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `type_products`
--

INSERT INTO `type_products` (`id`, `category_product_id`, `name`, `active`, `created_at`, `updated_at`) VALUES
(1, 1, 'TV', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(2, 1, 'Radio', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(3, 1, 'PC', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(4, 1, 'Camaras', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(5, 1, 'Impresoras', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(6, 2, 'Reparación de PC', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(7, 2, 'Limpieza', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(8, 2, 'Decoraciones', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(9, 2, 'Labanderia', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(10, 2, 'Pasear perros', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(11, 3, 'Mesas', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(12, 3, 'Sillas', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(13, 3, 'Vitrinas', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(14, 3, 'Closet', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(15, 3, 'Gradas', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(16, 4, 'Música', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(17, 4, 'Accesorios', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(18, 4, 'Heramientas', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(19, 5, 'Hierbas', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(20, 5, 'Pizarra', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(21, 5, 'Semillas', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `type_send_products`
--

DROP TABLE IF EXISTS `type_send_products`;
CREATE TABLE IF NOT EXISTS `type_send_products` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `type_send_products`
--

INSERT INTO `type_send_products` (`id`, `name`, `active`, `created_at`, `updated_at`) VALUES
(1, 'No hago envíos', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(2, 'Si hago envíos', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38'),
(3, 'Acordar con el comprador', 1, '2016-10-21 09:23:38', '2016-10-21 09:23:38');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
