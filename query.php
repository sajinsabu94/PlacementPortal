<?php
include('connection.php');

$list = array
(
    "Sajin",
    "Sabu",
);

$file = fopen("contacts.csv","w");

foreach ($list as $line)
{
    fputcsv($file,explode(',',$line));
}

fclose($file);
?>