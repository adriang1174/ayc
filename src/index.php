<?php
        include('Cabecera.php');
?>
<script type="text/javascript">
$(document).ready(function() {
	jQuery( '#divempresa').hide();
	$( "#dialog-form" ).dialog({
			autoOpen: true,
			//height: 300,
			width: 350,
			modal: true,
			buttons: {
				"Login": function() {
						//alert($("#form1").attr('action'));
						//alert($("#empresa"));
						 var form_data = {
                				        	username: $("#username").val(),
		                  	      		password: $("#password").val(),
																	empresa:  $("#empresa").val(),
								};
						jQuery.ajax({
				                        type: "POST",
				                        url: 'doLogin.php',
				                        data: form_data,
				                        success: function(response)
				                        {
				                                //alert(response);
				                                if(response == 'success')
                                				{
				                                        $("#form1").slideUp('slow', function() {
                                				                $("#message").html("<p class='ui-state-highlight'>You have logged in successfully!</p>");
				                                        });
                                				        window.location.replace("start.php");
				                                }
				                                else
						                                if(response == 'select')
						                                {
						                                			 $("#message").html("<p class='ui-state-highlight'>Por favor seleccione la empresa con la que va a trabajar</p>");
						                                			 jQuery( '#divempresa').show();
						                                }
		                                				else
										//	$( "#dialog-form" ).dialog({height: 700 });
						                                        $("#message").html("<p class='ui-state-error ui-icon-alert'>Invalid username and/or password.</p>");   
				                        }
				                });
					},
				Cancel: function() {
					//$( this ).dialog( "close" );
					jQuery( '#username').val ('');
					jQuery( '#password').val ('');
					jQuery( '#message').hide();
					jQuery( '#divempresa').hide();
				}
			},
			close: function() {
				allFields.val( "" ).removeClass( "ui-state-error" );
			}
		});

});
</script>
</head>

<body>
<p>&nbsp;</p>

<div id="dialog-form" title="Login">
<!-- <img src="img/LogoSTARConnecting.png" alt="STAR Connecting Logo" style="width: 90%;margin: 20px;"> -->
 <div id="message"></div>

	<form action="doLogin.php" method="post" id=form1 >
	<fieldset>
		</p>
		<label for="username" class="ui-widget " style="font-weight:bold;color:#777;font-size:1.1em;">Usuario</label>
		</br>
		<input type="text" name="username" id="username" class="text ui-widget-content ui-corner-all" style="width:15em; height:1.5em; font-size:1.1em;"/>
		</p>
		<label for="password" class="ui-widget " style="font-weight:bold;color:#777;font-size:1.1em;">Clave </label>
		</br>
		<input type="password" name="password" id="password" value="" class="text ui-widget-content ui-corner-all" style="width:15em; height:1.5em; font-size:1.1em";/>
	  </p>
		<div id="divempresa">
		<label for="empresa" class="ui-widget " style="font-weight:bold;color:#777;font-size:1.1em;">Empresa </label>
		</br>
		<?php
				include('model/select_empresas.php');
		?>
		</p>
	  </div>
	</fieldset>
	</form>
</div>

</body>
</html>
