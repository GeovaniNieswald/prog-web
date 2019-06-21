<?php

namespace Model;

class FeedItemDAO extends ClassConexao {

    private $db;

    public function __construct() {
        $this->db = $this->conectaDB();
    }

    public function consultarItensPorId($id, $perfil = false) {
        if ($perfil) {
            $sql  = '
            SELECT 
                id, publicacao, id_usuario, nome_usuario, usuario_usuario, id_criador, nome_criador, usuario_criador, 
                imagem_criador, id_publicacao, DATE_FORMAT(data_hora_cru,"%d/%m/%Y %H:%i") AS data_hora, num_likes, 
                num_compartilhamentos, conteudo, compartilhou, curtiu 
            FROM (
                SELECT 
                    PUBLI.id, true AS publicacao, PUBLI.id_usuario, USER.nome AS nome_usuario, USER.usuario AS usuario_usuario,
                    PUBLI.id_usuario AS id_criador, USER.nome AS nome_criador, USER.usuario AS usuario_criador, USER.imagem AS imagem_criador, 
                    PUBLI.id AS id_publicacao, PUBLI.data_hora AS data_hora_cru, (SELECT COUNT(id) FROM curtida WHERE id_publicacao = PUBLI.id) AS num_likes, 
                    (SELECT COUNT(id) FROM compartilhamento WHERE id_publicacao = PUBLI.id) AS num_compartilhamentos, PUBLI.conteudo, 
                    IF((SELECT id FROM curtida WHERE id_publicacao = PUBLI.id AND id_usuario = :id) IS NOT NULL, 1, 0) AS curtiu, 
                    IF((SELECT id FROM compartilhamento WHERE id_publicacao = PUBLI.id AND id_usuario = :id) IS NOT NULL, 1, 0) AS compartilhou
                FROM 
                    publicacao AS PUBLI 
                INNER JOIN 
                    usuario AS USER ON PUBLI.id_usuario = USER.id 
                WHERE 
                    PUBLI.id_usuario = :id 
            ) AS x 
            ORDER BY 
                data_hora_cru DESC;';
        } else {
            $sql  = '
            SELECT 
                id, publicacao, id_usuario, nome_usuario, usuario_usuario, id_criador, nome_criador, usuario_criador, 
                imagem_criador, id_publicacao, DATE_FORMAT(data_hora_cru,"%d/%m/%Y %H:%i") AS data_hora, num_likes, 
                num_compartilhamentos, conteudo, compartilhou, curtiu 
            FROM (
                SELECT 
                    PUBLI.id, true AS publicacao, PUBLI.id_usuario, USER.nome AS nome_usuario, USER.usuario AS usuario_usuario,
                    PUBLI.id_usuario AS id_criador, USER.nome AS nome_criador, USER.usuario AS usuario_criador, USER.imagem AS imagem_criador, 
                    PUBLI.id AS id_publicacao, PUBLI.data_hora AS data_hora_cru, (SELECT COUNT(id) FROM curtida WHERE id_publicacao = PUBLI.id) AS num_likes, 
                    (SELECT COUNT(id) FROM compartilhamento WHERE id_publicacao = PUBLI.id) AS num_compartilhamentos, PUBLI.conteudo, 
                    IF((SELECT id FROM curtida WHERE id_publicacao = PUBLI.id AND id_usuario = :id) IS NOT NULL, 1, 0) AS curtiu, 
                    IF((SELECT id FROM compartilhamento WHERE id_publicacao = PUBLI.id AND id_usuario = :id) IS NOT NULL, 1, 0) AS compartilhou
                FROM 
                    publicacao AS PUBLI 
                INNER JOIN 
                    usuario AS USER ON PUBLI.id_usuario = USER.id 
                WHERE 
                    (PUBLI.id_usuario = :id OR PUBLI.id_usuario IN (SELECT id_seguido FROM relacionamento WHERE id_seguidor = :id))
                
                UNION ALL
            
                SELECT 
                    COMP.id, false AS publicacao, COMP.id_usuario, USER.nome AS nome_usuario, USER.usuario AS usuario_usuario, 
                    COMP.id_criador, CRIAD.nome AS nome_criador, CRIAD.usuario AS usuario_criador, CRIAD.imagem AS imagem_criador,
                    COMP.id_publicacao, COMP.data_hora AS data_hora_cru, (SELECT COUNT(id) FROM curtida WHERE id_publicacao = COMP.id_publicacao) AS num_likes, 
                    (SELECT COUNT(id) FROM compartilhamento WHERE id_publicacao = COMP.id_publicacao) AS num_compartilhamentos, PUBLI.conteudo, 
                    IF((SELECT id FROM curtida WHERE id_publicacao = PUBLI.id AND id_usuario = :id) IS NOT NULL, 1, 0) AS curtiu, 
                    IF((SELECT id FROM compartilhamento WHERE id_publicacao = COMP.id_publicacao AND id_usuario = :id) IS NOT NULL, 1, 0) AS compartilhou
                FROM 
                    compartilhamento AS COMP
                INNER JOIN 
                    usuario AS USER ON COMP.id_usuario = USER.id 
                INNER JOIN 
                    usuario AS CRIAD ON COMP.id_criador = CRIAD.id 
                INNER JOIN 
                    publicacao AS PUBLI ON COMP.id_publicacao = PUBLI.id 
                WHERE 
                    (COMP.id_usuario = :id OR COMP.id_usuario IN (SELECT id_seguido FROM relacionamento WHERE id_seguidor = :id))
            ) AS x 
            ORDER BY 
                data_hora_cru DESC;';
        }

        $prepare = $this->db->prepare($sql);

        $prepare->bindValue(':id', $id);

        $lista = array();
        
        if ($prepare->execute()) {
            while ($dados = $prepare->fetch(\PDO::FETCH_OBJ)) {
                $feedItem = new FeedItem();

                $feedItem->setId($dados->id);
                $feedItem->setIdUsuario($dados->id_usuario);
                $feedItem->setNomeUsuario($dados->nome_usuario);
                $feedItem->setUsuarioUsuario($dados->usuario_usuario);
                $feedItem->setIdCriador($dados->id_criador);
                $feedItem->setNomeCriador($dados->nome_criador);
                $feedItem->setUsuarioCriador($dados->usuario_criador);
                $feedItem->setImagemCriador($dados->imagem_criador);
                $feedItem->setIdPublicacao($dados->id_publicacao);
                $feedItem->setDataHora($dados->data_hora);
                $feedItem->setNumLikes($dados->num_likes);
                $feedItem->setNumCompartilhamentos($dados->num_compartilhamentos);
                $feedItem->setConteudo($dados->conteudo);
                $feedItem->setPublicacao($dados->publicacao);

                $feedItem->setCompartilhou($dados->compartilhou);
                $feedItem->setCurtiu($dados->curtiu);

                $lista[] = $feedItem;
            }
        }
        
        return $lista;
    }

