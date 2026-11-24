<?php 
/**
 * Default Header
 */
return array(
	'title'      => esc_html__( 'Default Header', 'sports-association' ),
	'categories' => array( 'sports-association', 'header' ),
	'content'    => '<!-- wp:group {"className":"main-header","style":{"spacing":{"padding":{"right":"0","left":"0","top":"0","bottom":"0"},"margin":{"top":"0","bottom":"0"},"blockGap":"0"}},"backgroundColor":"primary","layout":{"type":"default"}} -->
<div class="wp-block-group main-header has-primary-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"><!-- wp:group {"className":"bottom-header","style":{"border":{"top":{"color":"#2a2400","width":"1px"}},"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40"}}},"layout":{"type":"constrained","contentSize":"80%"}} -->
<div class="wp-block-group bottom-header" style="border-top-color:#2a2400;border-top-width:1px;padding-top:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40)"><!-- wp:columns {"verticalAlignment":"center","className":"bottom-header-boxes","style":{"spacing":{"blockGap":{"top":"14px","left":"14px"}}}} -->
<div class="wp-block-columns are-vertically-aligned-center bottom-header-boxes"><!-- wp:column {"verticalAlignment":"center","width":"25%","className":"header-logo"} -->
<div class="wp-block-column is-vertically-aligned-center header-logo" style="flex-basis:25%"><!-- wp:group {"className":"logo-box","layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group logo-box"><!-- wp:site-logo {"width":80,"shouldSyncIcon":true} /-->

<!-- wp:site-title {"style":{"elements":{"link":{"color":{"text":"var:preset|color|foreground"}}},"typography":{"fontSize":"26px","fontStyle":"normal","fontWeight":"700"}},"textColor":"foreground","fontFamily":"sports-association-poppins"} /--></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"55%","className":"menu-box","style":{"spacing":{"padding":{"top":"4px","bottom":"4px","left":"4px","right":"4px"}}}} -->
<div class="wp-block-column is-vertically-aligned-center menu-box" style="padding-top:4px;padding-right:4px;padding-bottom:4px;padding-left:4px;flex-basis:55%"><!-- wp:navigation {"textColor":"foreground","overlayBackgroundColor":"tertiary","overlayTextColor":"foreground","metadata":{"ignoredHookedBlocks":["woocommerce/customer-account","woocommerce/mini-cart"]},"className":"header-menu","style":{"typography":{"fontStyle":"normal","fontWeight":"400","textTransform":"capitalize","fontSize":"18px"},"spacing":{"blockGap":"var:preset|spacing|60"}},"fontFamily":"sports-association-teko","layout":{"type":"flex","justifyContent":"center"}} --><!-- wp:navigation-link {"label":"Home","type":"","url":"#","kind":"custom","isTopLevelLink":true} /-->

<!-- wp:navigation-link {"label":"About Us","type":"","url":"#","kind":"custom","isTopLevelLink":true} /-->

<!-- wp:navigation-link {"label":"Game","type":"","url":"#","kind":"custom","isTopLevelLink":true} /-->

<!-- wp:navigation-link {"label":"Pages","type":"","url":"#","kind":"custom","isTopLevelLink":true} /-->

<!-- wp:navigation-link {"label":"Blog","type":"","url":"#","kind":"custom","isTopLevelLink":true} /-->

<!-- wp:navigation-link {"label":"Buy Now","type":"link","opensInNewTab":true,"url":"' . esc_url( SPORTS_ASSOCIATION_BUY_NOW ) . '","kind":"custom","className":"buy-now-button"} /-->
<!-- /wp:navigation --></div>
<!-- /wp:column -->

<!-- wp:column {"width":"20%","className":"header-btn-box"} -->
<div class="wp-block-column header-btn-box" style="flex-basis:20%"><!-- wp:buttons {"className":"header-button","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|60"}}},"layout":{"type":"flex","justifyContent":"right"}} -->
<div class="wp-block-buttons header-button"><!-- wp:button {"textColor":"foreground","gradient":"button-gradient","className":"header-btn","style":{"border":{"radius":{"topLeft":"12px","topRight":"12px","bottomLeft":"12px","bottomRight":"12px"},"width":"2px","color":"#ffffff"},"spacing":{"padding":{"left":"16px","right":"16px","top":"10px","bottom":"10px"}},"elements":{"link":{"color":{"text":"var:preset|color|foreground"}}},"typography":{"fontSize":"14px","textTransform":"capitalize","fontStyle":"normal","fontWeight":"500"}}} -->
<div class="wp-block-button header-btn"><a class="wp-block-button__link has-foreground-color has-button-gradient-gradient-background has-text-color has-background has-link-color has-border-color has-custom-font-size wp-element-button" href="#" style="border-color:#ffffff;border-width:2px;border-top-left-radius:12px;border-top-right-radius:12px;border-bottom-left-radius:12px;border-bottom-right-radius:12px;padding-top:10px;padding-right:16px;padding-bottom:10px;padding-left:16px;font-size:14px;font-style:normal;font-weight:500;text-transform:capitalize">'. esc_html__('login / signup','sports-association').'</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->',
);