<?php
include '../../Controllers/CoursController.php';
$cc = new CoursController();

$cc->deleteCours($_GET["ID"]);  


header('Location: homeAdmin.php');

?>
