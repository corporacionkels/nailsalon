<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Sweetalert</title>
</head>
<body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script type="text/javascript">
	swal({
    title: "Are you sure?",
    text: "Once deleted, you will not be able to recover this record!",
    icon: "warning",
    buttons: true,
    dangerMode: true,
})
.then((willDelete) => {
    if (willDelete) {
           window.location = "redirectURL";
    } else {
        swal("Your imaginary file is safe!");
    }
});
</script>
</body>
</html>