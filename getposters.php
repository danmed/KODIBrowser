
<html>
<head>
<style>

* {
margin:0;
padding:0;
outline:0;
}
body {
background:#000000;
}
#scroll {
text-align:center;
width:100%;
height:180px;
margin:0px auto;
background:#000000;
border:0px solid #000;
overflow:auto;
}
#scroll div {
float:left;
text-align:center;
margin-right:-999em;
white-space:nowrap;
}
#scroll img {
margin:5px 5px 0 5px;
}
/* ------------- Flexcroll CSS ------------ */
.scrollgeneric {
line-height:1px;
font-size:1px;
position:absolute;
top:0;left:0;
}
.hscrollerbase {
height:17px;
background:#999;
}
.hscrollerbar {
height:12px;
background:#000;
cursor:e-resize;
padding:3px;
border:1px solid #999;
}
.hscrollerbar:hover {
background:#222;
border:1px solid #222;
}
#rightImage
{
    height:138px;
    width: 92px;
    margin: 10px;
    float:left;
    position:relative;

    
}
#rightImage:hover img
{
    height: 150px;
    width: 100px;
    margin: 0px;
}

</style>

<script type="text/javascript" src="flexcroll.js"></script>
</head>

<body bgcolor="black">
<?PHP

include "config.inc.php";

$db_handle = mysql_connect($server, $username, $password);
$db_found = mysql_select_db($database, $db_handle);

if ($db_found) {

$SQL = "select * from movie_view Order By c00 Asc";
$result = mysql_query($SQL);

while ( $db_field = mysql_fetch_assoc($result) ) {

$imdb = $db_field['c09'];

$json=file_get_contents("https://api.themoviedb.org/3/movie/" . $imdb . "?api_key=" . $apikey);
$info=json_decode($json, TRUE);
$poster = $info['poster_path'];
$poster_path = "http://image.tmdb.org/t/p/w92/" . $poster;

file_put_contents("posters/" . $imdb . ".jpg", fopen($poster_path, 'r'));
}

mysql_close($db_handle);

}
else {
print "Database NOT Found ";
}

?>


