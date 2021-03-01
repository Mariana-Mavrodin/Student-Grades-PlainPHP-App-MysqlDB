<!DOCTYPE html>
<html lang="en">
<head>
	  <title>Bootstrap Example</title>
	  <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	  <style>
* {
  box-sizing: border-box;
}

/* Create two equal columns that floats next to each other */
.column {
  float: left;
  width: 50%;
  padding: 10px;
  height: 300px; /* Should be removed. Only for demonstration */
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}
	</style>
</head>
<body>

<?php
	$chenarDenumireMaterieAdaugare = "";
	$chenarProfesorAdaugare = "";
	$chenarPuncteCreditAdaugare;
	
	
	$chenarIdMaterieActualizare;
	$chenarDenumireMaterieActualizare = "";
	$chenarProfesorActualizare = "";
	$chenarPuncteCreditActualizare;
	
	if (isset($_GET['idmaterie'])){
		$chenarIdMaterieActualizare = $_GET['idmaterie'];
		$chenarDenumireMaterieActualizare = $_GET['denumire'];   ////////actualizare
		$chenarProfesorActualizare = $_GET['profesor'];
		$chenarPuncteCreditActualizare = $_GET['punctecredit'];
	}
?>

<div class="container">
	<br></br>
	<h1>Materii</h1>
	<h2><a href = "../">Inapoi</a></h2>
	
	<div class="row">
		<div class="column">
			<form action="index.php" method="post">
				<br></br>
				denumire : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="text" name="denumire" value="<?php echo $chenarDenumireMaterieAdaugare;?>"> 
				<br></br>
				profesor : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="text" name="profesor" value="<?php echo $chenarProfesorAdaugare;?>">
				<br></br>
				puncteCredit : &nbsp;&nbsp;
				<input type="number" name="puncteCredit" value="<?php echo $chenarPuncteCreditAdaugare;?>">
				<br></br>
				<input type="submit" name="adaugaMaterie" value="Adauga Materie"/>
			</form>
		</div>
		<div class="column">
			<form action="index.php" method="post">
				<br></br>
				id : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="number" name="id" value="<?php echo $chenarIdMaterieActualizare;?>" readonly >
				<br></br>
				denumire : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="text" name="denumire" value="<?php echo $chenarDenumireMaterieActualizare;?>"> 
				<br></br>
				profesor : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="text" name="profesor" value="<?php echo $chenarProfesorActualizare;?>">
				<br></br>
				puncteCredit : &nbsp;
				<input type="number" name="puncteCredit" value="<?php echo $chenarPuncteCreditActualizare;?>">
				<br></br>
				<input type="submit" name="actualizeazaMaterie" value="Actualizeaza Materie"/>
			</form>
		</div>
	</div>	

	
	<br></br>
	

	
	<br></br>

	
	<form action="index.php" method="post">
		<input type="submit" name="incarcaMaterii" value="Incarca Materii"/>
	</form>
	
	<br></br>

  
<?php

	$host = 'localhost';
	$port = '3306';
	$server = $host . ':' . $port;
	$user = 'root';
	$password = 'paste.bronzate18';

	$link = mysqli_connect($server, $user, $password);
	if (!$link)
	{
		die('Error: Could not connect: ' . mysqli_error($link));
	}

	$database = 'proiect';

	mysqli_select_db($link, $database);	
	
	function showTable($link) {

		$query = 'select * from materii';

		$result = mysqli_query($link, $query);

		if (!$result) 
		{
			$message = 'ERROR:' . mysqli_error($link);
			return $message;
		}
		else
		{
			echo '<table class="table table-bordered"><thead><tr>';
			
			while ($property = mysqli_fetch_field($result)) {
				echo '<td><b>' . $property->name . '</b></td>';
			};
			echo '<td><b>Operatiune</b></td>';
			echo '</tr></thead>';
			
			echo '<tbody>';
			while ($row = mysqli_fetch_row($result)) 
			{
				echo '<tr>';
				$count = count($row);
				$y = 0;
				while ($y < $count)
				{
					$c_row = current($row);
					echo '<td>' . $c_row . '</td>';
					next($row);
					$y = $y + 1;
				}
				echo "<td><a href = 'index.php?id=$row[0]'>Stergere</a> &nbsp &nbsp <a href='index.php?idmaterie=$row[0]&denumire=$row[1]&profesor=$row[2]&punctecredit=$row[3]'>Pregatire actualizare</a></td>";
				echo '</tr>';
			};
			echo '</tbody></table>';
			mysqli_free_result($result);
		}
	}
	
	
	
    if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['incarcaMaterii']))
    {
		showTable($link);
	}
	
	else if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['adaugaMaterie']))
	{
		$denumire = $_POST['denumire'];
		$profesor = $_POST['profesor'];
		$puncteCredit = $_POST['puncteCredit'];
		
		$query = "insert into materii(denumire, profesor, punctecredit) values ('" . $denumire . "', '" . $profesor . "', " . $puncteCredit . " ); ";
		
		if (mysqli_query($link, $query)) {
			echo "Record inserted successfully";
			echo '<br></br>';
			showTable($link);
		} else {
			echo "Error inserting record: " . mysqli_error($link);
		}
	}
	
	elseif ($_SERVER['REQUEST_METHOD'] == "GET" and isset($_GET['id'])){

		$query = "delete from materii where idmaterie = " . $_GET['id'] . ";";

		if (mysqli_query($link, $query)) {
			echo "Record deleted successfully";
			echo '<br></br>';
			showTable($link);
		} else {
			echo "Error deleting record: " . mysqli_error($link);
		}
		
	}
	
	elseif ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['actualizeazaMaterie'])){
		
		$denumire = $_POST['denumire'];
		$profesor = $_POST['profesor'];
		$puncteCredit = $_POST['puncteCredit'];
		
		$query = "update materii set denumire= '" . $denumire . "' , profesor='" . $profesor . "', punctecredit= " . $puncteCredit 
					. " where idmaterie=" .  $_POST['id'] . ";";

		if (mysqli_query($link, $query)) {
			echo "Record updated successfully";
			echo '<br></br>';
			showTable($link);
		} else {
			echo "Error updating record: " . mysqli_error($link);
		}
	}

	else {
		echo '<table class="table table-bordered"><thead><tr><td><b>idmaterie</b></td><td><b>denumire</b></td><td><b>profesor</b></td><td><b>punctecredit' 
		. '</b></td><td><b>Operatiune</b></td></tr></thead><tbody><tr><td></td><td></td><td></td><td></td><td></td></tr></tbody></table>';
	}
	
	mysqli_close($link);

?>

</div>

</body>
</html>