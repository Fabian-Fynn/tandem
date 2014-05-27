<?php
/*TANDEM is a second semester project (MultiMediaProjekt 1) of the course Multimedia Technology at University of Applied Sciences Salzburg

Author: Fabian Hoffmann
Course of Study: Multimedia Technology
At: University of Applied Sciences Salzburg

fhoffmann.mmt-b2013@fh-salzburg.ac.at

"Icons made by Icons8, Freepik and Designerz Base from Flaticon.com / partly modified"

"Index picture made by CollegeDegrees360 from Flickr.com"
*/


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