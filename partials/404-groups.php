<?php
/*
* Error 404 Groups
*
* @package al3
* @subpackage Groups
*/
?>

<article id="post-not-found" class="not-found hentry cf">

    <header class="article-header">
        <h1><?php _e( 'Oops, no Group found!', 'al3' ); ?></h1>
    </header>

    <div class="entry-content">
        <p><?php _e( 'Man, this is strange: We either have no groups right now or this is website is broken. Most likely the last option.', 'al3' ); ?></p>
    </div>

    <footer class="article-footer">
        <p><?php printf ( __('Since this seems to be a major error, you mind telling us about it? Simply write a short message to <a href="mailto:%s" title="Write us!">%s</a>!', 'al3'), get_option( 'admin_email' ), get_option( 'admin_email' ) ); ?></p>
    </footer>

</article>
