<?php
/**
 * Customizer Custom Controls
 */

if ( class_exists( 'WP_Customize_Section' ) ) {
	/**
	 * Upsell section
	 */
	class Baseball_Sports_Club_Upsell_Section extends WP_Customize_Section {
		/**
		 * The type of control being rendered
		 */
		public $type = 'baseball_sports_club-upsell';

		/**
		 * The Upsell button text
		 */
		public $button_text = '';

		/**
		 * The Upsell URL
		 */
		public $url = '';

		/**
		 * The background color for the control
		 */
		public $background_color = '';

		/**
		 * The text color for the control
		 */
		public $text_color = '';

		/**
		 * Render the section, and the controls that have been added to it.
		 */
		protected function baseball_sports_club_render() {
			$background_color = ! empty( $this->background_color ) ? esc_attr( $this->background_color ) : '#fff';
			$text_color       = ! empty( $this->text_color ) ? esc_attr( $this->text_color ) : '#50575e';
			?>
			<li id="accordion-section-<?php echo esc_attr( $this->id ); ?>" class="baseball_sports_club_upsell_section accordion-section control-section control-section-<?php echo esc_attr( $this->id ); ?> cannot-expand">
				<h3 class="accordion-section-title" style="color:<?php echo esc_attr( $text_color ); ?>;background:<?php echo esc_attr( $background_color ); ?>;border-left-color:<?php echo esc_attr( $background_color ); ?>;">
					<?php echo esc_html( $this->title ); ?>
					<a href="<?php echo esc_url( $this->url ); ?>" class="button button-secondary alignright" target="_blank" style="margin-top: -4px;"><?php echo esc_html( $this->button_text ); ?></a>
				</h3>
			</li>
			<?php
		}
	}
}

if ( class_exists( 'WP_Customize_Control' ) ) {
	class baseball_sports_club_Custom_Text_Control extends WP_Customize_Control {
        public $type = 'customtext';
        public $extra = ''; 
        public function baseball_sports_club_render_content() {
        ?>
        <label>            
            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
            <span style="padding-bottom: 10px;"><?php echo esc_html( $this->extra ); ?></span>
            <input type="text" style="margin-top:5px;" value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); ?> />
        </label>
        <?php
        }
    }
}

if ( class_exists( 'WP_Customize_Control' ) ) {
	class baseball_sports_club_Separator_Custom_control extends WP_Customize_Control{
	        public $type = 'separator';
	        public function baseball_sports_club_render_content(){
	                ?>
	                <p><hr></p>
	                <?php
	        }
	}    

}