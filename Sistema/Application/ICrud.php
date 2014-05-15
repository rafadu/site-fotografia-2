<?php

/**
 *
 * @author Rafael
 * 
 * Determina as operações básicas com banco de dados
 * C -> Create - INSERT
 * R -> Read - SELECT
 * U -> Update - UPDATE
 * D -> Delete - DELETE
 */
namespace Application;
    interface ICrud {
        //object -> instancia de algum Data Object
        //key -> nome da coluna -> valor de parametro para coluna
        //isText -> booleano para determinar se value é string. 
        //(se sim, altera a forma de escrever a query)
        
        public function create($object);
        public function read();
        public function update($object);
        public function delete($id);
    }

?>
