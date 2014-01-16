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
        public function update($object){}
        public function delete($key,$value,$isText){}
}
?>