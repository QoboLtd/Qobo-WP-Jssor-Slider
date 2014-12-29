<?php
/**
 * Helper class for slide transition,arrow and bullet skin
 */
class JssorSliderHelper {
	
	/**
	 * Return the a formatted $result array
	 *
	 * @param array $result 
	 * @return array
	 */
	public static function format_R( $result ) {
		
		foreach( $result as $key => $value ) {
			if ( $key = 'NULL' ) {
				$result[$key] = 'NO';	
			}
		}
		return $result;
		
	}	
	
	/**
	 * Return the javascript for the slide transition
	 *
	 * @param array $slides
	 * @return string
	 */
	public static function getslide_trans( $slides ) {
		
		$string = '';
		for( $flag = 0; $flag < count($slides); $flag++ ) {
			$trans = $slides[$flag]->slide_trans;
			if ( ( $trans == 'NULL' ) || ( $trans == NULL ) ) {
				continue;
			}
			$string .= $trans . ",\n";
		}
		return $string;
		
	}
	
	/**
	 * Return the javascript for the caption transition
	 *
	 * @param array $slides
	 * @param array $result 
	 * @return string
	 */
	public static function getcaption_trans( $slides, $result, $string_id ) {
	 
		$string = '';
		for( $flag = 0; $flag < count($slides) ; $flag++ ) {
			$trans = $slides[$flag]->$string_id;
			if ( ( $trans == 'NULL' ) || ( $trans == NULL ) ) {
				continue;
			}
			$string .= "_CaptionTransitions[\"" . $result[$trans] . "\"] = " . $trans . ";\n";
		}
		return $string;
		
	}
	
