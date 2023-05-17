const car = {

  /**
   * Function which add a car in the board
   * @param {Object} newCar Object wich car'sdata
   */
  create: function(newCar) {

    const template = document.querySelector('#car-template');

    const clone = template.content.cloneNode(true);

    const trElement = clone.querySelector('tr');

    trElement.dataset.id = newCar.id;
    trElement.textContent = newCar.id;

    const tdElements = document.querySelectorAll('td');

    tdElements[0].textContent = newCar.brand;
    tdElements[1].textContent = newCar.model;
    tdElements[2].textContent = newCar.registration;
    tdElements[3].textContent = newCar.fuel;
    tdElements[4].textContent = `${newCar.price} €`;
    tdElements[5].textContent = newCar.kind;
    tdElements[6].textContent = newCar.reserved;

    const listElement = document.querySelector('.table-group-divider');

    listElement.append(trElement);

  },
   
  /**
   * Function call when we click on Delete Button on car List
   * @param {Event} event 
   */
  handleDeleteClick: async function(event) {

    const deleteButton = event.currentTarget;
    
    const carElement = deleteButton.closest('tr');

    const id = carElement.dataset.id;

    const response = await fetch(app.baseEndpoint + id, {
        method: 'DELETE'
    });

    if(response.status === 204) {
      carElement.remove();
    }
  },

  /**
   * Function call when we click on Edit Button on car List
   * @param {Event} event 
   */
  handleEditClick: async function(event) {

    const editButton = event.currentTarget;
    
    const carElement = editButton.closest('tr');

    const id = carElement.dataset.id;

    const response = await fetch(app.baseEndpoint + id, {
        method: 'GET'
    });

    const car = response.data

    if(response.status === 204) {

      const inputElements = document.querySelectorAll('input');
      const optionElements = document.querySelectorAll('option');

      // loop on car proprieties in json 
      for (const key in car){
        // loop on form inputs
        for (const input of inputElements){
          if (input.dataset.name === key){
            input.textContent = car[key];
          }
        }
        // loop on <select>'s <option> to attribute selected data
        for (const option of optionElements){
          if (option.dataset.value === car[key]){
            option.setAttribute('selected');
          }
        }
      }
      
    }

  },

  /**
   * Function which add Listener to  delete and edit buttons
   * @param {DOMElement} carElement 
   */
  addListeners: function(carElement) {

    const deleteButton  = carElement.querySelector('.button--delete');
    deleteButton.addEventListener('click', car.handleDeleteClick);

    const editButton  = carElement.querySelector('.button--edit');
    editButton.addEventListener('click', car.handleEditClick);
  }
}