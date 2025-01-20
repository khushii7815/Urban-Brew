<?php
require_once("../include/initialize.php");
 if (!isset($_SESSION['ADMIN_USERID'])){
      redirect(web_root."admin/index.php"); 
 }else{
 	 if ($_SESSION['ADMIN_ROLE']!='Administrator') {
      	# code...
      	 redirect(web_root."admin/orders/");
      }
 }

$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';
 $title="Users"; 
 $header=$view; 
switch ($view) {
	case 'list' :
		$content    = 'list.php';		
		break;

	case 'add' :
		$content    = 'add.php';		
		break;

	case 'edit' :
		$content    = 'edit.php';		
		break;
    case 'view' :
		$content    = 'view.php';		
		break;

	default :
		$content    = 'list.php';		
}
require_once ("../theme/templates.php");
?>
  
