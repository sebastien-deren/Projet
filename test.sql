-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : ven. 09 sep. 2022 à 09:25
-- Version du serveur : 10.4.24-MariaDB
-- Version de PHP : 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `test`
--

-- --------------------------------------------------------

--
-- Structure de la table `commands`
--

CREATE TABLE `commands` (
  `id` int(11) NOT NULL,
  `n_command` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `product_text` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `commands`
--

INSERT INTO `commands` (`id`, `n_command`, `id_users`, `product_text`, `date`) VALUES
(25, 0, 11, 'emmental , 3 , 1800 ', '2022-09-07'),
(26, 1, 11, 'emmental , 4 , 1800 ', '2022-09-07'),
(27, 2, 11, 'beurre 250g , 2 , 250 ', '2022-09-07');

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

CREATE TABLE `panier` (
  `id_panier` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `quantity_cart` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `panier`
--

INSERT INTO `panier` (`id_panier`, `id_product`, `id_user`, `quantity_cart`) VALUES
(25, 3, 15, 5),
(26, 10, 15, 6),
(65, 3, 11, 2);

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

CREATE TABLE `products` (
  `id_product` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_quantity` varchar(64) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `products`
--

INSERT INTO `products` (`id_product`, `category`, `name`, `quantity`, `unit_quantity`, `price`) VALUES
(3, 'BOF', 'beurre 250g', 133, 'pièce', 250),
(4, 'BOF', 'emmental', 29980, 'kg', 1800),
(7, 'BOF', 'yaourt aux fruits 4 pot', 35, 'pièce', 500),
(8, 'viande', 'haché 8*100g', 36, 'pièce', 1500),
(9, 'viande', 'Côte de boeuf 1,2kg', 90775, 'kg', 3500),
(10, 'legumes', 'carottes', 49991, 'kg', 500),
(11, 'legumes', 'choux', 189, 'pièce', 100),
(12, 'BOF', 'reblochon', 26946, 'kg', 3000),
(13, 'Poisson', 'maquerau au groseilles', 10, 'boites', 200);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `full_name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `passwrd` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id_user`, `full_name`, `email`, `passwrd`) VALUES
(11, 'seb seb', 'seb.seb@seb.seb', '$2y$10$yLj8jOZ88NJPwviLiJDa4OYCEqdvEFwk18jcQKMjUSWsQMZzp7vKC'),
(15, 'jean jean', 'jean.jean@jean.jean', '$2y$10$DuQRsGsesxkcLceyOZFq5u8quSJAcP6lGOH80B0QNGOGmvzpaTpDe'),
(16, 'sdf sdf', 'p.f@g.com', '$2y$10$h8TLnQbqoeDBnyvNyahlB.jRGeBkYQNCD8.daDTAK0uwZE3RmDytG');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `commands`
--
ALTER TABLE `commands`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `panier`
--
ALTER TABLE `panier`
  ADD PRIMARY KEY (`id_panier`);

--
-- Index pour la table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id_product`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `commands`
--
ALTER TABLE `commands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT pour la table `panier`
--
ALTER TABLE `panier`
  MODIFY `id_panier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT pour la table `products`
--
ALTER TABLE `products`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
