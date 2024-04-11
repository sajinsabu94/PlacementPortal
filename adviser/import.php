<?php
include("../connection.php");

if (isset($_POST["Import"])) {
    $file = $_FILES['file']['tmp_name'];
    $handle = fopen($file, "r");
    $c = 0;
    while (($filesop = fgetcsv($handle, 1000, ",")) !== false) {
        $StudentID = $filesop[1];
        $LastName = $filesop[2];
        $FirstName = $filesop[3];
        $MiddleName = $filesop[4];
        $Course = $filesop[5];
        $CompanyName = $filesop[6];
        $CompanyAddress = $filesop[7];
        $Supervisor = $filesop[8];
        $Position = $filesop[9];
        $ContactNumber = $filesop[10];

        $sql =
            GSecureSQL::query(
                "INSERT INTO ojttbl (
					StudentID,
					LastName,
					FirstName,
					MiddleName,
					Course,
					CompanyName,
					CompanyAddress,
					Position,
					ContactNumber)
					VALUES (?,?,?,?,?,?,?,?,?,?)",
                FALSE,
                "ssssssssss",
                $LastName,
                $FirstName,
                $MiddleName,
                $Course,
                $CompanyName,
                $CompanyAddress,
                $Supervisor,
                $Position,
                $ContactNumber

            );
        $c = $c + 1;
    }

    if ($sql) {
        echo "You database has imported successfully. You have inserted " . $c . " records";
    } else {
        echo "Sorry! There is some problem.";
    }

}
?>		 