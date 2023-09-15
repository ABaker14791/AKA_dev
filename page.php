
<?php get_header(); ?>
<main class="page-content">

    <?php 
        if(have_posts()) {
            while(have_posts()) : the_post();
    ?>



            <div class="aka-wrapper">

            <?php the_content(); ?>

            </div>
            
    <?php endwhile; } ?>

</main>
<?php get_footer(); ?>

