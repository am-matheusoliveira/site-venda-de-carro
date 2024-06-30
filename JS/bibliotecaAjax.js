
    // REALIZANDO A REQUEST HTTP
    function requisicaoHTTP(tipo, url, assinc, dados_request, tipo_tratamento, objeto_html){
        
        // INICIANDO UM NOVO OBJETOS XMLHttpRequest()
        ajax_request = new XMLHttpRequest();

        // EXECUTANDO A REQUEST HTTP
        ajax_request.open(tipo, url, assinc);
        ajax_request.onreadystatechange = function(){
            if(ajax_request.readyState === 4){
                if(ajax_request.status === 200){
                    trataDados(tipo_tratamento, objeto_html)
                }else{
                    alert("Problema na comunicação com o objeto XMLHttpRequest.");
                }
            }
        };
        ajax_request.setRequestHeader("Content-type", "application/x-www-form-urlencoded; charset=UTF-8");
        ajax_request.send(dados_request);
    }

    // REMOVENDO AS OPTIONS DE UM SELECT
    function clean_select(select){

        // VARIAVEIS PARA AUXILIO DA FUNÇÃO
        var cont, cont_options;
        cont_options = (select.options.length - 1);
        
        // ELE COMEÇA EM 1, ISSO E PARA NÃO EXCLUIR A 1º OPÇÃO DO COMBOBOX
        for(cont = cont_options; cont >= 1; cont--){
            select.remove(cont);
        }        
    }    

    // TRATANDO OS DADOS VINDO DE NOSSA REQUEST
    function trataDados(tipo_tratamento, objeto_html = null){
        
        // VARIAVEL RECEBENDO O RESPONSE DA REQUEST E CONVERTENDO PARA JSON        
        var resposta = JSON.parse(ajax_request.responseText);
                
        // VERIFICANDO SE O RETORNO DA REQUEST E MAIOR QUE ZERO            
        if(Object.keys(resposta).length === 0){
            return false;
        }

        if(tipo_tratamento === "ATUALIZA-SELECT"){

            // IMPRIMINDO OS VALORES DA RESPONSE
            resposta.forEach(function(value, key, array){

                // CRIANDO NOVO OPTION
                var option = document.createElement('option');
                
                // CONFIGURANDO OS ATRIBUTOS DO OPTION
                option.value = value.campo_key;
                option.innerHTML = value.campo_value;

                // INSERINDO O OPTION NO SELECT MARCAS
                objeto_html.appendChild(option);
            });
            objeto_html.options[0].selected = true;
        }

        if(tipo_tratamento === "LISTA-CARROS"){

            objeto_html.innerHTML = `<h3>Versões do Modelo: ${resposta[0].modelo}</h3>`
            //
            resposta.forEach(function(value, key, array){
                objeto_html.innerHTML += `
                    <div class="classe_carros">
                       <article class="article_carro">
                          <div id="d1"><a href="detalhes_modelo.php?id_carro=${value.id_carro}"><img src="${value.min3}"></a></div>
                          <div id="d2">
                             <div id="titulo">
                                <div id="t1">
                                   <a href="detalhes_modelo.php?id_carro=${value.id_carro}">
                                      <p>${value.marca}</p>
                                      <p>${value.modelo}</p>
                                      <p>${value.versao}</p>
                                   </a>
                                </div>
                                <div id="t2">
                                   <p>${parseFloat(value.valor).toLocaleString('pt-BR', {style: 'currency', currency: 'BRL'})}</p>
                                </div>
                             </div>
                             <div id="dados">Ano - Fabricação: ${value.ano_fab}<br>Ano - Modelo: ${value.ano_mod}<br>Vendido: ${value.vendido}</div>
                             <div></div>
                          </div>
                       </article>
                    </div>                            
                `;
            });
        }        
    }    