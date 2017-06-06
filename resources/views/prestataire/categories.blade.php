@extends('layouts.prestataire')

@section('title',"Préstataire - Catégories")

@section('js_css')
  <script type="text/javascript" src="{{asset('assets/js/plugins/tables/datatables/datatables.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('assets/js/plugins/forms/selects/select2.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('assets/js/plugins/forms/styling/uniform.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('assets/js/plugins/notifications/pnotify.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('js/prestataire/datatables_categories.js')}}"></script>
@endsection

@section('content')

<div class="col-lg-8">
  <!-- Basic datatable -->
  <div class="panel panel-flat">
      <div class="panel-heading">
          <h6 class="panel-title">Catégories</h6>
          <div class="heading-elements">
      			<ul class="icons-list">
      				<li><a data-action="collapse"></a></li>
      				<li><a data-action="reload"></a></li>
      			</ul>
      		</div>
      </div>

      <hr class="no-margin">

      <table class="table datatable-basic table-bordered" id="allclients">
          <thead>
          <tr>
              <th>Catégories</th>
              <th>Description</th>
              <th></th>
          </tr>
          </thead>
          <tbody>

          </tbody>
      </table>
  </div>
  <!-- /basic datatable -->
</div>


<div class="col-lg-4">
  <div class="panel panel-flat">
    <form id="formCategorieAjout" action="get" onsubmit="return false;">
        <div class="panel-heading">
            <h6 class="panel-title">Ajouter une catégories<a class="heading-elements-toggle"><i class="icon-more"></i></a></h6>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">
        <div class="form-group">
                <label>Categorie:</label>
                <input type="text" class="form-control" placeholder="Catégorie" name="categorieAjout" value="" id="categorieAjouter"></input>
            </div>

        <div class="form-group">
                <label>Description:</label>
                <input rows="5" cols="5" class="form-control" placeholder="Entrez une petite description" value="" name="descriptionAjouter" id="descriptionAjouter"></input>
            </div>

        <div class="text-right">
                <button id="Add_Categorie" type="submit" class="btn btn-primary">Ajouter <i class="icon-arrow-right14 position-right"></i></button>
            </div>
        </div>
    </form>
  </div>
</div>

<!-- Success modal -->
<div id="modal_theme_success" class="modal fade editmodale">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h6 class="modal-title">Modification du Categorie</h6>
            </div>

            <div class="modal-body form-horizontal">
                <br>
                <form id="formcategorie" action="get" onsubmit="return false;">
                <div class="form-group">
                    <label class="col-lg-3 control-label">Categorie</label>
                    <div class="col-lg-9">
                        <div class="form-group has-feedback has-feedback-left">
                            <input type="text" class="form-control input-sm" name="categorie">
                            <input type="hidden" class="form-control" name="id">
                            <div class="form-control-feedback">
                                <i class="icon-profile"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-3 control-label">Description</label>
                    <div class="col-lg-9">
                        <div class="form-group has-feedback has-feedback-left">
                            <input type="text" class="form-control" name="description">
                            <div class="form-control-feedback">
                                <i class="icon-arrow-right5"></i>
                            </div>
                        </div>
                    </div>
                </div>

                </form>
            </div>
            <hr class="no-margin-top"/>
            <div class="modal-footer">
                <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success actionbutton" id="Edit">Save changes</button>
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
