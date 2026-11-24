<?php
/**
 * Template for displaying search forms
 *
 * @package baseball-sports-club
 */

?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <label style="display: inline;">
        <span
            class="screen-reader-text"><?php echo esc_html_x( 'Search for:', 'label', 'baseball-sports-club' ) ?></span>

    </label>
    <div class="custom-search" style=" position: relative;">
        <input type="search" class="search-field"
            placeholder="<?php echo esc_attr_x( 'Search ...', 'placeholder', 'baseball-sports-club' ) ?>"
            value="<?php the_search_query() ?>" name="s"
            title="<?php echo esc_attr_x( 'Search for:', 'label', 'baseball-sports-club' ) ?>" />
        <button type="submit" class="search-submit"
            value="<?php echo esc_attr_x( 'Search', 'submit button', 'baseball-sports-club' ) ?>"><i
                class="fas fa-search"></i></button>
    </div>
</form>