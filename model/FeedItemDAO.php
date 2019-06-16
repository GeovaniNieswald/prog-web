<?php

namespace Model;

class FeedItemDAO extends ClassConexao {

    private $db;

    public function __construct() {
        $this->db = $this->conectaDB();
    }

    public function consultarItensPorId($id) {
        $sql  = '
        SELECT 
            id, publicacao, id_usuario, nome_usuario, usuario_usuario, id_criador, nome_criador, usuario_criador, 
            imagem_criador, id_publicacao, DATE_FORMAT(data_hora,"%d/%m/%Y %H:%i") AS data_hora, num_likes, 
            num_compartilhamentos, conteudo, compartilhou, curtiu 
        FROM (
            SELECT 
                PUBLI.id, true AS publicacao, PUBLI.id_usuario, USER.nome AS nome_usuario, USER.usuario AS usuario_usuario,
                PUBLI.id_usuario AS id_criador, USER.nome AS nome_criador, USER.usuario AS usuario_criador, USER.imagem AS imagem_criador, 
                PUBLI.id AS id_publicacao, PUBLI.data_hora, (SELECT COUNT(id) FROM curtida WHERE id_publicacao = PUBLI.id) AS num_likes, 
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
                COMP.id_publicacao, COMP.data_hora, (SELECT COUNT(id) FROM curtida WHERE id_publicacao = COMP.id_publicacao) AS num_likes, 
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
            data_hora DESC;';

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
}