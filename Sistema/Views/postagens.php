<!DOCTYPE html>
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
							<a href="cadastroPost.html?acao=1">Nova postagem</a>
						</li>

						<li>
							<a href="postagens.php?busca=">Postagens</a>
							<!-- cadastroPost.html?acao=2 -->
						</li>

						<li>
							<a href="#">Postagens Inativas</a>
						</li>

						<li>
							<a href="#">Feeds</a>
						</li>

						<li>
							<a href="#">Parceiros</a>
						</li>

						<!--<li>
							<a href="#">Feeds</a>
						</li>-->
					</ul>
				</nav>
			</header>
			<main id="main">
				<div>
					<input type="text" id="txtBusca" name="buscar" value="Pesquise postagens..."/>
					<input type="submit" id="btnBuscaPost" name="ok" value=""/>
				</div>
				<section id="postagens">
					<h1>Postagens</h1>

				</section>
			</main>
			<footer>
				&copy; Exodia Corporation
				| Fraan Lezel Fotografia
				<time pubdate="pubdate">2013-18-06</time>

				<div id="login">
						<a href="login.html">Sair</a>
				</div>
			</footer>
		</div>
		<script type="text/javascript" src="common/scripts/jquery-2.0.2.min.js"></script>
		<script type="text/javascript" src="common/scripts/mustache.js"></script>
		<script type="text/javascript" src="common/scripts/core.js"></script>
		<script type="text/javascript" src="common/scripts/postagens.js"></script>
	</body>
</html>