	/**
	 * Return the css,width and height of the arrow skin
	 *
	 * @param string $arrow 
	 * @return array
	 */
	public static function arrowSkin( $arrow ) {
		
		switch( $arrow ){
			case 'a01':
				$style = '.jssora01l,.jssora01r,.jssora01ldn,.jssora01rdn { position:absolute; cursor:pointer; display:block; background:url( ' . JSSOR_SL_PLUGIN_URL . '/assets/images/arrows/a01.png ) no-repeat; overflow:hidden; }  .jssora01l:hover { background-position:-128px -38px; }  .jssora01r:hover { background-position:-188px -38px; }  .jssora01l,.jssora01ldn { background-position:-8px -38px; }  .jssora01r,.jssora01rdn { background-position:-68px -38px; }';
				$width = '45';  $height = '45';
				return array( $style, $width, $height );
			case 'a02' :
				$style = '.jssora02l,.jssora02r,.jssora02ldn,.jssora02rdn { position:absolute; cursor:pointer; display:block; background:url( ' . JSSOR_SL_PLUGIN_URL . '/assets/images/arrows/a02.png ) no-repeat; overflow:hidden; }  .jssora02l:hover { background-position:-123px -33px; }  .jssora02r:hover { background-position:-183px -33px; }  .jssora02l,.jssora02ldn { background-position:-3px -33px; }  .jssora02r,.jssora02rdn { background-position:-63px -33px; }';
				$width = '55'; $height = '55';
				return array( $style, $width, $height );
			case 'a03' :
				$style = '.jssora03l,.jssora03r,.jssora03ldn,.jssora03rdn { position:absolute; cursor:pointer; display:block; background:url( ' . JSSOR_SL_PLUGIN_URL . '/assets/images/arrows/a03.png ) no-repeat; overflow:hidden; }  .jssora03l { background-position:-3px -33px; }  .jssora03r { background-position:-63px -33px; }  .jssora03l:hover { background-position:-123px -33px; }  .jssora03r:hover { background-position:-183px -33px; }  .jssora03ldn { background-position:-243px -33px; }  .jssora03rdn { background-position:-303px -33px; }';
				$width = '55';  $height = '55';
				return array( $style, $width, $height );
			case 'a04' :
				$style = '.jssora04l,.jssora04r,.jssora04ldn,.jssora04rdn { position:absolute; cursor:pointer; display:block; background:url( ' . JSSOR_SL_PLUGIN_URL . '/assets/images/arrows/a04.png ) no-repeat; overflow:hidden; }  .jssora04l { background-position:-16px -39px; }  .jssora04r { background-position:-76px -39px; }  .jssora04l:hover { background-position:-136px -39px; }  .jssora04r:hover { background-position:-196px -39px; }  .jssora04ldn { background-position:-256px -39px; }  .jssora04rdn { background-position:-316px -39px; }';
				$width = '28'; $height = '40';
				return array( $style, $width, $height );
			case 'a05' :
				$style = '.jssora05l,.jssora05r,.jssora05ldn,.jssora05rdn { position:absolute; cursor:pointer; display:block; background:url( ' . JSSOR_SL_PLUGIN_URL . '/assets/images/arrows/a05.png ) no-repeat; overflow:hidden; }  .jssora05l { background-position:-10px -40px; }  .jssora05r { background-position:-70px -40px; }  .jssora05l:hover { background-position:-130px -40px; }  .jssora05r:hover { background-position:-190px -40px; }  .jssora05ldn { background-position:-250px -40px; }  .jssora05rdn { background-position:-310px -40px; }';
				$width = '40'; $height= '40';
				return array ( $style, $width, $height );
			case 'a06' :
				$style = '.jssora06l,.jssora06r,.jssora06ldn,.jssora06rdn { position:absolute; cursor:pointer; display:block; background:url( ' . JSSOR_SL_PLUGIN_URL . '/assets/images/arrows/a06.png ) no-repeat; overflow:hidden; }  .jssora06l { background-position:-8px -38px; }  .jssora06r { background-position:-68px -38px; }  .jssora06l:hover { background-position:-128px -38px; }  .jssora06r:hover { background-position:-188px -38px; }  .jssora06ldn { background-position:-248px -38px; }  .jssora06rdn { background-position:-308px -38px; }';
				$width = '45'; $height= '45';
				return array ( $style, $width, $height );
			case 'a07' :
				$style = '.jssora07l,.jssora07r,.jssora07ldn,.jssora07rdn { position:absolute; cursor:pointer; display:block; background:url( ' . JSSOR_SL_PLUGIN_URL . '/assets/images/arrows/a07.png ) no-repeat; overflow:hidden; }  .jssora07l { background-position:-5px -35px; }  .jssora07r { background-position:-65px -35px; }  .jssora07l:hover { background-position:-125px -35px; }  .jssora07r:hover { background-position:-185px -35px; }  .jssora07ldn { background-position:-245px -35px; }  .jssora07rdn { background-position:-305px -35px; }';
				$width = '50'; $height= '50';
				return array ( $style, $width, $height );
			case 'a08' :
				$style = '.jssora08l,.jssora08r,.jssora08ldn,.jssora08rdn { position:absolute; cursor:pointer; display:block; background:url( ' . JSSOR_SL_PLUGIN_URL . '/assets/images/arrows/a08.png ) no-repeat; overflow:hidden; }  .jssora08l { background-position:-3px -33px; }  .jssora08r { background-position:-63px -33px; }  .jssora08l:hover { background-position:-123px -33px; }  .jssora08r:hover { background-position:-183px -33px; }  .jssora08ldn { background-position:-243px -33px; }  .jssora08rdn { background-position:-303px -33px; }';
				$width = '55'; $height= '55';
				return array ( $style, $width, $height );	
			case 'a09' :
				$style = '.jssora09l,.jssora09r,.jssora09ldn,.jssora09rdn { position:absolute; cursor:pointer; display:block; background:url( ' . JSSOR_SL_PLUGIN_URL . '/assets/images/arrows/a09.png ) no-repeat; overflow:hidden; opacity:.4; filter:alpha(opacity=40); }  .jssora09l { background-position:-5px -35px; }  .jssora09r { background-position:-65px -35px; }  .jssora09l:hover { background-position:-5px -35px; opacity:.8; filter:alpha(opacity=80); }  .jssora09r:hover { background-position:-65px -35px; opacity:.8; filter:alpha(opacity=80); }  .jssora09ldn { background-position:-5px -35px; opacity:.3; filter:alpha(opacity=30); }  .jssora09rdn { background-position:-65px -35px; opacity:.3; filter:alpha(opacity=30); }';
				$width = '50'; $height= '50';
				return array ( $style, $width, $height );
			case 'a10' :
				$style = '.jssora10l,.jssora10r,.jssora10ldn,.jssora10rdn { position:absolute; cursor:pointer; display:block; background:url( ' . JSSOR_SL_PLUGIN_URL . '/assets/images/arrows/a10.png ) no-repeat; overflow:hidden; }  .jssora10l { background-position:-16px -39px; }  .jssora10r { background-position:-76px -39px; }  .jssora10l:hover { background-position:-136px -39px; }  .jssora10r:hover { background-position:-196px -39px; }  .jssora10ldn { background-position:-256px -39px; }  .jssora10rdn { background-position:-316px -39px; }';
				$width = '28'; $height= '40';
				return array ( $style, $width, $height );
			case 'a11' :
				$style = '.jssora11l,.jssora11r,.jssora11ldn,.jssora11rdn { position:absolute; cursor:pointer; display:block; background:url( ' . JSSOR_SL_PLUGIN_URL . '/assets/images/arrows/a11.png ) no-repeat; overflow:hidden; }  .jssora11l { background-position:-11px -41px; }  .jssora11r { background-position:-71px -41px; }  .jssora11l:hover { background-position:-131px -41px; }  .jssora11r:hover { background-position:-191px -41px; }  .jssora11ldn { background-position:-251px -41px; }  .jssora11rdn { background-position:-311px -41px; }';
				$width = '37'; $height= '37';
				return array ( $style, $width, $height );
			case 'a12' :
				$style = '.jssora12l,.jssora12r,.jssora12ldn,.jssora12rdn { position:absolute; cursor:pointer; display:block; background:url( ' . JSSOR_SL_PLUGIN_URL . '/assets/images/arrows/a12.png ) no-repeat; overflow:hidden; }  .jssora12l { background-position:-16px -37px; }  .jssora12r { background-position:-75px -37px; }  .jssora12l:hover { background-position:-136px -37px; }  .jssora12r:hover { background-position:-195px -37px; }  .jssora12ldn { background-position:-256px -37px; }  .jssora12rdn { background-position:-315px -37px; }';
				$width = '30'; $height = '46'; $border = true;	
				return array ( $style, $width, $height, $border );
			case 'a13' :
				$style = '.jssora13l,.jssora13r,.jssora13ldn,.jssora13rdn { position:absolute; cursor:pointer; display:block; background:url( ' . JSSOR_SL_PLUGIN_URL . '/assets/images/arrows/a13.png ) no-repeat; overflow:hidden; }  .jssora13l { background-position:-10px -35px; }  .jssora13r { background-position:-70px -35px; }  .jssora13l:hover { background-position:-130px -35px; }  .jssora13r:hover { background-position:-190px -35px; }  .jssora13ldn { background-position:-250px -35px; }  .jssora13rdn { background-position:-310px -35px; }';
				$width = '40'; $height = '50'; $border = true;	
				return array ( $style, $width, $height, $border );
			case 'a14' :
				$style = '.jssora14l,.jssora14r,.jssora14ldn,.jssora14rdn { position:absolute; cursor:pointer; display:block; background:url( ' . JSSOR_SL_PLUGIN_URL . '/assets/images/arrows/a14.png ) no-repeat; overflow:hidden; }  .jssora14l { background-position:-15px -35px; }  .jssora14r { background-position:-75px -35px; }  .jssora14l:hover { background-position:-135px -35px; }  .jssora14r:hover { background-position:-195px -35px; }  .jssora14ldn { background-position:-255px -35px; }  .jssora14rdn { background-position:-315px -35px; }';
				$width = '30'; $height = '50'; $border = true;	
				return array ( $style, $width, $height, $border );
			case 'a15' :
				$style = '.jssora15l,.jssora15r,.jssora15ldn,.jssora15rdn { position:absolute; cursor:pointer; display:block; background:url( ' . JSSOR_SL_PLUGIN_URL . '/assets/images/arrows/a15.png ) no-repeat; overflow:hidden; }  .jssora15l { background-position:-20px -41px; }  .jssora15r { background-position:-80px -41px; }  .jssora15l:hover { background-position:-140px -41px; }  .jssora15r:hover { background-position:-200px -41px; }  .jssora15ldn { background-position:-260px -41px; }  .jssora15rdn { background-position:-320px -41px; }';
				$width = '20'; $height = '38';	
				return array ( $style, $width, $height );
			case 'a16' :
				$style = '.jssora16l,.jssora16r,.jssora16ldn,.jssora16rdn { position:absolute; cursor:pointer; display:block; background:url( ' . JSSOR_SL_PLUGIN_URL . '/assets/images/arrows/a16.png ) no-repeat; overflow:hidden; }  .jssora16l { background-position:-19px -42px; }  .jssora16r { background-position:-79px -42px; }  .jssora16l:hover { background-position:-139px -42px; }  .jssora16r:hover { background-position:-199px -42px; }  .jssora16ldn { background-position:-259px -42px; }  .jssora16rdn { background-position:-319px -42px; }';
				$width = '22'; $height = '36';	
				return array ( $style, $width, $height );
			case 'a17' :
				$style = '.jssora17l,.jssora17r,.jssora17ldn,.jssora17rdn { position:absolute; cursor:pointer; display:block; background:url( ' . JSSOR_SL_PLUGIN_URL . '/assets/images/arrows/a17.png ) center center no-repeat; overflow:hidden; }  .jssora17l { background-position:-3px -33px; }  .jssora17r { background-position:-63px -33px; }  .jssora17l:hover { background-position:-123px -33px; }  .jssora17r:hover { background-position:-183px -33px; }  .jssora17ldn { background-position:-243px -33px; }  .jssora17rdn { background-position:-303px -33px; }';
				$width = '55'; $height = '55';	
				return array ( $style, $width, $height );
			case 'a18' :
				$style = '.jssora18l,.jssora18r,.jssora18ldn,.jssora18rdn { position:absolute; cursor:pointer; display:block; background:url( ' . JSSOR_SL_PLUGIN_URL . '/assets/images/arrows/a18.png ) no-repeat; overflow:hidden; }  .jssora18l { background-position:-16px -45px; }  .jssora18r { background-position:-76px -45px; }  .jssora18l:hover { background-position:-136px -45px; }  .jssora18r:hover { background-position:-196px -45px; }  .jssora18ldn { background-position:-256px -45px; }  .jssora18rdn { background-position:-316px -45px; }';
				$width = '29'; $height = '29';	
				return array ( $style, $width, $height );
			case 'a19' :
				$style = '.jssora19l,.jssora19r,.jssora19ldn,.jssora19rdn { position:absolute; cursor:pointer; display:block; background:url( ' . JSSOR_SL_PLUGIN_URL . '/assets/images/arrows/a19.png ) no-repeat; overflow:hidden; }  .jssora19l { background-position:-5px -35px; }  .jssora19r { background-position:-65px -35px; }  .jssora19l:hover { background-position:-125px -35px; }  .jssora19r:hover { background-position:-185px -35px; }  .jssora19ldn { background-position:-245px -35px; }  .jssora19rdn { background-position:-305px -35px; }';
				$width = '50'; $height = '50';	
				return array ( $style, $width, $height );
		}
		
	}
	 
