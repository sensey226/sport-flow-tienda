<?php

/**
 * Sanitize select field
 *
 * @param  string $input   Selected input
 * @param  string $setting Input setting
 */
function baseball_sports_club_sanitise_custom_option($input)
{
	return ($input === "No") ? "No" : "Yes";
}

function baseball_sports_club_sanitise_custom_text($input)
{
	return filter_var($input, FILTER_SANITIZE_STRING);
}

function baseball_sports_club_sanitize_additional_content_array($input_array)
{
	$sanitized_array = array();

	foreach ($input_array as $input) {
		$sanitized_array[] = sanitize_text_field($input);
	}

	return $sanitized_array;
}


function baseball_sports_club_sanitise_custom_texttitle($inputtitle)
{
	return filter_var($inputtitle, FILTER_SANITIZE_STRING);
}

function baseball_sports_club_sanitise_custom_url($input)
{
	return filter_var($input, FILTER_SANITIZE_URL);
}

function baseball_sports_club_sanitize_switch($input)
{
	if (true === $input) {
		return true;
	} else {
		return false;
	}
}


function baseball_sports_club_site_title_font_choices()
{
	return apply_filters('baseball_sports_club_site_title_font_choices', array(
		'aboreto'   => 'Aboreto',
		'lobster two' => 'Lobster Two',
		'norican'   => 'Norican',
		'arial'     => 'Arial',
		'verdana'   => 'Verdana, Geneva',
		'trebuchet' => 'Trebuchet',
		'georgia'   => 'Georgia',
		'times new roman'     => 'Times New Roman',
		'tahoma'    => 'Tahoma, Geneva',
		'palatino'  => 'Palatino',
		'helvetica' => 'Helvetica*',
		'abel'     => 'Abel',
		'abril fatface' => 'Abril Fatface',
		'aclonica'   => 'Aclonica',
		'adamina'     => 'Adamina',
		'advent pro'    => 'Advent Pro',
		'akronim'  => 'Akronim',
		'aladin' => 'Aladin',
		'aleo'     => 'Aleo',
		'alex brush'   => 'Alex Brush',
		'alice' => 'Alice',
		'alike'   => 'Alike',
		'almendra'     => 'Almendra',
		'arial black'     => 'Arial Black',
		'arial narrow'   => 'Arial narrow',
		'arial nova' => 'Arial Nova',
		'arnoldboecklin'   => 'Arnoldboecklin',
		'avanta'     => 'Avanta Garde',
		'bahnschrift'    => 'Bahnschrift',
		'bahnschrift light'  => 'Bahnschrift Light',
		'baskerville' => 'Baskerville',
		'b612'    => 'B612',
		'babylonica'  => 'Babylonica',
		'bad script' => 'Bad Script',
		'bangers'     => 'Bangers',
		'barrio'   => 'Barrio',
		'battambang' => 'Battambang',
		'bayon'   => 'Bayon',
		'bellota'     => 'Bellota',
		'babylonica'  => 'Babylonica',
		'batang'     => 'Batang',
		'batangChe'   => 'BatangChe',
		'big caslon' => 'Big Caslon',
		'bIZ udgothic'   => 'BIZ UDGothic',
		'blippo'     => 'Blippo',
		'bodoni mt'    => 'Bodoni MT',
		'book antiqua'  => 'Book Antiqua',
		'bookman' => 'Bookman',
		'bradley hand'     => 'Bradley Hand',
		'browallia new'   => 'Browallia New',
		'browalliaUPC' => 'BrowalliaUPC',
		'brush script mt'   => 'Brush Script MT',
		'brushscript script std'     => 'Brush Script Std',
		'brushstroke'    => 'Brushstroke',
		'calibri'  => 'Calibri',
		'calibri light' => 'Calibri Light',
		'calisto mt'     => 'Calisto MT',
		'cambodian'   => 'Cambodian',
		'cambria' => 'Cambria',
		'cambria math'   => 'Cambria Math',
		'candara'     => 'Candara',
		'century gothic'    => 'Century Gothic',
		'chalkduster'  => 'Chalkduster',
		'cherokee' => 'Cherokee',
		'comic sans'     => 'Comic Sans',
		'comicms sans ms'   => 'Comic Sans MS',
		'consolas' => 'Consolas',
		'constantia'   => 'Constantia',
		'copperplate'     => 'Copperplate',
		'corbel'    => 'Corbel',
		'cordia new'  => 'Cordia New',
		'cordiaUPC' => 'CordiaUPC',
		'cabin'     => 'Cabin',
		'cairo'   => 'Cairo',
		'calligraffitti' => 'Calligraffitti',
		'candal'   => 'Candal',
		'cherry swash'     => 'Cherry Swash',
		'chonburi'    => 'Chonburi',
		'cinzel decorative'  => 'Cinzel Decorative',
		'comfortaa' => 'Comfortaa',
		'coronetscript'     => 'Coronetscript',
		'courier'   => 'Courier',
		'Courier new' => 'Courier New',
		'daunPenh'   => 'DaunPenh',
		'david'     => 'David',
		'dengXian'    => 'DengXian',
		'didot'  => 'Didot',
		'dilleniaUPC' => 'DilleniaUPC',
		'dokChampa'     => 'DokChampa',
		'dotum'   => 'Dotum',
		'dotumChe' => 'DotumChe',
		'ebrima'   => 'Ebrima',
		'estrangelo edessa'     => 'Estrangelo Edessa',
		'eucrosiaUPC'    => 'EucrosiaUPC',
		'euphemia'  => 'Euphemia',
		'eangSong' => 'FangSong',
		'elorence'     => 'Florence',
		'franklin gothic medium'   => 'Franklin Gothic Medium',
		'frankRuehl' => 'FrankRuehl',
		'freesiaUPC'   => 'FreesiaUPC',
		'futara'     => 'Futara',
		'fondamento' => 'Fondamento',
		'gabriola'    => 'Gabriola',
		'gadugi'  => 'Gadugi',
		'garamond' => 'Garamond',
		'gautami'     => 'Gautami',
		'geneva'   => 'Geneva',
		'georgia' => 'Georgia',
		'georgia pro'   => 'Georgia Pro',
		'gill sans'     => 'Gill Sans',
		'gill sans nova'    => 'Gill Sans Nova',
		'gisha'  => 'Gisha',
		'goudy old style' => 'Goudy Old Style',
		'gulim'     => 'Gulim',
		'gungsuh'   => 'Gungsuh',
		'hebrew' => 'Hebrew',
		'hoefler text'   => 'Hoefler Text',
		'impact'     => 'Impact',
		'ink free'    => 'Ink Free',
		'irisUPC'  => 'IrisUPC',
		'iskoola pota' => 'Iskoola Pota',
		'japanese'     => 'Japanese',
		'jasmineUPC'   => 'JasmineUPC',
		'javanese text' => 'Javanese Text',
		'jazz let'   => 'Jazz LET',
		'kaiTi'     => 'KaiTi',
		'kalinga'    => 'Kalinga',
		'kartika'  => 'Kartika',
		'kokila' => 'Kokila',
		'lao'     => 'Lao',
		'Lato'    => 'Lato',
		'latha'   => 'Latha',
		'leelawadee' => 'Leelawadee',
		'levenim mt'   => 'Levenim MT',
		'lucida bright'     => 'Lucida Bright',
		'lucida console'    => 'Lucida Console',
		'lucida handwriting'  => 'Lucida Handwriting',
		'lucida sans' => 'Lucida Sans',
		'malgun gothic'     => 'Malgun Gothic',
		'mangal'   => 'Mangal',
		'marker felt' => 'Marker Felt',
		'meiryo'   => 'Meiryo',
		'microsoft sans serif'     => 'Microsoft Sans Serif',
		'microsoft tai le'    => 'Microsoft Tai Le',
		'miriam'  => 'Miriam',
		'monaco' => 'Monaco',
		'Montserrat' => 'Montserrat',
		'mystery quest'     => 'Mystery Quest',
		'nerko one'   => 'Nerko One',
		'nokora' => 'Nokora',
		'notable'   => 'Notable',
		'noto emoji'     => 'Noto Emoji',
		'oldenburg'    => 'Oldenburg',
		'oleo script'  => 'Oleo Script',
		'open sans' => 'Open Sans',
		'oregano'     => 'Oregano',
		'overpass'   => 'Overpass',
		'Oswald'     => 'Oswald',
		'pt mono' => 'PT Mono',
		'palanquin'   => 'Palanquin',
		'play'     => 'Play',
		'podkova'    => 'Podkova',
		'poppins'  => 'Poppins',
		'prata' => 'Prata',
		'playfair display' => 'Playfair Display',
		'radley'     => 'Radley',
		'raleway'   => 'Raleway',
		'ramaraja' => 'Ramaraja',
		'rhodium libre'   => 'Rhodium Libre',
		'roboto'     => 'Roboto',
		'Roboto Condensed' => 'Roboto Condensed',
		'ruda'    => 'Ruda',
		'sahitya'  => 'Sahitya',
		'salsa' => 'Salsa',
		'sanchez'     => 'Sanchez',
		'send flowers'   => 'Send Flowers',
		'shanti' => 'Shanti',
		'shippori mincho'   => 'Shippori Mincho',
		'solway'     => 'Solway',
		'sofia'    => 'Sofia',
		'tapestry'  => 'Tapestry',
		'texturina' => 'Texturina',
		'tillana'     => 'Tillana',
		'xanh mono'   => 'Xanh Mono',
		'yeon sung' => 'Yeon Sung',
		'yuji boku'   => 'Yuji Boku',
		'yusei magic'     => 'Yusei Magic',
		'zen antique'    => 'Zen Antique',
		'zen dots'  => 'Zen Dots',
		'zen old mincho' => 'Zen Old Mincho',
	));
}

