<?php
/**
 * Description of VetorOrdenadoAdjacente
 *
 * @author Vinicius
 */
class VetorOrdenadoAdjacente {
    /**
     *
     * @var ArrayObject 
     */
    private $adjacentes;
    private $numeroElementos;
    
    function __construct($tam) {
        $this->adjacentes = array_fill(0, $tam, null);
        $this->numeroElementos = 0;
    }
    
    function inserir($adjacente){
        $posicao;
        
        for($posicao = 0; $posicao< $this->numeroElementos;$posicao++){
            if($this->adjacentes[$posicao]->getDistanciaAEstrela()>$adjacente->getDistanciaAEstrela()){
                break;
            }
        }
        
        for($k = $this->numeroElementos; $k>$posicao;$k--){
            $this->adjacentes[$k] = $this->adjacentes[$k -1];
        }
        
        $this->adjacentes[$posicao] = $adjacente;
        $this->numeroElementos++;
    }
    
    function getPrimeiro(){
        if($this->adjacentes[0]!=null)
            return $this->adjacentes[0]->getCidade();
        return null;
    }
    
    function size(){
        return $this->numeroElementos;
    }
    
    function pop(){
        $p = $this->getPrimeiro();
        for($i =0; $i<count($this->adjacentes)-1;$i++){
            $this->adjacentes[$i] = $this->adjacentes[$i+1];
        }
        $this->numeroElementos--;
        return $p;
    }
            
    function mostrar(){
        for($i = 0; $i<$this->numeroElementos; $i++){
                echo "{".$this->adjacentes[$i]->getCidade()->getNome()." - ".$this->adjacentes[$i]->getDistanciaAEstrela()."}<br>";
        }
        echo "<br>";
    }

}
