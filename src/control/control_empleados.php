<script type="text/javascript">
jQuery(document).ready(function()
	{
		var lastsel2
		jQuery('#menu1').ptMenu();
		$( "#fechad" ).datepicker({dateFormat: 'yy-mm-dd'});
		$( "#fechah" ).datepicker({dateFormat: 'yy-mm-dd'});
		$( "#subm" ).button();
		$( "#subm" ).click(function(){
													var form_data = {
																		fechad: $("#fechad").val(),
																		fechah: $("#fechah").val(),																		
																		ids: $("#ids").val(),
																	};
													jQuery.ajax({
																				type: "POST",
																				url: 'model/dbfechasvigencia.php',
																				data: form_data,
																				success: function(response)
																				{
																						if(response == 'OK')
																						{
																							$("#message").html("<p class='ui-state-highlight'>Vigencia actualizada exitosamente!</p>");
																							  $("#EMPLEADOS").jqGrid("setGridParam",{datatype:"json",loadonce: false}).trigger("reloadGrid");
																						}
																				}
																}) ;
										});

		jQuery("#PROVEEDORES").jqGrid(
		{
			height: 'auto',
			url: 'model/dbproveedores.php',
			datatype: 'json',
				colNames: <?php include('model/proveedores_colNames.php'); ?>,
				colModel :<?php include('model/proveedores_colModel.php'); ?>,
			pager: '#PROVEEDORESpager',
		
			rowNum:10,
			rowList:[10,20,50],
			width:1370,
			shrinkToFit: false,
			sortname: 'Proveedor',
			sortorder: 'asc',
			viewrecords: true,
			gridview: true,
			editurl: 'model/dbproveedores.php',
			caption: 'Proveedores',
			height: 'auto',
			
			onSelectRow: function(ids, status)
				{ 
						//
						
						if(ids == null) 
						{ 
							ids=0;
							if(jQuery("#EMPLEADOS").jqGrid('getGridParam','records') >0 )
							{
								var ret = jQuery("#PROVEEDORES").jqGrid('getRowData',ids);
								jQuery("#EMPLEADOS").jqGrid('setGridParam',{url:"model/dbempleados.php?id="+ids,editurl:"model/dbempleados.php?id="+ids,page:1});
								jQuery("#EMPLEADOS").jqGrid('setCaption',"Empleados de: "+ret.Proveedor)
								.trigger('reloadGrid');
							}
						} 
						else 
						{
							var ret = jQuery("#PROVEEDORES").jqGrid('getRowData',ids);
							jQuery("#EMPLEADOS").jqGrid('setGridParam',{url:"model/dbempleados.php?id="+ids,editurl:"model/dbempleados.php?id="+ids,page:1});
							jQuery("#EMPLEADOS").jqGrid('setCaption',"Empleados de: "+ret.Proveedor)
							.trigger('reloadGrid');			
						}
				},
			
			gridComplete: function () 
				{
                $('#count').html($('#PROVEEDORES').jqGrid('getGridParam','records'));
				}
		});

		jQuery("#PROVEEDORES").jqGrid('navGrid',"#PROVEEDORESpager",
						{}, //options
                        {closeAfterEdit: true,reloadAfterSubmit: true}, //edit options
                        {reloadAfterSubmit: true}, // add options
                        {reloadAfterSubmit: true}, //del options
                        {multipleSearch:true, multipleGroup:true, resize: true, drag: true, closeOnEscape: true, closeAfterReset: true, closeAfterSearch:true} // search options
                );

		$("#dialog-form2").hide("fast");
	
	jQuery("#EMPLEADOS").jqGrid(
		{
		height: 'auto',
		url:'model/dbempleados.php?id=0',
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
		editurl: 'model/dbempleados.php',
    		caption: 'Empleados',
		height: 'auto',
		multiselect: true,
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

function reload(rowid, result) {
  jQuery("#PROVEEDORES").trigger("reloadGrid"); 
}

</script>