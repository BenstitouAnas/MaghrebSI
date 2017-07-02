
    @extends('layouts.client')
    @section('title',"Client - Tickets")


@section('js_css')
@endsection

@section('content')
<div class="panel panel-flat">
    <div class="panel-heading">
        <h6 class="panel-title">Liste des réponses</h6>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div>
    </div>

    <div class="panel-body">
        <ul class="media-list chat-list content-group">
        @foreach ($messages as $message)

            <li class="media">
                <div class="media-left">
                    <a>
                        <img src="{{asset('./assets/images/placeholder.jpg')}}" class="img-circle" alt="">
                    </a>
                </div>

                <div class="media-body">
                    <div class="media-content">{{$message->message}}</div>
                    <span class="media-annotation display-block mt-10">{{$message->created_at}} <a href="#"><i class="icon-pin-alt position-right text-muted"></i></a></span>
                </div>
            </li>

        @endforeach

        </ul>

        @if($ticket->active == '1')

        <textarea name="enter-message" class="form-control content-group" rows="3" cols="1" placeholder="Enter your message..." id="message"></textarea>

        <div class="row">
            <div class="col-xs-6">
                <ul class="icons-list icons-list-extended mt-10">
                </ul>
            </div>
            <div class="col-xs-6 text-right">
                <button type="button" class="btn bg-teal-400 btn-labeled btn-labeled-right" id="repondre"><b><i class="icon-circle-right2"></i></b> Répondre</button>
            </div>
        </div>

        @else

        <div class="alert alert-info">
            <strong>Info !</strong> Ce ticket est fermé !
        </div>

        @endif

    </div>
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
      $(function() {
          $(document).delegate("#Del_Categorie","click",function(e){
              id=$(this).attr("ref");
              swal({
                      title: "Êtes-vous sûr ? ",
                      text: "Vous ne pourrez pas récupérer ce enregistrement!",
                      type: "error",
                      showCancelButton: true,
                      confirmButtonColor: "#C62828",
                      confirmButtonText: "Oui, Supprimer",
                      closeOnConfirm: false,
                      cancelButtonText: "Annuler"
                  },
                  function(){
                      $.post("./CategorieDelete",{ id: id},function(data){
                          tablef.ajax.reload();
                          swal("Supprimé !", data, "success");
                      });
                  }
                  );
          });


          $(document).delegate("#repondre","click",function(e){
              
              //alert({{$ticket->id}});
              $.post("./RepondreTicketClient"+{{$ticket->id}},{
                  ticket:$(".editmodale input[name='id']").val(),
                  message:$("#message").val()
              },function(data){
                  /*tablef.ajax.reload();
                  swal("Modifié !", data, "success");
                  $('#modal_theme_success').modal('hide');
                  $("#formcategorie").trigger("reset");
                  //$('#modal_theme_success').modal('show');
                  $.uniform.update();*/
              });
          });
      });
  </script>
@endsection
