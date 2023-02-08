<?php   
namespace calender; 
 class events{

private $id;  
private $name;
private $description;
private $start;
private $end;


public function getid():int{
    return $this->id;
}
public function getname():string{
    return $this->name;
}
public function getdescription():?string{
    return $this->description;
}
public function getstart():\datetime{
    return new \datetime($this->start);
}
public function getend():\datetime{
    return new \datetime($this->end);
}
public function setname(string $name){
    $this->name=$name;
}
public function setdescription(string $description){
    $this->description=$description;
}
public function setstart(string $start){
    $this->start=$start;
}
public function setend(string $end){
    $this->end=$end;
}

 }

?>