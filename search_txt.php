<?php
	mysql_connect("localhost","root","root");
	mysql_select_db("sentiword");
	// SELECT * FROM dbtxt WHERE synset_term LIKE "% happy#%" OR synset_term LIKE "happy#%"
	// echo readfile("sentisample.txt");

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>SentiWord PHP v1</title>

    <!-- Bootstrap -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">	
    <style>
		legend
		{
			padding: 60px 10px;
			padding-bottom: 10px;
		}
		.hid-reset
		{
			visibility: hidden;
		}
    </style>
</head>
<body>
	<div class="row">
		<div class="container">
			<form class="form-horizontal" method="post" action="search_txt.php">
			<fieldset>

			<!-- Form Name -->
			<legend>Word Score Search</legend>

			<!-- Text input-->
			<div class="form-group">
			  <label class="col-md-4 control-label" for="search_w">Search Word</label>  
			  <div class="col-md-4">
			  <input id="search_w" name="search_w" type="text" placeholder="Type a word" class="form-control input-md" required="">
			    
			  </div>
			</div>

			<!-- Button (Double) -->
			<div class="form-group">
			  <label class="col-md-4 control-label" for="submit"></label>
			  <div class="col-md-8">
			    <button type="submit" id="submit" name="submit" class="btn btn-primary">Search</button>
			    <button type="reset" id="Reset" name="Reset" class="btn btn-default">Reset</button>
			  </div>
			</div>

			</fieldset>
			</form>
			<!-- END FORM -->
			
			<?php 
				if(isset($_POST[submit]))
				{
					$phrase_p	= $_POST['search_w'];
					$phrase_p 	= str_replace("'", "`", $phrase_p);
					$phrase_p 	= strtolower($phrase_p);
					$sql 		= "SELECT * FROM dbtxt WHERE synset_term LIKE \"% $phrase_p#%\" OR synset_term LIKE \"$phrase_p#%\"";
					$exe_sql	= mysql_query($sql);
					
					$pos_score 	= 0;
					$neg_score 	= 0;
					while($out_sql 	= mysql_fetch_array($exe_sql))
					{
						$pos_score 	+= $out_sql[pos_score];
						$neg_score 	+= $out_sql[neg_score];
					}
					$total_score 	= $pos_score - $neg_score;

					// if(empty($phrase))
					// {
					// 	$found = "Word Not Found. Try Again";
					// }
					// else
					// {
					// 	$found = "Word Found. Score is";
					// }
					$found 	= "Result";
			?>
				<h4 class="page-header text-center hid"><?php echo $found; ?></h4>
				<div class="hid" class="row">
					<div class="col-md-4 col-md-offset-4">
						<table class="table table-bordered">
							<thead>
								<th>Word</th>
								<th>Score</th>
							</thead>
							<tbody>
								<tr>
									<td><?php echo $phrase_p; ?></td>
									<td><?php echo $total_score; ?></td>
								</tr>
							</tbody>
						</table>						
					</div>
				</div>
				<!-- END ROW -->
			<?php
				} // CLOSE IF isset($_POST[submit])
				else
				{
					// SKIP Hide
				} // CLOSE Else isset($_POST[submit])
			?>
			
		</div> <!-- END CONTAINER -->
	</div> <!-- END ROW  -->


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="assets/js/jquery-1.12.0.min.js"></script>

    <!-- BS-3 JS -->
    <script src="assets/js/bootstrap.min.js"></script>	

    <script type="text/javascript">
    	$("#Reset").click(function(){
    		$(".hid").addClass("hid-reset");
    	});
    	$("#submit").click(function(){
    		$(".hid").removeClass("hid-reset");
    		//$(".hid").addClass("vis-on");
    	});    	
    </script>
</body>
</html>