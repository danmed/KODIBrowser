<html>
<?PHP
include "config.inc.php";
$movieid = $_GET["search"];
$db_handle = mysql_connect($server, $username, $password);
$db_found  = mysql_select_db($database, $db_handle);
if ($db_found) {
    
    if(isset($_POST['update'])) {
        
     $idmovie = $_POST['idMovie'];
     $idfile = $_POST['idFile'];
     $movie_title = $_POST['title'];
     $movie_synopsis = $_POST['synopsis'];
     $movie_tagline  = $_POST['tagline'];
     $movie_rating = $_POST['rating'];
     $movie_genres = $_POST['genres'];
     $movie_director = $_POST['director'];
     $movie_studio = $_POST['studio'];
                    $sql = "UPDATE movie SET c00 = '" . $movie_title . "' WHERE idmovie = '" . $idmovie . "'" ;

            $retval = mysql_query( $sql);
            
            if(! $retval ) {
               die('Could not update data: ' . mysql_error());
            }
            echo "Updated data successfully\n";
    }
    else
    {
    
    
    
    $SQL    = "select * from movie where idMovie = '" . $movieid . "'";
    $result = mysql_query($SQL);
     while ($db_field = mysql_fetch_assoc($result)) {
     $idmovie = $db_field['idMovie'];
     $idfile = $db_field['idFile'];
     $movie_title = $db_field['c00'];
     $movie_synopsis = $db_field['c01'];
     $movie_tagline  = $db_field['c03'];
     $movie_rating = $db_field['c12'];
     $movie_genres = $db_field['c14'];
     $movie_director = $db_field['c15'];
     $movie_studio = $db_field['c18'];
     }
     
?>
<form method="post" action="<?php $_PHP_SELF ?>">
    <input type="hidden" name="idMovie" value="<?PHP print $idMovie; ?>">
<table>
<tbody>
<tr>
<td>Title</td>
<td><input type="text" name="title" value="<?PHP print $movie_title; ?>"></td>
</tr>
<tr>
<td>Synopsis</td>
    <td><textarea name="synposis" rows="10" cols="50"><?PHP print $movie_synopsis; ?></textarea></td>
</tr>
<tr>
<td>Tagline</td>
<td><input type="text" name="tagline" value="<?PHP print $movie_tagline; ?>"></td>
</tr>
<tr>
<td>Rating</td>
<td><input type="text" name="rating" value="<?PHP print $movie_rating; ?>"></td>
</tr>
<tr>
<td>Genres</td>
<td><input type="text" name="genres" value="<?PHP print $movie_genres; ?>"></td>
</tr>
<tr>
<td>Director</td>
<td><input type="text" name="director" value="<?PHP print $movie_director; ?>"></td>
</tr>
<tr>
<td>Studio</td>
<td><input type="text" name="studio" value="<?PHP print $movie_studio; ?>"></td>
</tr>
</tbody>
</table>
                           <input name = "update" type = "submit" 
                              id = "update" value = "Update">
    </form>
     
     
     
<?PHP     
    }
    mysql_close($db_handle);
} else {
    print "Database NOT Found ";
}
?>
     
     
