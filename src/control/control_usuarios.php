<script type="text/javascript">
jQuery(document).ready(function()
	{
		jQuery('#menu1').ptMenu();
	  jQuery("#USUARIOS").jqGrid(
		{
		height: 'auto',
		url: 'model/dbusuarios.php',
		datatype: 'json',
	    	colNames:<?php include('model/usuarios_colNames.php' );?>,
	    	colModel :<?php include('model/usuarios_colModel.php'); ?>,
		pager: '#USUARIOSpager',
		rowNum:20,
	    	rowList:[10,20,50],
		width:1370,
		shrinkToFit: false,
    		sortname: 'usuario',
    		sortorder: 'asc',
    		viewrecords: true,
		gridview: true,
		editurl: 'model/dbusuarios.php',
    caption: 'Usuarios',
		height: 'auto',
 	}); 

	jQuery("#USUARIOS").jqGrid('navGrid',"#USUARIOSpager",
		{}, //options 
		{closeAfterEdit: true,reloadAfterSubmit: true, width: 700}, //edit options
		{closeAfterAdd: true,reloadAfterSubmit: true}, //add options
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