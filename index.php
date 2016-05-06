<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>SentiWord Mining</title>
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/dashboard.css">
</head>
<body>
	<?php 
		include ( "koneksi.php" );
		include ( "view/navbar.php" );		
	?>

	<div class="body container-fluid">
		<div class="row">
			<div class="col-md-8 col-xs-6 main">
				<form method="post" id="form_inp" role="form" action="index.php">
					<h2 class="page-header">Input Sentences</h2>	
					<br>			
						<!-- Multiple Radios (inline) -->
						<div class="form-group pull-right">
						  <div class="btn-group" data-toggle="buttons">
						    <label id="lang_id" class="btn btn-lg btn-default btn-noclick">
						      <input type="radio" name="lang" required> ID
						    </label>
						    <label id="lang_en" class="btn btn-lg btn-default btn-noclick">
						      <input type="radio" name="lang" required> EN
						    </label>
						  </div>            
						</div> 
					<br>										
						<div class="form-group">
							<textarea class="form-control" name="search_sen" cols="30" rows="8" placeholder="Input a sentences" required></textarea>
						</div>

						<div align="center" class="form-group">
							<input type="submit" name="submit" class="btn btn-lg btn-default" value="View Results">
						</div>
				</form>
			</div>
			<div class="col-md-4 col-xs-6 sidebar">
			<h3 class="page-header text-left">Mining Result <span class="pull-right glyphicon glyphicon-list-alt"></span></h3>
			<?php 
				$submit = $_POST[submit];
				$lang_get = $_GET[lang];				
				if( ! isset($submit))
				{
					echo "<div style='display:block; padding:10px;' class='bg-primary'> Nothing to display.</div>";
				}
				else
				{
					$sentences 	= $_POST['search_sen'];
					$origin_sen = $sentences;
					if($lang_get == "id")
					{
						// Pass Translate bahasa
					}
					else if($lang_get == "en")
					{
						// English Dict langsung pake
					}

					// Lalu jalankan perintah
					$sentences 	= preg_replace('/[^a-z]+/i', '__', $sentences); 
					$sentences 	= explode('__', $sentences);
					$total_score= 0;
					$per_phrase = "";

					// Cari nilai perkata kemudian jumlahkan
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

					
			?>
				<table class="table table-responsive">
					<thead class="bg-primary">
						<th>Sentences</th>
						<th>Score</th>
					</thead>
					<tbody>
						<?php echo $per_phrase; ?>
						<tr class="bg-info">
							<td><strong>Total Score</strong></td>
							<td><strong><?php echo $total_score; ?></strong></td>
						</tr>
					</tbody>
				</table>
			<?php
				} // Close Else ! isset
			?>
			<div align="center" class="copyright hidden-xs"> &copy; 2016 Informatika <br>Universitas Muhammadiyah Surakarta</div>
			</div> <!-- Close class="col-md-3 sidebar -->
		</div> <!-- Close container-fluid -->
	</div>
	<script type="text/javascript" src="assets/js/jquery-1.12.0.min.js"></script>
	<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
	<script>
		$("#lang_id").click(function(){
			$("#form_inp").attr({
				"action" : "index.php?lang=id"
			});			
		});
		$("#lang_en").click(function(){
			$("#form_inp").attr({
				"action" : "index.php?lang=en"
			});			
		});		
	</script>	
</body>
</html>