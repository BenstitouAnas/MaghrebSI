@extends('layouts.admin')

@section('title',"Admin - Demandes")

@section('js_css')
  <script type="text/javascript" src="{{asset('assets/js/plugins/tables/datatables/datatables.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('assets/js/plugins/forms/selects/select2.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('assets/js/plugins/forms/styling/uniform.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('assets/js/plugins/notifications/pnotify.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('js/admin/datatables_commerciales.js')}}"></script>
@endsection

@section('content')

<div class="col-lg-12">

  <!-- Basic datatable -->
  <div class="panel panel-flat">
      <div class="panel-heading">
          <h6 class="panel-title">Liste des Demandes des Commerciaux</h6>
          <div class="heading-elements">
      			<ul class="icons-list">
                  <li><button type="button" class="btn btn-primary addbutton" id="Send_Email"><i class="glyphicon glyphicon-plus"></i>  Email</button></li>
                    <li><button type="button" class="btn btn-primary addbutton" id="Add_Commerciale"><i class="glyphicon glyphicon-plus"></i>  Ajouter Prestataire</button></li>
      				<li><a data-action="collapse"></a></li>
      				<li><a data-action="reload"></a></li>
      			</ul>
      		</div>
      </div>

      <hr class="no-margin">
      <table class="table datatable-basic22 table-bordered" id="allclients">
          <thead>
          <tr>
              <th>Role</th>
              <th>Nom</th>
              <th>Prénom</th>
              <th>Email</th>
              <th>Etat</th>
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
    <div id="modalInfoCommerciale" class="modal fade editmodale">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title">Commerciales</h5>
                </div>

                <form id="formprestataire" action="get" onsubmit="return false;">
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>Nom</label>
                                    <input type="text" placeholder="Nom" class="form-control" name="nom">
                                    <input type="hidden" class="form-control" name="id">
                                </div>

                                <div class="col-sm-6">
                                    <label>Prénom</label>
                                    <input type="text" placeholder="Prénom" class="form-control" name="prenom">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>Email</label>
                                    <input type="email" placeholder="Email" class="form-control" name="email">
                                </div>

                                <div class="col-sm-6">
                                    <label>Téléphone</label>
                                    <input type="text" placeholder="Téléphone" class="form-control" name="tel">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>Status Entreprise</label>
                                    <select name="statusEntreprise" class="form-control" id="selectEtat">
                                        <option value="Entrepreneur">Entrepreneur</option>
                                        <option value="AutoEntrepreneur">Auto Entrepreneur</option>
                                    </select>
                                </div>

                                <div class="col-sm-4">
                                    <label>Compagnie</label>
                                    <input type="text" placeholder="Compagnie" class="form-control" name="compagnie">
                                </div>

                                <div class="col-sm-4">
                                    <label>Identifiant Légale</label>
                                    <input type="text" placeholder="Identifiant Légale" class="form-control" name="identifiantLegale">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>Role</label>
                                    <select name="role_id" class="form-control" id="selectRole">
                                        @foreach ($roles as $role)
                                            <option value="{{$role->id}}">{{$role->role}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-sm-4">
                                    <label>Supérviseur</label>
                                    <select name="superieur" class="form-control" id="selectSuperieur">
                                        @foreach ($superieurs as $superieur)
                                            <option value="{{$superieur->id}}">{{$superieur->nom}} {{$superieur->prenom}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-sm-4">
                                    <label>Etat</label>
                                    <select name="etat" class="form-control" id="selectEtat">
                                        <option value="Confirme">Confirmé</option>
                                        <option value="Attente">En Attente</option>
                                        <option value="Suspendue">Suspendue</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
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

          $(document).delegate("#InfosCommerciale","click",function(e){
              $('#modalInfoCommerciale').find('input, select').attr('disabled','disabled');
              $(".modal-title").html("Modification du Commerciale");
              $(".actionbutton").attr('id',"Edit_commerciale");
              $(".actionbutton").html("Modifier");
              $.get("./CommercialeByID/"+$(this).attr("ref"),function(data){
                  $(".editmodale input[name='id']").val(data.id);
                  $(".editmodale input[name='nom']").val(data.nom);
                  $(".editmodale input[name='prenom']").val(data.prenom);
                  $(".editmodale input[name='email']").val(data.email);
                  $(".editmodale input[name='identifiantLegale']").val(data.identifiantLegale);
                  $(".editmodale input[name='statusEntreprise']").val(data.statusEntreprise);

                  $("#selectRole option[value="+data.role_id+"]").prop("selected", true);
                  $("#selectSuperieur option[value="+data.superieur+"]").prop("selected", true);
                  $("#selectEtat option[value="+data.etat+"]").prop("selected", true);
                  $(".editmodale input[name='compagnie']").val(data.compagnie);
                  $(".editmodale input[name='tel']").val(data.tel);

                  $.uniform.update();
                  $('#modalInfoCommerciale').modal('show');
              });
          });

          $(document).delegate("#Edit_commerciale","click",function(e){
                $('#modalInfoCommerciale').find('input, select').attr('disabled',false);
                $(".actionbutton").attr('id',"Edit");
                $(".actionbutton").html("Enregistrer");
          });

          $(document).delegate("#Edit","click",function(e){
              $.post("./CommercialeUpdate",{
                  id:$(".editmodale input[name='id']").val(),
                  nom:$(".editmodale input[name='nom']").val(),
                  prenom:$(".editmodale input[name='prenom']").val(),
                  email:$(".editmodale input[name='email']").val(),
                  identifiantLegale:$(".editmodale input[name='identifiantLegale']").val(),
                  statusEntreprise:$(".editmodale select[name='statusEntreprise']").val(),
                  role_id:$(".editmodale select[name='role_id']").val(),
                  superieur:$(".editmodale select[name='superieur']").val(),
                  compagnie:$(".editmodale input[name='compagnie']").val(),
                  tel:$(".editmodale input[name='tel']").val(),
                  etat:$(".editmodale select[name='etat']").val()
              },function(data){
                  tablef2.ajax.reload();
                  swal("Modifié !", data, "success");
                  $('#modalInfoCommerciale').modal('hide');
                  $.uniform.update();
              });
          });

          $(document).delegate("#Add_Commerciale","click",function(e){
                $("#formprestataire").trigger("reset");
                $.uniform.update();
                $(".modal-title").html("Ajouter Commerciale");
                $(".actionbutton").attr("id","Add");
                $(".actionbutton").html("Ajouter");
                $('#modalInfoCommerciale').modal('show');
          });


         $(document).delegate("#Add","click",function(e){
              $.post("./CommercialeAdd",{
                  nom:$(".editmodale input[name='nom']").val(),
                  prenom:$(".editmodale input[name='prenom']").val(),
                  email:$(".editmodale input[name='email']").val(),
                  identifiantLegale:$(".editmodale input[name='identifiantLegale']").val(),
                  statusEntreprise:$(".editmodale select[name='statusEntreprise']").val(),
                  role_id:$(".editmodale select[name='role_id']").val(),
                  superieur:$(".editmodale select[name='superieur']").val(),
                  compagnie:$(".editmodale input[name='compagnie']").val(),
                  tel:$(".editmodale input[name='tel']").val(),
                  etat:$(".editmodale select[name='etat']").val()
              },function(data){
                tablef2.ajax.reload();
                $("#formprestataire").trigger("reset");
                $('#modalInfoCommerciale').modal('hide');
                swal("Ajouté !", data, "success");
              });
          });

          $(document).delegate("#Send_Email","click",function(e){
              $.post("./CommercialeSendEmail",{
                  email:$(".editmodale input[name='emailTest']").val()
              },function(data){
                /*tablef2.ajax.reload();
                $('#modalInfoPrestataire').modal('hide');
                $("#formprestataire").trigger("reset");
                $.uniform.update();*/
                  
              });
          });

            $(document).delegate("#selectEtatChange","change",function(e){
                $.post("./CommercialeConfirme",{
                    id:$(this).attr("ref"),
                    etat:$('#selectEtatChange option:selected').val()
                },function(data){
                    tablef2.ajax.reload();
                    if(data.etat == "Confirme")
                        swal("Ajouté !", data, "success");
                    else
                        swal("Suspendue !", data, "success");
                    $.uniform.update();
                });
            });
      });
  </script>
@endsection