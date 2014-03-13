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
                $sqlCommand = "INSERT INTO Imagem(caminhoImagem,link,idTipoImagem";
                if($object->idPostagem==0)
				    $sqlCommand = $sqlCommand.") VALUES('$object->caminhoImagem','$object->link',$object->idTipoImagem)";
                else
                    $sqlCommand = $sqlCommand.",idPostagem) VALUES('$object->caminhoImagem','$object->link',$object->idTipoImagem,$object->idPostagem)";
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
		public function readAll($idPostagem){
			//read principal, entenda como o select usado para carregar as imagens dos posts da pagina de postagem

            //criar comando sql
            $sqlCommand = "SELECT id,caminhoImagem FROM Imagem WHERE idTipoImagem=1 AND idPostagem=$idPostagem";
            //abrir conexão
            $mysqli = Connection::Open();
			mysqli_set_charset($mysqli, 'utf8');
            //executar comando
            $result = $mysqli->query($sqlCommand);
            //guardar valores
            $imagens = array();
			if (is_object($result)){
            while($row=$result->fetch_assoc()){
            	$obj = new Imagem();
                $obj->id = $row['id'];
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
		public function readById($idPostagem){
			//read principal, entenda como o select usado para carregar as imagens dos posts da pagina index

            //criar comando sql
            $sqlCommand = "SELECT caminhoImagem FROM Imagem WHERE idTipoImagem=1 AND idPostagem=$idPostagem LIMIT 3";
            //abrir conexão
            $mysqli = Connection::Open();
			mysqli_set_charset($mysqli, 'utf8');
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
        public function update($object){
            //adicionar barras invertidas
            $object->caminhoImagem = str_replace("\\", "\\\\", $object->caminhoImagem);
            //criar comando
            $sqlCommand = "UPDATE imagem SET caminhoImagem = '$object->caminhoImagem', link = '$object->link' 
                    WHERE id = $object->id";
            //abrir conexao
            $mysqli = Connection::Open();
            //executar comando
            $resultado = $mysqli->query($sqlCommand);
            //fechar conexao
            $mysqli->close();
            //retornar resultado
            return $resultado;
        }
        
        public function delete($id){
            //criar comando
            $sqlCommand = "DELETE FROM imagem WHERE id = $id";
            //criar conexao
            $mysqli = Connection::Open();
            //executar
            $resultado = $mysqli->query($sqlCommand);
            //fechar conexao
            $mysqli->close();
            //retornar resultado
            return $resultado;
        }

        public function readLink($idImagem){
            $img = new Imagem();
            //criar comando
            $sqlCommand = "SELECT caminhoImagem,link FROM Imagem WHERE id = $idImagem";
            //criar conexao
            $mysqli = Connection::Open();
            mysqli_set_charset($mysqli, 'utf8');
            //executar comando
            $resultado = $mysqli->query($sqlCommand);
            //fechar conexao
            $mysqli->close();
            //criar objeto
            $row = $resultado->fetch_assoc();
            $img->id = $idImagem;
            $img->caminhoImagem = $row['caminhoImagem'];
            $img->link = $row['link'];
            //retornar objeto
            return $img;
        }
}
?>