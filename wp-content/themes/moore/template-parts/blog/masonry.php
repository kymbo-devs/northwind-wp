<?php $sticky_class = is_sticky()?'sticky':''; ?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post-wrap '. $sticky_class); ?>  >
	
		<div class="content">
			<?php if( has_post_format('audio') || has_post_format('gallery') || has_post_format('video' ) || has_post_thumbnail() ): ?>
				
					<div class="post-media">
						
							<?php 
								if( has_post_format('audio') ){

								 	get_template_part( 'template-parts/parts/audio' );

								}elseif( has_post_format('gallery') ){

									get_template_part( 'template-parts/parts/gallery' );

								}elseif( has_post_format('video' )){

									get_template_part( 'template-parts/parts/video' );

								}elseif(has_post_thumbnail()){

									if ( has_post_thumbnail()  && ! post_password_required() || has_post_format( 'image') )  :
								      the_post_thumbnail(  'moore_thumbnail' , array('class'=> 'img-responsive' ));
								    endif;

						        }
							?>
						
					</div>

			<?php endif; ?>

			<div class="footer">

				<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
					<h2 class="post-title">
						
						<?php echo moore_custom_text( get_the_title(), 9 ); ?>
						
					</h2>
				</a>

				<div class="date">
					 <?php the_time( get_option( 'date_format' ));?>
				</div>	
			</div>
			
		</div>
	
</article>


