<?php  
  function ServeSite($hostname,$last,$password)
  { 
  	  $file=fopen("users/".$hostname,"r");
  	  $now = fgets($file);
  	  $now = trim ($now );
     fclose($file); 
     $file_to_broadcast = $now ."&last=".$now;
     $next_index = "index.php?i=".$hostname."&last=".$now;
     $pass_input = "";
     if ( strlen($password)>1 ) { $pass_input="&password=".$password; }
     echo "<html> 
             <head><title>View Link Service for user ".$hostname."</title></head>
             <body>    
              <iframe src=\"ticker.php?i=".$hostname.$pass_input."&last=".$now."\" width=\"100%\" height=\"50\"></iframe>
     
              <iframe   id=\"target\" name=\"target\"  src=\"".$now."\" width=\"100%\" height=\"100%\">
                 <p>Your browser does not support iframes.</p>
              </iframe> 
             </body>
           </html>" ; 
  }

 

if (isset($_GET['i'])) 
 { 
    $password = "";  
    $last_site = "#";
    if ( isset($_GET['last'])  ) { $last_site=$_GET['last']; } 
    if ( isset($_GET['password'])  ) { $password=$_GET['password']; } 
    ServeSite($_GET['i'],$last_site,$password);
 }
  else
{ echo "<html><body>No user provided</body></html>"; }
  
   
?>