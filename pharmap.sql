SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";



CREATE TABLE `avis` (
  `id` int(11) NOT NULL,
  `id_pharmacien` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  `note` int(11) NOT NULL,
  `avis` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `tel` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `conges` (
  `id` int(11) NOT NULL,
  `id_pharmacien` int(11) NOT NULL,
  `cong_debut` date NOT NULL,
  `cong_fin` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `gardes` (
  `id` int(11) NOT NULL,
  `id_pharmacien` int(11) NOT NULL,
  `garde_date` date NOT NULL,
  `garde_debut` time NOT NULL,
  `garde_fin` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `ordonnances` (
  `id` int(11) NOT NULL,
  `id_pharmacien` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `date` date NOT NULL,
  `url` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `pharmaciens` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `numero` varchar(255) NOT NULL,
  `tel` varchar(255) NOT NULL,
  `assurance` int(11) NOT NULL,
  `lat` double NOT NULL,
  `lng` double NOT NULL,
  `ouverture` time NOT NULL,
  `fermeture` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



ALTER TABLE `avis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pharmacien` (`id_pharmacien`),
  ADD KEY `id_client` (`id_client`);
  
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);
  
ALTER TABLE `conges`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pharmacien` (`id_pharmacien`);
  
ALTER TABLE `gardes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pharmacien` (`id_pharmacien`);
  
ALTER TABLE `ordonnances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pharmacien` (`id_pharmacien`),
  ADD KEY `id_client` (`id_client`);
  
ALTER TABLE `pharmaciens`
  ADD PRIMARY KEY (`id`);
  


ALTER TABLE `avis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
  
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
  
ALTER TABLE `conges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
  
ALTER TABLE `gardes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
  
ALTER TABLE `ordonnances`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
  
ALTER TABLE `pharmaciens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
  


ALTER TABLE `avis`
  ADD CONSTRAINT `avis_ibfk_1` FOREIGN KEY (`id_client`) REFERENCES `clients` (`id`),
  ADD CONSTRAINT `avis_ibfk_2` FOREIGN KEY (`id_pharmacien`) REFERENCES `pharmaciens` (`id`);
  
ALTER TABLE `conges`
  ADD CONSTRAINT `conges_ibfk_1` FOREIGN KEY (`id_pharmacien`) REFERENCES `pharmaciens` (`id`);
  
ALTER TABLE `gardes`
  ADD CONSTRAINT `gardes_ibfk_1` FOREIGN KEY (`id_pharmacien`) REFERENCES `pharmaciens` (`id`);
  
ALTER TABLE `ordonnances`
  ADD CONSTRAINT `ordonnances_ibfk_1` FOREIGN KEY (`id_client`) REFERENCES `clients` (`id`),
  ADD CONSTRAINT `ordonnances_ibfk_2` FOREIGN KEY (`id_pharmacien`) REFERENCES `pharmaciens` (`id`);
COMMIT;