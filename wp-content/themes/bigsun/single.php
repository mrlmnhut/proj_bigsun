<?php get_header(); ?>
    <main id="main" style="padding-top: 6rem">
        <div class="container">
			<?php
			if (have_posts()) :
				while (have_posts()) : the_post();
					?>
                    <h1 class="entry-title"><?php the_title(); ?></h1>
                    <div class="line-post"></div>
					<?php
					the_content();
				endwhile;
			else :
				// When no posts are found, output this text.
				_e('Sorry, no posts matched your criteria.');
			endif;
			?>
        </div>
    </main>
<?php get_footer(); ?>