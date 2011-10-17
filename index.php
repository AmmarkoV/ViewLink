<?php 

  
  function ServeSite($hostname,$last)
  {
  	
       	
  	
  	  $file=fopen($hostname,"r");
  	  $now = fgets($file);
  	  $now = trim ($now );
     fclose($file); 
     $file_to_broadcast = $now ."&last=".$now;
     $next_index = "index.php?i=".$hostname."&last=".$now;
   echo "  
    <html>
            <head> </head><body>    ";       
    echo "    
    <iframe src=\"ticker.php?i=".$hostname."&last=".$now."\" width=\"100%\" height=\"5%\">
    </iframe>
     
    <iframe   id=\"target\" name=\"target\"  src=\"".$now."\" width=\"100%\" height=\"100%\">
      <p>Your browser does not support iframes.</p>
    </iframe> </body></html>" ; 
  }






if (isset($_GET['i'])) 
 { 
      
    $last_site = "#";
    if ( isset($_GET['last'])  ) { $last_site=$_GET['last']; } 
  ServeSite($_GET['i'],$_GET['last']);
 }
  else
{ echo "Nothing provided"; }
  
   
?>