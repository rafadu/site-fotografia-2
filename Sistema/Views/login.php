<?php
session_start();
if (session_status() == PHP_SESSION_ACTIVE) {
session_destroy();
}
?>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>Fran Letzel Fotografia</title>
		<link rel="stylesheet" type="text/css" href="common/styles/reset.css">
		<link rel="stylesheet" type="text/css" href="common/styles/site.css">
		<link rel="stylesheet" type="text/css" href="common/styles/login.css">
	</head>
	<body>
	<div id="geral">
		<header>
			<h1>Fraan Letzel Fotografia</h1>
		</header>
		<main id="main">
			<section id="form">
				<form action="../Application/Logon.php" method="POST">
					<label for="txtTitulo">Login</label> <br/>
					<input type="text" name="txtLogin" id="txtLogin"/> <br />
					<label for="txtTitulo">Senha</label> <br/>
					<input type="password" name="txtSenha" id="txtSenha"/>
					<input type="hidden" name="controller" value="Postagem">
					<input type="hidden" name="method" id="method" value="create">
					<input type="submit" name="btnSubmit" value="Logar"/>
				</form>
			</section>		
		</main>
		<footer>
			&copy; Exodia Corporation
				| Fraan letzel Fotografia
					<time pubdate="pubdate">2013-25-06</time>
						
			<!--<div id="login">
				<a href="login.html">Login</a>
			</div>-->
		</footer>
	</div>
	</body>
</html>