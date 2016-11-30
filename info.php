
<html>
<?PHP
include "class.movietrailer.php";
include "config.inc.php";

function left($str, $length)
{
    return substr($str, 0, $length);
}
$movieid = $_GET["search"];

$db_handle = mysql_connect($server, $username, $password);
$db_found  = mysql_select_db($database, $db_handle);

if ($db_found) {
    $SQL    = "select * from movie_view where idMovie = '" . $movieid . "'";
    $result = mysql_query($SQL);
    
    while ($db_field = mysql_fetch_assoc($result)) {
        $idfile           = $db_field['idFile'];
        $movietitle       = $db_field['c00'];
        $movietitle2      = "'" . $db_field['c00'] . "'";
        $moviedescription = $db_field['c02'] . $db_field['c01'];
        $moviemoto        = $db_field['c03'];
        $imdbrating       = "<img src='" . substr($db_field['rating'], 0, 1) . ".png'> - " . substr($db_field['rating'], 0, 3) . "/10";
        $director         = $db_field['c06'];
        $year             = substr($db_field['premiered'], 0, 4);
        $year2            = "'" . $year . "'";
        $rating           = $db_field['c12'];
        $genre            = $db_field['c14'];
        $trailer          = $db_field['c19'];
        $studio           = $db_field['c18'];
        $filename         = $db_field['strFileName'];
        $location         = $db_field['strPath'];
        
        $imdb = $db_field['uniqueid_value'];
        if (file_exists("fanart/" . $imdb . ".jpg")) {
            $fanart_path = "fanart/" . $imdb . ".jpg";
        } Else {
            $json        = file_get_contents("https://api.themoviedb.org/3/movie/" . $imdb . "?api_key=" . $apikey);
            $info        = json_decode($json, TRUE);
            $fanart      = $info['backdrop_path'];
            $fanart_path = "http://image.tmdb.org/t/p/original/" . $fanart;
            file_put_contents("fanart/" . $imdb . ".jpg", fopen($fanart_path, 'r'));
        }
        
        $SQL2    = "select * from streamdetails where idFile = '" . $idfile . "' AND iStreamType = '0'";
        $result2 = mysql_query($SQL2);
        
        while ($db_field2 = mysql_fetch_assoc($result2)) {
            $codec = $db_field2['strVideoCodec'];
            $finalres = $db_field2['iVideoWidth'];
            $length = ($db_field2['iVideoDuration'] / 60);
        }
        
?>
<head>
<style>
.alpha60 {
/* Fallback for web browsers that doesn't support RGBa */
background: rgb(0, 0, 0);
/* RGBa with 0.6 opacity */
background: rgba(0, 0, 0, 0.6);
}
table
{
border:2px solid;
border-radius:25px;
-moz-border-radius:25px; /* Old Firefox */
}
a:link{color:white}
a:visited{color:white}
a:link{text-decoration:none}

{ margin: 0; padding: 0; }

html {
background: url('<?PHP
        print $fanart_path;
?>') no-repeat center center fixed;
-webkit-background-size: cover;
-moz-background-size: cover;
-o-background-size: cover;
background-size: cover;
} 

</style>
 
<script type="text/javascript" src="js/jquery.js"></script>

<link rel="stylesheet" type="text/css" href="js/fancybox/jquery.fancybox-1.2.6.css" media="screen" />
    <script type="text/javascript" src="js/fancybox/jquery.fancybox-1.2.6.js"></script>


    <script type="text/javascript">
        $(document).ready(function() {
            $("a.zoom").fancybox();

            $("a.zoom1").fancybox({
                'overlayOpacity'    :    0.7,
                'overlayColor'        :    '#000'
            });

            $("a.zoom2").fancybox({
                'zoomSpeedIn'        :    500,
                'zoomSpeedOut'        :    500
            });
        });
    </script>
    </head>
<?PHP
        
        print "<br><br><font face='arial' color='white'><center><table class='alpha60' border='0' width='750px' cellspacing='3' cellpadding='2' bgcolor='black'><tr><td colspan='2'><font face='arial' color='#0066FF' size='6'><b><A href='http://www.imdb.com/title/" . $imdb . "'>" . $movietitle . "</a></b></font><font face='arial' color='white'> - " . $year . "</td></tr><tr><td width='446px'>";
        new MovieTrailer(@$movietitle2, @$year2);
        print "</td><td width='300px' valign='top'><font face='arial' color='white'><b>Director:</b><br>" . $director . "<br><b>Genre:</b><br>" . $genre . "<br><b>Rating:</b><br>" . $rating . "<br><b>Resolution</b><br>" . $finalres . "<br><b>Duration</b><br>" . $length . "<br><b>Codec</b><br>" . $codec . "<br><b>IMDB Rating:</b><br>" . $imdbrating . "<br><b>Play Movie</b><br><a href='http://" . $xbmc2 . "/jsonrpc?request={ \"jsonrpc\": \"2.0\", \"method\": \"Player.Open\", \"params\": { \"item\": { \"file\": \"" . $location . $filename . "\" } }, \"id\": 1 }'>" . $xbmc2label . "</a> | <a href='http://" . $xbmc1 . "/jsonrpc?request={ \"jsonrpc\": \"2.0\", \"method\": \"Player.Open\", \"params\": { \"item\": { \"file\": \"" . $location . $filename . "\" } }, \"id\": 1 }'>" . $xbmc1label . "</a></td></tr><tr><td colspan='2'><font face='arial' color='white'><b>Plot:</b><br>" . $moviedescription . "</td></tr><tr><td><font face='arial' color='white'><b>Tag Line:</b><br>" . $moviemoto . " </td></tr>";
        
        
        
        
    }
    mysql_close($db_handle);
} else {
    print "Database NOT Found ";
}

?>
