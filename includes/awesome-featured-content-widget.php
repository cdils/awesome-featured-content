<?php
/**
 * Awesome Featured Content Widget
 *
 * Displays featured content and a Font Awesome icon
 * of the users choice.
 *
 * @package     AFCW
 * @copyright   Copyright (c) 2013, FAT Media, LLC
 * @license     GPL-2.0+
 * @since       1.0.0
 */

/**
 * Awesome Feature widget class.
 *
 * @category AFCW
 * @package Widgets
 *
 * @since 1.0.0
 */
class Awesome_Featured_Widget extends WP_Widget {

	/**
	 * Holds widget settings defaults, populated in constructor.
	 *
	 * @var array
	 */
	protected $defaults;

	/**
	 * Constructor. Set the default widget options and create widget.
	 */
	function __construct() {

		$this->defaults = array(
			'title'		        => '',
			'awesome_id'        => '',
			'awesome_icon'      => '',
			'awesome_text'      => '',
			'icon_placement'    => 'after_title',
			'awesome_filter'    => '',
		);

		$widget_ops = array(
			'classname'   => 'awesome-feature',
			'description' => __( 'Displays a font awesome icon linked to a featured page of your choosing.', 'afcw' ),
		);

		$control_ops = array(
			'id_base' => 'awesome-feature',
			'width'   => 300,
			'height'  => 450,
		);

		parent::__construct('awesome-feature', __('Awesome Featured Content', 'afcw'), $widget_ops, $control_ops);

	}

	/**
	 * Echo the widget content.
	 *
	 * @param array $args Display arguments including before_title, after_title, before_widget, and after_widget.
	 * @param array $instance The settings for the particular instance of the widget
	 */
	function widget( $args, $instance ) {

		extract( $args );

		/** Merge with defaults */
		$instance = wp_parse_args( (array) $instance, $this->defaults );

		/* User-selected settings. */
		$awesome_title  = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$awesome_icon   = $instance['awesome_icon'];
		$icon_placement = $instance['icon_placement'];
		$awesome_text   = apply_filters( 'widget_text', empty( $instance['awesome_text'] ) ? '' : $instance['awesome_text'], $instance );

		/* HTML output */
		echo $before_widget;

			$awesome_page = new WP_Query( array( 'page_id' => $instance['awesome_id'] ) );
			if ( $awesome_page->have_posts() ) :
				while ( $awesome_page->have_posts() ) : $awesome_page->the_post();

					/* Add a link to the featured page to the widget title */
					$before_title .= '<a href="'. get_permalink() .'">';
					$after_title = '</a>' . $after_title;

					/* Check for the title before the icon */
					if ( $icon_placement == 'after_title' && ! empty( $awesome_title ) ) {
						echo $before_title . $awesome_title . $after_title;
					}
					/* Display the icon if it's been set */
					if ( ! empty( $awesome_icon ) ) {
						echo'<span class="ico-bg"><a href="' . get_permalink() . '"><i class="fa '. esc_attr( $awesome_icon ) .'"></i></a></span>';
					}
					/* Check for the title after the icon */
					if ( $icon_placement == 'before_title' && ! empty( $awesome_title ) ) {
						echo $before_title . $awesome_title . $after_title;
					}
					/* Display the featured content if it exists */
					echo !empty( $instance['awesome_filter'] ) ? wpautop( $awesome_text ) : $awesome_text;

				endwhile;
				wp_reset_postdata();
			endif;

		echo $after_widget;

	}

	/**
	 * Update a particular instance.
	 *
	 * This function should check that $new_instance is set correctly.
	 * The newly calculated value of $instance should be returned.
	 * If "false" is returned, the instance won't be saved/updated.
	 *
	 * @param array $new_instance New settings for this instance as input by the user via form()
	 * @param array $old_instance Old settings for this instance
	 * @return array Settings to save or bool false to cancel saving
	 */
	function update( $new_instance, $old_instance ) {
		$new_instance['title']            = strip_tags( $new_instance['title'] );
		$new_instance['awesome_icon']     = strip_tags( $new_instance['awesome_icon'] );
		$new_instance['icon_placement']   = strip_tags( $new_instance['icon_placement'] );
		if ( current_user_can( 'unfiltered_html' ) ) {
			$new_instance['awesome_text'] =  $new_instance['awesome_text'];
		} else {
			$new_instance['awesome_text'] = stripslashes( wp_filter_post_kses( addslashes( $new_instance['awesome_text'] ) ) );
		}
		$new_instance['awesome_filter']   = isset( $new_instance['awesome_filter'] );

		return $new_instance;
	}

