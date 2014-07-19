<?php

require_once('admin-page-class.php');

/*
Hämta data såhär i temafilerna:

// Hämta alla data till en array. Behöver bara göras en gång (i varje temafil?)
$data = get_option('isoc_options');

// Hämta varje fält med fältets id
echo $data['text_field_id'];

/**
 * configure your admin page
 */
$config = array(    
  'menu' 					 => array('top' => 'installningar'),
  //'menu'           => 'settings',             //sub page to settings page
  'page_title'     => __('Inställningar','apc'),       //The name of this page 
  'capability'     => 'edit_themes',         // The capability needed to view the page 
  'option_group'   => 'isoc_options',       //the name of the option to create in the database
  'id'             => 'isoc_options_page',            // meta box id, unique per page
  'fields'         => array(),            // list of fields (can be added by field arrays)
  'local_images'   => false,          // Use local or hosted images (meta box images for add/remove)
  'use_with_theme' => get_stylesheet_directory_uri() .'/theme-options'          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
);  

/**
 * instantiate your admin page
 */
$isoc_options = new BF_Admin_Page_Class($config);
$isoc_options->OpenTabs_container('');

/**
 * define your admin page tabs listing
 */
$isoc_options->TabsListing(array(
  'links' => array(
    'options_framsida' => 'Framsidan',
  )
));

/**
 * Open admin page first tab
 */
$isoc_options->OpenTab('options_framsida');

/**
 * Add fields to your admin page first tab
 * 
 * Simple options:
 * input text, checbox, select, radio 
 * textarea
 */
//title
$isoc_options->Title(__("Val som rör framsidan","apc"));
//An optionl descrption paragraph

//textarea field
$isoc_options->addTextarea('framsida_info',array('name'=> 'Vad är ISOC-SE?', 'std'=> '', 'desc' => ''));

$isoc_options->addParagraph('Banner');
$isoc_options->addText('banner_rubrik', array('name' => 'Rubrik', 'std' => '', 'desc' => ''));
$isoc_options->addTextarea('banner_text',array('name'=> 'Text', 'std'=> '', 'desc' => 'Denna text visas också under "Bli medlem" på framsidan.'));

/**
 * Close first tab
 */   
$isoc_options->CloseTab();

?>