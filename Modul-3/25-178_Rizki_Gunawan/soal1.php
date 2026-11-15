<?php
$fruits=['Avocado','Blueberry','Cherry'];
$fruits[]='Durian';
$fruits[]='Elderberry';
$fruits[]='Fig';
$fruits[]='Grape';
$fruits[]='Honeydew';
echo "1.1 Data array fruits adalah ";
foreach($fruits as $fruit){
    echo "$fruit " ;
}
echo "<br>";
echo "Dengah index array tertinggi adalah ". end($fruits);
echo "<br>";
echo "<br>";
echo "1.2 Data $fruits[1] dihapus";
unset($fruits[1]);
echo "<br>";
echo "Data array fruits setelah dihapus adalah ";
foreach($fruits as $fruit){
    echo "$fruit " ;
}
?>