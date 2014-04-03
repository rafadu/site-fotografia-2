<?php
session_start();
require_once('../Application/Auth.php');
use Application\Auth;
Auth::VerificaLogon();
?>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>Fraan Letzel Fotografia - Painel de Controle</title>
		<link rel="stylesheet" type="text/css" href="common/styles/reset.css">
		<link rel="stylesheet" type="text/css" href="common/styles/site.css">
		<link rel="stylesheet" type="text/css" href="common/styles/painel.css">
		<link rel="stylesheet" type="text/css" href="common/styles/cadastroLink.css">
	</head>
	<body>
		<div id="geral">
			<header>
				<h1>Fraan Letzel Fotografia</h1>
				<nav>
					<ul>
						<li>
							<a href="painel.php">Home</a>
						</li>
						<!--<li>
							<a href="cadastroPost.html?acao=1">Nova postagem</a>
						</li>
						<li>
							<a href="cadastroPost.html?acao=2">Editar Postagem</a>
						</li>
						<li>
							<a href="#">Postagens Inativas</a>
						</li>-->
						<li>
							<a href="#">Parceiros</a>
						</li>
						<li>
							<a href="#">Feeds</a>
						</li>
					</ul>
				</nav>
			</header>
			<main id="main">
				<form action="../Application/Dispatch.php" method="POST" enctype="multipart/form-data">
					<label for="">Imagem</label><br /><br />
					<input type="file" accept="image/*" name="imgLink" id="imgLink"/><!--<br /><br/>
					<img id="imgFeed" src=""><br /><br/>-->
					<label for="">Link</label><br /><br/>
					<input type="text" name="txtLink" id="txtLink"/><br /><br/>
					<div id="buttons">
						<input type="button" name="btnCancel" value="Cancelar"/>
						<input type="submit" name="btnSubmit" value="Enviar"/>
					</div>
					<input type="hidden" name="controller" value="Imagem">
					<input type="hidden" name="method" id="method" value="createLink">
					<input type="hidden" name="typeLink" id="typeLink" value="0">
				</form>
			</main>
		</div>
		<script type="text/javascript" src="common/scripts/jquery-2.0.2.min.js"></script>
		<script type="text/javascript" src="common/scripts/core.js"></script>
		<script type="text/javascript" src="common/scripts/cadastroLink.js"></script>
	</body>
</html>