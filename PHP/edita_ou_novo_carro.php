<?php
    include("sessao.php");
    //
    $opc_s = array();
    $opc_s[0] = 'Vidro Elétrico';
    $opc_s[1] = 'Teto Solar';
    $opc_s[2] = 'Ar Condicionado';
?>
<!doctype html>
<html lang="pt-br">
    <head>
        <title>Itapú Veículos</title>
        <!--<meta charset="utf-8"/>   Temos essa opção i abaixo temos uma mais completa-->
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="../CSS/estilo.css" />
        <link rel="icon" href="../IMG/logoGoogle.png" />
        <script src="../JS/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function(){
                //
                $('select[name="select_marcas"]').on('change', function(){
                    var vmarcas = this.value;
                    var first_option = null;
                    //
                    $('select[name="select_modelos"] option').each(function(){
                        var $this = $(this);                        
                        if($this.data('marca') == vmarcas){
                            $this.show();
                            //
                            if(first_option === null){
                                first_option = $this.data('id');
                            }
                        }else{
                            $this.hide();
                        }
                    });
                    //                    
                    $("select[name='select_modelos']")[0].selectedIndex = first_option;
                    $('select[name="select_modelos"]').trigger('change');
                });

                $('select[name="select_modelos"]').on('change', function(){
                    var vmodelos = this.value;
                    var first_option = null;
                    //
                    $('select[name="select_modelo_versao"] option').each(function(){
                        var $this = $(this);
                        if($this.data('modelo') == vmodelos){
                            $this.show();
                            //
                            if(first_option === null){
                                first_option = $this.data('id');
                            }                            
                        }else{
                            $this.hide();
                        }
                    });
                    //
                    $("select[name='select_modelo_versao']")[0].selectedIndex = first_option;
                });
                //
            });
        </script>
    </head>
    <body>
        <div id="interface">
            <header>
                <?php include("topo.php"); ?>                
            </header>
            <!---->
            <section id="section_form">            
                <div class="posicionar_form">
                    <a href="gerenciamento.php?num=<?php echo($numSecao); ?>" target="_self" class="btmenu">Retornar</a>                    
                    <a id="mensagem_acao" disabled></a>
                    <h2>Novo Carro.</h2>                
                    <form name="" class="formulario_padrao" method="POST" action="edita_ou_novo_carro.php" enctype="multipart/form-data">
                        <input type="hidden" name="num" value="<?php echo($numSecao); ?>">
                        <!---->
                        <label for="select_marcas">Marcas:</label>
                        <select name="select_marcas" id="select_marcas" required>
                            <!-- <option value="">Selecione uma Marca</option> -->
                            <?php
                                $consulta  = "SELECT * FROM tb_marcas";
                                $resultado = mysqli_query($conexao, $consulta);
                                $valores   = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
                                //
                                foreach($valores as $valores){
                                    echo("<option value='".$valores["id_marca"]."'>".$valores["marca"]."</option>");
                                }
                            ?>
                        </select>
                        
                        <label for="select_modelos">Modelos:</label>
                        <select name="select_modelos" id="select_modelos" required>
                            <!-- <option value="">Selecione um Modelo</option> -->
                            <?php
                                $consulta  = "SELECT * FROM tb_modelos";
                                $resultado = mysqli_query($conexao, $consulta);
                                $valores   = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
                                //
                                foreach($valores as $key => $valores){
                                    echo("<option value='".$valores["id_modelo"]."' data-marca='".$valores["id_marca"]."' data-id='".$key."'>".$valores["modelo"]."</option>");
                                }
                            ?>
                        </select>
                        
                        <label for="select_modelo_versao">Modelo Versão:</label>
                        <select name="select_modelo_versao" id="select_modelo_versao" required>
                            <!-- <option value="">Selecione um Modelo Versão</option> -->
                            <?php
                                $consulta  = "SELECT * FROM tb_modelo_versoes";
                                $resultado = mysqli_query($conexao, $consulta);
                                $valores   = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
                                //
                                foreach($valores as $key => $valores){
                                    echo("<option value='".$valores["id_modelo_versao"]."' data-modelo='".$valores["id_modelo"]."' data-id='".$key."'>".$valores["modelo_versao"]."</option>");
                                }
                            ?>
                        </select>
                        <label for="versao">Versão:</label>
                        <input type="text" name="f_versao" id="versao" maxlength="30" required>

                        <label for="anofab">Ano Fabricação:</label>
                        <input type="text" name="f_anofab" id="anofab" maxlength="4" required pattern="[0-9]{4}">

                        <label for="anomod">Ano Modelo:</label>
                        <input type="text" name="f_anomod" id="anomod" maxlength="4" required pattern="[0-9]{4}">

                        <label for="obs">Observação:</label>
                        <textarea name="f_obs" id="obs" rows="5" cols="20" maxlength="100" required></textarea>
                        
                        <label for="valor">Valor R$:</label>
                        <input type="text" name="f_valor" id="valor" maxlength="11" required pattern="[0-9]+$">

                        <label for="foto01">Foto 01:</label>
                        <input type="file" name="f_foto01" id="foto01">
                        
                        <label for="foto02">Foto 02:</label>
                        <input type="file" name="f_foto02" id="foto02">

                        <label>Opcionais:</label>
                        <div>
                            <div class="div_checkbox">
                                <input type="checkbox" name="f_opc1" id="opc01"><label for="opc01"><?php echo($opc_s[0]); ?></label>
                            </div>
                            <div class="div_checkbox">
                                <input type="checkbox" name="f_opc2" id="opc02"><label for="opc02"><?php echo($opc_s[1]); ?></label>
                            </div>
                            <div class="div_checkbox">
                                <input type="checkbox" name="f_opc3" id="opc03"><label for="opc03"><?php echo($opc_s[2]); ?></label>
                            </div>
                        </div>
                        <!--
                        <label>Momento atual desse veiculo:</label>
                        <div>
                            <div class="div_checkbox">
                                <input type="checkbox" name="f_bloqueado" value="0" id="carro_block"><label for="carro_block">Carro Bloqueado?</label>
                            </div>
                            <div class="div_checkbox">
                                <input type="checkbox" name="f_vendido" value="0" id="carro_vendido"><label for="carro_vendido">Carro Vendido?</label>
                            </div>
                        </div>
                        -->
                        <input type="submit" name="f_bt_novo_carro" class="btmenu" value="Salvar">
                    </form>
                </div>
            </section>            
        </div>

        <script type="text/javascript">
            //
            $(window).on("load", function(){  
                var vmarcas = $("#select_marcas option:selected").val();
                //
                $('select[name="select_modelos"] option').each(function(){
                    var $this = $(this);
                    if($this.data('marca') == vmarcas){
                        $this.show();                            
                    }else{
                        $this.hide();
                    }
                });
                
                var vmodelos = $("#select_modelos option:selected").val();
                //
                $('select[name="select_modelo_versao"] option').each(function(){
                    var $this = $(this);
                    if($this.data('modelo') == vmodelos){
                        $this.show();
                    }else{
                        $this.hide();
                    }
                });
            });
        </script> 
    </body>
