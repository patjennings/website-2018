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

  <div class="container-fluid container--home">
    <div class="grid">
      <div class="grid-sizer"></div>

    <?php
      $jsonPath = file_get_contents("http://www.thomasguesnon.fr/data/portfolio.json");
      $json = json_decode($jsonPath, true);
      // var_dump($json);
      // $jsonIterator = new RecursiveIteratorIterator(new RecursiveArrayIterator($json), RecursiveIteratorIterator::SELF_FIRST);

      $id = 0;

      foreach ($json as $key => $value) {
        $itemId = $id;
        $title = $value['title'];
        $productionDate = explode("-", $value['production-date']);
        $description = $value['description'];
        $thumbnail = $value['thumbnail'];
        $isPublished = $value['published'];

        $output;

        if($isPublished == 'true'){
          $output = '<div class="grid-item">';
            $output .= '<a class="card card-'.$itemId.'" href="projet.php?id='.$itemId.'">';
              $output .= '<img class="card-img-top" src="'.$thumbnail.'" alt="Card image cap">';
              $output .= '<div class="card-body">';
                $output .= '<h6 class="card-title">'.$title.'</h6>';
                $output .= '<p class="card-text">'.$description.'</p>';
                $output .= '<p class="card-text"><small class="text-muted">'.$productionDate[0].'</small></p>';
              $output .= '</div>';
            $output .= '</a>';
          $output .= '</div>';
          // $output .= '';

          echo $output;
        }

          // if($jsonIterator-> getDepth() == 0){ // on lit les premiers niveaux
          //   echo '<a class="card">';
          //   echo '<p>'.$title.'</p>';
          //   echo '</a>';
          // }
        $id++;
      }
     ?>
     </div>
  </div>
</div>

</body>
</html>
