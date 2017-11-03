<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Thumbnail Gallery - Start Bootstrap Template</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/thumbnail-gallery.css" rel="stylesheet">

  </head>

  <body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="#">Start Bootstrap</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="#">Home
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Services</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Contact</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Page Content -->
    <div class="container">

      <h1 class="my-4 text-center text-lg-left">Thumbnail Gallery</h1>

      <div class="row text-center text-lg-left">

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
        print "<div class=\"col-lg-3 col-md-4 col-xs-6\"><a href=\"#\" class=\"d-block mb-4 h-100\"><img class=\"img-fluid img-thumbnail\" src=\"" . $poster_path . "\" alt=\"\"></a></div>";
		
        
    }
    
    mysqli_close($db_handle);
    
} else {
    print "Database NOT Found ";
}
?>
	  
	  
	  
        <div class="col-lg-3 col-md-4 col-xs-6"><a href="#" class="d-block mb-4 h-100"><img class="img-fluid img-thumbnail" src="http://placehold.it/400x300" alt=""></a></div>
        <div class="col-lg-3 col-md-4 col-xs-6">
          <a href="#" class="d-block mb-4 h-100">
            <img class="img-fluid img-thumbnail" src="http://placehold.it/400x300" alt="">
          </a>
        </div>
        <div class="col-lg-3 col-md-4 col-xs-6">
          <a href="#" class="d-block mb-4 h-100">
            <img class="img-fluid img-thumbnail" src="http://placehold.it/400x300" alt="">
          </a>
        </div>
        <div class="col-lg-3 col-md-4 col-xs-6">
          <a href="#" class="d-block mb-4 h-100">
            <img class="img-fluid img-thumbnail" src="http://placehold.it/400x300" alt="">
          </a>
        </div>
        <div class="col-lg-3 col-md-4 col-xs-6">
          <a href="#" class="d-block mb-4 h-100">
            <img class="img-fluid img-thumbnail" src="http://placehold.it/400x300" alt="">
          </a>
        </div>
        <div class="col-lg-3 col-md-4 col-xs-6">
          <a href="#" class="d-block mb-4 h-100">
            <img class="img-fluid img-thumbnail" src="http://placehold.it/400x300" alt="">
          </a>
        </div>
        <div class="col-lg-3 col-md-4 col-xs-6">
          <a href="#" class="d-block mb-4 h-100">
            <img class="img-fluid img-thumbnail" src="http://placehold.it/400x300" alt="">
          </a>
        </div>
        <div class="col-lg-3 col-md-4 col-xs-6">
          <a href="#" class="d-block mb-4 h-100">
            <img class="img-fluid img-thumbnail" src="http://placehold.it/400x300" alt="">
          </a>
        </div>
        <div class="col-lg-3 col-md-4 col-xs-6">
          <a href="#" class="d-block mb-4 h-100">
            <img class="img-fluid img-thumbnail" src="http://placehold.it/400x300" alt="">
          </a>
        </div>
        <div class="col-lg-3 col-md-4 col-xs-6">
          <a href="#" class="d-block mb-4 h-100">
            <img class="img-fluid img-thumbnail" src="http://placehold.it/400x300" alt="">
          </a>
        </div>
        <div class="col-lg-3 col-md-4 col-xs-6">
          <a href="#" class="d-block mb-4 h-100">
            <img class="img-fluid img-thumbnail" src="http://placehold.it/400x300" alt="">
          </a>
        </div>
        <div class="col-lg-3 col-md-4 col-xs-6">
          <a href="#" class="d-block mb-4 h-100">
            <img class="img-fluid img-thumbnail" src="http://placehold.it/400x300" alt="">
          </a>
        </div>
      </div>

    </div>
    <!-- /.container -->

    <!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Your Website 2017</p>
      </div>
      <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>
