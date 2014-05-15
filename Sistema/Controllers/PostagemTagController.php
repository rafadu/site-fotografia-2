<?php 
require_once("..\Application\Controller.php");
require_once("..\Objects\PostagemTag.php");
require_once("..\Models\PostagemTagModel.php");

use Application\Controller;
use Object\PostagemTag;
class PostagemTagController extends Controller{
	public function create($idPostagem,$idsTags){
		try{
			$postTagModel = new PostagemTagModel();
			//pra cada id tag criar um objeto PostagemTag e mandar gravá-lo
			foreach($idsTags as $idTag){
				//criar objeto
				$postTagObj = new PostagemTag();
				//passar valores
				//idPostagem
				$postTagObj->idPostagem = $idPostagem;
				//idTag
				$postTagObj->idTag = $idTag;

				//chamar model e gravar
				$postTagModel->create($postTagObj);
			}
		}
		catch(Exception $ex){
			throw new Exception("Erro ao vincular postagem com tags. Fase Controller. ".$ex->getMessage());
		}
	}

	public function delete($idPostagem,$idTags){
		//chamar model para apagar relacionamento entre postagem e tag
		$postTagModel = new PostagemTagModel();
		try{
			foreach ($idTags as $idTag) {
				$postTagModel->delete($idPostagem,$idTag);
			}
		}
		catch(Exception $ex){
			throw new Exception("Erro ao desvincular tags da postagem. Fase Controller. ".$ex->getMessage());
		}
	}

	public function selectByIdTag($idTag){
		//chamar model e retornar resultado
		$postTagModel = new PostagemTagModel();
		try{
			return $postTagModel->selectByIdTag($idTag);
		}catch(Exception $ex){
			throw new Exception("Erro ao pesquisar por tag. Fase Controller. ".$ex->getMessage());
		}
	}
}
?>