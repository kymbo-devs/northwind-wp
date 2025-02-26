<?php $sticky_class = is_sticky()?'sticky':''; ?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post-wrap '. $sticky_class); ?>  >
		
		<?php if( has_post_format('audio') || has_post_format('gallery') || has_post_format('video' ) || has_post_thumbnail() ): ?>
			<a href="<?php the_permalink(); ?>">
				<div class="post-media">
						<?php 
							if( has_post_format('audio') ){

							 	get_template_part( 'template-parts/parts/audio' );

							}elseif( has_post_format('gallery') ){

								get_template_part( 'template-parts/parts/gallery' );

							}elseif( has_post_format('video' )){

								get_template_part( 'template-parts/parts/video' );

							}elseif(has_post_thumbnail()){

								get_template_part( 'template-parts/parts/thumbnail' );

					        }
						?>
					
				</div>
			</a>
		<?php endif; ?>

		
		<?php get_template_part( 'template-parts/parts/title' ); ?>
		

		<div class="post-excerpt">
			<?php get_template_part( 'template-parts/parts/excerpt' ); ?>
		</div>

		 <?php if( !is_search() ){ ?>
			<div class="meta">
				 <ul>
				 		
			 		<li class="date">
					    <?php the_time( get_option( 'date_format' ));?>
			 		</li>
			 		<li class="splash">/</li>
			 		<li class="author">
			 			<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
			 				<?php the_author_meta( 'display_name' ); ?>
			 			</a>
			 		</li>
			 		<li class="splash">/</li>
			 		<li>
			 			
			            <?php comments_popup_link(
			            	esc_html__(' 0 Comments', 'moore'), 
			            	esc_html__(' 1 Comment', 'moore'), 
			            	' % '.esc_html__('Comments', 'moore'),
			            	'',
			          		esc_html__( 'Comment off', 'moore' )
			            ); ?>
			    	
			 		</li>

			 	</ul>
			</div>
		<?php } ?>

		
</article>


