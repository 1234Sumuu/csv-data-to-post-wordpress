<?php get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <?php
        if (have_posts()) :
            while (have_posts()) : the_post();
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="entry-header">
                        <?php
                        if (is_singular()) :
                            the_title('<h1 class="entry-title">', '</h1>');
                        else :
                            the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
                        endif;
                         if(has_post_thumbnail()): ?>
                            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(array(300,275)); ?></a> 
                            <?php endif;
                        if ('post' === get_post_type()) :
                            ?>
                            <div class="entry-meta">
                                <?php
                                the_time('F j, Y');
                                ?>
                            </div><!-- .entry-meta -->
                        <?php endif; ?>
                    </header><!-- .entry-header -->

                    <div class="entry-content">
                        <?php
                        the_excerpt();
                        wp_link_pages(array(
                            'before' => '<div class="page-links">' . __('Pages:', 'blogsimplicity'),
                            'after' => '</div>',
                        ));
                        ?>
                    </div><!-- .entry-content -->

                    <footer class="entry-footer">
                        <?php blogsimplicity_entry_footer(); ?>
                    </footer><!-- .entry-footer -->
                </article><!-- #post-<?php the_ID(); ?> -->
                <?php
            endwhile;

            the_posts_navigation();

        else: ?>
            <p><?php esc_html_e( 'Nothing yet to be displayed!', 'blogsimplicity'); ?></p>
        <?php endif; ?> 
    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
