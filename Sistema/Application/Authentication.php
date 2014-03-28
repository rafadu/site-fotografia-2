<?php
require_once("..\Application\Connection.php");
 class Authentication {
	$_SG['conectaServidor'] = true;
	$_SG['abreSessao'] = true; 
	
	
	$dadosConexao = Connection::Authenticate();
	$_SG['address'] = $dadosConexao['address'];
	$_SG['dbuser'] = $dadosConexao['dbuser'];
	$_SG['dbpassword'] = $dadosConexao['dbpassword'];
	$_SG['dbname'] = $dadosConexao['dbname'];
	
	
	if ($_SG['conectaServidor'] == true) {
	$_SG['link'] = mysql_connect($_SG['address'], $_SG['dbuser'], $_SG['dbpassword']) 
	or die("MySQL: Não foi possível conectar-se ao servidor [".$_SG['address']."].");
	mysql_select_db($_SG['dbname'], $_SG['link']) 
	or die("MySQL: Não foi possível conectar-se ao banco de dados [".$_SG['dbname']."].");
	}

	if ($_SG['abreSessao'] == true) {
	session_start();
	}
	
function autenticaUsuario($usuario, $senha){
	$sqlCommand = "SELECT nome,usuario,senha FROM usuarios WHERE usuario = $usuario AND senha = $senha";
	$mysqli = Connection::Open();
	mysqli_set_charset($mysqli, 'utf8');
	$query = $mysqli->query($sqlCommand);
	$resultado = mysql_fetch_assoc($query);

	if (empty($resultado)){
		return false;
	}
	else{
		$_SESSION['usuario'] = $resultado['usuario'];
		$_SESSION['nome'] = $resutlado['nome'];
		return true;
	}
	
function verificaLogon(){
	global $_SG;
	if (!isset($_SESSION['usuario']) OR !isset($_SESSION['nome'])){
		unset($_SESSION['usuario'], $_SESSION['nome'];
		header("Location: index.php");
	}
}

}



	
}
?>