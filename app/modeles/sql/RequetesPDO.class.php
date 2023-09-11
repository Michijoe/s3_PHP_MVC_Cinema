<?php

/**
 * Classe des requêtes PDO 
 *
 */
class RequetesPDO
{

  protected $sql;
  protected $params; // penser à initialiser systématiquement ce tableau, en lien avec la propriété $sql

  const UNE_SEULE_LIGNE = true;

  /**
   * Récupération d'une ou plusieurs ligne de la requête $sql
   * @param array   $params paramètres de la requête préparée
   * @param boolean $uneSeuleLigne true si une seule ligne à récupérer false sinon 
   * @return array|false false si aucune ligne retournée par fetch
   */
  public function getLignes($uneSeuleLigne = false)
  {
    $sPDO = SingletonPDO::getInstance();
    $oPDOStatement = $sPDO->prepare($this->sql);
    foreach ($this->params as $marqueur => $valeur) {
      // $oPDOStatement->bindValue(":$marqueur", $valeur);
      $oPDOStatement->bindParam(":$marqueur", $this->params[$marqueur]);
    }
    $oPDOStatement->execute();
    return $uneSeuleLigne ? $oPDOStatement->fetch(PDO::FETCH_ASSOC) : $oPDOStatement->fetchAll(PDO::FETCH_ASSOC);
  }

  /**
   * Requête $sql de Création Update ou Delete d'une ligne
   * @return boolean|string chaîne contenant lastInsertId s'il est > 0
   */
  public function CUDLigne()
  {
    $sPDO = SingletonPDO::getInstance();

    $oPDOStatement = $sPDO->prepare($this->sql);
    foreach ($this->params as $marqueur => $valeur) {
      $oPDOStatement->bindValue(":$marqueur", $valeur);
      // $oPDOStatement->bindParam(":$marqueur", $this->params[$marqueur]);
    }
    $oPDOStatement->execute();
    if ($oPDOStatement->rowCount() <= 0) return false;
    if ($sPDO->lastInsertId() > 0)       return $sPDO->lastInsertId();
    return true;
  }
}
