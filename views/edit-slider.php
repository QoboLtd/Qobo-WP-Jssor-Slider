<?php
	
	global $wpdb,$current_user;
	include_once JSSOR_SLIDER_PATH  . '/lib/settings.php';
	$slider_id = intval( $_REQUEST["slider_id"] );
	
	$check_slider_id = $wpdb->get_var
						(
							$wpdb->prepare
								(
									"SELECT slider_id FROM " . JssorSliderPlugin::jssor_sliders() . " WHERE slider_id= %d",
									$slider_id
								)
						);

	if ( $check_slider_id == 0 ) {
	
		$wpdb->query
		(
			$wpdb->prepare
			(
				"INSERT INTO " . JssorSliderPlugin::jssor_sliders() . " (slider_id, slider_name, slider_date, author, slider_order)
				VALUES(%d, %s, CURDATE(), %s, %d)",
				$slider_id,
				"Untitled Slider",
				$current_user->display_name,
				$slider_id
			)
		);
		
		$slider = $wpdb->get_row
					(
						$wpdb->prepare
							(
								"SELECT * FROM " . JssorSliderPlugin::jssor_sliders() . " WHERE slider_id = %d",
								$slider_id
							)
					);
	}
	else {
	
		$slider = $wpdb->get_row
					(
						$wpdb->prepare
							(
								"SELECT * FROM " .JssorSliderPlugin::jssor_sliders() . " WHERE slider_id = %d",
								$slider_id
							)
					);
	}
	
	$settings =	unserialize( $slider->slider_settings );
	
	$slides = $wpdb->get_results
				(
					$wpdb->prepare
						(
							"SELECT * FROM " . JssorSliderPlugin::jssor_slides() . " WHERE slider_id = %d ORDER BY sorting_order ASC",
							$slider_id
					)
				);
