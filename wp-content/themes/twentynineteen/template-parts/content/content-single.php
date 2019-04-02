<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since 1.0.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( ! twentynineteen_can_show_post_thumbnail() ) : ?>
	<header class="entry-header">
		<?php get_template_part( 'template-parts/header/entry', 'header' ); ?>
	</header>
	<?php endif; ?>

	<div class="entry-content">

        <h3>
            <?php the_title(); ?>
        </h3>
        <h4><?php the_field('start_date'); ?>
            <?php if( get_field('end_date') ): ?>- <?php the_field('end_date'); ?><?php endif; ?></h4>
        <?php echo the_content(); ?>

        <?php if( get_field('url') ): ?>
            <a href="<?php the_field('url'); ?>" title="More information" target="_blank">More information</a>

        <?php elseif( get_field('news') ): ?>
            <a href="<?php the_field('news'); ?>" title="More information">More information</a>
        <?php endif; ?>
    </div><!-- .entry-content -->

	<?php if ( ! is_singular( 'attachment' ) ) : ?>
		<?php get_template_part( 'template-parts/post/author', 'bio' ); ?>
	<?php endif; ?>

</article><!-- #post-${ID} -->
