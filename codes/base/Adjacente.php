<?php
/**
 * Description of Adjacente
 *
 * @author Vinicius
 */
class Adjacente {
    private $cidade;
    private $distancia;
    private $distanciaAEstrela;
    
    function __construct(Cidade $cidade, $distancia) {
        $this->cidade = $cidade;
        $this->distancia = $distancia;
        $this->distanciaAEstrela = $this->cidade->getDistanciaObjeto() + $this->getDistancia();
    }
    
    function getCidade() {
        return $this->cidade;
    }

    function getDistancia() {
        return $this->distancia;
    }

    function getDistanciaAEstrela() {
        return $this->distanciaAEstrela;
    }

    function setCidade($cidade) {
        $this->cidade = $cidade;
    }

    function setDistancia($distancia) {
        $this->distancia = $distancia;
    }

    function setDistanciaAEstrela($distanciaAEstrela) {
        $this->distanciaAEstrela = $distanciaAEstrela;
    }



}
