document.querySelectorAll('.supprimer').forEach(e => e.onclick = afficherFenetreModale);

/**
 * Affichage d'une fenêtre modale
 */
function afficherFenetreModale() {
  let locationHref = () => location.href = this.dataset.href;
  let annuler = () => document.getElementById('modaleSuppression').close();
  document.querySelector('#modaleSuppression .ok').onclick = locationHref;
  document.querySelector('#modaleSuppression .ko').onclick = annuler;
  document.getElementById('modaleSuppression').showModal();
  document.querySelector('#modaleSuppression .focus').focus();
}