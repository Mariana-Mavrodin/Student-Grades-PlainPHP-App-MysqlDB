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
	$chenarPartialAdaugare;
	$chenarExamenAdaugare;
	$chenarColocviuAdaugare;
	$chenarDenumireAdaugare = "";
	
	$chenarIdStudentActualizare;
	$chenarNumeActualizare = "";
	$chenarPrenumeActualizare = "";
	$chenarPartialActualizare;
	$chenarExamenActualizare;
	$chenarColocviuActualizare;
	$chenarDenumireActualizare = "";
	
	if (isset($_GET['idstudent'])){
		$chenarIdStudentActualizare = $_GET['idstudent'];
		$chenarNumeActualizare = $_GET['nume']; 
		$chenarPrenumeActualizare = $_GET['prenume'];
		$chenarPartialActualizare = $_GET['partial'];
		$chenarExamenActualizare = $_GET['examen'];
		$chenarColocviuActualizare = $_GET['colocviu'];
		$chenarDenumireActualizare = $_GET['denumire'];
	}
?>

<div class="container">
	<br></br>
	<h1>Evaluari</h1>
	<h2><a href = "../">Inapoi</a></h2>
	
	<div class="row">
		<div class="column">
			<form action="index.php" method="post">
				<br></br>
				nume : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="text" name="nume" value="<?php echo $chenarNumeAdaugare;?>">
				<br></br>
				prenume : &nbsp;&nbsp;&nbsp;
				<input type="text" name="prenume" value="<?php echo $chenarPrenumeAdaugare;?>">
				<br></br>
				partial : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="number" name="partial" value="<?php echo $chenarPartialAdaugare;?>">
				<br></br>
				examen : &nbsp;&nbsp;&nbsp;&nbsp;
				<input type="number" name="examen" value="<?php echo $chenarExamenAdaugare;?>">
				<br></br>
				colocviu : &nbsp;&nbsp;&nbsp;&nbsp;
				<input type="number" name="colocviu" value="<?php echo $chenarColocviuAdaugare;?>">
				<br></br>
				denumire : &nbsp;&nbsp;
				<input type="text" name="denumire" value="<?php echo $chenarDenumireAdaugare;?>">
				<br></br>
				<input type="submit" name="adaugaEvaluare" value="Adauga Evaluare"/>
			</form>
		</div>
		<div class="column">
			<form action="index.php" method="post">
				<br></br>
				id : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="number" name="id" value="<?php echo $chenarIdStudentActualizare;?>" readonly >
				<br></br>
				nume : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="text" name="nume" value="<?php echo $chenarNumeActualizare;?>">
				<br></br>
				prenume : &nbsp;&nbsp;&nbsp;
				<input type="text" name="prenume" value="<?php echo $chenarPrenumeActualizare;?>">
				<br></br>
				partial : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="number" name="partial" value="<?php echo $chenarPartialActualizare;?>">
				<br></br>
				examen : &nbsp;&nbsp;&nbsp;&nbsp;
				<input type="number" name="examen" value="<?php echo $chenarExamenActualizare;?>">
				<br></br>
				colocviu : &nbsp;&nbsp;&nbsp;&nbsp;
				<input type="number" name="colocviu" value="<?php echo $chenarColocviuActualizare;?>">
				<br></br>
				denumire : &nbsp;&nbsp;
				<input type="text" name="denumire" value="<?php echo $chenarDenumireActualizare;?>">
				<br></br>
				<input type="submit" name="actualizeazaEvaluare" value="Actualizeaza Evaluare"/>
			</form>
		</div>
	</div>
	
	<br></br>
	<br></br>
	
	<form action="index.php" method="post">
		<input type="submit" name="incarcaEvaluari" value="Incarca Evaluari"/>
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
			
		$query = "SELECT s.idstudent , s.nume , s.prenume , e_partial.punctajobtinut as 'partial' , e_examen.punctajobtinut as 'examen' , e_colocviu.punctajobtinut as 'colocviu', m.denumire "
					. "from evaluari e_partial "
					. "join studenti s ON e_partial.idstudent = s.idstudent "
					. "join subiecte sb_partial ON e_partial.idsubiect = sb_partial.idsubiect "
					. "join materii m ON sb_partial.idmaterie = m.idmaterie "
					. "join evaluari e_examen ON e_examen.idstudent = e_partial.idstudent "
					. "join subiecte sb_examen ON e_examen.idsubiect = sb_examen.idsubiect "
					. "join evaluari e_colocviu ON e_colocviu.idstudent = e_partial.idstudent "
					. "join subiecte sb_colocviu ON e_colocviu.idsubiect = sb_colocviu.idsubiect "
					. "where sb_partial.tip = 'partial' AND sb_partial.idmaterie = sb_examen.idmaterie AND sb_examen.tip = 'examen' "
					. "AND sb_partial.idmaterie = sb_colocviu.idmaterie AND sb_colocviu.tip = 'colocviu';";

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
				echo "<td><a href = 'index.php?id=$row[0]&denumire=$row[6]'>Stergere</a> &nbsp &nbsp <a href='index.php?idstudent=$row[0]&nume=$row[1]&prenume=$row[2]&partial=$row[3]&examen=$row[4]&colocviu=$row[5]&denumire=$row[6]'>Pregatire actualizare</a></td>";
				echo '</tr>';
			};
			echo '</tbody></table>';
			mysqli_free_result($result);
		}
	}
	
	
    if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['incarcaEvaluari']))
    {
		showTable($link);
	}
	
	else if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['adaugaEvaluare']))            						///AICI INCEPE ADAUGAREA
	{
		
		///OBTIN idMaterie
		$queryIdMaterie = "SELECT idmaterie FROM materii WHERE denumire = '" . $_POST['denumire'] . "';";   //pas 1
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
		
		///OBTIN idStudent
		$queryIdStudent = "SELECT idstudent FROM studenti WHERE nume = '" . $_POST['nume'] . "' and prenume = '" . $_POST['prenume'] . "';" ;   //pas 1
		$idStudent;
		
		$result = mysqli_query($link, $queryIdStudent);

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
					$idStudent = $c_row;
				}
			} else {
				echo "Error updating record: " . mysqli_error($link);
			}
		}
		mysqli_free_result($result);
		
		///obtin cele 3 id uri 
		
		$queryPartial = "SELECT idsubiect FROM subiecte WHERE idmaterie = " . $idMaterie . " and tip='partial';";   // pas 2.1
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
		
		$queryExamen = "SELECT idsubiect FROM subiecte WHERE idmaterie = " . $idMaterie . " and tip='examen';";  //pas 2.2
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
		
		$queryColocviu = "SELECT idsubiect FROM subiecte WHERE idmaterie = " . $idMaterie . " and tip='colocviu';";  // pas 2.3
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
		
		/////
		
		$queryAdaugarePartial = "insert into evaluari (idstudent, idsubiect, punctajobtinut)"
					. "values ( "  . $idStudent . " , " . $idSubiectPartial . " , " . $_POST['partial'] . " );";
		
		if (mysqli_query($link, $queryAdaugarePartial)) {
			echo "Record inserted successfully";
			echo '<br></br>';
		} else {
			echo "Error inserting record: " . mysqli_error($link);
		}
		
		$queryAdaugareExamen = "insert into evaluari (idstudent, idsubiect, punctajobtinut)"
					. "values ( "  . $idStudent . " , " . $idSubiectExamen . " , " . $_POST['examen'] . " );";
		
		if (mysqli_query($link, $queryAdaugareExamen)) {
			echo "Record inserted successfully";
			echo '<br></br>';
		} else {
			echo "Error inserting record: " . mysqli_error($link);
		}
		
		$queryAdaugareColocviu = "insert into evaluari (idstudent, idsubiect, punctajobtinut)"
					. "values ( "  . $idStudent . " , " . $idSubiectColocviu . " , " . $_POST['colocviu'] . " );";
		
		if (mysqli_query($link, $queryAdaugareColocviu)) {
			echo "Record inserted successfully";
			echo '<br></br>';
			showTable($link);
		} else {
			echo "Error inserting record: " . mysqli_error($link);
		}
		
	}																																	///AICI SE TERMINAA ADAUGAREA
	
	elseif ($_SERVER['REQUEST_METHOD'] == "GET" and isset($_GET['id'])){

		$query = "DELETE from evaluari WHERE idstudent = " . $_GET['id'] . " AND idsubiect IN ( SELECT idsubiect from subiecte WHERE idmaterie IN "
					. " (SELECT idmaterie from materii WHERE denumire = '" . $_GET['denumire'] . "'))";  //////// NU E BINE

		if (mysqli_query($link, $query)) {
			echo "Record deleted successfully";
			echo '<br></br>';
			showTable($link);
		} else {
			echo "Error deleting record: " . mysqli_error($link);
		}
		
	}																																		
	
	elseif ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['actualizeazaEvaluare'])){         				////ACTUALIZAREA
		
		//pas 1 : scoti idMaterie cu denumire din tabela materii
		//pas 2 : scoti 3 id subiecte pentru fiecare tip cu idMaterie potrivit
		//pas 3 : scoti cele 3 id evaluari pentru fiecare tip cu cele idSubiecte scoase
		//pas 4 : faci update de trei ori pe fiecare id evaluare
		
		$queryIdMaterie = "SELECT idmaterie FROM materii WHERE denumire = '" . $_POST['denumire'] . "';";   //pas 1
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
		
		$queryPartial = "SELECT idsubiect FROM subiecte WHERE idmaterie = " . $idMaterie . " and tip='partial';";   // pas 2.1
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
		
		$queryExamen = "SELECT idsubiect FROM subiecte WHERE idmaterie = " . $idMaterie . " and tip='examen';";  //pas 2.2
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
		
		$queryColocviu = "SELECT idsubiect FROM subiecte WHERE idmaterie = " . $idMaterie . " and tip='colocviu';";  // pas 2.3
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
		
		$queryIdEvaluarePartial = "SELECT idevaluare FROM evaluari WHERE idstudent = " . $_POST['id'] . " and idsubiect = " . $idSubiectPartial . ";";  // pas 3.1
		$idEvaluarePartial;
		
		$result = mysqli_query($link, $queryIdEvaluarePartial);
		
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
					$idEvaluarePartial = $c_row;
				}
			} else {
				echo "Error updating record: " . mysqli_error($link);
			}
		}
		mysqli_free_result($result);
		
		$queryIdEvaluareExamen = "SELECT idevaluare FROM evaluari WHERE idstudent = " . $_POST['id'] . " and idsubiect = " . $idSubiectExamen . ";";  // pas 3.2
		$idEvaluareExamen;
		
		$result = mysqli_query($link, $queryIdEvaluareExamen);
		
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
					$idEvaluareExamen = $c_row;
				}
			} else {
				echo "Error updating record: " . mysqli_error($link);
			}
		}
		mysqli_free_result($result);
		
		$queryIdEvaluareColocviu = "SELECT idevaluare FROM evaluari WHERE idstudent = " . $_POST['id'] . " and idsubiect = " . $idSubiectColocviu . ";";  // pas 3.2
		$idEvaluareColocviu;
		
		$result = mysqli_query($link, $queryIdEvaluareColocviu);
		
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
					$idEvaluareColocviu= $c_row;
				}
			} else {
				echo "Error updating record: " . mysqli_error($link);
			}
		}
		mysqli_free_result($result);
			
		$queryUpdatePartial = "update evaluari set punctajobtinut= " . $_POST['partial']
					. " where idevaluare= " . $idEvaluarePartial . ";";       														 ///pas 4.1

		if (mysqli_query($link, $queryUpdatePartial)) {
			echo "Record updated successfully";
			echo '<br></br>';
		} else {
			echo "Error updating record: " . mysqli_error($link);
		}		
		
		$queryUpdateExamen = "update evaluari set punctajobtinut= " . $_POST['examen']
					. " where idevaluare= " . $idEvaluareExamen. ";";       														 ///pas 4.2

		if (mysqli_query($link, $queryUpdateExamen)) {
			echo "Record updated successfully";
			echo '<br></br>';
		} else {
			echo "Error updating record: " . mysqli_error($link);
		}		
		
		$queryUpdateColocviu = "update evaluari set punctajobtinut= " . $_POST['colocviu']
					. " where idevaluare= " . $idEvaluareColocviu. ";";       														 ///pas 4.3

		if (mysqli_query($link, $queryUpdateColocviu)) {
			echo "Record updated successfully";
			echo '<br></br>';
			showTable($link);
		} else {
			echo "Error updating record: " . mysqli_error($link);
		}		
		
	}																																		//SFARSITUL ACTUALIZARII

	else {
		echo '<table class="table table-bordered"><thead><tr><td><b>idstudent</b></td><td><b>nume</b></td><td><b>prenume</b></td><td><b>partial</b></td><td><b>examen</b></td><td><b>colocviu</b></td><td><b>denumire</b></td><td><b>Operatiune</b></td></tr></thead><tbody><tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr></tbody></table>';
	}
	
	mysqli_close($link);

?>

</div>

</body>
</html>