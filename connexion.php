<?php

function get_pdo():pdo{

 try
 {
    $pdo=new pdo ("mysql:host=localhost8080 ; bdname=evenementphilos","root",''); 

    return $pbo;
 }
 catch(PDOException $e)
 {
     echo $e->getMessage();
 }
  
}
 function e404(){
   header('location:/404.php');
 }

 function dd(...$vars){
    foreach($vars as $var){
    echo'<pre>';
    print_r($var);
    echo'</pre>';
    }
 }
 function h(?string $value):string{
   if($value===null){
      return '';
   }
   return htmlentities($value);
 }
 function render(string $view,$parametre=[]){ 
   extract($parametre);
   include"..\views\{$views}.php";
 }
?>
