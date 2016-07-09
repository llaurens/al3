    <aside id="post-navigation">

        <?php  // Previous/next post navigation.
        the_post_navigation( array(
            'next_text' => '<span class="h4 meta-nav" aria-hidden="true">' . __( 'Next', 'al3' ) . '</span> ' .
            '<span class="h3 post-title">%title</span>',
            'prev_text' => '<span class="h4 meta-nav" aria-hidden="true">' . __( 'Previous', 'al3' ) . '</span> ' .
            '<span class="h3 post-title">%title</span>',
            'screen_reader_text' => __('Before & After', 'al3')
        ) );

?>
    </aside>
