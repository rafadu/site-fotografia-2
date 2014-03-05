<?php 
require_once("..\Application\Controller.php");
require_once("..\Models\ImagemModel.php");
require_once("..\Objects\Imagem.php");

use Application\Controller;
use Object\Imagem; 
class ImagemController extends Controller{
	public function create($idPostagem){
		try{
			$caminhoUpload = "..\Uploads\\";
			//guardar caminho ate a pasta criada
			$caminhoCompleto=$caminhoUpload."$idPostagem";
			//checar na pasta Uploads se existe pasta com o id
			if(!is_dir($caminhoCompleto))
				//se nao existir, criar a pasta
				\mkdir($caminhoCompleto);

			//pra cada imagem, chamar Model, passando o caminhoCompleto  o nome do arquivo
			//apos o registro, mover a imagem para a pasta
			$imagemModel =  new ImagemModel();
			foreach($_FILES as $file){
				if ($file['type']=="image/gif" || $file['type']=="image/jpeg" || $file['type']=="image/png"){
					//criar object imagem
					$imageObj = new Imagem();
					//passar valores
					//caminhoImagem
					$imageObj->caminhoImagem = $caminhoCompleto."\\".$this->noSpecial(($file['name']));
					//link
					$imageObj->link = "";
					//idTipoImagem
					$imageObj->idTipoImagem = 1;
					//idPostagem
					$imageObj->idPostagem = $idPostagem;

					//gravar no banco
					$imagemModel->create($imageObj);

					//mover arquivo pra pasta
					move_uploaded_file($file['tmp_name'], $caminhoCompleto."\\".$this->noSpecial($file['name']));
				}
			}
		}
		catch(Exception $ex){
			throw new Exception("Erro ao criar imagem. Fase Controller".$ex->getMessage());
		}
	}

	public function readAll($idPostagem){
		try{
			//chamar model
			$obj = new ImagemModel();
			return $obj->readAll($idPostagem);
		}
		catch(Exception $ex){
			throw new Exception("Erro ao selecionar imagens. Fase Controller".$ex->getMessage());
		}
	}
	public function read($idPostagem){
		try{
			//chamar model
			$obj = new ImagemModel();
			return $obj->readById($idPostagem);
		}
		catch(Exception $ex){
			throw new Exception("Erro ao selecionar imagens. Fase Controller".$ex->getMessage());
		}
	}

	public function update($idPostagem){
		$imgModel = new ImagemModel();
		//checar os checkbox de imagens
		foreach($_POST as $field=>$value){
			//se vier dentro de $_POST algum checkbox é porque ele já está selecionado
			if (strpos($field,"idimagem_") !== false){
				//chamar model para remover caminho do banco de acordo com o valor do checkbox
				$sub = substr($field, strrpos($field,"_")+1);
                                $imgModel->delete((int)$sub);
				//apagar arquivo da pasta de uploads
				unlink($value);
			}

		}

		$caminhoUpload = "..\Uploads\\";
		//guardar caminho ate a pasta criada
		$caminhoCompleto=$caminhoUpload."$idPostagem";

		//verificar imagens novas
		foreach($_FILES as $file){
			if ($file['type']=="image/gif" || $file['type']=="image/jpeg" || $file['type']=="image/png"){
				//criar object imagem
				$imageObj = new Imagem();
				//passar valores
				//caminhoImagem
				$imageObj->caminhoImagem = $caminhoCompleto."\\".$this->noSpecial(($file['name']));
				//link
				$imageObj->link = "";
				//idTipoImagem
				$imageObj->idTipoImagem = 1;
				//idPostagem
				$imageObj->idPostagem = $idPostagem;
	
				//gravar no banco
				$imgModel->create($imageObj);

				//mover arquivo pra pasta
				move_uploaded_file($file['tmp_name'], $caminhoCompleto."\\".$this->noSpecial($file['name']));
			}
		}
	}

	
		public function createLink(){
		try{
			$caminhoUpload = "..\Uploads\\";
			//guardar caminho ate a pasta criada
			$caminhoCompleto=$caminhoUpload."Feeds";
			//checar na pasta Uploads se existe pasta com o id
			if(!is_dir($caminhoCompleto))
				//se nao existir, criar a pasta
				\mkdir($caminhoCompleto);

			//pra cada imagem, chamar Model, passando o caminhoCompleto  o nome do arquivo
			//apos o registro, mover a imagem para a pasta
			$imagemModel =  new ImagemModel();
			foreach($_FILES as $file){
				if ($file['type']=="image/gif" || $file['type']=="image/jpeg" || $file['type']=="image/png"){
					//criar object imagem
					$imageObj = new Imagem();
					//passar valores
					//caminhoImagem
					$imageObj->caminhoImagem = $caminhoCompleto."\\".$this->noSpecial(($file['name']));
					//link
					$imageObj->link =$_POST["txtLink"];
					//idTipoImagem
					$imageObj->idTipoImagem = 1;
					//idPostagem
					$imageObj->idPostagem = 0;

					//gravar no banco
					$imagemModel->create($imageObj);

					//mover arquivo pra pasta
					move_uploaded_file($file['tmp_name'], $caminhoCompleto."\\".$this->noSpecial($file['name']));
				}
			}
			$this->redirect("..\Views\painel.html");
		}
		catch(Exception $ex){
			throw new Exception("Erro ao criar imagem. Fase Controller".$ex->getMessage());
		}
	}

	
	
}

?>