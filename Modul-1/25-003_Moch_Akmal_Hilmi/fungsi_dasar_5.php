<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
</body>
</html>

<?php
function sum($x, $y) {
    return "<h3> $x + $y = " . ($x + $y) . " </h3>";
}
$z = sum(5, 10);
echo "<h3> $z </h3>";

$z = sum(7, 13);
echo "<h3> $z </h3>";

$z = sum(2, 4);
echo "<h3> $z </h3>";
?>