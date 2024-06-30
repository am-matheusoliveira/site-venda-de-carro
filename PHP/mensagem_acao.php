<?php        
    mysqli_query($conexao, $sql);
 
    $linhas_afetadas = mysqli_affected_rows($conexao);
 
    if($linhas_afetadas > 0){
        echo("<script> document.getElementById('mensagem_acao').style.visibility = 'visible'; document.getElementById('mensagem_acao').style.backgroundColor = '#04AA6D'; document.getElementById('mensagem_acao').innerHTML = 'Registro executado com sucesso &#128512;'; </script>");
    }else{
        echo("<script> document.getElementById('mensagem_acao').style.visibility = 'visible'; document.getElementById('mensagem_acao').style.backgroundColor = '#CF1B29'; document.getElementById('mensagem_acao').innerHTML = 'Registro executado sem sucesso &#128528;'; </script>");
    }
?>