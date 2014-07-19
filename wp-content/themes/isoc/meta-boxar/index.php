<?php
require_once('my-meta-box-class.php');

if (is_admin()){
    /* 
     * prefix of meta keys, optional
     * use underscore (_) at the beginning to make keys hidden, for example $prefix = '_ba_';
     *  you also can make prefix empty to disable it
     * 
     */
    // Meta box för puffar på startsidan
    $prefix = 'bilaga_';
    
    /* 
     * configure your meta box
     */
    $config = array(
        'id' => 'bilagor_meta_box',                    // meta box id, unique per meta box
        'title' => 'Bilagor',                 // meta box title
        'pages' => array('post'),           // post types, accept custom post types as well, default is array('post'); optional
        'context' => 'normal',                      // where the meta box appear: normal (default), advanced, side; optional
        'priority' => 'high',                       // order of meta box: high (default), low; optional
        'fields' => array(),                        // list of meta fields (can be added by field arrays)
        'local_images' => false,                        // Use local or hosted images (meta box images for add/remove)
        'use_with_theme' => get_stylesheet_directory_uri() .'/meta-boxar'                    //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
    );

    /*
     * Initiate your meta box
     */
    $bilaga_meta =  new AT_Meta_Box($config);

    //Add fields to your meta box
    $bilagor[] = $bilaga_meta->addFile($prefix.'fil',array('name'=> 'Bilaga'), true);

    //repeater block
    $bilaga_meta->addRepeaterBlock($prefix.'re_',array(
        'inline'   => true, 
        'name'     => 'Bilagor',
        'fields'   => $bilagor, 
        'sortable' => true
    ));

    //Finish Meta Box Declaration 
    $bilaga_meta->Finish();
}