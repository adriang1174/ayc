<script type="text/javascript">

 	
jQuery(document).ready(function()
	{
		jQuery('#menu1').ptMenu();
		jQuery.ajax({  
									type: "GET",  
									url: "model/select_empresas.php",  
									success: function(html)
									{       
														jQuery("#selectempresas").html(html);
    					 		}
    					 	});
    
    jQuery("#selectempresas").change(function() {
    																 jQuery("#FIELDS").jqGrid('setGridParam',{url:"model/dbfields.php?idEmpresa="+jQuery("#selectempresas").val(),editurl:"model/dbfields.php?idEmpresa="+jQuery("#selectempresas").val(),page:1})
    																 .trigger('reloadGrid');
    																}
    );
    
    jQuery("#FIELDS").jqGrid(
		{
		height: 'auto',
		url:'model/dbfields.php',
		datatype: 'json',
	    	colNames:<?php include('model/fields_colNames.php' );?>,
	    	colModel :<?php include('model/fields_colModel.php'); ?>,
		pager: '#FIELDSpager',
	
		rowNum:20,
	    	rowList:[10,20,50],
		width:800,
		shrinkToFit: false,
    		sortname: 'nombreCampo',
    		sortorder: 'asc',
    		viewrecords: true,
		gridview: true,
		editurl: 'model/dbfields.php',
    		caption: 'Campos',
		height: 'auto',
 	}); 

	jQuery("#FIELDS").jqGrid('navGrid',"#FIELDSpager",
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