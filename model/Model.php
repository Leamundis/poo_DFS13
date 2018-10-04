<?php

namespace Model;


abstract class Model
{
    protected $dbConnec;

    function __construct()
    {

        $database = $GLOBALS['config']['SGBDDatabase'];
        $dbAdress = 'mysql:host=localhost;dbname=' . $database;
        $user = $GLOBALS['config']['SGBDUser'];
        $pass = $GLOBALS['config']['SGBDPass'];
        try {
        $this->dbConnec = new \PDO($dbAdress, $user, $pass, [
            \PDO::ATTR_ERRMODE              => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE   => \PDO::FETCH_ASSOC,
        ]);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMesssage(), $e->getCode());
        }
    }

    public function getAll()
    {
        $sql = 'SELECT * FROM ' . $this->table;
        $request = $this->dbConnec->prepare($sql);
        $request->execute();
        return $request->fetchAll();
    }

    public function getOneById($value)
    {
        $sql = 'SELECT * FROM ' . $this->table . ' WHERE id= :value';
        $request = $this->dbConnec->prepare($sql);
        $request->execute(['value' => $value]);
        $result = $request->fetch();
        if ($result !== null) {
            return $result;
        } else {
            return false;
        }
    }

    public function getOne($column, $value)
    {
        $sql = 'SELECT * FROM ' . $this->table . ' WHERE ' . $column . ' = :value';
        $request = $this->dbConnec->prepare($sql);
        $request->execute(['value' => $value]);
        $result = $request->fetch();
        if ($result !== null) {
            return $result;
        } else {
            return false;
        }
    }

}