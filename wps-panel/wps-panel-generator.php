<?php
/* ---------------------------------------------------------------------------------------------------
  
    File: wps-panel-generator.php
  
--------------------------------------------------------------------------------------------------- */
 
foreach($options as $option){
  
    /* Get the value of the field (nothing for types open and close). */
    if($option['type'] != 'open' && $option['type'] != 'close'){
  
        /* Variable that will hold the value of this option */
        $real_value = '';
  
        /* Get default value */
        $default_value = $option['std'];
  
        /* Get the value if user has set it */
        $user_defined_value = get_option($option['id']);
  
        /* Set the $real_value */
        if($user_defined_value == '') { $real_value = $default_value; }else{ $real_value = $user_defined_value; }
  
    }/* end if */
    /* Populate $sidebar_html and $content_html according to the option type */
    switch ($option['type']) {
  
        /* open: Opens a new section */
        case 'open':
  
            /* Generate the id which will be used as the id of the section (for the tabs system purposes) */
            $tab_id = str_replace(' ', '-', strtolower($option['title']));
  
            /* Add the new link in the sidebar for this section */
            $sidebar_html .= '<li><a href="#wps-panel-'.$tab_id.'">'.$option['title'].'</a></li>';
  
            /* Open the new section */
            $fields_html .= '<div class="wps-panel-section" id="wps-panel-'.$tab_id.'">';
  
        break;
  
        /* close: Closes the current section */
        case 'close':
  
            /* Close the current section */
            $fields_html .= '</div><!-- .wps-panel-section -->';
  
        break;
  
        /* text: Simple textual input field */
        case 'text':
  
            /* Field container open */
            $fields_html .= '<div class="wps-panel-field">';
  
                /* Label */
                $fields_html .= '<label class="label"  for="'.$option['id'].'">'.$option['title'].'</label>';
  					$fields_html .='<div class="open"> ';
                /* Description */
                if(isset($option['desc'])){
                    $fields_html .= '<div class="wps-panel-description">';
                        $fields_html .= $option['desc'];
                    $fields_html .= '</div><!-- .jw-field-description -->';
                }       
  
                /* The Field */
                $fields_html .= '<input type="text" name="'.$option['id'].'" id="'.$option['id'].'" value="'.$real_value.'" />';
  				$fields_html .='</div>';
            /* Field container close */
            $fields_html .= '</div><!-- .wps-panel-field -->';
  
        break;
  
        /* textarea: Text area field */
        case 'textarea':
  
            /* Field container open */
            $fields_html .= '<div class="wps-panel-field">';
  			
                /* Label */
                $fields_html .= '<label class="label" for="'.$option['id'].'">'.$option['title'].'</label>';
  				$fields_html .='<div class="open">';
                /* Description */
                if(isset($option['desc'])){
                    $fields_html .= '<div class="wps-panel-description">';
                        $fields_html .= $option['desc'];
                    $fields_html .= '</div><!-- .jw-field-description -->';
                }       
  
                /* The Field */
                $fields_html .= '<textarea name="'.$option['id'].'" id="'.$option['id'].'">'.$real_value.'</textarea>';
  				$fields_html .='</div>';
            /* Field container close */
            $fields_html .= '</div><!-- .wps-panel-field -->';
  
        break;
  
        /* select: Select field */
        case 'select':
  
            /* Field container open */
            $fields_html .= '<div class="wps-panel-field">';
  
                /* Label */
                $fields_html .= '<label class="label" for="'.$option['id'].'">'.$option['title'].'</label>';
  				$fields_html .='<div class="open">';
                /* Description */
                if(isset($option['desc'])){
                    $fields_html .= '<div class="wps-panel-description">';
                        $fields_html .= $option['desc'];
                    $fields_html .= '</div><!-- .jw-field-description -->';
                }       
  
                /* The Field */
                $fields_html .= '<select name="'.$option['id'].'" id="'.$option['id'].'">';
  
                    /* Loop options */
                    foreach($option['opts'] as $key => $value){
  
                        /* Which options should be selected */
                        if($value == $real_value){
                            $active_attr = 'selected';
                        }else{
                            $active_attr = '';
                        }
  
                        /* Option */
                        $fields_html .= '<option value="'.$value.'" '.$active_attr.'>'.$value.'</option>';
  
                    }
  
                $fields_html .= '</select>';
  				$fields_html .='</div>';
            /* Field container close */
            $fields_html .= '</div><!-- .wps-panel-field -->';
  
        break;
  
        /* radio: radio field */
        case 'radio':
  
            /* Field container open */
            $fields_html .= '<div class="wps-panel-field">';
  
                /* Label */
                $fields_html .= '<label class="label"  for="'.$option['id'].'">'.$option['title'].'</label>';
  				$fields_html .='<div class="open">';
                /* Description */
                if(isset($option['desc'])){
                    $fields_html .= '<div class="wps-panel-description">';
                        $fields_html .= $option['desc'];
                    $fields_html .= '</div><!-- .jw-field-description -->';
                }       
  
                /* The Field */
                foreach($option['opts'] as $key => $value){
  
                    /* Which options should be selected */
                    if($value == $real_value){
                        $active_attr = 'checked';
                    }else{
                        $active_attr = '';
                    }
  
                    /* Field */
                    $fields_html .= '<p><input type="radio" name="'.$option['id'].'" value="'.$value.'" '.$active_attr.'>'.$key.'</p>';
  
                }
  			$fields_html .='</div>';
            /* Field container close */
            $fields_html .= '</div><!-- .wps-panel-field -->';
  
        break;
  
        /* checkbox: checkbox field */
        case 'checkbox':
  
            /* Field container open */
            $fields_html .= '<div class="wps-panel-field">';
  
                /* Label */
                $fields_html .= '<label class="label" for="'.$option['id'].'">'.$option['title'].'</label>';
  				$fields_html .='<div class="open">';
                /* Description */
                if(isset($option['desc'])){
                    $fields_html .= '<div class="wps-panel-description">';
                        $fields_html .= $option['desc'];
                    $fields_html .= '</div><!-- .jw-field-description -->';
                }       
  
                /* The Field */
                if($value == $real_value){
                    $active_attr = 'checked';
                }else{
                    $active_attr = '';
                }
  
                /* Field */
                
  				$fields_html .='<div class="onoffswitch">
								    <input type="checkbox" name="'.$option['id'].'" class="onoffswitch-checkbox" id="'.$option['id'].'" value="'.$value.'"  '.$active_attr.'>
								    <label class="onoffswitch-label" for="'.$option['id'].'">
								        <div class="onoffswitch-inner">
								            <div class="onoffswitch-active">ON</div>
								            <div class="onoffswitch-inactive">OFF</div>
								        </div>
								        <div class="onoffswitch-switch"></div>
								    </label>
								</div>';
				$fields_html .='</div>';				
            /* Field container close */
            $fields_html .= '</div><!-- .wps-panel-field -->';
  
        break;
		
		case 'color':
  
            /* Field container open */
            $fields_html .= '<div class="wps-panel-field">';
  
                /* Label */
                $fields_html .= '<label class="label" for="'.$option['id'].'">'.$option['title'].'</label>';
  				$fields_html .='<div class="open">';
                /* Description */
                if(isset($option['desc'])){
                    $fields_html .= '<div class="wps-panel-description">';
                        $fields_html .= $option['desc'];
                    $fields_html .= '</div><!-- .jw-field-description -->';
                }       
  
               
                
  
                /* Field */
                
  				$fields_html .='<input type="text" name="'.$option['id'].'" value="'.$real_value.'" class="color" />';			
          	$fields_html .='</div>';
		    /* Field container close */
            $fields_html .= '</div><!-- .wps-panel-field -->';
  
        break;
		case 'upload':
  
            /* Field container open */
            $fields_html .= '<div class="wps-panel-field">';
  
                /* Label */
                $fields_html .= '<label class="label" for="'.$option['id'].'">'.$option['title'].'</label>';
  				$fields_html .='<div class="open">';
                /* Description */
                if(isset($option['desc'])){
                    $fields_html .= '<div class="wps-panel-description">';
                        $fields_html .= $option['desc'];
                    $fields_html .= '</div><!-- .jw-field-description -->';
                }       
  
               
                
  
                /* Field */
                 echo "<img src='.$img.' />";
  				$fields_html .='<input type="file" name="'.$option['id'].'" size="40" />';	
				$fields_html.='<p>image perview</p><img src="'.get_option($option['id']).'" />'		;
            
			 $fields_html .='</div>'; 
			 /* Field container close */
            $fields_html .= '</div><!-- .wps-panel-field -->';
  
        break;
  
    }/* end switch */
  
}/* end foreach */
	