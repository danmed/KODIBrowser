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
        <Td align=right width=33%><a href="index.php"><img src="images/movies.png" border="0" width="30"></a></td>
    </tr>
</table>
</font><br><br>
<?PHP
include "config.inc.php";
    include "smart_resize_image.function.php";
$searchstring = $_GET["search"];
$tag          = $_GET["tag"];
$db_handle    = mysqli_connect($server, $username, $password);
$db_found     = mysqli_select_db($db_handle, $database);
if ($db_found) {
    If ($tag == "search") {
        $SQL = "select * from tvshow_view where c00 like '%" . $searchstring . "%' ORDER BY RAND() LIMIT 30";
    } else {
        $SQL = "select * from tvshow_view ORDER BY DateAdded desc LIMIT 30";
    }
    $result = mysqli_query($db_handle, $SQL);
    while ($db_field = mysqli_fetch_assoc($result)) {
        $imdb  = $db_field['uniqueid_value'];
        $title = $db_field['c00'];
        if (empty($imdb)) {
            $poster_path = "posters/blank.jpg";
        } Else {
            if (file_exists("posters/" . $imdb . "-3.jpg") && filesize("posters/" . $imdb . "-3.jpg") > 0) {
                $poster_path = "posters/" . $imdb . "-3.jpg";
            } Else {
                $poster      = "http://www.thetvdb.com/banners/posters/" . $imdb . "-2.jpg";
                $full_poster_path = "posters/" . $imdb . "-full.jpg";
                $poster_path = "posters/" . $imdb . "-3.jpg";
                file_put_contents($full_poster_path, fopen($poster, 'r'));
                smart_resize_image($full_poster_path , null, 90 , 132 , false , $resizedFile , false , false ,100 );
                If (filesize("posters/" . $imdb . "-3.jpg") < 1) {
                    $poster_path = "posters/blank.jpg";
                }
            }
        }
        print "<a href='tvinfo.php?search=" . $db_field['idShow'] . "'><img class='content' src='" . $poster_path . "' width=90px alt='" . $title . " - " . $imdb . "'/></a>";
    }
    mysqli_close($db_handle);
} else {
    print "Database NOT Found ";
}
?>
           

        

    </div>
</div>
<?PHP
include "tvmenu.php";
?>
</body>
</html>
