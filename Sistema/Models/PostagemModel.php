<?php 

require_once("..\Application\Connection.php");
require_once("..\Application\ICrud.php");
require_once("..\Objects\Postagem.php");

use Application\ICrud;
use Application\Connection;
use Object\Postagem;
class PostagemModel implements ICrud{
		public function create($object){
			try{
				//	criar comando sql para inserir
				$sqlCommand = "INSERT INTO Postagem(titulo,texto,dataCriacao,isAtivo,idTipoPostagem) VALUES(
					'$object->titulo','$object->texto','$object->dataCriacao',$object->isAtivo,$object->idTipoPostagem)";
				//	abrir a conexão com o banco
				$mysqli = Connection::Open();
				//	realizar o comando sql
				$mysqli->query($sqlCommand);
				//	pegar id da postagem criada
				$id = $mysqli->insert_id;
				//	fechar conexão com banco
				$mysqli->close();
				//	retornar id
				return $id;
			}
			catch(Exception $ex){
				throw new Exception("Erro ao inserir postagem no banco. Mensagem: ".$ex->getMessage());
			}
			
		}
        public function read(){}
        public function update($object){}
        public function delete($key,$value,$isText){}
}
?>