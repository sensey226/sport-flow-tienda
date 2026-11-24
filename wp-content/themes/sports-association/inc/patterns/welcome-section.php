<?php 
/**
 * Default Welcome Section
 */

return array(
	'title'      => esc_html__( 'Welcome Section', 'sports-association' ),
	'categories' => array( 'sports-association', 'Welcome Section' ),
	'content'    => '<!-- wp:group {"className":"welcome-section","layout":{"type":"constrained","contentSize":"80%"}} -->
<div class="wp-block-group welcome-section"><!-- wp:columns {"verticalAlignment":"center","className":"welcome-head-box wow fadeInDown","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|60"},"blockGap":{"top":"5px","left":"20%"}}}} -->
<div class="wp-block-columns are-vertically-aligned-center welcome-head-box wow fadeInDown" style="margin-bottom:var(--wp--preset--spacing--60)"><!-- wp:column {"verticalAlignment":"center","width":"25%","className":"welcome-left"} -->
<div class="wp-block-column is-vertically-aligned-center welcome-left" style="flex-basis:25%"><!-- wp:paragraph {"className":"welcome-sub-title","style":{"elements":{"link":{"color":{"text":"var:preset|color|background"}}},"typography":{"textTransform":"capitalize","fontStyle":"normal","fontWeight":"400","fontSize":"15px"}},"textColor":"background"} -->
<p class="welcome-sub-title has-background-color has-text-color has-link-color" style="font-size:15px;font-style:normal;font-weight:400;text-transform:capitalize">'. esc_html__('welcome to victoryarena','sports-association').'</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"className":"welcome-main-title","style":{"typography":{"fontSize":"30px","fontStyle":"normal","fontWeight":"500","textTransform":"capitalize"},"spacing":{"margin":{"top":"5px"}}}} -->
<h2 class="wp-block-heading welcome-main-title" style="margin-top:5px;font-size:30px;font-style:normal;font-weight:500;text-transform:capitalize">'. esc_html__('experience sports like never before','sports-association').'</h2>
<!-- /wp:heading --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"75%","className":"welcome-right"} -->
<div class="wp-block-column is-vertically-aligned-center welcome-right" style="flex-basis:75%"><!-- wp:paragraph {"className":"welcome-desc","style":{"elements":{"link":{"color":{"text":"#0a0b0fcc"}}},"color":{"text":"#0a0b0fcc"}}} -->
<p class="welcome-desc has-text-color has-link-color" style="color:#0a0b0fcc">'. esc_html__('At VictoryArena, we don’t just watch sports — we live it. Since 2021, our platform has been a hub for fans, athletes, and enthusiasts of all levels, from beginners to professionals.','sports-association').'</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:columns {"className":"welcome-boxes"} -->
<div class="wp-block-columns welcome-boxes"><!-- wp:column {"className":"welcome-box wow zoomIn","style":{"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"}}}} -->
<div class="wp-block-column welcome-box wow zoomIn" style="padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"><!-- wp:cover {"overlayColor":"primary","isUserOverlayColor":true,"className":"welcome-inner","style":{"border":{"radius":{"topLeft":"12px","topRight":"12px","bottomLeft":"12px","bottomRight":"12px"}},"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60","left":"0","right":"0"}}},"layout":{"type":"constrained","contentSize":"85%"}} -->
<div class="wp-block-cover welcome-inner" style="border-top-left-radius:12px;border-top-right-radius:12px;border-bottom-left-radius:12px;border-bottom-right-radius:12px;padding-top:var(--wp--preset--spacing--60);padding-right:0;padding-bottom:var(--wp--preset--spacing--60);padding-left:0"><span aria-hidden="true" class="wp-block-cover__background has-primary-background-color has-background-dim-100 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:group {"className":"welcome-icon","layout":{"type":"default"}} -->
<div class="wp-block-group welcome-icon"><!-- wp:html -->
<svg width="43" height="31" viewBox="0 0 43 31" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M21.5 15.5C9.62461 15.5 0 12.0286 0 7.75C0 3.47135 9.62461 0 21.5 0C33.3754 0 43 3.47135 43 7.75C43 12.0286 33.3754 15.5 21.5 15.5ZM0 23.25V14.4263C1.41934 15.4193 3.10742 16.2185 4.87949 16.8562C9.33066 18.4628 15.2096 19.375 21.5 19.375C27.7904 19.375 33.6693 18.4628 38.1205 16.8562C39.901 16.2185 41.5807 15.4193 43 14.4263V23.25C43 27.5286 33.3754 31 21.5 31C9.62461 31 0 27.5286 0 23.25Z" fill="var(--wp--preset--color--background)"/>
</svg>
<!-- /wp:html --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"className":"welcome-inner-desc","style":{"elements":{"link":{"color":{"text":"var:preset|color|foreground"}}},"typography":{"fontStyle":"normal","fontWeight":"300","lineHeight":"2.2"},"spacing":{"margin":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}},"textColor":"foreground"} -->
<p class="welcome-inner-desc has-foreground-color has-text-color has-link-color" style="margin-top:var(--wp--preset--spacing--60);margin-bottom:var(--wp--preset--spacing--60);font-style:normal;font-weight:300;line-height:2.2">'. esc_html__('Professional stadiums and world-class sports facilities with advanced lighting, turf quality, and climate-ready environments — experience every game at its best, in any season.','sports-association').'</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"className":"welcome-inner-btn"} -->
<div class="wp-block-buttons welcome-inner-btn"><!-- wp:button {"textColor":"background","style":{"spacing":{"padding":{"left":"0px","right":"0px","top":"0px","bottom":"0px"}},"elements":{"link":{"color":{"text":"var:preset|color|background"}}},"typography":{"fontSize":"15px","textTransform":"capitalize","fontStyle":"normal","fontWeight":"400"}}} -->
<div class="wp-block-button"><a class="wp-block-button__link has-background-color has-text-color has-link-color has-custom-font-size wp-element-button" style="padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px;font-size:15px;font-style:normal;font-weight:400;text-transform:capitalize"><svg width="33" height="13" viewBox="0 0 33 13" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect width="32.5" height="13" rx="6.5" fill="var(--wp--preset--color--background)"></rect>
<circle cx="23.4002" cy="6.49999" r="5.2" fill="white"></circle>
<circle cx="23.3999" cy="6.5" r="3.25" fill="var(--wp--preset--color--background)"></circle>
</svg>'. esc_html__(' live match mode','sports-association').'</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div></div>
<!-- /wp:cover --></div>
<!-- /wp:column -->

