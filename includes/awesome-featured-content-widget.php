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
			'icon_placement'    => 'after_title',
			'awesome_filter'    => '',
		);

		/**
		* Add a Font Awesome metabox output with Select2
		*
		* @link http://fortawesome.github.com/Font-Awesome/
		* @link http://ivaynberg.github.com/select2/
		*/
		$this->icons = array(
			array(
				'name'  => '',
				'value' => '',
			),
			array(
				'name'  => 'Adjust',
				'value' => 'fa-adjust',
			),
			array(
				'name'  => 'Adn',
				'value' => 'fa-adn',
			),
			array(
				'name'  => 'Align Center',
				'value' => 'fa-align-center',
			),
			array(
				'name'  => 'Align Justify',
				'value' => 'fa-align-justify',
			),
			array(
				'name'  => 'Align Left',
				'value' => 'fa-align-left',
			),
			array(
				'name'  => 'Align Right',
				'value' => 'fa-align-right',
			),
			array(
				'name'  => 'Ambulance',
				'value' => 'fa-ambulance',
			),
			array(
				'name'  => 'Anchor',
				'value' => 'fa-anchor',
			),
			array(
				'name'  => 'Android',
				'value' => 'fa-android',
			),
			array(
				'name'  => 'Angle Double Down',
				'value' => 'fa-angle-double-down',
			),
			array(
				'name'  => 'Angle Double Left',
				'value' => 'fa-angle-double-left',
			),
			array(
				'name'  => 'Angle Double Right',
				'value' => 'fa-angle-double-right',
			),
			array(
				'name'  => 'Angle Double Up',
				'value' => 'fa-angle-double-up',
			),
			array(
				'name'  => 'Angle Down',
				'value' => 'fa-angle-down',
			),
			array(
				'name'  => 'Angle Left',
				'value' => 'fa-angle-left',
			),
			array(
				'name'  => 'Angle Right',
				'value' => 'fa-angle-right',
			),
			array(
				'name'  => 'Angle Up',
				'value' => 'fa-angle-up',
			),
			array(
				'name'  => 'Apple',
				'value' => 'fa-apple',
			),
			array(
				'name'  => 'Archive',
				'value' => 'fa-archive',
			),
			array(
				'name'  => 'Arrow Circle Down',
				'value' => 'fa-arrow-circle-down',
			),
			array(
				'name'  => 'Arrow Circle Left',
				'value' => 'fa-arrow-circle-left',
			),
			array(
				'name'  => 'Arrow Circle O Down',
				'value' => 'fa-arrow-circle-o-down',
			),
			array(
				'name'  => 'Arrow Circle O Left',
				'value' => 'fa-arrow-circle-o-left',
			),
			array(
				'name'  => 'Arrow Circle O Right',
				'value' => 'fa-arrow-circle-o-right',
			),
			array(
				'name'  => 'Arrow Circle O Up',
				'value' => 'fa-arrow-circle-o-up',
			),
			array(
				'name'  => 'Arrow Circle Right',
				'value' => 'fa-arrow-circle-right',
			),
			array(
				'name'  => 'Arrow Circle Up',
				'value' => 'fa-arrow-circle-up',
			),
			array(
				'name'  => 'Arrow Down',
				'value' => 'fa-arrow-down',
			),
			array(
				'name'  => 'Arrow Left',
				'value' => 'fa-arrow-left',
			),
			array(
				'name'  => 'Arrow Right',
				'value' => 'fa-arrow-right',
			),
			array(
				'name'  => 'Arrow Up',
				'value' => 'fa-arrow-up',
			),
			array(
				'name'  => 'Arrows',
				'value' => 'fa-arrows',
			),
			array(
				'name'  => 'Arrows Alt',
				'value' => 'fa-arrows-alt',
			),
			array(
				'name'  => 'Arrows H',
				'value' => 'fa-arrows-h',
			),
			array(
				'name'  => 'Arrows V',
				'value' => 'fa-arrows-v',
			),
			array(
				'name'  => 'Asterisk',
				'value' => 'fa-asterisk',
			),
			array(
				'name'  => 'Backward',
				'value' => 'fa-backward',
			),
			array(
				'name'  => 'Ban',
				'value' => 'fa-ban',
			),
			array(
				'name'  => 'Bar Chart O',
				'value' => 'fa-bar-chart-o',
			),
			array(
				'name'  => 'Barcode',
				'value' => 'fa-barcode',
			),
			array(
				'name'  => 'Bars',
				'value' => 'fa-bars',
			),
			array(
				'name'  => 'Beer',
				'value' => 'fa-beer',
			),
			array(
				'name'  => 'Bell',
				'value' => 'fa-bell',
			),
			array(
				'name'  => 'Bell O',
				'value' => 'fa-bell-o',
			),
			array(
				'name'  => 'Bitbucket',
				'value' => 'fa-bitbucket',
			),
			array(
				'name'  => 'Bitbucket Square',
				'value' => 'fa-bitbucket-square',
			),
			array(
				'name'  => 'Bold',
				'value' => 'fa-bold',
			),
			array(
				'name'  => 'Bolt',
				'value' => 'fa-bolt',
			),
			array(
				'name'  => 'Book',
				'value' => 'fa-book',
			),
			array(
				'name'  => 'Bookmark',
				'value' => 'fa-bookmark',
			),
			array(
				'name'  => 'Bookmark O',
				'value' => 'fa-bookmark-o',
			),
			array(
				'name'  => 'Briefcase',
				'value' => 'fa-briefcase',
			),
			array(
				'name'  => 'Btc',
				'value' => 'fa-btc',
			),
			array(
				'name'  => 'Bug',
				'value' => 'fa-bug',
			),
			array(
				'name'  => 'Building O',
				'value' => 'fa-building-o',
			),
			array(
				'name'  => 'Bullhorn',
				'value' => 'fa-bullhorn',
			),
			array(
				'name'  => 'Bullseye',
				'value' => 'fa-bullseye',
			),
			array(
				'name'  => 'Calendar',
				'value' => 'fa-calendar',
			),
			array(
				'name'  => 'Calendar O',
				'value' => 'fa-calendar-o',
			),
			array(
				'name'  => 'Camera',
				'value' => 'fa-camera',
			),
			array(
				'name'  => 'Camera Retro',
				'value' => 'fa-camera-retro',
			),
			array(
				'name'  => 'Caret Down',
				'value' => 'fa-caret-down',
			),
			array(
				'name'  => 'Caret Left',
				'value' => 'fa-caret-left',
			),
			array(
				'name'  => 'Caret Right',
				'value' => 'fa-caret-right',
			),
			array(
				'name'  => 'Caret Square O Down',
				'value' => 'fa-caret-square-o-down',
			),
			array(
				'name'  => 'Caret Square O Left',
				'value' => 'fa-caret-square-o-left',
			),
			array(
				'name'  => 'Caret Square O Right',
				'value' => 'fa-caret-square-o-right',
			),
			array(
				'name'  => 'Caret Square O Up',
				'value' => 'fa-caret-square-o-up',
			),
			array(
				'name'  => 'Caret Up',
				'value' => 'fa-caret-up',
			),
			array(
				'name'  => 'Certificate',
				'value' => 'fa-certificate',
			),
			array(
				'name'  => 'Chain Broken',
				'value' => 'fa-chain-broken',
			),
			array(
				'name'  => 'Check',
				'value' => 'fa-check',
			),
			array(
				'name'  => 'Check Circle',
				'value' => 'fa-check-circle',
			),
			array(
				'name'  => 'Check Circle O',
				'value' => 'fa-check-circle-o',
			),
			array(
				'name'  => 'Check Square',
				'value' => 'fa-check-square',
			),
			array(
				'name'  => 'Check Square O',
				'value' => 'fa-check-square-o',
			),
			array(
				'name'  => 'Chevron Circle Down',
				'value' => 'fa-chevron-circle-down',
			),
			array(
				'name'  => 'Chevron Circle Left',
				'value' => 'fa-chevron-circle-left',
			),
			array(
				'name'  => 'Chevron Circle Right',
				'value' => 'fa-chevron-circle-right',
			),
			array(
				'name'  => 'Chevron Circle Up',
				'value' => 'fa-chevron-circle-up',
			),
			array(
				'name'  => 'Chevron Down',
				'value' => 'fa-chevron-down',
			),
			array(
				'name'  => 'Chevron Left',
				'value' => 'fa-chevron-left',
			),
			array(
				'name'  => 'Chevron Right',
				'value' => 'fa-chevron-right',
			),
			array(
				'name'  => 'Chevron Up',
				'value' => 'fa-chevron-up',
			),
			array(
				'name'  => 'Circle',
				'value' => 'fa-circle',
			),
			array(
				'name'  => 'Circle O',
				'value' => 'fa-circle-o',
			),
			array(
				'name'  => 'Clipboard',
				'value' => 'fa-clipboard',
			),
			array(
				'name'  => 'Clock O',
				'value' => 'fa-clock-o',
			),
			array(
				'name'  => 'Cloud',
				'value' => 'fa-cloud',
			),
			array(
				'name'  => 'Cloud Download',
				'value' => 'fa-cloud-download',
			),
			array(
				'name'  => 'Cloud Upload',
				'value' => 'fa-cloud-upload',
			),
			array(
				'name'  => 'Code',
				'value' => 'fa-code',
			),
			array(
				'name'  => 'Code Fork',
				'value' => 'fa-code-fork',
			),
			array(
				'name'  => 'Coffee',
				'value' => 'fa-coffee',
			),
			array(
				'name'  => 'Cog',
				'value' => 'fa-cog',
			),
			array(
				'name'  => 'Cogs',
				'value' => 'fa-cogs',
			),
			array(
				'name'  => 'Columns',
				'value' => 'fa-columns',
			),
			array(
				'name'  => 'Comment',
				'value' => 'fa-comment',
			),
			array(
				'name'  => 'Comment O',
				'value' => 'fa-comment-o',
			),
			array(
				'name'  => 'Comments',
				'value' => 'fa-comments',
			),
			array(
				'name'  => 'Comments O',
				'value' => 'fa-comments-o',
			),
			array(
				'name'  => 'Compass',
				'value' => 'fa-compass',
			),
			array(
				'name'  => 'Compress',
				'value' => 'fa-compress',
			),
			array(
				'name'  => 'Credit Card',
				'value' => 'fa-credit-card',
			),
			array(
				'name'  => 'Crop',
				'value' => 'fa-crop',
			),
			array(
				'name'  => 'Crosshairs',
				'value' => 'fa-crosshairs',
			),
			array(
				'name'  => 'Css3',
				'value' => 'fa-css3',
			),
			array(
				'name'  => 'Cutlery',
				'value' => 'fa-cutlery',
			),
			array(
				'name'  => 'Desktop',
				'value' => 'fa-desktop',
			),
			array(
				'name'  => 'Dot Circle O',
				'value' => 'fa-dot-circle-o',
			),
			array(
				'name'  => 'Download',
				'value' => 'fa-download',
			),
			array(
				'name'  => 'Dribbble',
				'value' => 'fa-dribbble',
			),
			array(
				'name'  => 'Dropbox',
				'value' => 'fa-dropbox',
			),
			array(
				'name'  => 'Eject',
				'value' => 'fa-eject',
			),
			array(
				'name'  => 'Ellipsis H',
				'value' => 'fa-ellipsis-h',
			),
			array(
				'name'  => 'Ellipsis V',
				'value' => 'fa-ellipsis-v',
			),
			array(
				'name'  => 'Envelope',
				'value' => 'fa-envelope',
			),
			array(
				'name'  => 'Envelope O',
				'value' => 'fa-envelope-o',
			),
			array(
				'name'  => 'Eraser',
				'value' => 'fa-eraser',
			),
			array(
				'name'  => 'Eur',
				'value' => 'fa-eur',
			),
			array(
				'name'  => 'Exchange',
				'value' => 'fa-exchange',
			),
			array(
				'name'  => 'Exclamation',
				'value' => 'fa-exclamation',
			),
			array(
				'name'  => 'Exclamation Circle',
				'value' => 'fa-exclamation-circle',
			),
			array(
				'name'  => 'Exclamation Triangle',
				'value' => 'fa-exclamation-triangle',
			),
			array(
				'name'  => 'Expand',
				'value' => 'fa-expand',
			),
			array(
				'name'  => 'External Link',
				'value' => 'fa-external-link',
			),
			array(
				'name'  => 'External Link Square',
				'value' => 'fa-external-link-square',
			),
			array(
				'name'  => 'Eye',
				'value' => 'fa-eye',
			),
			array(
				'name'  => 'Eye Slash',
				'value' => 'fa-eye-slash',
			),
			array(
				'name'  => 'Female',
				'value' => 'fa-female',
			),
			array(
				'name'  => 'Ffacebook',
				'value' => 'ffacebook',
			),
			array(
				'name'  => 'Facebook Square',
				'value' => 'fa-facebook-square',
			),
			array(
				'name'  => 'Fast Backward',
				'value' => 'fa-fast-backward',
			),
			array(
				'name'  => 'Fast Forward',
				'value' => 'fa-fast-forward',
			),
			array(
				'name'  => 'Fighter Jet',
				'value' => 'fa-fighter-jet',
			),
			array(
				'name'  => 'File',
				'value' => 'fa-file',
			),
			array(
				'name'  => 'File O',
				'value' => 'fa-file-o',
			),
			array(
				'name'  => 'File Text',
				'value' => 'fa-file-text',
			),
			array(
				'name'  => 'File Text O',
				'value' => 'fa-file-text-o',
			),
			array(
				'name'  => 'Files O',
				'value' => 'fa-files-o',
			),
			array(
				'name'  => 'Film',
				'value' => 'fa-film',
			),
			array(
				'name'  => 'Filter',
				'value' => 'fa-filter',
			),
			array(
				'name'  => 'Fire',
				'value' => 'fa-fire',
			),
			array(
				'name'  => 'Fire Extinguisher',
				'value' => 'fa-fire-extinguisher',
			),
			array(
				'name'  => 'Flag',
				'value' => 'fa-flag',
			),
			array(
				'name'  => 'Flag Checkered',
				'value' => 'fa-flag-checkered',
			),
			array(
				'name'  => 'Flag O',
				'value' => 'fa-flag-o',
			),
			array(
				'name'  => 'Flask',
				'value' => 'fa-flask',
			),
			array(
				'name'  => 'Flickr',
				'value' => 'fa-flickr',
			),
			array(
				'name'  => 'Floppy O',
				'value' => 'fa-floppy-o',
			),
			array(
				'name'  => 'Folder',
				'value' => 'fa-folder',
			),
			array(
				'name'  => 'Folder O',
				'value' => 'fa-folder-o',
			),
			array(
				'name'  => 'Folder Open',
				'value' => 'fa-folder-open',
			),
			array(
				'name'  => 'Folder Open O',
				'value' => 'fa-folder-open-o',
			),
			array(
				'name'  => 'Font',
				'value' => 'fa-font',
			),
			array(
				'name'  => 'Forward',
				'value' => 'fa-forward',
			),
			array(
				'name'  => 'Foursquare',
				'value' => 'fa-foursquare',
			),
			array(
				'name'  => 'Frown O',
				'value' => 'fa-frown-o',
			),
			array(
				'name'  => 'Gamepad',
				'value' => 'fa-gamepad',
			),
			array(
				'name'  => 'Gavel',
				'value' => 'fa-gavel',
			),
			array(
				'name'  => 'Gbp',
				'value' => 'fa-gbp',
			),
			array(
				'name'  => 'Gift',
				'value' => 'fa-gift',
			),
			array(
				'name'  => 'Github',
				'value' => 'fa-github',
			),
			array(
				'name'  => 'Github Alt',
				'value' => 'fa-github-alt',
			),
			array(
				'name'  => 'Github Square',
				'value' => 'fa-github-square',
			),
			array(
				'name'  => 'Gittip',
				'value' => 'fa-gittip',
			),
			array(
				'name'  => 'Glass',
				'value' => 'fa-glass',
			),
			array(
				'name'  => 'Globe',
				'value' => 'fa-globe',
			),
			array(
				'name'  => 'Google Plus',
				'value' => 'fa-google-plus',
			),
			array(
				'name'  => 'Google Plus Square',
				'value' => 'fa-google-plus-square',
			),
			array(
				'name'  => 'H Square',
				'value' => 'fa-h-square',
			),
			array(
				'name'  => 'Hand O Down',
				'value' => 'fa-hand-o-down',
			),
			array(
				'name'  => 'Hand O Left',
				'value' => 'fa-hand-o-left',
			),
			array(
				'name'  => 'Hand O Right',
				'value' => 'fa-hand-o-right',
			),
			array(
				'name'  => 'Hand O Up',
				'value' => 'fa-hand-o-up',
			),
			array(
				'name'  => 'Hdd O',
				'value' => 'fa-hdd-o',
			),
			array(
				'name'  => 'Headphones',
				'value' => 'fa-headphones',
			),
			array(
				'name'  => 'Heart',
				'value' => 'fa-heart',
			),
			array(
				'name'  => 'Heart O',
				'value' => 'fa-heart-o',
			),
			array(
				'name'  => 'Home',
				'value' => 'fa-home',
			),
			array(
				'name'  => 'Hospital O',
				'value' => 'fa-hospital-o',
			),
			array(
				'name'  => 'Html5',
				'value' => 'fa-html5',
			),
			array(
				'name'  => 'Inbox',
				'value' => 'fa-inbox',
			),
			array(
				'name'  => 'Indent',
				'value' => 'fa-indent',
			),
			array(
				'name'  => 'Info',
				'value' => 'fa-info',
			),
			array(
				'name'  => 'Info Circle',
				'value' => 'fa-info-circle',
			),
			array(
				'name'  => 'Inr',
				'value' => 'fa-inr',
			),
			array(
				'name'  => 'Instagram',
				'value' => 'fa-instagram',
			),
			array(
				'name'  => 'Italic',
				'value' => 'fa-italic',
			),
			array(
				'name'  => 'Jpy',
				'value' => 'fa-jpy',
			),
			array(
				'name'  => 'Key',
				'value' => 'fa-key',
			),
			array(
				'name'  => 'Keyboard O',
				'value' => 'fa-keyboard-o',
			),
			array(
				'name'  => 'Krw',
				'value' => 'fa-krw',
			),
			array(
				'name'  => 'Laptop',
				'value' => 'fa-laptop',
			),
			array(
				'name'  => 'Leaf',
				'value' => 'fa-leaf',
			),
			array(
				'name'  => 'Lemon O',
				'value' => 'fa-lemon-o',
			),
			array(
				'name'  => 'Level Down',
				'value' => 'fa-level-down',
			),
			array(
				'name'  => 'Level Up',
				'value' => 'fa-level-up',
			),
			array(
				'name'  => 'Lightbulb O',
				'value' => 'fa-lightbulb-o',
			),
			array(
				'name'  => 'Link',
				'value' => 'fa-link',
			),
			array(
				'name'  => 'Linkedin',
				'value' => 'fa-linkedin',
			),
			array(
				'name'  => 'Linkedin Square',
				'value' => 'fa-linkedin-square',
			),
			array(
				'name'  => 'Linux',
				'value' => 'fa-linux',
			),
			array(
				'name'  => 'List',
				'value' => 'fa-list',
			),
			array(
				'name'  => 'List Alt',
				'value' => 'fa-list-alt',
			),
			array(
				'name'  => 'List Ol',
				'value' => 'fa-list-ol',
			),
			array(
				'name'  => 'List Ul',
				'value' => 'fa-list-ul',
			),
			array(
				'name'  => 'Location Arrow',
				'value' => 'fa-location-arrow',
			),
			array(
				'name'  => 'Lock',
				'value' => 'fa-lock',
			),
			array(
				'name'  => 'Long Arrow Down',
				'value' => 'fa-long-arrow-down',
			),
			array(
				'name'  => 'Long Arrow Left',
				'value' => 'fa-long-arrow-left',
			),
			array(
				'name'  => 'Long Arrow Right',
				'value' => 'fa-long-arrow-right',
			),
			array(
				'name'  => 'Long Arrow Up',
				'value' => 'fa-long-arrow-up',
			),
			array(
				'name'  => 'Magic',
				'value' => 'fa-magic',
			),
			array(
				'name'  => 'Magnet',
				'value' => 'fa-magnet',
			),
			array(
				'name'  => 'Mail Reply All',
				'value' => 'fa-mail-reply-all',
			),
			array(
				'name'  => 'Male',
				'value' => 'fa-male',
			),
			array(
				'name'  => 'Map Marker',
				'value' => 'fa-map-marker',
			),
			array(
				'name'  => 'Maxcdn',
				'value' => 'fa-maxcdn',
			),
			array(
				'name'  => 'Medk',
				'value' => 'fa-medk',
			),
			array(
				'name'  => 'Meh O',
				'value' => 'fa-meh-o',
			),
			array(
				'name'  => 'Microphone',
				'value' => 'fa-microphone',
			),
			array(
				'name'  => 'Microphone Slash',
				'value' => 'fa-microphone-slash',
			),
			array(
				'name'  => 'Minus',
				'value' => 'fa-minus',
			),
			array(
				'name'  => 'Minus Circle',
				'value' => 'fa-minus-circle',
			),
			array(
				'name'  => 'Minus Square',
				'value' => 'fa-minus-square',
			),
			array(
				'name'  => 'Minus Square O',
				'value' => 'fa-minus-square-o',
			),
			array(
				'name'  => 'Mobile',
				'value' => 'fa-mobile',
			),
			array(
				'name'  => 'Money',
				'value' => 'fa-money',
			),
			array(
				'name'  => 'Moon O',
				'value' => 'fa-moon-o',
			),
			array(
				'name'  => 'Music',
				'value' => 'fa-music',
			),
			array(
				'name'  => 'Outdent',
				'value' => 'fa-outdent',
			),
			array(
				'name'  => 'Pagelines',
				'value' => 'fa-pagelines',
			),
			array(
				'name'  => 'Paperclip',
				'value' => 'fa-paperclip',
			),
			array(
				'name'  => 'Pause',
				'value' => 'fa-pause',
			),
			array(
				'name'  => 'Pencil',
				'value' => 'fa-pencil',
			),
			array(
				'name'  => 'Pencil Square',
				'value' => 'fa-pencil-square',
			),
			array(
				'name'  => 'Pencil Square O',
				'value' => 'fa-pencil-square-o',
			),
			array(
				'name'  => 'Phone',
				'value' => 'fa-phone',
			),
			array(
				'name'  => 'Phone Square',
				'value' => 'fa-phone-square',
			),
			array(
				'name'  => 'Picture O',
				'value' => 'fa-picture-o',
			),
			array(
				'name'  => 'Pinterest',
				'value' => 'fa-pinterest',
			),
			array(
				'name'  => 'Pinterest Square',
				'value' => 'fa-pinterest-square',
			),
			array(
				'name'  => 'Plane',
				'value' => 'fa-plane',
			),
			array(
				'name'  => 'Play',
				'value' => 'fa-play',
			),
			array(
				'name'  => 'Play Circle',
				'value' => 'fa-play-circle',
			),
			array(
				'name'  => 'Play Circle O',
				'value' => 'fa-play-circle-o',
			),
			array(
				'name'  => 'Plus',
				'value' => 'fa-plus',
			),
			array(
				'name'  => 'Plus Circle',
				'value' => 'fa-plus-circle',
			),
			array(
				'name'  => 'Plus Square',
				'value' => 'fa-plus-square',
			),
			array(
				'name'  => 'Power Off',
				'value' => 'fa-power-off',
			),
			array(
				'name'  => 'Print',
				'value' => 'fa-print',
			),
			array(
				'name'  => 'Puzzle Piece',
				'value' => 'fa-puzzle-piece',
			),
			array(
				'name'  => 'Qrcode',
				'value' => 'fa-qrcode',
			),
			array(
				'name'  => 'Question',
				'value' => 'fa-question',
			),
			array(
				'name'  => 'Question Circle',
				'value' => 'fa-question-circle',
			),
			array(
				'name'  => 'Quote Left',
				'value' => 'fa-quote-left',
			),
			array(
				'name'  => 'Quote Right',
				'value' => 'fa-quote-right',
			),
			array(
				'name'  => 'Random',
				'value' => 'fa-random',
			),
			array(
				'name'  => 'Refresh',
				'value' => 'fa-refresh',
			),
			array(
				'name'  => 'Renren',
				'value' => 'fa-renren',
			),
			array(
				'name'  => 'Repeat',
				'value' => 'fa-repeat',
			),
			array(
				'name'  => 'Reply',
				'value' => 'fa-reply',
			),
			array(
				'name'  => 'Reply All',
				'value' => 'fa-reply-all',
			),
			array(
				'name'  => 'Retweet',
				'value' => 'fa-retweet',
			),
			array(
				'name'  => 'Road',
				'value' => 'fa-road',
			),
			array(
				'name'  => 'Rocket',
				'value' => 'fa-rocket',
			),
			array(
				'name'  => 'Rss',
				'value' => 'fa-rss',
			),
			array(
				'name'  => 'Rss Square',
				'value' => 'fa-rss-square',
			),
			array(
				'name'  => 'Rub',
				'value' => 'fa-rub',
			),
			array(
				'name'  => 'Scissors',
				'value' => 'fa-scissors',
			),
			array(
				'name'  => 'Search',
				'value' => 'fa-search',
			),
			array(
				'name'  => 'Search Minus',
				'value' => 'fa-search-minus',
			),
			array(
				'name'  => 'Search Plus',
				'value' => 'fa-search-plus',
			),
			array(
				'name'  => 'Share',
				'value' => 'fa-share',
			),
			array(
				'name'  => 'Share Square',
				'value' => 'fa-share-square',
			),
			array(
				'name'  => 'Share Square O',
				'value' => 'fa-share-square-o',
			),
			array(
				'name'  => 'Shield',
				'value' => 'fa-shield',
			),
			array(
				'name'  => 'Shopping Cart',
				'value' => 'fa-shopping-cart',
			),
			array(
				'name'  => 'Sign In',
				'value' => 'fa-sign-in',
			),
			array(
				'name'  => 'Sign Out',
				'value' => 'fa-sign-out',
			),
			array(
				'name'  => 'Signal',
				'value' => 'fa-signal',
			),
			array(
				'name'  => 'Sitemap',
				'value' => 'fa-sitemap',
			),
			array(
				'name'  => 'Skype',
				'value' => 'fa-skype',
			),
			array(
				'name'  => 'Smile O',
				'value' => 'fa-smile-o',
			),
			array(
				'name'  => 'Sort',
				'value' => 'fa-sort',
			),
			array(
				'name'  => 'Sort Alpha Asc',
				'value' => 'fa-sort-alpha-asc',
			),
			array(
				'name'  => 'Sort Alpha Desc',
				'value' => 'fa-sort-alpha-desc',
			),
			array(
				'name'  => 'Sort Amount Asc',
				'value' => 'fa-sort-amount-asc',
			),
			array(
				'name'  => 'Sort Amount Desc',
				'value' => 'fa-sort-amount-desc',
			),
			array(
				'name'  => 'Sort Asc',
				'value' => 'fa-sort-asc',
			),
			array(
				'name'  => 'Sort Desc',
				'value' => 'fa-sort-desc',
			),
			array(
				'name'  => 'Sort Numeric Asc',
				'value' => 'fa-sort-numeric-asc',
			),
			array(
				'name'  => 'Sort Numeric Desc',
				'value' => 'fa-sort-numeric-desc',
			),
			array(
				'name'  => 'Spinner',
				'value' => 'fa-spinner',
			),
			array(
				'name'  => 'Square',
				'value' => 'fa-square',
			),
			array(
				'name'  => 'Square O',
				'value' => 'fa-square-o',
			),
			array(
				'name'  => 'Stack Exchange',
				'value' => 'fa-stack-exchange',
			),
			array(
				'name'  => 'Stack Overflow',
				'value' => 'fa-stack-overflow',
			),
			array(
				'name'  => 'Star',
				'value' => 'fa-star',
			),
			array(
				'name'  => 'Star Half',
				'value' => 'fa-star-half',
			),
			array(
				'name'  => 'Star Half O',
				'value' => 'fa-star-half-o',
			),
			array(
				'name'  => 'Star O',
				'value' => 'fa-star-o',
			),
			array(
				'name'  => 'Step Backward',
				'value' => 'fa-step-backward',
			),
			array(
				'name'  => 'Step Forward',
				'value' => 'fa-step-forward',
			),
			array(
				'name'  => 'Stethoscope',
				'value' => 'fa-stethoscope',
			),
			array(
				'name'  => 'Stop',
				'value' => 'fa-stop',
			),
			array(
				'name'  => 'Strikethrough',
				'value' => 'fa-strikethrough',
			),
			array(
				'name'  => 'Subscript',
				'value' => 'fa-subscript',
			),
			array(
				'name'  => 'Suitcase',
				'value' => 'fa-suitcase',
			),
			array(
				'name'  => 'Sun O',
				'value' => 'fa-sun-o',
			),
			array(
				'name'  => 'Superscript',
				'value' => 'fa-superscript',
			),
			array(
				'name'  => 'Table',
				'value' => 'fa-table',
			),
			array(
				'name'  => 'Tablet',
				'value' => 'fa-tablet',
			),
			array(
				'name'  => 'Tachometer',
				'value' => 'fa-tachometer',
			),
			array(
				'name'  => 'Tag',
				'value' => 'fa-tag',
			),
			array(
				'name'  => 'Tags',
				'value' => 'fa-tags',
			),
			array(
				'name'  => 'Tasks',
				'value' => 'fa-tasks',
			),
			array(
				'name'  => 'Terminal',
				'value' => 'fa-terminal',
			),
			array(
				'name'  => 'Text Height',
				'value' => 'fa-text-height',
			),
			array(
				'name'  => 'Text Width',
				'value' => 'fa-text-width',
			),
			array(
				'name'  => 'Th',
				'value' => 'fa-th',
			),
			array(
				'name'  => 'Th Large',
				'value' => 'fa-th-large',
			),
			array(
				'name'  => 'Th List',
				'value' => 'fa-th-list',
			),
			array(
				'name'  => 'Thumb Tack',
				'value' => 'fa-thumb-tack',
			),
			array(
				'name'  => 'Thumbs Down',
				'value' => 'fa-thumbs-down',
			),
			array(
				'name'  => 'Thumbs O Down',
				'value' => 'fa-thumbs-o-down',
			),
			array(
				'name'  => 'Thumbs O Up',
				'value' => 'fa-thumbs-o-up',
			),
			array(
				'name'  => 'Thumbs Up',
				'value' => 'fa-thumbs-up',
			),
			array(
				'name'  => 'Ticket',
				'value' => 'fa-ticket',
			),
			array(
				'name'  => 'Times',
				'value' => 'fa-times',
			),
			array(
				'name'  => 'Times Circle',
				'value' => 'fa-times-circle',
			),
			array(
				'name'  => 'Times Circle O',
				'value' => 'fa-times-circle-o',
			),
			array(
				'name'  => 'Tint',
				'value' => 'fa-tint',
			),
			array(
				'name'  => 'Trash O',
				'value' => 'fa-trash-o',
			),
			array(
				'name'  => 'Trello',
				'value' => 'fa-trello',
			),
			array(
				'name'  => 'Trophy',
				'value' => 'fa-trophy',
			),
			array(
				'name'  => 'Truck',
				'value' => 'fa-truck',
			),
			array(
				'name'  => 'Try',
				'value' => 'fa-try',
			),
			array(
				'name'  => 'Tumblr',
				'value' => 'fa-tumblr',
			),
			array(
				'name'  => 'Tumblr Square',
				'value' => 'fa-tumblr-square',
			),
			array(
				'name'  => 'Twitter',
				'value' => 'fa-twitter',
			),
			array(
				'name'  => 'Twitter Square',
				'value' => 'fa-twitter-square',
			),
			array(
				'name'  => 'Umbrella',
				'value' => 'fa-umbrella',
			),
			array(
				'name'  => 'Underline',
				'value' => 'fa-underline',
			),
			array(
				'name'  => 'Undo',
				'value' => 'fa-undo',
			),
			array(
				'name'  => 'Unlock',
				'value' => 'fa-unlock',
			),
			array(
				'name'  => 'Unlock Alt',
				'value' => 'fa-unlock-alt',
			),
			array(
				'name'  => 'Upload',
				'value' => 'fa-upload',
			),
			array(
				'name'  => 'Usd',
				'value' => 'fa-usd',
			),
			array(
				'name'  => 'User',
				'value' => 'fa-user',
			),
			array(
				'name'  => 'User Md',
				'value' => 'fa-user-md',
			),
			array(
				'name'  => 'Users',
				'value' => 'fa-users',
			),
			array(
				'name'  => 'Video Camera',
				'value' => 'fa-video-camera',
			),
			array(
				'name'  => 'Vimeo Square',
				'value' => 'fa-vimeo-square',
			),
			array(
				'name'  => 'Vk',
				'value' => 'fa-vk',
			),
			array(
				'name'  => 'Volume Down',
				'value' => 'fa-volume-down',
			),
			array(
				'name'  => 'Volume Off',
				'value' => 'fa-volume-off',
			),
			array(
				'name'  => 'Volume Up',
				'value' => 'fa-volume-up',
			),
			array(
				'name'  => 'Weibo',
				'value' => 'fa-weibo',
			),
			array(
				'name'  => 'Wheelchair',
				'value' => 'fa-wheelchair',
			),
			array(
				'name'  => 'Windows',
				'value' => 'fa-windows',
			),
			array(
				'name'  => 'Wrench',
				'value' => 'fa-wrench',
			),
			array(
				'name'  => 'Xing',
				'value' => 'fa-xing',
			),
			array(
				'name'  => 'Xing Square',
				'value' => 'fa-xing-square',
			),
			array(
				'name'  => 'YouTube',
				'value' => 'fa-youtube',
			),
			array(
				'name'  => 'YouTube Play',
				'value' => 'fa-youtube-play',
			),
			array(
				'name'  => 'YouTube Square',
				'value' => 'fa-youtube-square',
			),
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

	function generate_post_select( $select_id, $post_type, $selected = 0 ) {
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
		$instance     = wp_parse_args( (array) $instance, $this->defaults );
		$title        = strip_tags($instance['title']);
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