    public function publicar($conteudo, $idUsuario) {
        $sql = "INSERT INTO publicacao(id_usuario, data_hora, conteudo) VALUES(:idUser, NOW(), :conteudo)";

        $prepare = $this->db->prepare($sql);

        $prepare->bindValue(':idUser', $idUsuario);
        $prepare->bindValue(':conteudo', $conteudo);

        if ($prepare->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function compartilhar($idPublicacao, $idCriador, $idUsuario) {
        $sql = "INSERT INTO compartilhamento(id_usuario, id_criador, id_publicacao, data_hora) VALUES(:idUser, :idCriador, :idPubli, NOW())";

        $prepare = $this->db->prepare($sql);

        $prepare->bindValue(':idUser', $idUsuario);
        $prepare->bindValue(':idCriador', $idCriador);
        $prepare->bindValue(':idPubli', $idPublicacao);

        $prepare->execute();

        return $this->numComps($idPublicacao);
    }

    public function descompartilhar($idPublicacao, $idCriador, $idUsuario) {
        $sql = "DELETE FROM compartilhamento WHERE id_usuario = :idUser AND id_criador = :idCriador AND id_publicacao = :idPubli";

        $prepare = $this->db->prepare($sql);

        $prepare->bindValue(':idUser', $idUsuario);
        $prepare->bindValue(':idCriador', $idCriador);
        $prepare->bindValue(':idPubli', $idPublicacao);

        $prepare->execute();

        return $this->numComps($idPublicacao);
    }

    public function curtir($idPublicacao, $idUsuario) {
        $sql = "INSERT INTO curtida(id_usuario, id_publicacao) VALUES(:idUser, :idPubli)";

        $prepare = $this->db->prepare($sql);

        $prepare->bindValue(':idUser', $idUsuario);
        $prepare->bindValue(':idPubli', $idPublicacao);

        $prepare->execute();

        return $this->numCurtidas($idPublicacao);
    }

    public function descurtir($idPublicacao, $idUsuario) {
        $sql = "DELETE FROM curtida WHERE id_usuario = :idUser AND id_publicacao = :idPubli";

        $prepare = $this->db->prepare($sql);

        $prepare->bindValue(':idUser', $idUsuario);
        $prepare->bindValue(':idPubli', $idPublicacao);

        $prepare->execute();

        return $this->numCurtidas($idPublicacao);
    }

    private function numCurtidas($idPublicacao) {
        $sql = "SELECT COUNT(id) AS num_curtidas FROM curtida WHERE id_publicacao = :idPubli";

        $prepare = $this->db->prepare($sql);

        $prepare->bindValue(':idPubli', $idPublicacao);

        if ($prepare->execute()) {
            while ($dados = $prepare->fetch(\PDO::FETCH_OBJ)) {
                return $dados->num_curtidas;
            }
        } else {
            return -1;
        }
    }

    private function numComps($idPublicacao) {
        $sql = "SELECT COUNT(id) AS num_comps FROM compartilhamento WHERE id_publicacao = :idPubli";

        $prepare = $this->db->prepare($sql);

        $prepare->bindValue(':idPubli', $idPublicacao);

        if ($prepare->execute()) {
            while ($dados = $prepare->fetch(\PDO::FETCH_OBJ)) {
                return $dados->num_comps;
            }
        } else {
            return -1;
        }
    }

    public function editar($id, $conteudo) {
        $sql = "UPDATE publicacao SET conteudo = :conteudo, data_hora = NOW() WHERE id = :id";

        $prepare = $this->db->prepare($sql);

        $prepare->bindValue(':conteudo', $conteudo);
        $prepare->bindValue(':id', $id);

        if ($prepare->execute()) {

            $sql = "DELETE FROM compartilhamento WHERE id_publicacao = :id";
            $prepare = $this->db->prepare($sql);
            $prepare->bindValue(':id', $id);
            $prepare->execute();

            $sql = "DELETE FROM curtida WHERE id_publicacao = :id";
            $prepare = $this->db->prepare($sql);
            $prepare->bindValue(':id', $id);
            $prepare->execute();

            return true;
        } else {
            return false;
        }
    }

    public function apagar($id) {
        $sql = "DELETE FROM publicacao WHERE id = :id";

        $prepare = $this->db->prepare($sql);

        $prepare->bindValue(':id', $id);

        if ($prepare->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
