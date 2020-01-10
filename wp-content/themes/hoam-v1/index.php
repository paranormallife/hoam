<?php get_header(); ?>

<!-- Index Template -->

<div class="sitewrap">
    <?php 
        if ( have_posts() ) {
            while ( have_posts() ) {
                the_post(); 
                $thumb = get_the_post_thumbnail_url( $post->ID, 'full' );
                echo '<div class="hero-container">';
                echo    '<div class="hero-image" style="background-image: url('.$thumb.');">';
                echo        '<img src="'.$thumb.'" alt="'.get_the_title().'" />';
                echo    '</div>';
                echo '</div>';
                echo '<div class="post-content">';
                        the_content();
                echo '</div>';
            } 
        } 
    ?>
</div>

<?php get_footer(); ?>