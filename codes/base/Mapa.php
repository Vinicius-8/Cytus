<?php

/**
 * Description of Mapa
 *
 * @author Vinicius
 */
class Mapa {
    
    private $portoUniao;
    private $pauloFrontin;
    private $canoinhas;
    private $irati;
    private $saoMateus;
    private $tresBarras;
    private $palmeiras;
    private $contenda;
    private $lapa;
    private $mafra;
    private $campoLargo;
    private $balsaNova;
    private $araucaria;
    private $tijucasDoSul;
    private $saoJoseDosPinhais;
    private $curitiba;
    
    function __construct() {
        $this->portoUniao = new Cidade("Porto União",203);
        $this->pauloFrontin = new Cidade("Paulo Frontin",172);
        $this->canoinhas = new Cidade("Canoinhas",141);
        $this->irati = new Cidade("Irati",139);
        $this->saoMateus = new Cidade("São Mateus",123);
        $this->tresBarras = new Cidade("Tres Barras",131);
        $this->palmeiras = new Cidade("Palmeiras",59);
        $this->contenda = new Cidade("Contenda",39);
        $this->lapa = new Cidade("Lapa",74);
        $this->mafra = new Cidade("Mafra",94);
        $this->campoLargo = new Cidade("Campo Largo",27);
        $this->balsaNova = new Cidade("Balsa Nova",41);
        $this->araucaria = new Cidade("Araucária",23);
        $this->tijucasDoSul  = new Cidade("Tijucas Do Sul",56);
        $this->saoJoseDosPinhais = new Cidade("São José dos Pinhais",13);
        $this->curitiba = new Cidade("Curitiba",0);
        
//        $this->portoUniao = new Cidade("Porto União",0);
//        $this->pauloFrontin = new Cidade("Paulo Frontin",0);
//        $this->canoinhas = new Cidade("Canoinhas",0);
//        $this->irati = new Cidade("Irati",0);
//        $this->saoMateus = new Cidade("São Mateus",0);
//        $this->tresBarras = new Cidade("Tres Barras",0);
//        $this->palmeiras = new Cidade("Palmeiras",0);
//        $this->contenda = new Cidade("Contenda",0);
//        $this->lapa = new Cidade("Lapa",0);
//        $this->mafra = new Cidade("Mafra",0);
//        $this->campoLargo = new Cidade("Campo Largo",0);
//        $this->balsaNova = new Cidade("Balsa Nova",0);
//        $this->araucaria = new Cidade("Araucária",0);
//        $this->tijucasDoSul  = new Cidade("Tijucas Do Sul",0);
//        $this->saoJoseDosPinhais = new Cidade("São José dos Pinhais",0);
//        $this->curitiba = new Cidade("Curitiba",0);

        
        $this->portoUniao->addCidadeAdjacente(new Adjacente($this->pauloFrontin, 47.5));
        $this->portoUniao->addCidadeAdjacente(new Adjacente($this->saoMateus,87.5));
        $this->portoUniao->addCidadeAdjacente(new Adjacente($this->canoinhas,77.3));
        
        $this->pauloFrontin->addCidadeAdjacente(new Adjacente($this->irati,80.8));
        $this->pauloFrontin->addCidadeAdjacente(new Adjacente($this->portoUniao,48.2));
        
        $this->canoinhas->addCidadeAdjacente(new Adjacente($this->portoUniao,77.2));
        $this->canoinhas->addCidadeAdjacente(new Adjacente($this->tresBarras,13.5));
        $this->canoinhas->addCidadeAdjacente(new Adjacente($this->mafra,66.7));
        
        $this->irati->addCidadeAdjacente(new Adjacente($this->pauloFrontin,76.9));
        $this->irati->addCidadeAdjacente(new Adjacente($this->palmeiras,73.5));
        $this->irati->addCidadeAdjacente(new Adjacente($this->saoMateus,58));
        
        $this->saoMateus->addCidadeAdjacente(new Adjacente($this->irati,57.9));
        $this->saoMateus->addCidadeAdjacente(new Adjacente($this->portoUniao,88.4));
        $this->saoMateus->addCidadeAdjacente(new Adjacente($this->tresBarras,35.3));
        $this->saoMateus->addCidadeAdjacente(new Adjacente($this->palmeiras,77.2));
        $this->saoMateus->addCidadeAdjacente(new Adjacente($this->lapa,81.8));
        
        $this->tresBarras->addCidadeAdjacente(new Adjacente($this->canoinhas,12.4));
        $this->tresBarras->addCidadeAdjacente(new Adjacente($this->saoMateus,33.6));
        
        $this->palmeiras->addCidadeAdjacente(new Adjacente($this->saoMateus,75.4));
        $this->palmeiras->addCidadeAdjacente(new Adjacente($this->irati,75.1));
        $this->palmeiras->addCidadeAdjacente(new Adjacente($this->campoLargo,55.1));
        
        $this->contenda->addCidadeAdjacente(new Adjacente($this->balsaNova,19.9));
        $this->contenda->addCidadeAdjacente(new Adjacente($this->lapa,26.6));
        $this->contenda->addCidadeAdjacente(new Adjacente($this->araucaria,18.9));
        
        $this->lapa->addCidadeAdjacente(new Adjacente($this->saoMateus,81.4));
        $this->lapa->addCidadeAdjacente(new Adjacente($this->contenda,26.4));
        $this->lapa->addCidadeAdjacente(new Adjacente($this->mafra,54.8));
        
        $this->mafra->addCidadeAdjacente(new Adjacente($this->lapa,55));
        $this->mafra->addCidadeAdjacente(new Adjacente($this->canoinhas,66.3));
        $this->mafra->addCidadeAdjacente(new Adjacente($this->tijucasDoSul,99.1));
        
        $this->campoLargo->addCidadeAdjacente(new Adjacente($this->palmeiras,57.6));
        $this->campoLargo->addCidadeAdjacente(new Adjacente($this->balsaNova,20.6));
        $this->campoLargo->addCidadeAdjacente(new Adjacente($this->curitiba,29.7));
        
        $this->balsaNova->addCidadeAdjacente(new Adjacente($this->contenda,19.6));
        $this->balsaNova->addCidadeAdjacente(new Adjacente($this->campoLargo,25.7));
        $this->balsaNova->addCidadeAdjacente(new Adjacente($this->curitiba,51.9));
        
        $this->araucaria->addCidadeAdjacente(new Adjacente($this->contenda,18.4));
        $this->araucaria->addCidadeAdjacente(new Adjacente($this->curitiba,36.9));
        
        $this->tijucasDoSul->addCidadeAdjacente(new Adjacente($this->mafra,99.2));
        $this->tijucasDoSul->addCidadeAdjacente(new Adjacente($this->saoJoseDosPinhais,50.4));
        
        $this->saoJoseDosPinhais->addCidadeAdjacente(new Adjacente($this->tijucasDoSul,49.4));
        $this->saoJoseDosPinhais->addCidadeAdjacente(new Adjacente($this->curitiba,15.2));
        
        $this->curitiba->addCidadeAdjacente(new Adjacente($this->araucaria,28.5));
        $this->curitiba->addCidadeAdjacente(new Adjacente($this->saoJoseDosPinhais,15.1));
        $this->curitiba->addCidadeAdjacente(new Adjacente($this->balsaNova,51.9));
        $this->curitiba->addCidadeAdjacente(new Adjacente($this->campoLargo,29.8));
    }
    
