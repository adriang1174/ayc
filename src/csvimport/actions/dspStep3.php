<div style="text-align: center"><small>
  [Paso 3 de 3] - Final
</small></div><hr/>

<?php echo (!empty($error) ? '<hr/><span style="font-weight: bold; color: red">Messages: ' . $error . '</span>' : '<hr/> Importación de datos exitosa!')?>

<?php echo ( empty($error) && ($fQuickCSV->rows_count) > 0 ? '<hr/>Cantidad de registros importados: ' . $fQuickCSV->rows_count  : "")?>

