<?php
/*
Plugin Name: Skysa RSS Reader App
Plugin URI: http://wordpress.org/extend/plugins/skysa-rss-reader-app
Description: Display summary information from an RSS feed in and app window.
Version: 1.4
Author: Skysa
Author URI: http://www.skysa.com
*/

/*
*************************************************************
*                 This app was made using the:              *
*                       Skysa App SDK                       *
*    http://wordpress.org/extend/plugins/skysa-app-sdk/     *
*************************************************************
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
MA  02110-1301, USA.
*/

// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) exit;

// Skysa App plugins require the skysa-req subdirectory,
// and the index file in that directory to be included.
// Here is where we make sure it is included in the project.
include_once dirname( __FILE__ ) . '/skysa-required/index.php';


// RSS Reader APP
$GLOBALS['SkysaApps']->RegisterApp(array( 
    'id' => '50240601a0170',
    'label' => 'RSS Reader',
	'options' => array(
		'bar_label' => array( // key is the field name
            'label' => 'Button Label',
			'info' => 'What would you like the bar link label name to be?',
			'type' => 'text',
			'value' => 'RSS Feed',
			'size' => '30|1'
		),
        'icon' => array(
            'label' => 'Button Icon URL',
            'info' => 'Enter a URL for the an Icon Image. (You can leave this blank for none)',
			'type' => 'image',
			'value' => plugins_url( '/icons/rss-icon.png', __FILE__ ),
			'size' => '50|1'
        ),
        'title' => array(
            'label' => 'App Title',
            'info' => 'What would you like to set as the title for the app window?',
			'type' => 'text',
			'value' => 'My RSS Feed',
			'size' => '30|1'
        ),
        'option4' => array(
            'label' => 'RSS Feed URL',
            'info' => 'What is the full URL of the Feed?',
			'type' => 'text',
			'value' => '',
			'size' => '40|1'
        ),
        'option3' => array(
            'label' => 'Number of Items to Display',
            'info' => 'How many entries from the RSS feed do you want to display in the app window?',
			'type' => 'selectbox',
			'value' => '3|4|5|6|8|10',
			'size' => '10|1'
        ),
        'option2' => array(
            'label' => 'Preview Length',
            'info' => 'How many words do you want display for the RSS item previews? (set this to zero to just show the title)',
			'type' => 'selectbox',
			'value' => '0|10|20|50|100',
			'size' => '10|1'
        ),
        'option1' => array(
            'label' => 'Source Linking',
            'info' => 'Would you like to link to article sources?',
			'type' => 'selectbox',
			'value' => 'No|Yes, In a New Window|Yes, In the Same Window',
			'size' => '30|1'
        )
	),
    'window' => array(
        'width' => '350',
        'height' => '300',
        'position' => 'Page Center'
    ),
    'views' => array( // Each view can be an html string or a function which returns an html string. Link to other views using href="#view=view&queryparams"
        'main' => '<div class="SKYUI-feed" url="$app_option4" num="$app_option3" words="$app_option2" linking="$app_option1"><div style="text-align:center;"><img src="'.plugins_url( '/assets/Skysa-Loading.gif', __FILE__ ).'" style="width: 84px; height: 18px; margin: 50px auto;" /></div></div>'
    ), 
    'html' => '<div id="$button_id" class="bar-button" apptitle="$app_title" w="$app_width" h="$app_height" bar="$app_position">$app_icon<span class="label">$app_bar_label</span></div>',
    'js' => "
        S.on('click',function(){S.open('window','main','util.RSSFeed.draw')});
        S.require('js',S.domain+'/js/modjs/dev-rss-dev.js');
        S.require('css',S.domain+'/css/apps/rss.css');
     "
));
?>