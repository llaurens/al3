<?php
/*
* Error 404 Management
*
* @package al3
* @subpackage Management
*/
?>

<article id="post-not-found" class="not-found hentry cf">

    <header class="article-header">
        <h1><?php _e( 'Oops, no Management found!', 'al3' ); ?></h1>
    </header>

    <div class="entry-content">
        <p><?php _e( 'Wow, this is strange: We either have no management right now or this is website is broken. Most likely the last option.', 'al3' ); ?></p>
    </div>

    <footer class="article-footer">
        <p><?php printf ( __('Still here? OK, seriously: We do not have a clue what you are doing here nor how did you get here. But if you want to tell us, simply write a short message to <a href="mailto:%s" title="Write us!">%s</a>!', 'al3'), get_option( 'admin_email' ), get_option( 'admin_email' ) ); ?></p>
    </footer>

</article>
