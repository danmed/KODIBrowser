<html>
<?PHP
include "config.inc.php";
$movieid = $_GET["search"];
$db_handle = mysql_connect($server, $username, $password);
$db_found  = mysql_select_db($database, $db_handle);
if ($db_found) {
    
    if(isset($_POST['update'])) {
        
     $idmovie = mysql_real_escape_string($_POST['idMovie']);
     $idfile = mysql_real_escape_string($_POST['idFile']);
     $movie_title = mysql_real_escape_string($_POST['title']);
     $movie_synopsis = mysql_real_escape_string($_POST['synopsis']);
     $movie_tagline  = mysql_real_escape_string($_POST['tagline']);
     $movie_rating = mysql_real_escape_string($_POST['rating']);
     $movie_genres = mysql_real_escape_string($_POST['genres']);
     $movie_director = mysql_real_escape_string($_POST['director']);
     $movie_studio = mysql_real_escape_string($_POST['studio']);
                    $sql = "UPDATE movie SET c00 = '" . $movie_title . "', c01 = '" . $movie_synopsis . "', c03 = '" . $movie_tagline . "', c12 = '" . $movie_rating . "', c14 = '" . $movie_genres . "', c15 = '" . $movie_director . "', c18 = '" . $movie_studio . "' WHERE idmovie = '" . $idmovie . "'" ;

            $retval = mysql_query( $sql);
            
            if(! $retval ) {
               die('Could not update data: ' . mysql_error());
            }
            echo "Movie data updated successfully\n";
    }
    else
    {
    
    
    
    $SQL    = "select * from movie where idMovie = '" . $movieid . "'";
    $result = mysql_query($SQL);
     while ($db_field = mysql_fetch_assoc($result)) {
     $movie_title = $db_field['c00'];
     $movie_synopsis = $db_field['c01'];
     $movie_tagline  = $db_field['c03'];
     $movie_rating = $db_field['c12'];
     $movie_genres = $db_field['c14'];
     $movie_director = $db_field['c15'];
     $movie_studio = $db_field['c18'];
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
    
    <br><br><font face='arial' color='white'><center>
<form method="post" action="<?php $_PHP_SELF ?>">
    <input type="hidden" name="idMovie" value="<?PHP print $movieid; ?>">
    
<table class='alpha60' border='0' width='750px' cellspacing='3' cellpadding='2' bgcolor='black'>
<tbody>
<tr>
<td>Title</td>
<td><input type="text" name="title" value="<?PHP print $movie_title; ?>"></td>
</tr>
<tr>
<td>Synopsis</td>
    <td><input type="text" name="synopsis" value="<?PHP print $movie_synopsis; ?>"></td>
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
     
     
