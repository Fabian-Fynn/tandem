<?php
include_once "functions.php";

if(isset($_GET['key']))
{
  $key = $_GET['key'];

  //fetch userId with key
  $stm = $dbh->prepare("SELECT id FROM user WHERE activationKey = ?");
  $stm->execute(array($key));
  $response = $stm->fetch();

  if($response != null)
  {
    //set user as active
    $id = $response->id;
    $sth = $dbh->prepare("UPDATE user SET active = ?, activationKey = null WHERE id = ?;");
    $sth->execute(array(1,$id));

    header("Location:index.php?msgId=1");
    exit;
  }
  else
  {
   header("Location:index.php?msgId=2");
   exit;
  }
}
header("Location:index.php");
?>