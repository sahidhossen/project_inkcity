<?php
/**
 * Advance template
 */
$post = new posts();

$advances = $post->get_post_by('advance');

if($advances !=NULL ):
?>
<div class="col-md-3 advantage">
    <p> <i class="fa fa-plus fa-1x"></i> <?php  echo (isset($advances[0])) ? strtoupper($advances[0]->post_title) : 'Post Empty'; ?> </p>
</div>
<div class="col-md-9 printbox">
    <p> <span class="txt"> <?php echo (isset($advances[1])) ? strtoupper($advances[1]->post_title) : ''; ?> </span> <i class="fa fa-caret-down fa-2x"></i></p>
</div>
<div class="col-md-12 advantage-content">
    <div class="col-md-8 content-advantage-left">
        <div class="content">
            <?php echo (isset($advances[0])) ? $advances[0]->post_content : ''; ?>
        </div>
    </div>
    <div class="col-md-4 content-advantage-right">
        <div class="content">
              <?php echo (isset($advances[1])) ? $advances[1]->post_content : ''; ?>
        </div>
    </div>
</div>
<?php else: ?>
    <div class="blank-template">
        <h3 class="text-center empty-title">
            We are waiting for your posts !
        </h3>
        <!-- /.text-center empty-title -->
    </div>
    <!-- /.blank-template -->

<?php endif; ?>
