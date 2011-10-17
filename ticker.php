<?php 

  function ServeTicker($hostname,$last)
  {
  	  $file=fopen("users/".$hostname,"r");
  	  $now = fgets($file);
  	  $now = trim ($now );
     fclose($file); 
     $file_to_broadcast = $now ."&last=".$now;
     $next_index = "index.php?i=".$hostname."&last=".$now;
     
     $tick_timer = 30;
     if (strcmp($now,"closed.html")==0) { $tick_timer = 1000; /*Lets go a little (300x) slower :P */ } 
     
     echo  "<html> 
             <head>
              <meta http-equiv=\"refresh\" content=\"".$tick_timer.";url=ticker.php?i=".$hostname."&last=".$now."\"> 
              <script type=\"text/javascript\">
                function ticker_url()
                     {
	                    parent.document.getElementById('target').src=\"".$now."\";
                     }		
              </script>     
            </head> 
            
              "; 
              
              
     $body_arg = "";
     $status = "";
              
     if (strcmp($now,$last)!=0)
     {  
       $body_arg = "onload=\"ticker_url();\" ";
       $status = " <b>Different</b>"; // @ last was @".$last."@";       
     } else  
     {
       $status = " Same ";             
     }
    
    echo  " <body ".$body_arg." >
              <form>
                ViewLink URL : <input type=\"text\" name=\"viewlink\" size=80 value=\"".$now."\" />  ".$status."
              </form>
            </body>
           </html> ";     
  }

 

if (isset($_GET['i'])&&isset($_GET['last'])) 
 {  
  ServeTicker($_GET['i'],$_GET['last']);
 }
  else
{ echo "Nothing provided"; }
     
?>