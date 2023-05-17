const app = {

  baseEndpoint: "http://localhost:8080/car/",

  init: function() {

    // On démarre les modules qui ont besoin d'etre démarrés au chargement de la page
    console.log("app initialisé");

    app.loadCarFromAPI();

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

  loadCarFromAPI: async function() {
    console.log('Méthode loadCars appelée');

    const ajax = new XMLHttpRequest();
    ajax.open('POST', app.baseEndpoint + 'list');
    

    const response = await fetch(app.baseEndpoint + 'list');

    const carList = await response.json();
    console.log(carList);

  }

}
document.addEventListener('DOMContentLoaded', app.init);