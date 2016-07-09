            <nav id="lateral-nav" itemscope itemtype="http://schema.org/SiteNavigationElement">

                <?php wp_nav_menu(
                    array(
                        'container' => '',                              // remove nav container
                        'container_class' => 'footer-links cf',         // class of container (should you choose to use it)
                        'menu' => __( 'Lateral Menu', 'al3' ),          // nav name
                        'menu_class' => 'navigation nav cf',            // adding custom nav class
                        'theme_location' => 'lateral-nav',              // where it's located in the theme
                        'before' => '',                                 // before the menu
                        'after' => '',                                  // after the menu
                        'link_before' => '',                            // before each link
                        'link_after' => '',                             // after each link
                        'depth' => 0,                                   // limit the depth of the nav
                        'fallback_cb' => ''                             // fallback function
                    )
                ); ?>

            </nav>



            <?php // Breadcrumps & Copyright ?>

                <footer class="footer" itemscope itemtype="http://schema.org/WPFooter">

                    <?php if ( function_exists('yoast_breadcrumb') ) {
                        yoast_breadcrumb('<div class="home-block block-breadcrumbs wrap card cf"><p id="breadcrumbs" class="cf">','</p></div>');
                    } ?>

                    <div id="inner-footer" class="wrap card cf">

                        <nav id="footer-nav" class="m-all t-3of5 d-3of5 cf">

                            <?php if ( !(is_search() || is_404() )) { ?>

                                <div id="sb-search" class="sb-search">
                                    <form method="get" action="<?php echo home_url( '/' ); ?>">
                                        <input class="sb-search-input" placeholder="<?php _e( 'Search …', 'al3' ) ?>" type="search" value="<?php echo get_search_query() ?>" name="s" id="search" title="<?php _e( 'Search for:', 'al3' ) ?>" onkeyup="buttonUp();">
                                        <input class="sb-search-submit" type="submit" value="">
                                        <span class="sb-icon-search dashicons dashicons-search"></span>
                                    </form>
                                </div>

                            <?php } ?>

                             <?php wp_nav_menu(array(
                               'container' => false,                           // remove nav container
                               'container_class' => 'menu cf',                 // class of container (should you choose to use it)
                               'menu' => __( 'Footer Links', 'al3' ),          // nav name
                               'menu_class' => 'nav footer-nav cf',            // adding custom nav class
                               'theme_location' => 'footer-nav',               // where it's located in the theme
                               'before' => '',                                 // before the menu
                               'after' => '',                                  // after the menu
                               'link_before' => '',                            // before each link
                               'link_after' => '',                             // after each link
                               'depth' => 1,                                   // limit the depth of the nav
                               'fallback_cb' => ''                             // fallback function (if there is one)
                            )); ?>


					   </nav>

                                    <?php // Search Bar ?>

                        <p class="source-org m-all t-2of5 d-2of5 last-col cf copyright">&copy; <?php echo date('Y'); ?> <?php bloginfo( 'name' ); ?>.</p>

                    </div>

                </footer>

        </div><!-- end #container -->

        <?php // all js scripts are loaded in library/al3.php ?>

        <?php wp_footer(); ?>

    </div>
    <?php // end iOS Background Hack ?>
    </body>

</html> <!-- end of site. what a ride! -->
