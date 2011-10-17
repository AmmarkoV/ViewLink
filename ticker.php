<?php 
  
  function UpdateSite($hostname,$new_site,$password)
   {
      if ( strlen($new_site) > 255 ) 
        {
          echo " Site is too long.. :S ";	 
        } else {
        { 
       	//echo " Command hostname ".$hostname." password ".$password." site ".$new_site;
   	   //$file=fopen("users/".$hostname,"w");
   	   $file=fopen("users/ammar","w");
   	   fwrite($file,$new_site);
   	   fclose($file);
   	  }  
   }   
  
  
  function ServeTicker($hostname,$last,$origin,$password)
  {
  	  $file=fopen("users/".$hostname,"r");
  	  $now = fgets($file);
  	  $now = trim ($now );
     fclose($file); 
     $file_to_broadcast = $now ."&last=".$now;
     $next_index = "index.php?i=".$hostname."&last=".$now;
     
     $tick_timer = 30;
     if (strcmp($now,"closed.html")==0) { $tick_timer = 1000; /*Lets go a little (300x) slower :P */ } 
     


    $body_arg = "";
    $status = "";
    $head_code = "<meta http-equiv=\"refresh\" content=\"".$tick_timer.";url=ticker.php?i=".$hostname."&last=".$now."\"> 
                    <script type=\"text/javascript\">
                          function target_url()
                             {
	                           parent.document.getElementById('target').src=\"".$now."\";
                             }		
                    </script>";   
    $form_code = "";
    
                        
    if ( $origin==1 )
      {   	
         // THIS IS THE ORIGIN (MASTER) PAGE , THERE IS NOW NEED FOR REFRESHING HERE , BUT WE WANT TO UPDATE Target
         $body_arg = "onload=\"target_url();\" ";
         $form_code = "<form enctype=\"multipart/form-data\" action=\"ticker.php\" method=\"POST\" >
                        <input type=\"hidden\" name=\"user_host\" value=\"".$hostname."\" />
                        <input type=\"hidden\" name=\"pass_cookie\" value=\"".$password."\" />
                        ViewLink ".$status." URL : <input type=\"text\" name=\"viewlink\" size=80 value=\"".$now."\" /> 
                        <input type=\"submit\" value=\"Go\" name=\"submit\"  />        
                        <a target=\"_blank\" href=\"".$next_index."\">Viewer Link</a>   
                       </form>                     
                       "; 
      } else 
      {  
         if (strcmp($now,$last)!=0)
          {  
            $body_arg = "onload=\"target_url();\" ";
            $status = "<b>(Different)</b>"; // @ last was @".$last."@";       
          }                
          
        $form_code = "<form>ViewLink ".$status." URL : <input type=\"text\" name=\"viewlink\" size=80 value=\"".$now."\" /></form>";   
      }      	    
     
     
     echo  "<html>
             <head>"
               .$head_code."
             </head> 
             <body ".$body_arg." >
               ".$form_code."
            </body>
           </html> ";     
  }

  


/*
   ///////////////////////////////////
            NEW PAGE ( MASTER )
   /////////////////////////////////// 
*/
if(isset($_POST['submit']))
   {
   	if (isset($_POST['user_host']) && isset($_POST['viewlink']) && isset($_POST['pass_cookie']) ) 
   	 {
         UpdateSite($_POST['user_host'],$_POST['viewlink'],$_POST['pass_cookie']);  
   	   ServeTicker($_POST['user_host'],$_POST['viewlink'],1,$_POST['pass_cookie']);  	 
   	 } else 
   	 {
   	 	echo "Not all post values provided";
   	 }  
   }
 else  
/*
   ///////////////////////////////////
               CLIENT PAGE 
   /////////////////////////////////// 
*/
if ( isset($_GET['i']) && isset($_GET['last']) ) 
 {  
   if ( isset($_GET['password']) ) 
     {  
       ServeTicker($_GET['i'],$_GET['last'],1,$_GET['password']);
     } else 
     {
       ServeTicker($_GET['i'],$_GET['last'],0,"");
     }  
 }
  else
{ echo "Nothing provided"; }
     
?>