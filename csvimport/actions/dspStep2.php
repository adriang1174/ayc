<!--
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.min.js"></script>

<script type="text/javascript">
function automap() {
    $('td.header').each( function() {
        var num = $(this).attr('num');
        $('#select_' + num).val( $(this).html().toLowerCase() );
    } );
}
</script>
-->

<div style="text-align: center"><small>
  [Paso 2 de 3] - Defina mapeo de columnas
</small></div><hr/>

<?php echo (!empty($error) ? '<hr/><span style="font-weight: bold; color: red">Messages: ' . $error . '</span>' : "")?>

<form method="post">
  <table border="1" align="center">
    <tr>
      <th>Columna de la tabla en la base de datos <br/><input type="button" value="Auto-map" class="auto-map" onclick="automap()"/></th>
      <th>Encabezado CSV</th>
      <th>Linea ejemplo del CSV</th>
    </tr>
    <?php $k=0; foreach($arr_headers as $i=>$header) :?>
    <tr>
      <td><?php echo sprintf( $fields_select, htmlspecialchars( $header ), $k )?></td>
      <td class="header" num="<?=$k++?>"><?php echo htmlspecialchars( strtolower( trim( $header )))?></td>
      <td><i><?php echo htmlspecialchars( $arr_examples[$i] )?></i></td>
    </tr>
    <?php endforeach;?>
  </table>
  <br/>
  <div style="text-align: center">
    <input type="submit" name="submit" class="btn" value="Listo. Importar a base de datos" />
  </div>
</form>