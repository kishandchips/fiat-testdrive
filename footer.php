	</div><!-- #main -->
	<div class="bg-bottom">
		<div class="inner">
			<div class="car-left hide-on-mobile"></div>
			<div class="car-right hide-on-mobile"></div>
		</div>
	</div>	
</div><!-- .wrap-inner -->
	<footer id="footer"  role="contentinfo">
		<div id="ajax-page" class="clearfix"></div>
		<div class="site-info container">
			<div class="span eight right break-on-mobile footer-text">
				<?php if ( get_field('footer_text')) :?>
					<p><?php the_field('footer_text')?></p>
				<?php endif; ?>
			</div>			
			<div class="span two break-on-mobile">
				<?php _e('&copy; 2013 FIAT'); ?>
			</div>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->
<?php wp_footer(); ?>
</body>
</html>