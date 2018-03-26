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

    <div class="container container--projet">

      <?php
      $jsonPath = file_get_contents("http://www.thomasguesnon.fr/data/portfolio.json");
      $json = json_decode($jsonPath, true);
      $id = $_GET["id"];
      $imageId = 0;

      $projet = $json[$id];
      $isPublished = $projet['published'];

      // echo $id;

      // echo $projet['text']."<br/>";



      // var_dump($json);
      // $jsonIterator = new RecursiveIteratorIterator(new RecursiveArrayIterator($json), RecursiveIteratorIterator::SELF_FIRST);


     ?>


        <div class="container post-content" aria-label="Content">
          <div class="row projet--title">
            <div class="col-lg-8 offset-lg-2">
              <h1><?php if($isPublished == 'true'){ echo($projet['title']); } else { echo "Ceci n'est pas une erreur 404"; } ?></h1>
            </div>
          </div>
          <div class="row projet--texte">
            <div class="col-lg-8 offset-lg-2">
              <p>
                <?php if($isPublished == 'true'){ echo($projet['text']); } else { echo ""; } ?>
              </p>
            </div>
          </div>

          <?php
          if($isPublished == 'true'){
            foreach($projet['images'] as $image){
              $output = '<div class="row projet--image" id="item-'.$imageId.'">';
                $output .= '<div class="col-lg-12">';
                  $output .= '<img src="'.$image['path'].'" width="100%"/>';
                $output .= '</div>';
              $output .= '</div>';
              echo $output;
              $imageId++;
            }
          }

    ?>

        </div>
    </div>
  </div>
  <?php include('includes/footer.php'); ?>

</body>

</html>
