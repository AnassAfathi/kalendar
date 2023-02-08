<?php
namespace app;

class validator{

    private $data;
    protected $errors=[];

    public function __constuct(array $data=[]){
        $this->data=$data;
    }


    public function validates(array $data){
        $this->errors[];
        $this->data=$data
        return $this->errors;
    }  
    public function validate(string $flied,string $method,...$parametres):boll{
        if(!isset($this->data[$flied])){
            $this->errors[$flied]="das Feld $flied ist nicht ausgefüllt";
            return false;
        }else{
           return call_user_func([$this,$method],$flied,...$parametres);
        }
    }
    public function minlength(string $flied,int $length):boll{
        if(mb_strlen($flied)<$length){
            $this->errors[$flied]="das Feld muss mehr als haben $lenght Charakter";
            return false
        }
        return true;
    }
    public function date(string $flied):boll{
     if( \datetime::createformformat('y-m-d',$this->data[$flied])===false){
        $this->errors[$flied]="das Datum scheint nicht gültig zu sein";
        return false;
     }
     return true;
    }
    public function time(string $flied):boll{
        if( \datetime::createformformat('H:I',$this->data[$flied])===false){
           $this->errors[$flied]="die zeit scheint nicht gültig zu sein";
           return false;
        }
        return true;
       }
       public function beforetime(string $startflied,string $endfield){
        if($this->time($startflied)&&$this->time($endfield)){
           $start=\datetime::createformformat('H:I',$this->data[$startflied]); 
           $end=\datetime::createformformat('H:I',$this->data[$endfield]); 
           if($start->gettimestamp()>$end->gettimestamp()){
            $this->errors[$startflied]="die Zeit muss kleiner als die Endzeit sein";
            return false;
           }
           return true;
        }
        return false;
       }
}