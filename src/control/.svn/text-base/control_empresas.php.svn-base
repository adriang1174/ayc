<script type="text/javascript">
jQuery(document).ready(function()
	{
		jQuery('#menu1').ptMenu();
	  jQuery("#EMPRESAS").jqGrid(
		{
		height: 'auto',
		url: 'model/dbempresas.php',
		datatype: 'json',
	    	colNames:<?php include('model/empresas_colNames.php' );?>,
	    	colModel :<?php include('model/empresas_colModel.php'); ?>,
		pager: '#EMPRESASpager',
		rowNum:20,
	    	rowList:[10,20,50],
		width:1370,
		shrinkToFit: false,
    		sortname: 'Empresa',
    		sortorder: 'asc',
    		viewrecords: true,
		gridview: true,
		editurl: 'model/dbempresas.php',
    caption: 'Empresas',
		height: 'auto',
 	}); 

	jQuery("#EMPRESAS").jqGrid('navGrid',"#EMPRESASpager",
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