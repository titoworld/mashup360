<?php
foreach($_FILES as $file) {
   $n = $file['name'];
    $s = $file['size'];
   if (is_array($n)) {
      $c = count($n);
      for ($i=0; $i < $c; $i++) {
         echo "<br>uploaded: " . $n[$i] . " (" . $s[$i] . " bytes)";
      }
   }
   else
      echo "<br>uploaded: $n ($s bytes)";
}
?>