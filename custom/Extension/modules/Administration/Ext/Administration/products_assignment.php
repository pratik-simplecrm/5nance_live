<?php

    $admin_option_defs = array();
    $admin_option_defs['Administration']['products_assignment'] = array(
        //Icon name. Available icons are located in ./themes/default/images
        'Administration',
        
        //Link name label 
        'LBL_PRODUCT_ASSIGNMENT_LINK_NAME',
        
        //Link description label
        'LBL_PRODUCT_ASSIGNMENT_LINK_DESCRIPTION',
        
        //Link URL
        './index.php?module=Administration&action=assignedproductstousers',
    );

    $admin_group_header[] = array(
        //Section header label
        'LBL_PRODUCT_ASSIGNMENT_SECTION_HEADER',
        
        //$other_text parameter for get_form_header()
        '',
        
        //$show_help parameter for get_form_header()
        false,
        
        //Section links
        $admin_option_defs, 
        
        //Section description label
        'LBL_PRODUCT_ASSIGNMENT_SECTION_DESCRIPTION'
    );
    ?>
