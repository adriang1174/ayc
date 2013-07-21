<?php
session_start();

include("dbconfig.php");

$campos = "
[ 
					  {name:'Identificacion', width:80, index:'Identificacion', align:'right', sortable:false, editable:true, searchtype:'integer', edittype:'text', editrules:{required:true}},
					  {name:'Nombre', index:'Nombre', width:150, sortable:true, editable:true, edittype:'text'},
					  {name:'CUIL', index:'CUIL', width:80, sortable:true, editable:true, edittype:'text'},
					  {name:'Condicion', index:'Condicion', width:60, sortable:true, editable:true, edittype:'select',
							editoptions:{dataUrl: 'templates/cargaCond.php',
										 dataEvents :[
														{ type: 'change',
														  fn: function(e) {
																			var thisval = $(e.target).val();
																			//alert ('value: ' + thisval);
																			if (thisval=='Autonomo') {
																					//disable art, recibo sueldo, seguro de vida y repetición
																					$('#Poliza').val('NO'); 
																					$('#Poliza').attr('disabled', 'disabled');
																					$('#ReciboSueldo').attr('disabled', 'disabled');
																					$('#ReciboSueldo').val('NO');
																					$('#SeguroDeVida').attr('disabled', 'true');
																					$('#SeguroDeVida').val('NO');																					
																					$('#Repeticion').attr('disabled', 'true');
																					$('#Repeticion').val('NO');
																					}
																			if (thisval=='Empleado') {
																					//enable art, recibo sueldo, seguro de vida y repetición
																					//alert ('value: ' + thisval);
																					$('#Poliza').removeAttr('disabled','disabled');
																					$('#ReciboSueldo').removeAttr('disabled','disabled');
																					$('#SeguroDeVida').removeAttr('disabled','disabled');
																					$('#Repeticion').removeAttr('disabled','disabled');
																			}
															}//end func
														} // end type
													] // dataevents		
										} //end editoptions
					  },
					  {name:'F931', index:'F931', width:60, sortable:true, editable:true, edittype:'select',editoptions:{dataUrl: 'templates/cargaYN.php'}},
					  {name:'Poliza', index:'Poliza', width:60, sortable:true, editable:true, edittype:'select',editoptions:{dataUrl: 'templates/cargaYN.php'}},
					  {name:'VigenciaDesde', index:'VigenciaDesde', width:100, sortable:true, editable:true, edittype:'text',editoptions: {size: 10, maxlengh: 10,
									      dataInit: function(element) {
        								$(element).datepicker({dateFormat: 'yy-mm-dd'});
										$(element).datepicker('setDate', new Date());
      									}}},
					  {name:'VigenciaHasta', index:'VigenciaHasta', width:100, sortable:true, editable:true, edittype:'text',editoptions: {size: 10, maxlengh: 10,
									      dataInit: function(element) {
        								$(element).datepicker({dateFormat: 'yy-mm-dd'});
										$(element).datepicker('setDate', new Date());										
      									}}},
					  {name:'SeguroDeVida', index:'SeguroDeVida', width:100, sortable:true, editable:true, edittype:'select',editoptions:{dataUrl: 'templates/cargaYN.php'}},					  
					  {name:'ReciboSueldo', index:'ReciboSueldo', width:100, sortable:true, editable:true, edittype:'select',editoptions:{dataUrl: 'templates/cargaYN.php'}},					  
					  {name:'Repeticion', index:'Repeticion', width:80, sortable:true, editable:true, edittype:'select',editoptions:{dataUrl: 'templates/cargaYN.php'}},					  
					  {name:'Indemnidad', index:'Indemnidad', width:80, sortable:true, editable:true, edittype:'select',editoptions:{dataUrl: 'templates/cargaYN.php'}},					  
					  {name:'AptoIngreso', index:'AptoIngreso', width:80, sortable:true, editable:true, edittype:'select',editoptions:{dataUrl: 'templates/cargaYN.php'}},					  
					  {name:'Responsable', index:'Responsable', width:80, sortable:true, editable:true, edittype:'text'},					  
					  {name:'CentroCosto', index:'CentroCosto', width:100, sortable:true, editable:true, edittype:'text'},					  					  
"					  ;

//var_dump($_SESSION['empresa']);


if(!empty($_SESSION['empresa']))
{
						$db = mysql_connect($dbhost, $dbuser, $dbpassword) or die("Connection Error: " . mysql_error());
						mysql_select_db($database) or die("Error conecting to db.");
						$result = mysql_query("SELECT c.* FROM camposCustom c join empresas e on(c.idEmpresa = e.IdEmpresa) where e.IdEmpresa = ".$_SESSION['empresa']." order by idcampo" );
						//var_dump("SELECT c.* FROM camposCustom c join empresas e on(c.idEmpresa = e.IdEmpresa) where e.IdEmpresa = '".$_SESSION['empresa']."' order by idcampo");
						while($row = mysql_fetch_array($result,MYSQL_ASSOC)) 
						{
									//var_dump($row);
										$campos .= " {name:'".$row['nombreCampo']."', index:'".$row['nombreCampo']."', width:80, sortable:true, editable:true, edittype:'select',editoptions:{dataUrl: 'templates/cargaYN.php'}},					  
										";
						}

}

$campos .= "]";

echo $campos;
?>


