<?php get_header(); ?>

<div class="container">
    <?php
    if (have_posts()) :
        while (have_posts()) : the_post(); ?>
            <article>
                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <p><?php the_excerpt(); ?></p>
            </article>
        <?php endwhile;
        the_posts_pagination();
    else :
        echo '<p>' . esc_html__('No content found', 'blogsimplicity') . '</p>';
    endif;
    ?>
</div>

<?php get_footer(); ?>
