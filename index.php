<?php


if(isset($_REQUEST['submitForm'])){
	$v = preg_match('@^(?:http://)?([^/]+)@i',$_REQUEST['shortUrl'], $matches);
	$host = $matches[1];
	// echo "Host: " . $host ."\n";
		
	// echo $host . "\n";
	if ($host == "www.any.gs") {
		$google = substr($_REQUEST['shortUrl'], strpos($_REQUEST['shortUrl'],"url/")+4);
		// echo $google . "\n";
		header("Location: " . $google);
	}

	else {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $_REQUEST['shortUrl']);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
		curl_close($ch);	
		$needle1="<title>Redirecting to ";  	
		$needle2="</title>";  	
		$pos1 = strpos($result, $needle1);
		$pos1 = $pos1+22;
		$pos2 = strpos($result, $needle2);
		$blee = substr($result, $pos1,$pos2-$pos1);
		header("Location: " . $blee);
	}	
}



?> 

<!DOCTYPE html>
<html lang="en">
<head>

  <!-- Basic Page Needs
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <meta charset="utf-8">
  <title>Handy Link Skipper</title>
  <meta name="description" content="Skips sh.st links">
  <meta name="author" content="starbuckstech.com">

  <!-- Mobile Specific Metas
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- FONT
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">

  <!-- CSS
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/skeleton.css">

  <!-- Favicon
  –––––––––––––––––––––––––––––––––––––––––––––––––– 
  <link rel="icon" type="image/png" href="images/favicon.png">-->

</head>
<body>

  <!-- Primary Page Layout
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <div class="container">
    <div class="row">
      <div class="one-half column" style="margin-top: 25%">
      <h4>Handy Link Skipper</h4>
      <form method="post" action="index.php">
      	<input class="u-full-width" name="shortUrl" value="">
      	<input type="hidden" name="submitForm" value="true">
      	<button type="submit">GO</button>
      </form>
      </div>
    </div>
  </div>

<!-- End Document
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
</body>
</html>
