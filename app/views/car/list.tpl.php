<table class="table container">
    <!-- <caption>Liste des voitures rentrées</caption> -->
    <thead>
        <tr>
            <th scope="col">Voiture</th>
            <th scope="col">Marque</th>
            <th scope="col">Modèle</th>
            <th scope="col">Plaque immatriculation</th>
            <th scope="col">Carburant</th>
            <th scope="col">Prix</th>
            <th scope="col">Type de vente</th>
            <th scope="col">Réservé ?</th>
        </tr>
    </thead>
    <tbody class="table-group-divider">
    <!-- <template id="car-template">
        <tr id="car-template">
                <th scope="row"></th>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td><input for="" class="btn btn-primary button--edit" type="button" value="Edit"></td>
                <td><input for="" class="btn btn-danger button--delete" type="button" value="Delete"></td>
            </tr> 
        </template> -->
        <?php foreach ($carList as $currentCar) : ?>
            <tr id="car-template">
                <th scope="row" data-id=""><?= $currentCar->getId(); ?></th>
                <td><?= $currentCar->getBrand(); ?></td>
                <td><?= $currentCar->getModel(); ?></td>
                <td><?= $currentCar->getRegistration(); ?></td>
                <td><?= $currentCar->getFuel(); ?></td>
                <td><?= $currentCar->getPrice(); ?> €</td>
                <td><?= $currentCar->getKind(); ?></td>
                <td><?= $currentCar->getReserved(); ?></td>
                <td><input for="<?= $currentCar->getId(); ?>" class="btn btn-primary button--edit" type="button" value="Edit"></td>
                <td><input for="<?= $currentCar->getId(); ?>" class="btn btn-danger button--delete" type="button" value="Delete"></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<div class="container">
    <h2>Nouvelle voiture</h2>
    <form class="row align-items-start" action="" method="POST">
        <div class="mb-3 col-md-6">
            <label for="brand" class="form-label">Marque</label>
            <input required class="form-control" id="brand" name="brand" placeholder="Indiquer la marque de la voiture">
        </div>
        <div class="mb-3 col-md-6">
            <label for="model" class="form-label">Modèle</label>
            <input required class="form-control" id="model" name="model" placeholder="Indiquer le modèle de la voiture"></input>
        </div>
        <div class="mb-3 col-sm-6">
            <label for="registration" class="form-label">Plaque d'immatriculation</label>
            <input required class="form-control" id="registration" name="registration" placeholder="Indiquer la plaque d'immatriculation de la voiture"></input>
        </div>
        <div class="mb-3 col-md-6">
            <label for="price" class="form-label">Prix</label>
            <input required class="form-control" id="price" name="price" type="number" step=".01" placeholder="Indiquer le prix de la voiture"></input>
        </div>
        <div class="d-flex">
            <select required class="form-select mb-3 p-2" id="fuel" name="fuel" aria-label="Default select example">
                <option selected value="" >Choisissez le carburant</option>
                <option value="Gazoil">Gazoil</option>
                <option value="Sans plomb 95">Sans plomb 95</option>
                <option value="Sans plomb 98">Sans plomb 98</option>
            </select>
            <select required class="form-select mb-3 p-2" id="kind" name="kind" aria-label="Default select example">
                <option selected value="">Choisissez le type de vente</option>
                <option value="Occasion">Occasion</option>
                <option value="Neuf">Neuf</option>
            </select>
            <select required class="form-select mb-3 p-2" id="reserved" name="reserved" aria-label="Default select example">
                <option selected value="">Est-elle réservée ?</option>
                <option value="Oui">Oui</option>
                <option value="Non">Non</option>
            </select>
        </div>
        <button type="submit" class="btn btn-secondary add-car">Soumettre</button>
    </form>
</div>