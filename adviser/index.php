<?php

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Demo - Import Excel file data in mysql database using PHP, Upload Excel file data in database</title>
<meta name="description" content="This tutorial will learn how to import excel sheet data in mysql database using php. Here, first upload an excel sheet into your server and then click to import it into database. All column of excel sheet will store into your corrosponding database table."/>
<meta name="keywords" content="import excel file data in mysql, upload ecxel file in mysql, upload data, code to import excel data in mysql database, php, Mysql, Ajax, Jquery, Javascript, download, upload, upload excel file,mysql"/>
</head>
<body>

	<form name="import" method="post" enctype="multipart/form-data">
    	<input type="file" name="file" /><br />
        <input type="submit" name="submit" value="Submit" />
    </form>

<?php
include('connection.php');

	if (isset($_POST["submit"])) {
	

		set_include_path(get_include_path() . PATH_SEPARATOR . 'Classes/');
		include 'PHPExcel/IOFactory.php';

		// This is the file path to be uploaded.
		$inputFileName = $_FILES['file']['tmp_name']; 

		try {
			$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
		} catch(Exception $e) {
			die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
		}


		$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
		$arrayCount = count($allDataInSheet);  // Here get total count of row in that Excel sheet


		for($i=2;$i<=$arrayCount;$i++){
		$userName = trim($allDataInSheet[$i]["A"]);
		$userMobile = trim($allDataInSheet[$i]["B"]);


		$query = "SELECT name FROM ojttbl WHERE name = '".$userName."' and email = '".$userMobile."'";
		$sql = mysql_query($query);
		$recResult = mysql_fetch_array($sql);
		$existName = $recResult["name"];
		if($existName=="") {
		$insertTable= mysql_query("insert into ojttbl (name, email) values('".$userName."', '".$userMobile."');");


		$msg = 'Record has been added. <div style="Padding:20px 0 0 0;"><a href="">Go Back to tutorial</a></div>';
		} else {
		$msg = 'Record already exist. <div style="Padding:20px 0 0 0;"><a href="">Go Back to tutorial</a></div>';
		}
		}
		echo "<div style='font: bold 18px arial,verdana;padding: 45px 0 0 500px;'>".$msg."</div>";
	} 

?>
<body>
</html>