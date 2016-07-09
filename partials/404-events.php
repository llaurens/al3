<?php
/*
* Error 404 Event
*
* @package al3
* @subpackage Events
*/
?>

<article id="post-not-found" class="not-found hentry cf">

    <header class="article-header">
        <h1><?php _e( 'Oops, no event found!', 'al3' ); ?></h1>
    </header>

    <div class="entry-content">
        <p><?php _e( 'Three Possibilites: 1. The Website is broken (not so unlikely). 2. There is no event in the near future (rather unlikely). 3. We forget to add new events (most likely).', 'al3' ); ?></p>
    </div>

    <footer class="article-footer">
        <p><?php printf( __('You want us to add more events? Write us: <a href="mailto:%s" title="Write us!">%s</a>.', 'al3'), get_option( 'admin_email' ), get_option( 'admin_email' ) ); ?></p>
    </footer>

</article>
