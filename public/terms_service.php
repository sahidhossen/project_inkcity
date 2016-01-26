<?php
/**
 * forget password page
 *
 */
include('header.php');
$post = new posts();
$term = $post->get_single_post_by('terms');
?>

    <!-- Breadcrumb area -->
    <div class="container-fluid bg-red breadcrumb">
        <div class="container">
            <h3 class="breadcrumb-title"> <?php echo (isset($term->post_title)) ? strtoupper($term->post_title) : 'TERM & SERVICES'; ?>  </h3>
        </div>
    </div>


    <section class="container-fluid section bg-gray-img">
        <div class="container">
            <div class="term-main">
                <div class="term-title bg-gray-dark"> <h3 class="title"><?php echo (isset($term->post_title)) ? strtoupper($term->post_title) : 'TERM & SERVICES'; ?> </h3> </div>
                <div class="term-body">
                    <?php echo (isset($term->post_content)) ? $term->post_content : ''; ?>
                </div>
            </div>

            <div class="backbtn">
                <p> <a class="btn btn-red btn-radius" href="<?php echo get_home_url() ?>/registration.php"> <i class="fa fa-chevron-left"></i> Back </a></p>
            </div>
            <!-- /.backbtn -->
        </div>
    </section>

<?php include('footer.php'); ?>