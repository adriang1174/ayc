<?php

$options =& $_SESSION['data'];

if( !empty($attributes['submit']) ) //second step was OK 
{
  $_SESSION['data']['mapping'] = $attributes['mapping'];
  Location('index.php?step=3');
}
elseif( !empty($options['file_name']) ) //first step was OK 
{
  if( empty($options['field_separate_char']) ) //separator autodetect (comma as default)
  {
    $separator = CSV::try_separators( CSV::get_line( $options['file_name'] ) );
    if( empty( $separator ) ) {
        exit( 'No se puede autodetectar el separador de campos' );
    }
    $options['field_separate_char'] = $separator;
  }
  
    $arr_fields = get_table_fields($db, $options['table'] );
	//var_dump($arr_fields);
    if( empty( $arr_fields ) ) {
        exit( 'No se pueden extraer los campos de la tabla' );
    }
	if( $_SESSION['perfil'] == 'PROVEEDOR') {
		//Le quitamos IdProveedor de la lista de campos
		array_shift($arr_fields);
	}
  	//var_dump($arr_fields);
    $arr_headers = CSV::get_header_fields( $db, $options['file_name'], $options['encoding'], $options['field_separate_char'], $options['field_enclose_char'], $options['field_escape_char'] );
    //var_dump($arr_headers);
    if( empty( $arr_headers ) ) {
        exit( 'No se pueden recuperar las cabeceras del archivo CSV' );
    }

    $arr_examples = CSV::get_examples( $db, $options['file_name'], $options['encoding'], $options['field_separate_char'], $options['field_enclose_char'], $options['field_escape_char'] );
    if( empty( $arr_examples ) ) {
        exit( 'No se puede recuperar la primera linea del archivo CSV (ejemplo)' );
    }
  //save for 3rd step to avoid rereads
  $_SESSION['data']['table_columns'] = $arr_fields;
  $_SESSION['data']['csv_headers'] = $arr_headers;

}
else //1st step was not OK
{
  Location('index.php?step=1');
}

$fields_select = '<select name="mapping[%s]" id="select_%d"><option value="">- select -</option>';
foreach( $arr_fields as $field)
{
  $fields_select .= '<option value="'.htmlspecialchars($field).'">'.htmlspecialchars($field).'</option>';
}
$fields_select .= '</select>';