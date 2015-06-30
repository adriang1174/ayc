<?php
session_start();
$prov = $_SESSION['idProveedor'];
//$prov = 4;
?>
<script type="text/javascript">
jQuery(document).ready(function()
	{
		var lastsel2
		var prov = <?php echo json_encode($prov); ?>;
		jQuery('#menu1').ptMenu();
	
	jQuery("#EMPLEADOS").jqGrid(
		{
		height: 'auto',
		url:'model/dbempleados.php?id=0&prov='+prov,
		datatype: 'json',
	    	colNames:<?php include('model/empleados_colNames.php' );?>,
	    	colModel :<?php include('model/empleados_colModel.php'); ?>,
		pager: '#EMPLEADOSpager',
	
		rowNum:20,
	    	rowList:[10,20,50],
		width:1370,
		shrinkToFit: false,
    		sortname: 'Nombre',
    		sortorder: 'asc',
    		viewrecords: true,
		gridview: true,
		editurl: 'model/dbempleados.php?prov='+prov,
    		caption: 'Empleados',
		height: 'auto',
		edit: {recreateForm: true},
	}); 

	jQuery("#EMPLEADOS").jqGrid('navGrid',"#EMPLEADOSpager",
		{}, //options 
		{closeAfterEdit: true,reloadAfterSubmit: true, width: 700}, //edit options
		{closeAfterAdd: true,reloadAfterSubmit: true, recreateForm: true}, //add options
		{reloadAfterSubmit: true}, //del options
		{multipleSearch:true, multipleGroup:true, resize: true, drag: true, closeOnEscape: true, closeAfterReset: true, closeAfterSearch:true} // search options
	);
	
});

function processAddEdit(response, postdata) {
        	var success = true;
        	var message = ""
        	var json = eval('(' + response.responseText + ')');
        	if(json.errors) {
        		success = false;
        		for(i=0; i < json.errors.length; i++) {
        			message += json.errors[i] + '<br/>';
        		}
        	}
        	var new_id = "1";
		Alert(message);
        	return [success,message,new_id];
        }


</script>