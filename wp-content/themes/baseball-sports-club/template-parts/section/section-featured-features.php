<?php 
/**
 * Template part for displaying Featured features Section
 * (Capabilities Section)
 *
 *@package baseball-sports-club
 */
    
if (!get_theme_mod('enable_featured_features_section', true)) {
     return;
}
?>
<div id="featured-features">
    <div class="section-content container-fluid" id="primaryid">
        <div class="featuresbg col-xl-11 col-lg-11 col-md-11 col-sm-12 col-12">
            <div
                class="grid gap-20 xl:grid-cols-3 lg:grid-cols-3 md:grid-cols-3 sm:grid-cols-1 grid-cols-1 h-full items-center">

                <article
                    class="features-block <?php echo esc_attr(get_theme_mod('baseball_sports_club_featured_features_onload_effects','wow zoomIn')); ?>"
                    data-wow-duration="2s">

                    <div class="featuresbox"
                        style="text-align : <?php if(get_theme_mod('featured_features_box_align','Center') == 'Center'){ ?> Center <?php } elseif(get_theme_mod('featured_features_box_align','Left') == 'Left'){ ?> Left <?php } elseif(get_theme_mod('featured_features_box_align','Right') == 'Right'){ ?> right <?php } ?> ">

                        <div class="featuretextcontainer">

                            <div class="featuredicon">
                                <i class="fas <?php echo esc_html(get_theme_mod('baseball_sports_club_featured_icon',__('fa-hourglass-start', 'baseball-sports-club')))?>"
                                    style="font-size: <?php echo esc_attr(get_theme_mod('features_icon_fontsize','60')) ?>px;"></i>
                            </div>
                            <!-- </?php endif; ?> -->

                            <h4 class="features-title"><a href="<?php the_permalink();?>"
                                    style="text-transform : <?php if(get_theme_mod('featured_features_title_case','Capitalize') == 'Capitalize'){ ?> Capitalize <?php } elseif(get_theme_mod('featured_features_title_case','Uppercase') == 'Uppercase'){ ?> Uppercase <?php } elseif(get_theme_mod('featured_features_title_case','Lowercase') == 'Lowercase'){ ?> Lowercase <?php } elseif(get_theme_mod('featured_features_title_case','None') == 'None'){ ?> none <?php } ?> "><?php echo esc_html(get_theme_mod('featured_about_section_featuretext1','Time Spirit'))?></a>
                            </h4>
                            <div class="features-details">
                                <?php
                                $baseball_sports_club_feture_section_excerpt = esc_html(get_theme_mod('featured_about_section_featuresubtext1',__('Etiam ornare lorem in bibendum pretium. Ut purus libero, consequat sed porttitor at, ullamcorper ut velit.', 'baseball-sports-club'))) ;
                                echo wp_kses_post( wpautop( $baseball_sports_club_feture_section_excerpt ) );    
                            ?>
                            </div>
                        </div>
                    </div>
                </article>
                <article
                    class="features-block <?php echo esc_attr(get_theme_mod('baseball_sports_club_featured_features_onload_effects','wow zoomIn')); ?>"
                    data-wow-duration="2s">

                    <div class="featuresbox"
                        style="text-align : <?php if(get_theme_mod('featured_features_box_align','Center') == 'Center'){ ?> Center <?php } elseif(get_theme_mod('featured_features_box_align','Left') == 'Left'){ ?> Left <?php } elseif(get_theme_mod('featured_features_box_align','Right') == 'Right'){ ?> right <?php } ?> ">

                        <div class="featuretextcontainer">
                            <div class="featuredicon">
                                <i class="fas  <?php echo esc_html(get_theme_mod('baseball_sports_club_featured_icon2',__('fa-handshake-angle', 'baseball-sports-club')))?>"
                                    style="font-size: <?php echo esc_attr(get_theme_mod('features_icon_fontsize','60')) ?>px;"></i>
                            </div>
                            <!-- </?php endif; ?> -->

                            <h4 class="features-title"><a href="<?php the_permalink();?>"
                                    style="text-transform : <?php if(get_theme_mod('featured_features_title_case','Capitalize') == 'Capitalize'){ ?> Capitalize <?php } elseif(get_theme_mod('featured_features_title_case','Uppercase') == 'Uppercase'){ ?> Uppercase <?php } elseif(get_theme_mod('featured_features_title_case','Lowercase') == 'Lowercase'){ ?> Lowercase <?php } elseif(get_theme_mod('featured_features_title_case','None') == 'None'){ ?> none <?php } ?>"><?php echo esc_html(get_theme_mod('featured_about_section_featuretext2','Physical Fitness'))?></a>
                            </h4>
                            <div class="features-details">
                                <?php
                                $baseball_sports_club_feture_section_excerpt = esc_html(get_theme_mod('featured_about_section_featuresubtext2',__('Etiam ornare lorem in bibendum pretium. Ut purus libero, consequat sed porttitor at, ullamcorper ut velit.', 'baseball-sports-club')));
                                echo wp_kses_post( wpautop( $baseball_sports_club_feture_section_excerpt ) );    
                            ?>
                            </div>
                        </div>
                    </div>
                </article>
                <article
                    class="features-block <?php echo esc_attr(get_theme_mod('baseball_sports_club_featured_features_onload_effects','wow zoomIn')); ?>"
                    data-wow-duration="2s">
                    <div class="featuresbox"
                        style="text-align : <?php if(get_theme_mod('featured_features_box_align','Center') == 'Center'){ ?> Center <?php } elseif(get_theme_mod('featured_features_box_align','Left') == 'Left'){ ?> Left <?php } elseif(get_theme_mod('featured_features_box_align','Right') == 'Right'){ ?> right <?php } ?> ">

                        <div class="featuretextcontainer">
                            <div class="featuredicon">
                                <i class="fas <?php echo esc_html(get_theme_mod('baseball_sports_club_featured_icon3',__('fa-dumpster-fire', 'baseball-sports-club')))?>"
                                    style="font-size: <?php echo esc_attr(get_theme_mod('features_icon_fontsize','60')) ?>px;"></i>
                            </div>
                            <!-- </?php endif; ?> -->

                            <h4 class="features-title"><a href="<?php the_permalink();?>"
                                    style="text-transform : <?php if(get_theme_mod('featured_features_title_case','Capitalize') == 'Capitalize'){ ?> Capitalize <?php } elseif(get_theme_mod('featured_features_title_case','Uppercase') == 'Uppercase'){ ?> Uppercase <?php } elseif(get_theme_mod('featured_features_title_case','Lowercase') == 'Lowercase'){ ?> Lowercase <?php } elseif(get_theme_mod('featured_features_title_case','None') == 'None'){ ?> none <?php } ?> "><?php echo esc_html(get_theme_mod('featured_about_section_featuretext3','Training Camps'))?></a>
                            </h4>
                            <div class="features-details">
                                <?php
                                $baseball_sports_club_feture_section_excerpt = esc_html(get_theme_mod('featured_about_section_featuresubtext3',__('Etiam ornare lorem in bibendum pretium. Ut purus libero, consequat sed porttitor at, ullamcorper ut velit.', 'baseball-sports-club')));
                                echo wp_kses_post( wpautop( $baseball_sports_club_feture_section_excerpt ) );    
                            ?>
                            </div>
                        </div>
                    </div>
                </article>
            </div><!-- .section-content -->
        </div>

    </div>

</div>