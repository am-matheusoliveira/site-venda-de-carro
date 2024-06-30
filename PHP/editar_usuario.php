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
    </head>
    <body>
        <div id="interface">
            <header>
                <?php include("topo.php"); ?>
                <script> document.getElementById('btlogin').style.visibility = 'hidden'; </script>
            </header>
            <!---->
            <section id="section_form">            
                <div class="posicionar_form">
                    <a href="gerenciamento.php?num=<?php echo($numSecao); ?>" target="_self" class="btmenu">Retornar</a>                    
                    <a id="mensagem_acao" disabled></a>
                    <div id="mostrar_registro">
                        <?php
                            if(isset($_GET['f_bt_salvar_colaborador'])){
                                $id_colaborador = addslashes($_GET['id_colaborador']);
                                $nome = addslashes($_GET['f_nome']);
                                $usuario = addslashes($_GET['f_user']);
                                $senha = addslashes($_GET['f_senha']);
                                $id_acesso = addslashes($_GET['select_acesso']);
                            
                                $sql = "UPDATE tb_colaboradores SET id_colaborador = '$id_colaborador', nome = '$nome', username = '$usuario', senha = md5('$senha'), acesso = '$id_acesso' WHERE id_colaborador = '$id_colaborador'";
                            
                                include("mensagem_acao.php");
                                //
                                echo('<script> document.getElementById("mostrar_registro").style.display = "block" </script>');
                                echo('<script> document.getElementById("editar_registro").style.display = "none" </script>');                                
                            }
                        ?>
                        <h2>Editar Usuário.</h2>
                        <h3>Selecione o usuário.</h3>
                        <form name="" class="formulario_padrao" method="GET" action="editar_usuario.php">
                            <input type="hidden" name="num" value="<?php echo($numSecao); ?>">
                            <select name="select_editar_colaborador" id="select_editar_colaborador" size="10"required>
                            <?php 
                                $consulta  = "SELECT * FROM tb_colaboradores";
                                $resultado = mysqli_query($conexao, $consulta);
                                $valores   = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
                                //
                                foreach($valores as $valores){ 
                            ?>
                                    <option value="<?php echo($valores['id_colaborador']); ?>"><?php echo($valores['nome']); ?></option>
                            <?php }?>
                            </select>                                                    
                            <input type="submit" name="f_bt_posicionar_colaborador" class="btmenu" value="Editar">
                        </form>                                
                    </div>
                    <!---->
                    <div id="editar_registro">
                        <?php 
                            if(isset($_GET['f_bt_posicionar_colaborador'])){
                                $id_colaborador = addslashes($_GET['select_editar_colaborador']);
                                //
                                $consulta  = "SELECT * FROM tb_colaboradores WHERE id_colaborador = '$id_colaborador'";
                                $resultado = mysqli_query($conexao, $consulta);
                                $valores   = mysqli_fetch_array($resultado); 
                                //
                                echo('<script> document.getElementById("mostrar_registro").style.display = "none" </script>');
                                echo('<script> document.getElementById("editar_registro").style.display = "block" </script>');
                        ?>

                        <form name="" class="formulario_padrao" method="GET" action="editar_usuario.php">
                            <input type="hidden" name="num" value="<?php echo($numSecao); ?>">
                            <input type="hidden" name="id_colaborador" value="<?php echo($valores[0]);?>">                        
                            <!---->
                            <label for="id_nome">Nome:</label>
                            <input type="text" name="f_nome" id="id_nome" maxlength="50" value="<?php echo($valores[1]);?>" required>
                            
                            <label for="id_user">Usuário:</label>
                            <input type="text" name="f_user" id="id_user" maxlength="50" value="<?php echo($valores[2]);?>" required>
                            
                            <label for="id_senha">Senha:</label>
                            <input type="password" name="f_senha" id="id_senha" maxlength="20" value="<?php echo($valores[3]);?>" required>
                            
                            <label for="id_acesso">Acesso:</label>
                            <select name="select_acesso" id="id_acesso" class="class_Buscar" required>
                                <option value="ATIVO">ATIVO</option>
                                <option value="DESLIGADO">DESLIGADO</option>
                            </select>
                            <input type="submit" name="f_bt_salvar_colaborador" class="btmenu" value="Salvar">
                        </form>
                    </div>
                </div>
                <?php } ?>
            </section>            
        </div>
    </body>
</html>