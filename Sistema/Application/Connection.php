<?php

/**
 * Description of Connection
 *
 * @author Rafael
 */
namespace Application;
class Connection {
    //classe de conexão com o banco de dados, sempre instanciar
    //ao realizar uma operação lá
    private static $address='localhost';
    private static $dbuser='rafadu';
    private static $dbpassword='rafael916152'; 
    private static $dbname='fotografia';
    
    //abre a conexão com o banco de dados e retorna um objeto mysqli que permite
    //fazer as operações com o database (gera uma interface para realizar as 
    //operações)
    public static function Open(){
	$conn = new \mysqli(self::$address,self::$dbuser,self::$dbpassword,self::$dbname);
        return($conn);
    }
    
    //OBS:não esqueça de fechar o mysqli depois
}

?>
