<?php 
namespace calendar;
class eventvalidator extends validator{

    public function validates(array $data){
        parent::validates($data);
        $this->validate('name','minlength',3);
        $this->validate('date','date');
        $this->validate('start','beforetime','end');
        return $this->errors;
    }  




}