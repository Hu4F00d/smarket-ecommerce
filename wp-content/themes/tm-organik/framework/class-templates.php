<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package   InsightFramework
 */
class Insight_Templates {

	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	public static function posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string, esc_attr( get_the_date( 'c' ) ), esc_html( get_the_date() ), esc_attr( get_the_modified_date( 'c' ) ), esc_html( get_the_modified_date() ) );

		$posted_on = sprintf( esc_html_x( '%s', 'post date', 'tm-organik' ), $time_string );

		//$byline = sprintf( esc_html_x( 'by %s', 'post author', 'tm-organik' ), '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>' );

		$categories_list = get_the_category_list( esc_html__( ', ', 'tm-organik' ) );

		echo '<span class="posted-on"><i class="ion-calendar"></i> ' . $posted_on . '</span><span class="categories"><i class="ion-folder"></i> ' . $categories_list . '</span><span class="comment"><i class="ion-chatbubble-working"></i> ' . get_comments_number_text( '0', '1', '%' ) . '</span>'; // WPCS: XSS OK.
	}

	public static function posted_on_list() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string, esc_attr( get_the_date( 'c' ) ), esc_html( get_the_date() ), esc_attr( get_the_modified_date( 'c' ) ), esc_html( get_the_modified_date() ) );

		$posted_on = sprintf( esc_html_x( '%s', 'post date', 'tm-organik' ), $time_string );

		echo '<span class="posted-on"><i class="ion-calendar"></i> ' . $posted_on . '</span><span class="comment"><i class="ion-chatbubble-working"></i> ' . get_comments_number_text( '0', '1', '%' ) . '</span>'; // WPCS: XSS OK.
	}

	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	public static function entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html__( ' ', 'tm-organik' ) );
			?>
			<div class="row">
				<div class="col-md-6">
					<div class="tags">
						<?php echo wp_kses( $tags_list, array( 'a' => array( 'href' => array() ) ) ); ?>
					</div>
				</div>
				<div class="col-md-6">
					<div class="share">
						<span>
						<i class="ion-android-share-alt"></i> <?php esc_html_e( 'Share this post', 'tm-organik' ); ?>
							</span>
						<span>
						<a target="_blank"
						   href="http://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode( get_permalink() ); ?>"><i
								class="fa fa-facebook"></i></a>
					</span>
						<span>
						<a target="_blank"
						   href="http://twitter.com/share?text=<?php echo urlencode( get_the_title() ); ?>&url=<?php echo urlencode( get_permalink() ); ?>"><i
								class="fa fa-twitter"></i></a>
					</span>
						<span>
						<a target="_blank"
						   href="https://plus.google.com/share?url=<?php echo urlencode( get_permalink() ); ?>"><i
								class="fa fa-google-plus"></i></a>
					</span>
					</div>
				</div>
			</div>
			<?php
		}
		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link( esc_html__( 'Leave a comment', 'tm-organik' ), esc_html__( '1 Comment', 'tm-organik' ), esc_html__( '% Comments', 'tm-organik' ) );
			echo '</span>';
		}
	}

	/**
	 * Returns true if a blog has more than 1 category.
	 *
	 * @return bool
	 */
	public static function categorized_blog() {
		if ( false === ( $all_the_cool_cats = get_transient( 'thememove_categories' ) ) ) {
			// Create an array of all the categories that are attached to posts.
			$all_the_cool_cats = get_categories( array(
				'fields'     => 'ids',
				'hide_empty' => 1,
				// We only need to know if there is more than one category.
				'number'     => 2,
			) );

			// Count the number of categories that are attached to the posts.
			$all_the_cool_cats = count( $all_the_cool_cats );

			set_transient( 'thememove_categories', $all_the_cool_cats );
		}

		if ( $all_the_cool_cats > 1 ) {
			// This blog has more than 1 category so categorized_blog should return true.
			return true;
		} else {
			// This blog has only 1 category so categorized_blog should return false.
			return false;
		}
	}

}