    function getPortoUniao() {
        return $this->portoUniao;
    }

    function getPauloFrontin() {
        return $this->pauloFrontin;
    }

    function getCanoinhas() {
        return $this->canoinhas;
    }

    function getIrati() {
        return $this->irati;
    }

    function getSaoMateus() {
        return $this->saoMateus;
    }

    function getTresBarras() {
        return $this->tresBarras;
    }

    function getPalmeiras() {
        return $this->palmeiras;
    }

    function getContenda() {
        return $this->contenda;
    }

    function getLapa() {
        return $this->lapa;
    }

    function getMafra() {
        return $this->mafra;
    }

    function getCampoLargo() {
        return $this->campoLargo;
    }

    function getBalsaNova() {
        return $this->balsaNova;
    }

    function getAraucaria() {
        return $this->araucaria;
    }

    function getTijucasDoSul() {
        return $this->tijucasDoSul;
    }

    function getSaoJoseDosPinhais() {
        return $this->saoJoseDosPinhais;
    }

    function getCuritiba() {
        return $this->curitiba;
    }

    function setPortoUniao($portoUniao) {
        $this->portoUniao = $portoUniao;
    }

    function setPauloFrontin($pauloFrontin) {
        $this->pauloFrontin = $pauloFrontin;
    }

    function setCanoinhas($canoinhas) {
        $this->canoinhas = $canoinhas;
    }

    function setIrati($irati) {
        $this->irati = $irati;
    }

    function setSaoMateus($saoMateus) {
        $this->saoMateus = $saoMateus;
    }

    function setTresBarras($tresBarras) {
        $this->tresBarras = $tresBarras;
    }

    function setPalmeiras($palmeiras) {
        $this->palmeiras = $palmeiras;
    }

    function setContenda($contenda) {
        $this->contenda = $contenda;
    }

    function setLapa($lapa) {
        $this->lapa = $lapa;
    }

    function setMafra($mafra) {
        $this->mafra = $mafra;
    }

    function setCampoLargo($campoLargo) {
        $this->campoLargo = $campoLargo;
    }

    function setBalsaNova($balsaNova) {
        $this->balsaNova = $balsaNova;
    }

    function setAraucaria($araucaria) {
        $this->araucaria = $araucaria;
    }

    function setTijucasDoSul($tijucasDoSul) {
        $this->tijucasDoSul = $tijucasDoSul;
    }

    function setSaoJoseDosPinhais($saoJoseDosPinhais) {
        $this->saoJoseDosPinhais = $saoJoseDosPinhais;
    }

    function setCuritiba($curitiba) {
        $this->curitiba = $curitiba;
    }


}
