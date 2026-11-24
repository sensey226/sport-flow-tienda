<?php 
/**
 * Template part for displaying About Section
 *
 *@package baseball-sports-club
 */
$baseball_sports_club_featured_about_section_number       = baseball_sports_club_get_option( 'featured_about_section_number' ); 
$baseball_sports_club_featured_about_section_numtext       = baseball_sports_club_get_option( 'featured_about_section_numtext' ); 
$baseball_sports_club_featured_about_section_subword       = baseball_sports_club_get_option( 'featured_about_section_subword' ); 
$baseball_sports_club_featured_about_section_title1       = baseball_sports_club_get_option( 'featured_about_section_title1' ); 
$baseball_sports_club_featured_about_section_title2       = baseball_sports_club_get_option( 'featured_about_section_title2' ); 
$baseball_sports_club_featured_about_section_bxtitle    = baseball_sports_club_get_option( 'featured_about_section_bxtitle' );
$baseball_sports_club_featured_iconabout                = baseball_sports_club_get_option( 'featured_iconabout' ); 
$baseball_sports_club_featured_about_section_buttontext  = baseball_sports_club_get_option( 'featured_about_section_buttontext' );
$baseball_sports_club_featured_iconbutnicn               = baseball_sports_club_get_option( 'featured_iconbutnicn' );
$baseball_sports_club_featured_about_info_title1       = baseball_sports_club_get_option( 'featured_about_info_title1' ); 
$baseball_sports_club_featured_about_info_text1       = baseball_sports_club_get_option( 'featured_about_info_text1' ); 
$baseball_sports_club_featured_about_info_title2       = baseball_sports_club_get_option( 'featured_about_info_title2' ); 
$baseball_sports_club_featured_about_info_text2       = baseball_sports_club_get_option( 'featured_about_info_text2' ); 
$baseball_sports_club_featured_about_info_title3       = baseball_sports_club_get_option( 'featured_about_info_title3' ); 
$baseball_sports_club_featured_about_info_text3       = baseball_sports_club_get_option( 'featured_about_info_text3' ); 
    

?>
<?php if (!get_theme_mod('enable_featured_about_section', true)) {
     return;
} ?>

