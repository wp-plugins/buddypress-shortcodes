<?php

// [webim_members_grid]
function webim_members_grid($atts, $content = null) {
    $sliderrandomid = rand();
	extract( shortcode_atts( array(
                "title" => '',
				"type" => 'active',
				"count" => '' ,
				"col" => 6 // Maximum 12 
			), $atts ));
	ob_start();
	?> 
  <div class="container"> 
                <?php if ( function_exists( 'bp_is_active' ) ) { ?>  
				 <?php if($title){?> 
				      <h3 class="section-title"><span><?php echo $title ?></span></h3>
		      <?php } ?>
                  <?php
            
                    $args = array(
					 'type' => $type,
                     'per_page' => $count
                    ); ?>
                    
            <?php if ( bp_has_members( $args ) ) : ?>
				<?php while ( bp_members() ) : bp_the_member(); ?>
				<div class="col-md-<?php echo $col?> col-sm-<?php echo $col?>">
				<div class="bp-webim-members-loop">
				 <div class="item-avatar text-center">
							<a href="<?php bp_member_permalink(); ?>"><?php bp_member_avatar( 'type=full&height=200&width=200' ); ?></a>
						</div>
				 <div class="item-title text-center">
					
						<?php $user_displayed_name_max = 18; ?>
						<?php $user_displayed_name = bp_get_member_name(); ?>
						<?php $user_displayed_name_count = strlen( $user_displayed_name ); ?>
						<?php if( $user_displayed_name_count >=  $user_displayed_name_max ){ ?>
							<h5><a title="<?php echo $user_displayed_name; ?>" href="<?php bp_member_permalink(); ?>"><?php echo substr( $user_displayed_name, 0, $user_displayed_name_max ); ?>&hellip;</a></h5>
						<?php }else{ ?>
							<h5><a href="<?php bp_member_permalink(); ?>"><?php echo $user_displayed_name; ?></a></h5>
						<?php } ?>
						
					</div>
	               
					<div class="item-meta text-center"><span class="activity"><?php bp_member_last_active(); ?></span></div>
					</div>
                </div><!-- .grid -->
			    <?php endwhile; ?>
	       <?php endif; ?>
	       <?php } ?> 
  </div><!-- .container -->
  <div class="clearfix"></div>
	<?php
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}

add_shortcode("webim_members_grid", "webim_members_grid");