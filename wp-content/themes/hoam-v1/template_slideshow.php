<?php /* Template Name: Slideshow */ get_header(); ?>

<!-- Index Template -->

<div class="sitewrap">
    <header>
        <a href="<?php echo get_bloginfo('wpurl'); ?>" title="<?php echo get_bloginfo('name'); ?>">
            <img class="logo" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/logo.svg" alt="Ernest Shaw" />
        </a>
    </header>
    <nav>
        <?php get_template_part('snippets/navigation'); ?>
    </nav>
    <main class="swiper-container slideshow">
        <?php get_template_part('snippets/slideshow'); ?>
    </main>
    <section class="slide-navigation">
        <div class="swiper-button-prev"></div>
        <div class="swiper-pagination"></div>
        <div class="swiper-button-next"></div>
    </section>
    <footer>
        <?php get_template_part('snippets/footer'); ?>
    </footer>
</div>

<?php get_footer(); ?>