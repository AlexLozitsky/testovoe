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
global $wp_query;
// Initialize where to start the post from, 0 is most recent post
$init_count = 0;

// Get the current page integer
$page = get_query_var('paged') ? get_query_var('paged') : 1;

// And the simple formula for offset is this
$offset = ($page - 1) * $init_count;
?>

    <section id="primary" class="container content-area">
        <main id="main" class="site-main row">
            <?php if (have_posts()): ?>

                <div>
                    <h3 class="text-center">Events</h3>
                    <?php
                    $wp_query = new WP_Query(array(
                        'post_type' => 'event',
                        'post_status' => array('publish'),
                        'meta_key' => 'start_date',
                        'orderby' => 'meta_value',
                        'order' => 'ASC',
                        'posts_per_page' => '5',
//                        'number'     =>  $init_count,
//                        'page'       =>  $page,
//                        'offset'     =>  $offset,
//                        'meta_query' => array(
//                            array(
//                                'key' => 'start_date',
//                                'value' => date('Y-m-d'),
//                                'compare' => '>=',
//                            ))
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
                    <?php endwhile; ?>

                    <?php echo get_the_posts_pagination(); ?>

                    <?php wp_reset_query(); ?>
                </div>
            <?php endif; ?>

        </main><!-- #main -->
    </section><!-- #primary -->

<?php
get_footer();
