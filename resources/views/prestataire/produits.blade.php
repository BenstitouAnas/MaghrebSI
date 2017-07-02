@extends('layouts.prestataire')

@section('title',"Préstataire - Produits")

@section('js_css')

  <script type="text/javascript" src="{{asset('assets/js/plugins/tables/datatables/datatables.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('assets/js/plugins/forms/selects/select2.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('assets/js/plugins/forms/styling/uniform.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('assets/js/plugins/notifications/pnotify.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('js/prestataire/datatables_produits.js')}}"></script>
@endsection

@section('content')

<div class="col-lg-12">
@if (Session::has('message'))
    <div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
        <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
        <span class="text-semibold">Ajout avec secces ! </span> votre produit est bien ajouté à la liste des produits.
    </div>
@endif
  <!-- Basic datatable -->
  <div class="panel panel-flat">
      <div class="panel-heading">
      
          <h6 class="panel-title">Liste des Produits</h6>
          <div class="heading-elements">
      			<ul class="icons-list">
                  <li>
      				<li><a data-action="collapse"></a></li>
      				<li><a data-action="reload"></a></li>
      			</ul>
      		</div>
      </div>

      <hr class="no-margin">
      <table class="table datatable-basic2 table-bordered" id="allclients">
          <thead>
          <tr>
              <th>Catégorie</th>
              <th>Image</th>
              <th>Libelle</th>
              <th>Type</th>
              <th>Documentation</th>
              <th>Prix</th>
              <th>Quantité</th>
              <th>Action</th>
          </tr>
          </thead>
          <tbody>

          </tbody>
      </table>
  </div>
  <!-- /basic datatable -->
