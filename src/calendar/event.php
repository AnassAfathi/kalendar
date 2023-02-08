<?php
namespace calendar;

class event{

private $pdo;

public function __construct(\pdo $pdo){
   $this->pdo=$pdo;

}


    public function geteventsbetween(\datetime $start, \datetime $end) :array {
           include("connexion.php");
        $sql=$pdo->prepare("select * from events where start between'{$start->format('y-m-d 00:00:00')}' and  '{$end->format('y-m-d 23:59:59')}'order by start asc" );
        $startement = $this->$pdo->query($sql);
        $resulat = $startement->fetchAll();
        return $resulat; 
    }

    public function geteventsbetweenbyday(\datetime $start, \datetime $end) :array {
       $events=$this->geteventsbetween($start,$end);
       $days=[];  
       foreach($events as $end){
         $date=explore( '' , $events['start'])[0];
         if(!isset($days[$date])){
          $days[$date]=[$event];
         }else{
            $days=[$date ];
         }
         return $days;
       }
       
      }
      public function find(int $id):events{
         include("connexion.php");
         require 'events.php';
         $startement=$this->pdo->query("select * from event where id= $id limit 1");
         $startement->setFetchMode(:pdo::FETCH_class,events::class);
         $result=$startement->fetch();
         
         if($result===false){
            throw new Exception('keine Ergebnis gefunden ');
         }else{
            return $result;
         }
        }
        public function create(events $events ):boll{
         $startement=$this->pdo->prepare('insert into event(name,description,start,end)values(?,?,?,?)');
          return $startement->execute([
              $events->getname(), 
              $events->getdescription(),
              $events->getstart()->foermat('y-m-d H:i:s'),
              $events->getend()->foermat('y-m-d H:i:s'),

      ]);
        }
        public function update(events $events ):boll{
         $startement=$this->pdo->prepare('update event set name=?,description=?,start=?,end=? where id=?');
          return $startement->execute([
              $events->getname(), 
              $events->getdescription(),
              $events->getstart()->foermat('y-m-d H:i:s'),
              $events->getend()->foermat('y-m-d H:i:s'),
              $event->getid()

      ]);
        }
        public function hydrate(event $event ,array $data){
         $events->setname($data['name']);
         $events->setdescription($data['description']);
         $events->setstart(\datetime::createformformat('y-m-d',$data['date'].''.$data['start'])->format('y-m-d h::i:s'));
         $events->setend(\datetime::createformformat('y-m-d',$data['date'].''.$data['end'])->format('y-m-d h::i:s'));
         return $event;

        }
         public function delete(events $events):boll{ 
            
            $startement=$this->pdo->prepare('delete event set name=?,description=?,start=?,end=? where id=?');
            return $startement->execute([
                $events->getname(), 
                $events->getdescription(),
                $events->getstart()->foermat('y-m-d H:i:s'),
                $events->getend()->foermat('y-m-d H:i:s'),
                $event->getid()]);
         }

}



?>