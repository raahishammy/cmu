$(function(){
    
    if ($("#login-form").length > 0){
        $("#login-form").validate({
            errorElement: 'span',
            errorClass: 'is-invalid',
            rules:{
                email:{
                    required: true,
                    email: true
                },
                password:'required'
            },
            messages: {
                password: "Please enter your Password",
                email: {
                    required: "Please enter your Email ID",
                    email: "Your email address is Invalid."
                }
            },
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    }

    if ($("#register-form").length > 0) {
        $("#register-form").validate({
            errorElement: 'span',
            errorClass: 'is-invalid',
            rules: {
                email: {
                    required: true,
                    email: true
                },
                name: 'required',
                contact: 'required',
                agreeTerms: 'required',
            },
            messages: {
                name: "Please enter your Full Name",
                contact: "Please enter your Phone Contact",
                agreeTerms: "Please check accept the terms option",
                email: {
                    required: "Please enter your Email ID",
                    email: "Your email address is Invalid."
                },
            },
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    }

    $("#copy_referral").on("click", function () {
        var copyText = document.getElementById("referral_link");
        copyText.select();
        copyText.setSelectionRange(0, 99999); /*For mobile devices*/

        /* Copy the text inside the text field */
        document.execCommand("copy");
        swal("Copied!", "You Referral Link has been copied!", "success");
    });
});