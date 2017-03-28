<?php
/*
* Schedule Snippet
*
* @package al3
* @subpackage Groups
*/
?>

<div class="article-header">

    <h1 class="h2 entry-title"><?php al3_acf_select_labels('groups_meet_day'); ?></h1>

    <h2 class="h3 entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>

    <?php if( get_field('groups_meet_time') ): ?>
        <p class="strong"><?php printf(__('Between %s oclock', 'al3'), get_field('groups_meet_time')); ?></p>
    <?php endif; ?>

    <?php if( get_field('groups_members') ): ?>
        <p class="strong"><?php printf(__('For %s.', 'al3'), get_field('groups_members')); ?></p>
    <?php endif; ?>

</div>

<div class="cf">

    <?php if( get_field('groups_leader') ): ?>
        <?php   $groups_leader = get_field('groups_leader');
                $groups_leader = implode("&nbsp;&amp;&nbsp;", array_map(function ($groups_leader) { return $groups_leader['nickname']; }, $groups_leader));?>
                <p><?php printf(__('With %s', 'al3'), $groups_leader); ?></p>
    <?php endif; ?>

    <?php if( get_field('groups_mail') ): ?>
        <p class="em">
            <a href="mailto:<?php echo antispambot( get_field('groups_mail') ); ?>" title="<?php printf(__('Send an E-Mail to %s!', 'al3'), get_field('groups_mail')); ?>">
                <?php echo antispambot( get_field('groups_mail') ); ?>
            </a>
        </p>
    <?php endif; ?>

</div>
