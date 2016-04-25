<?php
	mysql_connect("localhost","root","root");
	mysql_select_db("sentiword");
	// echo readfile("sentisample.txt");
	// !IMPORTANT set in php/php.ini : max_execution_time=4000
	echo "<br>LOADING<br>";

	$hashmap 			= array(); // isi hashmap = array($word=>nilai,$word=>nilai,$word=>nilai);
	$hashmap_tampung 	= array();

	$stor_all 	= array(); // sekumpulan array yang diisi stor_id
	$stor_id 	= array(); // sekumpulan array yang diisi stor_isi
	$stor_isi 	= array(); // sekumpulan array yang diisi [tipe] [pos_score] [neg_score] [arg] [word]

	// Membuka file dalam baris baris
	$arr_file = file("sentisample.txt");

	//Timing
	$mulai_time = date('h:i:sa');

	// Untuk setiap baris di dalam file
	$start 	= 50001; // Awal mulai baris
	$limit 	= 250000; // Limit jumlah baris, jika 1 maka hanya 1 baris dst. MAX 117659

	$no 	= 0; // Counter
	$start 	-= 1; // No Aware
	$limit 	+= 1;  // No Aware
	foreach ($arr_file as $key => $value) {	
		$no += 1;			
		if($no == $limit)
		{
			break; // Break
		}
		else if($no <= $start)
		{
			// Skip
		}
		else
		{
			//Jika awal kata adalah # maka lewati
			if($value[0] == "#")
			{
				//Pass
			}
			else
			{
				$pecah_per_spasi = explode("\t", $value);

					$stor_isi['tipe'] 		= $pecah_per_spasi[0];	 	//POS	
					$stor_isi['id']	 		= $pecah_per_spasi[1];        // ID
					$stor_isi['pos_score'] 	= $pecah_per_spasi[2];	// + Score					
					$stor_isi['neg_score'] 	= $pecah_per_spasi[3];   // - Score
					//addslashes untuk trouble input petik ke mysql db
					$stor_isi['word'] 		= addslashes($pecah_per_spasi[4]);   // Synset Term
					$stor_isi['arg'] 		= addslashes($pecah_per_spasi[5]); 		// Gloss replace
				
					$sql_ins 	= "INSERT INTO dbtxt VALUES(
									NULL,
									'$stor_isi[tipe]',
									'$stor_isi[id]',
									'$stor_isi[pos_score]',
									'$stor_isi[neg_score]',
									'$stor_isi[word]',
									'$stor_isi[arg]'
									)";
						// echo "<br><br>";
						mysql_query($sql_ins);							
							// $hashmap[$pecah_word_natural[0]] = $total_score;
			} // Close else $value[0]

		} // Close else limit $no		
				
	}
	// print_r($stor_all);
	// $d = 0;
	// foreach ($hashmap as $key => $value) {
	// 	// $d += 1;
	// 	// echo $d.". ".$key." = ".$value;
	// 	// echo "<br><br>";
	// 	# code...
	// }
	echo "<h1>DONE !</h1>"
	//echo "Hashmap : ".print_r($hashmap);
?>