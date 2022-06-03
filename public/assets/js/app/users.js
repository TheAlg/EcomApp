main.users = {

    register : $(function () {
        console.log("ici")
        $('#register-form').on('submit',function (e) {
    
                  $.ajax({
                    type: 'post',
                    url: '/users/signup',
                    data: $('#register-form').serialize(),
                    success: function () {
                     alert("Email has been sent!");
                    }
                  });
              e.preventDefault();
            });
    })
} 
main.users.register;