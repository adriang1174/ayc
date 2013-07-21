<?php

echo"
[ 
					  {name:'idalerta', width:80, index:'idalerta', align:'right', sortable:false, editable:false, searchtype:'integer', hidden: true },
					  {name:'nombreAlerta', index:'nombreAlerta', width:450, sortable:true, editable:true, edittype:'text'},
					  {name:'tipoAlerta', index:'tipoAlerta', width:80, sortable:true, editable:true, edittype:'text'},
					  {name:'idEmpresa', index:'idEmpresa', width:180, sortable:true, editable:true, edittype:'select',editoptions:{dataUrl: 'model/select_empresas.php'}},
]";
?>


