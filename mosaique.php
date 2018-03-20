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
      <div class="mosaique">
        <ul>
      <?php
        $jsonPath = file_get_contents("http://www.thomasguesnon.fr/data/mosaique.json");
        $json = json_decode($jsonPath, true);
        // var_dump($json);
        // $jsonIterator = new RecursiveIteratorIterator(new RecursiveArrayIterator($json), RecursiveIteratorIterator::SELF_FIRST);

        $id = 0;

        foreach ($json as $key => $value) {
          $itemId = $id;
          $isPublished = $value['published'];
          $image = $value['image']['path'];
          $imageTitle = $value['image']['title'];
          $thumbnail = $value['thumbnail']['path'];
          // echo $imagepath;

          $output;

          if($isPublished == 'true'){
            $output = '<li>';
              $output .= '<a href="#">';
                $output .= '<img class="card-img-top" src="'.$thumbnail.'" alt="'.$imageTitle.'">';
              $output .= '</a>';
            $output .= '</li>';
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
     </ul>
    </div>
  </div>

</body>

</html>
