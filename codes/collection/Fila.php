<?php
/**
 * Description of Fila
 *
 * @author Vinicius
 */
class Fila {
    private $tamanho;
    
    /**
     *
     * @var ArrayObject() 
     */
    private $cidades;
    private $inicio;
    private $fim;
    private $numeroElementos;
    
    function __construct($tamanho) {
        $this->tamanho = $tamanho;
        $this->cidades = array_fill(0,$tamanho,NULL);
        $this->inicio = 0;
        $this->fim = -1;
        $this->numeroElementos = 0;
    }
    
    function enfileirar($cidade){
        if(!$this->filaCheia()){
            if($this->fim == $this->tamanho-1){
                $this->fim = -1;
            }
            $this->cidades[++$this->fim] = $cidade;
            $this->numeroElementos++;
        }else{
            echo "<h1>Fila Cheia!</h1>";
        }
    }
    
    function desenfileirar(){
        if(!$this->filaVazia()){
            $temp = $this->cidades[$this->inicio++];
            if($this->inicio == $this->tamanho){
                $this->inicio = 0;
            }
            $this->numeroElementos--;
            return $temp;
        }else{
            echo "<h1>Fila já vazia!</h1>";
            return null ;
        }
    }
    
    function show(){
        if(!$this->filaVazia()){
            for($i = $this->inicio; $i<count($this->cidades); $i++){
                if($this->cidades[$i]!=null){
                    echo "[".$this->cidades[$i]->getNome()."] ";
                }
            }
            echo '<br>';
        }
        
    }
    
    function getPrimeiro(){
        return $this->cidades[$this->inicio];
    }
    
    function filaVazia(){
        return $this->numeroElementos == 0;
    }
    
    function filaCheia(){
        return $this->tamanho == $this->numeroElementos;
    }
    
    function getNumeroElementos(){
        return $this->numeroElementos;
    }
}
