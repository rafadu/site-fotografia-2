<?php 
require_once("..\Application\Connection.php");
require_once("..\Application\ICrud.php");
require_once("..\Objects\Imagem.php");

use Application\ICrud;
use Application\Connection;
use Object\Imagem;
class ImagemModel implements ICrud{
		public function create($object){
			try{
                                //adicionar barras invertidas
                                $object->caminhoImagem = str_replace("\\", "\\\\", $object->caminhoImagem);
				//criar comando sql
				$sqlCommand = "INSERT INTO Imagem(caminhoImagem,link,idTipoImagem,idPostagem)
						VALUES('$object->caminhoImagem','$object->link',$object->idTipoImagem,$object->idPostagem)";
				//abrir conexão com o banco
				$mysqli = Connection::Open();
				//executar comando sql
				$mysqli->query($sqlCommand);
				//fechar conexão
				$mysqli->close();
				//retornar true
				return true;
			}
			catch(Exception $ex){
				throw new Exception("Erro ao registrar imagem no banco. ".$ex->getMessage());
			}
		}
                public function read(){}
		public function readById($idPostagem){
			//read principal, entenda como o select usado para carregar as imagens dos posts da pagina index

            //criar comando sql
            $sqlCommand = "SELECT caminhoImagem FROM Imagem WHERE idTipoImagem=1 AND idPostagem=$idPostagem LIMIT 3";
            //abrir conexão
            $mysqli = Connection::Open();
            //executar comando
            $result = $mysqli->query($sqlCommand);
            //guardar valores
            $imagens = array();
			if (is_object($result)){
            while($row=$result->fetch_assoc()){
            	$obj = new Imagem();
            	$obj->caminhoImagem = $row['caminhoImagem'];
            	$imagens[] = $obj;
            }
            //fechar conexão
            $result->close();
            $mysqli->close();
            //retornar valores
			}
            return $imagens;
		}
        public function update($object){}
        public function delete($key,$value,$isText){}
}
?>