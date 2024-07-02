<?php 
    session_start();
    if(isset($_SESSION["numlogin"])){
        $numlogin = $_SESSION["numlogin"];
        header("Location: gerenciamento.php?num=$numlogin");
    }
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
            <header>
                <?php include("topo.php"); ?>
            </header>
            <!---->
            <section id="main">
                <p class="lgErro" style="background-color: rgb(255, 215, 0) !important; color: #2b2e38 !important;">Atenção Somente Administradores !</p>    
                <?php
                    include('conexao.php');

                    if(isset($_POST['f_logar'])){
    
                        if(empty($_POST['f_user']) || empty($_POST['f_senha'])) {
                            echo('<p class="lgErro">ERRO: Forneça todos os campos!</p>');
                            #header('Location: login.php');
                            #exit(0);
                        }else{
                         
                            $usuario = addslashes($_POST['f_user']);
                            $senha   = addslashes($_POST['f_senha']);
                             
                            $query = "SELECT * 
                                      FROM tb_colaboradores 
                                      WHERE username = '{$usuario}' AND senha = MD5('{$senha}')";
                             
                            $result = mysqli_query($conexao, $query);
                             
                            $row = mysqli_fetch_array($result);
        
                            if($row == 0){
                                echo('<p class="lgErro">ERRO: Usuário ou senha inválidos!</p>');
                            }else{
                                /*1º Embaralha a variavel $chave 
                                2º Conta quantos digitos tem a variavel Trabalho de $tChave
                                3º Usar uma função para realizar a criação da Chave com um tamnho ja definido */
                                //
                                $chave1   = 'abcdefghijklmnopqrstuvwxyz';
                                $chave2   = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                                $chave3   = '0123456789';
                                //
                                $chave    = str_shuffle($chave1.$chave2.$chave3); //strshuffle Essa função embaralha o conteudo de uma variavel.
                                $tChave   = strlen($chave); //strlen Retorna tamanho em numeros de uma variavel.
                                $qtde     = rand(20, 50);   //Usada apenas definir um valor aleatorio baseado em dois parametros
                                $numChave = "";
                                //
                                for ($c=0; $c < $qtde; $c++) { 
                                    $pos       = rand(0, $tChave);
                                    $numChave .= substr($chave, $pos, 1);
                                }
                                //
                                $_SESSION['numlogin'] = $numChave;
                                $_SESSION['username'] = $usuario;
                                $_SESSION['acesso']   = $row["acesso"];
                                                                
                                header("Location: gerenciamento.php?num=$numChave");
                                //Lembre do header(Location) sempre botar em aspas Duplas para poder usar variaveis;
                            }
                            mysqli_close($conexao);
                        }
                    }
                ?>
                <!---->                
                <form action="login.php" method="POST" name="f_login" id="f_login">
                    <!---->
                    <label for="f_user">Usuário</label>
	                <input type="text" name="f_user" id="f_user">
	                <!---->
	                <label for="f_senha">Senha</label>
	                <input type="password" name="f_senha" id="f_senha">
                    <!---->
	                <input type="submit" value="LOGAR" name="f_logar">
                </form>
            </section>             
        </div>
    </body>
</html>