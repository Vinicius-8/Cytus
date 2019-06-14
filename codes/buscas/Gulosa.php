<?php
/**
 * Description of Gulosa
 *
 * @author Vinicius
 */
class Gulosa {
    /**
     *
     * @var ArrayObject 
     */
    private $caminho;
    private $counter = 0;
    /**
     *
     * @var VetorOrdenado 
     */
    private $fronteira;
    /**
     *
     * @var Cidade 
     */
    private $objetivo;    
    
    function __construct(Cidade $objetivo) {
        $this->objetivo = $objetivo;
    }
    
    /**
     * 
     * @param Cidade $atual
     */
    function buscar($atual){
        //echo "Atual: ".$atual->getNome()."<br>";
        $atual->setVisitado(true);
        $this->caminho[$this->counter++] = $atual;
        if($atual == $this->objetivo){
            return $this->caminho;
        }else{
            $this->fronteira = new VetorOrdenado(count($atual->getAdjacentes()));
            foreach($atual->getAdjacentes() as $a){
                if($a->getCidade() == $this->objetivo){
                    $this->buscar($a->getCidade());
                    return $this->caminho;
                }else
                if(!$a->getCidade()->isVisitado()){
                    $a->getCidade()->setVisitado(true);
                    $this->fronteira->inserir($a->getCidade());
                }
            }
            
            //$this->fronteira->mostrar();
            
            if($this->fronteira->getPrimeiro() != null){
//                return $this->buscar($this->fronteira->getPrimeiro());
                $fronteira2 = $this->fronteira;
                while($fronteira2->size()>0){
                    $a = $this->buscar($fronteira2->getPrimeiro());
                    if( in_array($this->objetivo, $a) )
                        return $this->caminho;
                    
                    $fronteira2->pop();
                    
                    $this->caminho[$this->counter++] = $atual;
                    
                }
            }
            
        }
        
        return $this->caminho;
    }

}


