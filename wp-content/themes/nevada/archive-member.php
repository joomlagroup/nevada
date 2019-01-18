
<?php
/*
Template Name: Archive Members
*/


$current_id_member = get_query_var('id');


$page_id  = $post->ID;
$args = array( 'post_type' => 'member','posts_per_page' => -1);

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
                        $index = 1;
                        while ( $loop->have_posts() ) : $loop->the_post();
                            $id = get_the_ID();
                            $arr_id[] = $id;

                            ?>
                            <li><a href="<?php the_permalink() ?>" class="<?php if($i==0 and is_user_logged_in()) echo 'current_item' ?>"> <?php echo sprintf("%02d", $index).' - '; ?>  <?php the_title(); ?></a></li>
                        <?php
                        $i++;
                        $index++;
                        endwhile;
                        ?>
                    </ul>

                </div>
                <div class="vc_col-md-8">
                     <?php if ( ! is_user_logged_in() ): ?>
                         <?php
                         $args = array(
                             'redirect' => home_url('/members'),
                             'label_username' => __( 'Username' ),
                         );
                         ?>
                          <div class="members_login">
                              <p>This content is restricted to site members. If you are an existing user, please login</p>
                             <h3>Existing Users Log In</h3>
                              <?php
                             wp_login_form( $args );
                             ?>
                          </div>
                     <?php else: ?>

                             <?php
                             $current_id = $arr_id[0];
                             $args = array( 'post_type' => 'member','post__in' => array($current_id));
                             $detail = new WP_Query( $args );
                             if($detail->have_posts()){
                                 while ( $detail->have_posts() ) { $detail->the_post();
                                     echo '<h4 class="lb_munite">'.get_the_title().'</h4>';
                                     if(get_the_content()){
                                         echo '<div class="content_post clearfix">';
                                         the_content();
                                         echo '</div>';
                                     }
                                 }
                             }
                             ?>

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
                                     <li class="clearfix <?php  if($key >= $limit_pdf) echo 'hide_item' ?>"><a target="_blank" href="<?php echo $file_upload ?>"><?php echo $title ?> <span class="pull-right">View</span></a></li>
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