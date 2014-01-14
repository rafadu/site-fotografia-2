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
}
?>