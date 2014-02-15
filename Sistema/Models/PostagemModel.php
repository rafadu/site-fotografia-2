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
        	$resultado->close();
        	$mysqli->close();
        	//retornar resultados
        	return $postagens;
        }
        public function readByTipo($idTipoPostagem){
                //criar comando sql
                $sqlCommand = "SELECT id,titulo,texto FROM Postagem WHERE isAtivo=1 AND idTipoPostagem = $idTipoPostagem ORDER BY id DESC LIMIT 4";
                //abrir conexao
                $mysqli = Connection::Open();
                //executar comando
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
                //fechar conexao
                $resultado->close();
                $mysqli->close();
                //retornar valores
                return $postagens;
        }

        public function readById($idPostagem){
                //criar comando sql
                $sqlCommand = "SELECT id,titulo,texto FROM Postagem WHERE id = $idPostagem";
                //abrir conexao
                $mysqli = Connection::Open();
                //executar comando
                $resultado = $mysqli->query($sqlCommand);
                //guardar resultados
                $row = $resultado->fetch_assoc();
                $obj = new Postagem();
                $obj->id = $row['id'];
                $obj->titulo = $row['titulo'];
                $obj->texto = $row['texto'];
                 //fechar conexao
                $resultado->close();
                $mysqli->close();
                //retornar valores
                return $obj;
        }

        public function search($tag){
            //criar comando sql
            $sqlCommand = "SELECT P.id,P.titulo FROM Postagem P ";
            if ($tag!="")
                $sqlCommand = $sqlCommand."INNER JOIN PostagemTag PT ON P.id= PT.idPostagem WHERE PT.idTag IN (SELECT id FROM Tag WHERE tag LIKE '%$tag%') GROUP BY P.id";

            //abrir conexao
            $mysqli = Connection::Open();
            //executar operação
            $resultado = $mysqli->query($sqlCommand);
            $postagens = array();
            //guardar valores
            while($row=$resultado->fetch_assoc()){
                $obj = new Postagem();
                $obj->id = $row['id'];
                $obj->titulo = $row['titulo'];
                $postagens[]=$obj;
            }
            //fechar conxexão
            $resultado->close();
            $mysqli->close();
            //retornar valores
            return $postagens;
        }
        public function update($object){}
        public function delete($key,$value,$isText){}
}
?>