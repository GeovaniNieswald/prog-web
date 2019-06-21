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

    public function seguir($idAlvo, $seuId) {
        if ($this->voceSegue($idAlvo, $seuId)) {
            return false;
        } else {
            $sql = "INSERT INTO relacionamento(id_seguidor, id_seguido) VALUES(:seuId, :idAlvo)";

            $prepare = $this->db->prepare($sql);
    
            $prepare->bindValue(':seuId', $seuId);
            $prepare->bindValue(':idAlvo', $idAlvo);
    
            return $prepare->execute();
        }
    }

    public function pararSeguir($idAlvo, $seuId) {
        if ($this->voceSegue($idAlvo, $seuId)) {
            $sql = "DELETE FROM relacionamento WHERE id_seguidor = :seuId AND id_seguido = :idAlvo";

            $prepare = $this->db->prepare($sql);
    
            $prepare->bindValue(':seuId', $seuId);
            $prepare->bindValue(':idAlvo', $idAlvo);
    
            return $prepare->execute();
        } else {
            return false;
        }
    }

    public function voceSegue($idAlvo, $seuId) {
        $sql = "SELECT COUNT(id_seguidor) AS segue FROM relacionamento WHERE id_seguidor = :seuId AND id_seguido = :idAlvo";

        $prepare = $this->db->prepare($sql);

        $prepare->bindValue(':seuId', $seuId);
        $prepare->bindValue(':idAlvo', $idAlvo);

        if ($prepare->execute()) {
            while ($dados = $prepare->fetch(\PDO::FETCH_OBJ)) {
                return ($dados->segue > 0);
            }
        } else {
            return false;
        }
    }
}
