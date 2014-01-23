<?php 
require_once ("..\Controllers\PostagemController.php");
echo "Só pra conectar o XDebug <br>";
echo "<a href='cadastroPost.html'>Cadastro</a><br>";
echo "Chamando Postagem Controller...";
$obj = new PostagemController();
$array = $obj->loadIndexPosts();
echo $array;
?>
<script type="text/javascript" src="common/scripts/jquery-2.0.2.min.js"></script>
<script type="text/javascript" src="common/scripts/core.js"></script>