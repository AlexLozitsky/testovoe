<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since 1.0.0
 */

get_header();
?>
    <div class="container">
        <div class="row">
            <?php while (have_posts()) : the_post(); ?>

                <h3> <?php the_title(); ?> </h3>

                <h4><?php the_field('start_date'); ?>
                    <?php if (get_field('end_date')): ?>- <?php the_field('end_date'); ?><?php endif; ?></h4>

                <?php the_content(); ?>

                <?php if (get_field('url')): ?>
                    <a href="<?php the_field('url'); ?>" title="More information" target="_blank">More information</a>

                <?php elseif (get_field('news')): ?>
                    <a href="<?php the_field('news'); ?>" title="More information">More information</a>
                <?php endif; ?>

            <?php endwhile; ?>

            <?php
            $wp_query = new WP_Query(array(
                'post_type' => 'event',
                'meta_query' => array(
                    array(
                        'key' => 'news_post',
                        'value' => '"' . get_the_ID() . '"',
                        'compare' => 'LIKE'
                    )
                )
            ));

            ?>
            <?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
                <div>
                    <div>
                        <h3 class="media-heading">
                            <a href="<?php esc_url( the_permalink() ); ?>" title="<?php the_title(); ?>" rel="bookmark">
                                <?php the_title(); ?>
                            </a>
                        </h3>
                        <?php echo get_the_excerpt(); ?>
                    </div>
                </div>
            <?php endwhile; ?>
            <?php wp_reset_query(); ?>

        </div>
    </div>
<?php
get_footer();
