<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
<title> Kodi Browser </title>
        <link rel="stylesheet" title="Standard" href="styles.css" type="text/css" media="screen" />
</head>
<body>
<center>
<table border=0 cellpadding=0 cellspacing=0 width=100%>
    <tr>
        <td width=33%></td>
        <td width=33%><font face="arial" size="15">KODI BROWSER</font></td>
        <Td align=right width=33%><a href="tvshows.php"><img src="images/tvshows.png" border="0" width="30"></a></td>
    </tr>
</table>
</font><br><br>
<?PHP
include "config.inc.php";
$searchstring = $_GET["search"];
$tag          = $_GET["tag"];
$db_handle    = mysql_connect($server, $username, $password);
$db_found     = mysql_select_db($database, $db_handle);

if ($db_found) {
    If ($tag == "genre") {
        $SQL = "select * from movie_view where c14 like '%" . $searchstring . "%' ORDER BY RAND() LIMIT 30";
    } elseif ($tag == "movie") {
        $SQL = "select * from movie_view where c00 like '%" . $searchstring . "%' ORDER BY RAND() LIMIT 30";
    } elseif ($tag == "year") {
        $SQL = "select * from movie_view where premiered like '%" . $searchstring . "%' ORDER BY RAND() LIMIT 30
";
    } elseif ($tag == "rate") {
        $SQL = "select * from movie_view where rating like '%" . $searchstring . ".%' ORDER BY RAND() LIMIT 30";
    } else {
        $SQL = "select * from movie_view ORDER BY DateAdded desc LIMIT 30";
    }
    
    $result = mysql_query($SQL);
    
    while ($db_field = mysql_fetch_assoc($result)) {
        
        $imdb  = $db_field['uniqueid_value'];
        $title = $db_field['c00'];
        
        if (empty($imdb)) {
            $poster_path = "posters/blank.jpg";
        } Else {
            if (file_exists("posters/" . $imdb . ".jpg")) {
                $poster_path = "posters/" . $imdb . ".jpg";
            } Else {
                $json        = file_get_contents("https://api.themoviedb.org/3/movie/" . $imdb . "?api_key=" . $apikey);
                $info        = json_decode($json, TRUE);
                $poster      = $info['poster_path'];
                $poster_path = "http://image.tmdb.org/t/p/w92/" . $poster;
                file_put_contents("posters/" . $imdb . ".jpg", fopen($poster_path, 'r'));
            }
        }
        print "<a href='info.php?search=" . $db_field['idMovie'] . "'><img class='content' src='" . $poster_path . "' alt='" . $title . " - " . $imdb . "'/></a>";
        
    }
    
    mysql_close($db_handle);
    
} else {
    print "Database NOT Found ";
}

?>
           

        

    </div>
</div>
<?PHP
include "menu.php";
?>
</body>
</html>
