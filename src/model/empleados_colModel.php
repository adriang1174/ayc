<?php

echo"
[ 
					  {name:'Identificacion', width:80, index:'Identificacion', align:'right', sortable:false, editable:false, searchtype:'integer', hidden: true },
					  {name:'Nombre', index:'Nombre', width:150, sortable:true, editable:true, edittype:'text'},
					  {name:'CUIL', index:'CUIL', width:80, sortable:true, editable:true, edittype:'text'},
					  {name:'Condicion', index:'Condicion', width:60, sortable:true, editable:true, edittype:'select',editoptions:{dataUrl: 'templates/cargaYN.php'}},
					  {name:'F931', index:'F931', width:60, sortable:true, editable:true, edittype:'select',editoptions:{dataUrl: 'templates/cargaYN.php'}},
					  {name:'Poliza', index:'Poliza', width:60, sortable:true, editable:true, edittype:'select',editoptions:{dataUrl: 'templates/cargaYN.php'}},
					  {name:'VigenciaDesde', index:'VigenciaDesde', width:100, sortable:true, editable:true, edittype:'text',editoptions: {size: 10, maxlengh: 10,
									      dataInit: function(element) {
        								$(element).datepicker({dateFormat: 'yy-mm-dd'})
      									}}},
					  {name:'VigenciaHasta', index:'VigenciaHasta', width:100, sortable:true, editable:true, edittype:'text',editoptions: {size: 10, maxlengh: 10,
									      dataInit: function(element) {
        								$(element).datepicker({dateFormat: 'yy-mm-dd'})
      									}}},
					  {name:'SeguroDeVida', index:'SeguroDeVida', width:100, sortable:true, editable:true, edittype:'select',editoptions:{dataUrl: 'templates/cargaYN.php'}},					  
					  {name:'ReciboSueldo', index:'ReciboSueldo', width:100, sortable:true, editable:true, edittype:'select',editoptions:{dataUrl: 'templates/cargaYN.php'}},					  
					  {name:'Repeticion', index:'Repeticion', width:80, sortable:true, editable:true, edittype:'select',editoptions:{dataUrl: 'templates/cargaYN.php'}},					  
					  {name:'Indemnidad', index:'Indemnidad', width:80, sortable:true, editable:true, edittype:'select',editoptions:{dataUrl: 'templates/cargaYN.php'}},					  
					  {name:'AptoIngreso', index:'AptoIngreso', width:80, sortable:true, editable:true, edittype:'select',editoptions:{dataUrl: 'templates/cargaYN.php'}},					  
					  {name:'Responsable', index:'Responsable', width:80, sortable:true, editable:true, edittype:'text'},					  
					  {name:'CentroCosto', index:'CentroCosto', width:100, sortable:true, editable:true, edittype:'text'},					  					  
]";
?>


