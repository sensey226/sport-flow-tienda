<?php
class baseball_sports_club_My_Customize_Section_Label extends WP_Customize_Section {
    public $type = 'my_custom_section_label';
    public $pro_text;
    public $pro_url;

    public function __construct( $manager, $id, $args = array(), $control = null ) {
        $this->pro_text = isset( $args['pro_text'] ) ? $args['pro_text'] : '';
        $this->pro_url = isset( $args['pro_url'] ) ? $args['pro_url'] : '';

        parent::__construct( $manager, $id, $args, $control );
    }

    public function baseball_sports_club_render() {
        ?>
        <li id="<?php echo esc_attr( $this->id ); ?>" class="customize-control customize-control-<?php echo esc_attr( $this->type ); ?>">
            <h3 class="customize-control-title"><?php echo esc_html( $this->title ); ?></h3>
            <?php if ( $this->pro_text && $this->pro_url ) : ?>
                <a href="<?php echo esc_url( $this->pro_url ); ?>" class="button" target="_blank"><?php echo esc_html( $this->pro_text ); ?></a>
            <?php endif; ?>
        </li>
        <?php
    }
}
