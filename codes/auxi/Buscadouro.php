<?php

/**
 * Description of Buscadouro
 *
 * @author Vinicius
 */
class Buscadouro {
    
    /**
     *
     * @var ArrayObject 
     */
    private $cit;
    /**
     * 
     * @param String $origem
     * @param String $destino
     * @param String $busca
     */
    /**
     *
     * @var Cidade 
     */
    private $origem;
    /**
     *
     * @var Cidade 
     */
    private $destino;
    
    private $busca;
    
    function __construct($origem, $destino,$busca) {
        $mapa = new Mapa();
        $this->cit = array(
            'porto_uniao'=> $mapa->getPortoUniao(),
            'paulo_frontin'=> $mapa->getPauloFrontin(),
            'irati'=> $mapa->getIrati(),
            'palmeira'=> $mapa->getPalmeiras(),
            'sao_mateus'=> $mapa->getSaoMateus(),
            'tres_barras'=> $mapa->getTresBarras(),
            'canoinhas'=> $mapa->getCanoinhas(),
            'mafra'=> $mapa->getMafra(),
            'lapa'=> $mapa->getLapa(),
            'contenda'=> $mapa->getContenda(),
            'balsa_nova'=> $mapa->getBalsaNova(),
            'campo_largo'=> $mapa->getCampoLargo(),
            'araucaria'=> $mapa->getAraucaria(),
            'tijucas_do_sul'=> $mapa->getTijucasDoSul(),
            'sao_jose_dos_pinhais'=> $mapa->getSaoJoseDosPinhais(),
            'curitiba'=> $mapa->getCuritiba());
            //echo "[Cidade Origem] -- >".$this->getCidade($origem)->getDistanciaObjeto()."<br>";
            //echo "[Cidade Destino] -- >".$this->getCidade($destino)->getNome()."<br>";
            $this->origem = $this->getCidade($origem);
            $this->destino = $this->getCidade($destino);
            $this->busca = $busca;
            //echo array_search($mapa->getPauloFrontin(), $this->cit);;
    }
    
    /**
     * 
     * @param type $nome
     * @return Cidade
     */
    function getCidade($cidad){
        return $this->cit[$cidad];
    }
    
    function buscar(){
        if('profundidade' == $this->busca){
            $p = new Profundidade($this->origem, $this->destino);
            return $this->caminho($p->buscar());
            
        }else if('largura' == $this->busca){
            $l = new Largura($this->origem, $this->destino);
            return $this->caminho($l->buscar());
            
        }else if('gulosa' == $this->busca){
            $g = new Gulosa($this->destino);
            return $this->caminho($g->buscar($this->origem));
            
        }else if('aestrela' == $this->busca){
            $ae = new AEstrela($this->destino);
            return $this->caminho($ae->buscar($this->origem));
            
        }
    }
    
    function caminho($arrei = array()){
        /*
         * Aqui começa a ordem das cidades
         */
        $ahei = array();
        
        for($i = 0;$i<count($arrei);$i++){
           $ahei[$i] = array_search($arrei[$i], $this->cit);
//           var_dump($ahei[$i]);
//           /**
//            * Definição da ordem das Edges
//            */
//           $atual_proximo = array($arrei[$i]->get, $arrei[$i+1]);
//           sort($atual_proximo);
//           $ahei[$i] = $atual_proximo[0]."-".$atual_proximo[1] ;
        }
        //$atual_proximo = array();
        $atual_proximo = null;
        $a_p = 0;
        
        
        for($i=0;$i<count($ahei)-1;$i++){
            $aux = array($ahei[$i], $ahei[$i+1]);
            sort($aux);
            $atual_proximo[$a_p++] = $aux[0]."-".$aux[1];
        }
        $a_p = 0;
        $hei = 0;
        $nodges = null;
        
//        for($i=0;$i<count($ahei)+count($atual_proximo);$i++){
//            $nodges[$i] = $ahei[$hei++];
//            $i++;
//            $nodges[$i] = $atual_proximo[$a_p++];
//        }
        for($i=0;$i<count($ahei)*2;$i+=2){
            $nodges[$i] = $ahei[$hei++];
        }
        for($i=1;$i<count($atual_proximo)*2;$i+=2){
            $nodges[$i] = $atual_proximo[$a_p++];
        }
        
        ksort($nodges);
        
        return $nodges;
    }
    
    /**
     * cy.$('#canoinhas').style('background-color','red'); // muda cor de um node especifc
     * 
     * @param array $arr
     */
    function writer($arr,$param){
        $vara = null;
        if(!$param)
            $passada = 280;
        else
            $passada = 150;
        
        $conte_me = $passada;
        
        
        for($i=0; $i<count($arr)-1;$i++){
            
            $vara .= " cy.$('#".$arr[$i++]."').delay(".$conte_me.").animate({
                        style: {
                        'border-width': 4,
                        'border-color': 'red',
                        'background-color':'white'
                      }}); 
                      cy.$('#".$arr[$i]."').delay(".($conte_me+=$passada).").animate({
                    style: {
                      lineColor: \"red\"
                    }
                });";
            $conte_me+=$passada;
        }
        $vara .= " cy.$('#".$arr[count($arr)-1]."').delay(".$conte_me.").animate({
                        style: {
                        'border-width': 4,
                        'border-color': 'red',
                        'background-color':'white'
                      }}); ";

        return $vara;
    }

}