<section id="featured-about">
    <div class="about-overlay"></div>
    <div class="title-section">
        <div class="row" style="align-items:center">
            <div class="col-lg-2 col-md-2 col-2 youtube ">
                <div class="center-image">
                    <?php 
                        $baseball_sports_club_about_youtube_image = get_theme_mod('baseball_sports_club_about_youtube_image');
                        $image_height = esc_attr(get_theme_mod('featured_about_youtube_height', '90'));
                        $inline_css = "height: " . $image_height . "px;";
                            
                        if(!empty($baseball_sports_club_about_youtube_image)){
                            echo '<img style="' . $inline_css . '" alt="'. esc_html(get_the_title()) .'" src="'.esc_url($baseball_sports_club_about_youtube_image).'" />';
                        } else {
                            echo '<img style="' . $inline_css . '" alt="About us" src="'.get_template_directory_uri().'/assets/images/youtube-removebg-preview.png"/>';
                        }
                    ?>
                </div>
                <div id="Circle-Txt"><?php esc_html_e('WATCH VIDEO * WATCH VIDEO *', 'baseball-sports-club'); ?> </div>
            </div>

            <div class="col-lg-9 col-md-9 col-9" style="text-align: justify;">
                <div class="d-inline-flex align-items-baseline">
                    <h1 class="animatfirst-text bounce2"><?php echo esc_html($baseball_sports_club_featured_about_section_subword); ?>
                    </h1>
                    <h1 class="animatsecond-text"
                        style="text-transform: <?php if(get_theme_mod('featured_about_title_case','none') == 'none'){ ?> none <?php } elseif(get_theme_mod('featured_about_title_case','Uppercase') == 'Uppercase'){ ?> Uppercase <?php } elseif(get_theme_mod('featured_about_title_case','Lowercase') == 'Lowercase'){ ?> Lowercase <?php } elseif(get_theme_mod('featured_about_title_case','Capitalize') == 'Capitalize'){ ?> Capitalize <?php } ?>">
                        <span class="span1"><?php echo esc_html($baseball_sports_club_featured_about_section_title1); ?></span>
                    </h1>
                </div>
                <div class="col-lg-12 col-md-12 col-12 d-inline-flex">
                    <h1 class="animatthird-text"
                        style="text-transform: <?php if(get_theme_mod('featured_about_title_case','none') == 'none'){ ?> none <?php } elseif(get_theme_mod('featured_about_title_case','Uppercase') == 'Uppercase'){ ?> Uppercase <?php } elseif(get_theme_mod('featured_about_title_case','Lowercase') == 'Lowercase'){ ?> Lowercase <?php } elseif(get_theme_mod('featured_about_title_case','Capitalize') == 'Capitalize'){ ?> Capitalize <?php } ?>">
                        <span class="span2"><?php echo esc_html($baseball_sports_club_featured_about_section_title2); ?></span>
                    </h1>
                </div>
            </div>
        </div>
    </div>

    <div class="row d-flex align-items-center">
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 about-img-box <?php echo esc_attr(get_theme_mod('baseball_sports_club_featured_about_onload_effects','wow zoomIn')); ?>"
            data-wow-duration="2s">
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="about-image1">
                        <?php 
                        $baseball_sports_club_about1_image = get_theme_mod('baseball_sports_club_about1_image');
                        $baseball_sports_club_image_height = esc_attr(get_theme_mod('featured_about_image1_height', '406'));
                        $baseball_sports_club_inline_css = "height: " . $baseball_sports_club_image_height . "px;";
                            
                            if(!empty($baseball_sports_club_about1_image)){
                                echo '<img style="' . $baseball_sports_club_inline_css . '" alt="'. esc_html(get_the_title()) .'" src="'.esc_url($baseball_sports_club_about1_image).'" />';
                            } else {
                                echo '<img style="' . $baseball_sports_club_inline_css . '" alt="About us" src="'.get_template_directory_uri().'/assets/images/aboutsection1.jpg"/>';
                            }
                    ?>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 pl-0">
                    <div class="aboutredbox">
                        <div class="d-flex">
                            <h2><?php echo esc_html($baseball_sports_club_featured_about_section_number); ?></h2>
                            <p><?php echo esc_html($baseball_sports_club_featured_about_section_numtext); ?></p>
                        </div>
                    </div>
                    <div class="about-image2">
                        <?php 
                        $baseball_sports_club_about2_image = get_theme_mod('baseball_sports_club_about2_image');
                        $baseball_sports_club_image_height = esc_attr(get_theme_mod('featured_about_image2_height', '277'));
                        $baseball_sports_club_inline_css = "height: " . $baseball_sports_club_image_height . "px;";
                            
                            if(!empty($baseball_sports_club_about2_image)){
                                echo '<img style="' . $baseball_sports_club_inline_css . '" alt="'. esc_html(get_the_title()) .'" src="'.esc_url($baseball_sports_club_about2_image).'" />';
                            } else {
                                echo '<img style="' . $baseball_sports_club_inline_css . '" alt="About us" src="'.get_template_directory_uri().'/assets/images/slider2.jpg"/>';
                            }
                    ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 <?php echo esc_attr(get_theme_mod('baseball_sports_club_featured_about_onload_effects','wow zoomIn')); ?>"
            data-wow-duration="2s">

            <div class="col-xl-10 col-lg-10 col-md-12 col-sm-12 col-12"
                style="text-align : <?php if(get_theme_mod('featured_about_box_align','Left') == 'Left'){ ?> Left <?php } elseif(get_theme_mod('featured_about_box_align','Center') == 'Center'){ ?> Center <?php } elseif(get_theme_mod('featured_about_box_align','Right') == 'Right'){ ?> right <?php } ?> ">
                <div class="container">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab"
                                href="#home"><?php echo esc_html($baseball_sports_club_featured_about_info_title1); ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab"
                                href="#menu1"><?php echo esc_html($baseball_sports_club_featured_about_info_title2); ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab"
                                href="#menu2"><?php echo esc_html($baseball_sports_club_featured_about_info_title3); ?></a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div id="home" class="container tab-pane active">
                            <p><?php echo esc_html($baseball_sports_club_featured_about_info_text1); ?></p>
                        </div>
                        <div id="menu1" class="container tab-pane fade">
                            <p><?php echo esc_html($baseball_sports_club_featured_about_info_text2); ?></p>
                        </div>
                        <div id="menu2" class="container tab-pane fade">
                            <p><?php echo esc_html($baseball_sports_club_featured_about_info_text3); ?></p>
                        </div>
                    </div>
                </div>


                <div class="row px-3 mt-4 ml-1">
                    <?php $baseball_sports_club_feature_count = 4; ?>

                    <div class="row px-3">
                        <?php 
                    for ($i = 1; $i <= $baseball_sports_club_feature_count; $i++) {
                        $baseball_sports_club_title = baseball_sports_club_get_option("featured_about_section_bxtitle{$i}");
                        $baseball_sports_club_icon = baseball_sports_club_get_option("featured_iconabout{$i}");
                        
                        if (!empty($baseball_sports_club_title)) : ?>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mt-4">
                            <div class="icontext">
                                <div class="abouticon">
                                    <i class="<?php echo esc_attr($baseball_sports_club_icon); ?>"></i>
                                </div>
                                <div class="">
                                    <h3><?php echo esc_html($baseball_sports_club_title); ?></h3>
                                </div>
                            </div>
                        </div>
                        <?php endif; 
                    } ?>
                    </div>
                </div>

                <?php if( !empty($baseball_sports_club_featured_about_section_buttontext) ):?>
                <div class="button">
                    <a href=""><?php echo ($baseball_sports_club_featured_about_section_buttontext);?></a>
                </div>
                <?php endif;?>

            </div>
        </div>
    </div>

</section>

<!-- ///////////////////////////// -->