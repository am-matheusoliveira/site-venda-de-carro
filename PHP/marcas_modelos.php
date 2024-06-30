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
                $('select[name="f_select_delete_marca"]').on('change', function(){
                    var vmarcas = this.value;
                    $('select[name="f_select_delete_modelo"] option').each(function(){
                        var $this = $(this);
                        if($this.data('marca') == vmarcas){
                            $this.show();
                        }else{
                            $this.hide();
                        }
                    });
                });
                //$('select[name="f_select_delete_modelo"]').val('');                
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
                <script> document.getElementById('btlogin').style.visibility = 'hidden'; </script>
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
                                <label for="f_select__modelo_marca">Selecione uma marca</label>
                                <select name="f_select__modelo_marca" id="f_select__modelo_marca" size="10" required>
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
                    </div>
                    <!---->
                    <div id="f_del" class="f_add_del">
                        <?php
                            if(isset($_GET["f_bt_novo_modelo"])){
                                $id_marca = addslashes($_GET["f_select__modelo_marca"]);
                                $modelo   = strtoupper(addslashes($_GET["nome_modelo"]));
                                //
                                $sql = "INSERT INTO tb_modelos VALUES(DEFAULT, '$modelo', '$id_marca')";

                                include("mensagem_acao.php");
                            }else if(isset($_GET["f_bt_deletar_modelo"])){
                                $modelo = addslashes($_GET["f_select_delete_modelo"]);
                                //
                                $sql = "DELETE FROM tb_modelos WHERE id_modelo = '$modelo'";

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
                                <label for="f_select_delete_modelo">Selecione uma modelo</label>
                                <select name="f_select_delete_modelo" id="f_select_delete_modelo" size="10" required>
                                <?php
                                    $consulta = "SELECT * FROM tb_modelos";
                                    $result   = mysqli_query($conexao, $consulta);                        
                                    $valores  = mysqli_fetch_all($result);
                                    //
                                    foreach($valores as $valores){?>
                                        <option value="<?php echo($valores[0]); ?>" data-marca="<?php echo($valores[2]); ?>"><?php echo($valores[1]); ?></option>                            
                                <?php } ?>
                                </select>
                                <input type="submit" value="Deletar modelo" class="btmenu" name="f_bt_deletar_modelo">
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <script type="text/javascript">
            $(window).on("load", function(){
                $('#f_select_delete_marca').prop("selectedIndex", 0);
                var vmarcas = $("#f_select_delete_marca option:selected").val();
                $('select[name="f_select_delete_modelo"] option').each(function(){                    
                    var $this = $(this);
                    if($this.data('marca') == vmarcas){
                        $this.show();                            
                    }else{
                        $this.hide();
                    }
                });                
                //selected="selected"
            });
        </script> 

    </body>
</html>
<?php
    if(isset($_GET["f_bt_nova_marca"])||isset($_GET["f_bt_novo_modelo"])){        
        
        echo('<script> document.getElementById("f_add").style.display="block"; </script>');

    }else if(isset($_GET["f_bt_deletar_marca"])||isset($_GET["f_bt_deletar_modelo"])){
        
        echo('<script> document.getElementById("f_del").style.display="block"; </script>');

    }
?>