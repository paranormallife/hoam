<?php /* Template Name: Blank Parallax Page */ get_header(); ?>

<!-- template_blank.php ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

<div class="sitewrap blank parallax-wrapper">
    <?php 
        if ( have_posts() ) {
            while ( have_posts() ) {
                the_post(); 
                the_content();
            } 
        } 
    ?>
</div>

<?php get_footer(); ?>