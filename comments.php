<?php
/*
The comments page for al3
*/

// don't load it if you can't comment
if ( post_password_required() ) {
  return;
}

?>

<?php // You can start editing here. ?>

  <?php if ( have_comments() ) : ?>

    <h3 id="comments-title" class="h2"><?php comments_number( __( '<span>No</span> Comments', 'al3' ), __( '<span>One</span> Comment', 'al3' ), __( '<span>%</span> Comments', 'al3' ) );?></h3>

    <div class="commentlist">
      <?php
        wp_list_comments( array(
          'style'             => 'div',
          'short_ping'        => true,
          'avatar_size'       => 40,
          'callback'          => 'al3_comments',
          'type'              => 'all',
          'reply_text'        => __('Reply', 'al3'),
          'page'              => '',
          'per_page'          => '',
          'reverse_top_level' => null,
          'reverse_children'  => ''
        ) );
      ?>
    </div>

    <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
    	<nav class="navigation comment-navigation" role="navigation">
      	<div class="comment-nav-prev"><?php previous_comments_link( __( '&larr; Previous Comments', 'al3' ) ); ?></div>
      	<div class="comment-nav-next"><?php next_comments_link( __( 'More Comments &rarr;', 'al3' ) ); ?></div>
    	</nav>
    <?php endif; ?>

    <?php if ( ! comments_open() ) : ?>
    	<p class="no-comments"><?php _e( 'Comments are closed.' , 'al3' ); ?></p>
    <?php endif; ?>

  <?php endif; ?>

  <?php $comments_args = array(
          'id_form'           => 'commentform',
          'id_submit'         => 'submit',
          'title_reply'       => __( 'Talk with us!', 'al3' ),
          'title_reply_to'    => __( 'What is your opinion to %s?', 'al3' ),
          'cancel_reply_link' => __( 'Cancel Reply', 'al3' ),
          'label_submit'      => __( 'Post Comment', 'al3' ),

          'comment_field' =>  '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" placeholder="' . __('I love this article, because...', 'al3') . '">' . '</textarea></p>',

          'must_log_in' => '<p class="must-log-in">' . sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.', 'al3' ), wp_login_url( apply_filters( 'the_permalink', get_permalink() ) ) ) . '</p>',

          'logged_in_as' => '<p class="logged-in-as">' . sprintf( __( 'You are logged in as the faboulous <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">You are not %2$s or you want to leave us?</a>', 'al3' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) )) . '</p>',

          'comment_notes_before' => '<p class="comment-notes">' . __( 'Yay! You have decided to leave a comment. That is fantastic! Please keep in mind that comments are moderated and our website is not a place to insult people. So, please do not use a spammy keyword or a domain as your name, do not mess around, or else it will be deleted. Let us have a personal and meaningful conversation instead. Thanks for dropping by!', 'al3' )  . '</p>',

          'comment_notes_after' => '',

          'fields' => apply_filters( 'comment_form_default_fields', array(

              'author' => '<p class="comment-form-author">' . '<label for="author">' . '<input id="author" name="author" type="text" placeholder="' . __('What is your name?', 'al3') . '" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . ' /></label></p>',

              'email' => '<p class="comment-form-email"><label for="email">' .  '<input id="email" name="email" type="text" placeholder="' . __('How is your mail?', 'al3') . '" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . ' /></label></p>',

              'url' => '',

          )
                                   ),
      );

comment_form($comments_args); ?>
