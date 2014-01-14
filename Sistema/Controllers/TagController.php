<?php 
require_once("..\Application\Controller.php");
require_once("..\Models\TagModel.php");
require_once("..\Objects\Tag.php");

use Application\Controller;
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
				if (strpos($field,"tag") !== false){
					if (trim($value)!==''){
						$idFromDatabase = $tagModel->readByTag($value);
						if($idFromDatabase == 0){
							//criar objeto tag
							$tagObj = new Tag();
							//passar valor
							$tagObj->tag = $value;
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
}
?>