// // =========================================

if ( ! function_exists( 'baseball_sports_club_sanitize_select' ) ) :

// 	/**
// 	 * Sanitize select.
// 	 *
// 	 * @since 1.0.0
// 	 *	
// 	 */
	function baseball_sports_club_sanitize_select( $input, $setting ) {

		// Ensure input is a slug.
		$input = sanitize_key( $input );

		// Get list of choices from the control associated with the setting.
		$choices = $setting->manager->get_control( $setting->id )->choices;

		// If the input is a valid key, return it; otherwise, return the default.
		return ( array_key_exists( $input, $choices ) ? $input : $setting->default );

	}

endif;

if ( ! function_exists( 'baseball_sports_club_dropdown_pages' ) ) :
	function baseball_sports_club_dropdown_pages( $page_id, $setting ) {
	  // Ensure $input is an absolute integer.
	  $page_id = absint( $page_id );
	  
	  // If $page_id is an ID of a published page, return it; otherwise, return the default.
	  return ( 'publish' == get_post_status( $page_id ) ? $page_id : $setting->default );
	}
endif;

// 	/**
// 	 * Post Dropdown.
// 	 *
// 	 * @since 1.0.0	 *
// 	 */
	function baseball_sports_club_dropdown_posts() {

		$posts = get_posts( array( 'numberposts' => -1 ) );
		$choices = array();
		$choices[0] = esc_html__( '--Select--', 'baseball-sports-club' );
		foreach ( $posts as $post ) {
			$choices[$post->ID] = $post->post_title;
		}
		return $choices;
	}

