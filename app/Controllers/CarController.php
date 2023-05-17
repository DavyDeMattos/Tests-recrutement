<?php

namespace App\Controllers;

use App\Models\Car;

class CarController extends CoreController
{
    /**
     * Function to get all cars
     *
     * @return void
     */
    public function listAction()
    {
        $carList = Car::findAll();
        //dump($carList);

        // En argument, on fournit le fichier de Vue
        // Par convention, chaque fichier de vue sera dans un sous-dossier du nom du Controller
        $this->show('car/list', [
            'carList' => $carList,
        ]);
    }

    /**
     * Function called by form to add a car
     */
    public function createAction()
    {
        // dump($_POST);
        // exit;
        $brand = filter_input(INPUT_POST, 'brand');
        $model = filter_input(INPUT_POST, 'model');
        // strtoupper = put letter to uppercase
        $registration = strtoupper(filter_input(INPUT_POST, 'registration'));
        $fuel = filter_input(INPUT_POST, 'fuel');
        // floatval = string to float
        $price = floatval(filter_input(INPUT_POST, 'price'));
        $kind = filter_input(INPUT_POST, 'kind');
        $reserved = filter_input(INPUT_POST, 'reserved');

        $newCar = new Car();
        
        // We use datas from form to set car's Model
        $newCar->setBrand($brand);
        $newCar->setModel($model);
        $newCar->setRegistration($registration);
        $newCar->setFuel($fuel);
        $newCar->setPrice($price);
        $newCar->setKind($kind);
        $newCar->setReserved($reserved);        

        $newCar->save();

        // Une fois la voiture insérée en BDD, on redirige vers la page liste des voitures
        $this->redirect('car-list');

    }

    /**
     * Function in charge of Méthode qui permet de traiter les infos envoyées par le formulaire d'édition
     *
     * @param int $id
     * @return void
     */
    public function updateAction($id) {

        // On récupère les infos  de la voiture depuis $_POST
        $brand = filter_input(INPUT_POST, 'brand');
        $model = filter_input(INPUT_POST, 'model');
        $registration = filter_input(INPUT_POST, 'registration');
        $fuel = filter_input(INPUT_POST, 'fuel');
        $price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_INT);
        $kind = filter_input(INPUT_POST, 'kind');
        $reserved = filter_input(INPUT_POST, 'reserved');

        // We check datas
        if($brand === "" || $brand === null) {
            echo "Le nom de la marque est obligatoire";
            exit;
        }
        if($model === "" || $model === null) {
            echo "Le nom du modèle est obligatoire";
            exit;
        }
        if($registration === "" || $registration === null) {
            echo "Le nom de la plaque est obligatoire";
            exit;
        }
        if($price === "" || $price === null) {
            echo "Le prix est obligatoire";
            exit;
        }

        // Get car to edit
        $carToEdit = Car::find($id);

        $carToEdit->setBrand($brand);
        $carToEdit->setModel($model);
        $carToEdit->setRegistration($registration);
        $carToEdit->setFuel($fuel);
        $carToEdit->setPrice($price);
        $carToEdit->setKind($kind);
        $carToEdit->setReserved($reserved);
   
        $carToEdit->save();

        $this->redirect('car-list');

    }
}                                           
