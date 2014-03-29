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
			if ($_POST['txtTitulo'] <>""){
			$postagemObj->titulo = utf8_decode($_POST['txtTitulo']);
			}
			else{
			throw new Exception('Postagem sem título');
			}
			
			//texto
			if ($_POST['txtDescricao'] <>""){
			$postagemObj->texto = utf8_decode($_POST['txtDescricao']);
			}
			else{
			throw new Exception('Postagem sem descrição');
			}
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

			$this->redirect("..\Views\painel.html");
		}
		catch(Exception $ex){
			echo ("Erro ao criar postagem : ".$ex->getMessage());
		}
	}

	/*public function loadIndexPosts(){
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
	}*/


	public function loadPosts(){
		//selecionar ultimos posts, de acordo com o parametro, sera para a index, para artigos ou para eventos
		//necessario valor idTipoPostagem ser enviado
		$postModel = new PostagemModel();
		$imagemController = new ImagemController();
		$tagController = new TagController();
                $tipo = (int)$_POST['tipoPostagem'];
		if ($tipo==0)
			$postagens = $postModel->read();
		else
			$postagens = $postModel->readByTipo($tipo);
		foreach ($postagens as $postagem){
			//selecionar imagens desses dois ultimos posts
			$postagem->imagens = $imagemController->read($postagem->id);
			//selecionar tags desses dois ultimos posts
			$postagem->tags = $tagController->read($postagem->id);
			//montar array				
		}
		//retorna-lo
                return $this->JSONResult(array("postagens"=>$postagens));
	}

	public function loadPost(){
		$postModel = new PostagemModel();
		$imagemController = new ImagemController();
		$tagController = new TagController();
		
		$postagem = $postModel->readById($_POST['idPost']);
		//selecionar imagens desses dois ultimos posts
		$postagem->imagens = $imagemController->readAll($postagem->id);
		//selecionar tags desses dois ultimos posts
		$postagem->tags = $tagController->read($postagem->id);
						
		//retorna-lo
        return $this->JSONResult(array("postagem"=>$postagem));
	}

	public function search(){
		//tag vem dentro de $_POST
		$postModel = new PostagemModel();
		$postagens = array("postagens" => $postModel->search($_POST['tag'],$_POST['isAtivo']));
		return $this->JSONResult($postagens);
	}

	public function update(){
		//pegar informações da postagem, formar object e mandar atualiza-las
		$idPostagem = $_POST['idPost'];
		$post = new Postagem();
		$post->id = $idPostagem;
		
		if ($_POST['txtTitulo'] <>"")
			$post->titulo = utf8_decode($_POST['txtTitulo']);
		else
			throw new Exception('Postagem sem título');
		
		if ($_POST['txtDescricao'] <>"")
			$post->texto = utf8_decode($_POST['txtDescricao']);
		else
			throw new Exception('Postagem sem descrição');			

		//$post->isAtivo = $_POST['isAtivo'];
		$post->idTipoPostagem = $_POST['tipoPostagem'];

		//chamar update de postagem, passando object
		$postModel = new PostagemModel();
		$postModel->update($post);

		//chamar controller de imagem para realizar update de informações das imagens
		$imgController = new ImagemController();
		$imgController->update($idPostagem);

		//chamar controller de tag para realizar update de informações das tags
		$tagController = new TagController();
		$tagController->update($idPostagem);
                $this->redirect("..\Views\painel.html");
	}
}
?>