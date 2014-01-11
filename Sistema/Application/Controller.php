<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Controller
 *
 * @author Rafael
 * 
 * Deve ser herdada pelas controllers para que todas possa usar os métodos desta
 * classe
 */
namespace Application;

class Controller {
    
    public function redirect($path){
        header("Location: $path");
        exit(0);
    }
    
    public function JSONResult($array){
        return json_encode($array);
    }
}

?>
