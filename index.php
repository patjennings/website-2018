<!doctype html>
<html class="no-js" lang="">


<?php include('includes/head.php'); ?>

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
  <?php include('includes/navbar.php'); ?>

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
<?php include('includes/footer.php'); ?>
</body>
</html>
