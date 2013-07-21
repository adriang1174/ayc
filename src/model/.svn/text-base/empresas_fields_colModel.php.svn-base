<?php

echo"
[ 
					  {name:'IdEmpresa', width:80, index:'IdEmpresa', align:'right', sortable:false, editable:false, searchtype:'integer', hidden: true },
				    {name:'Empresa',index:'Empresa',width:150, editable: true, edittype:'select', editoptions:{value:'bkflag:bkflag;bkchapter:bkchapter;proptype:proptype', dataEvents :[{type:'change', fn:function(e){
                                                                                                                    alert('yo');
                                                                                                                    var thisval = $(e.target).val();
                                                                                                                    alert(thisval);
                                                                                                                    lookupField(thisval, subgrid_table_id, row_id);
                                                                                                                    }}]}
                        },
]";
?>


