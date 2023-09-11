<?php

/**
 * Classe Contrôleur des requêtes de l'application admin
 */

class Admin extends Routeur
{
  private $entite;
  private $action;
  private $utilisateur_id;

  private $methodes = [
    'film' => [
      'l' => ['methode' => 'listerFilms', 'droits' => [Utilisateur::PROFIL_ADMINISTRATEUR, Utilisateur::PROFIL_EDITEUR, Utilisateur::PROFIL_CORRECTEUR]],
      'a' => ['methode' => 'ajouterFilm', 'droits' => [Utilisateur::PROFIL_ADMINISTRATEUR, Utilisateur::PROFIL_EDITEUR]],
      'm' => ['methode' => 'modifierFilm', 'droits' => [Utilisateur::PROFIL_ADMINISTRATEUR, Utilisateur::PROFIL_EDITEUR, Utilisateur::PROFIL_CORRECTEUR]],
      's' => ['methode' => 'supprimerFilm', 'droits' => [Utilisateur::PROFIL_ADMINISTRATEUR, Utilisateur::PROFIL_EDITEUR]]
    ],
    'genre' => [
      'l' => ['methode' => 'listerGenres', 'droits' => [Utilisateur::PROFIL_ADMINISTRATEUR, Utilisateur::PROFIL_EDITEUR, Utilisateur::PROFIL_CORRECTEUR]],
      'a' => ['methode' => 'ajouterGenre', 'droits' => [Utilisateur::PROFIL_ADMINISTRATEUR, Utilisateur::PROFIL_EDITEUR]],
      'm' => ['methode' => 'modifierGenre', 'droits' => [Utilisateur::PROFIL_ADMINISTRATEUR, Utilisateur::PROFIL_EDITEUR, Utilisateur::PROFIL_CORRECTEUR]],
      's' => ['methode' => 'supprimerGenre', 'droits' => [Utilisateur::PROFIL_ADMINISTRATEUR, Utilisateur::PROFIL_EDITEUR]]
    ],
    'realisateur' => [
      'l' => ['methode' => 'listerRealisateurs', 'droits' => [Utilisateur::PROFIL_ADMINISTRATEUR, Utilisateur::PROFIL_EDITEUR, Utilisateur::PROFIL_CORRECTEUR]],
      'a' => ['methode' => 'ajouterRealisateur', 'droits' => [Utilisateur::PROFIL_ADMINISTRATEUR, Utilisateur::PROFIL_EDITEUR]],
      'm' => ['methode' => 'modifierRealisateur', 'droits' => [Utilisateur::PROFIL_ADMINISTRATEUR, Utilisateur::PROFIL_EDITEUR, Utilisateur::PROFIL_CORRECTEUR]],
      's' => ['methode' => 'supprimerRealisateur', 'droits' => [Utilisateur::PROFIL_ADMINISTRATEUR, Utilisateur::PROFIL_EDITEUR]]
    ],
    'acteur' => [
      'l' => ['methode' => 'listerActeurs', 'droits' => [Utilisateur::PROFIL_ADMINISTRATEUR, Utilisateur::PROFIL_EDITEUR, Utilisateur::PROFIL_CORRECTEUR]],
      'a' => ['methode' => 'ajouterActeur', 'droits' => [Utilisateur::PROFIL_ADMINISTRATEUR, Utilisateur::PROFIL_EDITEUR]],
      'm' => ['methode' => 'modifierActeur', 'droits' => [Utilisateur::PROFIL_ADMINISTRATEUR, Utilisateur::PROFIL_EDITEUR, Utilisateur::PROFIL_CORRECTEUR]],
      's' => ['methode' => 'supprimerActeur', 'droits' => [Utilisateur::PROFIL_ADMINISTRATEUR, Utilisateur::PROFIL_EDITEUR]]
    ],
    'pays' => [
      'l' => ['methode' => 'listerPays', 'droits' => [Utilisateur::PROFIL_ADMINISTRATEUR, Utilisateur::PROFIL_EDITEUR, Utilisateur::PROFIL_CORRECTEUR]],
      'a' => ['methode' => 'ajouterPays', 'droits' => [Utilisateur::PROFIL_ADMINISTRATEUR, Utilisateur::PROFIL_EDITEUR]],
      'm' => ['methode' => 'modifierPays', 'droits' => [Utilisateur::PROFIL_ADMINISTRATEUR, Utilisateur::PROFIL_EDITEUR, Utilisateur::PROFIL_CORRECTEUR]],
      's' => ['methode' => 'supprimerPays', 'droits' => [Utilisateur::PROFIL_ADMINISTRATEUR, Utilisateur::PROFIL_EDITEUR]]
    ],
    'seance' => [
      'l' => ['methode' => 'listerSeances', 'droits' => [Utilisateur::PROFIL_ADMINISTRATEUR, Utilisateur::PROFIL_EDITEUR, Utilisateur::PROFIL_CORRECTEUR]],
      'a' => ['methode' => 'ajouterSeance', 'droits' => [Utilisateur::PROFIL_ADMINISTRATEUR, Utilisateur::PROFIL_EDITEUR]],
      'm' => ['methode' => 'modifierSeance', 'droits' => [Utilisateur::PROFIL_ADMINISTRATEUR, Utilisateur::PROFIL_EDITEUR, Utilisateur::PROFIL_CORRECTEUR]],
      's' => ['methode' => 'supprimerSeance', 'droits' => [Utilisateur::PROFIL_ADMINISTRATEUR, Utilisateur::PROFIL_EDITEUR]]
    ],
    'salle' => [
      'l' => ['methode' => 'listerSalles', 'droits' => [Utilisateur::PROFIL_ADMINISTRATEUR, Utilisateur::PROFIL_EDITEUR, Utilisateur::PROFIL_CORRECTEUR]],
      'a' => ['methode' => 'ajouterSalle', 'droits' => [Utilisateur::PROFIL_ADMINISTRATEUR, Utilisateur::PROFIL_EDITEUR]],
      'm' => ['methode' => 'modifierSalle', 'droits' => [Utilisateur::PROFIL_ADMINISTRATEUR, Utilisateur::PROFIL_EDITEUR, Utilisateur::PROFIL_CORRECTEUR]],
      's' => ['methode' => 'supprimerSalle', 'droits' => [Utilisateur::PROFIL_ADMINISTRATEUR, Utilisateur::PROFIL_EDITEUR]]
    ],
    'utilisateur' => [
      'd' => ['methode' => 'deconnecter', 'droits' => [Utilisateur::PROFIL_ADMINISTRATEUR, Utilisateur::PROFIL_EDITEUR, Utilisateur::PROFIL_CORRECTEUR]],
      'l' => ['methode' => 'listerUtilisateurs', 'droits' => [Utilisateur::PROFIL_ADMINISTRATEUR]],
      'a' => ['methode' => 'ajouterUtilisateur', 'droits' => [Utilisateur::PROFIL_ADMINISTRATEUR]],
      'm' => ['methode' => 'modifierUtilisateur', 'droits' => [Utilisateur::PROFIL_ADMINISTRATEUR]],
      's' => ['methode' => 'supprimerUtilisateur', 'droits' => [Utilisateur::PROFIL_ADMINISTRATEUR]]
    ]
  ];

