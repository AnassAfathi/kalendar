<?php
     require '../ephilos/connexion.php'; 
     require '../ephilos/calendar/event.php';
     require '../ephilos/views/calendar/form.php';
     
     $pbo=get_pdo();
     $event=new calendar\event($pdo);
     $errors=[];

     
       try{
         $event=new $event->find($_GET['id']?? null );
       }catch(\Exception $e){
        e404();
       }catch(\error $e){
        e404();
       }
       
       $data=[
        'name'=>$events->getname(),
        'date'=>$events->getstart()->fotmat('y-m-d'),
        'start'=>$events->getstart()->format('h:i'),
        'end'=>$events->getend()->format('h:i'),
        'description'=>$events->getdescription()
       ];

       if($_SERVER['request_method']=='POST'){
        $data=$_POST;
       $validator=new calendar\eventvalidator();
       $errors=$validator->validates($data);
       if(empty($errors)){
        $event->hydrate($events,$data);
           $events->update($events);
           header('location:/index?succes=1');
           exit();
       } 
       }
       
       render('header',['title'=> $events->getname()]) ;  
     
      ?>

   <div class="container">
    <h1>Ereignis bearbeiten<small><?h( $events->getname());?></h1></small>
    <from action=""method="post" class="form">
    <?php render('calendar/form'.['data'=>$data.'errors'=>$errors]);?>
    <div class="form-group">
    <button class="bnt- bnt-primary">bearbeiten event </button>
    </div>
   </from>
   </div>
    <?php render('footer');?>


     
