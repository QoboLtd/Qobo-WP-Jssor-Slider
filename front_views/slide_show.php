<?php
	$result = array_flip( $Caption_Transition );
	$slides = $wpdb->get_results
				(
					$wpdb->prepare
						(
							"SELECT * FROM " .JssorSliderPlugin::jssor_slides() . " WHERE slider_id = %d ORDER BY sorting_order ASC ",
							$slider_id
						)
				);

	$slider = $wpdb->get_row
				(
					$wpdb->prepare
						(
							"SELECT * FROM " .JssorSliderPlugin::jssor_sliders() . " WHERE slider_id = %d",
							$slider_id
						)
				);

	if ( !$slider ) {

		_e( "<-- jssor slider id=".$slider_id." not found -->", jssor_slider );
		return;
	}

	$settings = unserialize( $slider->slider_settings );
	$sliderW = ( $settings[slider_width ]) ? ( $settings[slider_width] ) : '600';
	$sliderH = ( $settings[slider_height] ) ? ( $settings[slider_height] ) : '300';
	$slideD = ( $settings[slide_duration] ) ? ( $settings[slide_duration] ) : '500';
	$aPlay = ( $settings[auto_play] ) ? 'true' : 'false';
	$aPlay_Int = ( $settings[auto_interval] ) ? ( $settings[auto_interval] ) : '3000';
	$auto_Steps = ( $settings[auto_steps] ) ? ( $settings[auto_steps] ) : '1';
	$play_Orient = ( $settings[play_orient] ) ? ( $settings[play_orient] ) : '1';
	$pauseH = ( $settings[pause_hover] ) ? ( $settings[pause_hover] ):	'1';
	$responsive = ( $settings[responsive] );
	$swipe = ( $settings[swipe] ) ? ( $settings[swipe] ) : '0';
	$descH = $sliderH - 50;

	$use_arrows = $settings[use_arrows];
	$arrow = $settings[arrow_skin];
	$arrow_show = ( $settings[arrow_show ]) ? ( $settings[arrow_show] ) : '1';
	$arrowSkin = JssorSliderHelper::arrowSkin( $arrow )[0];
	$arrowWidth = JssorSliderHelper::arrowSkin( $arrow )[1];
	$arrowHeight = JssorSliderHelper::arrowSkin( $arrow )[2];
	$arrowBorder = JssorSliderHelper::arrowSKin ( $arrow )[3];
	$arrowL = 'jssor' . $arrow . 'l';
	$arrowR = 'jssor' . $arrow . 'r';

	$use_bullets = $settings[use_bullets];
	$bullet_show = ( $settings[bullet_show] ) ? ( $settings[bullet_show] ) : '1' ;
	$bullet_action = ( $settings[bullet_action] ) ? ( $settings[bullet_action] ) : '1';
	$bullet_spacing = ( $settings[bullet_spacing] ) ? ( $settings[bullet_spacing] ) : '10';
	$bullet = $settings[bullet_skin];
	$bulletStyle1 = JssorSliderHelper::bulletSkin( $bullet )[0];
	$bulletStyle2 = JssorSliderHelper::bulletSkin( $bullet )[1];
	$bulletNT = JssorSliderHelper::bulletSkin( $bullet )[2];
	$bulletCl = 'jssor' . $bullet;

	$slide_trans = JssorSliderHelper::getslide_trans( $slides );

	$captionIn_trans = JssorSliderHelper::getcaption_trans( $slides, $result, $string_id = 'caption_in' );
	$captionOut_trans = JssorSliderHelper::getcaption_trans( $slides, $result, $string_id = 'caption_out' );
	$decriptionIn_trans = JssorSliderHelper::getcaption_trans( $slides, $result, $string_id = 'description_in' );
	$decriptionOut_trans = JssorSliderHelper::getcaption_trans( $slides, $result, $string_id = 'description_out' );

	$caption_trans = $captionIn_trans.$captionOut_trans.$decriptionIn_trans.$decriptionOut_trans;
	$result2 = JssorSliderHelper::format_R( $result );

