<?php 
include('Authentication.php');

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$usuario = (isset($_POST['usuario'])) ? $_POST['usuario'] : '';
		$senha = (isset($_POST['senha'])) ? $_POST['senha'] : '';
		
		if (autenticaUsuario($usuario, $senha) == true) {
		header("Location: painel.php");
		}
	else {
		verificaLogon();
	}
}

?>