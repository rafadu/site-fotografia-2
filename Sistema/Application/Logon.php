<?php
include('../Application/Auth.php');
use Application\Auth;
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	Auth::Logon($_POST['txtLogin'],$_POST['txtSenha']);
	}