  private $messageRetourAction;
  private $classeRetourAction = 'fait';



  /**
   * Constructeur qui initialise le contexte du contrôleur  
   */
  public function __construct()
  {
    $this->entite    = $_GET['entite']    ?? 'film';
    $this->action    = $_GET['action']    ?? 'l';
    $this->utilisateur_id = $_GET['utilisateur_id'] ?? null;
    $this->oRequetesSQL = new RequetesSQL;
  }


  /**
   * Gérer l'interface d'administration 
   */
  public function gererAdmin()
  {
    if (isset($_SESSION['oUtilConn'])) {
      $this->oUtilConn = $_SESSION['oUtilConn'];
      if (isset($this->methodes[$this->entite])) {
        if (isset($this->methodes[$this->entite][$this->action])) {
          $methode = $this->methodes[$this->entite][$this->action]['methode'];
          $droits = $this->methodes[$this->entite][$this->action]['droits'];
          if (in_array($this->oUtilConn->utilisateur_profil, $droits)) {
            $this->$methode();
          } else {
            throw new Exception(self::ERROR_FORBIDDEN);
          }
        } else {
          throw new Exception("L'action $this->action de l'entité $this->entite n'existe pas.");
        }
      } else {
        throw new Exception("L'entité $this->entite n'existe pas.");
      }
    } else {
      $this->connecter();
    }
  }

  /**
   * Connexion d'un utilisateur
   */
  public function connecter()
  {
    if (count($_POST) > 0) {
      $utilisateur = $this->oRequetesSQL->connecter($_POST);
      if ($utilisateur !== false) {
        $_SESSION['oUtilConn'] = new Utilisateur($utilisateur);
        $this->gererAdmin();
        exit;
      } else {
        $messageErreurConnexion = 'Courriel ou mot de passe erronés';
      }
    } else {
      $messageErreurConnexion = '';
    }
    new Vue(
      'modaleConnexionAdmin',
      [
        'titre' => 'Connexion',
        'messageErreurConnexion' => $messageErreurConnexion
      ],
      'gabarit-admin-min'
    );
  }

  /**
   * Déconnexion d'un utilisateur
   */
  public function deconnecter()
  {
    unset($_SESSION['oUtilConn']);
    $this->connecter();
  }

