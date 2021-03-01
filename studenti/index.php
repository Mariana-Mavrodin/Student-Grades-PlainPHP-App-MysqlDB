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
	$chenarNumeAdaugare = "";
	$chenarPrenumeAdaugare = "";
	$chenarGrupaAdaugare;
	$chenarSerieAdaugare = "";
	$chenarAnAdaugare;
	$chenarSpecializareAdaugare = "";
	
	$chenarIdActualizare;
	$chenarNumeActualizare = "";
	$chenarPrenumeActualizare = ""; //////////////////////
	$chenarGrupaActualizare="";
	$chenarSerieActualizare = "";
	$chenarAnActualizare;
	$chenarSpecializareActualizare = "";
	
	if (isset($_GET['idstudent'])){
		$chenarIdActualizare = $_GET['idstudent'];
		$chenarNumeActualizare = $_GET['nume'];   ////////actualizare
		$chenarPrenumeActualizare = $_GET['prenume'];
		$chenarGrupaActualizare = $_GET['grupa'];
		$chenarSerieActualizare = $_GET['serie'];
		$chenarAnActualizare = $_GET['an'];
		$chenarSpecializareActualizare = $_GET['specializare'];
	}
?>

<div class="container">
	<br></br>
	<h1>Studenti</h1>
	
	<h2><a href = "../">Inapoi</a></h2>
	
	<div class="row">
		<div class="column">
			<form action="index.php" method="post">
				<br></br>
				nume : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="text" name="nume" value="<?php echo $chenarNumeAdaugare;?>"> 
				<br></br>
				prenume : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="text" name="prenume" value="<?php echo $chenarPrenumeAdaugare;?>">
				<br></br>
				grupa : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="number" name="grupa" value="<?php echo $chenarGrupaAdaugare;?>">
				<br></br>
				serie : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="text" name="serie" value="<?php echo $chenarSerieAdaugare;?>">
				<br></br>
				an : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="number" name="an" value="<?php echo $chenarAnAdaugare;?>">
				<br></br>
				specializare : &nbsp;&nbsp;
				<input type="text" name="specializare" value="<?php echo $chenarSpecializareAdaugare;?>">
				<br></br>
				<input type="submit" name="adaugaStudent" value="Adauga Student"/>
			</form>
		</div>
		<div class="column">
			<form action="index.php" method="post">
				<br></br>
				id : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="number" name="id" value="<?php echo $chenarIdActualizare;?>" readonly >
				<br></br>
				nume : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="text" name="nume" value="<?php echo $chenarNumeActualizare;?>">
				<br></br>
				prenume : &nbsp;&nbsp;&nbsp;&nbsp;
				<input type="text" name="prenume" value="<?php echo $chenarPrenumeActualizare;?>">
				<br></br>
				grupa : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="number" name="grupa" value="<?php echo $chenarGrupaActualizare;?>">
				<br></br>
				serie : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="text" name="serie" value="<?php echo $chenarSerieActualizare;?>">
				<br></br>
				an : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="number" name="an" value="<?php echo $chenarAnActualizare;?>">
				<br></br>
				specializare : 
				<input type="text" name="specializare" value="<?php echo $chenarSpecializareActualizare;?>">
				<br></br>
				<input type="submit" name="actualizeazaStudent" value="Actualizeaza Student"/>
			</form>
		</div>
	</div>
	
	<br></br>
	<br></br>
	
	<form action="index.php" method="post">
		<input type="submit" name="incarcaStudenti" value="Incarca Studenti"/>
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

		$query = 'select * from studenti';

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
				echo "<td><a href = 'index.php?id=$row[0]'>Stergere</a> &nbsp &nbsp <a href='index.php?idstudent=$row[0]&nume=$row[1]&prenume=$row[2]&grupa=$row[3]&serie=$row[4]&an=$row[5]&specializare=$row[6]'>Pregatire actualizare</a></td>";
				echo '</tr>';
			};
			echo '</tbody></table>';
			mysqli_free_result($result);
		}
	}
	
	
	
    if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['incarcaStudenti']))
    {
		showTable($link);
	}
	
	else if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['adaugaStudent']))
	{
		$nume = $_POST['nume'];
		$prenume = $_POST['prenume'];
		$grupa = $_POST['grupa'];
		$serie = $_POST['serie'];
		$an = $_POST['an'];
		$specializare = $_POST['specializare'];
		
		$query = "INSERT INTO studenti (nume, prenume, grupa, serie, an, specializare)" 
		. " VALUES ('" . $nume . "', '" . $prenume . "', " . $grupa . " , '" . $serie 
		. "', " . $an . " , '" . $specializare . "');";
		
		if (mysqli_query($link, $query)) {
			echo "Record inserted successfully";
			echo '<br></br>';
			showTable($link);
		} else {
			echo "Error inserting record: " . mysqli_error($link);
		}
	}
	
	elseif ($_SERVER['REQUEST_METHOD'] == "GET" and isset($_GET['id'])){

		$query = "DELETE FROM studenti WHERE idstudent = " . $_GET['id'] . ";";

		if (mysqli_query($link, $query)) {
			echo "Record deleted successfully";
			echo '<br></br>';
			showTable($link);
		} else {
			echo "Error deleting record: " . mysqli_error($link);
		}
		
	}
	
	elseif ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['actualizeazaStudent'])){
		
		echo $_POST['id'];
		
		//if(chenarSpecializareActualizare != empty())
		$query = "update studenti set nume = '" . $_POST['nume'] . "', prenume = '" .  $_POST['prenume'] . "' , grupa= " 
			.  $_POST['grupa'] . ", serie= '" .  $_POST['serie'] . "', an= " .  $_POST['an'] . ", specializare= '" .  $_POST['specializare'] . "' "
			. "where idstudent = " .  $_POST['id'] . ";";

		if (mysqli_query($link, $query)) {
			echo "Record updated successfully";
			echo '<br></br>';
			showTable($link);
		} else {
			echo "Error updating record: " . mysqli_error($link);
		}
	}

	else {
		echo '<table class="table table-bordered"><thead><tr>';
		
		echo '<td><b>idstudent</b></td>';
		echo '<td><b>nume</b></td>';
		echo '<td><b>prenume</b></td>';
		echo '<td><b>grupa</b></td>';
		echo '<td><b>serie</b></td>';
		echo '<td><b>an</b></td>';
		echo '<td><b>specializare</b></td>';
		
		echo '</tr></thead>';
		echo '<tbody>';
		echo '<tr>';
		
		echo '<td></td>';
		echo '<td></td>';
		echo '<td></td>';
		echo '<td></td>';
		echo '<td></td>';
		echo '<td></td>';
		echo '<td></td>';
		
		echo '</tr>';
		echo '</tbody></table>';
	}
	
	mysqli_close($link);

?>

</div>

</body>
</html>