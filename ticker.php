<?php 

  function ServeTicker($hostname,$last)
  {
  	  $file=fopen("users/".$hostname,"r");
  	  $now = fgets($file);
  	  $now = trim ($now );
     fclose($file); 
     $file_to_broadcast = $now ."&last=".$now;
     $next_index = "index.php?i=".$hostname."&last=".$now;
     echo  "<html> 
             <head>
              <meta http-equiv=\"refresh\" content=\"10;url=ticker.php?i=".$hostname."&last=".$now."\"> 
              <script type=\"text/javascript\">
                function ticker_url()
                     {
	                    parent.document.getElementById('target').src=\"".$now."\";
                     }		
              </script>     
            </head> 
            
              "; 
     if (strcmp($now,$last)!=0)
     {  
      echo " <body onload=\"ticker_url();\">
              Different : Now Is @".$now."@ last was @".$last."@ 
           ";   
     } else 
    //
    {
      echo " <body>
              Same : Now Is @".$now."@ last was @".$last."@ ";             
    }
    echo  "</body></html> ";     
  }

 

if (isset($_GET['i'])&&isset($_GET['last'])) 
 {  
  ServeTicker($_GET['i'],$_GET['last']);
 }
  else
{ echo "Nothing provided"; }
     
?>