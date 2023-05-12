<h2>
  Un client concessionnaire vous demande de lui créer une petite application web pour gérer ses voitures :
</h2>
<ul>
  <li>
    Un tableau de bord affichant la liste des voitures rentrées
    <ul>
      <li>Avec comme colonnes : marque, modèle, plaque immatriculation, carburant, prix, type vente (occasion ou neuve), réservé (oui ou non)</li>
    </ul>
  </li>
  <li>
    Il sera possible à partir de ce tableau de bord de :
    <ul>
      <li>Ajouter une voiture</li>
      <li>Supprimer une voiture</li>
      <li>Modifier une voiture</li>
    </ul>
  </li>
  <li>Enfin, à chaque modification</li>
</ul>
<table class="table container">
    <!-- <caption>Liste des voitures rentrées</caption> -->
    <thead>
        <tr>
            <th scope="col">Voiture</th>
            <th scope="col">marque</th>
            <th scope="col">modèle</th>
            <th scope="col">plaque immatriculation</th>
            <th scope="col">carburant</th>
            <th scope="col">prix</th>
            <th scope="col">type de vente</th>
            <th scope="col">réservé ?</th>
        </tr>
    </thead>
    <tbody class="table-group-divider">
        <tr>
            <th scope="row">1</th>
            <td>Toyota</td>
            <td>Prius</td>
            <td>E6Z RJ45</td>
            <td>Gazol</td>
            <td>15 560 €</td>
            <td>Occasion</td>
            <td>Oui</td>
        </tr>
        <tr>
            <th scope="row">2</th>
            <td>Citroën</td>
            <td>C3</td>
            <td>AB3 654E</td>
            <td>Sans plomb 98</td>
            <td>5 560 €</td>
            <td>Occasion</td>
            <td>Non</td>
        </tr>
        <tr>
        <th scope="row">3</th>
            <td>Volkswagen</td>
            <td>Coccinelle</td>
            <td>C0C 1N3LLE</td>
            <td>Gazol</td>
            <td>15 560 €</td>
            <td>Neuf</td>
            <td>Oui</td>
        </tr>
    </tbody>
</table>

<div class="container">
    <h2>Nouvelle voiture</h2>
    <form class="row align-items-start">
        <div class="mb-3 col-md-6">
            <input class="form-control" id="carBrand" placeholder="Indiquer la marque de la voiture">
        </div>
        <div class="mb-3 col-md-6">
            <input class="form-control" id="carModel" placeholder="Indiquer le modèle de la voiture"></input>
        </div>
        <div class="mb-3 col-sm-6">
            <input class="form-control" id="carRegistration" placeholder="Indiquer la plaque d'immatriculation de la voiture"></input>
        </div>
        <div class="mb-3 col-md-6">
            <input class="form-control" id="carPrice" placeholder="Indiquer le prix de la voiture"></input>
        </div>
        <!-- Put selected directly on a value ? -->
        <div class="d-flex">
            <select class="form-select mb-3 p-2" aria-label="Default select example">
                <option selected>Choississez le carburant</option>
                <option value="1">Gazoil</option>
                <option value="2">Sans plomb 94</option>
                <option value="3">Sans plomb 98</option>
            </select>
            <!-- Put selected directly on a value ? -->
            <select class="form-select mb-3 p-2" aria-label="Default select example">
                <option selected>Choississez le type de vente</option>
                <option value="1">Occasion</option>
                <option value="2">Neuf</option>
            </select>
            <!-- Put selected directly on a value ? -->
            <select class="form-select mb-3 p-2" aria-label="Default select example">
                <option selected>Est-elle réservée ?</option>
                <option value="1">Oui</option>
                <option value="2">Non</option>
            </select>
        </div>
        <button type="button" class="btn btn-secondary">Soumettre</button>
    </form>
</div>