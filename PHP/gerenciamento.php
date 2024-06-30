<?php
    include('sessao.php');
?>
<!doctype html>
<html lang="pt-br">
    <head>
        <title>Itapú Veículos</title>
        <!--<meta charset="utf-8"/>   Temos essa opção i abaixo temos uma mais completa-->
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="../CSS/estilo.css" />
        <link rel="icon" href="../IMG/logoGoogle.png" />
        <script src="../JS/jquery-3.6.0.min.js"></script>
        <!--Para fazer o arquivo JS abaixo funcionar e necessario 1° Adicionar o Arquivo do JQuery... Como declarado acima-->
        <script type="text/javascript" src="../JS/scriptMenu.js"></script>
    </head>
    <body>
        <div id="interface">
            <header>
                <?php include("topo.php"); ?>
                <script> document.getElementById('btlogin').style.visibility = 'hidden'; </script>
            </header>
            <!---->
            <section class="secao_topo_geren">
                <h3>Menu principal de gerenciamento</h3>        
                <nav>
                    <div class="menu_ger">
                        <button id="mostraMenuCarros" class="btmenu widthButton">Carros</button>
                        <div id="menuCarros" class="menuB">
                            <a href="novo_carro.php?num=<?php echo($numSecao); ?>" target="_self">Novo</a>
                            <a href="" target="_self">Editar</a>
                            <a href="excluir_carro.php?num=<?php echo($numSecao); ?>" target="_self">Excluir</a>
                            <a href="marcas_modelos.php?num=<?php echo($numSecao); ?>" target="_self">Marcas-Modelos</a>
                        </div>
                    </div>
                    <!---->
                    <div class="menu_ger">
                        <button id="mostraMenuSlides" class="btmenu widthButton">Slider</button>
                        <div id="menuSlides" class="menuB">
                            <a href="" target="_self">Configurar</a>
                        </div>
                    </div>           
                    <!---->

                    <?php if($_SESSION["acesso"] == 'ATIVO'){?>
                    <div class="menu_ger">
                        <button id="mostraMenuUsuario" class="btmenu widthButton">Usuários</button>
                        <div id="menuUsuario" class="menuB">
                            <a href="novo_usuario.php?num=<?php echo($numSecao); ?>" target="_self">Novo</a>                        
                            <a href="editar_usuario.php?num=<?php echo($numSecao); ?>" target="_self">Editar</a>
                            <a href="excluir_usuario.php?num=<?php echo($numSecao); ?>" target="_self">Excluir</a>
                        </div>
                    </div>
                    <?php } ?>
                    <!---->
                    <div class="menu_ger">
                        <button id="mostraMenuLogoff" class="btmenu widthButton">Logoff</button>
                        <div id="menuLogoff" class="menuB">
                            <a href="logout.php" target="_self">Sair</a>
                        </div>
                    </div>
                </nav>    
            </section>        
        </div>
    </body>
</html>