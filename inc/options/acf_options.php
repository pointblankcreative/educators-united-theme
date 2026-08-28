<?php

//Options are used to add global options to pages IE: The Contact Form
if( function_exists("acf_add_options_page") ) {

	acf_add_options_page(array(
		"page_title" 	=> "Misc Site Settings",
		"menu_title"	=> "Misc Site Settings",
		"menu_slug" 	=> "misc-site-settings",
		"capability"    => "edit_posts",
		"redirect"		=> true,
		"icon_url" => "dashicons-edit",
	));

		acf_add_options_sub_page(array(
			"page_title" 	=> "Socials",
			"menu_title"	=> "Socials",
			"parent_slug"	=> "misc-site-settings",
		));

		acf_add_options_sub_page(array(
			"page_title" 	=> "Language Toggler",
			"menu_title"	=> "Language Toggler",
			"parent_slug"	=> "misc-site-settings",
		));

		acf_add_options_sub_page(array(
			"page_title" 	=> "Footer Controls",
			"menu_title"	=> "Footer Controls",
			"parent_slug"	=> "misc-site-settings",
		));
	
		acf_add_options_sub_page(array(
			"page_title" 	=> "Header Footer Scripts",
			"menu_title"	=> "Header Footer Scripts",
			"parent_slug"	=> "misc-site-settings",
		));	

		acf_add_options_sub_page(array(
			"page_title" 	=> "404 Redirect Page",
			"menu_title"	=> "404 Redirect Page",
			"parent_slug"	=> "misc-site-settings",
		));	
		
}