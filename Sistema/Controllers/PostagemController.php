<?php 
require_once("..\Application\Controller.php");
require_once("..\Models\PostagemModel.php");
require_once("..\Controllers\ImagemController.php");
require_once("..\Controllers\TagController.php");
require_once("..\Controllers\PostagemTagController.php");
require_once("..\Objects\Postagem.php");

use Application\Controller;
use Object\Postagem;
class PostagemController extends Controller{
	public function create(){
		try{
			//verificar valores do formulário

			//criar objeto da postagem
			$postagemObj = new Postagem();

			//passar valores do formulário para o objeto
			//titulo
			$postagemObj->titulo = $_POST['txtTitulo'];
			//texto
			$postagemObj->texto = $_POST['txtDescricao'];
			//dataCriacao
			$tz_object = new DateTimeZone('America/Sao_Paulo');
			$datetime = new DateTime();
			$datetime->setTimezone($tz_object);     
			$postagemObj->dataCriacao =  $datetime->format('Y\-m\-d\ H:i:s');
			//isAtivo
			$postagemObj->isAtivo = 1;
			//idTipoPostagem
			$postagemObj->idTipoPostagem = $_POST['tipoPostagem'];

			//gravar Postagem no banco
			$postagemModel = new PostagemModel();
			$idNovaPostagem = $postagemModel->create($postagemObj);
			
			//verificar se $_FILES está vazio
			if(!empty($_FILES)){
				$flag = false;
				//se tiver algum arquivo de imagem, chamar o Controller
				foreach ($_FILES as $file){
					if ($file['type']=="image/gif" || $file['type']=="image/jpeg" || $file['type']=="image/png"){
						$flag = true;
						break;		
					}
				}
				if ($flag){
					//chama Controller, passando idNovaPostagem
					$imagemController = new ImagemController();
					$imagemController->create($idNovaPostagem);
				}
			}

			//verificar se foram enviadas tags
			if (isset($_POST['tag_1'])){
				//criar objeto TagController
				$tagController = new TagController();
				//array com os ids das tags geradas
				$tagCollection = $tagController->create();
				

				//criar objeto PostagemTagController
				$postTagController = new PostagemTagController();
				//fazer procedimento para vincular tags para a postagem
				$postTagController->create($idNovaPostagem,$tagCollection);

			}

		}
		catch(Exception $ex){
			throw new Exception("Erro ao criar postagem na fase do Controller. ".$ex->getMessage());
		}
	}

	public function loadIndexPosts(){
		//selecionar 2 ultimos posts
		$postModel = new PostagemModel();
		$imagemController = new ImagemController();
		$tagController = new TagController();
		$postagens = array("postagens" => $postModel->read());
		foreach ($postagens as $postagem){
			//selecionar imagens desses dois ultimos posts
			$postagem->imagens = $imagemController->read($postagem->id);
			//selecionar tags desses dois ultimos posts
			$postagem->tags = $tagController->read($postagem->id);
			//montar array				
		}
		//retorna-lo
                return $this->JSONResult($postagens);
	}
}
?>