$(document).ready(function(){
    $("#frmLogin").submit(function(e) {
        e.preventDefault();

        var formData = $(this).serialize();
        formData += "&action=login";

        $.ajax({
            type: 'POST',
            url: 'includes/studentMngt.php',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if(response.success) {
                    Swal.fire({
                        title: "Success",
                        text: response.message,
                        icon: "success"
                    });
                    window.location.href = "dashboard.php";
                }
                else {
                    Swal.fire({
                        title: "Error",
                        text: response.message,
                        icon: "error"
                    });
                }
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    title: "Error",
                    text: error,
                    icon: "error"
                });
            }
        })
        $("#frmLogin")[0].reset();
    })
})

