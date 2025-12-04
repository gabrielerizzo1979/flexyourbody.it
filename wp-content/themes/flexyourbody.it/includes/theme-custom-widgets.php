<?php
// Creating the widget
class wpb_widget extends WP_Widget {
	function __construct() {
		parent::__construct(
			// Base ID of your widget
			'imattr_btn_fltr_widget', 
			// Widget name will appear in UI
			__('IM*Attributes Button Update Filters Widget', 'imattr_btn_fltr_widget_domain'), 
			// Widget description
			array( 'description' => __( 'Pulsante Update Filters', 'imattr_btn_fltr_widget_domain' ), )
		);
	}
	 
	// Creating widget front-end
	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );
		// before and after widget arguments are defined by themes
		echo $args['before_widget'];
		if ( ! empty( $title ) ) 	echo $args['before_title'] . $title . $args['after_title'];
			if( !is_admin() && is_woocommerce() && ( is_shop() || is_archive() ) ) {
				// This is where you run the code and display the output
				// $term = get_queried_object();
				//print_r( $term );
				//global $products;
				//$taxonomy   = 'pa_colore';
				

				// $terms = get_terms( array(
				// 	'taxonomy'   => 'pa_colore',
				// 	'hide_empty' => false,
				// ) );
				// foreach ( $terms as $myterm ){
				// 	//echo $myterm->term_id;
				// 	if( $myterm->term_id == 47 ){
				// 		$product_attribute_color = get_term_meta($myterm->term_id);
				// 		foreach ( $product_attribute_color as $myattribute ){
				// 			print_r( $myattribute[0] );
				// 		}

				// 	}
				// 	//	term_id
				// }
				//print_r ( $terms );

				// if( is_shop() ){
				// 	echo 'pagina Shop';
				// }else{
				// 	echo 'pagina Archive';
				// 	$term = get_queried_object();
				// 	print_r( $term );
				// }
				echo '<button onclick="onUpdateAllFilters()" class="update-all-filters">'.__( 'Update All Filters', 'wpb_widget_domain' ).'</button>';
				?>
				<script>
					let baseurl = "<?php echo get_bloginfo('url'); ?>";
					let currentpath = "<?php echo explode( '?', $_SERVER['REQUEST_URI'] )[0]; ?>";
					let url = baseurl + currentpath;
					let query = "";
					//
					function addQuery(myquery){
						if( query == "" ){
							query = "?" + myquery;
						}else{
							query = query + "&" + myquery;
						}
					}
					function onUpdateAllFilters(e){
						// reset query
						query = "";
						//
						//
						// filter price
						let price_input_min = document.querySelector(".wc-sidebar-archive .filter_price .wc-block-components-price-slider__range-input--min");
						if( price_input_min ){
							let min = price_input_min.getAttribute("min");
							let min_price = price_input_min.getAttribute("aria-valuetext");
							let value = price_input_min.getAttribute("value");
							if( value > min ){
								addQuery("min_price="+min_price);
							}
						}
						let price_input_max = document.querySelector(".wc-sidebar-archive .filter_price .wc-block-components-price-slider__range-input--max");
						if( price_input_max ){
							let max = price_input_max.getAttribute("max");
							let max_price = price_input_max.getAttribute("aria-valuetext");
							let value = price_input_max.getAttribute("value");
							if( value < max ){
								addQuery("max_price="+max_price);
							}
						}
						//
						//
						// all attributes filter
						let allAttributeFilters = document.querySelectorAll("[data-filter-type='attribute-filter']");
						let attributes = new Array();
						allAttributeFilters.forEach( (el) => {
							let classname = el.className.split(" ");
							classname.forEach( (str) => {
								if( str.includes("imattr_") ){
									attributes.push( str.replace('imattr_','') );
								}
							})
						})
						attributes.forEach( (myattribute, index) => {
							if( document.querySelector( ".wc-sidebar-archive li.widget .imattr_"+myattribute) ){
								let my_filter = document.querySelector( ".wc-sidebar-archive li.widget .imattr_"+myattribute);
								let add_query_type = false;
								my_filter.querySelectorAll("input").forEach( (input) => {
									if( input.checked ){
										if( !add_query_type ){
											addQuery("filter_"+myattribute+"="+input.value);
											add_query_type = true;
										}else{
											query = query + "%2C" + input.value;
										}
									}
								})
								if( add_query_type ){
									addQuery("query_type_"+myattribute+"=or");
								}
							}
						})
						//
						//
						//
						
						//
						window.location.href = url + query;
					}

					let si = setInterval(() => {
						const color_list = document.querySelectorAll(".filter_color ul li");
						const old_color_list = document.querySelectorAll(".imattr_colore ul li");
						

						if( color_list.length > 0 && old_color_list.length > 0 && color_list.length == old_color_list.length ){
							clearInterval(si);

							

							color_list.forEach( (el,index)=>{
							
								let output = "";
								let id_color = el.getAttribute("data-term");
								let item_color = el.querySelector("span.item.item-color");
								// item_color.forEach( (el)=>{
								// 	output = "<span style='"+el.getAttribute("style")+"'></span>";
								// });
								//	
								// if( item_color ){
								// 	output = "<span style='"+item_color.getAttribute("style")+"'></span>";
								// }else{
								// 	item_color = el.querySelector("span.item.item-dual-color");
								// 	output = "<span style='"+item_color.getAttribute("style")+"'></span>";
								// }
								//console.log( output+" "+id_color );

								// let my_old_input = document.querySelector(".imattr_colore #"+id_color);
								// my_old_input.parentNode.innerHTML+=output;
								// let parent = my_old_input.parentNode;
								// parent.append(item_color);

								// let my_old_input = document.querySelector(".imattr_colore #"+id_color);
								let my_old_input = document.querySelector('.imattr_colore input[value='+id_color+']');

								// console.log('my_old_input: ',my_old_input);
								// console.log('id_color: ',id_color);
								// console.log('item_color: ',item_color);

								if( item_color ){
									output = item_color.getAttribute("style");
									my_old_input.setAttribute("style", output );
								}else{
									item_color = el.querySelector("span.item.item-dual-color");
									output = item_color.getAttribute("style");
									my_old_input.setAttribute("style", output );
								}

							});
							
						}
						

						
						
					}, 100);
				</script>
				<?php
			}
		echo $args['after_widget'];
	}
	 
	// Widget Backend
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( 'Update All Filters', 'imattr_btn_fltr_widget_domain' );
		}
		// Widget admin form
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
	<?php
	}
	 
	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		return $instance;
	}
	 
	// Class wpb_widget ends here
} 
	 
// Register and load the widget
function wpb_load_widget() {
	register_widget( 'wpb_widget' );
}
add_action( 'widgets_init', 'wpb_load_widget' );