<article id="post-not-found" class="not-found hentry cf">

    <header class="article-header">
        <h1><?php _e( 'Oops, page not found!', 'al3' ); ?></h1>
    </header>

    <div class="entry-content">
        <p><?php _e( 'This page appears to be missing. Strange. Sure you wanted to land here?', 'al3' ); ?></p>
    </div>

    <footer class="article-footer">
        <p><?php printf ( __('If you want us to fix this error, simply write a short message to <a href="mailto:%s" title="Write us!">%s</a>!', 'al3'), get_option( 'admin_email' ), get_option( 'admin_email' ) ); ?></p>
    </footer>

</article>
