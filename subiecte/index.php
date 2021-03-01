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
	$chenarPartialAdaugare;
	$chenarExamenAdaugare;
	$chenarColocviuAdaugare;
	
	$chenarIdMaterieActualizare;
	$chenarDenumireMaterieActualizare = "";
	$chenarPartialActualizare;
	$chenarExamenActualizare;
	$chenarColocviuActualizare;
	
	if (isset($_GET['idmaterie'])){
		$chenarIdMaterieActualizare = $_GET['idmaterie'];
		$chenarDenumireMaterieActualizare = $_GET['denumire']; 
		$chenarPartialActualizare = $_GET['partial'];
		$chenarExamenActualizare = $_GET['examen'];
		$chenarColocviuActualizare = $_GET['colocviu'];
	}
?>

<div class="container">
	<br></br>
	<h1>Subiecte</h1>
	<h2><a href = "../">Inapoi</a></h2>
	
	<div class="row">
		<div class="column">
			<form action="index.php" method="post">
				<br></br>
				denumire : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="text" name="denumire" value="<?php echo $chenarDenumireMaterieAdaugare;?>"> 
				<br></br>
				partial : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="number" name="partial" value="<?php echo $chenarPartialAdaugare;?>">
				<br></br>
				examen : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="number" name="examen" value="<?php echo $chenarExamenAdaugare;?>">
				<br></br>
				colocviu : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="number" name="colocviu" value="<?php echo $chenarColocviuAdaugare;?>">
				<br></br>
				<input type="submit" name="adaugaSubiect" value="Adauga Subiect"/>
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
				partial : &nbsp;&nbsp;;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="number" name="partial" value="<?php echo $chenarPartialActualizare;?>">
				<br></br>
				examen : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="number" name="examen" value="<?php echo $chenarExamenActualizare;?>">
				<br></br>
				colocviu : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="number" name="colocviu" value="<?php echo $chenarColocviuActualizare;?>">
				<br></br>
				<input type="submit" name="actualizeazaSubiect" value="Actualizeaza Subiect"/>
			</form>			
		</div>
	</div>	
	
	<br></br>
	<br></br>

	<form action="index.php" method="post">
		<input type="submit" name="incarcaSubiecte" value="Incarca Subiecte"/>
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

		$query = "SELECT m.idmaterie, m.denumire, s1.punctaj as 'partial', s2.punctaj as 'examen', s3.punctaj as 'colocviu' " 
			. "FROM `proiect`.`materii` as m " 
			. "JOIN `proiect`.`subiecte` as s1 on m.idmaterie = s1.idmaterie "
			. "JOIN `proiect`.`subiecte` as s2 on m.idmaterie = s2.idmaterie "
			. "JOIN `proiect`.`subiecte` as s3 on m.idmaterie = s3.idmaterie "
			. "WHERE s1.tip = 'partial' AND s2.tip = 'examen' AND s3.tip='colocviu';";

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
				echo "<td><a href = 'index.php?id=$row[0]'>Stergere</a> &nbsp &nbsp <a href='index.php?idmaterie=$row[0]&denumire=$row[1]&partial=$row[2]&examen=$row[3]&colocviu=$row[4]'>Pregatire actualizare</a></td>";
				echo '</tr>';
			};
			echo '</tbody></table>';
			mysqli_free_result($result);
		}
	}
	
	
	
    if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['incarcaSubiecte']))
    {
		showTable($link);
	}
	
	else if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['adaugaSubiect']))
	{
		
		$queryIdMaterie = "SELECT idmaterie FROM materii WHERE denumire = '"  . $_POST['denumire'] . "';";
		$idMaterie;
		
		$result = mysqli_query($link, $queryIdMaterie);

		if (!$result) 
		{
			$message = 'ERROR:' . mysqli_error($link);
			return $message;
		}
		else
		{	
			$row = mysqli_fetch_row($result);
			if($row){
				$count = count($row);
				if($count != 1){
					echo "Error updating record: " . mysqli_error($link);
				}else{
					$c_row = current($row);
					$idMaterie = $c_row;
				}
			} else {
				echo "Error updating record: " . mysqli_error($link);
			}
		}
		mysqli_free_result($result);
		
		$queryAdaugarePartial = "insert into subiecte (tip, idmaterie, punctaj) values ('Partial'," . $idMaterie . ", " . $_POST['partial'] . ");";
		
		if (mysqli_query($link, $queryAdaugarePartial)) {
			echo "Record inserted successfully";
			echo '<br></br>';
		} else {
			echo "Error inserting record: " . mysqli_error($link);
		}
		
		$queryAdaugareExamen = " insert into subiecte (tip, idmaterie, punctaj) values ('Examen'," . $idMaterie . ", " . $_POST['examen']. ");";
		
		if (mysqli_query($link, $queryAdaugareExamen)) {
			echo "Record inserted successfully";
			echo '<br></br>';
		} else {
			echo "Error inserting record: " . mysqli_error($link);
		}
		
		$queryAdaugareColocviu = " insert into subiecte (tip, idmaterie, punctaj) values ('Colocviu'," . $idMaterie . ", " . $_POST['colocviu']. ");";
		
		if (mysqli_query($link, $queryAdaugareColocviu)) {
			echo "Record inserted successfully";
			echo '<br></br>';
			showTable($link);
		} else {
			echo "Error inserting record: " . mysqli_error($link);
		}
		
	}
	
	elseif ($_SERVER['REQUEST_METHOD'] == "GET" and isset($_GET['id'])){

		$query = "delete from subiecte where idmaterie = " . $_GET['id'] . ";";

		if (mysqli_query($link, $query)) {
			echo "Record deleted successfully";
			echo '<br></br>';
			showTable($link);
		} else {
			echo "Error deleting record: " . mysqli_error($link);
		}
		
	}
	
	elseif ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['actualizeazaSubiect'])){
		
		$queryPartial = "SELECT idsubiect FROM subiecte WHERE idmaterie = " . $_POST['id'] . " and tip='partial';";
		$idSubiectPartial;
		
		$result = mysqli_query($link, $queryPartial);

		if (!$result) 
		{
			$message = 'ERROR:' . mysqli_error($link);
			return $message;
		}
		else
		{	
			$row = mysqli_fetch_row($result);
			if($row){
				$count = count($row);
				if($count != 1){
					echo "Error updating record: " . mysqli_error($link);
				}else{
					$c_row = current($row);
					$idSubiectPartial = $c_row;
				}
			} else {
				echo "Error updating record: " . mysqli_error($link);
			}
		}
		mysqli_free_result($result);
		
		$queryExamen = "SELECT idsubiect FROM subiecte WHERE idmaterie = " . $_POST['id'] . " and tip='examen';";
		$idSubiectExamen;
		
		
		$result = mysqli_query($link, $queryExamen);
		
		if (!$result) 
		{
			$message = 'ERROR:' . mysqli_error($link);
			return $message;
		}
		else
		{	
			$row = mysqli_fetch_row($result);
			if($row){
				$count = count($row);
				if($count != 1){
					echo "Error updating record: " . mysqli_error($link);
				}else{
					$c_row = current($row);
					$idSubiectExamen = $c_row;
				}
			} else {
				echo "Error updating record: " . mysqli_error($link);
			}
		}
		mysqli_free_result($result);
		
		$queryColocviu = "SELECT idsubiect FROM subiecte WHERE idmaterie = " . $_POST['id'] . " and tip='colocviu';";
		$idSubiectColocviu;
		
		$result = mysqli_query($link, $queryColocviu);
		
		if (!$result) 
		{
			$message = 'ERROR:' . mysqli_error($link);
			return $message;
		}
		else
		{	
			$row = mysqli_fetch_row($result);
			if($row){
				$count = count($row);
				if($count != 1){
					echo "Error updating record: " . mysqli_error($link);
				}else{
					$c_row = current($row);
					$idSubiectColocviu = $c_row;
				}
			} else {
				echo "Error updating record: " . mysqli_error($link);
			}
		}
		mysqli_free_result($result);
		
		$idSubiectPartialNumar = (int)$idSubiectPartial;
		$idSubiectExamenNumar = (int)$idSubiectExamen;
		$idSubiectColocviuNumar = (int)$idSubiectColocviu;
		
        $queryUpdatePartial = "UPDATE subiecte SET tip='partial', punctaj= " . $_POST['partial']
					. " WHERE idsubiect = " .  $idSubiectPartialNumar .  " ;";

		if (mysqli_query($link, $queryUpdatePartial)) {
			echo "Record updated successfully";
			echo '<br></br>';
		} else {
			echo "Error updating record: " . mysqli_error($link);
		}		
		
		$queryUpdateExamen = "UPDATE subiecte SET tip='examen', punctaj= " . $_POST['examen'] 
			. " WHERE idsubiect = " .  $idSubiectExamenNumar .  ";";

		if (mysqli_query($link, $queryUpdateExamen)) {
			echo "Record updated successfully";
			echo '<br></br>';
		} else {
			echo "Error updating record: " . mysqli_error($link);
		}		
		
		$queryUpdateColocviu = "UPDATE subiecte SET tip = 'colocviu', punctaj= " . $_POST['colocviu'] 
			. " WHERE idsubiect = " .  $idSubiectColocviuNumar .  ";";

		if (mysqli_query($link, $queryUpdateColocviu)) {
			echo "Record updated successfully";
			echo '<br></br>';
			showTable($link);
		} else {
			echo "Error updating record: " . mysqli_error($link);
		}		
		
	}

	else {
		echo '<table class="table table-bordered"><thead><tr><td><b>idmaterie</b></td><td><b>denumire</b></td><td><b>partial</b></td><td><b>examen</b></td><td><b>colocviu</b>' 
		. '</td><td><b>Operatiune</b></td></tr></thead><tbody><tr><td></td><td></td><td></td><td></td><td></td><td></td></tr></tbody></table>';
	}
	
	mysqli_close($link);

?>

</div>

</body>
</html>