<html>
<?PHP
include "config.inc.php";
$movieid = $_GET["search"];
$db_handle = mysql_connect($server, $username, $password);
$db_found  = mysql_select_db($database, $db_handle);
if ($db_found) {
    $SQL    = "select * from movie_view where idMovie = '" . $movieid . "'";
    $result = mysql_query($SQL);
     while ($db_field = mysql_fetch_assoc($result)) {
     $idmovie = $db_field['idMovie'];
     $idfile = $db_field['idFile'];
     $movie_title = $db_field['c00'];
     $movie_synopsis = $db_field['c01'];
     $movie_tagline  = $db_field['c03'];
     $movie_rating = $db_field['c12'];
     $movie_genres = $db_field['c14'];
     $movie_director = $db_field['c14'];
     $movie_studio = $db_field['c18'];
     }
     
?>
<form>
<table>
<tbody>
<tr>
<td>Title</td>
<td><input type="text" name="firstname" value="<?PHP print $movie_title; ?>"</td>
</tr>
<tr>
<td>Synopsis</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>Tagline</td>
<td><input type="text" name="firstname"></td>
</tr>
<tr>
<td>Rating</td>
<td><input type="text" name="firstname"></td>
</tr>
<tr>
<td>Genres</td>
<td><input type="text" name="firstname"></td>
</tr>
<tr>
<td>Director</td>
<td><input type="text" name="firstname"></td>
</tr>
<tr>
<td>Studio</td>
<td><input type="text" name="firstname"></td>
</tr>
</tbody>
</table>
     
     
     
     
<?PHP     
    
    mysql_close($db_handle);
} else {
    print "Database NOT Found ";
}
?>
     
     
