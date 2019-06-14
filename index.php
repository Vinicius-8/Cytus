<?php 
//error_reporting(0);
//ini_set('display_errors', 0);
include './codes/base/Adjacente.php';
include './codes/base/Cidade.php';
include './codes/base/Mapa.php';
include './codes/collection/Fila.php';
include './codes/collection/Pilha.php';
include './codes/collection/VetorOrdenado.php';
include './codes/collection/VetorOrdenadoAdjacente.php';
include './codes/buscas/Largura.php';
include './codes/buscas/Profundidade.php';
include './codes/buscas/Gulosa.php';
include './codes/buscas/AEstrela.php';
include './codes/auxi/Buscadouro.php';
//var_dump($_POST);
$cit = [
    'porto_uniao',
    'paulo_frontin',
    'irati',
    'palmeira',
    'sao_mateus',
    'tres_barras',
    'canoinhas',
    'mafra',
    'lapa',
    'contenda',
    'balsa_nova',
    'campo_largo',
    'araucaria',
    'tijucas_do_sul',
    'sao_jose_dos_pinhais',
    'curitiba'];
    $arr = null;
    $lar = false;
    if(isset($_POST) && !empty($_POST)){ //check if form was submitted
        $b = new Buscadouro($_POST['origem'],$_POST['destino'],$_POST['busca']);
        $arr = $b->buscar();
//        echo '<br><br><br><br><br>';
//        echo '<br><br><br><br><br>';
//        echo '<br><br><br><br><br>';
//        echo '<br><br><br><br><br>';
//        echo '<br><br><br><br><br>';
//        echo '<br><br><br><br><br>';
//        var_dump($arr);
        
        if($_POST['busca'] == 'largura')
            $lar = true;
    }
    
    //porto_uniao -> palmeira
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Buscadouro</title>
        <script src="js/jquery-3.3.1.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/cytoscape.js"></script>
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css">
        <style>
            #toolbar{
                background-color: #EAEAEA;
                width: 100%;
                height: 70px;
                position: absolute;
            }
            
            .btn{     
                float: left;
                margin-left: 25px;
                margin-top: 15px;
            }
            
            #cy {
                width: 100%;
                height: 90%;
                position: absolute;
                top: 60px;
                left: 0px;
            }
            
        </style>
        <script>
            var source;
            var target;
            var busca;
            
            function origem(a){
                this.source = a;
                $("#ori").text(a);
                document.getElementById("ori_form").setAttribute('value',a);
            }
            function destino(a){
                this.target = a;
                $("#dest").text(a);
                document.getElementById("dest_form").setAttribute('value',a);
            }
            
            function busca(a){
                this.busca = a;
                $("#bus").text(a);
                document.getElementById("bus_form").setAttribute('value',a);
            }
            function show(){
                if(this.source ==null || this.target == null)
                    alert("selecione a cidade!");
                else if(this.source == this.target)
                    alert("As cidades não podem ser iguais");
                else if(this.busca == null)
                    alert("selecione o tipo de busca!");
                console.log(this.source+"_"+this.target);
                
                document.getElementById("formula").submit();
            }
        </script>
    </head>
    <body>
        <div id="toolbar" style="z-index: 1">
            <form id="formula" action="#" method="POST">
                <input type="hidden" id="ori_form" name="origem" >
                <input type="hidden" id="dest_form" name="destino">
                <input type="hidden" id="bus_form" name="busca">
            </form>
            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span id="ori">Origem</span>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <?php
                    foreach ($cit as $c){
                        echo "<a class='dropdown-item' href='#' onclick=\"origem('".$c."')\">$c</a>";
                    }
                    ?>
                    
                </div>
                
            </div>
            
            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span id="dest">Destino</span>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <?php
                    foreach ($cit as $c){
                        echo "<a class='dropdown-item' href='#' onclick=\"destino('".$c."')\">$c</a>";
                    }
                    ?>
                </div>
            </div>
            
            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span id="bus">Tipo de Busca</span>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#" onclick="busca('profundidade')">Profundidade</a>
                    <a class="dropdown-item" href="#" onclick="busca('largura')">Largura</a>
                    <a class="dropdown-item" href="#" onclick="busca('gulosa')">Gulosa</a>
                    <a class="dropdown-item" href="#" onclick="busca('aestrela')">AEstrela</a>
                        
                </div>
            </div>
            
            <button type="button" class="btn btn-primary" onclick="show()">Aplicar</button>
            <div style="float: right; margin: 20px;color:#c1c1c1">
                    <?php
                    if(isset($_POST) && !empty($_POST)){
                       echo $_POST['origem']." -> ".$_POST['destino']." [".$_POST['busca']."]" ;
                    }
                    ?>
            </div>
        </div>
            <div id="cy"></div>
            <script>
                var desc = 35;
           var cy = cytoscape({
                container: document.getElementById('cy'),//container
                elements:[
                    //[Porto União]     
                    {
                        group:'nodes',
                        data:{
                            id:'porto_uniao'
                        },
                        position:{x:150,y:320}
                       
                    },
                    //++ paulo_frontin*[porto_uniao]
                    {
                        group:'edges',
                        data:{
                            id:'paulo_frontin-porto_uniao',
                            target:'porto_uniao',
                            source:'paulo_frontin'
                        }
                    },
                    //++canoinhas*[porto_uniao]
                    {
                        group:'edges',
                        data:{
                            id:'canoinhas-porto_uniao',
                            source:'canoinhas',
                            target:'porto_uniao'
                        }
                    },
                    //++[porto_uniao]*sao_mateus
                    {
                        group:'edges',
                        data:{
                            id:'porto_uniao-sao_mateus',
                            target:'sao_mateus',
                            source:'porto_uniao'
                        }
                    },
                   
                    //[Paulo frontin]
                    {
                        group:'nodes',
                        data:{
                            id:'paulo_frontin'
                        },
                        position:{x:250,y:155}
                       
                    },
                    //++irati*[paulo_frontin]
                    {
                        group:'edges',
                        data:{
                            id:'irati-paulo_frontin',
                            source:'irati',
                            target:'paulo_frontin'
                        }
                    },
                    //++[paulo_frontin]*porto_uniao
                    //§
                    
                    //[irati]
                    {
                        group:'nodes',
                        data:{
                            id:'irati'
                        },
                        position:{x:330,y:60}
                       
                    },
                    //++[irati]*paulo_frontin
                    //§
                    
                    //++[irati]*palmeira
                    {
                        group:'edges',
                        data:{
                            id:'irati-palmeira',
                            source:'irati',
                            target:'palmeira'
                        }
                    },
                    //++[irati]*sao_mateus
                    {
                        group:'edges',
                        data:{
                            id:'irati-sao_mateus',
                            source:'irati',
                            target:'sao_mateus'
                        }
                    },
                    
                    //[Palmeira]        
                    {
                        group:'nodes',
                        data:{
                            id:'palmeira'
                        },
                        position:{x:780,y:50}
                       
                    },
                    //++irati*[palmeira]
                    //§
                    
                    
                    //++[palmeira]*sao_mateus
                    {
                        group:'edges',
                        data:{
                            id:'palmeira-sao_mateus',
                            source:'palmeira',
                            target:'sao_mateus'
                        }
                    },
                    //++campo_largo*[palmeira]
                    {
                        group:'edges',
                        data:{
                            id:'campo_largo-palmeira',
                            source:'campo_largo',
                            target:'palmeira'
                        }
                    },
                    
                    //[sao mateus]
                    {
                        group:'nodes',
                        data:{
                            id:'sao_mateus'
                        },
                        position:{x:490,y:270}
                       
                    },
                    
                    //irati*[sao_mateus]
                    //§
                    
                    //palmeira*[sao_mateus]
                    //§
                    
                    //porto_uniao*[sao_mateus]
                    //§
                    
                    //lapa*[sao_mateus]
                    {
                        group:'edges',
                        data:{
                            id:'lapa-sao_mateus',
                            source:'lapa',
                            target:'sao_mateus'
                        }
                    },
                    
                    //[sao_mateus]*tres_barras
                    {
                        group:'edges',
                        data:{
                            id:'sao_mateus-tres_barras',
                            source:'sao_mateus',
                            target:'tres_barras'
                        }
                    },
                    
                    
                    
                    //[tres barras]
                    {
                        group:'nodes',
                        data:{
                            id:'tres_barras'
                        },
                        position:{x:455,y:400}
                       
                    },
                    
                    //sao_mateus*[tres barras]
                    //§
                    
                    //canoinhas*[tres barras]
                     {
                        group:'edges',
                        data:{
                            id:'canoinhas-tres_barras',
                            source:'canoinhas',
                            target:'tres_barras'
                        }
                    },
                    
                    
                    //[Canoinhas]
                    {
                        group:'nodes',
                        data:{
                            id:'canoinhas'
                        },
                        position:{x:300,y:545-this.desc}
                       
                    },
                    
                    //[Canoinhas]*mafra
                    {
                        group:'edges',
                        data:{
                            id:'canoinhas-mafra',
                            source:'canoinhas',
                            target:'mafra'
                        }
                    },
                    //[Canoinhas]*porto_uniao
                    //§
                    //[Canoinhas]*tres_barras
                    //§
                    
                    
                    //[mafra]
                    {
                        group:'nodes',
                        data:{
                            id:'mafra'
                        },
                        position:{x:680,y:531-this.desc}
                       
                    },
                    //canoinhas*[mafra]
                    //§
                    
                    //lapa*[mafra]
                    {
                        group:'edges',
                        data:{
                            id:'lapa-mafra',
                            source:'lapa',
                            target:'mafra'
                        }
                    },
                    
                    //[mafra]*tijucas
                    {
                        group:'edges',
                        data:{
                            id:'mafra-tijucas_do_sul',
                            source:'mafra',
                            target:'tijucas_do_sul'
                        }
                    },
                    
                    
                    
                    //[Lapa] 
                    {
                        group:'nodes',
                        data:{
                            id:'lapa'
                        },
                        position:{x:702,y:365}
                       
                    },
                    
                    //contenda*[lapa]
                    {
                        group:'edges',
                        data:{
                            id:'contenda-lapa',
                            source:'contenda',
                            target:'lapa'
                        }
                    },
                    
                    //[Lapa*sao_mateus
                    //§
                   
                    //[Lapa]*mafra
                    //§
                   
                    //[Contenda]
                    {
                        group:'nodes',
                        data:{
                            id:'contenda'
                        },
                        position:{x:762,y:230}
                       
                    },
                    //araucaria*[Contenda]
                    {
                        group:'edges',
                        data:{
                            id:'araucaria-contenda',
                            source:'araucaria',
                            target:'contenda'
                        }
                    },
                    //balsa_nova*[Contenda]
                    {
                        group:'edges',
                        data:{
                            id:'balsa_nova-contenda',
                            source:'balsa_nova',
                            target:'contenda'
                        }
                    },
                    //[Contenda]*lapa
                    //§
                    
                    //[Balsa nova]
                    {
                        group:'nodes',
                        data:{
                            id:'balsa_nova'
                        },
                        position:{x:955,y:160}
                       
                    },
                    
                    //[Balsa nova]*campo_largo
                    {
                        group:'edges',
                        data:{
                            id:'balsa_nova-campo_largo',
                            source:'balsa_nova',
                            target:'campo_largo'
                        }
                    },
                    //[Balsa nova]*contenda
                    //§
                    
                    //[Balsa nova]*curitiba
                    {
                        group:'edges',
                        data:{
                            id:'balsa_nova-curitiba',
                            source:'balsa_nova',
                            target:'curitiba'
                        }
                    },
                    
                    
                    //[Campo largo]
                    {
                        group:'nodes',
                        data:{
                            id:'campo_largo'
                        },
                        position:{x:1220,y:50}
                       
                    },
                    //balsa_nova*[Campo largo]
                    //§
                    
                    //[Campo largo]*curitiba
                    {
                        group:'edges',
                        data:{
                            id:'campo_largo-curitiba',
                            source:'campo_largo',
                            target:'curitiba'
                        }
                    },
                    //[Campo largo]*palmeira
                    //§
                    
                    //[Araucaria]
                    {
                        group:'nodes',
                        data:{
                            id:'araucaria'
                        },
                        position:{x:1020,y:366}
                       
                    },
                    //[Araucaria]*contenda
                    //§
                    
                    //[Araucaria]*curitiba
                    {
                        group:'edges',
                        data:{
                            id:'araucaria-curitiba',
                            source:'araucaria',
                            target:'curitiba'
                        }
                    },
                    
                    
                    //[Tijucas do sul]
                    {
                        group:'nodes',
                        data:{
                            id:'tijucas_do_sul'
                        },
                        position:{x:970,y:580-this.desc}
                       
                    },
                    //mafra*[Tijucas do sul]
                    //§
                    
                    //sao_jose_dos_pinhais*[Tijucas do sul]
                    {
                        group:'edges',
                        data:{
                            id:'sao_jose_dos_pinhais-tijucas_do_sul',
                            source:'sao_jose_dos_pinhais',
                            target:'tijucas_do_sul'
                        }
                    },
                    
                    
                    //[São josé dos pinhais]
                    {
                        group:'nodes',
                        data:{
                            id:'sao_jose_dos_pinhais'
                        },
                        position:{x:1170,y:470}
                       
                    },                    
                    //curitiba*[São josé dos pinhais]
                    {
                        group:'edges',
                        data:{
                            id:'curitiba-sao_jose_dos_pinhais',
                            target:'sao_jose_dos_pinhais',
                            source:'curitiba'
                        }
                    },
                    
                    //[São josé dos pinhais]*tijucas_do_sul
                    //§
                    
                    
                    //[Curitiba]
                    {
                        group:'nodes',
                        data:{
                            id:'curitiba'
                        },
                        position:{x:1260,y:345}
                       
                    }
                    //araucaria*[Curitiba]
                    //§
                    
                    //balsa_nova*[Curitiba]
                    //§
                    
                    //campo_largo*[Curitiba]
                    //§
                    
                    //[Curitiba]*sao_jose_dos_pinhais
                    //§
        
        
        
        /// - - - - - --  - - - - -- 
                ],
                style:[
                        { 
                         selector:'node',
                         style:{
                             'label': 'data(id)',
                             'background-color':'blue'
                             
                            }
                         }
                    ],
                layout:{name:'preset'},//permite livre prosicionamento
                
            zoomingEnabled: false, //bloqueia zoom
            userPanningEnabled: false,// bloqueia movimentamento do usuario
        
                

            }
            ).autoungrabify(true);
    
//                cy.$('#lapa-sao_mateus').delay(1000).animate({
//                    style: {
//                      lineColor: "red"
//                    }
//                });
        </script>
        
        <?php
            if($arr){
                echo "<script>";
                echo $b->writer($arr,$lar);
                echo "</script>";
            }    
        ?>
        
    </body>
</html>
