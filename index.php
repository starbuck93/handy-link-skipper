<?php

  if(isset($_REQUEST['submitForm'])){
    $v = preg_match('@^(?:http://)?([^/]+)@i',$_REQUEST['shortUrl'], $matches); //need to add https
    $host = $matches[1];    
    if ($host == "www.any.gs") {
      $location = substr($_REQUEST['shortUrl'], strpos($_REQUEST['shortUrl'],"url/")+4);
      header("Location: " . $location);
    }
    else if($host == "sh.st") {
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
      $location = substr($result, $pos1,$pos2-$pos1);
      header("Location: " . $location);
    }
    else {
      header("Location: " . $_REQUEST['shortUrl']);
    } 
  }

?> 

<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <title>Handy Link Skipper</title>
  <meta name="description" content="Skips sh.st links">
  <meta name="author" content="starbuckstech.com">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css" integrity="sha384-aUGj/X2zp5rLCbBxumKTCw2Z50WgIr1vs/PFN4praOTvYXWlVyh2UtNUU0KAUhAX" crossorigin="anonymous">
  <link rel="icon" type="image/png" href="images/favicon.png">

</head>
<body>

  <!-- Primary Page Layout
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <div class="container">
    <div class="row">
      <div class="col-md-4" style="margin-top: 25%; margin-left:5%">
      <h3>Handy Link Skipper</h3>
      <br>
      <form class="form-inline" method="post" action="index.php">
        
        <div class="form-group">
          <input type="hidden" name="submitForm" value="true">
          <input class="form-control" name="shortUrl" value="" placeholder="sh.st link">
        </div>
        
        <button class="btn btn-success" type="submit">GO</button>
        
        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#instructions">
         Instructions
       </button>
        
      </form>
      
      <br>
        
        <div class="modal fade" id="instructions" tabindex="-1" role="dialog" aria-labelledby="ModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="ModalLabel">Instructions</h4>
              </div>
              <div class="modal-body">
                <p>Instructions: Paste a sh.st link (like this one: http://sh.st/bKeWP) into the box and hit go. (You can also paste any.gs links.) </p> <p>Any other links will simply be forwared to the link.</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
        
      </div>
    </div>
  </div>

<!-- End Document
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  
 <!-- Latest compiled and minified JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>

</body>
</html>
