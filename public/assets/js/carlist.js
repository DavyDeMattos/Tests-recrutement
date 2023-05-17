const carlist = {

  /**
   * Function to Load car's data from API
   */
  load: async function() {
    console.log('Méthode load carlist appelée');

    // Call API with fetch method
    const response = await fetch(app.baseEndpoint + 'list');

    const carList = await response.json();

    // TODO add a loader to wait information from API

    // We create a row in the board for each car from carList
    for (const currentCar of carList) {
      car.create(currentCar);
    }
  },


}