<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package IT_Residence
 */

printf('</div>');
?>

<?php do_action('itre_footer'); ?>

	<footer id="colophon" class="site-footer">

		<?php if ( empty( get_theme_mod('itre_disable_footer_credits', '') ) ) : ?>

		<div class="site-info">
			<?php
				if (!empty( get_theme_mod('itre_footer_text', '') ) ) :
					printf('<p>%s</p>', get_theme_mod('itre_footer_text', '') );
				else :
			?>
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'it-residence' ) ); ?>">
				<?php
				/* translators: %s: CMS name, i.e. WordPress. */
				printf( esc_html__( 'Proudly powered by %s', 'it-residence' ), 'WordPress' );
				?>
			</a>
			<span class="sep"> | </span>

				<?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'Theme: %1$s by %2$s.', 'it-residence' ), 'it-residence', '<a href="http://underscores.me/">Underscores.me</a>' );
				?>
		</div><!-- .site-info -->
		<?php endif; ?>
	<?php endif; ?>
	</footer><!-- #colophon -->
</div><!-- #page -->

<nav id="menu" class="panel" role="navigation">
	<div id="panel-top-bar">
		<button class="go-to-bottom"></button>
		<button id="close-menu" class="menu-link"><i class="fa fa-chevron-right" aria-hidden="true"></i></button>
	</div>

	<?php wp_nav_menu( apply_filters( 'mobile_nav_args', array(
			'menu_id'	=> 'menu-mobile',
			'container'		=> 'ul',
			'theme_location' => 'menu-2',
			'walker'         => has_nav_menu('menu-2') ? new itre_Mobile_Menu : '',
	 ) ) ); ?>

	<button class="go-to-top"></button>
</nav>

<?php if ( !empty( get_theme_mod( 'itre_back_to_top', 1 ) ) ) { ?>
	<div id="itre-back-to-top"><i class="fa fa-chevron-up" aria-hidden="true"></i></div>
<?php } ?>

<?php wp_footer(); ?>

</body>
</html>
