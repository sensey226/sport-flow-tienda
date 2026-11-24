<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package baseball-sports-club
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function baseball_sports_club_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'baseball_sports_club_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function baseball_sports_club_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'baseball_sports_club_pingback_header' );

if(class_exists('WP_Customize_Control')){
	class Baseball_Sports_Club_Toggle_Checkbox_Custom_control extends WP_Customize_Control{
		public $type = 'toogle_checkbox';
		public function enqueue(){
			// wp_enqueue_style( 'custom_controls_css', get_template_directory_uri().'/inc/customizer/css/custom_controls.css');
		}
		public function render_content(){
			?>
			<div class="checkbox_switch">
				<div class="onoffswitch">
					<input type="checkbox" id="<?php echo esc_attr($this->id); ?>" name="<?php echo esc_attr($this->id); ?>" class="onoffswitch-checkbox" value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); checked( $this->value() ); ?>>
					<label class="onoffswitch-label" for="<?php echo esc_attr($this->id); ?>"></label>
				</div>
				<span class="customize-control-title onoffswitch_label"><?php echo esc_html( $this->label ); ?></span>
				<p><?php echo wp_kses_post($this->description); ?></p>
			</div>
			<?php
		}
	}
}

if ( ! function_exists( 'baseball_sports_club_the_excerpt' ) ) :

	/**
	 * Generate excerpt.
	 *
	 * @since 1.0.0
	 *
	 * @param int     $length Excerpt length in words.
	 * @param WP_Post $post_obj WP_Post instance (Optional).
	 * @return string Excerpt.
	 */
	function baseball_sports_club_the_excerpt( $length = 0, $post_obj = null ) {

		global $post;

		if ( is_null( $post_obj ) ) {
			$post_obj = $post;
		}

		$length = absint( $length );

		if ( 0 === $length ) {
			return;
		}

		$source_content = $post_obj->post_content;

		if ( ! empty( $post_obj->post_excerpt ) ) {
			$source_content = $post_obj->post_excerpt;
		}

		$source_content = preg_replace( '`\[[^\]]*\]`', '', $source_content );
		$trimmed_content = wp_trim_words( $source_content, $length, '&hellip;' );
		return $trimmed_content;

	}

endif;

//  Customizer Control
if (class_exists('WP_Customize_Control') && ! class_exists( 'Baseball_Sports_Club_Image_Radio_Control' ) ) {
	/**
 	* Customize sidebar layout control.
 	*/
	class Baseball_Sports_Club_Image_Radio_Control extends WP_Customize_Control {

		public function render_content() {

			if (empty($this->choices))
				return;

			$name = '_customize-radio-' . $this->id;
			?>
			<span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
			<ul class="controls" id='baseball_sports_club-img-container'>
				<?php
				foreach ($this->choices as $value => $label) :
					$class = ($this->value() == $value) ? 'baseball_sports_club-radio-img-selected baseball_sports_club-radio-img-img' : 'baseball_sports_club-radio-img-img';
					?>
					<li style="display: inline;">
						<label>
							<input <?php $this->link(); ?>style = 'display:none' type="radio" value="<?php echo esc_attr($value); ?>" name="<?php echo esc_attr($name); ?>" <?php
							  $this->link();
							  checked($this->value(), $value);
							  ?> />
							<img src='<?php echo esc_url($label); ?>' class='<?php echo esc_attr($class); ?>' />
						</label>
					</li>
					<?php
				endforeach;
				?>
			</ul>
			<?php
		}

	}
}

// color
function baseball_sports_club_addColorPalatOption($wpCustomizer, $id, $section, $label="Choose Color", $color = '#ffffff'){
    $wpCustomizer->add_setting(
        $id,
        array(
            'default'           => $color,
            'sanitize_callback' => 'sanitize_hex_color',
            'priority' => 1
        )
    );
    $wpCustomizer->add_control(
        new WP_Customize_Color_Control(
            $wpCustomizer,
            $id,
            array(
                'settings'      => $id,
                'section'       => $section,
                'label' => $label,
            )
        )
    );
}
