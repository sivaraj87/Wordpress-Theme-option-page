<?php
/* ---------------------------------------------------------------------------------------------------
  
    File: wps-panel-options.php
  
    Here we will set the options we are going to have in the theme options panel.
  
--------------------------------------------------------------------------------------------------- */
  
/* ---------------------------------------------------------------------------------------------------
    Declare vars
--------------------------------------------------------------------------------------------------- */
  
$shortname = 'wps';
$options = array();
  
/* ---------------------------------------------------------------------------------------------------
    First Section
--------------------------------------------------------------------------------------------------- */
 /* Get Categories into a drop-down list */
$categories_list = get_categories('hide_empty=0&orderby=name');
$getcat = array();
foreach($categories_list as $acategory) {
	$getcat[$acategory->cat_ID] = $acategory->cat_name;
}
$category_dropdown = array_unshift($getcat, "اختر التصنيف:");

/* Get Pages into a drop-down list */
$pages_list = get_pages();
$getpag = array();
foreach($pages_list as $apage) {
	$getpag[$apage->ID] = $apage->post_title;
}
$page_dropdown = array_unshift($getpag, "اختر صفحة:");
/* open the style dir and listing the files in it into an array ....this is a php code and free of wordpress code */
$styles = array();
if(is_dir(TEMPLATEPATH . "/styles/")) {
	if($open_dirs = opendir(TEMPLATEPATH . "/styles/")) {
		while(($style = readdir($open_dirs)) !== false) {
			if(stristr($style, ".css") !== false) {
				$styles[] = $style;
			}
		}
	}
}
$style_dropdown = array_unshift($styles, "اختر تنسيق:");

 
$options[] = array( 'title' => 'عام',
                    'type'  => 'open',
                    'desc'  => 'في هذا القسم ستجد الإعدادات الرئيسية للقالب');
  

					
$options[] = array(	"title" => "تنسيق القالب",
						"desc" => "أي لون تفضل استخدامه؟",
						"id" => $shortname."_colourscheme",
						"type" => "select",
						"std" => "اختر تنسيق أو لون معين:",
						"opts" => $styles);
											
$options[] = 	array(	"title" => "تصنيف معرض الأعمال",
						"desc" => "اختر التصنيف الذي ستعتمده ليكن التصنيف الرئيسي للمعرض لديك",
						"id" => $shortname."_portfolio_cat",
						"type" => "select",
						"std" => "اختر تصنيف:",
						"opts" => $getcat);
					
$options[] =    array(	"title" => "صفحة التدوينات",
						"desc" => "اختر الصفحة التي ستظهر فيها التدوينات.",
						"id" => $shortname."_blogpage",
						"type" => "select",
						"std" => "اختر صفحة",
						"opts" => $getpag);
				  
$options[] = array( 'type'  => 'close' );
  
/* ---------------------------------------------------------------------------------------------------
    Second Section
--------------------------------------------------------------------------------------------------- */
  
$options[] = array( 'title' => 'الروابط الاجتماعية',
                    'type'  => 'open',
                    'desc'  => 'هنا يمكنك أن تدخل جميع الروابط لحساباتك الاجتماعية');
  
$options[] = array( 'title' => 'google plus',
                    'desc'  => 'أدخل رابط حساب google plus',
                    'id'    => $shortname.'_google',
                    'std'   => 'http://www.google.com',
                    'type'  => 'text' );
					
$options[] = array( 'title' => 'twitter',
                    'desc'  => 'أدخل رابط حساب تويتر',
                    'id'    => $shortname.'_twitter',
                    'std'   => 'http://www.twitter.com/manmhd',
                    'type'  => 'text' );

$options[] = array( 'title' => 'facebook',
                    'desc'  => 'أدخل رابط حساب facebook',
                    'id'    => $shortname.'_facebook',
                    'std'   => 'http://www.facebook.com/web0design',
                    'type'  => 'text' );

  
$options[] = array( 'type'  => 'close' );

/*------------------------------------------------------------------------------
 * 									third section
 ------------------------------------------------------------------------------*/
 $options[] = array( 'title' => 'إضافية',
                    'type'  => 'open',
                    'desc'  => 'ستجد هنا بعض الأمور الإضافية و بكن الهامة');
$options[] = array( 'title' => 'Text Field',
                    'desc'  => 'Here goes the description for this field.',
                    'id'    => $shortname.'_text_field_2',
                    'std'   => 'default value',
                    'type'  => 'text' );
  
$options[] = array( 'title' => 'كود إحصائيات الموقع',
                    'desc'  => 'أضف كود Google Analytics أو كود أي موقع تتبع آخر',
                    'id'    => $shortname.'_Analytics',
                    'std'   => '',
                    'type'  => 'textarea' );
  
$options[] = array( 'title' => 'Select Field',
                    'desc'  => 'Here goes the description for this field.',
                    'id'    => $shortname.'_select_field',
                    'opts'  => array( 'Option Title 1' => 'option_value_1', 'Option Title 2' => 'option_value_2' ),
                    'std'   => 'option_value_1',
                    'type'  => 'select' );
  
$options[] = array( 'title' => 'Radio Field',
                    'desc'  => 'Here goes the description for this field.',
                    'id'    => $shortname.'_radio_field-2',
                    'opts'  => array( 'Option Title 1' => 'option_value_1', 'Option Title 2' => 'option_value_2' ),
                    'std'   => 'option_value_1',
                    'type'  => 'radio' );
  
$options[] = array( 'title' => 'Checkbox Field',
                    'desc'  => 'Here goes the description for this field.',
                    'id'    => $shortname.'_radio_field',
                    'std'   => '',
                    'type'  => 'checkbox' );

$options[] = array( 'title' => 'color picker',
                    'desc'  => 'Here goes the description for this field.',
                    'id'    => $shortname.'_color',
                    'std'   => '',
                    'type'  => 'color' );

$options[] = array( 'title' => 'upload your logo',
                    'desc'  => 'Here goes the description for this field.',
                    'id'    => $shortname.'_upload',
                    'std'   => '',
                    'type'  => 'upload' );
					
$options[] = array( 'title' => 'custom favicon',
                    'desc'  => 'Here goes the description for this field.',
                    'id'    => $shortname.'_fav',
                    'std'   => '',
                    'type'  => 'upload' );
				
$options[] = array( 'type'  => 'close' );
?>