<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

class Car extends CoreModel
{
    //==============================
    // Propriétés
    //==============================

    /**
     * @var string
     */
    private $brand;
    /**
     * @var string
     */
    private $model;
    /**
     * @var string
     */
    private $registration;
    /**
     * @var int
     */
    private $fuel;
    /**
     * @var int
     */
    private $price;
    /**
     * @var int
     */
    private $kind;
    /**
     * @var int
     */
    private $reserved;

    //==============================
    // Méthodes 
    //==============================

    /**
     * Méthode permettant de récupérer un enregistrement de la table Car en fonction d'un id donné
     *
     * @param int $carId ID de la catégorie
     * @return Car
     */
    public static function find($carId)
    {
        // se connecter à la BDD
        $pdo = Database::getPDO();

        // écrire notre requête
        // ! Fonction SQL à modifier
        $sql = 'SELECT * FROM `car` WHERE `id` =' . $carId;

        // exécuter notre requête
        $pdoStatement = $pdo->query($sql);

        // un seul résultat => fetchObject
        // self::class permet d'afficher le FQCN (nom complet) de la classe dans laquelle on se situe
        $car = $pdoStatement->fetchObject(self::class);

        // retourner le résultat
        return $car;
    }

    /**
     * Méthode permettant de récupérer tous les enregistrements de la table car
     *
     * @return Car[]
     */
    public static function findAll()
    {
        $pdo = Database::getPDO();
        // ! Fonction SQL à modifier
        $sql = 'SELECT * FROM `car`';
        $pdoStatement = $pdo->query($sql);
        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);
        
