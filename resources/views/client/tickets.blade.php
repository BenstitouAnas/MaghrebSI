
    @extends('layouts.client')
    @section('title',"Client - Tickets")





@section('js_css')
@endsection

@section('content')

<div class="row">
<div class="col-lg-8">
  <!-- Questions list -->
    <div class="text-size-small text-uppercase text-semibold text-muted mb-10">Vos tickets</div>
    <div class="panel-group panel-group-control panel-group-control-right">
    @foreach ($tickets as $ticket)
        <div class="panel panel-white">
            <div class="panel-heading">
                <h6 class="panel-title">
                    <a class="collapsed" data-toggle="collapse" href="#question6">
                        <i class="icon-help position-left text-slate"></i> {{$ticket->titre}}
                    </a>
                </h6>
            </div>

            <div id="question6" class="panel-collapse collapse">
                <div class="panel-body">
                    {{$ticket->objet}}
                </div>

                <div class="panel-footer panel-footer-transparent">
                    <div class="heading-elements">
                        <span class="text-muted heading-text">Crée en : {{$ticket->created_at}}</span>

                        <ul class="list-inline list-inline-condensed heading-text pull-right">
                            <li><a href="../Clients/DetailleTicketClient/{{$ticket->id}}" class="text-primary">Détailles</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    </div>
    <!-- /questions list -->
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
