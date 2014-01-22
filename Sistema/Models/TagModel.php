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
	public function read($idPostagem){
                //read principal, entenda como read para os posts da index
                //criar comando sql
                $sqlCommand="SELECT T.tag FROM Tag T INNER JOIN PostagemTag PT ON T.id = PT.idTag WHERE PT.idPostagem = $idPostagem";
                //abrir conexão
                $mysqli = Connection::Open();
                //executar comando
                $result = $mysqli->query($sqlCommand);
                //guardar valores
                $tags = array();
                while($row = $result->fetch_assoc()){
                        $obj = new Tag();
                        $obj->tag = $row['tag'];
                        $tags[] = $obj;
                }
                //fechar conexão
                $result->close();
                $mysqli->close();
                //retornar valores
                return $tags;
        }
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