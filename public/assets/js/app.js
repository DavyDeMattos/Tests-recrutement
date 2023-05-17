const app = {
  // To configure path of API
  baseEndpoint: "http://localhost:8080/car/",

  init: function() {

    console.log("app initialisé");

    carlist.load();

    form.init();

  }
}
document.addEventListener('DOMContentLoaded', app.init);