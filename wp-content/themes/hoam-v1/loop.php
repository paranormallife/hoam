<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<?php $thumb = get_the_post_thumbnail_url($post->ID, 'full'); ?>

    <?php if( $thumb != '' ) { ?>
        <section id="hero">
            <div class="hero-image" style="background-image: url('<?php echo $thumb; ?>');">
                <h1><?php the_title(); ?></h1>
            </div>
        </section>
    <?php } else { ?>
        <section id="page-title">
            <h1><?php the_title(); ?></h1>
        </section>
    <?php } ?>

    <article class="post-width">
        <?php the_content(); ?>
    </article>

<?php endwhile; else: ?>
<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
<?php endif; ?>