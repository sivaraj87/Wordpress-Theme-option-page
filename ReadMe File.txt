/********this software Developed by Mhd0man (Mhd Manssour) http://pyw.cu.cc

*To include this option-page in wordpress copy the following code and paste it in FUNCTIONS.PHP file:

if(is_admin()){ include TEMPLATEPATH.'/wps-panel/wps-panel.php'; }
 
/* Include front-end */
if(!is_admin()){ include TEMPLATEPATH.'/wps-panel/wps-panel-front.php'; }


/*************************************************************************/
to creat a new section (Tab) in /wps-panel-options.php/ write the following code:
 $options[] = array( 'title' => 'tab name',
                    'type'  => 'open',
                    'desc'  => 'a short desc');

// fields HERE


$options[] = array( 'type'  => 'close' );

/*************************************************************************/
to creat a new option field you must write the following code in /wps-panel-options.php/:
$options[] = array( 'title' => 'The Field title goes here',
                    'desc'  => 'Here goes the description for this field.',
                    'id'    => $shortname.'_upload',
                    'std'   => '',
                    'type'  => 'field_type' );
/**************************************************************************/
Actual Front-end Usage:
<?php
	
	/* Get the options */
	$options = wps_panel_get_options();
	
	/* Actual usage when you need the value */
	echo $options['field_id'];
	
?>
/**************************************************************************/
and last excuse my English