<!-- wp:column {"className":"welcome-box wow zoomIn"} -->
<div class="wp-block-column welcome-box wow zoomIn"><!-- wp:cover {"url":"' . esc_url( get_theme_file_uri( '/assets/images/sports-img.png' ) ) .'","id":66,"dimRatio":80,"overlayColor":"primary","isUserOverlayColor":true,"sizeSlug":"full","className":"welcome-inner","style":{"border":{"radius":{"topLeft":"12px","topRight":"12px","bottomLeft":"12px","bottomRight":"12px"},"width":"1px"}},"borderColor":"background","layout":{"type":"constrained","contentSize":"85%"}} -->
<div class="wp-block-cover welcome-inner has-border-color has-background-border-color" style="border-width:1px;border-top-left-radius:12px;border-top-right-radius:12px;border-bottom-left-radius:12px;border-bottom-right-radius:12px"><img class="wp-block-cover__image-background wp-image-66 size-full" alt="" src="' . esc_url( get_theme_file_uri( '/assets/images/sports-img.png' ) ) .'" data-object-fit="cover"/><span aria-hidden="true" class="wp-block-cover__background has-primary-background-color has-background-dim-80 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:wpzoom-video-popup-block/block {"url":"https://www.youtube.com/embed/D0UnqGm_miA?si=od4bG74xHvQYrZ3s","text":"","icon":4,"className":"welcome-video"} -->
<a class="wp-block-wpzoom-video-popup-block-block wpzoom-video-popup-block welcome-video" href="https://www.youtube.com/embed/D0UnqGm_miA?si=od4bG74xHvQYrZ3s" data-popup-width="900px"><span class="wpzoom-video-popup-block_icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" aria-hidden="true"><path d="m2 28.221v-24.522c0-2.8431 2.9657-4.6201 5.2336-3.1985l20.935 12.261c2.4424 1.4216 2.4424 5.1531 0 6.5747l-20.935 12.261c-2.2679 1.2439-5.2336-0.53308-5.2336-3.3762z" fill="currentColor"></path></svg></span></a>
<!-- /wp:wpzoom-video-popup-block/block -->

<!-- wp:paragraph {"align":"center","className":"welcome-video-text","style":{"typography":{"fontSize":"16px","textTransform":"capitalize"},"elements":{"link":{"color":{"text":"var:preset|color|foreground"}}}},"textColor":"foreground"} -->
<p class="has-text-align-center welcome-video-text has-foreground-color has-text-color has-link-color" style="font-size:16px;text-transform:capitalize">'. esc_html__('live matches &amp; training sessions','sports-association').'</p>
<!-- /wp:paragraph --></div></div>
<!-- /wp:cover --></div>
<!-- /wp:column -->

