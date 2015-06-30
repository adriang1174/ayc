<?php

echo"
[ 
					  {name:'IdProveedor', width:50, index:'IdProveedor', align:'right', sortable:true, editable:false, searchtype:'integer', hidden: false },
					  {name:'Proveedor', index:'Proveedor', width:450, sortable:true, editable:true, edittype:'text'},
					  {name:'Identificacion', index:'Identificacion', width:60, sortable:true, editable:true, edittype:'text'},
					  {name:'DenunciaCC', index:'DenunciaCC', width:60, sortable:true, editable:true, edittype:'select',editoptions:{dataUrl: 'templates/cargaYN.php'}},
					  {name:'RiesgoFin', index:'RiesgoFin', width:60, sortable:true, editable:true, edittype:'select',editoptions:{dataUrl: 'templates/cargaRFIN.php'}},
]";
?>


