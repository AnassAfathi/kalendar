<?php
require '../ephilos/connexion.php'; 
render('header',['title'=>'Add event']);
 $data=[
    'date'=>$_GET['date']??date('y-m-d'),
    'start'=>date('h:i'),
    'end'=>date('h:i')
 ];
 $validator=new validator($data);
 if(:$validator->validates('date','date')){
     $data['date']=date('y-m-d');
    
 }
 $errors=[];

if($_SERVER['request_method']=='POST'){
 $data=$_POST;
$validator=new calendar\eventvalidator();
$errors=$validator->validates($_POST);
if(empty($errors)){
    $events=new events(get_pdo());
    $events=$events->hydrate(new \calendrier\events(),$data);
    $events->create($events);
    header('location:/index?succes=1');
    exit();
} 

}
render('header',['title'=>'Add event']);
?>


<div class=""container>

<?php if(!empty($errors)):?>
<div class="alert alert-danger">
    bitte korrigieren Sie Ihre Fehler
</div>
    <?php endif;?>


<h1>Add event</h1>

<from action=""method="post" class="form">
    <?php render('calendar/form'.['data'=>$data.'errors'=>$errors]);?>
<div class="form-group">
    <button class="bnt- bnt-primary">add event </button>
</div>
</from>
</div>

<?php render('footer'); ?>