  /**
   * Lister les utilisateurs
   */
  public function listerUtilisateurs()
  {
    if ($this->oUtilConn->utilisateur_profil == Utilisateur::PROFIL_CLIENT) {
      throw new Exception(self::ERROR_FORBIDDEN);
    }
    $utilisateurs = $this->oRequetesSQL->getUtilisateurs();

    new Vue(
      'vAdminUtilisateurs',
      [
        'oUtilConn'           => $this->oUtilConn,
        'titre'               => 'Gestion des utilisateurs',
        'messageRetourAction' => $this->messageRetourAction,
        'classeRetourAction'  => $this->classeRetourAction,
        'utilisateurs'        => $utilisateurs
      ],
      'gabarit-admin'
    );
  }

  /** 
   * Ajouter un utilisateur
   */
  public function ajouterUtilisateur()
  {
    if ($this->oUtilConn->utilisateur_profil == Utilisateur::PROFIL_CLIENT || $this->oUtilConn->utilisateur_profil == Utilisateur::PROFIL_CORRECTEUR) {
      throw new Exception(self::ERROR_FORBIDDEN);
    }
    if (count($_POST) > 0) {
      $utilisateur = $_POST;
      $oUtilisateur = new Utilisateur($utilisateur);
      $erreurs = $oUtilisateur->erreurs;
      if (count($erreurs) === 0) {
        $utilisateur_id = $this->oRequetesSQL->ajouterUtilisateur(
          [
            'utilisateur_nom'    => $oUtilisateur->utilisateur_nom,
            'utilisateur_prenom'    => $oUtilisateur->utilisateur_prenom,
            'utilisateur_courriel'    => $oUtilisateur->utilisateur_courriel,
            'utilisateur_mdp'    => $oUtilisateur->utilisateur_mdp,
            'utilisateur_profil'    => $oUtilisateur->utilisateur_profil
          ]
        );
        if ($utilisateur_id > 0) {
          $this->messageRetourAction = "L'utilisateur numéro $utilisateur_id a été ajouté.";
        } else {
          $this->messageRetourAction = "Ajout d'un utilisateur non effectué.";
          $this->classeRetourAction  = "erreur";
        }
        $this->listerUtilisateurs();
        exit;
      }
    } else {
      $utilisateur  = [];
      $erreurs = [];
    }

    new Vue(
      'vAdminUtilisateurAjouter',
      [
        'oUtilConn'           => $this->oUtilConn,
        'titre'  => "Ajout d'un utilisateur",
        'utilisateur' => $utilisateur,
        'erreurs' => $erreurs
      ],
      'gabarit-admin'
    );
  }

  /**
   * Modifier un utilisateur identifié par sa clé dans la propriété utilisateur_id
   */
  public function modifierUtilisateur()
  {
    if ($this->oUtilConn->utilisateur_profil == Utilisateur::PROFIL_CLIENT) {
      throw new Exception(self::ERROR_FORBIDDEN);
    }
    if (count($_POST) > 0) {
      $utilisateur = $_POST;
      $oUtilisateur = new Utilisateur($utilisateur);
      $erreurs = $oUtilisateur->erreurs;
      if (count($erreurs) == 0) {
        if ($this->oRequetesSQL->modifierUtilisateur(
          [
            'utilisateur_id'     => $oUtilisateur->utilisateur_id,
            'utilisateur_nom'    => $oUtilisateur->utilisateur_nom,
            'utilisateur_prenom' => $oUtilisateur->utilisateur_prenom,
            'utilisateur_courriel'    => $oUtilisateur->utilisateur_courriel,
            'utilisateur_profil'    => $oUtilisateur->utilisateur_profil
          ]
        )) {
          $this->messageRetourAction = "L'utilisateur numéro $this->utilisateur_id a été modifié.";
        } else {
          $this->messageRetourAction = "Modification de l'utilisateur numéro $this->utilisateur_id non effectuée.";
          $this->classeRetourAction = 'erreur';
        }
        $this->listerUtilisateurs();
        exit;
      }
    } else {
      $utilisateur = $this->oRequetesSQL->getUtilisateur($this->utilisateur_id);
      if (!$utilisateur) throw new Exception('Utilisateur inexistant.');
      $erreurs = [];
    }

    new Vue(
      'vAdminUtilisateurModifier',
      [
        'oUtilConn'           => $this->oUtilConn,
        'titre'  => "Modification de l'utilisateur numéro $this->utilisateur_id",
        'utilisateur' => $utilisateur,
        'erreurs' => $erreurs
      ],
      'gabarit-admin'
    );
  }

