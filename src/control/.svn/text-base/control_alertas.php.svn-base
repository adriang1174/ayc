<script type="text/javascript">
jQuery(document).ready(function()
	{
		jQuery('#menu1').ptMenu();
		jQuery("#ALERTAS").jqGrid(
		{
			height: 'auto',
			url: 'model/dbalertas.php',
			datatype: 'json',
				colNames: <?php include('model/alertas_colNames.php'); ?>,
				colModel :<?php include('model/alertas_colModel.php'); ?>,
			pager: '#ALERTASpager',
		
			rowNum:10,
			rowList:[10,20,50],
			width:1370,
			shrinkToFit: false,
			sortname: 'nombreAlerta',
			sortorder: 'asc',
			viewrecords: true,
			gridview: true,
			editurl: 'model/dbalertas.php',
			caption: 'Alertas',
			height: 'auto',
			
			onSelectRow: function(ids, status)
				{ 
						//
						
						if(ids == null) 
						{ 
							ids=0;
							if(jQuery("#RECEPTORES").jqGrid('getGridParam','records') >0 )
							{
								var ret = jQuery("#ALERTAS").jqGrid('getRowData',ids);
								jQuery("#RECEPTORES").jqGrid('setGridParam',{url:"model/dbreceptores.php?idAlerta="+ids,editurl:"model/dbreceptores.php?idAlerta="+ids,page:1});
								jQuery("#RECEPTORES").jqGrid('setCaption',"Receptores de: "+ret.nombreAlerta)
								.trigger('reloadGrid');
							}
						} 
						else 
						{
							var ret = jQuery("#ALERTAS").jqGrid('getRowData',ids);
							jQuery("#RECEPTORES").jqGrid('setGridParam',{url:"model/dbreceptores.php?idAlerta="+ids,editurl:"model/dbreceptores.php?idAlerta="+ids,page:1});
							jQuery("#RECEPTORES").jqGrid('setCaption',"Receptores de: "+ret.nombreAlerta)
							.trigger('reloadGrid');			
						}
				}
		});

		jQuery("#ALERTAS").jqGrid('navGrid',"#ALERTASpager",
						{}, //options
                        {closeAfterEdit: true,reloadAfterSubmit: true}, //edit options
                        {reloadAfterSubmit: true}, // add options
                        {reloadAfterSubmit: true}, //del options
                        {multipleSearch:true, multipleGroup:true, resize: true, drag: true, closeOnEscape: true, closeAfterReset: true, closeAfterSearch:true} // search options
                );

	
	
	jQuery("#RECEPTORES").jqGrid(
		{
		height: 'auto',
		url:'model/dbreceptores.php?id=0',
		datatype: 'json',
	    	colNames:<?php include('model/alertas_receptores_colNames.php' );?>,
	    	colModel :<?php include('model/alertas_receptores_colModel.php'); ?>,
		pager: '#RECEPTORESpager',
	
		rowNum:20,
	    	rowList:[10,20,50],
		width:1370,
		shrinkToFit: false,
    		sortname: 'idalerta',
    		sortorder: 'asc',
    		viewrecords: true,
		gridview: true,
		editurl: 'model/dbreceptores.php',
    		caption: 'Receptores',
		height: 'auto',
 	}); 

	jQuery("#RECEPTORES").jqGrid('navGrid',"#RECEPTORESpager",
		{}, //options 
		{closeAfterEdit: true,reloadAfterSubmit: true, width: 1200}, //edit options
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

function reload(rowid, result) {
  jQuery("#ALERTAS").trigger("reloadGrid"); 
}

</script>