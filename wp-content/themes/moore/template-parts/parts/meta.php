 <?php if( !is_search() ){ ?>
 	<ul>
 		
 		<li class="date">
 			<i class="ovaicon-calendar-1"></i>
		    <?php the_time( get_option( 'date_format' ));?>
 		</li>
 		<li class="author">
 			<i class="ovaicon-user-1"></i>
 			<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
 				<?php the_author_meta( 'display_name' ); ?>
 			</a>
 		</li>
 		<li class="comment">
 			<i class="ovaicon-chat-comment-oval-speech-bubble-with-text-lines"></i>
            <?php comments_popup_link(
            	esc_html__(' 0 Comments', 'moore'), 
            	esc_html__(' 1 Comment', 'moore'), 
            	' % '.esc_html__('Comments', 'moore'),
            	'',
          		esc_html__( 'Comment off', 'moore' )
            ); ?>
    	
 		</li>
 	</ul>
    
<?php } ?>