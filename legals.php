<?php
/*TANDEM is a second semester project (MultiMediaProjekt 1) of the course Multimedia Technology at University of Applied Sciences Salzburg

Author: Fabian Hoffmann
Course of Study: Multimedia Technology
At: University of Applied Sciences Salzburg

fhoffmann.mmt-b2013@fh-salzburg.ac.at

"Icons made by Icons8, Freepik and Designerz Base from Flaticon.com / partly modified"

"Index picture made by CollegeDegrees360 from Flickr.com"
*/
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