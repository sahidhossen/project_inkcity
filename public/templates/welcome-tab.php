<?php
/**
 * Home welcome tab
 */
$post = new posts();
$tabs = $post->get_post_by('tab');
if($tabs !=NULL ):
?>
<div class="col-md-3 col-xs-12 leftbar-tab">
        <ul class="tab_lists left-tab-list">
            <?php
            $i = 0;
            foreach( $tabs as $tab ):
                $i++;
            ?>
            <li data-target="<?php echo str_replace(' ','_', $tab->post_title).'_'.$i;?>"  class="<?php echo ($i==1) ? 'active' : ''; ?>">  <?php echo strtoupper($tab->post_title); ?> </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div class="col-md-9 col-xs-12 rightbar-tabcontainer">
        <div id="content_holder" class="home_tab_content">
            <?php
            $i = 0;
            foreach( $tabs as $tab ):
            $i++;
            ?>
            <div id="<?php echo str_replace(' ','_', $tab->post_title).'_'.$i;?>" class="tabcontent <?php echo ($i==1) ? 'active' : ''; ?>">
                   <?php echo $tab->post_content; ?>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

<?php else: ?>

    <div class="blank-template">
        <h3 class="text-center empty-title">
            We are waiting for your posts
        </h3>
        <!-- /.text-center empty-title -->
    </div>
    <!-- /.blank-template -->
 <?php endif; ?>
