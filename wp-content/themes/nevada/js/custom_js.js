
jQuery.noConflict();
jQuery(document).ready(function($){

    $(".wrap_members").on("click",".show_more", function(){
        $('.list_pdf_file ul li.hide_item').show();
        $(this).hide();
    });

});