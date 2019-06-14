<?php
/**
 * Description of AEstrela
 *
 * @author Vinicius
 */
class AEstrela {
    /**
     *
     * @var ArrayObject 
     */
    private $caminho;
    private $counter = 0;
    /**
     *
     * @var VetorOrdenadoAjacente 
     */
    private $fronteira;
    /**
     *
     * @var Cidade 
     */
    private $objetivo;
    
    function __construct(Cidade $objetivo) {
        $this->objetivo = $objetivo;
        $this->caminho = array();
    }
    /**
     * 
     * @param Cidade $atual
     * @return ArrayObject 
     */
    
    function debugCaminho($ahey){
        echo "<div style='background-color:yellow; margin:10px'>";
        echo "tipo-> ".gettype($ahey);
        echo "</div>";
    }
    function buscar($atual){
        //echo "Atual: ".$atual->getNome()."<br>";
        $atual->setVisitado(true);
        $this->caminho[$this->counter++] = $atual;
        if($atual == $this->objetivo){
            if($this->caminho == null)
                        echo "------------->";
            return $this->caminho;
        }else{
            $this->fronteira = new VetorOrdenadoAdjacente(count($atual->getAdjacentes()));
            foreach($atual->getAdjacentes() as $a){
                if($a->getCidade() == $this->objetivo){
                    $this->buscar($a->getCidade());
                    if($this->caminho == null)
                        echo "------------->";
                    return $this->caminho;
                }else
                if(!$a->getCidade()->isVisitado()){
                    $a->getCidade()->setVisitado(true);
                    $this->fronteira->inserir($a);
                }
            }
            //$this->fronteira->mostrar();
            if($this->fronteira->getPrimeiro() !=null){
                $fronteira2 = $this->fronteira;
                while($fronteira2->size()>0){
                    $a = $this->buscar($fronteira2->getPrimeiro());
                    if($a!=null and in_array($this->objetivo, $a))
                        return $this->caminho;
                    $fronteira2->pop();

                    $this->caminho[$this->counter++] = $atual;
                }
            }
        }
    }

}
