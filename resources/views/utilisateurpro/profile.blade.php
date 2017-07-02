@extends('layouts.prestataire')

@section('title',"Préstataire - Produits")

@section('js_css')
  <script type="text/javascript" src="{{asset('assets/js/plugins/forms/styling/uniform.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('assets/js/plugins/notifications/pnotify.min.js')}}"></script>
@endsection

@section('content')

<div class="col-lg-12">
  
</div>
@endsection

@section('script_footer')

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

<script>

</script>
@endsection
