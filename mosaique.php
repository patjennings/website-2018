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
              $output .= '<a href="'.$image.'">';
                $output .= '<img src="'.$thumbnail.'" alt="'.$imageTitle.'">';
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
  <?php include('includes/footer.php'); ?>

</body>

</html>
