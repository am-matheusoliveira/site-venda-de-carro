
<?php

    $query = "        
        SELECT 
        	TB_CRR.id_carro, TB_CRR.min3, TB_CRR.versao, 
        	TB_CRR.valor, TB_CRR.ano_fab, TB_CRR.ano_mod, 
        	TB_CRR.vendido, TB_MCS.marca, TB_MOD.modelo, 
        	TB_MOD_VERSAO.modelo_versao, TB_CRR.qtd_visitas
        FROM 
        	TB_CARROS                AS TB_CRR
        INNER JOIN TB_MARCAS         AS TB_MCS        ON (TB_CRR.ID_MARCA  = TB_MCS.ID_MARCA)
        INNER JOIN TB_MODELOS        AS TB_MOD        ON (TB_CRR.ID_MODELO = TB_MOD.ID_MODELO)
        INNER JOIN TB_MODELO_VERSOES AS TB_MOD_VERSAO ON (TB_CRR.ID_MODELO_VERSAO = TB_MOD_VERSAO.ID_MODELO_VERSAO)
        ORDER BY TB_CRR.qtd_visitas DESC
        LIMIT 5;
    ";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h3>Top 5 Modelos mais Visitados</h3>
<?php foreach($result as $registro): ?>
    <div class="classe_carros">
       <article class="article_carro">
          <div id="d1"><a href="detalhes_modelo.php?id_carro=<?= $registro["id_carro"] ?>"><img src="<?= $registro["min3"] ?>"></a></div>
          <div id="d2">
             <div id="titulo">
                <div id="t1">
                   <a href="detalhes_modelo.php?id_carro=<?= $registro["id_carro"] ?>">
                      <p>MARCA: <?= $registro["marca"]  ?></p>
                      <p>MODELO: <?= $registro["modelo"] ?></p>
                      <p>ANO VERSÃO: <?= $registro["versao"] ?></p>
                      <p>MODELO VERSÃO: <?= $registro["modelo_versao"] ?></p>
                   </a>
                </div>
                <div id="t2">
                   <p><?= number_format($registro["valor"], 2, ',', '.') ?></p>
                </div>
             </div>
             <div id="dados">
                Ano - Fabricação: <?= $registro["ano_fab"] ?>
                <br>
                Ano - Modelo: <?= $registro["ano_mod"] ?>
                <br>
                Vendido: <?= ($registro["vendido"] == "1" ? "Sim" : "Não") ?>
            </div>
             <div></div>
          </div>
       </article>
    </div> 
<?php endforeach; ?>