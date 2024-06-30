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
                    <h2>Excluir Carro.</h2>
                    <?php
                        if(isset($_GET['f_bt_excluir_carro'])){
                            $id_carro = addslashes($_GET['select_excluir_carro']);
                            
                            $sql = "SELECT * FROM tb_carros WHERE id_carro = '$id_carro'";
                            
                            $comando = mysqli_query($conexao, $sql);                                                    

                            while($exibe=mysqli_fetch_assoc($comando)){
                                $fotos = array($exibe["foto1"], $exibe["foto2"]);
                                $minis = array($exibe["min3"], $exibe["min4"]);
                            }                            
                            $sql = "DELETE FROM tb_carros WHERE id_carro = '$id_carro'";                        
                            mysqli_query($conexao, $sql);
 
                            $linhas_afetadas = mysqli_affected_rows($conexao);
                         
                            if($linhas_afetadas > 0){
                                for($c=0; $c<2; $c++){ 
                                    try{                                             
                                        if(file_exists($fotos[$c])){
                                            unlink($fotos[$c]);
                                        }
                                        if(file_exists($minis[$c])){
                                            unlink($minis[$c]);
                                        }                                            
                                    }catch(Exception $e){
                                        echo("Erro: $e");
                                    }
                                }
                                echo("<script> document.getElementById('mensagem_acao').style.visibility = 'visible'; document.getElementById('mensagem_acao').style.backgroundColor = '#04AA6D'; document.getElementById('mensagem_acao').innerHTML = 'Registro executado com sucesso &#128512;'; </script>");
                            }else{
                                echo("<script> document.getElementById('mensagem_acao').style.visibility = 'visible'; document.getElementById('mensagem_acao').style.backgroundColor = '#CF1B29'; document.getElementById('mensagem_acao').innerHTML = 'Registro executado sem sucesso &#128528;'; </script>");
                            }
                        }                

                    ?>
                    
                    <form name="f_excluir_carro" class="formulario_padrao" method="GET" action="excluir_carro.php">
                        <input type="hidden" name="num" value="<?php echo($numSecao); ?>">

                        <h3>Selecione o Carro.</h3>
                        <select name="select_excluir_carro" id="select_excluir_carro" size="15" required>
                            <?php 
                                $consulta = 'SELECT TB_CRR.ID_CARRO,  CONCAT(TB_CRR.ID_CARRO," - ",TB_MCS.MARCA," - ",TB_MOD.MODELO," - ",TB_CRR.VERSAO," - ",TB_CRR.ANO_FAB," - ",TB_CRR.ANO_MOD," - R$ ",TB_CRR.VALOR) AS CARRO
                                FROM TB_CARROS AS TB_CRR
                                INNER JOIN TB_MARCAS AS TB_MCS  ON TB_CRR.ID_MARCA  = TB_MCS.ID_MARCA
                                INNER JOIN TB_MODELOS AS TB_MOD ON TB_CRR.ID_MODELO = TB_MOD.ID_MODELO';
                                $result = mysqli_query($conexao, $consulta);                                                     
                                $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
                                foreach ($rows as $row) { ?>
                                    <option value="<?php echo($row['ID_CARRO']); ?>"><?php echo($row['CARRO']); ?></option>
                            <?php } ?>
                        </select>
                        <input type="submit" name="f_bt_excluir_carro" class="btmenu" id="f_bt_excluir_carro" value="Excluir">
                    </form>
                </div>
            </section>             
        </div>
    </body>
</html>