<?php get_header(); ?>
                <div class="section-blog">
                    <div id="main-content" class="container">
                        <section class="blog-item">
                            <article class="post-content" <?php post_class(); ?>>
                                <h1> <?php the_title();?> </h1>        
                            </article>
                            <div class="entry-content">
                                <?php the_content(); ?>
                                <?php wp_link_pages(); ?>
                            </div>
                        </section>
                    </div>
                </div>
    <?php get_footer(); ?>