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
			'icon_placement'   => 'after_title',
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
			array( 'name' => 'Adjust', 'value' => 'fa-adjust' ),
			array( 'name' => 'Align Center', 'value' => 'fa-align-center' ),
			array( 'name' => 'Align Justify', 'value' => 'fa-align-justify' ),
			array( 'name' => 'Align Left', 'value' => 'fa-align-left' ),
			array( 'name' => 'Align Right', 'value' => 'fa-align-right' ),
			array( 'name' => 'Ambulance', 'value' => 'fa-ambulance' ),
			array( 'name' => 'Anchor', 'value' => 'fa-anchor' ),
			array( 'name' => 'Angle Down', 'value' => 'fa-angle-down' ),
			array( 'name' => 'Angle Left', 'value' => 'fa-angle-left' ),
			array( 'name' => 'Angle Right', 'value' => 'fa-angle-right' ),
			array( 'name' => 'Angle Up', 'value' => 'fa-angle-up' ),
			array( 'name' => 'Arrow Down', 'value' => 'fa-arrow-down' ),
			array( 'name' => 'Arrow Left', 'value' => 'fa-arrow-left' ),
			array( 'name' => 'Arrow Right', 'value' => 'fa-arrow-right' ),
			array( 'name' => 'Arrow Up', 'value' => 'fa-arrow-up' ),
			array( 'name' => 'Asterisk', 'value' => 'fa-asterisk' ),
			array( 'name' => 'Backward', 'value' => 'fa-backward' ),
			array( 'name' => 'Ban Circle', 'value' => 'fa-ban-circle' ),
			array( 'name' => 'Bar Chart', 'value' => 'fa-bar-chart' ),
			array( 'name' => 'Barcode', 'value' => 'fa-barcode' ),
			array( 'name' => 'Beaker', 'value' => 'fa-beaker' ),
			array( 'name' => 'Beer', 'value' => 'fa-beer' ),
			array( 'name' => 'Bell', 'value' => 'fa-bell' ),
			array( 'name' => 'Bell Alt', 'value' => 'fa-bell-alt' ),
			array( 'name' => 'Bold', 'value' => 'fa-bold' ),
			array( 'name' => 'Bolt', 'value' => 'fa-bolt' ),
			array( 'name' => 'Book', 'value' => 'fa-book' ),
			array( 'name' => 'Bookmark', 'value' => 'fa-bookmark' ),
			array( 'name' => 'Bookmark Empty', 'value' => 'fa-bookmark-empty' ),
			array( 'name' => 'Briefcase', 'value' => 'fa-briefcase' ),
			array( 'name' => 'Building', 'value' => 'fa-building' ),
			array( 'name' => 'Bullhorn', 'value' => 'fa-bullhorn' ),
			array( 'name' => 'Bullseye', 'value' => 'fa-bullseye' ),
			array( 'name' => 'Calendar', 'value' => 'fa-calendar' ),
			array( 'name' => 'Calendar Empty', 'value' => 'fa-calendar-empty' ),
			array( 'name' => 'Camera', 'value' => 'fa-camera' ),
			array( 'name' => 'Camera Retro', 'value' => 'fa-camera-retro' ),
			array( 'name' => 'Caret Down', 'value' => 'fa-caret-down' ),
			array( 'name' => 'Caret Left', 'value' => 'fa-caret-left' ),
			array( 'name' => 'Caret Right', 'value' => 'fa-caret-right' ),
			array( 'name' => 'Caret Up', 'value' => 'fa-caret-up' ),
			array( 'name' => 'Certificate', 'value' => 'fa-certificate' ),
			array( 'name' => 'Check', 'value' => 'fa-check' ),
			array( 'name' => 'Check Empty', 'value' => 'fa-check-empty' ),
			array( 'name' => 'Check Minus', 'value' => 'fa-check-minus' ),
			array( 'name' => 'Check Sign', 'value' => 'fa-check-sign' ),
			array( 'name' => 'Chevron Down', 'value' => 'fa-chevron-down' ),
			array( 'name' => 'Chevron Left', 'value' => 'fa-chevron-left' ),
			array( 'name' => 'Chevron Right', 'value' => 'fa-chevron-right' ),
			array( 'name' => 'Chevron Sign Down', 'value' => 'fa-chevron-sign-down' ),
			array( 'name' => 'Chevron Sign Left', 'value' => 'fa-chevron-sign-left' ),
			array( 'name' => 'Chevron Sign Right', 'value' => 'fa-chevron-sign-right' ),
			array( 'name' => 'Chevron Sign Up', 'value' => 'fa-chevron-sign-up' ),
			array( 'name' => 'Chevron Up', 'value' => 'fa-chevron-up' ),
			array( 'name' => 'Circle', 'value' => 'fa-circle' ),
			array( 'name' => 'Circle Arrow Down', 'value' => 'fa-circle-arrow-down' ),
			array( 'name' => 'Circle Arrow Left', 'value' => 'fa-circle-arrow-left' ),
			array( 'name' => 'Circle Arrow Right', 'value' => 'fa-circle-arrow-right' ),
			array( 'name' => 'Circle Arrow Up', 'value' => 'fa-circle-arrow-up' ),
			array( 'name' => 'Circle Blank', 'value' => 'fa-circle-blank' ),
			array( 'name' => 'Cloud', 'value' => 'fa-cloud' ),
			array( 'name' => 'Cloud Download', 'value' => 'fa-cloud-download' ),
			array( 'name' => 'Cloud Upload', 'value' => 'fa-cloud-upload' ),
			array( 'name' => 'Code', 'value' => 'fa-code' ),
			array( 'name' => 'Code Fork', 'value' => 'fa-code-fork' ),
			array( 'name' => 'Coffee', 'value' => 'fa-coffee' ),
			array( 'name' => 'Cog', 'value' => 'fa-cog' ),
			array( 'name' => 'Cogs', 'value' => 'fa-cogs' ),
			array( 'name' => 'Collapse Alt', 'value' => 'fa-collapse-alt' ),
			array( 'name' => 'Columns', 'value' => 'fa-columns' ),
			array( 'name' => 'Comment', 'value' => 'fa-comment' ),
			array( 'name' => 'Comment Alt', 'value' => 'fa-comment-alt' ),
			array( 'name' => 'Comments', 'value' => 'fa-comments' ),
			array( 'name' => 'Comments Alt', 'value' => 'fa-comments-alt' ),
			array( 'name' => 'Copy', 'value' => 'fa-copy' ),
			array( 'name' => 'Credit Card', 'value' => 'fa-credit-card' ),
			array( 'name' => 'Crop', 'value' => 'fa-crop' ),
			array( 'name' => 'CSS3', 'value' => 'fa-css3' ),
			array( 'name' => 'Cut', 'value' => 'fa-cut' ),
			array( 'name' => 'Dashboard', 'value' => 'fa-dashboard' ),
			array( 'name' => 'Desktop', 'value' => 'fa-desktop' ),
			array( 'name' => 'Double Angle Down', 'value' => 'fa-double-angle-down' ),
			array( 'name' => 'Double Angle Left', 'value' => 'fa-double-angle-left' ),
			array( 'name' => 'Double Angle Right', 'value' => 'fa-double-angle-right' ),
			array( 'name' => 'Double Angle Up', 'value' => 'fa-double-angle-up' ),
			array( 'name' => 'Download', 'value' => 'fa-download' ),
			array( 'name' => 'Download Alt', 'value' => 'fa-download-alt' ),
			array( 'name' => 'Edit', 'value' => 'fa-edit' ),
			array( 'name' => 'Edit Sign', 'value' => 'fa-edit-sign' ),
			array( 'name' => 'Eject', 'value' => 'fa-eject' ),
			array( 'name' => 'Ellipsis Horizontal', 'value' => 'fa-ellipsis-horizontal' ),
			array( 'name' => 'Ellipsis Vertical', 'value' => 'fa-ellipsis-vertical' ),
			array( 'name' => 'Envelope', 'value' => 'fa-envelope' ),
			array( 'name' => 'Envelope Alt', 'value' => 'fa-envelope-alt' ),
			array( 'name' => 'Eraser', 'value' => 'fa-eraser' ),
			array( 'name' => 'Exchange', 'value' => 'fa-exchange' ),
			array( 'name' => 'Exclamation', 'value' => 'fa-exclamation' ),
			array( 'name' => 'Exclamation Sign', 'value' => 'fa-exclamation-sign' ),
			array( 'name' => 'Expand Alt', 'value' => 'fa-expand-alt' ),
			array( 'name' => 'External Link', 'value' => 'fa-external-link' ),
			array( 'name' => 'External Link Sign', 'value' => 'fa-external-link-sign' ),
			array( 'name' => 'Eye Close', 'value' => 'fa-eye-close' ),
			array( 'name' => 'Eye Open', 'value' => 'fa-eye-open' ),
			array( 'name' => 'Facebook', 'value' => 'fa-facebook' ),
			array( 'name' => 'Facebook Sign', 'value' => 'fa-facebook-sign' ),
			array( 'name' => 'Facetime Video', 'value' => 'fa-facetime-video' ),
			array( 'name' => 'Fast Backward', 'value' => 'fa-fast-backward' ),
			array( 'name' => 'Fast Forward', 'value' => 'fa-fast-forward' ),
			array( 'name' => 'Fighter Jet', 'value' => 'fa-fighter-jet' ),
			array( 'name' => 'File', 'value' => 'fa-file' ),
			array( 'name' => 'File Alt', 'value' => 'fa-file-alt' ),
			array( 'name' => 'Film', 'value' => 'fa-film' ),
			array( 'name' => 'Filter', 'value' => 'fa-filter' ),
			array( 'name' => 'Fire', 'value' => 'fa-fire' ),
			array( 'name' => 'Fire Extinguisher', 'value' => 'fa-fire-extinguisher' ),
			array( 'name' => 'Flag', 'value' => 'fa-flag' ),
			array( 'name' => 'Flag Alt', 'value' => 'fa-flag-alt' ),
			array( 'name' => 'Flag Checkered', 'value' => 'fa-flag-checkered' ),
			array( 'name' => 'Folder Close', 'value' => 'fa-folder-close' ),
			array( 'name' => 'Folder Close Alt', 'value' => 'fa-folder-close-alt' ),
			array( 'name' => 'Folder Open', 'value' => 'fa-folder-open' ),
			array( 'name' => 'Folder Open Alt', 'value' => 'fa-folder-open-alt' ),
			array( 'name' => 'Font', 'value' => 'fa-font' ),
			array( 'name' => 'Food', 'value' => 'fa-food' ),
			array( 'name' => 'Forward', 'value' => 'fa-forward' ),
			array( 'name' => 'Frown', 'value' => 'fa-frown' ),
			array( 'name' => 'Fullscreen', 'value' => 'fa-fullscreen' ),
			array( 'name' => 'Gamepad', 'value' => 'fa-gamepad' ),
			array( 'name' => 'Gift', 'value' => 'fa-gift' ),
			array( 'name' => 'Github', 'value' => 'fa-github' ),
			array( 'name' => 'Github Sign', 'value' => 'fa-github-sign' ),
			array( 'name' => 'Glass', 'value' => 'fa-glass' ),
			array( 'name' => 'Globe', 'value' => 'fa-globe' ),
			array( 'name' => 'Google Plus', 'value' => 'fa-google-plus' ),
			array( 'name' => 'Google Plus Sign', 'value' => 'fa-google-plus-sign' ),
			array( 'name' => 'Group', 'value' => 'fa-group' ),
			array( 'name' => 'H Sign', 'value' => 'fa-h-sign' ),
			array( 'name' => 'Hand Down', 'value' => 'fa-hand-down' ),
			array( 'name' => 'Hand Left', 'value' => 'fa-hand-left' ),
			array( 'name' => 'Hand Right', 'value' => 'fa-hand-right' ),
			array( 'name' => 'Hand Up', 'value' => 'fa-hand-up' ),
			array( 'name' => 'Hdd', 'value' => 'fa-hdd' ),
			array( 'name' => 'Headphones', 'value' => 'fa-headphones' ),
			array( 'name' => 'Heart', 'value' => 'fa-heart' ),
			array( 'name' => 'Heart Empty', 'value' => 'fa-heart-empty' ),
			array( 'name' => 'Home', 'value' => 'fa-home' ),
			array( 'name' => 'Hospital', 'value' => 'fa-hospital' ),
			array( 'name' => 'Html5', 'value' => 'fa-html5' ),
			array( 'name' => 'Inbox', 'value' => 'fa-inbox' ),
			array( 'name' => 'Indent Left', 'value' => 'fa-indent-left' ),
			array( 'name' => 'Indent Right', 'value' => 'fa-indent-right' ),
			array( 'name' => 'Info', 'value' => 'fa-info' ),
			array( 'name' => 'Info Sign', 'value' => 'fa-info-sign' ),
			array( 'name' => 'Italic', 'value' => 'fa-italic' ),
			array( 'name' => 'Key', 'value' => 'fa-key' ),
			array( 'name' => 'Keyboard', 'value' => 'fa-keyboard' ),
			array( 'name' => 'Laptop', 'value' => 'fa-laptop' ),
			array( 'name' => 'Leaf', 'value' => 'fa-leaf' ),
			array( 'name' => 'Legal', 'value' => 'fa-legal' ),
			array( 'name' => 'Lemon', 'value' => 'fa-lemon' ),
			array( 'name' => 'Level Down', 'value' => 'fa-level-down' ),
			array( 'name' => 'Level Up', 'value' => 'fa-level-up' ),
			array( 'name' => 'Lightbulb', 'value' => 'fa-lightbulb' ),
			array( 'name' => 'Link', 'value' => 'fa-link' ),
			array( 'name' => 'Linkedin', 'value' => 'fa-linkedin' ),
			array( 'name' => 'Linkedin Sign', 'value' => 'fa-linkedin-sign' ),
			array( 'name' => 'List', 'value' => 'fa-list' ),
			array( 'name' => 'List Alt', 'value' => 'fa-list-alt' ),
			array( 'name' => 'List Ol', 'value' => 'fa-list-ol' ),
			array( 'name' => 'List Ul', 'value' => 'fa-list-ul' ),
			array( 'name' => 'Location Arrow', 'value' => 'fa-location-arrow' ),
			array( 'name' => 'Lock', 'value' => 'fa-lock' ),
			array( 'name' => 'Magic', 'value' => 'fa-magic' ),
			array( 'name' => 'Magnet', 'value' => 'fa-magnet' ),
			array( 'name' => 'Mail Reply All', 'value' => 'fa-mail-reply-all' ),
			array( 'name' => 'Map Marker', 'value' => 'fa-map-marker' ),
			array( 'name' => 'Maxcdn', 'value' => 'fa-maxcdn' ),
			array( 'name' => 'Medkit', 'value' => 'fa-medkit' ),
			array( 'name' => 'Meh', 'value' => 'fa-meh' ),
			array( 'name' => 'Microphone', 'value' => 'fa-microphone' ),
			array( 'name' => 'Microphone Off', 'value' => 'fa-microphone-off' ),
			array( 'name' => 'Minus', 'value' => 'fa-minus' ),
			array( 'name' => 'Minus Sign', 'value' => 'fa-minus-sign' ),
			array( 'name' => 'Minus Sign Alt', 'value' => 'fa-minus-sign-alt' ),
			array( 'name' => 'Mobile Phone', 'value' => 'fa-mobile-phone' ),
			array( 'name' => 'Money', 'value' => 'fa-money' ),
			array( 'name' => 'Move', 'value' => 'fa-move' ),
			array( 'name' => 'Music', 'value' => 'fa-music' ),
			array( 'name' => 'Off', 'value' => 'fa-off' ),
			array( 'name' => 'Ok', 'value' => 'fa-ok' ),
			array( 'name' => 'Ok Circle', 'value' => 'fa-ok-circle' ),
			array( 'name' => 'Ok Sign', 'value' => 'fa-ok-sign' ),
			array( 'name' => 'Paper Clip', 'value' => 'fa-paper-clip' ),
			array( 'name' => 'Paste', 'value' => 'fa-paste' ),
			array( 'name' => 'Pause', 'value' => 'fa-pause' ),
			array( 'name' => 'Pencil', 'value' => 'fa-pencil' ),
			array( 'name' => 'Phone', 'value' => 'fa-phone' ),
			array( 'name' => 'Phone Sign', 'value' => 'fa-phone-sign' ),
			array( 'name' => 'Picture', 'value' => 'fa-picture' ),
			array( 'name' => 'Pinterest', 'value' => 'fa-pinterest' ),
			array( 'name' => 'Pinterest Sign', 'value' => 'fa-pinterest-sign' ),
			array( 'name' => 'Plane', 'value' => 'fa-plane' ),
			array( 'name' => 'Play', 'value' => 'fa-play' ),
			array( 'name' => 'Play Circle', 'value' => 'fa-play-circle' ),
			array( 'name' => 'Play Sign', 'value' => 'fa-play-sign' ),
			array( 'name' => 'Plus', 'value' => 'fa-plus' ),
			array( 'name' => 'Plus Sign', 'value' => 'fa-plus-sign' ),
			array( 'name' => 'Plus Sign Alt', 'value' => 'fa-plus-sign-alt' ),
			array( 'name' => 'Print', 'value' => 'fa-print' ),
			array( 'name' => 'Pushpin', 'value' => 'fa-pushpin' ),
			array( 'name' => 'Puzzle Piece', 'value' => 'fa-puzzle-piece' ),
			array( 'name' => 'Qrcode', 'value' => 'fa-qrcode' ),
			array( 'name' => 'Question', 'value' => 'fa-question' ),
			array( 'name' => 'Question Sign', 'value' => 'fa-question-sign' ),
			array( 'name' => 'Quote Left', 'value' => 'fa-quote-left' ),
			array( 'name' => 'Quote Right', 'value' => 'fa-quote-right' ),
			array( 'name' => 'Random', 'value' => 'fa-random' ),
			array( 'name' => 'Refresh', 'value' => 'fa-refresh' ),
			array( 'name' => 'Remove', 'value' => 'fa-remove' ),
			array( 'name' => 'Remove Circle', 'value' => 'fa-remove-circle' ),
			array( 'name' => 'Remove Sign', 'value' => 'fa-remove-sign' ),
			array( 'name' => 'Reorder', 'value' => 'fa-reorder' ),
			array( 'name' => 'Repeat', 'value' => 'fa-repeat' ),
			array( 'name' => 'Reply', 'value' => 'fa-reply' ),
			array( 'name' => 'Reply All', 'value' => 'fa-reply-all' ),
			array( 'name' => 'Resize Full', 'value' => 'fa-resize-full' ),
			array( 'name' => 'Resize Horizontal', 'value' => 'fa-resize-horizontal' ),
			array( 'name' => 'Resize Small', 'value' => 'fa-resize-small' ),
			array( 'name' => 'Resize Vertical', 'value' => 'fa-resize-vertical' ),
			array( 'name' => 'Retweet', 'value' => 'fa-retweet' ),
			array( 'name' => 'Road', 'value' => 'fa-road' ),
			array( 'name' => 'Rocket', 'value' => 'fa-rocket' ),
			array( 'name' => 'Rss', 'value' => 'fa-rss' ),
			array( 'name' => 'Rss Sign', 'value' => 'fa-rss-sign' ),
			array( 'name' => 'Save', 'value' => 'fa-save' ),
			array( 'name' => 'Screenshot', 'value' => 'fa-screenshot' ),
			array( 'name' => 'Search', 'value' => 'fa-search' ),
			array( 'name' => 'Share', 'value' => 'fa-share' ),
			array( 'name' => 'Share Alt', 'value' => 'fa-share-alt' ),
			array( 'name' => 'Share Sign', 'value' => 'fa-share-sign' ),
			array( 'name' => 'Shield', 'value' => 'fa-shield' ),
			array( 'name' => 'Shopping Cart', 'value' => 'fa-shopping-cart' ),
			array( 'name' => 'Sign Blank', 'value' => 'fa-sign-blank' ),
			array( 'name' => 'Signal', 'value' => 'fa-signal' ),
			array( 'name' => 'Sign In', 'value' => 'fa-signin' ),
			array( 'name' => 'Sign Out', 'value' => 'fa-signout' ),
			array( 'name' => 'Sitemap', 'value' => 'fa-sitemap' ),
			array( 'name' => 'Smile', 'value' => 'fa-smile' ),
			array( 'name' => 'Sort', 'value' => 'fa-sort' ),
			array( 'name' => 'Sort Down', 'value' => 'fa-sort-down' ),
			array( 'name' => 'Sort Up', 'value' => 'fa-sort-up' ),
			array( 'name' => 'Spinner', 'value' => 'fa-spinner' ),
			array( 'name' => 'Star', 'value' => 'fa-star' ),
			array( 'name' => 'Star Empty', 'value' => 'fa-star-empty' ),
			array( 'name' => 'Star Half', 'value' => 'fa-star-half' ),
			array( 'name' => 'Star Half Empty', 'value' => 'fa-star-half-empty' ),
			array( 'name' => 'Star Half Full', 'value' => 'fa-star-half-full' ),
			array( 'name' => 'Step Backward', 'value' => 'fa-step-backward' ),
			array( 'name' => 'Step Forward', 'value' => 'fa-step-forward' ),
			array( 'name' => 'Stethoscope', 'value' => 'fa-stethoscope' ),
			array( 'name' => 'Stop', 'value' => 'fa-stop' ),
			array( 'name' => 'Strikethrough', 'value' => 'fa-strikethrough' ),
			array( 'name' => 'Subscript', 'value' => 'fa-subscript' ),
			array( 'name' => 'Suitcase', 'value' => 'fa-suitcase' ),
			array( 'name' => 'Superscript', 'value' => 'fa-superscript' ),
			array( 'name' => 'Table', 'value' => 'fa-table' ),
			array( 'name' => 'Tablet', 'value' => 'fa-tablet' ),
			array( 'name' => 'Tag', 'value' => 'fa-tag' ),
			array( 'name' => 'Tags', 'value' => 'fa-tags' ),
			array( 'name' => 'Tasks', 'value' => 'fa-tasks' ),
			array( 'name' => 'Terminal', 'value' => 'fa-terminal' ),
			array( 'name' => 'Text Height', 'value' => 'fa-text-height' ),
			array( 'name' => 'Text Width', 'value' => 'fa-text-width' ),
			array( 'name' => 'Th', 'value' => 'fa-th' ),
			array( 'name' => 'Th Large', 'value' => 'fa-th-large' ),
			array( 'name' => 'Th List', 'value' => 'fa-th-list' ),
			array( 'name' => 'Thumbs Down', 'value' => 'fa-thumbs-down' ),
			array( 'name' => 'Thumbs Up', 'value' => 'fa-thumbs-up' ),
			array( 'name' => 'Ticket', 'value' => 'fa-ticket' ),
			array( 'name' => 'Time', 'value' => 'fa-time' ),
			array( 'name' => 'Tint', 'value' => 'fa-tint' ),
			array( 'name' => 'Trash', 'value' => 'fa-trash' ),
			array( 'name' => 'Trophy', 'value' => 'fa-trophy' ),
			array( 'name' => 'Truck', 'value' => 'fa-truck' ),
			array( 'name' => 'Twitter', 'value' => 'fa-twitter' ),
			array( 'name' => 'Twitter Sign', 'value' => 'fa-twitter-sign' ),
			array( 'name' => 'Umbrella', 'value' => 'fa-umbrella' ),
			array( 'name' => 'Underline', 'value' => 'fa-underline' ),
			array( 'name' => 'Undo', 'value' => 'fa-undo' ),
			array( 'name' => 'Unlink', 'value' => 'fa-unlink' ),
			array( 'name' => 'Unlock', 'value' => 'fa-unlock' ),
			array( 'name' => 'Unlock Alt', 'value' => 'fa-unlock-alt' ),
			array( 'name' => 'Upload', 'value' => 'fa-upload' ),
			array( 'name' => 'Upload Alt', 'value' => 'fa-upload-alt' ),
			array( 'name' => 'User', 'value' => 'fa-user' ),
			array( 'name' => 'User Md', 'value' => 'fa-user-md' ),
			array( 'name' => 'Volume Down', 'value' => 'fa-volume-down' ),
			array( 'name' => 'Volume Off', 'value' => 'fa-volume-off' ),
			array( 'name' => 'Volume Up', 'value' => 'fa-volume-up' ),
			array( 'name' => 'Warning Sign', 'value' => 'fa-warning-sign' ),
			array( 'name' => 'Wrench', 'value' => 'fa-wrench' ),
			array( 'name' => 'Zoom In', 'value' => 'fa-zoom-in' ),
			array( 'name' => 'Zoom Out', 'value' => 'fa-zoom-out' ),
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
		$awesome_title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$awesome_icon = $instance['awesome_icon'];
		$icon_placement = $instance['icon_placement'];
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
		$new_instance['title'] = strip_tags( $new_instance['title'] );
		$new_instance['awesome_icon'] = strip_tags( $new_instance['awesome_icon'] );
		$new_instance['icon_placement'] = strip_tags( $new_instance['icon_placement'] );
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

	function generate_post_select( $select_id, $post_type, $selected = 0 ) {
		$posts = get_posts(array('post_type'=> $post_type, 'post_status'=> 'publish', 'suppress_filters' => false, 'posts_per_page'=>-1 ) );
		echo '<select class="widefat" name="'. $select_id .'" id="'.$select_id.'">';
		foreach ( $posts as $post ) {
			echo '<option value="', $post->ID, '"', $selected == $post->ID ? ' selected="selected"' : '', '>', $post->post_title, '</option>';
		}
		echo '</select>';
		wp_reset_postdata();
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
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title (Optional)', 'afcw' ); ?>:</label>
			<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" class="widefat" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'awesome_icon' ); ?>"><?php _e( 'Choose an Icon', 'afcw' ); ?>:</label>
			<select class="widefat font-awesome" id="<?php echo $this->get_field_id( 'awesome_icon' ); ?>" name="<?php echo $this->get_field_name( 'awesome_icon' ); ?>">
				<?php foreach ( (array) $this->icons as $icon  ) { ?>
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
			<?php $this->generate_post_select( $select_id = $this->get_field_id( 'awesome_id' ), $post_type = 'any' ); ?>
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