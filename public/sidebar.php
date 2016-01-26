<?php
global $main_db, $main_page;
$subpage = new sub_page();
?>

<div class="col-md-3 sidebar">
    <ul class="nav">
        <?php
        $get_all_page = $main_page->get_all_pages();
        if($get_all_page !=NULL ):
            foreach($get_all_page as $page ): ?>
                <li> <a href="<?php echo get_home_url() ?>/main-page.php?page=<?php echo $page->id ?>"> <?php echo $page->name; ?> </span></a>
                    <?php $subpages = $subpage->get_page_by_mainPage( $page->id );

                    if($subpages !=NULL ):
                    ?>
                    <ul class="sub_nav">
                        <?php foreach($subpages as $s_page): ?>
                        <li>  <a href="<?php echo get_home_url() ?>/prices"> <?php echo $s_page->name; ?> </a> </li>
                        <?php endforeach; ?>
                    </ul>
                     <?php endif; ?>
                </li>

        <?php   endforeach;

        endif;
        ?>

    </ul>
</div>