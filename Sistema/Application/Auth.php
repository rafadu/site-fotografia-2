<?php 
namespace Application;
include('../Application/Connection.php');
use Application\Connection;
class Auth{

public static function Logon($login,$senha){
		$resultado = self::PesquisaUsuario($login,$senha);
			if (empty($resultado)){
				if (session_status() == PHP_SESSION_ACTIVE) {
					session_destroy();
				}
				else{
					header("Location: ../Views/login.php");
				}
			}
			else{
				session_start();
				$_SESSION['usuario'] = $resultado['usuario'];
				$_SESSION['nome'] = $resultado['nome'];
				$_SESSION['senha'] = $resultado['senha'];
				header("Location: ../Views/painel.php");
			}	
	
}

private static function PesquisaUsuario($usuario, $senha){
$conexaoBD = Connection::Open();
	$sqlCommand = "SELECT nome,usuario,senha FROM usuarios WHERE usuario = '$usuario' AND senha = '$senha' ";
		$result = $conexaoBD->query($sqlCommand);
			if (is_object($result)){
				while ($row = $result->fetch_assoc()){
					$resultado['usuario'] = $row['usuario'];
					$resultado['nome'] = $row['nome'];
					$resultado['senha'] = $row['senha'];
					return $resultado;
				}
			}
}

//------------------------------------------------

public static function VerificaLogon(){
	if (session_status() == PHP_SESSION_ACTIVE) {
		$resultado = self::PesquisaUsuario($_SESSION['usuario'],$_SESSION['senha']);
		if (empty($resultado)){
			session_destroy();
			header("Location: ../Views/login.php");
		}
		else{
			return true;
		}
	}
	else{
		header("Location: ../Views/login.php");
	}
}
}
?>