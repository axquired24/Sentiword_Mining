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
			<legend>Sentences Score Search</legend>

			<!-- Text input-->
			<div class="form-group">
			  <label class="col-md-4 control-label" for="search_w">Search Sentences Score</label>  
			  <div class="col-md-4">
			  <input id="search_w" name="search_sen" type="text" placeholder="Type a sentences" class="form-control input-md" required="">
			    
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
					$sentences 	= $_POST['search_sen'];
					$origin_sen = $sentences;
					$sentences 	= preg_replace('/[^a-z]+/i', '__', $sentences); 
					$sentences 	= explode('__', $sentences);
					$total_score= 0;
					$per_phrase = "";

					foreach ($sentences as $phrase_p) 
					{
						$phrase_p 	= str_replace("'", "`", $phrase_p);
						$phrase_p 	= strtolower($phrase_p);
						$sql 		= "SELECT synset_term, pos_score, neg_score FROM dbtxt WHERE synset_term LIKE \"$phrase_p#%\" OR synset_term LIKE \"% $phrase_p#%\"";
						$exe_sql	= mysql_query($sql);
						$phrase 	= $phrase_p;

						$pos_score 	= 0;
						$neg_score 	= 0;
						while ($arr_sql = mysql_fetch_array($exe_sql))
						{
							$pos_score += $arr_sql[pos_score];
							$neg_score += $arr_sql[neg_score];
						}
						// $score 		= $out_sql[pos_score] - $out_sql[neg_score];

						$score 		 = $pos_score - $neg_score;						
						$per_phrase .= 	"<tr><td>".$phrase."</td>".
										"<td>".$score."</td></tr>";

						$total_score += $score;
					} // Close foreach sentence

					// Check Score is not null
					if($total_score == 0)
					{
						$found = "No Word Not Found. Try Again";
					}
					else
					{
						$found = "Word Found. Score is";
					}					
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
								<?php echo $per_phrase; ?>
								<tr class="active">
									<td><strong>Total Score</strong></td>
									<td><strong><?php echo $total_score; ?></strong></td>
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