<?php
/**
 * Customer slide
 */

$post = new posts();

$top_slide = $post->get_post_by_status('pert_slide','right');
?>
<div id="sponser-slide" class="owl-carousel owl-theme">
    <?php
    if($top_slide !=NULL ){
        foreach($top_slide as $slide ):
            $data = seperate_slide_item($slide->comment);
            ?>
            <div class="item">
                <div class="item-message">
                    <div class="message-container arrow_box">
                        <div class="item-title"> <?php echo (isset($data['slide_title'])) ? $data['slide_title'] : 'Please fill title'; ?> <span class="close-message"> X </span></div>
                        <!-- /.item-title -->
                        <div class="item-message-body ">
                            <div class="part-one"> <?php echo (isset($data['slide_sub_title'])) ? $data['slide_sub_title'] : 'Please fill sub title'; ?> </div>
                            <div class="part-two number"> <?php echo (isset($data['number'])) ? $data['number'] : '520'; ?>  </div>
                            <!-- /.part-one -->
                        </div>
                        <!-- /.item-message-body -->
                    </div>
                    <!-- /.message-container -->
                </div>
                <!-- /.item-message -->
                <img src="<?php echo upload_dir().$slide->post_content; ?>" alt="The Last of us"></div>
            <?php
        endforeach;
    }else {
        ?>
        <div class="item"><img src="<?php echo get_stylesheet_uri('img') ?>logo-2.png" alt="Empty Slide"></div>
        <?php
    }

    ?>
</div>
