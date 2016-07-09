<?php
/*
* Error 404 Gallery
*
* @package al3
* @subpackage Events
*/
?>

<article id="post-not-found" class="not-found hentry cf">

    <header class="article-header">
        <h1><?php _e( 'Oops, no gallery found!', 'al3' ); ?></h1>
    </header>

    <div class="entry-content">
        <p><?php _e( 'Strange, it appears as if there are no images in this gallery. You sure you wanted to end up here?', 'al3' ); ?></p>
    </div>

    <footer class="article-footer">
        <p><?php printf( __('If you want us to add a few images here or to report this bug, simply write us: <a href="mailto:%s" title="Write us!">%s</a>.', 'al3'), get_option( 'admin_email' ), get_option( 'admin_email' ) ); ?></p>
    </footer>

</article>
