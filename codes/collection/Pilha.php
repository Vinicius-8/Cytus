<?php
/**
 * Description of Pilha
 *
 * @author Vinicius
 */
class Pilha {
    private $TAM = 0;
    /**
     *
     * @var ArrayObject 
     */
    private $cidades;
    private $topo;
    
    function __construct($tam) {
        $this->TAM = $tam;
        $this->cidades = array_fill(0, $this->TAM, NULL);
        $this->topo = -1;
    }
    function empilhar($cidade){
        if(!$this->pilhaCheia()){
            $this->cidades[++$this->topo] = $cidade;
        }else{
            echo "<h1>Pilha Cheia!</h1>";
        }
    }
    
    function desempilhar(){
        if(!$this->pilhaVazia()){
            return $this->cidades[$this->topo--];
        }else{
            echo "<h1>Pilha Vazia!</h1>";
        }
    }
    
    function pilhaCheia(){
        return ($this->TAM -1) == $this->topo;
    }
    
    function pilhaVazia(){
        return $this->topo == -1;
    }
    
    function topo(){
        return $this->cidades[$this->topo];
    }

}
