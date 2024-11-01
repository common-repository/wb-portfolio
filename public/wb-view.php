<?php
function wbportfolio_portfolio_shortcode( $atts ) {

	// Attributes
	extract( shortcode_atts(
		array(
			'posts_num' => "-1",
			'order' => 'DESC',
			'orderby' => '',
			'portfolio_cat'=>'',

		), $atts )
	);
  $args = array(
      'orderby' => 'date',
       'order' => $order,
        'wb_category' =>$portfolio_cat,
        'showposts' => $posts_num,
        'post_type' => 'wbportfolio'
 );
?>
<section class="wbportfolio_area">
 <ul class="wbportfolio_filters">
     <?php
         $wbportfolio_terms = get_terms('wbportfolio_category');
         $wbportfolio_count = count($wbportfolio_terms);
              echo '<li class="active" data-filter="*"><a href="" title="" class="active">All</a></li>';
         if ( $wbportfolio_count > 0 ){
             foreach ( $wbportfolio_terms as $wbportfolio_term ) {
                 $wbportfolio_termname = strtolower($wbportfolio_term->name);
                 $wbportfolio_termname = str_replace(' ', '-', $wbportfolio_termname);
                echo '<li><a href="" title="" data-filter=".'.$wbportfolio_termname.'">'.$wbportfolio_term->name.'</a></li>';
             }
         }
     ?>
 </ul>
 </section>
<?php
 $wb_loop= new WP_Query( $args );
 		if ($wb_loop->have_posts()) :
 			while ($wb_loop->have_posts()) : $wb_loop->the_post();  // wb portfolio start
			   // add terms
					 $terms = get_the_terms( $post->ID, 'wbportfolio_category' );
									 if ( $terms && ! is_wp_error( $terms ) ) :
											 $links = array();
											 foreach ( $terms as $term ) {
													 $links[] = $term->name;
											 }
											 $tax_links = join( " ", str_replace(' ', '-', $links));
											 $tax = strtolower($tax_links);
									 else :
								 $tax = '';
							 endif;
				 // end add terms
			$wb_view.='<div class="wbportfolio_items">';
      if ( has_post_thumbnail() ) {  // check if the post has a Post Thumbnail assigned to it.
					$wb_view.='<div class="wbportfolio_single_items '. $tax .'">';
						$wb_view.='<img class="wbportfolio_cover" src="'.get_the_post_thumbnail_url().'" alt="" />';
						$wb_view.='<div class="wbportfolio_title">'.get_the_title().'</div>';
					$wb_view.='</div>';
        }
			$wb_view.='</div>'; // wbportfolio_items
 		endwhile; //
 		endif;
 	wp_reset_query();
 	return $wb_view;
}
add_shortcode('wb-portfolio', 'wbportfolio_portfolio_shortcode' );

 ?>
