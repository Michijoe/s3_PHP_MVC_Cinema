DROP TABLE IF EXISTS utilisateur;

--

-- Structure de la table utilisateur

--

CREATE TABLE
    utilisateur (
        utilisateur_id int UNSIGNED NOT NULL AUTO_INCREMENT,
        utilisateur_nom varchar(255) NOT NULL,
        utilisateur_prenom varchar(255) NOT NULL,
        utilisateur_courriel varchar(255) NOT NULL UNIQUE,
        utilisateur_mdp varchar(255) NOT NULL,
        utilisateur_renouveler_mdp char(3) NOT NULL DEFAULT 'oui',
        utilisateur_profil varchar(255) NOT NULL,
        PRIMARY KEY (utilisateur_id)
    ) ENGINE = InnoDB DEFAULT CHARSET = UTF8;

INSERT INTO utilisateur
VALUES (
        1,
        "Dac",
        "Pierre",
        "pierre.dac@site1.ca",
        SHA2("a1b2c3d4e5", 512),
        "oui",
        "administrateur"
    ), (
        2,
        "Tremblay",
        "Jean",
        "jean.tremblay@site2.ca",
        SHA2("f1g2h3i4j5", 512),
        "oui",
        "editeur"
    ), (
        3,
        "Lepetit",
        "Olivier",
        "olivier.lepetit@site3.ca",
        SHA2("k1l2m3n4o5", 512),
        "oui",
        "correcteur"
    ), (
        4,
        "Legrand",
        "Jacques",
        "jacques.legrand@site4.ca",
        SHA2("p1q2r3s4t5", 512),
        "oui",
        "client"
    );