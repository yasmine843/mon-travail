<?php 
class Cours{
 private $titre;
 private $description;
 public function settitre($titre1){
    $this->titre=$titre1;
    
 }
 public function setdescription($describe1){
    $this->descprition=$describe1;
    
 }
 public function gettitre (){
    return $this->titre;
    
 }
 public function getdescription (){
    return $this->description;
    
 }
 public function __construct($var1,$var2){
    $this->titre=$var1;
    $this->description=$var2;
 }
}
?>