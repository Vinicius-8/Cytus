<?php
/**
 * Description of Profundidade
 *
 * @author Vinicius
 */
class Profundidade {
    /**
     *
     * @var ArrayObject 
     */
    private $caminho;
    private $counter = 0;
  
    //put your code here
    /**
     *
     * @var Pilha 
     */
    private $fronteira;
    /**
     *
     * @var Cidade 
     */
    private $inicio;
    /**
     *
     * @var Cidade 
     */
    private $objetivo;
    
    function __construct(Cidade $inicio, Cidade $objetivo) {
        $this->inicio = $inicio;
        $this->objetivo = $objetivo;
        $this->inicio->setVisitado(true);
        
        $this->fronteira = new Pilha(20);
        $this->fronteira->empilhar($inicio);
        //echo "Partida -> ".$this->inicio->getNome()."<br>Destino -> ".$this->objetivo->getNome()."<br>";
    }
    
    function buscar(){
        $topo = $this->fronteira->topo();
        //echo "-----------------> Topo: ".$topo->getNome()."<br>";
        $this->caminho[$this->counter++] = $topo;
        foreach($topo->getAdjacentes() as $a){
            //echo "Verificando se á visitado: ".$a->getCidade()->getNome()."<br>";
            if(!$a->getCidade()->isVisitado()){
                if($topo == $this->objetivo){
                    //echo "-------------------------> Chegou ao objetivo: {".$this->objetivo->getNome()."}   <br>";
                    return $this->caminho;
                }
                $a->getCidade()->setVisitado(true);
                $this->fronteira->empilhar($a->getCidade());
                if($this->buscar())
                    return $this->caminho;

            }
        }
        //echo "Desempilhou: ".$this->fronteira->desempilhar()->getNome()."<br>";
        return false;
    }   
}
