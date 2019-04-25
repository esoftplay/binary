<?php if ( ! defined('_VALID_BBC')) exit('No direct script access allowed');

$count = count($output['images']);
if ($count > 0)
{
  ?>
  <section class="slider">
    <!-- untuk menyamakan antara gambar depan dengan backgroundnya -->
    <!-- <div class="slider_background"></div> -->
    <div class="w3-content w3-display-container">
      <?php
      if ($count > 1)
      {
        foreach ($output['images'] as $key => $dt)
        {
          $images = '<img src="'.$dt['image'].'" alt="'.$dt['title'].'" title="'.$dt['title'].'" style="width:100%">';
          ?>
          <div class="w3-display-container mySlides">
            <?php
            if (!empty($dt['link']))
            {
              ?>
              <a href="<?php echo $dt['link'] ?>" title="<?php echo $dt['title'] ?>">
                <?php echo $images ?>
              </a>
              <?php
            }else{
              echo $images;
            }
            ?>
          </div>
          <?php
        }
      }

      if (!empty($output['config']['control']) && $count > 1)
      {
        ?>
        <button class="w3-button w3-display-left w3-black" onclick="plusDivs(-1)">&#10094;</button>
        <button class="w3-button w3-display-right w3-black" onclick="plusDivs(1)">&#10095;</button>
        <?php
      }
      ?>
    </div>
  </section>
  <?php
}