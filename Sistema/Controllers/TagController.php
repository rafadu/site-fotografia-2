<?php 
require_once("..\Application\Controller.php");
require_once("..\Models\TagModel.php");
require_once("..\Objects\Tag.php");

use Application\Controller;
use Object\Tag;
class TagController extends Controller{
	public function create(){
		try{
			$tagModel = new TagModel();
			$tagsIds = array();
			//ao chegar aqui já se sabe que existem tags
			//pra cada Tag, verificar se já existe, se sim, selecionar o id e guardar no array
			//se a tag não existe, registrar no banco e guardar o id gerado em array
			foreach($_POST as $field=>$value){
				//strpos retorna posição em que ele encontra a substring
				//maiores informações: http://www.php.net/manual/pt_BR/function.strpos.php
				if (strpos($field,"tag") !== false && strpos($field,"tag")==0){
					if (trim($value)!==''){
						$idFromDatabase = $tagModel->readByTag($value);
						if($idFromDatabase == 0){
							//criar objeto tag
							$tagObj = new Tag();
							//passar valor
							$tagObj->tag = utf8_decode($value);
							//chamar metodo do model
							$tagsIds[] = $tagModel->create($tagObj);
						}
						else{
							//guardar
							$tagsIds[]=$idFromDatabase;
						}
					}	
				}
			}
			
			//retornar array
			return $tagsIds;
		}
		catch(Exception $ex){
			throw new Exception("Erro ao gravar Tag. Fase Controller".getMessage());
		}
	}

	public function read($idPostagem){
		try{
			$tagModel = new TagModel();
			return $tagModel->readById($idPostagem);
		}
		catch(Exception $ex){
			throw new Exception("Erro ao selecionar Tags para post na index. Fase Controller".getMessage());	
		}
	}

	public function update($idPostagem){
		$idTags = array();
		//verificar se foram selecionadas tag para serem removidas
		foreach($_POST as $field=>$value){
			//se vier dentro de $_POST algum checkbox é porque ele já está selecionado
			if (strpos($field,"idTag_") !== false){
				//criar array dos ids das tags
				$idTags[] = $value;
			}
		}
		//mandar remover o relacionamento entre postagem e tags
		$postTagController = new PostagemTagController();
		$postTagController->delete($idPostagem,$idTags);
		//chamar metodo delete para analisar se a tag deve ser deletada (Caso nao tenha nenhum relacionamento)
		foreach($idTags as $idTag){
			$this->delete($idTag);
		}
		
		//verificar tags novas
		$tagModel = new TagModel();
		$tagsIds = array();
		foreach($_POST as $field=>$value){
			//strpos retorna posição em que ele encontra a substring
			//maiores informações: http://www.php.net/manual/pt_BR/function.strpos.php
			if (strpos($field,"tag_") !== false && strpos($field,"tag_")==0){
				if (trim($value)!==''){
					$idFromDatabase = $tagModel->readByTag($value);
					if($idFromDatabase == 0){
						//criar objeto tag
						$tagObj = new Tag();
						//passar valor
						$tagObj->tag = utf8_decode($value);
						//chamar metodo do model
						$tagsIds[] = $tagModel->create($tagObj);
					}
					else{
						//guardar
						$tagsIds[]=$idFromDatabase;
					}
				}	
			}
		}

		//fazer procedimento para vincular tags para a postagem
		$postTagController->create($idPostagem,$tagsIds);
	}

	public function delete($idTag){
		$postTagController = new PostagemTagController();
		$tagModel = new TagModel();
		//ir no banco verificar se a tag possui algum relacionamento lá
		$resultado = $postTagController->selectByIdTag($idTag);
		//se não tiver, mandar deletar tag
		if ($resultado->num_rows==0)
			$tagModel->delete($idTag);
	}
}
?>