<!-- wp:column {"className":"welcome-box wow zoomIn","style":{"spacing":{"padding":{"top":"0","bottom":"0"}}}} -->
<div class="wp-block-column welcome-box wow zoomIn" style="padding-top:0;padding-bottom:0"><!-- wp:cover {"overlayColor":"primary","isUserOverlayColor":true,"className":"welcome-inner","style":{"border":{"radius":{"topLeft":"12px","topRight":"12px","bottomLeft":"12px","bottomRight":"12px"}},"spacing":{"padding":{"right":"0px","left":"0px"}}},"layout":{"type":"constrained","contentSize":"85%"}} -->
<div class="wp-block-cover welcome-inner" style="border-top-left-radius:12px;border-top-right-radius:12px;border-bottom-left-radius:12px;border-bottom-right-radius:12px;padding-right:0px;padding-left:0px"><span aria-hidden="true" class="wp-block-cover__background has-primary-background-color has-background-dim-100 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:paragraph {"className":"welcome-in-count","style":{"elements":{"link":{"color":{"text":"var:preset|color|background"}}},"typography":{"fontSize":"32px"}},"textColor":"background"} -->
<p class="welcome-in-count has-background-color has-text-color has-link-color" style="font-size:32px">'. esc_html__('100K+','sports-association').'</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"active-text","style":{"elements":{"link":{"color":{"text":"var:preset|color|foreground"}}},"typography":{"textTransform":"capitalize","fontStyle":"normal","fontWeight":"500","fontSize":"14px"},"spacing":{"margin":{"top":"0px"}}},"textColor":"foreground"} -->
<p class="active-text has-foreground-color has-text-color has-link-color" style="margin-top:0px;font-size:14px;font-style:normal;font-weight:500;text-transform:capitalize">'. esc_html__('active viewers','sports-association').'</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"welcome-inner-desc","style":{"elements":{"link":{"color":{"text":"var:preset|color|foreground"}}},"typography":{"fontStyle":"normal","fontWeight":"300","lineHeight":"2.2"}},"textColor":"foreground"} -->
<p class="welcome-inner-desc has-foreground-color has-text-color has-link-color" style="font-style:normal;font-weight:300;line-height:2.2">'. esc_html__('Thousands of fans join live every day to watch matches, highlights, and exclusive sports content from around the world.','sports-association').'</p>
<!-- /wp:paragraph -->

