
<?php
/*
Template Name: Archive Members
*/

$current_page = get_query_var('paged')?get_query_var('paged') : 1;
$current_id_member = get_query_var('id');


$page_id  = $post->ID;
$page     = get_query_var('paged') ? get_query_var('paged') : 1;
$args = array( 'post_type' => 'member', 'posts_per_page' => 13,'paged' => $page);

$loop = new WP_Query( $args );

global $wp_query;
$query_obj = $wp_query->get_queried_object();

$arr_id = array();



?>

<?php get_header(); ?>
    <div class="container">
        <div class="container_inner wrap_members clearfix">
            <div class="margin_top_40 clearfix">
                <?php if ( is_user_logged_in() ): ?>
                <div class="main_logout pull-right"><?php echo wp_loginout(  home_url('/members'), false ) ?></div>
                <?php endif; ?>
            </div>
            <div class="row">
                <div class="vc_col-md-4 member_area">
                    <h4 class="lb_member"><span class="span1">Members</span> <span class="span2">Area</span></h4>
                    <ul class="list_members">
                        <?php
                        $i= 0;
                        $limit = 13;
                        $index = ($current_page - 1) * $limit +1;
                        while ( $loop->have_posts() ) : $loop->the_post();
                            $id = get_the_ID();
                            $arr_id[] = $id;

                            $nonce = wp_create_nonce("check_security_ajax");
                            ?>
                            <li><a data-nonce="<?php echo $nonce ?>"  class=" <?php if ( is_user_logged_in() ) echo 'link_detail_members'; ?> <?php if($i==0 and is_user_logged_in()) echo 'current_item' ?>" data-post_id="<?php the_ID(); ?>"> <?php echo sprintf("%02d", $index).' - '; ?>  <?php the_title(); ?></a></li>
                        <?php
                        $i++;
                        $index++;
                        endwhile;
                        ?>
                    </ul>

                    <div class="pagination clearfix">
                        <div class="pull-left">
                            <?php if (function_exists('devvn_wp_corenavi')) devvn_wp_corenavi($loop); ?>
                        </div>
                    </div>

                </div>
                <div class="vc_col-md-8">
                     <?php if ( ! is_user_logged_in() ): ?>
                         <?php
                         $args = array(
                             'redirect' => home_url('/members')
                         );
                         ?>
                          <div class="members_login">
                             <h3>Existing Users Log In</h3>
                              <?php
                             wp_login_form( $args );
                             ?>
                          </div>
                     <?php else: ?>
                         <h4 class="lb_munite">Board Munites</h4>
                         <div class="list_pdf_file">
                             <?php
                             $limit_pdf =5;
                             $current_id = $arr_id[0];
                             $pdfs = get_field('pdf',$current_id );
                             if($pdfs):
                                 echo '<ul>';
                                 foreach ($pdfs as $key=>$pdf):

                                     $title  = $pdf['title'];
                                     $file_upload  = $pdf['file_upload'];

                                     ?>
                                     <li class="clearfix <?php  if($key >= $limit_pdf) echo 'hide_item' ?>"><a href="<?php echo $file_upload ?>"><?php echo $title ?> <span class="pull-right">View</span></a></li>
                                 <?php
                                 endforeach;
                                 ?>
                                 </ul>

                                 <?php if(count($pdfs)>5): ?>
                                 <span class="show_more">Load More</span>
                             <?php endif; ?>

                             <?php endif; ?>
                         </div>
                     <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

<?php get_footer(); ?>