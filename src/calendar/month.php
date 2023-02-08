<?php  
 namespace app\date;
class mouth {
      
     public $day=['Montag', 'Dienstag', 'Mittwoch', 'Donnerstag', 'Freitag', 'Samstag', 'sonntag'];
    public  $months=['Januar' ,'Februar','März','April','Mai','Juni','Juli','August','September','Oktober','November','Dezember' ];
      public  $month;
      public $year;
    

    public  function construct( ?int $month=null, ?int $year=null) 
    {

        if($month===null || $month=1 || $month>12){}
        if($year===null  ){}
    
         $this-> $month=$month;
         $this->$year=$year;
    }

    public function getstartingday(): \datetime{
        return new \datetime("{$this->year}-{$this->month}-1");
    }
    public function toString():string{
        return  $this-> $month[ $this-> $month-1].''. $this->$year;
     }

     public function getweeks ():int{
        $start = $this->getstartingday();
        $end=(clone $start)->modify('+1 month -1 day'); 
        $weeks=intval($end->format('w'))- intval($start->format('w'))+1;
        if($weeks < 0){
           $weeks= intval($end->format('w'));      
        }
        return $weeks;
     }

     public function withinMonth(\datetime $date): bool{
        return $this->getstartingday()->format('y-m')== $date->format('y-m'); 
     }

     public function nextmonth(): month
     {
         $month=$this->month + 1;
         $year=$this->year;
         if($month > 12) 
         {
          $month=1;
          $year +=1,
         }
         return new month($month,$year);
     }
     public function previousmonth(): month
     {
         $month=$this->month - 1;
         $year=$this->year;
         if($month > 1) 
         {
          $month=12;
          $year -=1,
         }
         return new month($month,$year);
     }
}