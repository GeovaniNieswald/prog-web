<?php

namespace Model;

class RelacionamentoDAO extends ClassConexao {

    private $db;

    public function __construct() {
        $this->db = $this->conectaDB();
    }

    public function consultarRelacionamentosPorId($id, $seguidores, $limit = false) {
        $sql  = ($seguidores) ? "SELECT * FROM relacionamento WHERE id_seguido = :id" : "SELECT * FROM relacionamento WHERE id_seguidor = :id";
        $sql .= ($limit) ? " LIMIT 3" : "";

        $prepare = $this->db->prepare($sql);

        $prepare->bindValue(':id', $id);

        $lista = array();
        
        if ($prepare->execute()) {
            while ($dados = $prepare->fetch(\PDO::FETCH_OBJ)) {
                $relacionamento = new Relacionamento();
                
                $relacionamento->setIdSeguidor($dados->id_seguidor);
                $relacionamento->setIdSeguido($dados->id_seguido);

                $lista[] = $relacionamento;
            }
        }
        
        return $lista;
    }
}
