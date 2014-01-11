<?php

/**
 * Description of Connection
 *
 * @author Rafael
 */
class Connection {
    //classe de conexão com o banco de dados, sempre instanciar
    //ao realizar uma operação lá
    private $address='localhost';
    private $dbuser='rduarte';
    private $dbpassword='rafael';
    private $dbname='fotografia';
    
    //abre a conexão com o banco de dados e retorna um objeto mysqli que permite
    //fazer as operações com o database (gera uma interface para realizar as 
    //operações)
    public static function Open(){
	$conn = new mysqli($this->address,$this->dbuser,$this->dbpassword,$this->dbname);
        return($conn);
    }
    
    //OBS:não esqueça de fechar o mysqli depois
}

?>
