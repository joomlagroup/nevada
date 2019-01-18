
jQuery.noConflict();
jQuery(document).ready(function($){
    $('.link_detail_members').click(function(){

        var post_id = jQuery(this).attr("data-post_id");
        var nonce = jQuery(this).attr("data-nonce");
        $('ul.list_members li a').removeClass('current_item');
        $(this).addClass('current_item');

        $.ajax({
            type : "post",
            dataType : "json",
            url : ajaxurl,
            data : {
                action: "loadpost", //Tên action
                post_id : post_id,
				nonce: nonce,
            },
            context: this,
            beforeSend: function(){
            	//do anyting
            },
            success: function(response) {
                if(response.success) {
                    $('.list_pdf_file').html(response.data);
                }
                else {
                    console.log('error');
                }
            },
            error: function( jqXHR, textStatus, errorThrown ){
                console.log( 'The following error occured: ' + textStatus, errorThrown );
            }
        })
        return false;
    });

    $(".wrap_members").on("click",".show_more", function(){
        $('.list_pdf_file ul li.hide_item').show();
        $(this).hide();
    });

});