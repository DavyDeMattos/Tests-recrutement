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
     * @var string
     */
    private $fuel;
    /**
     * @var int
     */
    private $price;
    /**
     * @var string
     */
    private $kind;
    /**
     * @var string
     */
    private $reserved;

    //==============================
    // Méthodes 
    //==============================

    /**
     * Method to get datas from BDD with an id
     *
     * @param int $carId Car's id
     * @return Car
     */
    public static function find($carId)
    {
        // connection to BDD
        $pdo = Database::getPDO();
        $sql = 'SELECT * FROM `car` WHERE `id` =' . $carId;
        $pdoStatement = $pdo->query($sql);

        // self::class permet d'afficher le FQCN (nom complet) de la classe dans laquelle on se situe
        $car = $pdoStatement->fetchObject(self::class);

        return $car;
    }

    /**
     * MEthod to get every datas from table car 
     *
     * @return Car[]
     */
    public static function findAll()
    {
        $pdo = Database::getPDO();
        $sql = 'SELECT * FROM `car`';
        $pdoStatement = $pdo->query($sql);
        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);
        
        return $results;
    }

    /**
     * Method to add car's information to table 'car'
     * Object has to contain every propriety except for those who has default value (ex: updated_at)
     *
     * @return bool
     */
    public function insert()
    {
        $pdo = Database::getPDO();

        $sql = "INSERT INTO `car` (`brand`, `model`, `registration`, `fuel`, `price`, `kind`, `reserved` )
        VALUES (:brand, :model, :registration, :fuel, :price, :kind, :reserved)
        ";

        $query = $pdo->prepare($sql);

        $query->bindValue(':brand', $this->brand);
        $query->bindValue(':model', $this->model);
        $query->bindValue(':registration', $this->registration);
        $query->bindValue(':fuel', $this->fuel);
        $query->bindValue(':price', $this->price);
        $query->bindValue(':kind', $this->kind);
        $query->bindValue(':reserved', $this->reserved);

        $insertedRows = $query->execute();

        if ($insertedRows) {
            $this->id = $pdo->lastInsertId();

            return true;
        }

        return false;
    }

    /**
     * Method to update one row on car table
     * Object has to contain every propriety except for those who has default value (ex: updated_at)
     *
     * @return bool
     */
    public function update()
    {
        $pdo = Database::getPDO();
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

        $query = $pdo->prepare($sql);

        $query->bindValue(':brand', $this->brand, PDO::PARAM_STR);
        $query->bindValue(':model', $this->model, PDO::PARAM_STR);
        $query->bindValue(':registration', $this->registration, PDO::PARAM_STR);
        $query->bindValue(':fuel', $this->fuel, PDO::PARAM_STR);
        $query->bindValue(':price', $this->price, PDO::PARAM_INT);
        $query->bindValue(':kind', $this->kind, PDO::PARAM_STR);
        $query->bindValue(':reserved', $this->reserved, PDO::PARAM_STR);
        $query->bindValue(':id', $this->id, PDO::PARAM_INT);

        $updatedRows = $query->execute();
        return ($updatedRows);
    }


    /**
     * Method to delete car on BDD
     *
     * @return void
     */
    public function delete()
    {
        $pdo = Database::getPDO();

        $sql = "DELETE FROM `car`
        WHERE `id` = :id";

        $pdoStatement = $pdo->prepare($sql);

        $pdoStatement->bindValue(':id', $this->id, PDO::PARAM_INT);

        return $pdoStatement->execute();
        
    }

    /**
     * Method to order car on BDD
     *
     * @return Car[]
     */
    public static function orderBy($filter)
    {
        var_dump("coucou");
        var_dump($filter);
        $pdo = Database::getPDO();

        $sql = "SELECT * FROM `car`
        ORDER BY" . $filter;
        // var_dump($sql);
        $pdoStatement = $pdo->query($sql);
        // $pdoStatement->bindValue(':filter', $this->id, PDO::PARAM_INT);
        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);
        // $results = $pdoStatement->execute();
        // var_dump($results);
        // exit();
        return $results;
        
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
     * @return  string
     */ 
    public function getFuel()
    {
        return $this->fuel;
    }

    /**
     * Set the value of fuel
     *
     * @param  string  $fuel
     *
     * @return  self
     */ 
    public function setFuel(string $fuel)
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
     * @return  string
     */ 
    public function getKind()
    {
        return $this->kind;
    }

    /**
     * Set the value of kind
     *
     * @param  string  $kind
     *
     * @return  self
     */ 
    public function setKind(string $kind)
    {
        $this->kind = $kind;

        return $this;
    }

    /**
     * Get the value of reserved
     *
     * @return  string
     */ 
    public function getReserved()
    {
        return $this->reserved;
    }

    /**
     * Set the value of reserved
     *
     * @param  string  $reserved
     *
     * @return  self
     */ 
    public function setReserved(string $reserved)
    {
        $this->reserved = $reserved;

        return $this;
    }
}

