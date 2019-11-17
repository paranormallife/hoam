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
                echo        '<h1>'.get_the_title().'</h1>';
                echo    '</div>';
                echo '</div>';
            } 
        } 
    ?>
</div>

<?php get_footer(); ?>