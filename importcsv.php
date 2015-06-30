<?php

$columns = "`c1` , `c2`, `c3`, `c4` ";
$handle = fopen("test.csv", "r");
while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
  foreach( $data as $v ) {
     $insertValues="'".addslashes(trim($v))."'";
  }
  $values=implode(',',$insertValues);
  $sql = "INSERT INTO `tableName` ( $columns ) VALUES ( $values )";
  mysql_query($sql) or die('SQL ERROR:'.mysql_error());
}
fclose($handle);

?>