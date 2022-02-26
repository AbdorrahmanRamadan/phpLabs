<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Counter Page </title>
</head>
<body>
<?php
$file = file("counter.txt");
$count = $file[0];
echo "</br><center>The number of unique users = $count</center>";
?>
</body>
</html>