</html>

<?php
    if(isset($_POST["f_bt_novo_carro"])){
        //Inicio do tratamento das Fotos
        $vetFotos  = array();
        $vetMinis  = array();
        $if        = 0;
        $qtdeFotos = 2;
        $dir       = "../CARROS/"; 
  
        for($if = 0; $if < $qtdeFotos; $if++){
            if(isset($_FILES["f_foto0".($if+1)]["name"])){
                if($_FILES["f_foto0".($if+1)]["name"] != ""){

                    //Aqui estamos extraindo a estensão do arquivo. com strtolower deixamos tudo em minusculo e substr para pegar a posição que queremos.
                    $ext = strtolower(substr($_FILES["f_foto0".($if+1)]["name"], -4));
                    
                    //Aqui temos a função uniqid() ela gera um nome aleatorio como uma chave unica note que estamos concatenando com $ext que a extensão do File.
                    $novo_nome = uniqid().$ext;
                    //Aqui e onde o arquivo e movido para a pasta que foi definda em $dir.
                    //Observe que aqui em baixo temos tmp_name. E como se o input type file pegasse o file e criace uma copia e mandace para o Temp
                    // Do sistema operacional assim com a função move_uploaded_file devemos mudar o name para tmp_name que e onde esta o arquivo que sera movido
                    //Com isso ele ira pegar da pasta Temp.. depois mover para o $dir.
                    move_uploaded_file($_FILES["f_foto0".($if+1)]["tmp_name"], $dir.$novo_nome);
                    //
                    
                    //Muito bem.. lis() -> essa função captura informações e salva em formato de array 4 valoes de diversos tipos
                    //Abaixo estamos pegando largura altura e tipo do File.. Usando a função (getimagesize) que captura 
                    //4 Valores $largura, $altura, $tipo, e $alt ainda não sei oque e KKKKK
                    //Tabem captura e salva como array
                    list($largura, $altura, $tipo) = getimagesize($dir.$novo_nome);
                    //imagecreatefromjpeg => essa função cria uma imagem do tipo jpeg basta passar o caminho e o nome do arquivo
                    //Obs: Ela cria uma imagem apartir de outra imagem com outra extensão como png  
                    $imagem = imagecreatefromjpeg($dir.$novo_nome);
                    
                    //imagecreatetruecolor -> com isso Aqui assim como no Paint e como se estivessimos criando uma imagem com fundo branco
                    $thumb = imagecreatetruecolor(117, 80);
                    
                    //Aqui em baixo com a função imagecopyresampled estamos copiando da imagem original um tamanho suficiente
                    //para colocarmos em 117x88 da imagem que criamos acima esse monte de 0 define X por Y no caso define Largura e Altura
                    //Passando a imagem criada e a imagem original como no paint copiamos uma imagem e colamos na que foi criada no paint
                    imagecopyresampled($thumb, $imagem, 0, 0, 0, 0, 117, 88, $largura, $altura);
                    
                    //Por ultimo estamos usando a função imagejpeg() para poder gravar na pasta as imagem criadas passando alguns parametros como
                    //a imagem $thumb que foi a que passou por todo o tratamento acima e estamos passando o caminho onde sera armazenada,
                    //por ultimo parametro estamos dizendo que a qualidade sera de 50%
                    imagejpeg($thumb, $dir."mini_". $novo_nome, 50);
                    
                    //Aqui estamos definindo o nome do File nos vetores para poder salvar no Bando de Dados.
                    //Da imagem original e da Mini imagem
                                        
                    $vetFotos[$if] = $dir.$novo_nome;
                    $vetMinis[$if] = $dir."mini_". $novo_nome;

                    // echo('<PRE>');
                    // print_r($vetMinis);
                    // echo('</PRE>');
                }else{

                    $vetFotos[$if] = "";
                    $vetMinis[$if] = "";
                }
            }
        }
        //Fim do tratamento das Fotos
        
        //Inicio do tratamento dos campos Opcionais
        $opc_s_marcados    = array();
        $opc_s_marcados[0] = "0";
        $opc_s_marcados[1] = "0";
        $opc_s_marcados[2] = "0";
        //
        for($cont = 0; $cont < count($opc_s); $cont++){
            if(isset($_POST["f_opc".($cont+1)])){
                $opc_s_marcados[$cont] = "1";
            }                        
        }        
        //Fim do tratamento do campos Opcionais
        
        $id_marca         = $_POST["select_marcas"];
        $id_modelo        = $_POST["select_modelos"];
        $id_modelo_versao = $_POST["select_modelo_versao"];
        $versao           = $_POST["f_versao"];
        $ano_fab          = $_POST["f_anofab"];
        $ano_mod          = $_POST["f_anomod"];
        $obs              = $_POST["f_obs"];
        $valor            = $_POST["f_valor"];
        $foto01           = $vetFotos[0];
        $foto02           = $vetFotos[1];
        $mini01           = $vetMinis[0];
        $mini02           = $vetMinis[1];
        $vendido          = 0;
        $bloqueado        = 0;

        $sql = "INSERT INTO tb_carros(id_marca, id_modelo, id_modelo_versao, versao, ano_fab, ano_mod, obs, valor, foto1, foto2, min3, min4, opc1, opc2, opc3, vendido, bloqueado)
        VALUES ('$id_marca', '$id_modelo', '$id_modelo_versao', '$versao', '$ano_fab', '$ano_mod', '$obs', '$valor', '$foto01', '$foto02', '$mini01', '$mini02', '$opc_s_marcados[0]', '$opc_s_marcados[1]', '$opc_s_marcados[2]', '$vendido', '$bloqueado')";
        
        include("mensagem_acao.php");
    }
?>