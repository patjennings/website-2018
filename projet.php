<!doctype html>
<html class="no-js" lang="">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title></title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" type="text/css" href="public/css/all.css" />
  <script src="public/js/jquery.min.js" type="text/javascript"></script>
  <script src="public/js/masonry.pkgd.min.js" type="text/javascript"></script>
  <script src="public/js/jquery.waypoints.min.js" type="text/javascript"></script>
  <script src="public/js/all.min.js" type="text/javascript"></script>

</head>

<body>
  <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
    <div id="preloader">
      <div class="loader" id="loader-6">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>

    <div id="wrapper">
    <div class="container-fluid">
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php">
        <img src="http://www.thomasguesnon.fr/data/files/eye_logo_dark.svg" width="30" height="30" alt="">
      </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item active">
              <a class="nav-link" href="#">Travaux <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Écrits</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">À propos</a>
            </li>
          </ul>
        </div>
      </nav>
    </div>

    <div class="container container--projet">

      <?php
      $jsonPath = file_get_contents("http://www.thomasguesnon.fr/data/portfolio.json");
      $json = json_decode($jsonPath, true);
      $id = $_GET["id"];
      $imageId = 0;

      $projet = $json[$id];


      // echo $id;

      // echo $projet['text']."<br/>";



      // var_dump($json);
      // $jsonIterator = new RecursiveIteratorIterator(new RecursiveArrayIterator($json), RecursiveIteratorIterator::SELF_FIRST);


     ?>


        <div class="container post-content" aria-label="Content">
          <div class="row projet--title">
            <div class="col-lg-8 offset-lg-2">
              <h1><?php echo($projet['title']) ?></h1>
            </div>
          </div>
          <div class="row projet--texte">
            <div class="col-lg-8 offset-lg-2">
              <p>
                <?php echo($projet['text']) ?>
              </p>
            </div>
          </div>

          <?php
    foreach($projet['images'] as $image){
      $output = '<div class="row projet--image" id="item-'.$imageId.'">';
        $output .= '<div class="col-lg-12">';
          $output .= '<img src="'.$image['path'].'" width="100%"/>';
        $output .= '</div>';
      $output .= '</div>';
      echo $output;
      $imageId++;
    }
    ?>

        </div>
    </div>
  </div>
</body>

</html>
