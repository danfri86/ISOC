<?php
require_once('meta-boxar/my-meta-box-class.php');

if (is_admin()){
    /* 
     * prefix of meta keys, optional
     * use underscore (_) at the beginning to make keys hidden, for example $prefix = '_ba_';
     *  you also can make prefix empty to disable it
     * 
     */
    // Meta box för bilagor i inlägg och sidor
    $prefix = 'bilaga_';
    
    /* 
     * configure your meta box
     */
    $config = array(
        'id' => 'bilagor_meta_box',                    // meta box id, unique per meta box
        'title' => 'Bilagor',                 // meta box title
        'pages' => array('post', 'page'),           // post types, accept custom post types as well, default is array('post'); optional
        'context' => 'normal',                      // where the meta box appear: normal (default), advanced, side; optional
        'priority' => 'high',                       // order of meta box: high (default), low; optional
        'fields' => array(),                        // list of meta fields (can be added by field arrays)
        'local_images' => false,                        // Use local or hosted images (meta box images for add/remove)
        'use_with_theme' => get_stylesheet_directory_uri() .'/cpt-metaboxes/meta-boxar'                    //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
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






    // Meta box för medlemmar
    $prefix = 'medlem_';
    
    /* 
     * configure your meta box
     */
    $config = array(
        'id' => 'medlemmar_meta_box',                    // meta box id, unique per meta box
        'title' => 'Medlem',                 // meta box title
        'pages' => array('medlemmar'),           // post types, accept custom post types as well, default is array('post'); optional
        'context' => 'normal',                      // where the meta box appear: normal (default), advanced, side; optional
        'priority' => 'high',                       // order of meta box: high (default), low; optional
        'fields' => array(),                        // list of meta fields (can be added by field arrays)
        'local_images' => false,                        // Use local or hosted images (meta box images for add/remove)
        'use_with_theme' => get_stylesheet_directory_uri() .'/cpt-metaboxes/meta-boxar'                    //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
    );

    /*
     * Initiate your meta box
     */
    $medlem_meta =  new AT_Meta_Box($config);

    $medlem_meta->addText($prefix.'adress',array('name'=> 'Adress'));
    $medlem_meta->addText($prefix.'postnummer',array('name'=> 'Postnummer'));
    $medlem_meta->addText($prefix.'ort',array('name'=> 'Ort'));
    $medlem_meta->addText($prefix.'email',array('name'=> 'Epost'));
    $medlem_meta->addTextarea($prefix.'meddelande',array('name'=> 'Meddelande '));

    $medlem_meta->addRadio($prefix.'medlemstyp',array('Fullbetalande'=>'Fullbetalande','Studerande'=>'Studerande', 'Pensionär'=>'Pensionär'),array('name'=> 'Medlemstyp'));

    $medlem_meta->addCheckbox($prefix.'foretag-betalar',array('name'=> 'Företag/Organisation betalar'));

    $medlem_meta->addParagraph($prefix.'link_info',array('value'=> 'Information om företag'));
    $medlem_meta->addText($prefix.'foretag-namn',array('name'=> 'Namn'));
    $medlem_meta->addText($prefix.'foretag-adress',array('name'=> 'Adress'));
    $medlem_meta->addText($prefix.'foretag-postnummer',array('name'=> 'Postnummer'));
    $medlem_meta->addText($prefix.'foretag-ort',array('name'=> 'Ort'));









    // Meta box för styrelse
    $prefix = 'styrelse_';
    
    /* 
     * configure your meta box
     */
    $config = array(
        'id' => 'styrelse_meta_box',                    // meta box id, unique per meta box
        'title' => 'Styrelsemedlem',                 // meta box title
        'pages' => array('styrelse'),           // post types, accept custom post types as well, default is array('post'); optional
        'context' => 'normal',                      // where the meta box appear: normal (default), advanced, side; optional
        'priority' => 'high',                       // order of meta box: high (default), low; optional
        'fields' => array(),                        // list of meta fields (can be added by field arrays)
        'local_images' => false,                        // Use local or hosted images (meta box images for add/remove)
        'use_with_theme' => get_stylesheet_directory_uri() .'/cpt-metaboxes/meta-boxar'                    //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
    );

    /*
     * Initiate your meta box
     */
    $styrelse_meta =  new AT_Meta_Box($config);

    $styrelse_meta->addText($prefix.'roll',array('name'=> 'Roll'));
    $styrelse_meta->addImage($prefix.'bild',array('name'=> 'Bild '));

    //Finish Meta Box Declaration 
    $styrelse_meta->Finish();
}