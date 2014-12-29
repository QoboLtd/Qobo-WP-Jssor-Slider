<?php
	
	require_once JSSOR_SLIDER_PATH . '/lib/settings.php';
	global $wpdb;
	$Caption_T = $Caption_Transition;
	$Slide_T = $Slide_Transition;
	$dynamicArray = array();

		if ( isset( $_REQUEST['param'] ) ) {
			if ( $_REQUEST['param'] == 'add_new_dynamic_row_for_slide' ) {
				
				$img_path = esc_attr( $_REQUEST['img_path'] );
				$img_name = esc_attr($_REQUEST['img_name'] );
				$slideid = intval( $_REQUEST['slideid'] );
				
				process_image_upload( $img_path, 150, 150 );
			
			
				$select1 = caption_select( $Caption_T );
				$select2 = slide_select( $Slide_T );
				$column1 = '<tr class="slide" id="slid_'.$slideid.'">
								<td style="width:152px;" class="col-1">
									<div name="slide_'.$slideid.'" class="thumb" style="background-image: url(' . JSSOR_SL_THUMB_SMALL_URL . $img_path . ' );" >
										<a class="delete-slide"	onclick="deleteImage(this);" controlid ="' . $slideid . '">x</a>
										<span class="slide-details">Image Slide</span>
									</div>
								</td>';	
				array_push( $dynamicArray, $column1 );
			
				$column2 = 		'<td class="col-2">
									<ul class="tabs">
										<li class="selected" rel="tab-0">General</li>
										<li rel="tab-1"> Transition</li>
									</ul>
									<div class="tabs-content">
										<div class="tab tab-0">
											<input type="text" style="margin-bottom:5px;" class="slide_title" id="slide_title" placeholder="Caption"></input>
											<textarea	id="slide_desc" placeholder="Description"></textarea>
											<input type="text" class="slide_url"	id="slide_url" placeholder="URL" />
											<input type="hidden" id="slide_id" value="' . $slideid . '" />
										</div>
										<div class="tab tab-1" style="display:none">
											<div id="caption_div" style="margin:27px 0 26px 0;">
												<div class="caption_trans" >
													<label class="trans_label">Caption In</label>
													<select id="cap_trans_in" name="cap_trans_in" >
														' . $select1 . '
													</select>
												</div>
												<div class="caption_trans" >
													<label class="trans_label">Caption Out</label>
													<select id="cap_trans_out" name="cap_trans_out" >
														' . $select1 . '
													</select>
												</div>
											</div>
											<div id="desc_div" style="margin:18px 0 18px 0;">
												<div class="desc_trans">
													<label class="trans_label">Desc In</label>
													<select id="desc_trans_in" name="desc_trans_in">
														' . $select1 . '
													</select>
												</div>
												<div class="desc_trans">
													<label class="trans_label">DescOut</label>
													<select id="desc_trans_out" name="desc_trans_out">
														' . $select1 . '
													</select>
												</div>
											</div>
											<div id="slide_div" style="margin:18px 0 0 0;">
												<label class="trans_label">Slide</label>
												<select style="width:77%;" id="slide_trans" name="slide_trans">
													' . $select2 . '
												</select>
											</div>
										</div>
									</div>
								</td>
							</tr>';	
				array_push( $dynamicArray, $column2 );
				echo json_encode( $dynamicArray );
				die();
			}
			else if ( $_REQUEST['param'] == 'add_slide' ) {
				
				$ux_sliderid = intval( $_REQUEST['slider_id'] );
				$ux_img_name = esc_attr( html_entity_decode( $_REQUEST['imagename'] ) );
				$img_gb_path = esc_attr( $_REQUEST['img_gb_path'] );
	
				$wpdb->query
					(
						$wpdb->prepare
							(
								"INSERT INTO " . JssorSliderPlugin::jssor_slides() . " (slider_id,thumbnail_url,title,description,url,date,slide_name)
								VALUES(%d,%s,%s,%s,%s,CURDATE(),%s)",
								$ux_sliderid,
								$img_gb_path,
								"",
								"",
								"",
								$ux_img_name
								
							)
					);
				echo $slide_id = $wpdb->insert_id;
				$wpdb->query
					(
						$wpdb->prepare
							(
								"UPDATE " . JssorSliderPlugin::jssor_slides() . " SET sorting_order = %d WHERE slide_id = %d",
								$slide_id,
								$slide_id
							)
					);
					
				die();
			}
			else if ( $_REQUEST['param'] == 'update_slider' ) {
			
				$sliderId = intval( $_REQUEST['sliderid'] );
				$ux_edit_slider_name1 = htmlspecialchars( esc_attr( $_REQUEST['edit_slider_name'] ) );
				$ux_edit_slider_name = ( $ux_edit_slider_name1 == '' ) ? 'Untitled Slider' : $ux_edit_slider_name1;
				$sliderSets = json_decode( stripcslashes( $_REQUEST['slider_settings'] ), true );
			
				$sliderSettings= array(
					'slider_width' => $sliderSets[0],
					'slider_height' => $sliderSets[1],
					'slide_duration' => $sliderSets[2],
					'auto_interval' => $sliderSets[3],
					'auto_steps' => $sliderSets[4],
					'play_orient' => $sliderSets[5],
					'arrow_skin' => $sliderSets[6],
					'arrow_show' => $sliderSets[7],
					'bullet_skin' => $sliderSets[8],
					'bullet_show' => $sliderSets[9],
					'bullet_action' => $sliderSets[10],
					'bullet_spacing' => $sliderSets[11],
					'swipe' => $sliderSets[12],
					'auto_play' => $sliderSets[13],
					'pause_hover' => $sliderSets[14],
					'use_arrows' => $sliderSets[15],
					'use_bullets' => $sliderSets[16],
					'responsive' => $sliderSets[17]
				);
			 
				$sliderSettings2 = serialize( $sliderSettings );
				$wpdb->query
					(
						$wpdb->prepare
							(
								"UPDATE " . JssorSliderPlugin::jssor_sliders() . " SET slider_name = %s, slider_settings =%s WHERE slider_id = %d",
								$ux_edit_slider_name,
								$sliderSettings2,
								$sliderId
							)
					);
				die();
			}
			else if ( $_REQUEST['param'] == 'update_slide' ) {
			
				$slider_data = json_decode( stripcslashes( $_REQUEST['slider_data'] ), true);
				foreach( $slider_data as $field ) {
						
					$wpdb->query
						(
							$wpdb->prepare
								(
									"UPDATE " . JssorSliderPlugin::jssor_slides() . " SET title = %s, description = %s, url = %s, caption_in = %s, caption_out = %s, description_in = %s, description_out = %s ,slide_trans = %s, date = CURDATE() WHERE slide_id = %d",
									htmlspecialchars($field[1]),
									htmlspecialchars($field[2]),
									$field[3],
									$field[4],
									$field[5],
									$field[6],
									$field[7],
									$field[8],
									$field[0]
								)
						); 
	
				}
				die();
			}
			else if ( $_REQUEST['param'] == 'delete_slide' ) {
				
				$slideId = intval( $_REQUEST['slide_id'] );
				$slide_img = $wpdb->get_var
								(
									$wpdb->prepare
										(
											"SELECT thumbnail_url FROM " . JssorSliderPlugin::jssor_slides() . " WHERE slide_id= %d",
											$slideId
										)
								);
				$wpdb->query
					(
						$wpdb->prepare
							(
								"DELETE FROM " . JssorSliderPlugin::jssor_slides() . " WHERE slide_id = %d",
								$slideId
							)
					);
				
				@unlink( JSSOR_MAIN_UPLOAD_DIR.$slide_img );
				@unlink( JSSOR_MAIN_THUMB_DIR.$slide_img );
			
			}
			else if ( $_REQUEST['param'] == 'Delete_slider' ) {
			
				$slider_id = intval( $_REQUEST['slider_id'] );
				$slides = $wpdb->get_results
							(
								$wpdb->prepare
									(
										"SELECT * FROM " . JssorSliderPlugin::jssor_slides() . " WHERE slider_id = %d ORDER BY sorting_order ASC ",
										$slider_id
									)
							);
			
				for ( $flag = 0; $flag < count($slides); $flag++ ) {
					@unlink( JSSOR_MAIN_UPLOAD_DIR.$slides[$flag]->thumbnail_url );
					@unlink( JSSOR_MAIN_THUMB_DIR.$slides[$flag]->thumbnail_url );
				}
			
				$wpdb->query
					(
						$wpdb->prepare
							(
								"DELETE FROM " . JssorSliderPlugin::jssor_slides() . " WHERE slider_id = %d",
								$slider_id
							)
					);
					
				$wpdb->query
					(
						$wpdb->prepare
							(
								"DELETE FROM " . JssorSliderPlugin::jssor_sliders() . " WHERE slider_id = %d",
								$slider_id
							)
					);
				die();
			}
			else if ( $_REQUEST['param'] == 'update_order' ) {
		
				parse_str( $_REQUEST['order'], $slideOrder );
				foreach ( $slideOrder['slid'] as $key => $value ) {
					$wpdb->query
						(
							$wpdb->prepare
								(
									"UPDATE " . JssorSliderPlugin::jssor_slides() . " SET sorting_order = %d WHERE slide_id = %d",
									$key + 1,
									$value
								)
						);	
				}
			}
		}	

	function caption_select( $Caption_T ) { 
		
		$select = '';
		foreach( $Caption_T as $key=>$value ) {
			$select .= '<option value="'. $value.'">'. $key .'</option>'; 
		}
		return $select;
		
	}	

	function slide_select( $Slide_T ) { 
	 
		$select = '';
		foreach( $Slide_T as $key=>$value ) {
			$select .= '<option value="'. $value.'">'. $key .'</option>'; 
		}
		return $select;
		
	}

	function process_image_upload( $image, $width, $height ) {

		$temp_image_path = JSSOR_MAIN_UPLOAD_DIR . $image;
		$temp_image_name = $image;
		list(, , $temp_image_type) = getimagesize( $temp_image_path );
		if ( $temp_image_type === NULL ) {
			return false;
		}
		$uploaded_image_path = JSSOR_MAIN_UPLOAD_DIR . $temp_image_name;
		move_uploaded_file( $temp_image_path, $uploaded_image_path );
		$type = explode( '.', $image );
		$thumbnail_image_path = JSSOR_MAIN_THUMB_DIR . preg_replace( '{\\.[^\\.]+$}', '.'.$type[1], $temp_image_name );
	 
		$result = generate_thumbnail( $uploaded_image_path, $thumbnail_image_path, $width, $height );
		return $result ? array( $uploaded_image_path, $thumbnail_image_path ) : false;
		
	}

	function generate_thumbnail( $source_image_path, $thumbnail_image_path, $imageWidth, $imageHeight ) {

		list( $source_image_width, $source_image_height, $source_image_type ) = getimagesize( $source_image_path );
		$source_gd_image = false;
		switch ( $source_image_type ) {
			case IMAGETYPE_GIF:
				$source_gd_image = imagecreatefromgif( $source_image_path );
				break;
			case IMAGETYPE_JPEG:
				$source_gd_image = imagecreatefromjpeg( $source_image_path );
				break;
			case IMAGETYPE_PNG:
				$source_gd_image = imagecreatefrompng( $source_image_path );
				break;
		}
		if ( $source_gd_image === false ) {
			return false;
		}
		$source_aspect_ratio = $source_image_width / $source_image_height;
		if ( $source_image_width > $source_image_height ) {
			$real_height = $imageHeight;
			$real_width = $imageHeight * $source_aspect_ratio;
		} else if ( $source_image_height > $source_image_width ) {
			$real_height = $imageWidth / $source_aspect_ratio;
			$real_width = $imageWidth;
		} else {
			$real_height = $imageHeight > $imageWidth ? $imageHeight : $imageWidth;
			$real_width = $imageWidth > $imageHeight ? $imageWidth : $imageHeight;
		}

		$thumbnail_gd_image = imagecreatetruecolor( $real_width, $real_height );
		
		if ( ( $source_image_type == 1 ) || ( $source_image_type==3 ) ) {
			imagealphablending($thumbnail_gd_image, false);
			imagesavealpha( $thumbnail_gd_image, true );
			$transparent = imagecolorallocatealpha($thumbnail_gd_image, 255, 255, 255, 127);
			imagecolortransparent( $thumbnail_gd_image, $transparent );
			imagefilledrectangle( $thumbnail_gd_image, 0, 0, $real_width, $real_height, $transparent );
		} else {
			$bg_color = imagecolorallocate( $thumbnail_gd_image, 255, 255, 255 );
			imagefilledrectangle( $thumbnail_gd_image, 0, 0, $real_width, $real_height, $bg_color );
		}
	
		imagecopyresampled( $thumbnail_gd_image, $source_gd_image, 0, 0, 0, 0, $real_width, $real_height, $source_image_width, $source_image_height );
	
		switch ( $source_image_type ) {
			case IMAGETYPE_GIF:
				imagepng($thumbnail_gd_image, $thumbnail_image_path, 9 );
				break;
			case IMAGETYPE_JPEG:
				imagejpeg( $thumbnail_gd_image, $thumbnail_image_path, 100 );
				break;
			case IMAGETYPE_PNG:
				imagepng( $thumbnail_gd_image, $thumbnail_image_path, 9 );
				break;
		}
		
		imagedestroy( $source_gd_image );
		imagedestroy( $thumbnail_gd_image );
		return true;
		
	}
?>
