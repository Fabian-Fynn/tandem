<?php


if(isset($_GET['key']))
{
  $key = $_GET['key'];
 
  //fetch userId with key
  $stm = $dbh->prepare("SELECT id FROM user WHERE activationKey = ?");
  $stm->execute(array($key));
  $response = $stm->fetch();
 
  //delete key and userid
  //$sth = $dbh->prepare("DELETE FROM activation WHERE actKey = ?;");
  //$sth->execute(array($key));
 
  if($response != null)
  {
     //set user as active
    $id = $response->id;
    $sth = $dbh->prepare("UPDATE user SET active = ?, activationKey = null WHERE id = ?;");
    $sth->execute(array(1,$id));
 
    header("Location:index.php?msgId=2");
    exit;
  }
  else
  {
    header("Location:index.php");
    exit;
  }
 
 
}
header("Location:index.php");
 ?>