        return $results;
    }

    /**
     * Méthode permettant d'ajouter un enregistrement dans la table car
     * L'objet courant doit contenir toutes les données à ajouter : 1 propriété => 1 colonne dans la table (sauf les colonnes qui ont une valeur par défaut dans la BDD : id, created_at, home_order)
     *
     * @return bool
     */
    public function insert()
    {
        // TODO vérifier fonction
        // Récupération de l'objet PDO représentant la connexion à la DB
        $pdo = Database::getPDO();

        // Ecriture de la requête INSERT INTO
        // Pour se protéger des injections SQL notre requete doit comporter des "emplacements". Des sortes de cases dans lesquelles on mettra les vraies valeurs plus tard.
        // Par convention, un emplacement commence par ":" et porte le nom du champ.
        // ! Fonction SQL à modifier
        $sql = "INSERT INTO `car` (`brand`, `model`, `registration`, `fuel`, `price`, `kind`, `reserved` )
        VALUES (:brand, :model, :registration, :fuel, :price, :kind, :reserved)
        ";

        // Une fois la requete créée, on la confie à PDO pour qu'il prenne connaissance de celle-ci.
        $query = $pdo->prepare($sql);

        // Maintenant qu'il sait que la requete est une requete INSERT INTO qui contient 3 emplacements, on les remplit avec nos valeurs
        $query->bindValue(':brand', $this->brand);
        $query->bindValue(':model', $this->model);
        $query->bindValue(':registration', $this->registration);
        $query->bindValue(':fuel', $this->fuel);
        $query->bindValue(':price', $this->price);
        $query->bindValue(':kind', $this->kind);
        $query->bindValue(':reserved', $this->reserved);

        // On exécute la requete préparée à l'aide de la méthode execute
        $insertedRows = $query->execute();

        // Si au moins une ligne ajoutée
        if ($insertedRows) {
            // Alors on récupère l'id auto-incrémenté généré par MySQL
            $this->id = $pdo->lastInsertId();

            // On retourne VRAI car l'ajout a parfaitement fonctionné
            return true;
            // => l'interpréteur PHP sort de cette fonction car on a retourné une donnée
        }

        // Si on arrive ici, c'est que quelque chose n'a pas bien fonctionné => FAUX
        return false;
    }

    /**
     * Méthode permettant de mettre à jour un enregistrement dans la table car
     * L'objet courant doit contenir l'id, et toutes les données à ajouter : 1 propriété => 1 colonne dans la table
     *
     * @return bool
     */
    public function update()
    {
        // TODO vérifier fonction
        // Récupération de l'objet PDO représentant la connexion à la DB
        $pdo = Database::getPDO();
// (:brand, :model, :registration, :fuel, :price, :kind, :reserved)
        // Ecriture de la requête UPDATE
        // ! Fonction SQL à modifier
        $sql = "
            UPDATE `car`
            SET
                brand = :brand,
                model = :model,
                registration = :registration,
                fuel = :fuel,
                price = :price,
                kind = :kind,
                reserved = :reserved,
                updated_at = NOW()
            WHERE id = :id
        ";

        // On envoie la requete à PDO avec des emplacements pour qu'il la prépare.
        $query = $pdo->prepare($sql);

        // Une fois que PDO est courant du format de la requete, on lui donne les valeurs à mettre dans les emplacements
        // Le 3ème argument permet de forcer la vérification d'un type de donnée (par défaut c'est string : PDO::PARAM_STR, si on veut vérifier un entier c'est PDO::PARAM_INT)
        $query->bindValue(':brand', $this->brand, PDO::PARAM_STR);
        $query->bindValue(':model', $this->model, PDO::PARAM_STR);
        $query->bindValue(':registration', $this->registration, PDO::PARAM_STR);
        $query->bindValue(':fuel', $this->fuel, PDO::PARAM_STR);
        $query->bindValue(':price', $this->price, PDO::PARAM_INT);
        $query->bindValue(':kind', $this->kind, PDO::PARAM_STR);
        $query->bindValue(':reserved', $this->reserved, PDO::PARAM_STR);
        $query->bindValue(':id', $this->id, PDO::PARAM_INT);

        // Execution de la requête de mise à jour avec la méthode execute
        $updatedRows = $query->execute();
        // On retourne VRAI, si au moins une ligne ajoutée
        return ($updatedRows);
    }


    /**
     * Méthode supprimant l'objet courant de la BDD
     *
     * @return void
     */
    public function delete()
    {
        // TODO vérifier fonction
        // Récupération de l'objet PDO représentant la connexion à la DB
        $pdo = Database::getPDO();

        // On se crée une requete SQL de suppression. Comme l'ID est modifiable depuis l'url par l'utilisateur, on fait une requete préparée.
        // ! Fonction SQL à modifier
        $sql = "DELETE FROM `car`
        WHERE `id` = :id";

        // On confie à PDO la requete SQL qu'il va recevoir. Ainsi il est informé du nombre d'éléments qui vont composer cette requete. 
        $pdoStatement = $pdo->prepare($sql);

        // On remplace l'emplace :id par sa vraie valeur
        $pdoStatement->bindValue(':id', $this->id, PDO::PARAM_INT);

        // On execute la requete et on retourne ce que la méthode execute nous renvoie (true ou false)
        return $pdoStatement->execute();
        
    }

    //==============================
    // Getters / Setters
    //==============================  


    /**
     * Get the value of brand
     *
     * @return  string
     */ 
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * Set the value of brand
     *
     * @param  string  $brand
     *
     * @return  self
     */ 
    public function setBrand(string $brand)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get the value of model
     *
     * @return  string
     */ 
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Set the value of model
     *
     * @param  string  $model
     *
     * @return  self
     */ 
    public function setModel(string $model)
    {
        $this->model = $model;

        return $this;
    }

    /**
     * Get the value of registration
     *
     * @return  string
     */ 
    public function getRegistration()
    {
        return $this->registration;
    }

    /**
     * Set the value of registration
     *
     * @param  string  $registration
     *
     * @return  self
     */ 
    public function setRegistration(string $registration)
    {
        $this->registration = $registration;

        return $this;
    }

    /**
     * Get the value of fuel
     *
     * @return  int
     */ 
    public function getFuel()
    {
        return $this->fuel;
    }

    /**
     * Set the value of fuel
     *
     * @param  int  $fuel
     *
     * @return  self
     */ 
    public function setFuel(int $fuel)
    {
        $this->fuel = $fuel;

        return $this;
    }

    /**
     * Get the value of price
     *
     * @return  int
     */ 
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @param  int  $price
     *
     * @return  self
     */ 
    public function setPrice(int $price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get the value of kind
     *
     * @return  int
     */ 
    public function getKind()
    {
        return $this->kind;
    }

    /**
     * Set the value of kind
     *
     * @param  int  $kind
     *
     * @return  self
     */ 
    public function setKind(int $kind)
    {
        $this->kind = $kind;

        return $this;
    }

    /**
     * Get the value of reserved
     *
     * @return  int
     */ 
    public function getReserved()
    {
        return $this->reserved;
    }

    /**
     * Set the value of reserved
     *
     * @param  int  $reserved
     *
     * @return  self
     */ 
    public function setReserved(int $reserved)
    {
        $this->reserved = $reserved;

        return $this;
    }
}

