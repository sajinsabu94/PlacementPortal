$(function() {

    $("#btnLogin").click(function() {

        var AdminEmail = $("#AdminEmail").val();
        var password = $("#password").val();

        $.post("login.php", { AdminEmail: AdminEmail, password: password})
            .done(function( data ) {
                if(data == "Success") {
                    $('#Login').modal();

                    $('#Login').on('hidden.bs.modal', function (e) {
                        window.location = "admin/admin.php";
                    })
                } else {
                    $('#LoginFailed').modal();

                    $('#LoginFailed').on('hidden.bs.modal', function (e) {

                    })
                }

            });

    });

});