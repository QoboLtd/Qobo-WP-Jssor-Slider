	<div id="choose-jssor-slider" style="display: none;">
		<div class="fluid-layout responsive">
			<div>
				<h3 class="jssor-shortcode-label"><?php _e( "Insert Jssor Slider Shortcode", jssor_slider ); ?></h3>
				<span>
					<?php _e( "Select a slider below to add it to your post or page.", jssor_slider ); ?>
				</span>
			</div>
			<div class="layout-span12" style="padding:15px 15px 0 0;">
				<div class="layout-control-group" id="ux_select_album" style="display: block;">
					<select id="add_slider_id" class="layout-span5">
						<option value=""> <?php _e( "Select a Slider", jssor_slider ); ?></option>
							<?php
								global $wpdb;
								$slider = $wpdb->get_results
											(
												"SELECT * FROM " . JssorSliderPlugin::jssor_sliders() . " ORDER BY slider_order ASC"
											);
						
								if ( $slider ) :
									for ( $flag = 0; $flag < count($slider); $flag++ ) :
							?>
								<option value="<?php echo intval( $slider[$flag]->slider_id ); ?>"><?php echo esc_html( $slider[$flag]->slider_name ) ?></option>
							<?php endfor; else : ?>
								<option value=""><?php _e( 'No Slider Found', jssor_slider ); ?><option>
							<?php endif; ?>					
					</select>
					<button style="height:30px;" class='button primary' id='insertJssorSlider'>Insert Slideshow</button>
				</div>						
			</div>
		</div>
	</div>
	
	<script type="text/javascript">
		jQuery(document).ready(function() {
			jQuery('#insertJssorSlider').on('click', function() {
				var id = jQuery('#add_slider_id option:selected').val();
				window.send_to_editor('[jssorslider id=' + id + ']');
				tb_remove();
			})
		});
	</script>
