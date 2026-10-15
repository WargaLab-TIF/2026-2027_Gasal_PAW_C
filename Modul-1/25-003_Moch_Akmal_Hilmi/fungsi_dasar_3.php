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
function familyname($fname, $year) {
    return "<h3>$fname born in $year</h3>";
}

echo familyname("Hege", 1975); 
echo familyname("Stale", 1978); 
echo familyname("Kai Jim", 1983); 
?>