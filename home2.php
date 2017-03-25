
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Salary Management</title>
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
		<h2>Welcome To Salary Management<h2>
	</div>
</div>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="tabbable" id="tabs-573438">
				<ul class="nav nav-tabs">
					<li class="active">
						<a href="#panel-87878" data-toggle="tab">Section 1</a>
					</li>
					<li>
						<a href="#panel-560148" data-toggle="tab">Section 2</a>
					</li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="panel-87878">
						<p>
							Hi Ankul
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        Hello Ankul
						</p>
                                                	<p>
							Hi Ankul
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        Hello Ankul
						</p>
                        <div class="row">
				<div class="col-md-6">
					<form role="form">
						<div class="form-group">
							 
							<label for="exampleInputEmail1">
								Email address
							</label>
							<input type="email" class="form-control" id="exampleInputEmail1" />
						</div>
						<div class="form-group">
							 
							<label for="exampleInputPassword1">
								Password
							</label>
							<input type="password" class="form-control" id="exampleInputPassword1" />
						</div>
						<div class="form-group">
							 
							<label for="exampleInputFile">
								File input
							</label>
							<input type="file" id="exampleInputFile" />
							<p class="help-block">
								Example block-level help text here.
							</p>
						</div>
						<div class="checkbox">
							 
							<label>
								<input type="checkbox" /> Check me out
							</label>
						</div> 
						<button type="submit" class="btn btn-default">
							Submit
						</button>
					</form>
				</div>
				<div class="col-md-6">
				</div>
			</div>

					</div>
					<div class="tab-pane" id="panel-560148">
						<p>
							Howdy, I'm in Section 2.
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
			<div class="panel panel-default">

				<div class="panel-footer">
					<div class="col-md-5 col-xs-12"> </div> &copy;Input Zero Technologies Pvt. Ltd
				</div>
			</div>
<script language="javascript" type="text/javascript" src="datetimepick/datetimepicker.js"></script>
<script language="javascript" type="text/javascript" src="script/xml.js"></script>
<script language="javascript" type="text/javascript" src="script/basic.js"></script>
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
