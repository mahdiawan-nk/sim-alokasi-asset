
<script>
   
    function successAlert(message = "Your work has been saved") {
        Swal.fire({
            position: "top-end",
            icon: "success",
            title: message,
            showConfirmButton: false,
            timer: 1500
        });
    }

    function errorAlert(message = "Your work has been saved") {
        Swal.fire({
            position: "top-end",
            icon: "error",
            title: message,
            showConfirmButton: false,
            timer: 3500
        });
    }
</script>