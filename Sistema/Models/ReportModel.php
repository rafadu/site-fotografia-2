<?php
require_once("..\Application\Connection.php");
require_once("..\Objects\Report.php");

use Application\Connection;
use Object\Report;
class ReportModel {
	public function loadData(){
		$sqlArray = array("SELECT 'Postagens Ativas' AS TITLE,COUNT(*) INFO FROM postagem WHERE isAtivo=1",
							"SELECT 'Postagens Inativas' AS TITLE,COUNT(*) INFO FROM postagem WHERE isAtivo=0",
							"SELECT 'Imagens' AS TITLE,COUNT(*) INFO FROM imagem WHERE idPostagem IS NOT NULL",
							"SELECT 'Tags' AS TITLE,COUNT(*) INFO FROM tag",
							"SELECT 'Tag mais utilizadas' AS TITLE,idTag INFO,COUNT(*) CONT FROM postagemTag GROUP BY idTag ORDER BY CONT DESC LIMIT 1");
		$mysqli = Connection::Open();
		mysqli_set_charset($mysqli, 'utf8');
        //realizar o comando
        $info = array();
        foreach ($sqlArray as $sqlCommand) {
        	$resultado = $mysqli->query($sqlCommand);
        	while($row=$resultado->fetch_assoc()){
        		$obj = new Report();
        		$obj->TITLE = $row["TITLE"];
        		$obj->INFO = $row["INFO"];
        		$info[] = $obj;
        	}
        }
        $resultado->close();
        $mysqli->close();
        return $info;
	}
}
?>