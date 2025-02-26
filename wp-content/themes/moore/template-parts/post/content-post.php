<?php $sticky_class = is_sticky()?'sticky':''; ?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post-wrap '. $sticky_class); ?>  >

		<?php get_template_part( 'template-parts/parts/title' ); ?>
		

		<div class="post-meta">
			 <?php if( !is_search() ){ ?>
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

			 	</ul>
			    
			<?php } ?>

			
		</div>

		
		<?php if( has_filter( 'ova_share_social' ) ){ ?>
			<div class="share">
					<?php 
						$link = get_the_permalink();
						$title = get_the_title(); 
					?>    			
					<?php echo apply_filters( 'ova_share_social', $link, $title  ); ?>
			</div>
		<?php } ?>

		

		
		<?php if( has_post_format('audio') || has_post_format('gallery') || has_post_format('video' ) || has_post_thumbnail() ): ?>	
			<div class="post-media">
				<?php 
					if( has_post_format('audio') ){

					 	get_template_part( 'template-parts/parts/audio' );

					}elseif(has_post_format('gallery')){

						get_template_part( 'template-parts/parts/gallery' );

					}elseif(has_post_format('video')){

						get_template_part( 'template-parts/parts/video' );

					}elseif(has_post_thumbnail()){

						get_template_part( 'template-parts/parts/thumbnail' );

			        }
				?>
			</div>
		<?php endif; ?>

		
		

		<div class="post-content">
			<?php get_template_part( 'template-parts/parts/content' ); ?>
		</div>

		<?php if(has_tag()){ ?>
			<div class="post-tags">
				<?php get_template_part( 'template-parts/parts/tags' ); ?>
			</div>
		<?php } ?>
		
</article>


