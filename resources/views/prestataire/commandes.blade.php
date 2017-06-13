@extends('layouts.prestataire')

@section('title',"Préstataire - Catégories")

@section('js_css')
  <script type="text/javascript" src="{{asset('assets/js/plugins/tables/datatables/datatables.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('assets/js/plugins/forms/selects/select2.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('assets/js/plugins/forms/styling/uniform.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('assets/js/plugins/notifications/pnotify.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('js/prestataire/datatables_commandes.js')}}"></script>
@endsection

@section('content')

<div class="col-lg-12">
  <!-- Basic datatable -->
  <div class="panel panel-flat">
      <div class="panel-heading">
          <h6 class="panel-title">Commandes</h6>
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
              <th>Client</th>
              <th>Précision</th>
              <th>Montant</th>
              <th>Date</th>
              <th>Etat</th>
              <th></th>
          </tr>
          </thead>
          <tbody>

          </tbody>
      </table>
  </div>
  <!-- /basic datatable -->
</div>

<!-- Horizontal form modal -->
<div id="modal_theme_success" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">Horizontal form</h5>
            </div>
<!-- Horizontal borders -->
					<div class="panel panel-flat">

						<div class="table-responsive">
							<table class="table" id="produitsCommande">
								<thead>
									<tr>
										<th>#</th>
										<th>Produit</th>
										<th>Quantité</th>
										<th>Montant</th>
									</tr>
								</thead>
								<tbody>
									
								</tbody>
							</table>
						</div>
					</div>
					<!-- /horizontal borders -->
            
        </div>
    </div>
</div>
<!-- /horizontal form modal -->

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

          $(document).delegate("#InfosCommande","click",function(e){
              $(".modal-title").html("Liste des produit");
              $.get("./CommandeByID/"+$(this).attr("ref"),function(data){
                  //console.log(data);/*

                  var trHTML = '';
                
                    $.each(data, function (i, item) {
                        
                        trHTML += '<tr><td>'+(i+1)+'</td><td>' + data[i].produit_id + '</td><td>' + data[i].qte + '</td></td>'+ data[i].commande_id +'</tr>';
                    });
                    
                    $('#produitsCommande').append(trHTML);

                    $('#modal_theme_success').modal('show');
              });
          });

      });
  </script>
@endsection
