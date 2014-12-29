<?php
	
	global $wpdb;
	$last_slider_id = $wpdb->get_var
						(
							"SELECT slider_id FROM " . JssorSliderPlugin::jssor_sliders() . " ORDER BY slider_id DESC LIMIT 1"
						);
	
	$slider = $wpdb->get_results
						(
							"SELECT * FROM " . JssorSliderPlugin::jssor_sliders() . " ORDER BY slider_order ASC "
						);
	
?>

	<div style="margin:5px 2px 2px;width:96%;" id='setting-error-settings_updated' class='updated settings-error'> 
		<p><strong><?php _e( "Jssor Slider related: ", jssor_slider ); ?></strong>
			<a href="https://github.com/phpcentre/wordpress-jssor-slider" target="_blank" ><?php _e( "Jssor Slider on Github", jssor_slider ); ?></a> | 
			<a href="https://wordpress.org/plugins/jssor-slider/" target="_blank" ><?php _e( "Jssor Slider on WordPress", jssor_slider ); ?></a> | 
			<a href="http://phpcentre.net/wordpress-jssor-slider/" target="_blank" ><?php _e( "Report a Bug", jssor_slider ); ?></a> |
			<a href="http://phpcentre.net/wordpress-jssor-slider/" target="_blank" ><?php _e( "Jssor Slider Demo", jssor_slider ); ?></a>
		</p>
	</div>
	<div id="poststuff" style="width: 99% !important;">
		<div id="post-body" class="metabox-holder columns-3">
			<div id="postbox-container-2" class="postbox-container">
				<div id="advanced" class="meta-box-sortables">
					<div id="jssor_slider_get_started" class="postbox" >
						<div class="handlediv" data-target="#ux_dashboard" title="Click to toggle" data-toggle="collapse"><br></div>
						<h3 class="hndle"><span><?php _e( "Dashboard", jssor_slider ); ?></span></h3>
						<div class="inside">
							<div id="ux_dashboard" class="jssor_slider_layout">
								<a class="btn btn-info" href="admin.php?page=save_slider&slider_id=<?php echo count($last_slider_id) == 0 ? 1 : $last_slider_id + 1; ?>"><?php _e("Add New Slider", jssor_slider);?></a>
								<div class="separator-doubled"></div>			
								<div class="fluid-layout">
									<div class="layout-span12">
										<div class="widget-layout">
											<div class="widget-layout-title">
												<h4><?php _e( "Existing Slider Overview", jssor_slider ); ?></h4>
											</div>
											<div class="widget-layout-body">
												<table class="table table-striped " id="data-table-slider">
													<thead>
														<tr>
															<th style="width:30%"><?php _e( "Slider", jssor_slider ); ?></th>
															<th style="width:15%"><?php _e( "Total Slides", jssor_slider ); ?></th>
															<th style="width:20%"><?php _e( "Date", jssor_slider ); ?></th>
															<th style="width:20%"><?php _e( "Short-Codes", jssor_slider ); ?></th>
															<th style="width:15%"></th>
														</tr>
													</thead>
													<tbody>
														<?php
															for ( $flag=0; $flag <count($slider); $flag++ ) :
															
																$count_slide = $wpdb->get_var
																				(
																					$wpdb->prepare
																						(
																							"SELECT COUNT( ". JssorSliderPlugin::jssor_sliders() .".slider_id ) FROM " . JssorSliderPlugin::jssor_sliders() . " JOIN " . JssorSliderPlugin::jssor_slides() . " ON " . JssorSliderPlugin::jssor_sliders() . ".slider_id = " . JssorSliderPlugin::jssor_slides() . ".slider_id WHERE " . JssorSliderPlugin::jssor_sliders() . ".slider_id = %d ",
																							$slider[$flag]->slider_id
																						)
																				);
														?>
														<tr>
															<td style="padding-top:20px;"><a href="admin.php?page=save_slider&slider_id=<?php echo $slider[$flag]->slider_id;?>"><?php echo stripcslashes( htmlspecialchars_decode( $slider[$flag] -> slider_name ) );?></a></td>
															<td style="padding-top:20px;"><?php echo $count_slide;?></td>
															<td style="padding-top:20px;"><?php echo date("d-M-Y", strtotime( $slider[$flag]->slider_date ) );?></td>
															<td><pre>[jssorslider id=<?php echo $slider[$flag]->slider_id; ?>]</pre></td>
															<td style="padding:18px 0 0 40px;" >
																<a class="btn hovertip"	style="cursor: pointer;" title="Delete Slider" onclick="delete_slider(<?php echo $slider[$flag]->slider_id;?>);" >
																	<i class="icon-trash"></i>
																</a>	
															</td>
														</tr>
														<?php endfor; ?>														
													</tbody>
												</table>		
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

	<script type="text/javascript">
		jQuery("#data-table-slider .hovertip").tipsy({live: true, delayIn: 500, html: true, gravity: 'e'});
		jQuery("#data-table-slider").dataTable ({
			"bJQueryUI": false,
			"bAutoWidth": true,
			"sPaginationType": "full_numbers",
			"sDom": '<"datatable-header"fl>t<"datatable-footer"ip>',
			"oLanguage": {
				"sLengthMenu": "<span>Show entries:</span> _MENU_"
			},
			"aaSorting": [[ 0, "asc" ]]
		});

		function delete_slider(slider_id) {
			var r = confirm("<?php _e( "Are you sure you want to delete this Slider?", jssor_slider ); ?>");
			if(r == true) {
				jQuery.post(ajaxurl, "slider_id="+slider_id+"&param=Delete_slider&action=add_new_slider_library", function() {
					var check_page = "<?php echo $_REQUEST["page"]; ?>";
					window.location.href = "admin.php?page="+check_page;
				});
			}
		}
	</script>
