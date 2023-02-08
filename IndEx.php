      <?php
      require '../ephilos/connexion.php'; 
      require '../ephilos/calendar/month.php'; 
      require '../ephilos/calendar/event.php';
      $pdo=get_pdo();
      $event= new calendar\event($pdo);
      $start=$month->getstartingday();
      $start =  $start->format('n')==='1'? $start:$month->getstartingday()->modify('last monday');
      
      try{ 
        $month = new calendar\$month($_GET['month'] ?? null,$_GET['year'] ?? null);
    
           }catch(\Exception $e){
            $month = new calendar\month();

        }
        $weeks=$month->getweeks();
        $end=(clone $start)->modify('+'.( 6 + 7 * $weeks - 1) .'days');
       $event=$event->geteventsbetweenbyday($start,$end) ;
       require '../views/header.php';
      ?>
  <div class="calendar">

 

  <div class="d-flex flex-row align-items-center justify-content-between mx-sm-3">
         <h1><?= $month->toString(); ?> </h1>
         <?php if(isset($_GET['success'])):?>
    <div class="container">

    <div class="alert alert-success">Die Veranstaltung wurde registriert

    </div>
    </div>
    <?php endif;?>
     
         <div>
          <a href="/indEx.php?month=<?= $month->previousmonth()->month;?> &year=<?= $month->previousmonth()->year;?>"  class="btn btn_primary">&lt;</a>
          <a href="/indEx.php?month=<?= $month->nextmonth()->month;?> &year=<?= $month->nextmonth()->year;?>" class="btn btn_primary">&gt;</a>
            </div>
      </div>

         <table class="calendar__table calendar__table--<?= $weeks;?>$weeks" >
        <?php for ($i=0; $i<$weeks;$i++):?>
            <tr>
                <?php foreach( $month->days as $k => $day ):
                    $date=(clone $start)->modify("+".($k + $i * 7)." days");
                    $eventsforday=$event[$date->formmat('y-m-d')] ??[];
                    $istoday=date('y-m-d')===$date->format('y-m-d');
                    ?>
                <td class="<?= $month->withinmonth($date)?'' : 'calendar__othermonth';?> <?= $istoday ?'istoday' : '';?>">
                <?php if( $i===0 );?>
                <div class="calendar__weekday"><?=$day;?></div>
                <?php endif;?>

                <a class="calendar__day" href="add.php?date=<? $date->format('y-d-h');?>"><? $date->format('d');?></a>
                <?php foreach($eventsforday as $event): ?>
                    <div class="calendar__event">
                        <?=(new datetime($event['start']))->format('h:i')?>-<a href="\edit.php ? id=<?$event['id'];?>">
                        <?=h($event['name']); ?></a>
                    </div>
                    <?php endforeach; ?>
                </td>
               
            </tr> 
             <?php endforeach; ?>
      </table>
    
      <a href="/add.php" class="calendar__button"></a>


  </div>
      
      <?php require '../views/footer.php';?>


