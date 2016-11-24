<?php
$domain = $_SERVER["SERVER_NAME"];
$requri = $_SERVER['REQUEST_URI'];
if (($domain == "sync.danmed.co.uk")  { 
   Header( "HTTP/1.1 301 Moved Permanently" ); 
   header("location: http://danmed.dyndns.org:8384"); 
}

else if (($domain == "uk.example.dk" && $requri == "/index.php"  ||
   $domain == "www.uk.example.dk") )  {
   Header( "HTTP/1.1 301 Moved Permanently" );    
   header("location: http://uk.example.dk/index.php/en/uk/home"); 
}

else if (($domain == "www.example.se" && $requri == "/index.php"  ||
   $domain == "example.se") )  { 
   Header( "HTTP/1.1 301 Moved Permanently" ); 
   header("location: http://example.se/index.php/sv/hem"); 
}

?>