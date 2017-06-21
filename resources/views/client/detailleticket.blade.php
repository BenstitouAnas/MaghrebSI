
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
                    <a href="{{asset('./assets/images/placeholder.jpg')}}">
                        <img src="{{asset('./assets/images/placeholder.jpg')}}" class="img-circle" alt="">
                    </a>
                </div>

                <div class="media-body">
                    <div class="media-content">{{$message->message}}</div>
                    <span class="media-annotation display-block mt-10">{{$message->created_at}} <a href="#"><i class="icon-pin-alt position-right text-muted"></i></a></span>
                </div>
            </li>

        @endforeach

            <!--<li class="media reversed">
                <div class="media-body">
                    <div class="media-content">Far squid and that hello fidgeted and when. As this oh darn but slapped casually husky sheared that cardinal hugely one and some unnecessary factiously hedgehog a feeling one rudely much but one owing sympathetic regardless more astonishing evasive tasteful much.</div>
                    <span class="media-annotation display-block mt-10">Mon, 10:24 am <a href="#"><i class="icon-pin-alt position-right text-muted"></i></a></span>
                </div>

                <div class="media-right">
                    <a href="{{asset('./assets/images/placeholder.jpg')}}">
                        <img src="{{asset('./assets/images/placeholder.jpg')}}" class="img-circle" alt="">
                    </a>
                </div>
            </li>

            <li class="media">
                <div class="media-left">
                    <a href="{{asset('./assets/images/placeholder.jpg')}}">
                        <img src="{{asset('./assets/images/placeholder.jpg')}}" class="img-circle" alt="">
                    </a>
                </div>

                <div class="media-body">
                    <div class="media-content">Darn over sour then cynically less roadrunner up some cast buoyant. Macaw krill when and upon less contrary warthog jeez some koala less since therefore minimal.</div>
                    <span class="media-annotation display-block mt-10">Mon, 10:56 am <a href="#"><i class="icon-pin-alt position-right text-muted"></i></a></span>
                </div>
            </li>

            <li class="media reversed">
                <div class="media-body">
                    <div class="media-content">Some upset impious a and submissive when far crane the belched coquettishly. More the puerile dove wherever</div>
                    <span class="media-annotation display-block mt-10">Mon, 11:29 am <a href="#"><i class="icon-pin-alt position-right text-muted"></i></a></span>
                </div>

                <div class="media-right">
                    <a href="{{asset('./assets/images/placeholder.jpg')}}">
                        <img src="{{asset('./assets/images/placeholder.jpg')}}" class="img-circle" alt="">
                    </a>
                </div>
            </li>

            <li class="media reversed">
                <div class="media-body">
                    <div class="media-content"><i class="icon-menu display-block"></i></div>
                </div>

                <div class="media-right">
                    <a href="{{asset('./assets/images/placeholder.jpg')}}">
                        <img src="{{asset('./assets/images/placeholder.jpg')}}" class="img-circle" alt="">
                    </a>
                </div>
            </li>-->
        </ul>

        <textarea name="enter-message" class="form-control content-group" rows="3" cols="1" placeholder="Enter your message..."></textarea>

        <div class="row">
            <div class="col-xs-6">
                <ul class="icons-list icons-list-extended mt-10">
                </ul>
            </div>
            <div class="col-xs-6 text-right">
                <button type="button" class="btn bg-teal-400 btn-labeled btn-labeled-right"><b><i class="icon-circle-right2"></i></b> Répondre</button>
            </div>
        </div>

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

          $(document).delegate("#Edit_Categorie","click",function(e){
              $(".modal-title").html("Modification du Categorie");
              $(".actionbutton").attr('id',"Edit");
              $(".actionbutton").html("Enregistrer");
              $.get("./CategorieByID/"+$(this).attr("ref"),function(data){
                  $(".editmodale input[name='id']").val(data.id);
                  $(".editmodale input[name='categorie']").val(data.titre);
                  $(".editmodale input[name='description']").val(data.description);
                  $.uniform.update();
                  $('#modal_theme_success').modal('show');
              });
          });

          $(document).delegate("#Edit","click",function(e){
              $.post("./CategorieUpdate",{
                  id:$(".editmodale input[name='id']").val(),
                  titre:$(".editmodale input[name='categorie']").val(),
                  description:$(".editmodale input[name='description']").val()
              },function(data){
                  tablef.ajax.reload();
                  swal("Modifié !", data, "success");
                  $('#modal_theme_success').modal('hide');
                  $("#formcategorie").trigger("reset");
                  //$('#modal_theme_success').modal('show');
                  $.uniform.update();
              });
          });

          $(document).delegate("#Add_Categorie","click",function(e){
              $.post("./CategorieAdd",{
                    titre:$("[id=categorieAjouter]").val(),
                    description:$("[id=descriptionAjouter]").val()
              },function(data, status){
                    tablef.ajax.reload();
                    swal("Ajouté !", data, "success");
                    $("#formCategorieAjout").trigger("reset");
              });
          });
      });
  </script>
@endsection
