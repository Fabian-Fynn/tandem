<?php
	include "menu.php";
	if(! isset($_SESSION['user']))
	{
		header('Location: index.php');
	}

	$user = $_SESSION['user'];
	$id = $_SESSION['id'];

	$stm = $dbh->query("SELECT * FROM user WHERE id=$id");
  	$person = $stm->fetch();

	if($person->avatar != null)
	{
		$avatar = $person->avatar;
	}
	else
	{
		$avatar = "img/profilePic.png";
	}
?>
<div class = "wrap">
		
	
			
</div>
	
<?php
    include "footer.php";
?>