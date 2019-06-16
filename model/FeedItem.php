<?php

namespace Model;

class FeedItem {

    private $id;
    private $idUsuario;
    private $nomeUsuario;
    private $usuarioUsuario;
    private $idCriador;
    private $nomeCriador;
    private $usuarioCriador;
    private $imagemCriador;
    private $idPublicacao;
    private $dataHora;
    private $numLikes;
    private $numCompartilhamentos;
    private $conteudo;
    private $publicacao;

    private $compartilhou;
    private $curtiu;

    public function __construct() {
    }

    public function setId($id) {
        $this->id = $id;
    }
    public function getId() {
        return $this->id;
    }

    public function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }
    public function getIdUsuario() {
        return $this->idUsuario;
    }

    public function setNomeUsuario($nomeUsuario) {
        $this->nomeUsuario = $nomeUsuario;
    }
    public function getNomeUsuario() {
        return $this->nomeUsuario;
    }

    public function setUsuarioUsuario($usuarioUsuario) {
        $this->usuarioUsuario = $usuarioUsuario;
    }
    public function getUsuarioUsuario() {
        return $this->usuarioUsuario;
    }

    public function setIdCriador($idCriador) {
        $this->idCriador = $idCriador;
    }
    public function getIdCriador() {
        return $this->idCriador;
    }

    public function setNomeCriador($nomeCriador) {
        $this->nomeCriador = $nomeCriador;
    }
    public function getNomeCriador() {
        return $this->nomeCriador;
    }

    public function setUsuarioCriador($usuarioCriador) {
        $this->usuarioCriador = $usuarioCriador;
    }
    public function getUsuarioCriador() {
        return $this->usuarioCriador;
    }

    public function setImagemCriador($imagemCriador) {
        $this->imagemCriador = $imagemCriador;
    }
    public function getImagemCriador() {
        return $this->imagemCriador;
    }

    public function setIdPublicacao($idPublicacao) {
        $this->idPublicacao = $idPublicacao;
    }
    public function getIdPublicacao() {
        return $this->idPublicacao;
    }

    public function setDataHora($dataHora) {
        $this->dataHora = $dataHora;
    }
    public function getDataHora() {
        return $this->dataHora;
    }

    public function setNumLikes($numLikes) {
        $this->numLikes = $numLikes;
    }
    public function getNumLikes() {
        return $this->numLikes;
    }

    public function setNumCompartilhamentos($numCompartilhamentos) {
        $this->numCompartilhamentos = $numCompartilhamentos;
    }
    public function getNumCompartilhamentos() {
        return $this->numCompartilhamentos;
    }

    public function setConteudo($conteudo) {
        $this->conteudo = $conteudo;
    }
    public function getConteudo() {
        return $this->conteudo;
    }

    public function setPublicacao($publicacao) {
        $this->publicacao = $publicacao;
    }
    public function isPublicacao() {
        return $this->publicacao;
    }

    public function setCompartilhou($compartilhou) {
        $this->compartilhou = $compartilhou;
    }
    public function getCompartilhou() {
        return $this->compartilhou;
    }

    public function setCurtiu($curtiu) {
        $this->curtiu = $curtiu;
    }
    public function getCurtiu() {
        return $this->curtiu;
    }
}