	function post_select( $select_id, $post_type, $selected = 0 ) {
		$args = array(
			'post_type'        => $post_type,
			'post_status'      => 'publish',
			'suppress_filters' => false,
			'posts_per_page'   => -1
		);
		// Get all published posts.
		$posts = get_posts( $args );

		// Display the select field.
		echo '<select class="widefat" name="'. $select_id .'" id="'.$select_id.'">';
			if ( $posts ) {
				foreach ( $posts as $post ) {
					echo '<option value="', $post->ID, '"', $selected == $post->ID ? ' selected="selected"' : '', '>', $post->post_title, '</option>';
				}
				wp_reset_postdata();
			}
		echo '</select>';
	}

	/**
	 * Echo the settings update form.
	 *
	 * @param array $instance Current settings
	 */
	function form( $instance ) {

		/** Merge with defaults */
		$instance      = wp_parse_args( (array) $instance, $this->defaults );
		$title         = strip_tags($instance['title']);
		$awesome_text  = esc_textarea($instance['awesome_text']);
		$awesome_icons = afcw_get_icons();

		?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title (Optional)', 'afcw' ); ?>:</label>
			<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" class="widefat" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'awesome_icon' ); ?>"><?php _e( 'Choose an Icon', 'afcw' ); ?>:</label>
			<select class="widefat font-awesome" id="<?php echo $this->get_field_id( 'awesome_icon' ); ?>" name="<?php echo $this->get_field_name( 'awesome_icon' ); ?>">
				<?php foreach ( (array) $awesome_icons as $icon  ) { ?>
				<option value="<?php echo $icon['value']; ?>"<?php selected( $icon['value'], $instance['awesome_icon'] ); ?>><?php _e( $icon['name'], 'afcw' ) ?></option>
				<?php } ?>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'icon_placement' ); ?>"><?php _e( 'Display the Icon', 'afcw' ); ?>:</label>
			<select class="widefat" id="<?php echo $this->get_field_id( 'icon_placement' ); ?>" name="<?php echo $this->get_field_name( 'icon_placement' ); ?>">
				<option value="before_title" <?php selected( 'before_title', $instance['icon_placement'] ); ?>><?php _e( 'Before the Title', 'afcw' ); ?></option>
				<option value="after_title" <?php selected( 'after_title', $instance['icon_placement'] ); ?>><?php _e( 'After the Title', 'afcw' ); ?></option>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'awesome_id' ); ?>"><?php _e( 'Link to Content', 'afcw' ); ?>:</label>
			<?php $this->post_select( $select_id = $this->get_field_id( 'awesome_id' ), $post_type = 'any' ); ?>
		</p>

		<textarea class="widefat" rows="10" cols="20" id="<?php echo $this->get_field_id('awesome_text'); ?>" name="<?php echo $this->get_field_name('awesome_text'); ?>"><?php echo $awesome_text; ?></textarea>

		<p>
			<input id="<?php echo $this->get_field_id('awesome_filter'); ?>" name="<?php echo $this->get_field_name('awesome_filter'); ?>" type="checkbox" <?php checked(isset($instance['awesome_filter']) ? $instance['awesome_filter'] : 0); ?> />&nbsp;
			<label for="<?php echo $this->get_field_id('awesome_filter'); ?>"><?php _e('Automatically add paragraphs', 'afcw'); ?></label>
		</p>
		<p>
			<a href="options-general.php?page=awesome-featured-content"><?php _e('Visit the Settings Page for More Options', 'afcw'); ?></a>
		</p>

		<?php
	}
}