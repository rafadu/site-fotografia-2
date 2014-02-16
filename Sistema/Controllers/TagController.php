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
}
?>