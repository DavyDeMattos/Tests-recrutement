const carlist = {

  /**
   * Méthode chargeant les taches depuis l'API
   */
  load: async function() {
      console.log('Méthode load carlist appelée');

      // On contacte l'API à l'aide de la méthode fetch. Celle-ci est asynchrone (JS n'attend pas qu'elle soit terminée pour passer à autre chose), et on la rend "synchrone" à l'aide du mot-clé await
      const response = await fetch(app.baseEndpoint);

      // Après avoir récupéré la réponse de l'API dans la variable response, on la traduit de JSON vers JS avec la méthode json() (elle aussi asynchrone, donc on attend qu'elle ait terminé avec await)
      const carList = await response.json();

      // Une fois les taches reçues, on supprime le loader
      document.querySelector('.loader').remove();

      // On parcourt la liste des taches reçues pour les créer dans le DOM
      for (const currentCar of carList) {
          // Pour chaque tache de la liste, on appelle la méthode qui sert à créer une tache dans le DOM
          car.create(currentCar);
      }
  },


}