<!-- wp:group {"className":"bar-box","layout":{"type":"default"}} -->
<div class="wp-block-group bar-box"><!-- wp:group {"className":"progress-barline","layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
<div class="wp-block-group progress-barline"><!-- wp:paragraph {"align":"left","className":"label","style":{"elements":{"link":{"color":{"text":"var:preset|color|body-text"}}},"typography":{"fontSize":"15px","fontStyle":"normal","fontWeight":"400","textTransform":"capitalize"},"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"},"margin":{"top":"0","bottom":"0","left":"0","right":"0"}}},"textColor":"body-text"} -->
<p class="has-text-align-left label has-body-text-color has-text-color has-link-color" style="margin-top:0;margin-right:0;margin-bottom:0;margin-left:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;font-size:15px;font-style:normal;font-weight:400;text-transform:capitalize">'. esc_html__('live matches','sports-association').'</p>
<!-- /wp:paragraph -->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"0px","bottom":"0px","left":"0px","right":"0px"}},"border":{"radius":{"topLeft":"6px","topRight":"6px","bottomLeft":"6px","bottomRight":"6px"}}},"layout":{"type":"default"}} -->
<div class="wp-block-group" style="border-top-left-radius:6px;border-top-right-radius:6px;border-bottom-left-radius:6px;border-bottom-right-radius:6px;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px"><!-- wp:paragraph {"className":"bar","style":{"typography":{"fontSize":"14px","fontStyle":"normal","fontWeight":"600"},"border":{"radius":{"topLeft":"6px","topRight":"6px","bottomLeft":"6px","bottomRight":"6px"}}},"fontFamily":"urbanist"} -->
<p class="bar has-urbanist-font-family" style="border-top-left-radius:6px;border-top-right-radius:6px;border-bottom-left-radius:6px;border-bottom-right-radius:6px;font-size:14px;font-style:normal;font-weight:600"></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"align":"center","className":"percent","style":{"elements":{"link":{"color":{"text":"var:preset|color|foreground"}}},"typography":{"fontSize":"15px","fontStyle":"normal","fontWeight":"400"},"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"},"margin":{"top":"0","bottom":"0","left":"0","right":"0"}}},"textColor":"foreground"} -->
<p class="has-text-align-center percent has-foreground-color has-text-color has-link-color" style="margin-top:0;margin-right:0;margin-bottom:0;margin-left:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;font-size:15px;font-style:normal;font-weight:400">'. esc_html__('24','sports-association').'</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"bar-box","layout":{"type":"default"}} -->
<div class="wp-block-group bar-box"><!-- wp:group {"className":"progress-barline","layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
<div class="wp-block-group progress-barline"><!-- wp:paragraph {"align":"left","className":"label","style":{"elements":{"link":{"color":{"text":"var:preset|color|body-text"}}},"typography":{"fontSize":"15px","fontStyle":"normal","fontWeight":"400","textTransform":"capitalize"},"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"},"margin":{"top":"0","bottom":"0","left":"0","right":"0"}}},"textColor":"body-text"} -->
<p class="has-text-align-left label has-body-text-color has-text-color has-link-color" style="margin-top:0;margin-right:0;margin-bottom:0;margin-left:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;font-size:15px;font-style:normal;font-weight:400;text-transform:capitalize">'. esc_html__('ongoing streams','sports-association').'</p>
<!-- /wp:paragraph -->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"0px","bottom":"0px","left":"0px","right":"0px"}},"border":{"radius":{"topLeft":"6px","topRight":"6px","bottomLeft":"6px","bottomRight":"6px"}}},"layout":{"type":"default"}} -->
<div class="wp-block-group" style="border-top-left-radius:6px;border-top-right-radius:6px;border-bottom-left-radius:6px;border-bottom-right-radius:6px;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px"><!-- wp:paragraph {"className":"bar","style":{"typography":{"fontSize":"14px","fontStyle":"normal","fontWeight":"600"},"border":{"radius":{"topLeft":"6px","topRight":"6px","bottomLeft":"6px","bottomRight":"6px"}}},"fontFamily":"urbanist"} -->
<p class="bar has-urbanist-font-family" style="border-top-left-radius:6px;border-top-right-radius:6px;border-bottom-left-radius:6px;border-bottom-right-radius:6px;font-size:14px;font-style:normal;font-weight:600"></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"align":"center","className":"percent","style":{"elements":{"link":{"color":{"text":"var:preset|color|foreground"}}},"typography":{"fontSize":"15px","fontStyle":"normal","fontWeight":"400"},"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"},"margin":{"top":"0","bottom":"0","left":"0","right":"0"}}},"textColor":"foreground"} -->
<p class="has-text-align-center percent has-foreground-color has-text-color has-link-color" style="margin-top:0;margin-right:0;margin-bottom:0;margin-left:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;font-size:15px;font-style:normal;font-weight:400">'. esc_html__('18','sports-association').'</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"bar-box","layout":{"type":"default"}} -->
<div class="wp-block-group bar-box"><!-- wp:group {"className":"progress-barline","layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
<div class="wp-block-group progress-barline"><!-- wp:paragraph {"align":"left","className":"label","style":{"elements":{"link":{"color":{"text":"var:preset|color|body-text"}}},"typography":{"fontSize":"15px","fontStyle":"normal","fontWeight":"400","textTransform":"capitalize"},"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"},"margin":{"top":"0","bottom":"0","left":"0","right":"0"}}},"textColor":"body-text"} -->
<p class="has-text-align-left label has-body-text-color has-text-color has-link-color" style="margin-top:0;margin-right:0;margin-bottom:0;margin-left:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;font-size:15px;font-style:normal;font-weight:400;text-transform:capitalize">'. esc_html__('active regions','sports-association').'</p>
<!-- /wp:paragraph -->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"0px","bottom":"0px","left":"0px","right":"0px"}},"border":{"radius":{"topLeft":"6px","topRight":"6px","bottomLeft":"6px","bottomRight":"6px"}}},"layout":{"type":"default"}} -->
<div class="wp-block-group" style="border-top-left-radius:6px;border-top-right-radius:6px;border-bottom-left-radius:6px;border-bottom-right-radius:6px;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px"><!-- wp:paragraph {"className":"bar","style":{"typography":{"fontSize":"14px","fontStyle":"normal","fontWeight":"600"},"border":{"radius":{"topLeft":"6px","topRight":"6px","bottomLeft":"6px","bottomRight":"6px"}}},"fontFamily":"urbanist"} -->
<p class="bar has-urbanist-font-family" style="border-top-left-radius:6px;border-top-right-radius:6px;border-bottom-left-radius:6px;border-bottom-right-radius:6px;font-size:14px;font-style:normal;font-weight:600"></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"align":"center","className":"percent","style":{"elements":{"link":{"color":{"text":"var:preset|color|foreground"}}},"typography":{"fontSize":"15px","fontStyle":"normal","fontWeight":"400"},"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"},"margin":{"top":"0","bottom":"0","left":"0","right":"0"}}},"textColor":"foreground"} -->
<p class="has-text-align-center percent has-foreground-color has-text-color has-link-color" style="margin-top:0;margin-right:0;margin-bottom:0;margin-left:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;font-size:15px;font-style:normal;font-weight:400">'. esc_html__('65','sports-association').'</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div></div>
<!-- /wp:cover --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->

<!-- wp:spacer {"height":"30px"} -->
<div style="height:30px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->',
);