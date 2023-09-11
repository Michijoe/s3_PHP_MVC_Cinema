<?php

class Utilisateur
{
    private $utilisateur_id;
    private $utilisateur_nom;
    private $utilisateur_prenom;
    private $utilisateur_courriel;
    private $utilisateur_mdp;
    private $utilisateur_renouveler_mdp;
    private $utilisateur_profil;

    const PROFIL_ADMINISTRATEUR = "administrateur";
    const PROFIL_EDITEUR        = "editeur";
    const PROFIL_CORRECTEUR     = "correcteur";
    const PROFIL_CLIENT         = "client";

    private $erreurs = [];

    /**
     * Constructeur de la classe 
     * @param array $proprietes, tableau associatif des propriétés 
     */
    public function __construct($proprietes = [])
    {
        foreach ($proprietes as $nom_propriete => $val_propriete) {
            $this->__set($nom_propriete, $val_propriete);
        }
    }

    /**
     * Accesseur magique d'une propriété de l'objet
     * @param string $prop, nom de la propriété
     * @return property value
     */
    public function __get($prop)
    {
        return $this->$prop;
    }

    /**
     * Accesseurs unitaires pour y accéder via twig dans les templates
     */
    public function getUtilisateur_id()
    {
        return $this->utilisateur_id;
    }

    public function getUtilisateur_nom()
    {
        return $this->utilisateur_nom;
    }

    public function getUtilisateur_prenom()
    {
        return $this->utilisateur_prenom;
    }

    public function getUtilisateur_courriel()
    {
        return $this->utilisateur_courriel;
    }

    public function getUtilisateur_mdp()
    {
        return $this->utilisateur_mdp;
    }

    public function getUtilisateur_renouveler_mdp()
    {
        return $this->utilisateur_renouveler_mdp;
    }

    public function getUtilisateur_profil()
    {
        return $this->utilisateur_profil;
    }

    /**
     * Mutateur magique qui exécute le mutateur de la propriété en paramètre 
     * @param string $prop, nom de la propriété
     * @param $val, contenu de la propriété à mettre à jour
     */
    public function __set($prop, $val)
    {
        $setProperty = 'set' . ucfirst($prop);
        $this->$setProperty($val);
    }

    /**
     * Mutateur de la propriété utilisateur_id 
     * @param int $utilisateur_id
     * @return $this
     */
    public function setutilisateur_id($utilisateur_id)
    {
        unset($this->erreurs['utilisateur_id']);
        $regExp = '/^[1-9]\d*$/';
        if (!preg_match($regExp, $utilisateur_id)) {
            $this->erreurs['utilisateur_id'] = "Numéro d'utilisateur incorrect.";
        }
        $this->utilisateur_id = $utilisateur_id;
        return $this;
    }

    /**
     * Mutateur de la propriété utilisateur_nom 
     * @param string $utilisateur_nom
     * @return $this
     */
    public function setutilisateur_nom($utilisateur_nom)
    {
        unset($this->erreurs['utilisateur_nom']);
        $utilisateur_nom = trim($utilisateur_nom);
        $regExp = '/^[a-zÀ-ÖØ-öø-ÿ]{2,}( [a-zÀ-ÖØ-öø-ÿ]{2,})*$/i';
        if (!preg_match($regExp, $utilisateur_nom)) {
            $this->erreurs['utilisateur_nom'] = "Au moins 2 caractères alphabétiques pour chaque mot.";
        }
        $this->utilisateur_nom = $utilisateur_nom;
        return $this;
    }

    /**
     * Mutateur de la propriété utilisateur_prenom 
     * @param string $utilisateur_prenom
     * @return $this
     */
    public function setutilisateur_prenom($utilisateur_prenom)
    {
        unset($this->erreurs['utilisateur_prenom']);
        $utilisateur_prenom = trim($utilisateur_prenom);
        $regExp = '/^\p{L}{2,}( \p{L}{2,})*$/ui';
        if (!preg_match($regExp, $utilisateur_prenom)) {
            $this->erreurs['utilisateur_prenom'] = "Au moins 2 caractères alphabétiques pour chaque mot.";
        }
        $this->utilisateur_prenom = $utilisateur_prenom;
        return $this;
    }

    /**
     * Mutateur de la propriété utilisateur_courriel 
     * @param string $utilisateur_courriel
     * @return $this
     */
    public function setutilisateur_courriel($utilisateur_courriel)
    {
        unset($this->erreurs['utilisateur_courriel']);
        $utilisateur_courriel = trim($utilisateur_courriel);
        $regExp = "/^[a-zA-Z0-9.!#$%&’*+\=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/";
        if (!preg_match($regExp, $utilisateur_courriel)) {
            $this->erreurs['utilisateur_courriel'] = "Format incorrect.";
        }
        $this->utilisateur_courriel = $utilisateur_courriel;
        return $this;
    }

    /**
     * Mutateur de la propriété utilisateur_mdp 
     * @param string $utilisateur_mdp
     * @return $this
     */
    public function setutilisateur_mdp($utilisateur_mdp)
    {
        unset($this->erreurs['utilisateur_mdp']);
        $regExp = '/^(?=.*[!:%=])(?=.*[A-Z])(?=.*[a-z])(?=.*\d).{10,}$/';
        if (!preg_match($regExp, $utilisateur_mdp)) {
            $this->erreurs['utilisateur_mdp'] = "Au moins 10 car., un car. parmis %!:=, une majuscule, une minuscule et un chiffre.";
        }
        $this->utilisateur_mdp = $utilisateur_mdp;
        return $this;
    }

    /**
     * Mutateur de la propriété utilisateur_renouveler_mdp 
     * @param string $utilisateur_renouveler_mdp
     * @return $this
     */
    public function setutilisateur_renouveler_mdp($utilisateur_renouveler_mdp)
    {
        $this->utilisateur_renouveler_mdp = $utilisateur_renouveler_mdp;
        return $this;
    }

    /**
     * Mutateur de la propriété utilisateur_profil 
     * @param string $utilisateur_profil
     * @return $this
     */
    public function setutilisateur_profil($utilisateur_profil)
    {
        $this->utilisateur_profil = $utilisateur_profil;
        return $this;
    }
}
