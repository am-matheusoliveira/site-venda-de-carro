<?php
    require_once('conexao.php');
?>
<!doctype html>
<html lang="pt-br">
    <head>
        <title>Itapú Veículos</title>
        <!--<meta charset="utf-8"/>   Temos essa opção e abaixo temos uma mais completa-->
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="../CSS/estilo.css" />
        <link rel="icon" href="../IMG/logoGoogle.png" />
    </head>
    <body>
        <div id="interface">
            <!--Menu princiapl do site-->
            <header id="header_principal">
                <?php 
                    include("topo.php");
                ?>
            </header>
            <!--Slide da Pagina-->
            <section id="main_carros">
                <?php
                    $maximo_registros_exibidos = 5;
                    if(isset($_GET["pg"])){
                        $pagina_atual = $_GET["pg"];
                    }else{
                        $pagina_atual = 1;
                    }
                    $inicio = $pagina_atual - 1;
                    $inicio *= $maximo_registros_exibidos;

                    $consulta  = "SELECT TB_CRR.*, TB_MCS.MARCA, TB_MOD.MODELO
                    FROM TB_CARROS AS TB_CRR
                    INNER JOIN TB_MARCAS AS TB_MCS  ON TB_CRR.ID_MARCA  = TB_MCS.ID_MARCA
                    INNER JOIN TB_MODELOS AS TB_MOD ON TB_CRR.ID_MODELO = TB_MOD.ID_MODELO
                    LIMIT $inicio, $maximo_registros_exibidos";
                    $resultado    = mysqli_query($conexao, $consulta); 

                    $total_registros = mysqli_num_rows(mysqli_query($conexao, "SELECT * FROM TB_CARROS"));
                    $total_paginas   = $total_registros/$maximo_registros_exibidos;

                    $anterior = $pagina_atual - 1;
                    $proxima  = $pagina_atual + 1;

                    foreach($resultado as $valores){
                        echo('<div class="classe_carros">');
                            echo('<article class="article_carro">');
                                echo('<div id="d1">');
                                    echo('<a href="detalhes_modelo.php?id_carro='.$valores["id_carro"].'&pg='.$pagina_atual.'"><img src="'.$valores["min3"].'"></a>');
                                echo('</div>');
                                echo('<div id="d2">');
                                    echo('<div id="titulo">');
                                        echo('<div id="t1">');
                                            echo('<a href="detalhes_modelo.php?id_carro='.$valores["id_carro"].'&pg='.$pagina_atual.'"><p>'.$valores["MARCA"].'</p>');
                                            echo('<p>'.$valores["MODELO"].'</p>');
                                            echo('<p>'.$valores["versao"].'</p></a>');
                                        echo('</div>');
                                        echo('<div id="t2">');
                                            echo('<p>R$ '.number_format($valores["valor"], 2, ',', '.').'</p>');
                                        echo('</div>');
                                    echo('</div>');
                                    echo('<div id="dados">');
                                        echo('Ano - Fabricação: '.$valores["ano_fab"]."<br/>");
                                        echo('Ano - Modelo: '.$valores["ano_mod"]."<br/>");
                                        echo('Vendido: '.($valores["vendido"] == "1" ? "Sim" : "Não"));
                                    echo('</div>');
                                echo('<div>');
                            echo('</article>');
                        echo('</div>');
                    }
                
                    echo('<div class="btn_ecolha_pagina">');
                        echo('<div class="btn_prox_next_page">');
                            if($pagina_atual > 1){
                                echo("<a class='btmenu' href='carros.php?pg=$anterior'>Anterior</a>");
                            }

                            if($pagina_atual < $total_paginas){
                                echo("<a class='btmenu' href='carros.php?pg=$proxima'>Proxima</a>");
                            }
                        echo('</div>');

                        echo('<div class="btn_prox_next_page_escolha">');
                            for($ip=0;$ip<$total_paginas;$ip++){
                                echo("<a href='carros.php?pg=".($ip+1)."' class='link_pagina'>");
                                if($pagina_atual == ($ip+1)){
                                    echo("<b style='color: #fff;' >".($pagina_atual)."</b>");
                                }else{
                                    echo($ip+1);
                                }
                                echo("</a>");
                            }
                        echo('</div>');
                    echo('</div>');
                ?>
            </section>
            <!---->
            <section id="rodape" style="clear: left;">
                <?php
                    require_once("../HTML/rodape.html");
                ?>
            </section>   
        </div>
    </body>
</html>