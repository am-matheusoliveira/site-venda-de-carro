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
                    <h2>Excluir Usuário.</h2>
                    <?php
                        if(isset($_GET['f_bt_excluir_colaborador'])){
                            $id_colaborador = addslashes($_GET['select_excluir_colaborador']);
                            $sql = "DELETE FROM tb_colaboradores WHERE id_colaborador = '$id_colaborador'";
                        
                            include("mensagem_acao.php");
                            //echo("<script> window.history.pushState(null, null, '/SiteCompleto/PHP/excluir_usuario.php?num=W7dwIxn2a9M1VjCzmBMlmSnF'); </script>");
                            //echo("<script> window.history.pushState(null, null, '/SiteCompleto/PHP/excluir_usuario.php?num=W7dwIxn2a9M1VjCzmBMlmSnF'); </script>");
                        }                

                    ?>
                    <form name="f_excluir_colaborador" class="formulario_padrao" method="GET" action="excluir_usuario.php">
                        <input type="hidden" name="num" value="<?php echo($numSecao); ?>">

                        <h3>Selecione o usuário.</h3>
                        <select name="select_excluir_colaborador" id="select_excluir_colaborador" size="10" required>
                            <?php 
                                $consulta = 'SELECT * FROM tb_colaboradores';
                                $result = mysqli_query($conexao, $consulta);                                                     
                                $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
                                foreach ($rows as $row) { ?>
                                    <option value="<?php echo($row['id_colaborador']); ?>"><?php echo($row['nome']); ?></option>
                            <?php } ?>
                        </select>
                        <input type="submit" name="f_bt_excluir_colaborador" class="btmenu" value="Excluir">
                        <!--<input type="text" name="f_acesso" id="id_acesso" maxlength="9" size="20" require="required" pattern="[0-1]+$" placeholder="0 ou 1" title="0 ou 1">-->
                    </form>
                </div>
            </section>             
        </div>
    </body>
</html>