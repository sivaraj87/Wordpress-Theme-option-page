<?php 
/* ---------------------------------------------------------------------------------------------------
     
    File: wps-panel.php
     
--------------------------------------------------------------------------------------------------- */
 
 
/* ---------------------------------------------------------------------------------------------------
    Javascript
--------------------------------------------------------------------------------------------------- */
add_action('admin_print_scripts', 'wps_panel_include_js');
function wps_panel_include_js(){
     
    /* Register scripts */
    wp_register_script('wps_panel_js', get_template_directory_uri().'/wps-panel/js/wps-panel-js.js', false);
    wp_register_script('jscolor_js',  get_template_directory_uri().'/wps-panel/js/jscolor.js'); //color picker for '#' value fields
    /* Enqueue scripts */
    wp_enqueue_script('wps_panel_js');
    wp_enqueue_script('jscolor_js');
	//Media Uploader Scripts

	
}/* wps_panel_include_js() */
 
 
/* ---------------------------------------------------------------------------------------------------
    CSS
--------------------------------------------------------------------------------------------------- */
add_action('admin_print_styles', 'wps_panel_include_styles');
function wps_panel_include_styles(){
 
    /* Register styles */
    wp_register_style('wps_panel_style', get_template_directory_uri().'/wps-panel/css/wps-panel-style.css', false);
    /* Enqueue styles */
    wp_enqueue_style('wps_panel_style');    
 
}/* wps_panel_include_styles() */
 
 
/* ---------------------------------------------------------------------------------------------------
    INIT wpsPanel
--------------------------------------------------------------------------------------------------- */
add_action('admin_menu', 'wps_panel_init');
function wps_panel_init(){
     
    /* Include the options */
    include TEMPLATEPATH.'/wps-panel/wps-panel-options.php';
      
    /* Save & Reset */
    if (isset($_GET['page']) && $_GET['page'] == basename(__FILE__)) {
         
        /* Save */
        if (isset($_REQUEST['action']) && 'save' == $_REQUEST['action']){
             
            /* Loop the options, cross reference the current and the submitted values, and save if they're different */
            foreach ($options as $option){
                 
                if($option['type'] != 'open' && $option['type'] != 'close'){             
                    if( $option['type'] == 'upload' )					
						{
							$overrides = array( 'test_form' => false);
							$upload = wp_handle_upload( $_FILES[ $option['id'] ], $overrides );					
							if( isset( $upload['url'] ) )					
							{
								if(preg_match('/(jpg|jpeg|png|gif|ico)$/', $upload['type'])){						
								update_option( $option['id'], $upload['url'] );	
								}
								
								else{
									echo"please enter an image";
								}				
							}							
						}					
					    elseif( isset( $_REQUEST[ $option['id'] ] ) )					
						{
					     if(!is_array($_REQUEST[$option['id']])){ $the_value = stripslashes($_REQUEST[$option['id']]); }else{ $the_value = serialize($_REQUEST[$option['id']]); }
						update_option( $option['id'], $the_value  );					
						}
						else{ delete_option($option['id']); } 				                   
                }                 
            }
             
            /* Redirect to the theme options page */
            header('Location: admin.php?page=wps-panel.php&saved=true');
             
            /* Chuck Norris */
            die;
          
        /* Reset */
        }else if(isset($_REQUEST['action']) && 'reset' == $_REQUEST['action']) {
             
            /* Loop the options and delete them (setting the default values will happen on next page load) */
            foreach ($options as $option) {
                delete_option($option['id']); 
            }
             
            /* Redirect to the theme options page */
            header("Location: admin.php?page=wps-panel.php&reset=true");
             
            /* Steven Seagal */
            die;
          
        }
    }
     
    /* Add the page */
    add_menu_page('PYW Panel', 'PYW Panel', 'edit_themes', basename(__FILE__), 'wps_panel_output', false, 30);
     
}/* wps_panel_init() */
/* ---------------------------------------------------------------------------------------------------
    wpsPanel HTML OUTPUT
--------------------------------------------------------------------------------------------------- */
function wps_panel_output(){
     
    /* Important: This function will be used to output the HTML of the WPS Panel page in the admin */
        
    /* Declare some vars */
    $sidebar_html = '';
    $fields_html = '';
  
    /* Include the options from wps-panel-options.php */
    include TEMPLATEPATH.'/wps-panel/wps-panel-options.php';
  
    /* Go through all the options to populate the 2 vars we declared above */
    include TEMPLATEPATH.'/wps-panel/wps-panel-generator.php';
     
    ?>
     
    <!-- Form to reset options to default values -->
<form method="post" enctype="multipart/form-data">
    <input type="hidden" name="action" value="reset" />
    <p>
        هل تريد <input type="submit" class="button-secondary" value="اسرجاع الإعدادت الافتراضية" /> ؟
    </p>
</form>
 
<!-- Form with all the options -->
<form method="post" enctype="multipart/form-data">
 
    <div id="wps-panel">
         
        <div id="wps-panel-sidebar">
        	
            <img src="<?php bloginfo('template_directory'); ?>/wps-panel/images/logo.jpg" />
            <ul>
                 
                <?php echo $sidebar_html; ?>
                 
            </ul>
             
        </div><!-- #wps-panel-sidebar -->
         
        <div id="wps-panel-content">
             
            <?php echo $fields_html; ?>
             
            <div id="wps-panel-actions">
                 
                <input type="hidden" name="action" value="save" />
                <input type="submit" class="button-primary" value="حفظ الإعدادات" />
                 
            </div><!-- #wps-panel-actions -->
             
        </div><!-- #wps-panel-content -->
         
    </div><!-- #wps_panel -->
     
</form>
 	
    <?php
  
}/* wps_panel_output() */

?>