?>
	<form id="edit_slider" class="layout-form">
		<div id="poststuff" style="width: 99% !important;">
			<div id="post-body" class="metabox-holder">
				<div id="postbox-container-2" class="postbox-container">
					<div id="advanced" class="meta-box-sortables">
						<div id="jssor_slider_get_started" class="postbox" >
							<div class="handlediv" data-target="#ux_edit_slider" title="Click to toggle" data-toggle="collapse"><br></div>
							<h3 class="hndle"><span><?php _e( "Slider", jssor_slider ); ?></span></h3>
							<div class="inside">
								<div id="ux_edit_slider" class="jssor_slider_layout">
									<a class="btn btn-inverse" href="admin.php?page=jssor_slider"><?php _e( "Back to Sliders", jssor_slider ); ?></a>
									<button type="submit" class="btn btn-info" style="float:right"><?php _e( "Save Slider", jssor_slider ); ?></button>
									<div class="separator-doubled"></div>
									<?php if ( !count($slides ) ) : ?>
									<div id="empty_slider_message" class="message red">
										<span>
											<strong><?php _e( "Slider empty. Please upload some images", jssor_slider ); ?></strong>
										</span>
									</div>
									<?php endif; ?>
									<div id="update_slider_success_message" class="message green" style="display: none;">
										<span>
											<strong><?php _e( "Slider Saved. Kindly wait for redirection", jssor_slider ); ?></strong>
										</span>
									</div>
									<div class="fluid-layout">
										<div class="layout-span8">
											<div class="widget-layout">
												<div class="widget-layout-title">
													<h4 style="padding:2px;"><div class='tab-title-slider'><input onfocus="this.style.width=((this.value.length + 1)*9) + 'px'"	type='text' id="edit_title" name='title' value="<?php echo stripcslashes(htmlspecialchars_decode($slider->slider_name)); ?>" placeholder="Slider Title"></div></h4>
												</div>
												<div style="padding:0px;" class="widget-layout-body">
													<div style="padding:0 15px 0 15px;" class="layout-control-group">
														<label style="cursor:default;" class="layout-control-label"><?php _e( "Slides", jssor_slider ); ?></label>
															<div style="float:right;margin-top:5px;"><a style="margin:3px;" class="button button-small" href="admin.php?page=slide_preview" target="_blank">Slide Preview</a><a style="margin:3px;" class="button button-small" href="admin.php?page=caption_preview" target="_blank">Caption Preview</a></div>
													</div>
													<input type="hidden" id="hidden_slider_id" value="<?php echo $slider_id; ?>"></input>
													<div style="margin:0 15px 0 15px;"class="separator-doubled"></div>
													<table id="slide_table" style="width:100%">
														<tbody>
															<?php for ( $flag = 0; $flag < count($slides); $flag++ ) : ?>
															<tr class="slide" id="slid_<?php echo $slides[$flag]->slide_id; ?>">
																<td style="width:152px;" class="col-1">
																	<div name="slide_<?php echo $slides[$flag]->slide_id; ?>" class='thumb' style='background-image: url(<?php echo stripcslashes(JSSOR_SL_THUMB_SMALL_URL . $slides[$flag]->thumbnail_url); ?>)'>
																		<a class="delete-slide" id="btn_delete" onclick="deleteImage(this);" controlid="<?php echo $slides[$flag]->slide_id; ?>" >x</a>
																			<span class='slide-details'>Image Slide</span>
																	</div>
																</td>
																<td class="col-2">
																	<ul class="tabs">
																		<li class="selected" rel="tab-0">General</li>
																		<li rel="tab-1"> Transition</li>
																	</ul>
																	<div class='tabs-content'>
																		<div class="tab tab-0">
																			<input type="text" style="margin-bottom:5px;" id="slide_title" class="slide_title"	value="<?php echo html_entity_decode(stripcslashes(htmlspecialchars($slides[$flag]->title))); ?>" placeholder="Caption"></input>
																			<textarea id="slide_desc" placeholder="Description"><?php echo html_entity_decode(stripcslashes(htmlspecialchars($slides[$flag]->description))); ?></textarea>
																			<input type="text" class="slide_url" id="slide_url" value="<?php echo html_entity_decode(stripcslashes(htmlspecialchars($slides[$flag]->url))); ?>" placeholder="URL"></input>
																			<input type="hidden"	id="slide_id" value="<?php echo $slides[$flag]->slide_id; ?>" ></input>
																		</div>
																		<div class="tab tab-1" style="display:none">
																			<div id="caption_div" style="margin:27px 0 26px 0;">
																				<div class="caption_trans" >
																					<label class="trans_label">Caption In</label>
																					<select id="cap_trans_in" name="cap_trans_in" >
																						<?php
																							foreach ( $Caption_Transition as $key=>$value ) :
																								$selected = ( $slides[$flag]->caption_in== $value ) ? 'selected="selected"' : '';
																						?>
																						<option value="<?php echo $value ?>" <?php echo $selected ?> ><?php echo $key ?></option>
																						<?php endforeach; ?>
																					</select>
																				</div>
																				<div class="caption_trans" >
																					<label class="trans_label" >Caption Out</label>
																					<select id="cap_trans_out" name="cap_trans_out">
																						<?php
																							foreach ( $Caption_Transition as $key=>$value ) :
																								$selected = ( $slides[$flag]->caption_out == $value ) ? 'selected="selected"' : '';
																						?>
																						<option value="<?php echo $value ?>" <?php echo $selected ?> ><?php echo $key ?></option>
																						<?php endforeach; ?>
																					</select>
																				</div>
																			</div>						
																			<div id="desc_div" style="margin:18px 0 18px 0;">
																				<div class="desc_trans">
																					<label class="trans_label">Desc In</label>
																					<select id="desc_trans_in" name="desc_trans_in">
																						<?php
																							foreach ( $Caption_Transition as $key=>$value ) :
																								$selected = ( $slides[$flag]->description_in == $value ) ? 'selected="selected"' : '';
																						?>
																						<option value="<?php echo $value ?>" <?php echo $selected ?> ><?php echo $key ?></option>
																						<?php endforeach; ?>
																					</select>
																				</div>
																				<div class="desc_trans">
																					<label class="trans_label" >Desc Out</label>
																					<select id="desc_trans_out" name="desc_trans_out">
																						<?php
																							foreach ( $Caption_Transition as $key=>$value ) :
																								$selected = ( $slides[$flag]->description_out == $value ) ? 'selected="selected"' : '';
																						?>
																						<option value="<?php echo $value ?>" <?php echo $selected ?> ><?php echo $key ?></option>
																						<?php endforeach; ?>
																					</select>
																				</div>
																			</div>
																			<div id="slide_div" style="margin:18px 0 0 0;">
																				<label class="trans_label">Slide</label>
																				<select style="width:77%;" id="slide_trans" name="slide_trans">
																					<?php
																						foreach ( $Slide_Transition as $key=>$value ) :
																							$selected = ( $slides[$flag]->slide_trans == $value ) ? 'selected="selected"' : '';
																					?>
																					<option value="<?php echo $value ?>" <?php echo $selected ?> ><?php echo $key ?></option>
																					<?php endforeach; ?>
																				</select>
																			</div>
																		</div>	
																	</div>
																</td>
															</tr>
															<?php endfor; ?>
														</tbody>
													</table>
												</div>	
											</div>
										</div>
										<div class="layout-span4">
											<div class="widget-layout">
												<div class="widget-layout-title">
													<h4><?php _e( "Upload Images", jssor_slider ); ?></h4>
													<span style="margin:10px 10px;" class="spinner"></span>
												</div>
												<div style="padding:0px;" class="widget-layout-body" id="edit_image_uploader">
													<p><?php _e( "Your browser doesn\"t have Flash, Silverlight or HTML5 support.", jssor_slider ) ?></p>
												</div>
											</div>
											<div class="widget-layout">
												<div class="widget-layout-title">
													<h4><?php _e( "Slider Settings", jssor_slider ); ?></h4>
													<span class="tools">
														<a data-target="#slider_settings" data-toggle="collapse">
															<i class="icon-chevron-down"></i>
														</a>
													</span>
												</div>
												<div id="slider_settings" class="collapse in">
													<div class="widget-layout-body">
														<div class="layout-control-group">
															<label	class="layout-control-label" title="Slideshow Width"><?php _e( "Width", jssor_slider ); ?></label>
															<div style="margin-left:10px;" class="layout-controls">
																<input	type="number" min="0" max="9999" class="layout-span5" id="slider_width" name="slider_width"
																placeholder="600" value="<?php echo $settings['slider_width']; ?>"/>
																<span>px</span>
															</div>
														</div>
													</div>
													<div class="widget-layout-body">
														<div class="layout-control-group">
															<label	class="layout-control-label" title="Slideshow Height"><?php _e( "Height", jssor_slider ); ?> </label>
															<div style="margin-left:10px;" class="layout-controls">
																<input	type="number" min="0" max="9999" class="layout-span5" id="slider_width" name="slider_width"
																placeholder="300" value="<?php echo $settings['slider_height']; ?>"/>
																<span>px</span>
															</div>
														</div>
													</div>
													<div class="widget-layout-body">
														<div class="layout-control-group">
															<label class="layout-control-label" title="Duration for Slide in milliseconds"><?php _e( "Duration", jssor_slider ); ?></label>
															<div style="margin-left:10px;" class="layout-controls">
																<input type="number" min="0" max="9999" class="layout-span5" id="slider_width" name="slider_width"
																placeholder="500" value="<?php echo $settings['slide_duration'] ; ?>"/>
																<span>ms</span>
															</div>
														</div>
													</div>
													<div class="widget-layout-body">
														<div class="layout-control-group">
															<label class="layout-control-label" title="Transition between slides automatically"><?php _e( "AutoPlay", jssor_slider ); ?> </label>
															<div class="layout-controls-checkbox">
																<?php
																	$checked = ( $settings['auto_play'] == 1 ) ? 'checked="checked"' : '';		
																?>
																<input type="checkbox" name="slider_autoplay" value="1" <?php echo $checked ?> />
															</div>
														</div>
													</div>
													<div class="widget-layout-body">
														<div class="layout-control-group">
															<label	class="layout-control-label" title="Interval (in milliseconds) to go for next slide since the previous stopped if the slider is auto playing" ><?php _e( "Autoplay Interval", jssor_slider ); ?> </label>
															<div style="margin-left:70px;" class="layout-controls">
																<input type="number" min="0" max="9999" class="layout-span5" id="slider_width" name="slider_width"
																placeholder="3000" value="<?php echo $settings['auto_interval']; ?>"/>
																<span>ms</span>	
															</div>
														</div>
													</div>
													<div class="widget-layout-body">
														<div class="layout-control-group">
															<label	class="layout-control-label" title="Steps to go for each navigation request (this options applys only when slideshow is disabled)"><?php _e( "Autoplay Steps", jssor_slider ); ?></label>
															<div style="margin-left:70px;" class="layout-controls">
																<input	type="number" min="0" max="9999" class="layout-span5" id="slider_width" name="slider_width"
																placeholder="1" value="<?php echo $settings['auto_steps']; ?>"/>
																<span>ms</span>	 
															</div>
														</div>
													</div>
													<div class="widget-layout-body">
														<div class="layout-control-group">
															<label	class="layout-control-label" title="Orientation to play slide (for auto play and arrow navigation)"><?php _e( "Play Orientation", jssor_slider ); ?> </label>
															<div style="margin-left:70px;" class="layout-controls">
																<select id="play_orientation" class="layout-span9" name="play_orientation" >
																	<?php
																		foreach ( $PlayOrientation as $key=>$value ) :
																			$selected = ( $settings['play_orient'] == $key ) ? 'selected="selected"' : '';
																	?>
																	<option value="<?php echo $key ?>" <?php echo $selected ?> ><?php echo $value ?></option>
																	<?php endforeach; ?>
																</select>	 
															</div>
														</div>
													</div>
													<div class="widget-layout-body">
														<div class="layout-control-group">
															<label class="layout-control-label" title="Whether to pause on mouseover if a slider is auto playing"><?php _e( "PauseHover", jssor_slider ); ?></label>
															<div class="layout-controls-checkbox">
																<?php
																	$checked = ( $settings['pause_hover'] == 1 ) ? 'checked="checked"' : '';		
																?>
																<input type="checkbox"	name="slider_pausehover" value="1" <?php echo $checked ?> />
															</div>
														</div>
													</div>
													<div class="widget-layout-body">
														<div class="layout-control-group">
															<label class="layout-control-label" title="Show the previous/next arrows"><?php _e( "Arrows", jssor_slider ); ?> </label>
															<div class="layout-controls-checkbox">
																<?php
																	$checked = ( $settings['use_arrows'] == 1 ) ? 'checked="checked"' : '';		
																?>
																<input type="checkbox" onclick="check_arrows();" name="slider_arrows" value="1" <?php echo $checked ?> />
															</div>
														</div>
													</div>
													<div id="slider_arrow_settings" style="display:none;">
														<div class="widget-layout-body">
															<div class="layout-control-group">
																<label class="layout-control-label" title="Option to select arrow skin for slider"><?php _e( "Arrow Skin", jssor_slider ); ?>	</label>
																<div style="margin-left:70px;" class="layout-controls">
																	<select id="slider_arrow_skin" class="layout-span9" name="slider_arrow_skin">
																		<?php
																			foreach ( $ArrowSkin as $key=>$value ) :
																				$selected = ( $settings['arrow_skin'] == $key ) ? 'selected="selected"' : '';
																		?>
																		<option value="<?php echo $key ?>" <?php echo $selected ?>><?php echo $value ?></option>
																		<?php endforeach; ?> 
																	</select>	 
																</div>
															</div>
														</div>
														<div class="widget-layout-body">
															<div class="layout-control-group">
																<label class="layout-control-label" title="Select when the arrows are displayed on the slider"><?php _e( "Show Arrow", jssor_slider ); ?> </label>
																<div style="margin-left:70px;" class="layout-controls">
																	<select id="slider_arrow_show" class="layout-span10" name="slider_arrow_show">
																		<?php
																			foreach ( $ShowAction as $key=>$value ) :
																				$selected = ( $settings['arrow_show'] == $key ) ? 'selected="selected"' : '';
																		?>
																		<option value="<?php echo $key ?>" <?php echo $selected ?> ><?php echo $value ?></option>
																		<?php endforeach; ?>
																	</select>	 
																</div>
															</div>
														</div>
													</div>
													<div class="widget-layout-body">
														<div class="layout-control-group">
															<label class="layout-control-label" title="Show the slide navigational bullets"><?php _e( "Bullets", jssor_slider ); ?> </label>
															<div class="layout-controls-checkbox">
																<?php
																	$checked = ( $settings['use_bullets'] == 1 ) ? 'checked="checked"' : '';		
																?>
																<input type="checkbox" onclick="check_bullets();" name="slider_bullets" value="1" <?php echo $checked ?>/>		
															</div>
														</div>
													</div>
													<div id="slider_bullet_settings" style="display:none;">
														<div class="widget-layout-body">
															<div class="layout-control-group">
																<label class="layout-control-label" title="Option to select bullet skin for slider"><?php _e( "Bullet Skin", jssor_slider ); ?></label>
																<div style="margin-left:70px;" class="layout-controls">
																	<select id="slider_bullet_skin" class="layout-span9" name="slider_bullet_skin">
																		<?php
																			foreach ( $BulletSkin as $key=>$value ) :
																				$selected = ( $settings['bullet_skin'] == $key ) ? 'selected="selected"' : '';
																		?>
																		<option value="<?php echo $key ?>" <?php echo $selected ?> ><?php echo $value ?></option>
																		<?php endforeach; ?> 
																	</select>	 
																</div>
															</div>
														</div>
														<div class="widget-layout-body">
															<div class="layout-control-group">
																<label class="layout-control-label" title="Select when the bullets are displayed on the slider"><?php _e( "Show Bullet", jssor_slider ); ?></label>
																<div style="margin-left:70px;" class="layout-controls">
																	<select id="slider_bullet_show" class="layout-span10" name="slider_bullet_show">
																		<?php
																			foreach ( $ShowAction as $key=>$value ) :
																				$selected = ( $settings['bullet_show'] == $key ) ? 'selected="selected"' : '';
																		?>
																			<option value="<?php echo $key ?>" <?php echo $selected ?> ><?php echo $value ?></option>
																		<?php endforeach; ?>
																	</select>	 
																</div>
															</div>
														</div>
														<div class="widget-layout-body">
															<div class="layout-control-group">
																<label class="layout-control-label" title="Option to register an action with the slider bullet "><?php _e( "Bullet Action ", jssor_slider ); ?></label>
																<div style="margin-left:70px;" class="layout-controls">
																	<select id="slider_bullet_action" class="layout-span9" name="slider_bullet_action">
																		<?php
																			foreach ( $BulletAction as $key=>$value ) :
																				$selected = ( $settings['bullet_action'] == $key ) ? 'selected="selected"' : '';
																		?>
																		<option value="<?php echo $key ?>" <?php echo $selected ?> ><?php echo $value ?></option>
																		<?php endforeach; ?>		
																	</select>	 
																</div>
															</div>
														</div>
														<div class="widget-layout-body">
															<div class="layout-control-group">
																<label class="layout-control-label" title="Horizontal spacing between the bullets in pixel"><?php _e( "Bullet Spacing", jssor_slider ); ?></label>
																<div style="margin-left:70px;" class="layout-controls">
																	<input type="number" min="0" max="9999" class="layout-span5" id="slider_width" name="slider_width"
																	placeholder="0" value="<?php echo $settings['bullet_spacing']; ?>"/>
																	<span>px</span>	 
																</div>
															</div>
														</div>
													</div>
													<div class="widget-layout-body">
														<div class="layout-control-group">
															<label class="layout-control-label" title="Make slider responsive"><?php _e( "Responsive", jssor_slider ); ?></label>
															<div class="layout-controls-checkbox">
																<?php
																	$checked = ( $settings['responsive'] == 1 ) ? 'checked="checked"' : '';		
																?>
																<input type="checkbox"	name="slider_reponsive" value="1" <?php echo $checked ?> />		
															</div>
														</div>
													</div>
													<div class="widget-layout-body">
														<div class="layout-control-group">
															<label class="layout-control-label" title="Enable swipe for mobile devices"><?php _e( "Swipe", jssor_slider ); ?></label>
																<div style="margin-left:70px;" class="layout-controls">
																<select id="slider_swipe" class="layout-span9" name="slider_swipe">
																	<?php
																		foreach ( $SwipeOptions as $key=>$value ) :
																			$selected = ( $settings['swipe'] == $key ) ? 'selected="selected"' : '';
																	?>
																	<option value="<?php echo $key ?>" <?php echo $selected ?> ><?php echo $value ?></option>
																	<?php endforeach; ?>
																</select>	 
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>									
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>

	<script type="text/javascript">
		var url = "<?php echo JSSOR_SL_PLUGIN_URL ?>";
		var array_slider_data = [];
		var array_slider_settings = [];
	
		jQuery(document).ready(function () {
			check_arrows();
			check_bullets();
			jQuery("#slide_table tbody").sortable ({
				helper: metaslider_sortable_helper,
				update: function(event, ui) {
					jQuery.post(ajaxurl, { order: jQuery('#slide_table tbody').sortable('serialize'),action:'add_new_slider_library',param:'update_order' },function(){
					});
				}
			});
		});
		
		// return a helper with preserved width of cells
		var metaslider_sortable_helper = function(e, ui) {
			ui.children().each(function() {
				jQuery(this).width(jQuery(this).width());
			});
			return ui;
		};
	
		jQuery("#slide_table").on('click', 'ul.tabs li', function() {
			var tab = jQuery(this);
			tab.parent().parent().children('.tabs-content').children('div.tab').hide();
			tab.parent().parent().children('.tabs-content').children('div.'+tab.attr('rel')).show();
			tab.siblings().removeClass("selected");
			tab.addClass("selected");
		});	
	 
		jQuery("#edit_slider").validate ({
			submitHandler: function () {
				jQuery("#update_slider_success_message").css("display", "block");
				jQuery("body,html").animate({
				scrollTop: jQuery("body,html").position().top}, "slow");
					
				var sliderid = jQuery('#hidden_slider_id').val();
				var edit_slider_name = jQuery('#edit_title').val();
				jQuery('#slider_settings input[type=number],#slider_settings select').each(function (index,el) {
					var slider_settings;
					slider_settings= jQuery(el).val();
					array_slider_settings.push(slider_settings);
				});
				jQuery('#slider_settings input[type=checkbox]').each(function (index,el) {
					var slider_radio_settings;
					slider_radio_settings = jQuery(el).is(':checked');	
					array_slider_settings.push(slider_radio_settings); 					
				});
			
				jQuery.post(ajaxurl, "sliderid=" + sliderid + "&edit_slider_name=" + edit_slider_name + "&slider_settings=" + encodeURIComponent(JSON.stringify(array_slider_settings)) + "&param=update_slider&action=add_new_slider_library", function () {
				
					jQuery('#slide_table tr').each(function (index,el) {
					var row_data = [];
					var slide_id = jQuery(el).find('#slide_id').val();
					row_data.push(slide_id);
					var slide_title = jQuery(el).find('#slide_title').val();
					row_data.push(slide_title);
					var slide_desc =	jQuery(el).find('#slide_desc').val();
					row_data.push(slide_desc);
					var slide_url = jQuery(el).find('#slide_url').val();
					row_data.push(slide_url);
					var caption_in = jQuery(el).find('#cap_trans_in').val();
					row_data.push(caption_in);
					var caption_out = jQuery(el).find('#cap_trans_out').val();
					row_data.push(caption_out);
					var desc_in = jQuery(el).find('#desc_trans_in').val();
					row_data.push(desc_in);
					var desc_out = jQuery(el).find('#desc_trans_out').val();
					row_data.push(desc_out);
					var slide_trans = jQuery(el).find('#slide_trans').val();
					row_data.push(slide_trans);
					array_slider_data.push(row_data);
					});
					
					jQuery.post(ajaxurl, "slider_data="+encodeURIComponent(JSON.stringify(array_slider_data))+ "&param=update_slide&action=add_new_slider_library", function () {
						window.location.href = "admin.php?page=jssor_slider";	
					});
				});
			}
		}); 
		
		jQuery("#edit_image_uploader").pluploadQueue ({
				
			runtimes: "html5,flash,silverlight,html4",
			url: ajaxurl + "?param=upload_slide&action=upload_library",
			chunk_size: "1mb",
			filters: {
				max_file_size: "100mb",
				mime_types: [
					{title: "Image files", extensions: "jpg,jpeg,gif,png"}
				]
			},
			rename: true,
			sortable: true,
			dragdrop: true,
			unique_names: true,
			max_file_count: 20,
			views: {
				list: true,
				thumbs: true, // Show thumbs
				active: "thumbs"
			},
			flash_swf_url: url + "/assets/Moxie.swf",
			silverlight_xap_url: url + "/assets/Moxie.xap",
			init: {
				FileUploaded: function (up, file) {
					jQuery('.widget-layout-title .spinner').show();
					var oTable = jQuery("#slide_table tbody");
					var sliderid = jQuery("#hidden_slider_id").val();
					var controlType = "image";
					var image_name = file.name;
					var img_gb_path = file.target_name;
					jQuery.post(ajaxurl, "slider_id=" + sliderid + "&imagename=" + image_name + "&img_gb_path=" + img_gb_path + 
								"&param=add_slide&action=add_new_slider_library", function (data) {
				
						jQuery.post(ajaxurl, "img_path=" + file.target_name + "&img_name=" + file.name + "&slideid=" + data +
							"&param=add_new_dynamic_row_for_slide&action=add_new_slider_library", function (data) {
						
							var col1 = jQuery.parseJSON(data)[0];
							var col2 = jQuery.parseJSON(data)[1];
							
							col= col1 + col2 ;
							oTable.append(col);
							jQuery('.widget-layout-title .spinner').hide(); 
							jQuery("#empty_slider_message").hide();
						});
					});
					
				},
				UploadComplete: function () {
					jQuery(".plupload_buttons").show();
					jQuery(".plupload_upload_status").hide();
				
				}
			}
		});
		
		var bDiv = jQuery('<div></div>').css({'background-color':'#F5F5F5','padding':'7px'});
		bDiv.insertAfter('.plupload_header');
		var buttons = jQuery('.plupload_buttons').detach();
		bDiv.append(buttons);
		
		function check_arrows() {
			var arrow_setting = jQuery("input:checkbox[name=slider_arrows]").is(':checked');
			if (arrow_setting) {
				jQuery("#slider_arrow_settings").show();
				
			} else {
				jQuery("#slider_arrow_settings").hide();
				
			}
		}
	
		function check_bullets() {
			var bullet_setting = jQuery("input:checkbox[name=slider_bullets]").is(':checked');
			if (bullet_setting) {
				jQuery("#slider_bullet_settings").show();
			} else {
				jQuery("#slider_bullet_settings").hide();
			}
		}
	
		function deleteImage(control) {
			var r = confirm("<?php _e( "Are you sure you want to delete this Slide?", jssor_slider ); ?>");
			if(r == true) {
				var slide_id = jQuery(control).attr("controlid");
				var row = jQuery(control).closest("tr");
				row.remove();
				jQuery.post(ajaxurl, "slide_id=" + slide_id + "&param=delete_slide&action=add_new_slider_library", function() {
				
				});
			}
		} 
		
		jQuery("#slider_settings label").tipsy({live: true, delayIn: 500, html: true, gravity: 'e'});
		
	</script>
