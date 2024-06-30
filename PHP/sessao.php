<?php
    include('conexao.php');
    //
    session_start();
    if(isset($_SESSION["numlogin"])){
        if(isset($_GET["num"])){
            $numSecao = $_GET["num"];
        }else if(isset($_POST["num"])){
            $numSecao = $_POST["num"];
        }
        $numSecaoChvae = $_SESSION["numlogin"];
        if($numSecao != $numSecaoChvae){
            echo("<h2>Login não realizado!</h2>");
            exit();
        }
    }else{
        echo("<h2>Login não realizado!</h2>");
        exit();
    }
?>