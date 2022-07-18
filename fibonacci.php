<?php require_once("./modules/int.php"); ?>

<h1>Fibonacci</h1>
<?php
   $array = [1, 1];
   
   while(count($array) < 50) {
       $a = $array[count($array)-1];
       $b = $array[count($array)-2];
       
       $dalsi_cislo = $a + $b;
       
       $array[] = $dalsi_cislo;
       echo $dalsi_cislo."<br>";
   }
   
   dump($array);
   echo "Konec";
   die();
?>