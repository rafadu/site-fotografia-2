<?php 
require_once("..\Application\Controller.php");
require_once("..\Models\ReportModel.php");

use Application\Controller;
class ReportController extends Controller {
	public function painelReport(){
		$rprtModel = new ReportModel();
		$data = $rprtModel->loadData();
		return $this->JSONResult(array("data"=>$data));
	}
}
?>