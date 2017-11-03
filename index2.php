<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap.min.css">
    <style type="text/css" class="init">
    
    </style>
    <script type="text/javascript" src="/media/js/site.js?_=45ee69f7580387099dcc5163940d7394">
    </script>
    <script type="text/javascript" src="/media/js/dynamic.php?comments-page=extensions%2Fresponsive%2Fexamples%2Fstyling%2Fbootstrap.html" async>
    </script>
    <script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-1.12.4.js">
    </script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js">
    </script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js">
    </script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js">
    </script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/responsive/2.1.1/js/responsive.bootstrap.min.js">
    </script>

    <script src="js/bootstrap.min.js"></script>     

    <script type="text/javascript" class="init">
    
$(document).ready(function() {
    $('#status').DataTable({  "pageLength": <?php echo $row_count; ?>, stateSave: true });
} );
    </script>
<meta http-equiv="refresh" content="<?PHP echo $refresh; ?>">
    <title>PStatus</title>

<style>    
  .progress {
    margin-bottom: 0 !important;
    background-color: #DA2A2A;
    -webkit-box-shadow: none;
    box-shadow: none;
}
</style>

    </head>

  <body>
<div class="album text-muted">
        <div class="container">

          <div class="row">
            <div class="card">
    <?PHP
include "navbar.php";
?>
<center>
<?PHP
include "config.inc.php";
$searchstring = $_GET["search"];
$tag          = $_GET["tag"];
$db_handle    = mysqli_connect($server, $username, $password);
$db_found     = mysqli_select_db($db_handle, $database);

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
    
    $result = mysqli_query($db_handle, $SQL);
    
    while ($db_field = mysqli_fetch_assoc($result)) {
        
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
        print "<div class='card'><img data-src='" . $poster_path . "' alt='" . $title . "'></div>";
        
    }
    
    mysqli_close($db_handle);
    
} else {
    print "Database NOT Found ";
}

?>
           

      </div>
          </div>    

    </div>
</div>
</body>
</html>
