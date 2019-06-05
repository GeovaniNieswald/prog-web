<?php

namespace Model;

abstract class ClassConexao {

    protected function conectaDB() {
        try {
            $con = new \PDO('mysql:host='.HOST.';dbname='.DB, USER, PASS);
            return $con;
        } catch (\PDOException $erro) {
            return $erro->getMessage();
        }
    }
}