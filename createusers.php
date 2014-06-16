<?php
/*TANDEM is a second semester project (MultiMediaProjekt 1) of the course Multimedia Technology at University of Applied Sciences Salzburg

Author: Fabian Hoffmann
Course of Study: Multimedia Technology
At: University of Applied Sciences Salzburg

fhoffmann.mmt-b2013@fh-salzburg.ac.at

"Icons made by Icons8, Freepik and Designerz Base from Flaticon.com / partly modified"

"Index picture made by CollegeDegrees360 from Flickr.com"
*/
	include 'menu.php';
	if($_SESSION['id'] != "3")
	{
		header('Location: index.php');
	}
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$firstMale =   array("Peter", "Paul", "Martin", "Max",     "Heinz",    "Franz", "Lukas",  "Simon",    "Dominik", "Bernhard");
	 	$firstFemale = array("Luise", "Lisa", "Petra", "Franziska", "Veronika", "Lena",  "Martha", "Isabella", "Sophie",  "Anna");
		$surnames = array("Huber", "Walch", "Leitner", "Rohrmoser", "Zwettler", "Maier", "Hoffmann", "Grübl", "Rest", "Jacimovic", "Müller", "Niedermüller", "Haidinger", "Haider", "Strasser", "Antos", "Höfinger", "Höfner", "Klappert", "Wieser", "Pöschl", "Untersteiner", "Steiner", "Berer", "Hörbinger", "Sommer", "Schmidt", "Zahn", "Haas", "Armstorfer", "Kiska", "Mühlleitner", "Dengg", "Pföss", "Sattler", "Hintersonnleitner", "Rehrl", "Treiber", "Schlager", "Schultheis","Baku", "Sögner", "Goiginger", "Sturm", "Nußbaumer","Pronj","Freinbichler","Kranewitter","Steger","Poschacher");

		$date = date('Y-m-d H:i:s');

		$dbh->exec("DELETE FROM user WHERE email LIKE  '%test.at'"); //keine beeinflussbare Variable

		$sth = $dbh->prepare(
			  "INSERT INTO user
				(id, firstname,surname,email,is_female,password,register_date, avatar)
				  VALUES
				(NULL,  ?,     ?,      ?,    ?,              ?,?,?)");
		$stho = $dbh->prepare(
			  "INSERT INTO offer
				(id, course, teacher)
				  VALUES
				(NULL, ?,   ?)");
		$sths = $dbh->prepare(
			  "INSERT INTO search
				(id, course, student)
				  VALUES
				(NULL, ?,   ?)");

		//create user
		$id=5;
		while($id <= $_POST['amount'])
		{
			$isfemaleRand = rand(1,20);

			if($isfemaleRand > 10)
				$isfemale = 1;
			else
				$isfemale = 0;
			
			if($isfemale == 0)
			{
				$firstnameNr = rand(0,count($firstMale)-1);
				$firstname = $firstMale[$firstnameNr];
			}else
			{
				$firstnameNr = rand(0,count($firstFemale)-1);
				$firstname = $firstFemale[$firstnameNr];
			}

			$surname = $surnames[rand(0, count($surnames)-1)];
			$email = $id."@test.at";
			
			$password = hashPasswordSecure("asdf");

			if($isfemale == 0)
	            $avatar = "male_avatar.png";
	        else
	        	$avatar = "female_avatar.png";

			$sth->execute(
				array(
					$firstname,
					$surname,
					$email,
					$isfemale,
					$password,
					$date,
					$avatar
				)
			); 

			$o = range(1, 25);
			shuffle($o);
			$offers = array_slice($o, 0, 5);
			$DBid = $dbh->lastInsertId();

			foreach ($offers as $offer ) {
				try{
				$stho->execute(
					array(
						$offer,
						$DBid
					)
				); 
				}
				catch(Execption $e)
				{}
			}
			$searchamount = 0;
			$searches = array();
			while($searchamount < 5)
			{
				$s = rand(1,25);
				if(!in_array ( $s , $searches) && !in_array ( $s , $offers))
				{
					$searchamount++;
					$searches[$searchamount] = $s;
				}
			}
			foreach ($searches as $search ) {
				$sths->execute(
					array(
						$search,
						$DBid
					)
				); 
			}
			$id++;
		}
	}
?>
	<div class = "wrap">
		<section class="profileTop">
			<div class="userName"><h1>Create Users</h1></div>
			<article class="left">
				<h2>RandomuserGenerator</h2>
				<form action="createusers.php" method="post" >
					<label for="amount" >Amount:</label> 
					<input type="text" name="amount"><br>
					<input type="submit" value=" create users ">
				</form>
			</article>
			<article class="right">
			<h2>RandomuserDeleter</h2>
			<form action="deleterandomusers.php" method="post" >				
				<input style="float:left;" type="submit" value=" delete all ">
			</form>
		</article>
		</section>
	</div>

<?php
	include 'footer.php'
?>
