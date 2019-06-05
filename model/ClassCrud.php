<?php

namespace Model;

class ClassCrud extends ClassConexao {

    private $crud;
    private $id_inserido;

    #Responsável pela preparação da query e execução
    private function prepareExecute($prep, $exec, $insert = FALSE) {
        $db = $this->conectaDB();
        
        $this->crud = $db->prepare($prep);
        $this->crud->execute($exec);
        
        if ($insert) {
            $this->id_inserido = $db->lastInsertId();
        }
    }

    #Seleção de dados
    public function selectDB($fields, $table, $where, $exec) {
        $this->prepareExecute("SELECT {$fields} FROM {$table} {$where}", $exec);
        return $this->crud;
    }

    #Inserção de dados
    public function insertDB($table, $fields, $values, $exec) {
        $this->prepareExecute("INSERT INTO {$table}({$fields}) VALUES({$values})", $exec, TRUE);
        return $this->id_inserido;
    }

    #Delete de dados
    public function deleteDB($table, $values, $exec) {
        $this->prepareExecute("DELETE FROM {$table} WHERE {$values}", $exec);
        return $this->crud;
    }

    #Atualização de dados
    public function updateDB($table, $values, $where, $exec) {
        $this->prepareExecute("UPDATE {$table} SET {$values} WHERE {$where}", $exec);
        return $this->crud;
    }
}