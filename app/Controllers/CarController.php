<?php

namespace App\Controllers;

use App\Models\Car;

class CarController extends CoreController
{
    /**
     * Méthode s'occupant de la liste des voitures
     *
     * @return void
     */
    public function listAction()
    {
        // On veut récupérer la liste de toutes les voitures
        // On demande donc à notre model car d'utiliser la méthode findAll

        // La méthode findAll est maintenant une méthode statique, elle n'a pas besoin qu'on instancie la classe pour l'utiliser.
        // Pour utiliser une  méthode  statique, on utilise le nom de la classe suivi du nom de la méthode, séparés par "::" (opérateur de résolution de portée)
        $carList = Car::findAll();
        //dump($carList);


        // On appelle la méthode show() de l'objet courant
        // En argument, on fournit le fichier de Vue
        // Par convention, chaque fichier de vue sera dans un sous-dossier du nom du Controller
        $this->show('car/list', [
            'carList' => $carList,
        ]);
    }

    /**
     * Méthode appelée par le formulaire d'ajout d'une voiture
     */
    public function createAction()
    {
        // TODO faire des if(isset)
        // dump($_POST);
        // exit;
        // On récupère les infos de notre formulaire à l'aide de filter_input. Cette fonction permet d'aller vérifier qu'une entrée de $_POST existe et nous renvoyer son contenu. Si l'entrée n'existe pas, elle renvoie null. L'avantage c'est que $firstname sera toujours existante
        $brand = filter_input(INPUT_POST, 'brand');
        $model = filter_input(INPUT_POST, 'model');
        // strtoupper = put letter to uppercase
        $registration = strtoupper(filter_input(INPUT_POST, 'registration'));
        $fuel = filter_input(INPUT_POST, 'fuel');
        // floatval = string to float
        $price = floatval(filter_input(INPUT_POST, 'price'));
        $kind = filter_input(INPUT_POST, 'kind');
        $reserved = filter_input(INPUT_POST, 'reserved');

        // Comme on utilise l'approche Active Record, on doit créer une voiture vide et la remplir avec les infos provenant du formulaire.

        $newCar = new Car();
        
        // On utilise les données provenant du formulaire pour remplir la voiture
        $newCar->setBrand($brand);
        $newCar->setModel($model);
        $newCar->setRegistration($registration);
        $newCar->setFuel($fuel);
        $newCar->setPrice($price);
        $newCar->setKind($kind);
        $newCar->setReserved($reserved);        

        // Maintenant que la voiture est remplie avec les bonnes infos, on sauvegarde celle-ci dans la BDD en utilisant la méthode save() qui s'occupe de vérifier si la voiture existe et la créer avec insert()
        $newCar->save();

        // Une fois la voiture insérée en BDD, on redirige vers la page liste des voitures
        $this->redirect('car-list');

    }

    /**
     * Affiche la page d'édition d'une catégorie
     *
     * @param int $id
     * @return void
     */
    public function editAction($id)
    {
  
        //On récupère l'étudiant à modifier 
        $car = Car::find($id);
        
        // On envoie l'étudiant à la vue
        $this->show('car/edit', [
            'car' => $car
        ]);
    }


    /**
     * Méthode qui permet de traiter les infos envoyées par le formulaire d'édition
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

        // On vérifie les infos reçues
        if($registration === "" || $registration === null) {
            echo "Le nom de la plaque est obligatoire";
            exit;
        }

        // On récupère depuis la BDD la voiture à modifier
        $carToEdit = Car::find($id);
        
        // On modifie la voiture à éditer
        $carToEdit->setBrand($brand);
        $carToEdit->setModel($model);
        $carToEdit->setRegistration($registration);
        $carToEdit->setFuel($fuel);
        $carToEdit->setPrice($price);
        $carToEdit->setKind($kind);
        $carToEdit->setReserved($reserved);
   
        // Maintenant que notre objet car est mis à jour, on appelle la méthode save() pour sauvegarder les modifications dans la BDD. La méthode se charge de vérifie si on travaille sur une catégorie existe et va appeler la méthode update() automatiquement
        $carToEdit->save();

        // Une fois la sauvegarde faite, on redirige vers la liste des étudiants
        // ! A changer
        $this->redirect('car-list');

    }

    /**
     * Méthode de suppression de catégorie
     *
     * @param int $id
     * @return void
     */
    public function deleteAction($id)
    {
        // On récupère la voiture à supprimer depuis la BDD
        $carToDelete = Car::find($id);

        // On appelle la méthode qui permet de supprimer une catégorie de la BDD.
        // Si la suppression a fonctionné, on redirige vers la liste
        if($carToDelete->delete()) {
            // ! A changer
            $this->redirect('car-list');
        }
    }    
}                                           
