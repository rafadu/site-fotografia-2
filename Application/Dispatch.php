<?php
/*
 * Usada para as requisições da aplicação, tanto requisições javascript como
 * de elementos forms. Devem ser passadas o nome da classe controller, o método
 * que quer executar
 */

//Fazendo o require do arquivo que contem a classe
$controller_file = "../Controllers/".$_REQUEST['controller']."Controller.php";
if(file_exists($controller_file))
    require_once $controller_file;

//instanciando a classe
$name_class = $_REQUEST['controller']."Controller";
if (class_exists($name_class))
    $o = new $name_class;

//chamando o método
$method_name = $_REQUEST['method'];
if (method_exists($o, $method_name))
        $o->$method_name();
?>
