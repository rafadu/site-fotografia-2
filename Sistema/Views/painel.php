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
	</head>
	<body>
		<div id="geral">
			<header>
				<h1>Fraan Letzel Fotografia</h1>
				<nav>
					<ul>
						<li>
							<a href="cadastroPost.php?acao=1">Nova postagem</a>
						</li>

						<li>
							<a href="postagens.php?busca=&isAtivo=1">Postagens</a>
							<!-- cadastroPost.html?acao=2 -->
						</li>

						<li>
							<a href="postagens.php?busca=&isAtivo=0">Postagens Inativas</a>
						</li>

						<li>
							<a href="links.php?idTipoImagem=2">Feeds</a>
						</li>

						<li>
							<a href="links.php?idTipoImagem=3">Parceiros</a>
						</li>

						<!--<li>
							<a href="#">Feeds</a>
						</li>-->
					</ul>
				</nav>
			</header>
			<main id="main">
				<section id="topSection">
					<div id="ultimasPostagens">
						<h2>Ultimas Postagens</h2>
						<ul>
							<li>
								<a href="#">Sobre fotografia</a><br>
							</li>
							<li>
								<a href="#">A fotografia é um conjunto</a>
							</li>
							<li>
								<a href="#">Lorem Ipsum Dolor</a>
							</li>
							<li>
								<a href="#">Lorem Ipsum Dolor</a>
							</li>
							<li>
								<a href="#">Lorem Ipsum Dolor</a>
							</li>	
						</ul>
					</div>
					<!--<div id="novaPostagem">
						<h2>Nova Postagem</h2>
						<div><a href="#">Nova postagem +</a><br></div>
					</div>
					<div id="ultimosComentarios">
						<h2>Últimos Comentários</h2>
						<p>Enviado por</p> <p id="Nome">Fulano</p>
						<p id="comentario">Lorem Ipsum Dolor HU3</p>
						<div>
							<input type="button" name="btnPrevious" value="Anterior"/>
							<input type="button" name="btnNext" value="Próximo"/>
						</div>
					</div>-->
				</section>
				<section id="bottomSection">
					<div id="estatisticas">
						<h2>Estatísticas mensais</h2>
						<!--<img src="common\images\grafico.jpg">-->
					</div>
					<!--<div id="postagemRapida">
						<h2>Postagem Rápida</h2>
						<br/>
						<textarea name="post" rows="10" cols="40"></textarea>
						<img id="btnEnviar" alt="Enviar" src="common\images\seta.gif">
					</div>-->
				</section>
			</main>
			<footer>
				&copy; Exodia Corporation
				| Fraan Lezel Fotografia
				<time pubdate="pubdate">2013-18-06</time>

				<div id="login">
						<a href="login.php">Sair</a>
				</div>
			</footer>
		</div>
		<script type="text/javascript" src="common/scripts/jquery-2.0.2.min.js"></script>
		<script type="text/javascript" src="common/scripts/core.js"></script>
	</body>
</html>