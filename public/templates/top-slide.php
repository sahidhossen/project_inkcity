<?php
/**
 * Home top slider
 */

$post = new posts();

$top_slide = $post->get_post_by_status('slide','top');
?>
<div id="home-slide" class="owl-carousel owl-theme">
<?php
if($top_slide !=NULL ){
    foreach($top_slide as $slide ):
        ?>
        <div class="item"><img src="<?php echo upload_dir().$slide->post_content; ?>" alt="The Last of us"></div>
        <?php
    endforeach;
}else {
    ?>
    <div class="item"><img src="<?php echo get_stylesheet_uri('img') ?>slid_1.png" alt="Empty Slide"></div>
    <?php
}

?>
</div>
