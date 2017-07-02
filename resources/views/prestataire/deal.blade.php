@extends('layouts.prestataire')

@section('title',"Préstataire - Produits")

@section('js_css')
  <script type="text/javascript" src="{{asset('assets/js/plugins/tables/datatables/datatables.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('assets/js/plugins/forms/selects/select2.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('assets/js/plugins/forms/styling/uniform.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('assets/js/plugins/notifications/pnotify.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('assets/js/pages/form_input_groups.js')}}"></script>

  <script type="text/javascript" src="{{asset('assets/js/plugins/forms/inputs/touchspin.min.js')}}"></script>

  <script type="text/javascript"> idDealData = {{$produit->id}}</script>

  <script type="text/javascript" src="{{asset('js/prestataire/datatables_deals.js')}}"></script>

@endsection

@section('content')
@if (Session::has('message'))
    <div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
        <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
        <span class="text-semibold">Ajout avec secces ! </span> votre produit est bien ajouté à la liste des produits, penser à ajouter des deals.
    </div>
@endif
<div class="panel panel-flat panel-collapsed">
    <div class="panel-heading">
        <h5 class="panel-title">Detailles Deal</h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div>
    </div>

    <div class="panel-body">
     
        <div class="form-horizontal editmodale" id="formAjoutProduit">

        <input type="hidden" class="form-control" name="id" value="{{$produit->id}}">

            <div class="form-group">
                <label class="control-label col-lg-2">Nom du Produit</label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" name="libelle" value="{{$produit->libelle}}">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-lg-2">Catégorie</label>
                <div class="col-lg-10">
                    <select name="categorie" class="form-control" id="selectCategorie">
                        @foreach ($categories as $categorie)
                            @if ($categorie->id == $produit->categorie_id)
                                <option value="{{$categorie->id}}" selected="selected">{{$categorie->titre}}</option>
                            @endif
                            <option value="{{$categorie->id}}">{{$categorie->titre}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-lg-2">Documentation Technique</label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" name="documentationTechnique" value="{{$produit->documentationTechnique}}">
                </div>
            </div>

            <div class="text-right">
                <button type="reset" class="btn btn-default" id="btnAnnuler">Annuler </button>
                <button type="submit" class="btn btn-primary actionbutton" id="modifierArticle">Modifier <i class="icon-arrow-right14 position-right"></i></button>
            </div>

        </div>
    </div>
</div>
<!-- ****************************************************************************************************************** -->

  <!-- Basic datatable -->
  <div class="panel panel-flat">
      <div class="panel-heading">
          <h6 class="panel-title">Liste des Deals</h6>
          <div class="heading-elements">
      			<ul class="icons-list">
                    <li><button type="button" class="btn btn-primary addbutton" id="Add_Deal"><i class="glyphicon glyphicon-plus"></i>  Ajouter Deal</button></li>
      				<li><a data-action="collapse"></a></li>
      			</ul>
      		</div>
      </div>

      <hr class="no-margin">
      <table class="table datatable-basic table-bordered" id="allclients">
          <thead>
          <tr>
              <th>Titre</th>
              <th>Prix</th>
              <th>Nombre Places</th>
              <th>Date Limite</th>
              <th>Action</th>
          </tr>
          </thead>
          <tbody>

          </tbody>
      </table>
  </div>
  <!-- /basic datatable -->

  <!-- Vertical form modal -->
    <div id="modalInfoPrestataire" class="modal fade editmodale2">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title">Ajouter Deal</h5>
                </div>

                <form id="formprestataire" action="get" onsubmit="return false;">
                    <div class="modal-body">
                    <form id="formprestataire" action="get" onsubmit="return false;">
                        <div class="form-group">
                            <label>Titre</label>
                            <input type="text" placeholder="Nom" class="form-control" name="titre">
                            <input type="hidden" class="form-control" name="idDeal">
                        </div>

                        <div class="form-group">
                            <label>Prix</label>
                            <input type="text" value="0" class="touchspin-prefix" name="prix" id="prix">
                        </div>

                        <div class="form-group">
                            <label>Nombre du Places</label>
                            <input type="text" value="1" class="touchspin-no-mousewheel" name="nomrbePlaces" id="nomrbePlaces">
                        </div>

                        <div class="form-group">
                            <label>Date Limite</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                <input type="text" class="form-control daterange-single" value="2017-06-17" name="dateLimite">
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-link" data-dismiss="modal">Retour</button>
                        <button type="button" class="btn btn-primary" id="addDeal">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /vertical form modal -->
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

          $('#formAjoutProduit').find('input, select').attr('disabled',true);
          $('#btnAnnuler').hide();

          $(document).delegate("#Del_Deal","click",function(e){
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
                      $.post("../DealDelete",{ id: id},function(data){
                          tablef.ajax.reload();
                          swal("Supprimé !", data, "success");
                      });
                  }
                  );
          });

          $(document).delegate("#Edit_Deal","click",function(e){
              $(".modal-title").html("Modification du Deal");
              $("#addDeal").attr('id',"Edit");
              $("#addDeal").html("Enregistrer");
              $.get("../DealByID/"+$(this).attr("ref"),function(data){
                  $(".editmodale2 input[name='idDeal']").val(data.id);
                  $(".editmodale2 input[name='titre']").val(data.titre);
                  $(".editmodale2 input[name='prix']").val(data.prix);
                  $(".editmodale2 input[name='nomrbePlaces']").val(data.nombrePlaces);
                  $(".editmodale2 input[name='dateLimite']").val(data.dateLimite);
                  $.uniform.update();
                  $('#modalInfoPrestataire').modal('show');
              });
          });

          $(document).delegate("#Edit","click",function(e){
              $.post("../DealUpdate",{
                  id:$(".editmodale2 input[name='idDeal']").val(),
                  titre:$(".editmodale2 input[name='titre']").val(),
                  prix:$(".editmodale2 input[name='prix']").val(),
                  nombrePlaces:$(".editmodale2 input[name='nomrbePlaces']").val(),
                  dateLimite:$(".editmodale2 input[name='dateLimite']").val()
              },function(data){
                  tablef.ajax.reload();
                  swal("Modifié !", data, "success");
                  $('#modalInfoPrestataire').modal('hide');
                  $("#formcategorie").trigger("reset");
                  //$('#modal_theme_success').modal('show');
                  $.uniform.update();
              });
          });

          $(document).delegate("#btnAnnuler","click",function(e){
                $('#formAjoutProduit').find('input, select').attr('disabled',true);
                $('#btnAnnuler').hide();
                $("#enregisterModification").html("Modifier");
                $("#enregisterModification").attr('id',"modifierArticle");
                $.uniform.update();
          });

          $(document).delegate("#modifierArticle","click",function(e){
                $('#formAjoutProduit').find('input, select').attr('disabled',false);
                $('#btnAnnuler').show();
                $("#modifierArticle").html("Enregistrer");
                $("#modifierArticle").attr('id',"enregisterModification");
                
            });
            
        $(document).delegate("#Add_Deal","click",function(e){
                $("#formprestataire").trigger("reset");
                $.uniform.update();
                $(".modal-title").html("Ajouter Deal");
                $('#modalInfoPrestataire').modal('show');
          });

          $(document).delegate("#addDeal","click",function(e){
              $.post("../DealAdd",{
                  produit_id:$(".editmodale input[name='id']").val(),
                  titre:$(".editmodale2 input[name='titre']").val(),
                  prix:$(".editmodale2 input[name='prix']").val(),
                  dateLimite:$(".editmodale2 input[name='dateLimite']").val(),
                  nombrePlaces:$(".editmodale2 input[name='nomrbePlaces']").val()
              },function(data){
                tablef.ajax.reload();
                $("#formprestataire").trigger("reset");
                $('#modalInfoPrestataire').modal('hide');
                swal("Ajouté !", data, "success");
              });
          });
            
            $(document).delegate("#enregisterModification","click",function(e){
              $.post("../ProduitDealUpdate",{
                  id:$(".editmodale input[name='id']").val(),
                  libelle:$(".editmodale input[name='libelle']").val(),
                  documentationTechnique:$(".editmodale input[name='documentationTechnique']").val(),
                  categorie:$(".editmodale select[name='categorie']").val()
              },function(data){
                  //tablef.ajax.reload();
                  swal("Modifié !", data, "success");
                  $.uniform.update();


                    $('#formAjoutProduit').find('input, select').attr('disabled',true);
                    $('#btnAnnuler').hide();
                    $("#enregisterModification").html("Modifier");
                    $("#enregisterModification").attr('id',"modifierArticle");
              });
          });

      });
  </script>
@endsection
