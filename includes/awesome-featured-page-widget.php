<?php
/**
 * Awesome Featured Page Widget
 *
 * Displays featured content and a Font Awesome icon
 * of the users choice.
 *
 * @package     AFPW
 * @copyright   Copyright (c) 2013, FAT Media, LLC
 * @license     GPL-2.0+
 * @since       1.0.0
 */

/**
 * Awesome Feature widget class.
 *
 * @category AFPW
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
	 * Default icon names and values.
	 *
	 * @var array
	 */
	protected $icons;

	/**
	 * Constructor. Set the default widget options and create widget.
	 */
	function __construct() {

		$this->defaults = array(
			'title'		        => '',
			'awesome_id'        => '',
			'awesome_icon'      => '',
			'awesome_text'      => '',
			'title_placement'   => 'before_icon',
			'awesome_filter'    => '',
		);

		/**
		* Add a Font Awesome metabox output with Select2
		*
		* @link http://fortawesome.github.com/Font-Awesome/
		* @link http://ivaynberg.github.com/select2/
		*/
		$this->icons = array(
			array( 'name' => '', 'value' => '' ),
			array( 'name' => 'Adjust', 'value' => 'icon-adjust' ),
			array( 'name' => 'Align Center', 'value' => 'icon-align-center' ),
			array( 'name' => 'Align Justify', 'value' => 'icon-align-justify' ),
			array( 'name' => 'Align Left', 'value' => 'icon-align-left' ),
			array( 'name' => 'Align Right', 'value' => 'icon-align-right' ),
			array( 'name' => 'Ambulance', 'value' => 'icon-ambulance' ),
			array( 'name' => 'Anchor', 'value' => 'icon-anchor' ),
			array( 'name' => 'Angle Down', 'value' => 'icon-angle-down' ),
			array( 'name' => 'Angle Left', 'value' => 'icon-angle-left' ),
			array( 'name' => 'Angle Right', 'value' => 'icon-angle-right' ),
			array( 'name' => 'Angle Up', 'value' => 'icon-angle-up' ),
			array( 'name' => 'Arrow Down', 'value' => 'icon-arrow-down' ),
			array( 'name' => 'Arrow Left', 'value' => 'icon-arrow-left' ),
			array( 'name' => 'Arrow Right', 'value' => 'icon-arrow-right' ),
			array( 'name' => 'Arrow Up', 'value' => 'icon-arrow-up' ),
			array( 'name' => 'Asterisk', 'value' => 'icon-asterisk' ),
			array( 'name' => 'Backward', 'value' => 'icon-backward' ),
			array( 'name' => 'Ban Circle', 'value' => 'icon-ban-circle' ),
			array( 'name' => 'Bar Chart', 'value' => 'icon-bar-chart' ),
			array( 'name' => 'Barcode', 'value' => 'icon-barcode' ),
			array( 'name' => 'Beaker', 'value' => 'icon-beaker' ),
			array( 'name' => 'Beer', 'value' => 'icon-beer' ),
			array( 'name' => 'Bell', 'value' => 'icon-bell' ),
			array( 'name' => 'Bell Alt', 'value' => 'icon-bell-alt' ),
			array( 'name' => 'Bold', 'value' => 'icon-bold' ),
			array( 'name' => 'Bolt', 'value' => 'icon-bolt' ),
			array( 'name' => 'Book', 'value' => 'icon-book' ),
			array( 'name' => 'Bookmark', 'value' => 'icon-bookmark' ),
			array( 'name' => 'Bookmark Empty', 'value' => 'icon-bookmark-empty' ),
			array( 'name' => 'Briefcase', 'value' => 'icon-briefcase' ),
			array( 'name' => 'Building', 'value' => 'icon-building' ),
			array( 'name' => 'Bullhorn', 'value' => 'icon-bullhorn' ),
			array( 'name' => 'Bullseye', 'value' => 'icon-bullseye' ),
			array( 'name' => 'Calendar', 'value' => 'icon-calendar' ),
			array( 'name' => 'Calendar Empty', 'value' => 'icon-calendar-empty' ),
			array( 'name' => 'Camera', 'value' => 'icon-camera' ),
			array( 'name' => 'Camera Retro', 'value' => 'icon-camera-retro' ),
			array( 'name' => 'Caret Down', 'value' => 'icon-caret-down' ),
			array( 'name' => 'Caret Left', 'value' => 'icon-caret-left' ),
			array( 'name' => 'Caret Right', 'value' => 'icon-caret-right' ),
			array( 'name' => 'Caret Up', 'value' => 'icon-caret-up' ),
			array( 'name' => 'Certificate', 'value' => 'icon-certificate' ),
			array( 'name' => 'Check', 'value' => 'icon-check' ),
			array( 'name' => 'Check Empty', 'value' => 'icon-check-empty' ),
			array( 'name' => 'Check Minus', 'value' => 'icon-check-minus' ),
			array( 'name' => 'Check Sign', 'value' => 'icon-check-sign' ),
			array( 'name' => 'Chevron Down', 'value' => 'icon-chevron-down' ),
			array( 'name' => 'Chevron Left', 'value' => 'icon-chevron-left' ),
			array( 'name' => 'Chevron Right', 'value' => 'icon-chevron-right' ),
			array( 'name' => 'Chevron Sign Down', 'value' => 'icon-chevron-sign-down' ),
			array( 'name' => 'Chevron Sign Left', 'value' => 'icon-chevron-sign-left' ),
			array( 'name' => 'Chevron Sign Right', 'value' => 'icon-chevron-sign-right' ),
			array( 'name' => 'Chevron Sign Up', 'value' => 'icon-chevron-sign-up' ),
			array( 'name' => 'Chevron Up', 'value' => 'icon-chevron-up' ),
			array( 'name' => 'Circle', 'value' => 'icon-circle' ),
			array( 'name' => 'Circle Arrow Down', 'value' => 'icon-circle-arrow-down' ),
			array( 'name' => 'Circle Arrow Left', 'value' => 'icon-circle-arrow-left' ),
			array( 'name' => 'Circle Arrow Right', 'value' => 'icon-circle-arrow-right' ),
			array( 'name' => 'Circle Arrow Up', 'value' => 'icon-circle-arrow-up' ),
			array( 'name' => 'Circle Blank', 'value' => 'icon-circle-blank' ),
			array( 'name' => 'Cloud', 'value' => 'icon-cloud' ),
			array( 'name' => 'Cloud Download', 'value' => 'icon-cloud-download' ),
			array( 'name' => 'Cloud Upload', 'value' => 'icon-cloud-upload' ),
			array( 'name' => 'Code', 'value' => 'icon-code' ),
			array( 'name' => 'Code Fork', 'value' => 'icon-code-fork' ),
			array( 'name' => 'Coffee', 'value' => 'icon-coffee' ),
			array( 'name' => 'Cog', 'value' => 'icon-cog' ),
			array( 'name' => 'Cogs', 'value' => 'icon-cogs' ),
			array( 'name' => 'Collapse Alt', 'value' => 'icon-collapse-alt' ),
			array( 'name' => 'Columns', 'value' => 'icon-columns' ),
			array( 'name' => 'Comment', 'value' => 'icon-comment' ),
			array( 'name' => 'Comment Alt', 'value' => 'icon-comment-alt' ),
			array( 'name' => 'Comments', 'value' => 'icon-comments' ),
			array( 'name' => 'Comments Alt', 'value' => 'icon-comments-alt' ),
			array( 'name' => 'Copy', 'value' => 'icon-copy' ),
			array( 'name' => 'Credit Card', 'value' => 'icon-credit-card' ),
			array( 'name' => 'Crop', 'value' => 'icon-crop' ),
			array( 'name' => 'CSS3', 'value' => 'icon-css3' ),
			array( 'name' => 'Cut', 'value' => 'icon-cut' ),
			array( 'name' => 'Dashboard', 'value' => 'icon-dashboard' ),
			array( 'name' => 'Desktop', 'value' => 'icon-desktop' ),
			array( 'name' => 'Double Angle Down', 'value' => 'icon-double-angle-down' ),
			array( 'name' => 'Double Angle Left', 'value' => 'icon-double-angle-left' ),
			array( 'name' => 'Double Angle Right', 'value' => 'icon-double-angle-right' ),
			array( 'name' => 'Double Angle Up', 'value' => 'icon-double-angle-up' ),
			array( 'name' => 'Download', 'value' => 'icon-download' ),
			array( 'name' => 'Download Alt', 'value' => 'icon-download-alt' ),
			array( 'name' => 'Edit', 'value' => 'icon-edit' ),
			array( 'name' => 'Edit Sign', 'value' => 'icon-edit-sign' ),
			array( 'name' => 'Eject', 'value' => 'icon-eject' ),
			array( 'name' => 'Ellipsis Horizontal', 'value' => 'icon-ellipsis-horizontal' ),
			array( 'name' => 'Ellipsis Vertical', 'value' => 'icon-ellipsis-vertical' ),
			array( 'name' => 'Envelope', 'value' => 'icon-envelope' ),
			array( 'name' => 'Envelope Alt', 'value' => 'icon-envelope-alt' ),
			array( 'name' => 'Eraser', 'value' => 'icon-eraser' ),
			array( 'name' => 'Exchange', 'value' => 'icon-exchange' ),
			array( 'name' => 'Exclamation', 'value' => 'icon-exclamation' ),
			array( 'name' => 'Exclamation Sign', 'value' => 'icon-exclamation-sign' ),
			array( 'name' => 'Expand Alt', 'value' => 'icon-expand-alt' ),
			array( 'name' => 'External Link', 'value' => 'icon-external-link' ),
			array( 'name' => 'External Link Sign', 'value' => 'icon-external-link-sign' ),
			array( 'name' => 'Eye Close', 'value' => 'icon-eye-close' ),
			array( 'name' => 'Eye Open', 'value' => 'icon-eye-open' ),
			array( 'name' => 'Facebook', 'value' => 'icon-facebook' ),
			array( 'name' => 'Facebook Sign', 'value' => 'icon-facebook-sign' ),
			array( 'name' => 'Facetime Video', 'value' => 'icon-facetime-video' ),
			array( 'name' => 'Fast Backward', 'value' => 'icon-fast-backward' ),
			array( 'name' => 'Fast Forward', 'value' => 'icon-fast-forward' ),
			array( 'name' => 'Fighter Jet', 'value' => 'icon-fighter-jet' ),
			array( 'name' => 'File', 'value' => 'icon-file' ),
			array( 'name' => 'File Alt', 'value' => 'icon-file-alt' ),
			array( 'name' => 'Film', 'value' => 'icon-film' ),
			array( 'name' => 'Filter', 'value' => 'icon-filter' ),
			array( 'name' => 'Fire', 'value' => 'icon-fire' ),
			array( 'name' => 'Fire Extinguisher', 'value' => 'icon-fire-extinguisher' ),
			array( 'name' => 'Flag', 'value' => 'icon-flag' ),
			array( 'name' => 'Flag Alt', 'value' => 'icon-flag-alt' ),
			array( 'name' => 'Flag Checkered', 'value' => 'icon-flag-checkered' ),
			array( 'name' => 'Folder Close', 'value' => 'icon-folder-close' ),
			array( 'name' => 'Folder Close Alt', 'value' => 'icon-folder-close-alt' ),
			array( 'name' => 'Folder Open', 'value' => 'icon-folder-open' ),
			array( 'name' => 'Folder Open Alt', 'value' => 'icon-folder-open-alt' ),
			array( 'name' => 'Font', 'value' => 'icon-font' ),
			array( 'name' => 'Food', 'value' => 'icon-food' ),
			array( 'name' => 'Forward', 'value' => 'icon-forward' ),
			array( 'name' => 'Frown', 'value' => 'icon-frown' ),
			array( 'name' => 'Fullscreen', 'value' => 'icon-fullscreen' ),
			array( 'name' => 'Gamepad', 'value' => 'icon-gamepad' ),
			array( 'name' => 'Gift', 'value' => 'icon-gift' ),
			array( 'name' => 'Github', 'value' => 'icon-github' ),
			array( 'name' => 'Github Sign', 'value' => 'icon-github-sign' ),
			array( 'name' => 'Glass', 'value' => 'icon-glass' ),
			array( 'name' => 'Globe', 'value' => 'icon-globe' ),
			array( 'name' => 'Google Plus', 'value' => 'icon-google-plus' ),
			array( 'name' => 'Google Plus Sign', 'value' => 'icon-google-plus-sign' ),
			array( 'name' => 'Group', 'value' => 'icon-group' ),
			array( 'name' => 'H Sign', 'value' => 'icon-h-sign' ),
			array( 'name' => 'Hand Down', 'value' => 'icon-hand-down' ),
			array( 'name' => 'Hand Left', 'value' => 'icon-hand-left' ),
			array( 'name' => 'Hand Right', 'value' => 'icon-hand-right' ),
			array( 'name' => 'Hand Up', 'value' => 'icon-hand-up' ),
			array( 'name' => 'Hdd', 'value' => 'icon-hdd' ),
			array( 'name' => 'Headphones', 'value' => 'icon-headphones' ),
			array( 'name' => 'Heart', 'value' => 'icon-heart' ),
			array( 'name' => 'Heart Empty', 'value' => 'icon-heart-empty' ),
			array( 'name' => 'Home', 'value' => 'icon-home' ),
			array( 'name' => 'Hospital', 'value' => 'icon-hospital' ),
			array( 'name' => 'Html5', 'value' => 'icon-html5' ),
			array( 'name' => 'Inbox', 'value' => 'icon-inbox' ),
			array( 'name' => 'Indent Left', 'value' => 'icon-indent-left' ),
			array( 'name' => 'Indent Right', 'value' => 'icon-indent-right' ),
			array( 'name' => 'Info', 'value' => 'icon-info' ),
			array( 'name' => 'Info Sign', 'value' => 'icon-info-sign' ),
			array( 'name' => 'Italic', 'value' => 'icon-italic' ),
			array( 'name' => 'Key', 'value' => 'icon-key' ),
			array( 'name' => 'Keyboard', 'value' => 'icon-keyboard' ),
			array( 'name' => 'Laptop', 'value' => 'icon-laptop' ),
			array( 'name' => 'Leaf', 'value' => 'icon-leaf' ),
			array( 'name' => 'Legal', 'value' => 'icon-legal' ),
			array( 'name' => 'Lemon', 'value' => 'icon-lemon' ),
			array( 'name' => 'Level Down', 'value' => 'icon-level-down' ),
			array( 'name' => 'Level Up', 'value' => 'icon-level-up' ),
			array( 'name' => 'Lightbulb', 'value' => 'icon-lightbulb' ),
			array( 'name' => 'Link', 'value' => 'icon-link' ),
			array( 'name' => 'Linkedin', 'value' => 'icon-linkedin' ),
			array( 'name' => 'Linkedin Sign', 'value' => 'icon-linkedin-sign' ),
			array( 'name' => 'List', 'value' => 'icon-list' ),
			array( 'name' => 'List Alt', 'value' => 'icon-list-alt' ),
			array( 'name' => 'List Ol', 'value' => 'icon-list-ol' ),
			array( 'name' => 'List Ul', 'value' => 'icon-list-ul' ),
			array( 'name' => 'Location Arrow', 'value' => 'icon-location-arrow' ),
			array( 'name' => 'Lock', 'value' => 'icon-lock' ),
			array( 'name' => 'Magic', 'value' => 'icon-magic' ),
			array( 'name' => 'Magnet', 'value' => 'icon-magnet' ),
			array( 'name' => 'Mail Reply All', 'value' => 'icon-mail-reply-all' ),
			array( 'name' => 'Map Marker', 'value' => 'icon-map-marker' ),
			array( 'name' => 'Maxcdn', 'value' => 'icon-maxcdn' ),
			array( 'name' => 'Medkit', 'value' => 'icon-medkit' ),
			array( 'name' => 'Meh', 'value' => 'icon-meh' ),
			array( 'name' => 'Microphone', 'value' => 'icon-microphone' ),
			array( 'name' => 'Microphone Off', 'value' => 'icon-microphone-off' ),
			array( 'name' => 'Minus', 'value' => 'icon-minus' ),
			array( 'name' => 'Minus Sign', 'value' => 'icon-minus-sign' ),
			array( 'name' => 'Minus Sign Alt', 'value' => 'icon-minus-sign-alt' ),
			array( 'name' => 'Mobile Phone', 'value' => 'icon-mobile-phone' ),
			array( 'name' => 'Money', 'value' => 'icon-money' ),
			array( 'name' => 'Move', 'value' => 'icon-move' ),
			array( 'name' => 'Music', 'value' => 'icon-music' ),
			array( 'name' => 'Off', 'value' => 'icon-off' ),
			array( 'name' => 'Ok', 'value' => 'icon-ok' ),
			array( 'name' => 'Ok Circle', 'value' => 'icon-ok-circle' ),
			array( 'name' => 'Ok Sign', 'value' => 'icon-ok-sign' ),
			array( 'name' => 'Paper Clip', 'value' => 'icon-paper-clip' ),
			array( 'name' => 'Paste', 'value' => 'icon-paste' ),
			array( 'name' => 'Pause', 'value' => 'icon-pause' ),
			array( 'name' => 'Pencil', 'value' => 'icon-pencil' ),
			array( 'name' => 'Phone', 'value' => 'icon-phone' ),
			array( 'name' => 'Phone Sign', 'value' => 'icon-phone-sign' ),
			array( 'name' => 'Picture', 'value' => 'icon-picture' ),
			array( 'name' => 'Pinterest', 'value' => 'icon-pinterest' ),
			array( 'name' => 'Pinterest Sign', 'value' => 'icon-pinterest-sign' ),
			array( 'name' => 'Plane', 'value' => 'icon-plane' ),
			array( 'name' => 'Play', 'value' => 'icon-play' ),
			array( 'name' => 'Play Circle', 'value' => 'icon-play-circle' ),
			array( 'name' => 'Play Sign', 'value' => 'icon-play-sign' ),
			array( 'name' => 'Plus', 'value' => 'icon-plus' ),
			array( 'name' => 'Plus Sign', 'value' => 'icon-plus-sign' ),
			array( 'name' => 'Plus Sign Alt', 'value' => 'icon-plus-sign-alt' ),
			array( 'name' => 'Print', 'value' => 'icon-print' ),
			array( 'name' => 'Pushpin', 'value' => 'icon-pushpin' ),
			array( 'name' => 'Puzzle Piece', 'value' => 'icon-puzzle-piece' ),
			array( 'name' => 'Qrcode', 'value' => 'icon-qrcode' ),
			array( 'name' => 'Question', 'value' => 'icon-question' ),
			array( 'name' => 'Question Sign', 'value' => 'icon-question-sign' ),
			array( 'name' => 'Quote Left', 'value' => 'icon-quote-left' ),
			array( 'name' => 'Quote Right', 'value' => 'icon-quote-right' ),
			array( 'name' => 'Random', 'value' => 'icon-random' ),
			array( 'name' => 'Refresh', 'value' => 'icon-refresh' ),
			array( 'name' => 'Remove', 'value' => 'icon-remove' ),
			array( 'name' => 'Remove Circle', 'value' => 'icon-remove-circle' ),
			array( 'name' => 'Remove Sign', 'value' => 'icon-remove-sign' ),
			array( 'name' => 'Reorder', 'value' => 'icon-reorder' ),
			array( 'name' => 'Repeat', 'value' => 'icon-repeat' ),
			array( 'name' => 'Reply', 'value' => 'icon-reply' ),
			array( 'name' => 'Reply All', 'value' => 'icon-reply-all' ),
			array( 'name' => 'Resize Full', 'value' => 'icon-resize-full' ),
			array( 'name' => 'Resize Horizontal', 'value' => 'icon-resize-horizontal' ),
			array( 'name' => 'Resize Small', 'value' => 'icon-resize-small' ),
			array( 'name' => 'Resize Vertical', 'value' => 'icon-resize-vertical' ),
			array( 'name' => 'Retweet', 'value' => 'icon-retweet' ),
			array( 'name' => 'Road', 'value' => 'icon-road' ),
			array( 'name' => 'Rocket', 'value' => 'icon-rocket' ),
			array( 'name' => 'Rss', 'value' => 'icon-rss' ),
			array( 'name' => 'Rss Sign', 'value' => 'icon-rss-sign' ),
			array( 'name' => 'Save', 'value' => 'icon-save' ),
			array( 'name' => 'Screenshot', 'value' => 'icon-screenshot' ),
			array( 'name' => 'Search', 'value' => 'icon-search' ),
			array( 'name' => 'Share', 'value' => 'icon-share' ),
			array( 'name' => 'Share Alt', 'value' => 'icon-share-alt' ),
			array( 'name' => 'Share Sign', 'value' => 'icon-share-sign' ),
			array( 'name' => 'Shield', 'value' => 'icon-shield' ),
			array( 'name' => 'Shopping Cart', 'value' => 'icon-shopping-cart' ),
			array( 'name' => 'Sign Blank', 'value' => 'icon-sign-blank' ),
			array( 'name' => 'Signal', 'value' => 'icon-signal' ),
			array( 'name' => 'Sign In', 'value' => 'icon-signin' ),
			array( 'name' => 'Sign Out', 'value' => 'icon-signout' ),
			array( 'name' => 'Sitemap', 'value' => 'icon-sitemap' ),
			array( 'name' => 'Smile', 'value' => 'icon-smile' ),
			array( 'name' => 'Sort', 'value' => 'icon-sort' ),
			array( 'name' => 'Sort Down', 'value' => 'icon-sort-down' ),
			array( 'name' => 'Sort Up', 'value' => 'icon-sort-up' ),
			array( 'name' => 'Spinner', 'value' => 'icon-spinner' ),
			array( 'name' => 'Star', 'value' => 'icon-star' ),
			array( 'name' => 'Star Empty', 'value' => 'icon-star-empty' ),
			array( 'name' => 'Star Half', 'value' => 'icon-star-half' ),
			array( 'name' => 'Star Half Empty', 'value' => 'icon-star-half-empty' ),
			array( 'name' => 'Star Half Full', 'value' => 'icon-star-half-full' ),
			array( 'name' => 'Step Backward', 'value' => 'icon-step-backward' ),
			array( 'name' => 'Step Forward', 'value' => 'icon-step-forward' ),
			array( 'name' => 'Stethoscope', 'value' => 'icon-stethoscope' ),
			array( 'name' => 'Stop', 'value' => 'icon-stop' ),
			array( 'name' => 'Strikethrough', 'value' => 'icon-strikethrough' ),
			array( 'name' => 'Subscript', 'value' => 'icon-subscript' ),
			array( 'name' => 'Suitcase', 'value' => 'icon-suitcase' ),
			array( 'name' => 'Superscript', 'value' => 'icon-superscript' ),
			array( 'name' => 'Table', 'value' => 'icon-table' ),
			array( 'name' => 'Tablet', 'value' => 'icon-tablet' ),
			array( 'name' => 'Tag', 'value' => 'icon-tag' ),
			array( 'name' => 'Tags', 'value' => 'icon-tags' ),
			array( 'name' => 'Tasks', 'value' => 'icon-tasks' ),
			array( 'name' => 'Terminal', 'value' => 'icon-terminal' ),
			array( 'name' => 'Text Height', 'value' => 'icon-text-height' ),
			array( 'name' => 'Text Width', 'value' => 'icon-text-width' ),
			array( 'name' => 'Th', 'value' => 'icon-th' ),
			array( 'name' => 'Th Large', 'value' => 'icon-th-large' ),
			array( 'name' => 'Th List', 'value' => 'icon-th-list' ),
			array( 'name' => 'Thumbs Down', 'value' => 'icon-thumbs-down' ),
			array( 'name' => 'Thumbs Up', 'value' => 'icon-thumbs-up' ),
			array( 'name' => 'Ticket', 'value' => 'icon-ticket' ),
			array( 'name' => 'Time', 'value' => 'icon-time' ),
			array( 'name' => 'Tint', 'value' => 'icon-tint' ),
			array( 'name' => 'Trash', 'value' => 'icon-trash' ),
			array( 'name' => 'Trophy', 'value' => 'icon-trophy' ),
			array( 'name' => 'Truck', 'value' => 'icon-truck' ),
			array( 'name' => 'Twitter', 'value' => 'icon-twitter' ),
			array( 'name' => 'Twitter Sign', 'value' => 'icon-twitter-sign' ),
			array( 'name' => 'Umbrella', 'value' => 'icon-umbrella' ),
			array( 'name' => 'Underline', 'value' => 'icon-underline' ),
			array( 'name' => 'Undo', 'value' => 'icon-undo' ),
			array( 'name' => 'Unlink', 'value' => 'icon-unlink' ),
			array( 'name' => 'Unlock', 'value' => 'icon-unlock' ),
			array( 'name' => 'Unlock Alt', 'value' => 'icon-unlock-alt' ),
			array( 'name' => 'Upload', 'value' => 'icon-upload' ),
			array( 'name' => 'Upload Alt', 'value' => 'icon-upload-alt' ),
			array( 'name' => 'User', 'value' => 'icon-user' ),
			array( 'name' => 'User Md', 'value' => 'icon-user-md' ),
			array( 'name' => 'Volume Down', 'value' => 'icon-volume-down' ),
			array( 'name' => 'Volume Off', 'value' => 'icon-volume-off' ),
			array( 'name' => 'Volume Up', 'value' => 'icon-volume-up' ),
			array( 'name' => 'Warning Sign', 'value' => 'icon-warning-sign' ),
			array( 'name' => 'Wrench', 'value' => 'icon-wrench' ),
			array( 'name' => 'Zoom In', 'value' => 'icon-zoom-in' ),
			array( 'name' => 'Zoom Out', 'value' => 'icon-zoom-out' ),
		);

		$widget_ops = array(
			'classname'   => 'awesome-feature',
			'description' => __( 'Displays a font awesome icon linked to a featured page of your choosing.', 'afpw' ),
		);

		$control_ops = array(
			'id_base' => 'awesome-feature',
			'width'   => 300,
			'height'  => 450,
		);

		parent::__construct('awesome-feature', __('Awesome Featured Page', 'afpw'), $widget_ops, $control_ops);

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
		$awesome_title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$awesome_icon = $instance['awesome_icon'];
		$title_placement = $instance['title_placement'];
		$awesome_text = apply_filters( 'widget_text', empty( $instance['awesome_text'] ) ? '' : $instance['awesome_text'], $instance );

		/* HTML output */
		echo $before_widget;

			$awesome_page = new WP_Query( array( 'page_id' => $instance['awesome_id'] ) );
			if ( $awesome_page->have_posts() ) :
				while ( $awesome_page->have_posts() ) : $awesome_page->the_post();

					/* Add a link to the featured page to the widget title */
					$before_title .= '<a href="'. get_permalink() .'">';
					$after_title = '</a>' . $after_title;

					/* Check for the title before the icon */
					if ( $title_placement == 'before_icon' && ! empty( $awesome_title ) ) {
						echo $before_title . $awesome_title . $after_title;
					}
					/* Display the icon if it's been set */
					if ( ! empty( $awesome_icon ) ) {
						echo'<span class="ico-bg"><a href="' . get_permalink() . '"><i class="'. esc_attr( $awesome_icon ) .'"></i></a></span>';
					}
					/* Check for the title after the icon */
					if ( $title_placement == 'after_icon' && ! empty( $awesome_title ) ) {
						echo $before_title . $awesome_title . $after_title;
					}
					/* Display the featured content if it exists */
					echo !empty( $instance['awesome_filter'] ) ? wpautop( $awesome_text ) : $awesome_text;

				endwhile;
				wp_reset_query();
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
		$new_instance['title'] = strip_tags( $new_instance['title'] );
		$new_instance['awesome_icon'] = strip_tags( $new_instance['awesome_icon'] );
		$new_instance['title_placement'] = strip_tags( $new_instance['title_placement'] );
		if ( current_user_can('unawesome_filtered_html') ) {
			$new_instance['awesome_text'] =  $new_instance['awesome_text'];
		} else {
			$new_instance['awesome_text'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['awesome_text']) ) ); // wp_filter_post_kses() expects slashed
		}
		$new_instance['awesome_filter'] = isset($new_instance['awesome_filter']);
		foreach ( $new_instance as $key => $value ) {

			/** Border radius and Icon size must not be empty, must be a digit */
			if ( ( 'border_radius' == $key || 'size' == $key ) && ( '' == $value || ! ctype_digit( $value ) ) ) {
				$new_instance[$key] = 0;
			}

			/** Validate hex code colors */
			elseif ( strpos( $key, '_color' ) && 0 == preg_match( '/^#(([a-fA-F0-9]{3}$)|([a-fA-F0-9]{6}$))/', $value ) ) {
				$new_instance[$key] = $old_instance[$key];
			}

			/** Sanitize Profile URIs */
			elseif ( array_key_exists( $key, (array) $this->profiles ) ) {
				$new_instance[$key] = esc_url( $new_instance[$key] );
			}

		}
		return $new_instance;
	}

	/**
	 * Echo the settings update form.
	 *
	 * @param array $instance Current settings
	 */
	function form( $instance ) {

		/** Merge with defaults */
		$instance = wp_parse_args( (array) $instance, $this->defaults );
		$title = strip_tags($instance['title']);
		$awesome_text = esc_textarea($instance['awesome_text']);

		?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title (Optional)', 'afpw' ); ?>:</label>
			<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" class="widefat" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'awesome_icon' ); ?>"><?php _e( 'Choose an Icon', 'afpw' ); ?>:</label>
			<select class="widefat font-awesome" id="<?php echo $this->get_field_id( 'awesome_icon' ); ?>" name="<?php echo $this->get_field_name( 'awesome_icon' ); ?>">
				<?php foreach ( (array) $this->icons as $icon  ) { ?>
				<option value="<?php echo $icon['value']; ?>"<?php selected( $icon['value'], $instance['awesome_icon'] ); ?>><?php _e( $icon['name'], 'afpw' ) ?></option>
				<?php } ?>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'title_placement' ); ?>"><?php _e( 'Display the Title', 'afpw' ); ?>:</label>
			<select class="widefat" id="<?php echo $this->get_field_id( 'title_placement' ); ?>" name="<?php echo $this->get_field_name( 'title_placement' ); ?>">
				<option value="before_icon" <?php selected( 'before_icon', $instance['title_placement'] ); ?>><?php _e( 'Before the Icon', 'afpw' ); ?></option>
				<option value="after_icon" <?php selected( 'after_icon', $instance['title_placement'] ); ?>><?php _e( 'After the Icon', 'afpw' ); ?></option>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'awesome_id' ); ?>"><?php _e( 'Link to Page', 'afpw' ); ?>:</label>
			<?php wp_dropdown_pages( array( 'name' => $this->get_field_name( 'awesome_id' ), 'selected' => $instance['awesome_id'] ) ); ?>
		</p>

		<textarea class="widefat" rows="10" cols="20" id="<?php echo $this->get_field_id('awesome_text'); ?>" name="<?php echo $this->get_field_name('awesome_text'); ?>"><?php echo $awesome_text; ?></textarea>

		<p>
			<input id="<?php echo $this->get_field_id('awesome_filter'); ?>" name="<?php echo $this->get_field_name('awesome_filter'); ?>" type="checkbox" <?php checked(isset($instance['awesome_filter']) ? $instance['awesome_filter'] : 0); ?> />&nbsp;
			<label for="<?php echo $this->get_field_id('awesome_filter'); ?>"><?php _e('Automatically add paragraphs', 'afpw'); ?></label>
		</p>
		<p>
			<a href="options-general.php?page=awesome-featured-page"><?php _e('Visit the Settings Page for More Options', 'afpw'); ?></a>
		</p>

		<?php
	}
}