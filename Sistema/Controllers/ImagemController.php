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
					$imageObj->caminhoImagem = $caminhoCompleto."\\".$file['name'];
					//link
					$imageObj->link = "";
					//idTipoImagem
					$imageObj->idTipoImagem = 1;
					//idPostagem
					$imageObj->idPostagem = $idPostagem;

					//gravar no banco
					$imagemModel->create($imageObj);

					//mover arquivo pra pasta
					move_uploaded_file($file['tmp_name'], $caminhoCompleto."\\".$file['name']);
				}
			}
		}
		catch(Exception $ex){
			throw new Exception("Erro ao criar imagem. Fase Controller".$ex->getMessage());
		}
	}
}
?>