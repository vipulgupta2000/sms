<?php
	require_once("auth.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Appraisal Management</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">

	<!--link rel="stylesheet/less" href="less/bootstrap.less" type="text/css" /-->
	<!--link rel="stylesheet/less" href="less/responsive.less" type="text/css" /-->
	<!--script src="js/less-1.3.3.min.js"></script-->
	<!--append ‘#!watch’ to the browser URL, then refresh the page. -->
<link rel="stylesheet" type="text/css" href="css/templateblue.css" />
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
  <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
  <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
  <![endif]-->

  <!-- Fav and touch icons -->
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="img/apple-touch-icon-144-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="img/apple-touch-icon-114-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="img/apple-touch-icon-72-precomposed.png">
  <link rel="apple-touch-icon-precomposed" href="img/apple-touch-icon-57-precomposed.png">
  <link rel="shortcut icon" href="img/favicon.png">

	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/scripts.js"></script>

</head>

<body>
<div class="row" id="top">
	<div class="col-md-4 col-xs-3"><img id="img" src="images/logo.png" alt="Input Zero" />
	</div>
	<div class="col-md-7 col-xs-3">
		<h2>Welcome To Intranet<h2>
	</div>
</div>
<div class="navbar navbar-default" role="navigation">
     <div class="navbar-collapse collapse">
     <div class="col-md-10"> </div>
     <ul class="nav navbar-nav">
			<li><a href="home.php?page=intranet.php">Home</a></li>
			<li><a href="logout.php">Logout</a></li>
			        <!---//<li class="dropdown">
			          //<a href="#" class="dropdown-toggle" data-toggle="dropdown">Categories<b class="caret"></b></a>
			          //<ul class="dropdown-menu">
			          //  <li><a href="#">Action</a></li>
			          //  <li><a href="#">Another action</a></li>
			          //  <li><a href="#">Something else here</a></li>
			          //  <li class="divider"></li>
			          //  <li><a href="#">Separated link</a></li>
			          //  <li class="divider"></li>
			          //  <li><a href="#">One more separated link</a></li>
			          //</ul>
        //</li> --->
                 	<?php include("lib/menu.php");  ?>

</ul>

        </div><!--/.nav-collapse -->
      </div>

	<div class="row clearfix">
		<div class="col-md-12 col-xs-12 column">

						
							<!--<div class="col-md-3 col-xs-12 column well">
							<?php //include("lib/menu.php"); ?>
				</div>-->
			
						
						<?php

							echo "<form role=\"form\" class=\"form-horizontal\" enctype=\"multipart/form-data\" name=\"form1\" id=\"frm1\" action=\"\" method=\"POST\">";
							//echo "<form role=\"form\" name=\"form1\" id=\"frm1\" action=\"\" method=\"POST\">";
							include("lib/insert.php");

							echo "</form>";
					?>
				

		

		</div>
	</div>
			<div class="panel panel-default">

				<div class="panel-footer">
					<div class="col-md-5 col-xs-12"> </div> &copy;Input Zero Technologies Pvt. Ltd
				</div>
			</div>
<script language="javascript" type="text/javascript" src="datetimepick/datetimepicker.js"></script>
<script language="javascript" type="text/javascript" >
document.forms["frm1"].chb.onchange= function(){
var j = document.getElementById("<?php echo $tbl; ?>").rows.length-1; 
for(i=0;i<j;i++) { 
				var z=document.forms["frm1"].elements["chb"+i].checked=eval(document.forms["frm1"].chb.checked);  
			}
}	
</script>
</body>
</html>
