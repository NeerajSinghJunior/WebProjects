<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script> 
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" />
</head>
@if (session('success'))

<script type="text/javascript">
        $(document).ready(function(){
        	swal("Success!", "{{ session('success') }}", "success");
        });
</script>
@endif
@if (session('alert'))
<script type="text/javascript">
        $(document).ready(function(){
        	swal("Sorry!", "{{ session('alert') }}", "error");
        });
</script>
@endif
@if (session('error'))
<script type="text/javascript">
        $(document).ready(function(){
        	swal("Sorry!", "{{ session('error') }}", "error");
        });
</script>
@endif