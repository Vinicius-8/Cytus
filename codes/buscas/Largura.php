<?php
/**
 * Description of Largura
 *
 * @author Vinicius
 */
class Largura {
    /**
     *
     * @var ArrayObject
     */
    private $caminho;
    /**
     *
     * @var Fila 
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
    private $counter = 0;
    
    function __construct(Cidade $inicio, Cidade $objetivo) {
        $this->inicio = $inicio;
        $this->inicio->setVisitado(true);
        $this->objetivo = $objetivo;
        $this->fronteira = new Fila(20);
        $this->fronteira->enfileirar($inicio);
        //echo "Partida -> ".$inicio->getNome()."<br>Destino -> ".$objetivo->getNome()."<br>";
    }
    
    function buscar(){
        //$this->fronteira->show();
        
        $primeiro = $this->fronteira->getPrimeiro();
        $this->caminho[$this->counter++] = $primeiro;

        //echo ++$this->counter." ]-- Primeiro: ".$primeiro->getNome()."<br>";
        
        //echo " Desenfileirou: ".$this->fronteira->desenfileirar()->getNome()."<br>";
        $this->fronteira->desenfileirar();
        foreach($primeiro->getAdjacentes() as $val){
            
            if($val->getCidade() == $this->objetivo){
                //echo " Chegou ao Destino: -> ".$val->getCidade()->getNome()."<br>";
                $this->caminho[$this->counter++] = $val->getCidade();
                //var_dump($this->caminho);
                
                return $this->caminho;
            }
            //echo "Verificando se já visitado: ".$val->getCidade()->getNome()."<br>";
            if(!$val->getCidade()->isVisitado()){
                $val->getCidade()->setVisitado(true);
                $this->fronteira->enfileirar($val->getCidade());
                $this->fronteira->enfileirar($primeiro);
                //echo "Opa";
            }
            
        }
        
        if($this->fronteira->getNumeroElementos()>0)
            $this->buscar ();
        return $this->caminho;
    }
    

}
