<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPEED</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/modern-normalize/1.0.0/modern-normalize.min.css">
    <link rel="stylesheet" href="./css/style.css"> 
</head>
<body>
    <?php
    $input_value = $_REQUEST["input_value"];
    $input_measure = $_REQUEST["input_measure"];
    $output_measure = $_REQUEST["output_measure"];
    $data = array(
      "km_hour" => array(1000,0.001),
      "m_hour" => array(1,1),
      "mil_hour" => array(1609.34,1.60934)
    );
    $output = $input_value * $data[$input_measure][0] * $data[$output_measure][1];
  ?>
  <form class="decor" action="./index.php" method="POST">
	  	<div class="form-left-decoration"></div>
		<div class="form-right-decoration"></div>
		<div class="circle"></div>
		<div class="form-inner">
	  <p>Input:</p> <input type="number" min = "0" max = "1000000" step = "0.1" name="input_value" value = "<?php echo $input_value; ?>" required>
	  </br>
	  <p>From Type Data:</p> <select class="select_from" name="input_measure">
	  <?php
	   foreach ($data as $key => $value){
	      echo "<option value=".$key." ";
	      if ($input_measure == $key) {
	        echo "selected";
	      }
	      echo ">".$key."</option>";
	  } 
	  ?>
	  </select>
	  <br>
	  <p>To Type Data:</p> <select class="select_to" name="output_measure">
	  <?php
	  foreach ($data as $key => $value){
	    echo "<option value=".$key." ";
	    if ($output_measure == $key) {
	      echo "selected";
	    }
	    echo ">".$key."</option>";
	  } 
	  ?>
	  </select>
	  <br>
	  <input type = "submit" value = "calculate" class="submit-button"> <br>
	  <p>Output:</p><input class="output" type="number" min = "0" max = "1000000" step = "0.1" name="output" value = "<?php echo $output; ?>" readonly="readonly"></br>
  </form> 
  <?php

  if (isset($_SESSION['data'])) {
  		$data = $_SESSION['data'];
  } else {
  		$data = array();
  }
  $data[time()] = $input_value." ".$input_measure." "." = ".$output." ".$output_measure;

  $_SESSION['data'] = $data;
  print_r($_SESSION);
  ?>
</body>
</html>