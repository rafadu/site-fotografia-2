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
        	$sqlCommand ="SELECT id,titulo,texto FROM Postagem WHERE isAtivo=1 ";

            if (isset($_POST["painel"]))
                $sqlCommand = $sqlCommand . "ORDER BY id DESC LIMIT 5";
            else
                $sqlCommand = $sqlCommand . "ORDER BY id DESC LIMIT 2";
        	//abrir conexão
        	$mysqli = Connection::Open();
			mysqli_set_charset($mysqli, 'utf8');
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
				mysqli_set_charset($mysqli, 'utf8');
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
                $sqlCommand = "SELECT id,titulo,texto,idTipoPostagem,isAtivo FROM Postagem WHERE id = $idPostagem";
                //abrir conexao
                $mysqli = Connection::Open();
				mysqli_set_charset($mysqli, 'utf8');
                //executar comando
                $resultado = $mysqli->query($sqlCommand);
                //guardar resultados
                $row = $resultado->fetch_assoc();
                $obj = new Postagem();
                $obj->id = $row['id'];
                $obj->titulo = $row['titulo'];
                $obj->texto = $row['texto'];
                $obj->idTipoPostagem = $row['idTipoPostagem'];
                $obj->isAtivo = $row['isAtivo'];
                 //fechar conexao
                $resultado->close();
                $mysqli->close();
                //retornar valores
                return $obj;
        }

        public function search($tag,$isAtivo){
            //criar comando sql
            $sqlCommand = "SELECT P.id,P.titulo, P.dataCriacao FROM Postagem P ";
            if ($tag!="")
                $sqlCommand = $sqlCommand."INNER JOIN PostagemTag PT ON P.id= PT.idPostagem WHERE (PT.idTag IN (SELECT id FROM Tag WHERE tag LIKE '%$tag%')
                            OR P.titulo LIKE '%$tag%') AND P.isAtivo = $isAtivo GROUP BY P.id";
            else
                $sqlCommand = $sqlCommand."WHERE P.isAtivo = $isAtivo";

            //abrir conexao
            $mysqli = Connection::Open();
			mysqli_set_charset($mysqli, 'utf8');
            //executar operação
            $resultado = $mysqli->query($sqlCommand);
            $postagens = array();
            //guardar valores
            while($row=$resultado->fetch_assoc()){
                $obj = new Postagem();
                $obj->id = $row['id'];
                $obj->titulo = $row['titulo'];
                $obj->dataCriacao = $row['dataCriacao'];
                $postagens[]=$obj;
            }
            //fechar conxexão
            $resultado->close();
            $mysqli->close();
            //retornar valores
            return $postagens;
        }
        public function update($object){
            //as informações já foram carregadas, basta configurar o update
            $sqlCommand = "UPDATE Postagem SET titulo='$object->titulo', texto='$object->texto',idTipoPostagem=$object->idTipoPostagem, isAtivo=$object->isAtivo WHERE id=$object->id";
            //abrir conexao
            $mysqli = Connection::Open();
            //executar update
            $resultado = $mysqli->query($sqlCommand);
            //fechar conexao
            $mysqli->close();
            //retornar resultado do update
            return $resultado;
        }
        public function delete($id){}
}
?>