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
			'title'           => '',
			'title_placement' => 'before_icon',
			'content_id'      => '',
			'awesome_icon'    => '',
			'icon_size'       => '5x',
			'awesome_text'    => '',
			'awesome_filter'  => '',
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
	 * @param array $args Display arguments including after_icon, before_icon, before_widget, and after_widget.
	 * @param array $instance The settings for the particular instance of the widget
	 */
	function widget( $args, $instance ) {

		extract( $args );

		// Merge with defaults.
		$instance = wp_parse_args( (array) $instance, $this->defaults );

		// User-selected settings.
		$awesome_title   = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$awesome_icon    = $instance['awesome_icon'];
		$icon_size       = $instance['icon_size'];
		$title_placement = $instance['title_placement'];
		$awesome_text    = apply_filters( 'widget_text', empty( $instance['awesome_text'] ) ? '' : $instance['awesome_text'], $instance );
		$before_icon     = '';
		$after_icon      = '';
		$before_stack    = '';
		$after_stack     = '';

		// Add a link to the featured page to the widget title.
		$before_title .= '<a href="'. get_permalink() .'">';
		$after_title = '</a>' . $after_title;

		// Check for the title before the icon.
		if ( $title_placement == 'before_icon' && ! empty( $awesome_title ) ) {
			$before_icon = $before_title . $awesome_title . $after_title;
		}

		// Check for the title after the icon.
		if ( $title_placement == 'after_icon' && ! empty( $awesome_title ) ) {
			$after_icon = $before_title . $awesome_title . $after_title;
		}

		// Add a link to content if we have content to link to.
		if (  ! empty( $instance['content_id'] ) ) {
			$before_stack = '<a href="' . get_permalink( $instance['content_id'] ) . '">';
			$after_stack  = '</a>';
		}

		// Output the widget's HTML.
		echo $before_widget;

			echo $before_icon;

			// Display the icon if it's been set.
			if ( ! empty( $awesome_icon ) ) {
				echo $before_stack;
					echo'<span class="fa-stack fa-' . strip_tags( $instance['icon_size'] ) . '">';
						echo'<i class="fa fa-circle fa-stack-2x"></i>';
						echo'<i class="fa ' . esc_attr( $awesome_icon ) . ' fa-stack-1x fa-inverse"></i>';
					echo'</span>';
				echo $after_stack;
			}

			echo $after_icon;

			// Display the featured content if it exists.
			echo ! empty( $instance['awesome_filter'] ) ? wpautop( $awesome_text ) : $awesome_text;

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
		$new_instance['icon_size']        = strip_tags( $new_instance['icon_size'] );
		$new_instance['title_placement']   = strip_tags( $new_instance['title_placement'] );
		if ( current_user_can( 'unfiltered_html' ) ) {
			$new_instance['awesome_text'] =  $new_instance['awesome_text'];
		} else {
			$new_instance['awesome_text'] = stripslashes( wp_filter_post_kses( addslashes( $new_instance['awesome_text'] ) ) );
		}
		$new_instance['awesome_filter']   = isset( $new_instance['awesome_filter'] );

		return $new_instance;
	}

	/**
	 * Echo the settings update form.
	 *
	 * @param array $instance Current settings
	 */
	function form( $instance ) {

		/** Merge with defaults */
		$instance      = wp_parse_args( (array) $instance, $this->defaults );
		$title         = strip_tags( $instance['title'] );
		$content_id    = intval( $instance['content_id'] );
		$awesome_text  = esc_textarea( $instance['awesome_text'] );
		$icon_size     = strip_tags( $instance['icon_size'] );
		$awesome_icons = afcw_get_icons();

		?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title (Optional)', 'afcw' ); ?>:</label>
			<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" class="widefat" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'title_placement' ); ?>"><?php _e( 'Display the Title', 'afcw' ); ?>:</label>
			<select class="widefat awesome-select" id="<?php echo $this->get_field_id( 'title_placement' ); ?>" name="<?php echo $this->get_field_name( 'title_placement' ); ?>">
				<option value="before_icon" <?php selected( 'before_icon', $instance['title_placement'] ); ?>><?php _e( 'Before the Icon', 'afcw' ); ?></option>
				<option value="after_icon" <?php selected( 'after_icon', $instance['title_placement'] ); ?>><?php _e( 'After the Icon', 'afcw' ); ?></option>
			</select>
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
			<label for="<?php echo $this->get_field_id( 'icon_size' ); ?>"><?php _e( 'Icon Size', 'afcw' ); ?>:</label>
			<select class="widefat awesome-select" id="<?php echo $this->get_field_id( 'icon_size' ); ?>" name="<?php echo $this->get_field_name( 'icon_size' ); ?>">
				<option value="lg" <?php selected( 'lg', $instance['icon_size'] ); ?>><?php _e( '1x', 'afcw' ); ?></option>
				<option value="2x" <?php selected( '2x', $instance['icon_size'] ); ?>><?php _e( '2x', 'afcw' ); ?></option>
				<option value="3x" <?php selected( '3x', $instance['icon_size'] ); ?>><?php _e( '3x', 'afcw' ); ?></option>
				<option value="4x" <?php selected( '4x', $instance['icon_size'] ); ?>><?php _e( '4x', 'afcw' ); ?></option>
				<option value="5x" <?php selected( '5x', $instance['icon_size'] ); ?>><?php _e( '5x', 'afcw' ); ?></option>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'content_id' ); ?>"><?php _e( 'Link to Content', 'afcw' ); ?>:</label>
			<?php afcw_dropdown_posts( $this->get_field_name( 'content_id' ), $instance['content_id'] ); ?>
		</p>

		<textarea class="widefat" rows="10" cols="20" id="<?php echo $this->get_field_id('awesome_text'); ?>" name="<?php echo $this->get_field_name('awesome_text'); ?>"><?php echo $awesome_text; ?></textarea>
		<p>
			<input id="<?php echo $this->get_field_id('awesome_filter'); ?>" name="<?php echo $this->get_field_name('awesome_filter'); ?>" type="checkbox" <?php checked(isset($instance['awesome_filter']) ? $instance['awesome_filter'] : 0); ?> />&nbsp;
			<label for="<?php echo $this->get_field_id('awesome_filter'); ?>"><?php _e('Automatically add paragraphs', 'afcw'); ?></label>
		</p>

		<?php
	}
}
