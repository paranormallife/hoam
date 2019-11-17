<?php 
$the_query = new WP_Query( array( 
    'post_type' => 'homepage_images',
    'posts_per_page' => 1,
    'orderby' => 'rand'

) ); 
if ( $the_query->have_posts() ) :
while ( $the_query->have_posts() ) : $the_query->the_post();
$img = get_the_post_thumbnail_url(get_the_ID(),'full');
?>

        <div class="homepage-image" title="<?php the_title(); ?>" style="background-image: url('<?php echo $img; ?>');">
            <img src="<?php echo $img; ?>" alt="<?php the_title(); ?>" />
        </div>

<?php endwhile;
endif; ?>