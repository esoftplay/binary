<?php if ( ! defined('_VALID_BBC')) exit('No direct script access allowed');

$count = count($output['images']);
if ($count > 0)
{
  $slider_size = $db->getRow('SELECT `width`,`height` FROM `imageslider_cat` WHERE `id`='.$config['cat_id']);
  ?>
  <section class="slider-top slick_slider_scale" data-width="<?php echo $slider_size['width']; ?>" data-height="<?php echo $slider_size['height']; ?>">
    <div class="slideshow">
      <div class="slider slider-1 slick_slider">
        <?php
        if ($count > 1)
        {
          foreach ($output['images'] as $key => $dt)
          {
            $images = '<img src="'.$dt['image'].'" alt="'.$dt['title'].'" title="'.$dt['title'].'" style="width:100%">';
            ?>
            <div class="item">
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
        ?>
      </div>
    </div>
  </section>
  <?php
}