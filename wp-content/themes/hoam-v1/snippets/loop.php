<div class="post-container">
<?php 
    if ( have_posts() ) {
        while ( have_posts() ) {
            the_post(); 
            //
            echo '<h1>' . get_the_title() . '</h1>';
            echo '<div class="post-content">' . the_content() . '</div>';
            //
        } 
    } 
?>
</div>