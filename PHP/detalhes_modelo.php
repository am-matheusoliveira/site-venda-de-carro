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
        <script>
            function clique(img){
                var modalJ = document.getElementById("janelaModal");
                var modalI = document.getElementById("imgModal");
                var modalB = document.getElementById("btFechar");            
    
                modalJ.style.display = "block";
                modalI.src = img;
                modalB.onclick=function(){
                    modalJ.style.display = "none";
                }
            }
        </script>
    </head>
    <body>
        <div id="interface">
            <!--Menu princiapl do site-->
            <header>
                <?php 
                    include("topo.php");
                ?>
            </header>
            <!--Slide da Pagina-->
            <section id="main_carros">
                <?php
                    $id_carro = $_GET["id_carro"];
                    if(isset($_GET["pg"])){
                        $pagina = $_GET["pg"];
                        echo('<a href="carros.php?pg='.$pagina.'" class="btmenu">Voltar</a>');
                    }else{
                        echo('<a href="index.php#buscador" class="btmenu">Voltar</a>');
                    }

                    // ATUALIZANDO O CAMPO 'qtd_visitas' DA TABELA 'tb_carro'
                    mysqli_query($conexao, "UPDATE tb_carros SET qtd_visitas = (qtd_visitas + 1) WHERE id_carro = " . $id_carro);
                    //
                    $consulta  = "SELECT TB_CRR.*, TB_MCS.MARCA, TB_MOD.MODELO, TB_MOD_VERSAO.modelo_versao
                    FROM TB_CARROS AS TB_CRR
                    INNER JOIN TB_MARCAS AS TB_MCS  ON TB_CRR.ID_MARCA  = TB_MCS.ID_MARCA
                    INNER JOIN TB_MODELOS AS TB_MOD ON TB_CRR.ID_MODELO = TB_MOD.ID_MODELO
                    INNER JOIN TB_MODELO_VERSOES AS TB_MOD_VERSAO ON (TB_CRR.ID_MODELO_VERSAO = TB_MOD_VERSAO.ID_MODELO_VERSAO)
                    WHERE TB_CRR.id_carro = $id_carro";

                    $resultado = mysqli_query($conexao, $consulta);
                    $valores   = mysqli_fetch_array($resultado);
                ?>
                <div class="classe_carros">
                    <?php
                        echo('<article class="article_carro">');
                            echo('<div id="dvminis">');
                                echo('<img src="'.$valores["min3"].'" class="mini" onclick="clique(\''.$valores["foto1"].'\')"></a>');
                                echo('<img src="'.$valores["min4"].'" class="mini" onclick="clique(\''.$valores["foto2"].'\')"></a>');
                            echo('</div>');

                            echo('<div id="dvdetalhes">');
                                echo('<div id="dvc1">');
                                    echo('Código : '.$valores["id_carro"].'<br/>');
                                    echo('Marca: '.$valores["MARCA"].'<br/>');
                                    echo('Modelo: '.$valores["MODELO"].'<br/>');
                                    echo('Modelo Versão: '.$valores["modelo_versao"].'<br/>');
                                    echo('Versão: '.$valores["versao"].'<br/>');
                                    echo('Preço <span class="preco">R$ '.number_format($valores["valor"], 2, ',', '.').'</span><br/>');
                                    echo('Ano: '.$valores["ano_fab"].'<br/>');
                                echo('</div>');
                                    
                                echo('<div id="dvc2">');
                                    echo('Observação: '.$valores["obs"].'<br/>');                                    
                                    echo('Opcional 01: '.($valores["opc1"] == "1" ? "Vidro Elétrico" : "0").'<br/>');                                    
                                    echo('Opcional 02: '.($valores["opc2"] == "1" ? "Teto Solar": "0").'<br/>');                                    
                                    echo('Opcional 03: '.($valores["opc3"] == "1" ? "Ar Condicionado" : "0").'<br/>');
                                    echo('Vendido: '.($valores["vendido"] == "1" ? "Sim" : "Não").'<br/>');
                                    echo('Bloqueado: '.($valores["bloqueado"] == "1" ? "Sim" : "Não"));
                                echo('</div>');
                            echo('</div>');
                        echo('</article>')
                    ?>
                </div>
                <div id="janelaModal">
                    <span id="btFechar">Fechar</span>
                    <img id="imgModal">
                </div>
            </section>

            <section id="rodape" style="clear: left;">
                <?php
                    require_once("../HTML/rodape.html");
                ?>
            </section>   
        </div>
    </body>
</html>