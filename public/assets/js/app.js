const app = {

  init: function() {

    // On démarre les modules qui ont besoin d'etre démarrés au chargement de la page
    console.log("app initialisé");

    // app.loadTaskFromAPI();

    const editButtons = document.querySelectorAll('.button--edit');
    const deleteButtons = document.querySelectorAll('.button--delete');
    
    for (const currentEditButtons of editButtons) {
      currentEditButtons.addEventListener('click', app.handleEditButtons);
    }
    for (const currentDeleteButtons of deleteButtons) {
      currentDeleteButtons.addEventListener('click', app.handleDeleteButtons);
    }
  },

  handleEditButtons: function (event) {
    console.log('function handleEditButtons call');
    const carId = event.currentTarget.getAttribute('for');
    console.log(carId);
    
  },

  handleDeleteButtons: function (event) {
    console.log('function handleDeleteButtons call');
    console.log(event.currentTarget.getAttribute('for'));
  },

  loadTaskFromAPI: async function() {
    console.log('Méthode loadTasks appelée');

    const response = await fetch('http://localhost:8000/car/list');
    console.log(response);
  }

}
document.addEventListener('DOMContentLoaded', app.init);