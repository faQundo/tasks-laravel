@if(Session::has('success'))
<div id="custom-alert" class="alert alert-success mb-2" role="alert"><strong class="text-capitalize">{{ session()->has('title') ? session()->get('title') : 'Success!' }}</strong>
    {{session()->get('description')}}
    <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
  </div>
@endif

@if(Session::has('destroy'))
  <div id="custom-alert" class="alert alert-danger mb-2" role="alert"><strong class="text-capitalize">{{ session()->has('title') ? session()->get('title') : 'Error!' }}</strong>
    {{session()->get('description')}}
    <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
  </div>
@endif

@push('bottom')
  <script>
      $(function(){
          $('.alert').fadeIn();
            setTimeout(function() {
                $(".alert").fadeOut();
            },3000);

      });
  </script>
@endpush
