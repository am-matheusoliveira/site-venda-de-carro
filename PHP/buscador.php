
<?php

    include('conexao.php');
    //
    $query = "SELECT * FROM tb_marcas ORDER BY id_marca";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<fieldset class="fieldSetBusca">
    <legend>Encontre um veículo</legend>
    <form name="fbuscador" id="fbuscador" action="#" method="post">
        <div class="divbusca">
            <label for="id_marca">Selecione uma marca</label>
            <select name="marca" id="id_marca" class="class_Buscar">
                <option value="50000" selected>Selecione uma marca</option>
                <?php foreach($result as $key => $value): ?>                    
                    <option value="<?= $value['id_marca'] ?>"><?= $value['marca'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <!---->
        <div class="divbusca">
            <label for="id_modelo">Selecione um modelo</label>
            <select name="modelo" id="id_modelo" class="class_Buscar">
			    <option value="50000" selected>Selecione a marca do modelo</option>
            </select>
        </div>
    </form>
</fieldset>
<div id="secao-resulta-busca">

</div>

<script src="../JS/bibliotecaAjax.js"></script>
<script>

    // SELECT'S: MARCAS & MODELOS
    const select_marca = document.getElementById("id_marca");
    const select_modelo = document.getElementById("id_modelo");
    const secao_resulta_busca = document.getElementById("secao-resulta-busca");

    // ADICIONANDO UM ESCUTADOR DE EVENTOS AO SELECT MARCAS
    select_marca.addEventListener("change", function(){

        // REMOVENDO OS ELEMENTOS DA BUSCA DE CARROS
        secao_resulta_busca.innerHTML = '';

        // REMOVER AS OPTIONS DO SELECT
        clean_select(select_modelo);        

        if(this.value != "50000"){
            // CHAMANDO A FUNÇÃO QUE REALIZA A REQUISIÇÃO
            requisicaoHTTP("POST", "buscar_carros.php", true, ("busca_modelo=" + this.value), "ATUALIZA-SELECT", select_modelo);
        }
    });

    // ADICIONANDO UM ESCUTADOR DE EVENTOS AO SELECT MODELOS
    select_modelo.addEventListener("change", function(){

        // REMOVENDO OS ELEMENTOS DA BUSCA DE CARROS
        secao_resulta_busca.innerHTML = '';

        // QUERY_STRING - MONTANDO NOSSA URL PARA A REQUEST HTTP
        let query_string = "busca_carro=dois_parametros&id_marca=" + select_marca.options[select_marca.selectedIndex].value + "&id_modelo=" + this.value;
        
        // CHAMANDO A FUNÇÃO QUE REALIZA A REQUISIÇÃO
        requisicaoHTTP("POST", "buscar_carros.php", true, query_string, "LISTA-CARROS", secao_resulta_busca);
    });    
</script>