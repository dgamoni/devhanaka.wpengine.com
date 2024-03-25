<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Astra
 * @since 1.0.0
 */

?>




      
          
</div>

			<?php astra_content_bottom(); ?>

			</div> <!-- ast-container -->

		</div><!-- #content -->
				<?php
//RIGHT POPUP
//$post_id = get_queried_object_id();
if( !isset($_COOKIE['fx_expire_cookie']) AND !isset($_COOKIE['fx_expire_cookie_2']) AND is_user_logged_in() !== true ){
	get_template_part( '/popup/popup_file' ); 
}
?>

		<?php astra_content_after(); ?>

		<?php astra_footer_before(); ?>

		<?php astra_footer(); ?>

		<?php astra_footer_after(); ?>

	</div><!-- #page -->

	<?php astra_body_bottom(); ?>
	


	<?php wp_footer(); ?>

	</body>
</html>

 
