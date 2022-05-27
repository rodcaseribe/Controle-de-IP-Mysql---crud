<?php
    require_once 'instanciaConexao.php';
	class Funcionalidades extends DB{
        protected $tabelaIPDescricao = 'controle';
        private $nome;
        private $email;
        private $adm;

        public function setID($ID){
            $this->ID = $ID;
        }
        public function getID(){
            return $this->ID;
        }

        public function setIP($IP){
            $this->IP = $IP;
        }
        public function getIP(){
            return $this->IP;
        }

        public function setDescricao($descricao){
            $this->descricao = $descricao;
        }
        public function getDescricao(){
            return $this->descricao;
        }

        public function setSetor($setor){
            $this->setor = $setor;
        }
        public function getSetor(){
            return $this->setor;
        }

        public function criarRegistro(){
            $sql  = "INSERT INTO $this->tabelaIPDescricao (ip, descricao, setor) VALUES (:ip, :descricao, :setor )";
            $stmt = DB::prepare($sql);
            $stmt->bindParam(':ip', $this->IP, PDO::PARAM_STR);
            $stmt->bindParam(':descricao', $this->descricao, PDO::PARAM_STR);
            $stmt->bindParam(':setor',$this->setor, PDO::PARAM_STR);
            $stmt->execute();
            $checandoEmail = $stmt->rowCount();
            if($checandoEmail > 0){
                return $stmt->fetch();
            }
            else{
                return NULL;
            }
        }


        public function visualizarRegistros(){
            $sql  = "SELECT id,ip, descricao, setor FROM  $this->tabelaIPDescricao ORDER BY ip ASC";
            $stmt = DB::prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        }


        public function checaRegistro(){
            $sql  = "SELECT :ip FROM  $this->tabelaIPDescricao WHERE ip=:ip";
            $stmt = DB::prepare($sql);
            $stmt->bindParam(':ip', $this->IP, PDO::PARAM_STR);
            $stmt->execute();
            $checandoEmail = $stmt->rowCount();
            if($checandoEmail > 0){
                return $stmt->fetch();
            }
            else{
                return NULL;
            }
        }


        public function alteroRegistro(){
            $sql  = "UPDATE $this->tabelaIPDescricao SET ip=:ip,descricao=:descricao,setor=:setor WHERE id=:id";
            $stmt = DB::prepare($sql);
            $stmt->bindParam(':id', $this->ID, PDO::PARAM_STR);
            $stmt->bindParam(':ip', $this->IP, PDO::PARAM_STR);
            $stmt->bindParam(':descricao', $this->descricao, PDO::PARAM_STR);
            $stmt->bindParam(':setor',$this->setor, PDO::PARAM_STR);
            $stmt->execute();
            $checandoEmail = $stmt->rowCount();
            if($checandoEmail > 0){
                return $stmt->fetch();
            }
            else{
                return NULL;
            }
        }

        //remocaoRegistro
        //DELETE FROM Customers WHERE CustomerName='Alfreds Futterkiste';
        public function remocaoRegistro(){
            $sql  = "DELETE FROM $this->tabelaIPDescricao WHERE id=:id";
            $stmt = DB::prepare($sql);
            $stmt->bindParam(':id', $this->ID, PDO::PARAM_STR);
            $stmt->execute();
            $checandoEmail = $stmt->rowCount();
            if($checandoEmail > 0){
                return $stmt->fetch();
            }
            else{
                return NULL;
            }
        }


    }
?>