$(function() {

    $("#btnLogin").click(function() {

        var StudentID = $("#StudentID").val();
        var password = $("#password").val();

        $.post("login.php", { StudentID: StudentID, password: password})
            .done(function( data ) {
                if(data == "Success") {
                    $('#Login').modal();

                    $('#Login').on('hidden.bs.modal', function (e) {
                        window.location = "student-view/search-job/jobs.php";
                    })
                } else {
                    $('#LoginFailed').modal();

                    $('#LoginFailed').on('hidden.bs.modal', function (e) {

                    })
                }

            });

    });

});