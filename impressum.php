<?php
	include "menu.php";
	if(! isset($_SESSION['id']))
	{
		header('Location: index.php');
	}

	
?>
	<div class = "wrap">
		<h1>Impressum</h1>
		<br>
		<p>TANDEM is a second semester project of the course MultimediaTechnology at University of Applied Sciences Salzburg</p><br>


<h3 class="">Fabian Hoffmann</h3>
<p>MultimediaTechnology</p>
<a href="http:\\www.fh-salzburg.ac.at"><p>University of Applied Sciences Salzburg</p></a><br>
<a href="mailto:fhoffmann.mmt-b2013@fh-salzburg.at"><p>fhoffmann.mmt-b2013@fh-salzburg.at</p></a></div>


	</div>
	
<?php
    include "footer.php";

?>

