<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
<title> Kodi Browser </title>
        <link rel="stylesheet" title="Standard" href="styles.css" type="text/css" media="screen" />
</head>
<body>
<center>
<font face="arial" size="15">KODI BROWSER</font>
</font><br><br>
<?PHP
include "config.inc.php";
$searchstring = $_GET["search"];
$tag = $_GET["tag"];
$db_handle = mysql_connect($server, $username, $password);
$db_found = mysql_select_db($database, $db_handle);
if ($db_found) {
If ($tag == "genre") 
{
$SQL = "select * from movie_view where c14 like '%" . $searchstring ."%' ORDER BY RAND() LIMIT 30";
}
elseif ($tag == "movie")
{
$SQL = "select * from movie_view where c00 like '%" . $searchstring ."%' ORDER BY RAND() LIMIT 30";
}
elseif ($tag == "year")
{
$SQL = "select * from movie_view where premiered like '%" . $searchstring ."%' ORDER BY RAND() LIMIT 30
";
}
elseif ($tag == "rate")
{
$SQL = "select * from movie_view where rating like '%" . $searchstring .".%' ORDER BY RAND() LIMIT 30";
}
else
{
$SQL = "select * from tvshow_view ORDER BY DateAdded desc LIMIT 30";
}
$result = mysql_query($SQL);
while ( $db_field = mysql_fetch_assoc($result) ) {
$imdb = $db_field['uniqueid_value'];
$title = $db_field['c00'];
if (empty($imdb)) { 
$poster_path = "posters/blank.jpg";
}
    Else
    {
if (file_exists("posters/" . $imdb . "-3.jpg")) {
$poster_path = "posters/" . $imdb . "-3.jpg";
}
Else
{
$json=file_get_contents("https://thetvdb.com/api/" . $tvdbkey . "/series/" . $imdb);
$info=json_decode($json, TRUE);
$poster = $info['poster'];
$poster_path = " http://www.thetvdb.com/banners/" . $poster;
file_put_contents("posters/" . $imdb . "-3.jpg", fopen($poster_path, 'r'));
}
}
print "<a href='info.php?search=" . $db_field['idMovie'] . "'><img class='content' src='" . $poster_path . "' alt='" . $title . " - " . $imdb ."'/></a>";
}
mysql_close($db_handle);
}
else {
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
