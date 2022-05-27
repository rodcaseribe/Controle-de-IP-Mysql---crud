$.getScript("View/environments.js", function() {

});


function alterarView(value){
    //document.getElementById("idNumeroIP-"+value).disabled=false;
    document.getElementById("idNumeroDescricao-"+value).disabled=false;
    document.getElementById("selectPadrao-"+value).disabled=false;
    document.getElementById("confirmaAlteracao-"+value).style.display = "inline";
    document.getElementById("botaoAlterar-"+value).style.display = "none";
}


function confirmaAlteracao(value){
    IP = document.getElementById("idNumeroIP-"+value).value;
    campoDescricaoAlteracao = document.getElementById("idNumeroDescricao-"+value).value;
    campoSetorAlteracao = document.getElementById("selectPadrao-"+value).value;
    if (confirm("Confirma Alteração de Dados?") == true) {
            $.ajax({
                url: "Controller/controllerRequest.php",
                type: "POST",            
                data: {
                    valorID: value,
                    IPAlteracao: IP,
                    DescricaoAlteracao: campoDescricaoAlteracao,
                    SetorAlteracao:  campoSetorAlteracao
                },
                success: function(retorno){
                    retorno = JSON.parse(JSON.stringify(retorno));
                    if(retorno["erro"]){
                        alert("Conflito de IP - IP já cadastrado");
                        window.location.replace(globalEnvFront);
                    }
                    else{
                        alert("Alteração realizada");
                        window.location.replace(globalEnvFront);
                    }
                },
                error: function(){
                    console.log("Ocorreu um erro durante a solicitação");
                }
            });
    }


}

function confirmaRemocao(value){
    if (confirm("Confirma Remoção de Dados?") == true) {
            $.ajax({
                url: "Controller/controllerRequest.php",
                type: "POST",            
                data: {
                    valorIDRemocao: value,
                },
                success: function(retorno){
                    retorno = JSON.parse(JSON.stringify(retorno));
                    if(retorno["erro"]){
                        alert("Erro ao remover Elemento!");
                        window.location.replace(globalEnvFront);
                    }
                    else{
                        alert("Remoção realizada com Sucesso");
                        window.location.replace(globalEnvFront);
                    }
                },
                error: function(){
                    console.log("Ocorreu um erro durante a solicitação");
                }
            });
        
    }
}




$(function(){
    $("button#InserirDados").on("click", function(e){
        e.preventDefault();
        let campoInsercao = $("form#formularioInsercao #ipInsercao").val();
        let campoDescricao = $("form#formularioInsercao #descricaoInsercao").val();
        let campoSetorInsercao = $("form#formularioInsercao .valorSetorInsercao").val();

        if(campoInsercao.trim() == "" || campoDescricao.trim() == "" || campoSetorInsercao.trim() == "Setor"){
            alert("Preencha todos os dados");
        }
        else{
            if (confirm("Confirma Inserção de Dados?") == true) {
                    $.ajax({
                        url: "Controller/controllerRequest.php",
                        type: "POST",
                        data: {
                            IP: campoInsercao,
                            Descricao: campoDescricao,
                            Setor:  campoSetorInsercao
                        },
                        success: function(retorno){
                            retorno = JSON.parse(JSON.stringify(retorno));
                            if(retorno["erro"]){
                                alert("Ja há um registro desse IP");
                                window.location.replace(globalEnvFront);
                            }
                            else{
                                console.log("Registro já Criado");
                                window.location.replace(globalEnvFront);
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown){
                            console.log("Ocorreu um erro durante a solicitação");
                        }
                    });
        }
        else{
            alert('dado nao inserido');
        }
        }
    })
})