</div>

 <!-- Vertical form modal -->
    <div id="modalInfoPrestataire" class="modal fade editmodale">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title">Produits</h5>
                </div>

                <form id="formprestataire" action="get" onsubmit="return false;">
                    <div class="modal-body">
                    <form id="formprestataire" action="get" onsubmit="return false;">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12">
                                    <label>Libelle</label>
                                    <input type="text" placeholder="Libelle" class="form-control" name="libelle">
                                    <input type="hidden" class="form-control" name="id">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12">
                                    <label>Documentation</label>
                                    <input type="text" placeholder="Documentation" class="form-control" name="documentation">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12">
                                    <label>Documentation Technique</label>
                                    <input type="text" placeholder=">Documentation Technique" class="form-control" name="documentationTechnique">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">

                                <div class="col-sm-6">
                                    <label>Catégorie</label>
                                    <select name="categorie" class="form-control" id="selectCategorie">
                                        <option value="4">Ete</option>
                                        <option value="1">Hiver</option>
                                        <option value="2">Informatique</option>
                                        <option value="3">Autre</option>
                                    </select>
                                </div>

                                <div class="col-sm-6">
                                    <label>Image Produit</label>
                                    <div class="uploader">
                                        <input id="imageProduit" type="file" class="file-styled-primary" name="image">
                                        <span class="filename" style="user-select: none;" id="imagep">Pas d'image</span>
                                        <span class="action btn bg-blue" style="user-select: none;">Choisir Fichier</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" style="text-align:left;" id="">Widget</button>
                        <button type="button" class="btn btn-link" data-dismiss="modal">Retour</button>
                        <button type="button" class="btn btn-primary actionbutton" id="Edit">Modifier</button>
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

          $(document).delegate("#imageProduit","change",function(e){
                $("#imagep").text(e.target.files[0].name);
            });


            $(document).delegate("#selectType","change",function(e){
                
                if(this.value == 'article')
                {
                    //alert( '0' );
                    $(".actionbutton").attr('id',"ajouterArticle");
                    $("#qte").prop('disabled', false);
                    $("#prix").prop('disabled', false);

                    
                }
                if(this.value == 'booking')
                {
                    //alert('1' );
                    $(".actionbutton").attr('id',"ajouterBooking");
                    $("#qte").prop('disabled', true);
                    $("#prix").prop('disabled', false);
                } 
                if(this.value == 'deal')
                {
                    //alert('2');
                    $(".actionbutton").attr('id',"ajouterDeal");
                    $("#qte").prop('disabled', true);
                    $("#prix").prop('disabled', true);
                } 
                if(this.value == 'prestation')
                {
                    //alert( '3' );
                    $(".actionbutton").attr('id',"ajouterPrestation");
                    $("#qte").prop('disabled', true);
                    $("#prix").prop('disabled', false);
                }                
          });



          $(document).delegate("#ajouterArticle","click",function(e){
              $.post("./AjouterArticle",{
                        libelle:$("input[name='libelle']").val(),
                        categorie_id:$("select[name='categorie']").val(),
                        documentation:$("input[name='documentation']").val(),
                        documentationTechnique:$("input[name='documentationTechnique']").val(),
                        image:$("input[name='image']").val(),
                        prix:$("input[name='prix']").val(),
                        qte:$("input[name='qte']").val()
                    },function(data, status){
                        //swal("Ajouté !", data, "success");
                        $(this).closest('form').find("input[type=text], textarea").val("");
                    });
          });

          $(document).delegate("#ajouterBooking","click",function(e){
              $.post("./AjouterBooking",{
                        libelle:$("input[name='libelle']").val(),
                        categorie_id:$("select[name='categorie']").val(),
                        documentation:$("input[name='documentation']").val(),
                        documentationTechnique:$("input[name='documentationTechnique']").val(),
                        image:$("input[name='image']").val(),
                        prix:$("input[name='prix']").val()
                    },function(data, status){
                        //swal("Ajouté !", data, "success");
                        $("#formAjoutProduit").trigger("reset");
                    });
          });

          $(document).delegate("#ajouterDeal","click",function(e){
              $.post("./AjouterDeal",{
                        libelle:$("input[name='libelle']").val(),
                        categorie_id:$("select[name='categorie']").val(),
                        documentation:$("input[name='documentation']").val(),
                        documentationTechnique:$("input[name='documentationTechnique']").val(),
                        image:$("input[name='image']").val()
                    },function(data, status){
                        //swal("Ajouté !", data, "success");
                        $("#formAjoutProduit").trigger("reset");
                    });
          });

          $(document).delegate("#ajouterPrestation","click",function(e){
              $.post("./AjouterPrestation",{
                        libelle:$("input[name='libelle']").val(),
                        categorie_id:$("select[name='categorie']").val(),
                        documentation:$("input[name='documentation']").val(),
                        documentationTechnique:$("input[name='documentationTechnique']").val(),
                        image:$("input[name='image']").val(),
                        prix:$("input[name='prix']").val()
                    },function(data, status){
                        //swal("Ajouté !", data, "success");
                        $("#formAjoutProduit").trigger("reset");
                    });
          });

          $(document).delegate("#InfoArticle","click",function(e){
              $('#modalInfoPrestataire').find('input, select').attr('disabled','disabled');
              $(".modal-title").html("Informations sur l'article");
              $(".actionbutton").attr('id',"Edit_Article");
              $(".actionbutton").html("Modifier");
              $('#modalInfoPrestataire').modal('show');
              $.get("./AriclePrestationByID/"+$(this).attr("ref"),function(data){
                  $(".editmodale input[name='id']").val(data.id);
                  $(".editmodale input[name='libelle']").val(data.libelle);
                  $(".editmodale input[name='documentation']").val(data.documentation);
                  $(".editmodale input[name='documentationTechnique']").val(data.documentationTechnique);
                  $(".editmodale input[name='image']").val(data.image);

                  $("#selectCategorie option[value="+data.categorie_id+"]").prop("selected", true);

                  $.uniform.update();
                  $('#modalInfoPrestataire').modal('show');
              });
          });

          $(document).delegate("#InfoPrestataion","click",function(e){
              $('#modalInfoPrestataire').find('input, select').attr('disabled','disabled');
              $(".modal-title").html("Informations du Préstation");
              $(".actionbutton").attr('id',"Edit_produit");
              $(".actionbutton").html("Modifier");
              $('#modalInfoPrestataire').modal('show');
              /*$.get("./PrestataireByID/"+$(this).attr("ref"),function(data){
                  $(".editmodale input[name='id']").val(data.id);
                  $(".editmodale input[name='nom']").val(data.nom);
                  $(".editmodale input[name='prenom']").val(data.prenom);
                  $(".editmodale input[name='email']").val(data.email);
                  $(".editmodale input[name='identifiantLegale']").val(data.identifiantLegale);
                  $(".editmodale input[name='statusEntreprise']").val(data.statusEntreprise);

                  $("#selectRole option[value="+data.role_id+"]").prop("selected", true);
                  $("#selectEtat option[value="+data.etat+"]").prop("selected", true);
                  $(".editmodale input[name='compagnie']").val(data.compagnie);
                  $(".editmodale input[name='tel']").val(data.tel);

                  $.uniform.update();
                  $('#modalInfoPrestataire').modal('show');
              });*/
          });

          $(document).delegate("#Edit_Article","click",function(e){
                $('#modalInfoPrestataire').find('input, select').attr('disabled',false);
                $(".actionbutton").attr('id',"EditArticle");
                $(".actionbutton").html("Enregistrer");
          });

          $(document).delegate("#EditArticle","click",function(e){
              $.post("./ArticleUpdate",{
                  id:$(".editmodale input[name='id']").val(),
                  libelle:$(".editmodale input[name='libelle']").val(),
                  documentation:$(".editmodale input[name='documentation']").val(),
                  documentationTechnique:$(".editmodale input[name='documentationTechnique']").val(),
                  categorie_id:$(".editmodale select[name='categorie']").val()
              },function(data){
                  tablef.ajax.reload();
                  swal("Modifié !", data, "success");
                  $('#modalInfoPrestataire').modal('hide');
                  $.uniform.update();
              });
          });

      });
  </script>
@endsection
