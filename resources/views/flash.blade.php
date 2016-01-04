@if(session()->has('flash_message'))
  <script type="text/javascript">
     swal({ 
       title: "Error!",   
       text: "{{session('flash_message')}}}",   
       type: "error", 
       confirmButtonText: "Cool",
       timer: 2000,   
       showConfirmButton: false
   });

  </script>


@endif