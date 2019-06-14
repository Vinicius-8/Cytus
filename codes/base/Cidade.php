<?php
/**
 * Description of Cidade
 *
 * @author Vinicius
 */
class Cidade {
    private $nome;
    private $visitado;
    private $adjacentes;
    private $distanciaObjeto;
    
    function __construct($nome, $distanciaObjeto) {
        $this->nome = $nome;
        $this->visitado = false;
        $this->adjacentes = new ArrayObject();
        $this->distanciaObjeto = $distanciaObjeto;
    }
    
    function addCidadeAdjacente($cidade){
        $this->adjacentes->append($cidade);
    }
    function getNome() {
        return $this->nome;
    }

    function isVisitado() {
        return $this->visitado;
    }

    function getAdjacentes() {
        return $this->adjacentes;
    }

    function getDistanciaObjeto() {
        return $this->distanciaObjeto;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setVisitado($visitado) {
        $this->visitado = $visitado;
    }

    function setAdjacentes($adjacentes) {
        $this->adjacentes = $adjacentes;
    }

    function setDistanciaObjeto($distanciaObjeto) {
        $this->distanciaObjeto = $distanciaObjeto;
    }



}
