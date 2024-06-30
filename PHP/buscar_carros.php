<?php

    include('conexao.php');
    //
    // DEFININDO A LOCALIZAÇÃO DO PAIS
    // setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
    //
    // // DEFININDO O TIMEZONE
    // date_default_timezone_set('America/Sao_Paulo');
    //
    // ATRIBUINDO A DATA E HORA COMPLETA - FORMATO [Sun, 30 Jun 2024 12:30:30]
    $DateTimeGMT = date("D, d M Y H:i:s");

    // DEFININDO DOS CABEÇALHOS HTTP
    header("Expires: {$DateTimeGMT} GMT"); 
    header("Last-Modified: {$DateTimeGMT} GMT");
    header("Cache-Control: no-cache, must-revalidate"); 
    header("Pragma: no-cache");
    header("Content-Type: text/html; charset=utf-8");
    header("Content-Type: application/json");
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Credentials: true");
    header("Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS");
    header("Access-Control-Max-Age: 1000");
    header("Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description, X-Request-With");
    header("Access-Control-Allow-Headers: X-Requested-With");

    // VERIFICANDO SE $_POST EXISTE, DENTRO DELA ESTA OS DADDOS DE NOSSA REQUEST
    if(isset($_POST["busca_modelo"])){

        // BUSCANDO MODELOS COM BASE EM SUA MARCA
        $query = "SELECT id_modelo AS campo_key, modelo AS campo_value  FROM tb_modelos WHERE id_marca = :id_marca ORDER BY id_modelo";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":id_marca", $_POST['busca_modelo'], PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // echo('<pre>');
        // print_r($result);
        // echo('</pre>');
        // exit;
        
        // MENSAGEM DE RETORNO DA REQUEST
        if($stmt->rowCount() >= 1)
            echo(json_encode($result));
        else
            echo(json_encode(array()));
    };

    if(isset($_POST["busca_carro"])){

        // BUSCANDO CARROS COM BASE EM SEU MODELO
        $query = "
            SELECT             	                
                TB_CRR.id_carro, TB_CRR.min3, TB_CRR.versao, 
                TB_CRR.valor, TB_CRR.ano_fab, TB_CRR.ano_mod, 
                TB_CRR.vendido, TB_MCS.marca, TB_MOD.modelo, 
                TB_MOD_VERSAO.modelo_versao
            FROM 
            	TB_CARROS                AS TB_CRR
            INNER JOIN TB_MARCAS         AS TB_MCS        ON (TB_CRR.ID_MARCA  = TB_MCS.ID_MARCA)
            INNER JOIN TB_MODELOS        AS TB_MOD        ON (TB_CRR.ID_MODELO = TB_MOD.ID_MODELO)
            INNER JOIN TB_MODELO_VERSOES AS TB_MOD_VERSAO ON (TB_CRR.ID_MODELO_VERSAO = TB_MOD_VERSAO.ID_MODELO_VERSAO)
            WHERE 
            	TB_CRR.ID_MARCA = :ID_MARCA 
            AND TB_CRR.ID_MODELO = :ID_MODELO
            ORDER BY 
            	ID_CARRO
            LIMIT 5;
        ";

        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":ID_MARCA", $_POST['id_marca'], PDO::PARAM_INT);
        $stmt->bindParam(":ID_MODELO", $_POST['id_modelo'], PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // MENSAGEM DE RETORNO DA REQUEST
        if($stmt->rowCount() >= 1)
            echo(json_encode($result));
        else
            echo(json_encode(array()));
    }
?>