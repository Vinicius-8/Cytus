<?php
/**
 * Description of VetorOrdenado
 *
 * @author Vinicius
 */
class VetorOrdenado {
    /**
     *
     * @var ArrayObject Cidade 
     */
    private $cidades;
    private $numeroElementos;
    
    function __construct($tam) {
        $this->cidades = array_fill(0,$tam,null);
        $this->numeroElementos = 0;
    }
    
    /**
     * 
     * @param Cidade $cidade
     */
    function inserir($cidade){
        $posicao;
        
        for($posicao = 0; $posicao < $this->numeroElementos; $posicao++){
            if($this->cidades[$posicao]->getDistanciaObjeto()>$cidade->getDistanciaObjeto()){
//                echo $this->cidades[$posicao]->getNome().":".$this->cidades[$posicao]->getDistanciaObjeto();
//                echo " |\| ".$cidade->getNome().":".$cidade->getDistanciaObjeto();
//                echo "<br>";
                break;
            }
        }
        
        for($k = $this->numeroElementos;$k>$posicao;$k--){
            $this->cidades[$k] = $this->cidades[$k -1];
        }
        
        $this->cidades[$posicao] = $cidade;
        $this->numeroElementos++;
    }
    
    function getPrimeiro(){        
        return $this->cidades[0];
    }
    
    function size(){
        return $this->numeroElementos;
    }
    
    function pop(){
        $c = $this->getPrimeiro();
        for($i =0; $i<count($this->cidades)-1;$i++){
            $this->cidades[$i] = $this->cidades[$i+1];
        }
        $this->numeroElementos--;
        return $c;
    }
    /**
     * 
     * @return array
     */
    function getCidades(){
        return $this->cidades;
    }
            
    function mostrar(){
        for($i = 0;$i<$this->numeroElementos;$i++){
            echo "{".$this->cidades[$i]->getNome()." - ".$this->cidades[$i]->getDistanciaObjeto()."}<br>";
        }
        echo "<br>";
    }

}
