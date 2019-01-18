
<?php
/*
Template Name: Archive Members
*/


$id = get_the_ID();
?>

<?php get_header(); ?>
	<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>
			aaaaaaaaa
		<?php endwhile; ?>
	<?php endif; ?>
<?php get_footer(); ?>