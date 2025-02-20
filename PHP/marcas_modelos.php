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
        <script>
            $(document).ready(function(){

                // ATUALIZA O SELECT MODELO PARA DELETAÇÃO
                $('#f_select_delete_marca').on('change', function(){
                    
                    // VAR AUXILIAR - DEFINI O PRIMEIRO OPTION VISIVEL
                    let first_option = null;

                    $('select[name="f_select_delete_modelo"] option').each(function(){
                        
                        if(($(this).data('marca') == $('#f_select_delete_marca').val())){
                            $(this).show();
                            //
                            if(first_option === null){
                                first_option = $(this).data('id');
                            }
                        }else{
                            $(this).hide();
                        }
                        
                    });
                    //
                    $('#f_select_delete_modelo')[0].selectedIndex = first_option;
                    $('#f_select_delete_modelo').trigger('change');
                });

                // ATUALIZA O SELECT MODELO_VERSAO PARA DELETAÇÃO
                $('#f_select_delete_modelo').on('change', function(){
                    
                    $('select[name="f_select_delete_modelo_versao"] option').each(function(){

                        ($(this).data('modelo') == $('#f_select_delete_modelo').val()) ? $(this).show() : $(this).hide();

                    });
                });
            });
                        
            function add(){
                document.getElementById("f_add").style.display="block";
                document.getElementById("f_del").style.display="none";
            }

            function del(){
                document.getElementById("f_del").style.display="block";
                document.getElementById("f_add").style.display="none";
            }
        </script>
    </head>
    <body>
        <div id="interface">
            <header>
                <?php include("topo.php"); ?>
            </header>
            <!---->
            <section id="section_form">
                <div class="posicionar_form_marca_modelo">
                    <a href="gerenciamento.php?num=<?php echo($numSecao); ?>" target="_self" class="btmenu">Retornar</a>                    
                    <a id="mensagem_acao" disabled></a>
                    <h2>Marcas / Modelos</h2>
                    <button class="btmenu" onclick="add()">Cadastrar</button>
                    <button class="btmenu" onclick="del()">Apagar</button> 
                    <div id="f_add" class="f_add_del">
                        <div>
                            <?php
                                if(isset($_GET["f_bt_nova_marca"])){
                                    $marca = strtoupper(addslashes($_GET["f_marca"]));
                                    //
                                    $sql = "INSERT INTO tb_marcas VALUES(DEFAULT, '$marca')";
                                
                                    include("mensagem_acao.php");
                                }else if(isset($_GET["f_bt_deletar_marca"])){
                                    $marca = addslashes($_GET["f_select_delete_marca"]);
                                    //
                                    $sql = "DELETE FROM tb_marcas WHERE id_marca = '$marca'";
                                
                                    include("mensagem_acao.php");
                                }
                            ?>                            
                            <h2>Cadastrar marca</h2>
                            <form name="" class="formulario_padrao" method="GET" action="marcas_modelos.php">
                                <input type="hidden" name="num" value="<?php echo($numSecao); ?>">
                                <!---->
                                <label for="f_marca">Nova marca</label>
                                <input type="text" name="f_marca" id="f_marca" maxlength="50" size="50" required>               
                                <input type="submit" value="Salvar marca" class="btmenu" name="f_bt_nova_marca">
                            </form>
                        </div>

                        <div>
                            <h2>Cadastrar modelo</h2>
                            <form name="" class="formulario_padrao" method="GET" action="marcas_modelos.php">
                                <input type="hidden" name="num" value="<?php echo($numSecao); ?>">
                                <label for="nome_modelo">Novo modelo</label>
                                <input type="text" name="nome_modelo" id="nome_modelo" maxlength="50" size="50" required>
                                <!---->
                                <label for="f_select_modelo_marca">Selecione uma marca</label>
                                <select name="f_select_modelo_marca" id="f_select_modelo_marca" size="10" required>
                                <?php
                                    $consulta = "SELECT * FROM tb_marcas";
                                    $result   = mysqli_query($conexao, $consulta);                        
                                    $valores  = mysqli_fetch_all($result);
                                    //
                                    foreach($valores as $valores){?>
                                        <option value="<?php echo($valores[0]); ?>"><?php echo($valores[1]); ?></option>                            
                                <?php } ?>
                                </select>
                                <input type="submit" value="Salvar modelo" class="btmenu" name="f_bt_novo_modelo">
                            </form>
                        </div>

                        <div>
                            <h2>Cadastrar modelo versão</h2>
                            <form name="" class="formulario_padrao" method="GET" action="marcas_modelos.php">
                                <input type="hidden" name="num" value="<?php echo($numSecao); ?>">
                                <label for="nome_modelo_versao">Novo modelo versão</label>
                                <input type="text" name="nome_modelo_versao" id="nome_modelo_versao" maxlength="50" size="50" required>
                                <!---->
                                <label for="f_select_modelo">Selecione um modelo</label>
                                <select name="f_select_modelo" id="f_select_modelo" size="10" required>
                                <?php
                                    $consulta = "SELECT * FROM tb_modelos";
                                    $result   = mysqli_query($conexao, $consulta);                        
                                    $valores  = mysqli_fetch_all($result);
                                    //
                                    foreach($valores as $valores){?>
                                        <option value="<?php echo($valores[0]); ?>"><?php echo($valores[1]); ?></option>
                                <?php } ?>
                                </select>
                                <input type="submit" value="Salvar modelo versão" class="btmenu" name="f_bt_novo_modelo_versao">
                            </form>
                        </div>                        
                    </div>
                    <!---->
                    <div id="f_del" class="f_add_del">
                        <?php
                            
                            // CADASTRAR MODELO
                            if(isset($_GET["f_bt_novo_modelo"])){
                                $id_marca = addslashes($_GET["f_select_modelo_marca"]);
                                $modelo   = strtoupper(addslashes($_GET["nome_modelo"]));
                                //
                                $sql = "INSERT INTO tb_modelos VALUES(DEFAULT, '$modelo', '$id_marca')";

                                include("mensagem_acao.php");
                            }
                            
                            // EXCLUIR UM MODELO
                            if(isset($_GET["f_bt_deletar_modelo"])){
                                $modelo = addslashes($_GET["f_select_delete_modelo"]);
                                //
                                $sql = "DELETE FROM tb_modelos WHERE id_modelo = '$modelo'";

                                include("mensagem_acao.php");
                            }
                            
                            // CADASTRAR MODELO VERSÃO
                            if(isset($_GET["f_bt_novo_modelo_versao"])){
                                $modelo_versao = strtoupper(addslashes($_GET["nome_modelo_versao"]));
                                $id_modelo = strtoupper(addslashes($_GET["f_select_modelo"]));
                                //
                                $sql = "INSERT INTO tb_modelo_versoes VALUES(DEFAULT, '$modelo_versao', '$id_modelo')";

                                include("mensagem_acao.php");
                            }
                            
                            // EXCLUIR MODELO VERSÃO
                            if(isset($_GET["f_bt_deletar_modelo_versao"])){
                                $modelo_versao = addslashes($_GET["f_select_delete_modelo_versao"]);
                                //
                                $sql = "DELETE FROM tb_modelo_versoes WHERE id_modelo_versao = '$modelo_versao'";

                                include("mensagem_acao.php");
                            }                            
                        ?>
                        <div>
                            <h2>Deletar marca</h2>
                            <form name="" class="formulario_padrao" method="GET" action="marcas_modelos.php">
                                <input type="hidden" name="num" value="<?php echo($numSecao); ?>">
                                <!---->
                                <label for="f_select_delete_marca">Selecione uma marca</label>
                                <select name="f_select_delete_marca" id="f_select_delete_marca" size="10" required>
                                <?php
                                    $consulta = "SELECT * FROM tb_marcas";
                                    $result   = mysqli_query($conexao, $consulta);                        
                                    $valores  = mysqli_fetch_all($result);
                                    //
                                    foreach($valores as $valores){?>
                                        <option value="<?php echo($valores[0]); ?>"><?php echo($valores[1]); ?></option>                            
                                <?php } ?>
                                </select>
                                <input type="submit" value="Deletar marca" class="btmenu" name="f_bt_deletar_marca">
                            </form>
                        </div>

                        <div>
                            <h2>Deletar modelo</h2>
                            <form name="" class="formulario_padrao" method="GET" action="marcas_modelos.php">
                                <input type="hidden" name="num" value="<?php echo($numSecao); ?>">
                                <!---->
                                <label for="f_select_delete_modelo">Selecione um modelo</label>
                                <select name="f_select_delete_modelo" id="f_select_delete_modelo" size="10" required>
                                <?php
                                    $consulta = "SELECT * FROM tb_modelos";
                                    $result   = mysqli_query($conexao, $consulta);                        
                                    $valores  = mysqli_fetch_all($result);
                                    //
                                    foreach($valores as $key => $valores){?>
                                        <option value="<?php echo($valores[0]); ?>" data-marca="<?php echo($valores[2]); ?>" data-id="<?= $key ?>" ><?php echo($valores[1]); ?></option>                            
                                <?php } ?>
                                </select>
                                <input type="submit" value="Deletar modelo" class="btmenu" name="f_bt_deletar_modelo">
                            </form>
                        </div>

                        <div>
                            <h2>Deletar modelo versão</h2>
                            <form name="" class="formulario_padrao" method="GET" action="marcas_modelos.php">
                                <input type="hidden" name="num" value="<?php echo($numSecao); ?>">
                                <!---->
                                <label for="f_select_delete_modelo_versao">Selecione um modelo versão</label>
                                <select name="f_select_delete_modelo_versao" id="f_select_delete_modelo_versao" size="10" required>
                                <?php
                                    $consulta = "SELECT * FROM tb_modelo_versoes";
                                    $result   = mysqli_query($conexao, $consulta);                        
                                    $valores  = mysqli_fetch_all($result);
                                    //
                                    foreach($valores as $valores){?>
                                        <option value="<?php echo($valores[0]); ?>" data-modelo="<?php echo($valores[2]); ?>"><?php echo($valores[1]); ?></option>                            
                                <?php } ?>
                                </select>
                                <input type="submit" value="Deletar modelo versão" class="btmenu" name="f_bt_deletar_modelo_versao">
                            </form>
                        </div>                        
                    </div>
                </div>
            </section>
        </div>
        <script type="text/javascript">
            $(window).on("load", function(){
                // DEFININDO A PRIMEIRA OPÇÃO DO 'SELECT MARCAS'
                $('#f_select_delete_marca').prop('selectedIndex', 0);

                // ESCONDENDO E MOSTRANDO AS OPÇÕES QUE CORRESPONDEM A MARCA CLICADA
                $('#f_select_delete_modelo option').each(function(){                                        
                    ($(this).data('marca') == $('#f_select_delete_marca').val()) ? $(this).show() : $(this).hide();
                });
                
                // DEFININDO A PRIMEIRA OPÇÃO DO 'SELECT MODELOS'
                $('#f_select_delete_modelo').prop('selectedIndex', 0);

                // ESCONDENDO E MOSTRANDO AS OPÇÕES QUE CORRESPONDEM AO MODELO CLICADO
                $('#f_select_delete_modelo_versao option').each(function(){
                    ($(this).data('modelo') == $('#f_select_delete_modelo').val()) ? $(this).show() : $(this).hide();
                });                
            });
        </script> 

    </body>
</html>
<?php
    if(isset($_GET["f_bt_nova_marca"])||isset($_GET["f_bt_novo_modelo"])){
        
        echo('<script> document.getElementById("f_add").style.display="block"; </script>');

    }else if(isset($_GET["f_bt_deletar_marca"])||isset($_GET["f_bt_deletar_modelo"]) || isset($_GET['f_bt_deletar_modelo_versao'])){
        
        echo('<script> document.getElementById("f_del").style.display="block"; </script>');

    }
?>