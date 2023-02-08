<?php
     require '../ephilos/connexion.php'; 
     require '../ephilos/calendar/event.php';
     
     $pbo=get_pdo();
     $event=new calendar\event($pdo);
     if(!isset($_GET['id'])){
        header('location:/404.php');
     }
       try{
         $event=new $event->find($_GET['id']?? null );
       }catch(\Exception $e){
        e404();
       }
       
       render('header',['title'=> $events->getname()]) ;  
     
      ?>


    <h1><?h( $events->getname());?></h1>
    <ul>
      <li> date: <?= $events->getstart()->format('d/m/y') ;?></li>
      <li> heure de demarrage: <?=  $events->getstart()->format('h:i') ;?></li>
      <li> heure de fin: <?=  $events->getend()->format('h:i') ;?></li>
      <li> 
        description:<br> 
        <?=h( $events->getdescription()); ?>
      </li>
    </ul>


      <?php require '../views/footer.php';?>


