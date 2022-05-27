<?php 
    function validaSetor($nomeSetor){   
        require('../View/envinronments.php');
        if (in_array($nomeSetor, $setores)) { 
           return $nomeSetor;
        }else{
            return null;
        }
    }

    function validaIP($IP){
        $rangeIPCIDR = ['192', '168', '0', '1','2','3'];
        if(substr($IP,0,3)==$rangeIPCIDR[0] && substr($IP,4,3)==$rangeIPCIDR[1]){
            $IPValido =  substr($IP,0,3).".".substr($IP,4,3);
            for($subRede1=0;$subRede1<=3;$subRede1++){
                if(substr($IP,8,1)==$subRede1){
                    $IPValido = $IPValido.".".substr($IP,8,1);
                    for($subRede2=1;$subRede2<=254;$subRede2++){
                        if(substr($IP,10)==$subRede2){
                            $IPValido = $IPValido.".".substr($IP,10);
                            return $IPValido;
                        }
                    }
                }
            }
        }
        else{
            return null;
        }
    }

    function visualizaoInicial(){
        require('./Model/InstanciaConexao.php');
        require('./Model/querysRequest.php');
        $conexao = new DB();
        $conexao->getInstance();
        $checkQuery = new Funcionalidades();
        return $checkQuery->visualizarRegistros();
    }


    if(isset($_POST["IP"]) && isset($_POST["Descricao"]) && isset($_POST["Setor"])){
        require('../Model/InstanciaConexao.php');
        require('../Model/querysRequest.php');
        $conexao = new DB();
        $conexao->getInstance();
        $checkQuery = new Funcionalidades();
        $checkQuery->setIP(validaIP($_POST["IP"]));
        $checkQuery->setDescricao($_POST["Descricao"]);
        if(validaSetor($_POST["Setor"])!=null && validaIP($_POST["IP"])!=null ){
            $checkQuery->setSetor(validaSetor($_POST["Setor"]));
            if($checkQuery->checaRegistro()==NULL ){
                $checkQuery->criarRegistro();
                echo json_encode(array("erro" => 0, "mensagem" => "registro criado com sucesso"));
            }
            else {
                echo json_encode(array("erro" => 1, "mensagem" => "erro ao criar registro"));
            }
        }
        else{
            echo json_encode(array("erro" => 1, "mensagem" => "Erro de inserção de setores ou IP"));
        }
       
            
    }
    
    if(isset($_POST["valorID"]) && isset($_POST["IPAlteracao"]) && isset($_POST["DescricaoAlteracao"]) && isset($_POST["SetorAlteracao"])){
        require('../Model/InstanciaConexao.php');
        require('../Model/querysRequest.php');
        $conexao = new DB();
        $conexao->getInstance();
        $checkQuery = new Funcionalidades();
        $checkQuery->setID($_POST["valorID"]);
        $checkQuery->setIP(validaIP($_POST["IPAlteracao"]));
        $checkQuery->setDescricao($_POST["DescricaoAlteracao"]);
        if(validaSetor($_POST["SetorAlteracao"])!=null && validaIP($_POST["IPAlteracao"])!=null){
            $checkQuery->setSetor($_POST["SetorAlteracao"]);
            if($checkQuery->alteroRegistro()==NULL){
                echo json_encode(array("erro" => 1, "mensagem" => "Registro alterado"));
            }
            else{
                echo json_encode(array("erro" => 0, "mensagem" => "Conflito de IP - IP existente"));
            }
        }
        else{
            echo json_encode(array("erro" => 1, "mensagem" => "Erro de alteração de setores ou IP"));
        }
    }

    if(isset($_POST["valorIDRemocao"])){
        require('../Model/InstanciaConexao.php');
        require('../Model/querysRequest.php');
        $conexao = new DB();
        $conexao->getInstance();
        $checkQuery = new Funcionalidades();
        $checkQuery->setID($_POST["valorIDRemocao"]);
        if($checkQuery->remocaoRegistro()==NULL){
            echo json_encode(array("erro" => 0, "mensagem" => "Registro removido"));
        }
        else{
            echo json_encode(array("erro" => 1, "mensagem" => "registro nao removido"));
        }
    }


    if(isset($_POST["visualGlobal"])){
        require('../Model/InstanciaConexao.php');
        require('../Model/querysRequest.php');
        $conexao = new DB();
        $conexao->getInstance();
        $checkQuery = new Funcionalidades();
        echo json_encode(array("registros" => $checkQuery->visualizarRegistros()));
    }

?>