// endif;

	function baseball_sports_club_dropdown_sliders() {

		$posts = get_posts( array( 'post_type'   => 'sliders', 'numberposts' => -1 ) );
		$choices = array();
		$choices[0] = esc_html__( '--Select--', 'baseball-sports-club' );
		foreach ( $posts as $post ) {
			$choices[$post->ID] = $post->post_title;
		}
		return $choices;
	}

// endif;

function baseball_sports_club_sanitize_post_dropdown( $input ) {
	// Ensure the input is an integer (post ID).
	$input = absint( $input );

	// Check if the post exists in the database.
	if ( get_post( $input ) ) {
		return $input; // Return the valid post ID.
	} else {
		return ''; // Return empty if it's invalid.
	}
}

// / whatweoffer
if ( ! function_exists( 'baseball_sports_club_dropdown_whatweoffer' ) ) :

	/**
	 * Post Dropdown.
	 *
	 * @since 1.0.0	 *
	 */
	function baseball_sports_club_dropdown_whatweoffer() {

		$posts = get_posts( array( 'post_type'   => 'whatweoffer', 'numberposts' => -1 ) );
		$choices = array();
		$choices[0] = esc_html__( '--Select--', 'baseball-sports-club' );
		foreach ( $posts as $post ) {
			$choices[$post->ID] = $post->post_title;
		}
		return $choices;
	}

endif;

// Text Case
if ( ! function_exists( 'baseball_sports_club_sanitize_choices' ) ) :

	function baseball_sports_club_sanitize_choices( $input, $setting ) {
		global $wp_customize; 
		$control = $wp_customize->get_control( $setting->id ); 
		if ( array_key_exists( $input, $control->choices ) ) {
			return $input;
		} else {
			return $setting->default;
		}
	}
	
	endif;

	// padding
	if ( ! function_exists( 'baseball_sports_club_sanitize_number_range' ) ) :

		/**
		 * Sanitize number range.
		 */
		function baseball_sports_club_sanitize_number_range( $input, $setting ) {
	
			// Get the input attributes associated with the setting.
			$atts = $setting->manager->get_control($setting->id)->input_attrs;
	
			// Ensure input is a float within the specified range.
			$input = floatval($input);
			$min = isset($atts['min']) ? $atts['min'] : 0;
			$max = isset($atts['max']) ? $atts['max'] : 100;
			$step = isset($atts['step']) ? $atts['step'] : 1;
	
			// Sanitize the input.
			$input = max($min, min($max, $input));
			$input = round($input / $step) * $step;
	
			return $input;
		}
	
	endif;

	
	if ( ! function_exists( 'baseball_sports_club_sanitize_sortable' ) ) :
		/**
		* Sanitizes strings in array
		* @param  $input entered value
		* @return sanitized output
		*
		* @since baseball-sports-club 1.0
		*/
		function baseball_sports_club_sanitize_sortable( $input ) {
	
			// Ensure $input is an array.
			if ( ! is_array( $input ) )
				$input = explode( ',', $input );
	
			$output = array_map( 'sanitize_text_field', $input );
	
			return implode( ',', $output );
		}
	endif;