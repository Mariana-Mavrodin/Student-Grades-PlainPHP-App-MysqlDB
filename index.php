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

<div class="container">
	<br></br>
	<h1>Bine ai venit la prezentarea proiectului PIBD !</h1>
	<br></br>
	
	<div class="row">
		<div class="column">
			<h1><a href = "studenti/">Studenti</a></h1>
			<h1><a href = "evaluari/">Evaluari</a></h1>
		</div>
		<div class="column">
			<h1><a href = "subiecte/">Subiecte</a></h1>
			<h1><a href = "materii/">Materii</a></h1>
		</div>
	</div>
	
	
</div>

</body>
</html>