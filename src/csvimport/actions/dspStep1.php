<div style="text-align: center"><small>
  [Paso 1 de 3] - Cargue su archivo
</small></div><hr/>

<form method="post" enctype="multipart/form-data">
  <table border="0" align="center">
    <tr>
      <td>Archivo CSV a importar:</td>
      <td rowspan="30" width="10px">&nbsp;</td>
      <td><input type="file" name="file_source" id="file_source" class="edt" value="<?=$file_source?>"></td>
    </tr>
    <tr>
      <td>El archivo CSV tiene encabezado:</td>
      <td><input type="checkbox" name="use_csv_header" id="use_csv_header" <?=(isset($_POST["use_csv_header"]) ? 'checked="checked"' : '' )?>/></td>
    </tr>
    <tr>
      <td>Caracter de separacion de columnas:</td>
      <td><input type="text" name="field_separate_char" id="field_separate_char" class="edt_30"  maxlength="1" value="<?=(""!=$_POST["field_separate_char"] ? htmlspecialchars($_POST["field_separate_char"]) : "")?>"/> <small>(leave empty for auto-detect)</small></td>
    </tr>
    <tr>
      <td>Caracter de encerrado:</td>
      <td><input type="text" name="field_enclose_char" id="field_enclose_char" class="edt_30"  maxlength="1" value="<?=(""!=$_POST["field_enclose_char"] ? htmlspecialchars($_POST["field_enclose_char"]) : htmlspecialchars("\""))?>"/></td>
    </tr>
    <tr>
      <td>Caracter de escape:</td>
      <td><input type="text" name="field_escape_char" id="field_escape_char" class="edt_30"  maxlength="1" value="<?=(""!=$_POST["field_escape_char"] ? htmlspecialchars($_POST["field_escape_char"]) : "\\")?>"/></td>
    </tr>
    <tr>
      <td>Exportar a tabla:</td>
      <td>
        <select name="table" id="table" class="edt">
          <option value="0">- select -</option>
        <?
//          if(!empty($arr_tables))
  //          foreach($arr_tables as $row)
  //            foreach($row as $table):
        ?>
          <option value="<?='empleadosAR'?>"<?= 'selected="selected"' ?>><?='empleadosAR'?></option>
          <option value="<?='proveedores'?>"><?='proveedores'?></option>
        <? //endforeach;?>
        </select>
      </td>
    </tr>
    <tr>
      <td>Codificacion:</td>
      <td>
        <select name="encoding" id="encoding" class="edt">
        <?
          if(!empty($arr_encodings))
            foreach($arr_encodings as $charset=>$description):
        ?>
          <option value="<?=$charset?>"<?=($charset == $attributes["encoding"] ? 'selected="selected"' : '')?>><?=$description?></option>
        <? endforeach;?>
        </select>
      </td>
    </tr>
    <tr>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3" align="center"><input type="Submit" name="Go" value="Cargar archivo" class="btn" onclick="var s = document.getElementById('file_source'); if(null != s && '' == s.value) {alert('Defina nombre de archivo'); s.focus(); return false;} var s = document.getElementById('table'); if(null != s && 0 == s.selectedIndex) {alert('Defina nombre de tabla'); s.focus(); return false;}"></td>
    </tr>
  </table>
</form>