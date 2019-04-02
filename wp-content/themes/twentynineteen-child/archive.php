<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since 1.0.0
 */

get_header();
?>

    <section id="primary" class="container content-area">
        <main id="main" class="site-main row">
            <?php if (have_posts()): ?>

                <div>
                    <h3 class="text-center">Events</h3>
                    <?php
                    global $paged;
                    $current_page = get_query_var('paged');
                    $current_page = max( 1, $current_page );
                    $offset = ( $current_page - 1 ) * $per_page + 1;
                    $wp_query = new WP_Query(array(
                        'post_type' => 'event',
                        'post_status' => array('publish'),
                        'posts_per_page' => 1,
                        'paged' => $paged,
                        'offset'=> $offset,
                        'meta_query' => array(
                            array(
                                'key' => 'start_date',
                                'value' => date('Y-m-d'),
                                'compare' => '>='
                            )
                        )
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
                                <?php echo wp_trim_words(get_the_content(), 100, ''); ?>
                            </div>
                        </div>
                        <div class="h-25"></div>
                    <?php endwhile; ?>

                    <?php pagination(); ?>

                    <?php wp_reset_query(); ?>

                </div>
            <?php endif; ?>

        </main><!-- #main -->
    </section><!-- #primary -->

<?php
get_footer();
