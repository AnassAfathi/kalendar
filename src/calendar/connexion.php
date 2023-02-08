<?php

function get_pdo(){

 try
 {
    $pdo=new pdo("mysql:host=localhost8080;bdname=evenementphilos";"root","");
    return $pbo;
 }
 catch(PDOException $e)
 {
     echo $e->getMessage();
 }
  
}


 function dd(...$vars){
    foreach($vars as $var){
    echo'<pre>';
    print_r($var);
    echo'</pre>';
    }
 }
?>