?>

	<script type='text/javascript'>
		jQuery(document).ready(function ($) {
			var _SlideshowTransitions = [<?php echo $slide_trans; ?>];
			var _CaptionTransitions = [];<?php echo $caption_trans; ?>
			var options = {
				$AutoPlay: <?php echo $aPlay; ?>,
				$AutoPlaySteps: <?php echo $auto_Steps; ?>,
				$AutoPlayInterval: <?php echo $aPlay_Int; ?>,
				$PauseOnHover: <?php echo $pauseH; ?>,
				$ArrowKeyNavigation: true,
				$SlideDuration: <?php echo $slideD; ?>,
				$MinDragOffsetToSlide: 20,
				$SlideSpacing: 0,
				$DisplayPieces: 1,
				$ParkingPosition: 0,
				$UISearchMode: 1,
				$PlayOrientation: <?php echo $play_Orient; ?>,
				$DragOrientation: <?php echo $swipe; ?>,
				$SlideshowOptions: {
					$Class: $JssorSlideshowRunner$,
					$Transitions: _SlideshowTransitions,
					$TransitionsOrder: 1,
					$ShowLink: true
				},
				$CaptionSliderOptions: {
					$Class: $JssorCaptionSlider$,
					$CaptionTransitions: _CaptionTransitions,
					$PlayInMode: 1,
					$PlayOutMode: 3
				},
				$BulletNavigatorOptions: {
					$Class: $JssorBulletNavigator$,
					$ChanceToShow: <?php echo $bullet_show; ?>,
					$AutoCenter: 1,
					$ActionMode: <?php echo $bullet_action; ?>,
					$Lanes: 1,
					$SpacingX: <?php echo $bullet_spacing; ?>,
					$SpacingY: 10
				},
				$ArrowNavigatorOptions: {
					$Class: $JssorArrowNavigator$,
					$ChanceToShow: <?php echo $arrow_show; ?>
				},
				$ThumbnailNavigatorOptions: {
					$Class: $JssorThumbnailNavigator$,
					$ChanceToShow: 2,
					$ActionMode: 0,
					$DisableDrag: true,
					$Orientation: 2
				}
			};
			var jssor_slider<?php echo $slider_id; ?> = new $JssorSlider$("slider_container_<?php echo $slider_id; ?>", options);
				<?php if ( $responsive ) : ?>
				function ScaleSlider() {
					var parentWidth = jssor_slider<?php echo $slider_id; ?>.$Elmt.parentNode.clientWidth;
					if (parentWidth)
						jssor_slider<?php echo $slider_id; ?>.$SetScaleWidth(Math.min(parentWidth,<?php echo $sliderW; ?>))
					else
					window.setTimeout(ScaleSlider, 30);
				}
				ScaleSlider();
				if (!navigator.userAgent.match(/(iPhone|iPod|iPad|BlackBerry|IEMobile)/)) {
					jQuery(window).bind('resize', ScaleSlider);
				}<?php endif; ?>
		});
	</script>

	<div id="slider_container_<?php echo $slider_id; ?>" style="position: relative; width:<?php echo $sliderW; ?>px; height:<?php echo $sliderH; ?>px;" class="jssor-slider">
		<!-- Slides Container -->
		<div u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width:<?php echo $sliderW; ?>px; height:<?php echo $sliderH; ?>px; overflow: hidden;">
			<!-- Slide -->
			<?php for ( $flag = 0;$flag < count($slides); $flag++ ) : ?>
			<div>
				<img u="image" src="<?php echo stripcslashes(JSSOR_SL_THUMB_URL . $slides[$flag]->thumbnail_url); ?>" />
				<?php 	if ( $slides[$flag]->title ) : ?>
				<div u="caption" t="<?php echo $result2[$slides[$flag]->caption_in]; ?>" t2="<?php echo $result2[$slides[$flag]->caption_out]; ?>" style="position: absolute; top: 20px; left: 20px; height: 30px; color: #ffffff; font-size: 20px; line-height: 30px;"><?php echo html_entity_decode( $slides[$flag]->title ); ?></div>
				<?php endif;
					if ( $slides[$flag]->description ) :
				?>
				<div u="caption" t="<?php echo $result2[$slides[$flag]->description_in]; ?>" t2="<?php echo $result2[$slides[$flag]->description_out]; ?>" style="position: absolute; top: <?php echo $descH; ?>px; left: 0px;width: 800px; height: 50px;">
					<div style="position: absolute; top: 0px; left: 0px; width: <?php echo $sliderW; ?>px; height: 50px;background-color: Black; opacity: 0.5; filter: alpha(opacity=50);"></div>
					<div style="position: absolute; top: 0px; left: 0px; width: <?php echo $sliderW; ?>px; height: 30px;color: White; font-size: 16px; font-weight: bold; line-height: 30px; text-align: center;">
						<?php if ( $slides[$flag]->url ) : ?>
							<a style="text-decoration:none;" target="_blank" href="<?php echo html_entity_decode($slides[$flag]->url  ); ?>"><?php echo html_entity_decode( $slides[$flag]->description  ); ?></a>
						<?php else : ?>
							<?php echo html_entity_decode( $slides[$flag]->description ); ?>
						<?php endif; ?>
					</div>
				</div>
				<?php endif; ?>
			</div>
			<!-- Slide -->
			<?php endfor; ?>
		</div>

		<!-- Bullet Navigator Skin Begin -->
		<?php if ( $use_bullets ) : ?>
		<style>
			<?php echo $bulletStyle1; ?>
		</style>

		<!-- bullet navigator container -->
		<div u="navigator" class="<?php echo $bulletCl; ?>" style="position: absolute; bottom: 4px;">
			<!-- bullet navigator item prototype -->
			<div u="prototype" style="<?php echo $bulletStyle2; ?>"><?php echo $bulletNT; ?></div>
		</div>
		<?php endif; ?>
		<!-- Bullet Navigator Skin End -->

		<!-- Arrow Navigator Skin Begin -->
		<?php if ( $use_arrows ) : ?>
		<style>
			<?php echo $arrowSkin; ?>
		</style>
		<!-- Arrow Left -->
		<span u="arrowleft" class="<?php echo $arrowL; ?>" style="width:<?php echo $arrowWidth; ?>px; height:<?php echo $arrowHeight; ?>px; top: 45%; left: <?php echo $arrowBorder? '0' : '8'?>px;"></span>
		<!-- Arrow Right -->
		<span u="arrowright" class="<?php echo $arrowR; ?>" style="width:<?php echo $arrowWidth; ?>px; height:<?php echo $arrowHeight; ?>px; top: 45%; right: <?php echo $arrowBorder? '0' : '8'?>px"></span>
		<?php endif; ?>
		<!-- Arrow Navigator Skin End -->

	</div>
