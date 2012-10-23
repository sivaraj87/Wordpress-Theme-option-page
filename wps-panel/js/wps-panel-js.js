/* 
    In the wps-panel-js.js 
    Returns an alert dialog with the value of test.
*/
jQuery(document).ready(function($){
     
    /* Assign .wps-panel-active class to the first section link and the first section content */
    $('#wps-panel-sidebar a:first').addClass('wps-panel-active');
    $('#wps-panel-content .wps-panel-section:first').addClass('wps-panel-active');
     
    /* Handle the section change when a section link is clicked */
    $('#wps-panel-sidebar a').click(function(e){
         
        /* Prevent default behaviour */
        e.preventDefault();
         
        /* Get the section id */
        var section_id = $(this).attr('href');
         
        /* Remove .wps-panel-active class from the previous section link and add it to the new one */
        $('#wps-panel-sidebar .wps-panel-active').removeClass('wps-panel-active');
        $(this).addClass('wps-panel-active');
         
        /* Add .wps-panel-active class to the new section content and remove it from the previous one */
        $('#wps-panel-content .wps-panel-section' + section_id).addClass('wps-panel-active').siblings('.wps-panel-active').removeClass('wps-panel-active');
         
    });
    



     
});


