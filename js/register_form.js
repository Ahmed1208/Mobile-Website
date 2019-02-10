      var mail = 'input[name="email"';
      var pass1 = 'input[name="first_password"';
      var pass2 = 'input[name="check_password"';

$(function(){
        document.querySelector('form').addEventListener("submit" , function(event){
            var email = $(mail).val();
            var password1 = $(pass1).val();
            var password2 = $(pass2).val();
            if ( email === '' || password1 === '' || password2 === '' || password1 !== password2 ){
             event.preventDefault();
             if(email === '' && $("#php-email-warning").text() === '')  $('#email-warning').text("please enter E-mail").slideDown();
             if(password1 === '')  $('#password1-warning').text("please enter Password").slideDown();
             if(password2 === '')  $('#password2-warning').text("please enter confirm Password").slideDown();
          }
        });
        $(pass2).keyup(function(){
            if ($(pass1).val() !== $(this).val())
                $('#password2-warning').text("Passwords don't match").slideDown().css({"color":"#fa2"});
            else
               $('#password2-warning').slideUp(400,function(){
                   $(this).css({"color":"#f64"});
               });
        });
        $(mail).blur(function(){
            var email = $(mail).val();
            if(email === ""){ $(this).css({"box-shadow": "0px 0px 2px 1px #f43"});  }
            else{  $(this).css({"box-shadow": "0px 0px 1px #333"});
                   $('#email-warning').slideUp(); 
                   $('#php-email-warning').slideUp(); }
        }).focus(function(){
            $(this).css({"box-shadow": "0px 0px 2px 1px #48f"});
        });
        
        
        $(pass1).blur(function(){
            var password1 = $(pass1).val();
            if(password1 === ""){  $(this).css({"box-shadow": "0px 0px 2px 1px #f43"});  }
            else{  $(this).css({"box-shadow": "0px 0px 1px #333"});
                   $('#password1-warning').slideUp();  }
        }).focus(function(){
            $(this).css({"box-shadow": "0px 0px 2px 1px #48f"});
        });

        $(pass2).blur(function(){
            var password2 = $(pass2).val();
            if(password2 === ""){  $(this).css({"box-shadow": "0px 0px 2px 1px #f43"});  }
            else{  $(this).css({"box-shadow": "0px 0px 1px #333"});
                   if($(pass1).val() === $(pass2).val()) { $('#password2-warning').slideUp(); }  }
        }).focus(function(){
            $(this).css({"box-shadow": "0px 0px 2px 1px #48f"});
        });
});