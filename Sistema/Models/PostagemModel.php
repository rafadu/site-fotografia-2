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
        public function read(){
        	//criar comando para o select principal (OBS:entenda aqui como Select dos posts para o Index)
        	$sqlCommand ="SELECT id,titulo,texto FROM Postagem WHERE isAtivo=1 ORDER BY id DESC LIMIT 2";
        	//abrir conexão
        	$mysqli = Connection::Open();
        	//realizar o comando
        	$resultado = $mysqli->query($sqlCommand);
        	//guardar resultados
        	$postagens = array();
        	while($row=$resultado->fetch_assoc()){
        		$obj = new Postagem();
        		$obj->id = $row['id'];
        		$obj->titulo = $row['titulo'];
        		$obj->texto = $row['texto'];
        		$postagens[] = $obj;
        	}
        	//fechar conexão
        	$result->close();
        	$mysqli->close();
        	//retornar resultados
        	return $postagens;
        }
        public function update($object){}
        public function delete($key,$value,$isText){}
}
?>