<?php
/*
Template Name: Home
*/
?>
<?php

global $wp_query;
?>
<?php get_header(); ?>

    <div class="container content">
        <?php if (have_posts()): ?>

            <div>
                <h3>Events</h3>
                <?php
                $wp_query = new WP_Query(array(
                    'post_type' => 'event',
                    'post_status' => array('publish'),
                    'posts_per_page' => 5,
                    'meta_key' => 'start_date',
                    'orderby' => 'meta_value',
                    'order' => 'ASC',
                    'meta_query' => array(
                        'relation' => 'OR',
                        array(
                            'key' => 'end_date',
                            'value' => date('Y-m-d'),
                            'compare' => '>='
                        ),
                        array(
                            'key' => 'start_date',
                            'value' => date('Y-m-d'),
                            'compare' => '>='
                        ),
                    ),
                )); ?>
                <?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
                    <div>
                        <div>
                            <h3 class="media-heading">
                                <a href="<?php esc_url(the_permalink()); ?>" title="<?php the_title(); ?>"
                                   rel="bookmark">
                                    <?php the_title(); ?>
                                </a>
                            </h3>
                            <h4><?php the_field('start_date'); ?>
                                <?php if (get_field('end_date')): ?>- <?php the_field('end_date'); ?><?php endif; ?></h4>
                            <?php echo get_the_excerpt(); ?>

                            <?php if(get_field('select') == "News"): ?>
                                <div><a href="<?php the_field('news'); ?>" title="More information">More information</a></div>

                            <?php elseif (get_field('select') == "External link"): ?>
                                <div><a href="<?php the_field('url'); ?>" title="More information" target="_blank">More information</a></div>

                            <?php endif; ?>
                            <div class="h-25"></div>
                        </div>
                    </div>
                <?php endwhile; ?>
                <?php wp_reset_query(); ?>
            </div>
        <?php endif; ?>

        <h3>
            <a style="display: block; text-align: center" href="<?php echo get_post_type_archive_link('event'); ?>"
               title="Event index page">Event index page</a>
        </h3>

    </div>

<?php get_footer(); ?>