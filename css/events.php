<?php
     require '../ephilos/connexion.php'; 
     require '../ephilos/calendar/event.php';
     require '../views/header.php';
     $pbo=get_pdo();
     $event=new calendar\event($pdo);
     if(!isset($_GET['id'])){
        header('location:/404.php');
     }
       
     $event=new $event->find($_GET['id']?? null );
     
      ?>


    <h1><? $events['name'];?></h1>
    <ul>
      <li> date: <?= (new datetime($events['start']))->format('d/m/y') ;?></li>
      <li> heure de demarrage: <?= (new datetime($events['start']))->format('h:i') ;?></li>
      <li> heure de fin: <?= (new datetime($events['end']))->format('h:i') ;?></li>
      <li> 
        description:<br> 
        <?= $events['description']?>
      </li>
    </ul>


      <?php require '../views/footer.php';?>


