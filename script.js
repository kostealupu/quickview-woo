$(window).on("load", function (e) {
    $(".popup-trigger").click(function(){
       $('.popup').show();
       $('.popup-bg').show();
    });
    $('.popup-close').click(function(){
         $('html, body').css({
            overflow: 'auto',
        });
        $('.popup').hide();
        $('.popup-bg').hide();
    });
    $('.popup-bg').click(function(){
        $('.popup').hide();
        $('.popup-bg').hide();
    });
});

$(document).ready(function($){
   $('.popupajax').on('click', function (e) {
        e.preventDefault();
        let self = $(this);
        let productId = $(this)
            .attr('rel');

        // add loader
        let btnContent = $(this).html();

        //self.html('Loading...');
        $('.cp_modal_loader').css('display', 'flex');
        $('html, body').css({
            overflow: 'hidden',
        });
        
        $.ajax({
            type: 'POST',
            url: cp_loc_ajaxpath,
            //dataType: "json",
            data:{
                action: 'cp_get_product_details',
                cp_productId: productId
            },
            success: function(data) {
                // remove loader
                self.html(btnContent);

                // show modal
               // $('.cp_modal_loader').css('display', 'none');
                $('.cp_modal_wrapper').css('display', 'flex');
                $('.cp_modal_content').html(data);
 
let prata = $('#selekted').attr('prat');
$(".popup-price").html(prata);

                $('.variation_price').on('click', function (e) {
$('.variation_price').css('background', '#000');
$(this).css('background', '#8c46e2');
let idata = $(this).attr('idat');
$("#variation_id").val(idata);
let prata = $(this).attr('prat');
$(".popup-price").html(prata);
    });

            },
            error: function(xhr, status, error) {
                let errorMsg = xhr.status + ' : ' + xhr.statusText
                alert('Error ', errorMsg);
            }
        })
    });
    $('.cp_modal_loader').on('click', function(){
        $('html, body').css({
            overflow: 'auto',
        });
        $(this).css('display', 'none');
    })
});
