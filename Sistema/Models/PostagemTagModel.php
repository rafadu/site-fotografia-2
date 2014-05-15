<?php 
require_once("../Application/Connection.php");
require_once("../Objects/PostagemTag.php");

use Application\Connection;
use Object\PostagemTag;
class PostagemTagModel{
	public function create($object){
		try{
			//criar comando sql
			$sqlCommand = "INSERT INTO PostagemTag(idPostagem,idTag) 
				VALUES ($object->idPostagem,$object->idTag)";
			//abrir conexão
			$mysqli = Connection::Open();
			//executar comando
			$mysqli->query($sqlCommand);
			//fechar conexão
			$mysqli->close();
			//retornar true
			return true;
		}
		catch(Exception $ex){
			throw new Exception("Erro ao criar relação entre postagem e tag. ".$ex->getMessage());
		}
	}

	public function delete($idPostagem,$idTag){
		try{
			//comando sql
			$sqlCommand = "DELETE FROM PostagemTag WHERE idPostagem = $idPostagem AND idTag = $idTag";
			//abrir conexao
			$mysqli = Connection::Open();
			//executar
			$resultado = $mysqli->query($sqlCommand);
			//fechar
			$mysqli->close();
			//retornar resultado
			return $resultado;
		}
		catch(Exception $ex){
			throw new Exception("Erro ao apagar relação entre postagem e tag", $ex->getMessage());
		}
	}

	public function selectByIdTag($idTag){
		try{
			//comando sql.
			$sqlCommand = "SELECT idPostagem FROM PostagemTag WHERE idTag=$idTag";
			//abrir conexao
			$mysqli = Connection::Open();
			//executar comando
			$resultado = $mysqli->query($sqlCommand);
			//fechar conexao
			$mysqli->close();
			//retornar resultado
			return $resultado;
		}
		catch(Exception $ex){
			throw new Exception("Erro ao buscar relação pela Tag", $ex->getMessage());
			
		}
	}
}
?>