	/**
	 * Return the css and numbertemplate of the bullet skin
	 *
	 * @param string $bullet 
	 * @return array
	 */
	public static function bulletSkin( $bullet ) {
		
		switch( $bullet ){
			case 'b01':
				$style1 = '.jssorb01 div,.jssorb01 div:hover,.jssorb01 .av { filter:alpha(opacity=70); opacity:.7; overflow:hidden; cursor:pointer; border:#000 1px solid; }  .jssorb01 div { background-color:gray; }  .jssorb01 div:hover,.jssorb01 .av:hover { background-color:#d3d3d3; }  .jssorb01 .av { background-color:#fff; }  .jssorb01 .dn,.jssorb01 .dn:hover { background-color:#555; }';
				$style2 = 'position: absolute; width: 12px; height: 12px;';
				$NT = NULL;
				return array( $style1, $style2, $NT );
			case 'b02' :
				$style1 = '.jssorb02 div,.jssorb02 div:hover,.jssorb02 .av { background:url( ' . JSSOR_SL_PLUGIN_URL . '/assets/images/bullets/b02.png ) no-repeat; overflow:hidden; cursor:pointer; }  .jssorb02 div { background-position:-5px -5px; }  .jssorb02 div:hover,.jssorb02 .av:hover { background-position:-35px -5px; }  .jssorb02 .av { background-position:-65px -5px; }  .jssorb02 .dn,.jssorb02 .dn:hover { background-position:-95px -5px; }';
				$style2	= 'position: absolute; width: 21px; height: 21px; text-align:center; line-height:21px; color:white; font-size:12px;';			
				$NT = '<NumberTemplate></NumberTemplate>';
				return array( $style1, $style2, $NT );
			case 'b03' :
				$style1 = '.jssorb03 div,.jssorb03 div:hover,.jssorb03 .av { background:url( ' . JSSOR_SL_PLUGIN_URL . '/assets/images/bullets/b03.png ) no-repeat; overflow:hidden; cursor:pointer; }  .jssorb03 div { background-position:-5px -4px; }  .jssorb03 div:hover,.jssorb03 .av:hover { background-position:-35px -4px; }  .jssorb03 .av { background-position:-65px -4px; }  .jssorb03 .dn,.jssorb03 .dn:hover { background-position:-95px -4px; }';
				$style2	= 'position: absolute; width: 21px; height: 21px; text-align:center; line-height:21px; color:white; font-size:12px;';			
				$NT = '<numbertemplate></numbertemplate>';
				return array( $style1, $style2, $NT );	
			case 'b04' :
				$style1 = '.jssorb04 div,.jssorb04 div:hover,.jssorb04 .av { background:url( ' . JSSOR_SL_PLUGIN_URL . '/assets/images/bullets/b04.png ) no-repeat; overflow:hidden; cursor:pointer; }  .jssorb04 div { background-position:-5px -5px; }  .jssorb04 div:hover,.jssorb04 .av:hover { background-position:-35px -5px; }  .jssorb04 .av { background-position:-65px -5px; }  .jssorb04 .dn,.jssorb04 .dn:hover { background-position:-95px -5px; }';
				$style2	= 'position: absolute; width: 19px; height: 19px; text-align:center; line-height:19px; color:White; font-size:12px;';			
				$NT = NULL;
				return array( $style1, $style2, $NT );
			case 'b05' :
				$style1 = '.jssorb05 div,.jssorb05 div:hover,.jssorb05 .av { background:url( ' . JSSOR_SL_PLUGIN_URL . '/assets/images/bullets/b05.png ) no-repeat; overflow:hidden; cursor:pointer; }  .jssorb05 div { background-position:-7px -7px; }  .jssorb05 div:hover,.jssorb05 .av:hover { background-position:-37px -7px; }  .jssorb05 .av { background-position:-67px -7px; }  .jssorb05 .dn,.jssorb05 .dn:hover { background-position:-97px -7px; }';
				$style2 = 'position: absolute; width: 16px; height: 16px;';	
				$NT = NULL;
				return array( $style1, $style2, $NT );
			case 'b06' :
				$style1 = '.jssorb06 div,.jssorb06 div:hover,.jssorb06 .av { background:url( ' . JSSOR_SL_PLUGIN_URL . '/assets/images/bullets/b06.png ) no-repeat; overflow:hidden; cursor:pointer; }  .jssorb06 div { background-position:-6px -6px; }  .jssorb06 div:hover,.jssorb06 .av:hover { background-position:-36px -6px; }  .jssorb06 .av { background-position:-66px -6px; }  .jssorb06 .dn,.jssorb06 .dn:hover { background-position:-96px -6px; }';
				$style2 = 'position: absolute; width: 18px; height: 18px;';	
				$NT = NULL;
				return array( $style1, $style2, $NT );
			case 'b07' :
				$style1 = '.jssorb07 div,.jssorb07 div:hover,.jssorb07 .av { background:url( ' . JSSOR_SL_PLUGIN_URL . '/assets/images/bullets/b07.png ) no-repeat; overflow:hidden; cursor:pointer; }  .jssorb07 div { background-position:-5px -5px; }  .jssorb07 div:hover,.jssorb07 .av:hover { background-position:-35px -5px; }  .jssorb07 .av { background-position:-65px -5px; }  .jssorb07 .dn,.jssorb07 .dn:hover { background-position:-95px -5px; }';
				$style2 = 'position: absolute; width: 20px; height: 20px;';	
				$NT = NULL;
				return array( $style1, $style2, $NT );
			case 'b08' :
				$style1 = '.jssorb08 div,.jssorb08 div:hover,.jssorb08 .av { background:url( ' . JSSOR_SL_PLUGIN_URL . '/assets/images/bullets/b08.png ) no-repeat; overflow:hidden; cursor:pointer; }  .jssorb08 div { background-position:-5px -5px; }  .jssorb08 div:hover,.jssorb08 .av:hover { background-position:-35px -5px; }  .jssorb08 .av { background-position:-65px -5px; }  .jssorb08 .dn,.jssorb08 .dn:hover { background-position:-95px -5px; }';
				$style2 = 'position: absolute; width: 19px; height: 19px; text-align:center; line-height:19px; color:White; font-size:12px;';	
				$NT = '<NumberTemplate></NumberTemplate>';
				return array( $style1, $style2, $NT );
			case 'b09' :
				$style1 = '.jssorb09 div,.jssorb09 div:hover,.jssorb09 .av { filter:alpha(opacity=70); opacity:.7; overflow:hidden; cursor:pointer; border:#fff 1px solid; }  .jssorb09 div { background-color:#d3d3d3; }  .jssorb09 div:hover,.jssorb09 .av:hover { background-color:gray; }  .jssorb09 .av { background-color:#000; }  .jssorb09 .dn,.jssorb09 .dn:hover { background-color:#a9a9a9; }';
				$style2 = 'position: absolute; width: 12px; height: 12px;';	
				$NT = NULL;
				return array( $style1, $style2, $NT );
			case 'b10' :
				$style1 = '.jssorb10 div,.jssorb10 div:hover,.jssorb10 .av { background:url( ' . JSSOR_SL_PLUGIN_URL . '/assets/images/bullets/b10.png ) no-repeat; overflow:hidden; cursor:pointer; }  .jssorb10 div { background-position:-10px -10px; }  .jssorb10 div:hover,.jssorb10 .av:hover { background-position:-40px -10px; }  .jssorb10 .av { background-position:-70px -10px; }  .jssorb10 .dn,.jssorb10 .dn:hover { background-position:-100px -10px; }';
				$style2 = 'position: absolute; width: 11px; height: 11px;';	
				$NT = NULL;
				return array( $style1, $style2, $NT );
			case 'b11' :
				$style1 = '.jssorb11 div,.jssorb11 div:hover,.jssorb11 .av { background:url( ' . JSSOR_SL_PLUGIN_URL . '/assets/images/bullets/b11.png ) no-repeat; overflow:hidden; cursor:pointer; }  .jssorb11 div { background-position:-10px -10px; }  .jssorb11 div:hover,.jssorb11 .av:hover { background-position:-40px -10px; }  .jssorb11 .av { background-position:-70px -10px; }  .jssorb11 .dn,.jssorb11 .dn:hover { background-position:-100px -10px; }';
				$style2 = 'position: absolute; width: 11px; height: 11px;';	
				$NT = NULL;
				return array( $style1, $style2, $NT );
			case 'b12' :
				$style1 = '.jssorb12 div,.jssorb12 div:hover,.jssorb12 .av { background:url( ' . JSSOR_SL_PLUGIN_URL . '/assets/images/bullets/b12.png ) no-repeat; overflow:hidden; cursor:pointer; }  .jssorb12 div { background-position:-7px -7px; }  .jssorb12 div:hover,.jssorb12 .av:hover { background-position:-37px -7px; }  .jssorb12 .av { background-position:-67px -7px; }  .jssorb12 .dn,.jssorb12 .dn:hover { background-position:-97px -7px; }';
				$style2 = 'position: absolute; width: 16px; height: 16px;';	
				$NT = NULL;
				return array( $style1, $style2, $NT );
			case 'b13' :
				$style1 = '.jssorb13 div,.jssorb13 div:hover,.jssorb13 .av { background:url( ' . JSSOR_SL_PLUGIN_URL . '/assets/images/bullets/b13.png ) no-repeat; overflow:hidden; cursor:pointer; }  .jssorb13 div { background-position:-5px -5px; }  .jssorb13 div:hover,.jssorb13 .av:hover { background-position:-35px -5px; }  .jssorb13 .av { background-position:-65px -5px; }  .jssorb13 .dn,.jssorb13 .dn:hover { background-position:-95px -5px; }';
				$style2 = 'position: absolute; width: 21px; height: 21px;';	
				$NT = NULL;
				return array( $style1, $style2, $NT );
			case 'b14' :
				$style1 = '.jssorb14 div,.jssorb14 div:hover,.jssorb14 .av { background:url( ' . JSSOR_SL_PLUGIN_URL . '/assets/images/bullets/b14.png ) no-repeat; overflow:hidden; cursor:pointer; }  .jssorb14 div { background-position:-9px -9px; }  .jssorb14 div:hover,.jssorb14 .av:hover { background-position:-39px -9px; }  .jssorb14 .av { background-position:-69px -9px; }  .jssorb14 .dn,.jssorb14 .dn:hover { background-position:-99px -9px;';
				$style2 = 'position: absolute; width: 12px; height: 12px;';	
				$NT = NULL;
				return array( $style1, $style2, $NT );
			case 'b15' :
				$style1 = '.jssorb15 div,.jssorb15 div:hover,.jssorb15 .av { background:url( ' . JSSOR_SL_PLUGIN_URL . '/assets/images/bullets/b15.png ) no-repeat; overflow:hidden; cursor:pointer; }  .jssorb15 div { background-position:-3px -3px; }  .jssorb15 div:hover,.jssorb15 .av:hover { background-position:-33px -3px; }  .jssorb15 .av { background-position:-63px -3px; }  .jssorb15 .dn,.jssorb15 .dn:hover { background-position:-93px -3px; }  .jssorb15 .n { display:none; color:#000; }  .jssorb15 div:hover .n,.jssorb15 .av .n,.jssorb15 .av:hover .n,.jssorb15 .dn .n { display:block; }';
				$style2 = 'position: absolute; width: 24px; height: 24px; text-align: center;line-height: 24px; font-size: 16px;';	
				$NT = '<Numbertemplate class=n></Numbertemplate>';
				return array( $style1, $style2, $NT );
			case 'b16' :
				$style1 = '.jssorb16 div,.jssorb16 div:hover,.jssorb16 .av { background:url( ' . JSSOR_SL_PLUGIN_URL . '/assets/images/bullets/b16.png ) no-repeat; overflow:hidden; cursor:pointer; }  .jssorb16 div { background-position:-5px -5px; }  .jssorb16 div:hover,.jssorb16 .av:hover { background-position:-35px -5px; }  .jssorb16 .av { background-position:-65px -5px; }  .jssorb16 .dn,.jssorb16 .dn:hover { background-position:-95px -5px; }';
				$style2 = 'position: absolute; width: 21px; height: 21px;';	
				$NT = NULL;
				return array( $style1, $style2, $NT );
			case 'b17' :
				$style1 = '.jssorb17 div,.jssorb17 div:hover,.jssorb17 .av { background:url( ' . JSSOR_SL_PLUGIN_URL . '/assets/images/bullets/b17.png ) no-repeat; overflow:hidden; cursor:pointer; }  .jssorb17 div { background-position:-7px -7px; }  .jssorb17 div:hover,.jssorb17 .av:hover { background-position:-37px -7px; }  .jssorb17 .av { background-position:-67px -7px; }  .jssorb17 .dn,.jssorb17 .dn:hover { background-position:-97px -7px; }';
				$style2 = 'position: absolute; width: 16px; height: 16px;';	
				$NT = NULL;
				return array( $style1, $style2, $NT );	
		}
		
	}
	
}

?>
