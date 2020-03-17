<?php get_header(); ?>
    <main id="main" class="">
		<?php
		if (have_posts()) :
			while (have_posts()) : the_post();
				the_content();
			endwhile;
		else :
			// When no posts are found, output this text.
			_e('Sorry, no posts matched your criteria.');
		endif;
		?>
    </main>
<?php get_footer(); ?>