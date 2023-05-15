const app = {

  init: function() {

    // On démarre les modules qui ont besoin d'etre démarrés au chargement de la page
    console.log("coucou ici JS");

  }

}
document.addEventListener('DOMContentLoaded', app.init);