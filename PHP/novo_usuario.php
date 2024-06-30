<?php
    include("sessao.php");    
?>
<!doctype html>
<html lang="pt-br">
    <head>
        <title>Itapú Veículos</title>
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
                    <h2>Novo Usuário.</h2>                
                    <form name="" class="formulario_padrao" method="GET" action="novo_usuario.php">
                        <input type="hidden" name="num" value="<?php echo($numSecao); ?>">
                        <!---->
                        <label for="id_nome">Nome:</label>
                        <input type="text" name="f_nome" id="id_nome" maxlength="50" required>

                        <label for="id_user">Usuário:</label>
                        <input type="text" name="f_user" id="id_user" maxlength="50" required>

                        <label for="id_senha">Senha:</label>
                        <input type="password" name="f_senha" id="id_senha" maxlength="20" required>

                        <label for="id_acesso">Acesso:</label>
                        <select name="select_acesso" id="id_acesso" class="class_Buscar" required>
                            <option value="ATIVO">ATIVO</option>
                            <option value="DESLIGADO">DESLIGADO</option>
                        </select>                    
                        <input type="submit" name="f_bt_novo_colaborador" class="btmenu" value="Salvar">                    
                        <!--<input type="text" name="f_acesso" id="id_acesso" maxlength="9" size="20" require="required" pattern="[0-1]+$" placeholder="0 ou 1" title="0 ou 1">-->
                    </form>
                </div>
            </section>            
        </div>
    </body>
</html>

<?php
    if(isset($_GET['f_bt_novo_colaborador'])){

        $nome = addslashes($_GET['f_nome']);
        $usuario = addslashes($_GET['f_user']);
        $senha = addslashes($_GET['f_senha']);
        $id_acesso = addslashes($_GET['select_acesso']);

        $sql = "INSERT INTO tb_colaboradores VALUES (DEFAULT, '$nome', '$usuario', MD5('$senha'), '$id_acesso')";

        include("mensagem_acao.php");
    }
?>