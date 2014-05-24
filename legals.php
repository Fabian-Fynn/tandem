<?php
	include "menu.php";
	if(! isset($_SESSION['id']))
	{
		header('Location: index.php');
	}

	
?>
	<div class = "wrap">
		<h1>Legal Notice</h1>
		<br>
		<?php
									include "legalText.php";
								?>
								
	</div>

	</div>
	
<?php
    include "footer.php";

?>

