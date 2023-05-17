const form = {

  /**
   * Function which contains every operations to do at start of the page. Function call by app.init
   */
  init: function() {

    const newCarButton = document.querySelector('.btn btn-secondary add-car');
    newCarButton.addEventListener('click', form.handleFormSubmit);


  },

  /**
   * Function to clean form field
   */
  emptyForm: function() {

    document.querySelector('#brand').value = "";
    document.querySelector('#model').value = "";
    document.querySelector('#registration').value = "";
    document.querySelector('#price').value = "";
    document.querySelector('#fuel').value = "";
    document.querySelector('#kind').value = "";
    document.querySelector('#reserved').value = "";

  },

  /**
   * Function called when we submit the form
   */
  handleFormSubmit: async function(event) {

    // Block sending form to not allow refresh
    event.preventDefault();

    const brand = querySelector('#brand');
    const brandValue = brand.value;

    const model = querySelector('#model');
    const modelValue = model.value;

    const registration = querySelector('#registration');
    const registrationValue = registration.value;

    const price = querySelector('#price');
    const priceValue = price.value;

    const fuel = querySelector('#fuel');
    const fuelValue = fuel.value;

    const kind = querySelector('#kind');
    const kindValue = kind.value;

    const reserved = querySelector('#reserved');
    const reservedValue = reserved.value;


    // Object to be sent to API
    const data = {
      brand: brandValue,
      model: modelValue,
      registration: registrationValue,
      price: priceValue,
      fuel: fuelValue,
      kind: kindValue,
      reserved: reservedValue
    };

    const response = await fetch(app.baseEndpoint, {
        method: "POST",
        body: JSON.stringify(data),
        headers: {
            'Content-Type': 'application/json'
        }
    });

    // Response from API, translate from JSON to JS
    const createdTask = await response.json();

    // Add car to board
    car.create(createdTask);

    // To empty form
    form.emptyForm();

  }
}