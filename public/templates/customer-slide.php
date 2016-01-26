<?php
/**
 * Customer slide
 */

$post = new posts();

$top_slide = $post->get_post_by_status('cus_slide','left');
?>
<div id="customer-slide" class="owl-carousel owl-theme">
    <?php
    if($top_slide !=NULL ){
        foreach($top_slide as $slide ):
            $data = seperate_slide_item($slide->comment);
            ?>
            <div class="item">
                <div class="customer-map">
                    <span class="line"></span>
                    <div class="map-item"> <?php echo (isset($data['slide_title'])) ? $data['slide_title'] : 'The ministry of education : 115 Kiosk' ; ?>  </div>
                </div>
                <img src="<?php echo upload_dir().$slide->post_content; ?>" alt="The Last of us"></div>
            <?php
        endforeach;
    }else {
        ?>
        <div class="item"><img src="<?php echo get_stylesheet_uri('img') ?>logo-5.png" alt="Empty Slide"></div>
        <?php
    }

    ?>
</div>
