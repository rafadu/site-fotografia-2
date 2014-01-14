<?php 
require_once("..\Application\Connection.php");
require_once("..\Application\ICrud.php");
require_once("..\Objects\Tag.php");


use Application\ICrud;
use Application\Connection;
use Object\Tag;
class TagModel implements ICrud{
		public function create($object){
			try{
				//criar comando sql
				$sqlCommand = "INSERT INTO Tag(tag) VALUES ('$object->tag')";
				//abrir conexão com o banco
				$mysqli = Connection::Open();
				//realizar o comando sql
				$mysqli->query($sqlCommand);
				//pegar id da Tag inserida
				$id = $mysqli->insert_id;
				//fechar conexão
				$mysqli->close();
				//retornar id
				return $id;
			}
			catch(Exception $ex){
				throw new Exception("Erro ao inserir nova Tag no banco. ".$ex->getMessage());
			}
		}
		public function read(){}
        public function update($object){}
        public function delete($key,$value,$isText){}

        public function readByTag($tag){
        	try{
        		$id = 0;
        		//criar comando SQL
        		$sqlCommand="SELECT id FROM Tag WHERE tag LIKE '$tag'";
        		//abrir conexao com banco
        		$mysqli = Connection::Open();
        		//fazer a busca
        		$result = $mysqli->query($sqlCommand);
        		while($row = $result->fetch_assoc()){
        			//guardar valor buscado
        			$id = $row['id'];
        		}
        		//fechar conexão e result
        		$result->close();
        		$mysqli->close();
        		//retornar resultado
        		return $id;
        	}
        	catch(Exception $ex){
        		throw new Exception("Erro ao buscar tags por tag. Fase Model ".getMessage());
        	}
        }
}
?>