  /**
   * Supprimer un utilisateur identifié par sa clé dans la propriété utilisateur_id
   */
  public function supprimerUtilisateur()
  {
    if ($this->oUtilConn->utilisateur_profil == Utilisateur::PROFIL_CLIENT || $this->oUtilConn->utilisateur_profil == Utilisateur::PROFIL_CORRECTEUR) {
      throw new Exception(self::ERROR_FORBIDDEN);
    }
    if ($this->oRequetesSQL->supprimerUtilisateur($this->utilisateur_id)) {
      $this->messageRetourAction = "L'utilisateur numéro $this->utilisateur_id a été supprimé.";
    } else {
      $this->messageRetourAction = "Suppression de l'utilisateur numéro $this->utilisateur_id non effectuée.";
      $this->classeRetourAction = 'erreur';
    }
    $this->listerUtilisateurs();
  }


  // DÉVELOPPEMENT EN COURS
  ////////////////////////////////////////////////////

  /**
   * Lister les films
   */
  public function listerFilms()
  {
    if ($this->oUtilConn->utilisateur_profil == Utilisateur::PROFIL_CLIENT) {
      throw new Exception(self::ERROR_FORBIDDEN);
    }
    new Vue(
      'vAdminDeveloppementEnCours',
      [
        'titre'               => 'Gestion des films',
        'oUtilConn'           => $this->oUtilConn,
        'messageErreur'       => 'Développement en cours.',
        'entite'              => $this->entite
      ],
      'gabarit-admin'
    );
  }

  /**
   * Lister les genres
   */
  public function listerGenres()
  {
    if ($this->oUtilConn->utilisateur_profil == Utilisateur::PROFIL_CLIENT) {
      throw new Exception(self::ERROR_FORBIDDEN);
    }
    new Vue(
      'vAdminDeveloppementEnCours',
      [
        'titre'               => 'Gestion des genres',
        'oUtilConn'           => $this->oUtilConn,
        'messageErreur'       => 'Développement en cours.',
        'entite'              => $this->entite
      ],
      'gabarit-admin'
    );
  }

  /**
   * Lister les réalisateurs
   */
  public function listerRealisateurs()
  {
    if ($this->oUtilConn->utilisateur_profil == Utilisateur::PROFIL_CLIENT) {
      throw new Exception(self::ERROR_FORBIDDEN);
    }
    new Vue(
      'vAdminDeveloppementEnCours',
      [
        'titre'               => 'Gestion des réalisateurs',
        'oUtilConn'           => $this->oUtilConn,
        'messageErreur'       => 'Développement en cours.',
        'entite'              => $this->entite
      ],
      'gabarit-admin'
    );
  }

  /**
   * Lister les acteurs
   */
  public function listerActeurs()
  {
    if ($this->oUtilConn->utilisateur_profil == Utilisateur::PROFIL_CLIENT) {
      throw new Exception(self::ERROR_FORBIDDEN);
    }
    new Vue(
      'vAdminDeveloppementEnCours',
      [
        'titre'               => 'Gestion des acteurs',
        'oUtilConn'           => $this->oUtilConn,
        'messageErreur'       => 'Développement en cours.',
        'entite'              => $this->entite
      ],
      'gabarit-admin'
    );
  }

  /**
   * Lister les pays
   */
  public function listerPays()
  {
    if ($this->oUtilConn->utilisateur_profil == Utilisateur::PROFIL_CLIENT) {
      throw new Exception(self::ERROR_FORBIDDEN);
    }
    new Vue(
      'vAdminDeveloppementEnCours',
      [
        'titre'               => 'Gestion des pays',
        'oUtilConn'           => $this->oUtilConn,
        'messageErreur'       => 'Développement en cours.',
        'entite'              => $this->entite
      ],
      'gabarit-admin'
    );
  }

  /**
   * Lister les seances
   */
  public function listerSeances()
  {
    if ($this->oUtilConn->utilisateur_profil == Utilisateur::PROFIL_CLIENT) {
      throw new Exception(self::ERROR_FORBIDDEN);
    }
    new Vue(
      'vAdminDeveloppementEnCours',
      [
        'titre'               => 'Gestion des séances',
        'oUtilConn'           => $this->oUtilConn,
        'messageErreur'       => 'Développement en cours.',
        'entite'              => $this->entite
      ],
      'gabarit-admin'
    );
  }

  /**
   * Lister les salles
   */
  public function listerSalles()
  {
    if ($this->oUtilConn->utilisateur_profil == Utilisateur::PROFIL_CLIENT) {
      throw new Exception(self::ERROR_FORBIDDEN);
    }
    new Vue(
      'vAdminDeveloppementEnCours',
      [
        'titre'               => 'Gestion des salles',
        'oUtilConn'           => $this->oUtilConn,
        'messageErreur'       => 'Développement en cours.',
        'entite'              => $this->entite
      ],
      'gabarit-admin'
    );
  }
}
