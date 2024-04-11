<?php
include('connection.php');

$A = GSecureSQL::query(
    "SELECT * FROM admintbl",
    TRUE
);

foreach($A as $value){
    $b = $value[0];
    $c = $value[1];
    $d = $value[2];
    $e = $value[3];
    $f = $value[4];
    ?>
    <h3><?php echo $b; ?></h3><br>
    <h3><?php echo $c; ?></h3><br>
    <h3><?php echo $d; ?></h3><br>
    <h3><?php echo $e; ?></h3><br>
    <h3><?php echo $f; ?></h3><br>
<?php
}
?>