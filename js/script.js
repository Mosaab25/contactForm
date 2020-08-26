$(function(){
    $('#contact-form').submit(function(e){
        e.preventDefault();
        $('.comments').empty();
        var postdata = $('#contact-form').serialize();
        
        $.ajax({
            type: 'POST',
            url: 'php/contact.php',
            data: postdata,
            dataType: 'json',
            success: function(result){
            
                if(result.isSuccess){
                    $('#contact-form').append("<p class='thank you'> You message has been sent successfully. Thank you :) !</p>");
                    $("#contact-form")[0].reset();
                }else{
                    $("#firstname + .comments").html(result.firstnameError);
                    $("#lastname + .comments").html(result.lastnameError);
                    $("#email + .comments").html(result.emailError);
                    $("#phone + .comments").html(result.phoneError);
                    $("#message + .comments").html(result.messageError);
                    
                }   
            }
        });
        
    });
})