$(document).ready(function(){
    loadData();

    function loadData() {
        let dataTable = $('#tbl_info').DataTable(); // Initialize DataTable first

        $.ajax({
            type: "POST",
            url: 'includes/studentMngt.php',
            data: { action: 'getData' },
            dataType: 'json',
            success: function(response) {
                dataTable.clear(); // Clear any existing data
                $.each(response.data, function(index, student) {
                    dataTable.row.add([
                        student.student_id,
                        student.fullname,
                        student.course,
                        student.address,
                        student.contact_no
                    ]);
                });
                dataTable.draw(); // Re-render the table
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });

    }

    $("#btnLogout").click(function() {
        Swal.fire({
            title: "Are you sure?",
            text: "This will log you out!",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Logout"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "logout.php";
            }
        });
    })
})

