<html>
<?PHP
include "class.movietrailer.php";
include "config.inc.php";
function left($str, $length)
{
    return substr($str, 0, $length);
}
$movieid   = $_GET["search"];
$db_handle = mysqli_connect($server, $username, $password);
$db_found  = mysqli_select_db($db_handle, $database);
if ($db_found) {
    $SQL     = "select * from tvshow_view where idshow = '" . $movieid . "'";
    $SQL2    = "select * from episode_view where idshow = '" . $movieid . "' ORDER BY CAST(c12 AS UNSIGNED INTEGER), CAST(c13 AS UNSIGNED INTEGER)";
    $result  = mysqli_query($db_handle, $SQL);
    $result2 = mysqli_query($db_handle, $SQL2);
    while ($row = mysqli_fetch_array($result2)) {
        $episodelist = $episodelist . "<option id='ep' value='" . $row['idEpisode'] . "'>S" . $row['c12'] . "E" . $row['c13'] . "-" . $row['c00'] . "</option>";
        $ep_location = $row['strPath'] . $row['strFilename'];
    }
    
    $episode_count = mysqli_num_rows($result2);
    while ($db_field = mysqli_fetch_assoc($result)) {
        $idfile           = $db_field['idFile'];
        $movietitle       = $db_field['c00'];
        $movietitle2      = "'" . $db_field['c00'] . "'";
        $moviedescription = $db_field['c02'] . $db_field['c01'];
        $moviemoto        = $db_field['c03'];
        $imdbrating       = "<img src='" . substr($db_field['rating'], 0, 1) . ".png'> - " . substr($db_field['rating'], 0, 3) . "/10";
        $director         = $db_field['c06'];
        $year             = substr($db_field['c05'], 0, 4);
        $year2            = "'" . $year . "'";
        $rating           = $db_field['c13'];
        $channel          = $db_field['c14'];
        $trailer          = $db_field['c19'];
        $studio           = $db_field['c14'];
        $filename         = $db_field['strFileName'];
        $location         = $db_field['strPath'];
        $imdb             = $db_field['uniqueid_value'];
        if (file_exists("fanart/" . $imdb . "-1.jpg")) {
            $fanart_path = "fanart/" . $imdb . "-1.jpg";
            $tv          = "TV Show";
        } Else {
            $fanart_path = "https://thetvdb.com/banners/fanart/original/" . $imdb . "-1.jpg";
            file_put_contents("fanart/" . $imdb . "-1.jpg", fopen($fanart_path, 'r'));
        }
        $SQL2    = "select * from streamdetails where idFile = '" . $idfile . "' AND iStreamType = '0'";
        $result2 = mysqli_query($db_handle, $SQL2);
        while ($db_field2 = mysqli_fetch_assoc($result2)) {
            $codec = $db_field2['strVideoCodec'];
        }
        
        $resolution  = explode('[', $filename);
        $resolution1 = explode(']', $resolution[1]);
        $finalres    = substr($resolution1[0], 5);
?>
<head>
    <title><?PHP
        print $movietitle;
?> </title>
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
        print "<br><br><font face='arial' color='white'><center><table class='alpha60' border='0' width='750px' cellspacing='3' cellpadding='2' bgcolor='black'><tr><td colspan='2'><font face='arial' color='#0066FF' size='6'><b><A href='http://thetvdb.com/?tab=series&id=" . $imdb . "'>" . $movietitle . "</a></b></font><font face='arial' color='white'> - " . $year . "</td></tr><tr><td width='446px'>";
        new MovieTrailer(@$movietitle2, @$year2);
        print "</td><td width='300px' valign='top'><font face='arial' color='white'><b>Channel:</b><br>" . $channel . "<br><b>Episodes:</b><br><form action='episodeinfo.php' method='get'><input type='hidden' name='show' value='" . $movieid . "'><select onchange='this.form.submit()' name='ep'><option value='List'>list</option>" . $episodelist . "</select></form><br><b>Rating:</b><br>" . $rating . "<br><b>IMDB Rating:</b><br>" . $imdbrating . "<br></td></tr><tr><td colspan='2'><font face='arial' color='white'><b>Plot:</b><br>" . $moviedescription . "</td></tr><tr><td><font face='arial' color='white'><b>Tag Line:</b><br>" . $moviemoto . " </td></tr>";
    }
    mysql_close($db_handle);
} else {
    print "Database NOT Found ";
}
?>

