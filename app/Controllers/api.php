<?php

use App\Models\Car;
use App\Utils\Database;

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Origin");

include_once './app/Models/Car.php';

if($_SERVER['REQUEST_METHOD'] == 'GET'){
  // La bonne méthode est utilisée

}else{
  // Mauvaise méthode, on gère l'erreur
  http_response_code(405);
  echo json_encode(["message" => "La méthode n'est pas autorisée"]);
}

// On instancie la base de données
$database = new Database();
$pdo = $database->getPDO();

// On instancie les car
$car = new Car($pdo);

$carList = $car->findAll();
// On vérifie si on a au moins 1 voiture
if($carList->rowCount() > 0){
  // On initialise un tableau associatif
  $tableauCar = [];
  $tableauCar['car'] = [];

  // On parcourt les voitures
  while($row = $carList->fetch(PDO::FETCH_ASSOC)){
      extract($row);

      $prod = [
          "id" => $id,
          "brand" => $brand,
          "model" => $model,
          "registration" => $registration,
          "fuel" => $fuel,
          "price" => $price,
          "kind" => $kind,
          "reserved" => $reserved,
      ];

      $tableauCar['car'][] = $prod;
  }
  // On envoie le code réponse 200 OK
  http_response_code(200);

  // On encode en json et on envoie
  echo json_encode($tableauCar);
}
?>