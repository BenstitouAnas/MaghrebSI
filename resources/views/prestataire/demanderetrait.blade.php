@extends('layouts.prestataire')

@section('title',"Présstataire - Demander Retrait")

@section('path1',"Solde")

@section('path2',"Demander Retrait")

@section('js_css')

@endsection

@section('content')

<div class="row">


    <div class="col-md-6">
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h6 class="panel-title">Historique Retraits</h6>
                <div class="heading-elements">
                    <ul class="icons-list">
                        <li><a data-action="collapse"></a></li>
                        <li><a data-action="reload"></a></li>
                        <li><a data-action="close"></a></li>
                    </ul>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-striped" id="listRetraits">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Montant</th>
                            <th>Etat</th>
                            <th>Facture</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php($index=1)
                        @foreach($retraits as $retrait)
                        <tr>
                            <td>{{$index}}</td>
                            <td>{{$retrait->montant }}</td>

                            @if($retrait->etat=="envoye")
                            <td><span class="label label-primary">Envoyé</span></td>
                            @endif
                            @if($retrait->etat=="valide")
                                <td><span class="label label-success">Validé</span></td>
                            @endif
                            @if($retrait->etat=="revise")
                                <td><span class="label label-danger">Revisé</span></td>
                            @endif

                            <td>
                                <a>
                                    <span class="label label-default">File
                                        <i class="fa fa-file" aria-hidden="true"></i>
                                    </span>
                                </a>
                            </td>
                            <td>{{$retrait->created_at}}</td>
                        </tr>
                        @php($index++)
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h6 class="panel-title">Demander un Retrait</h6>
                <div class="heading-elements">
                    <ul class="icons-list">
                        <li><a data-action="collapse"></a></li>
                        <li><a data-action="reload"></a></li>
                        <li><a data-action="close"></a></li>
                    </ul>
                </div>
            </div>

            <div class="panel-body">
            <form class="form-horizontal" id="formDemande">
                <div class="form-group">
                    <label class="control-label col-lg-2">Montant</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" placeholder="Montant..." name="montant" id="montant">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-2">Facture</label>
                    <div class="col-lg-10">
                        <div class="uploader"><input id="facture" type="file" class="file-styled-primary" ><span class="filename" style="user-select: none;" id="nomFacture">Pas de facture</span><span class="action btn bg-blue" style="user-select: none;">Choisir Fichier</span></div>
                    </div>
                </div>

                <div class="text-right">
                    <button type="submit" class="btn btn-primary" id="demander">Demander <i class="icon-arrow-right14 position-right"></i></button>
                </div>

            </fomr>
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
        
        $(document).delegate("#facture","change",function(e){
            $("#nomFacture").text(e.target.files[0].name);
        });

        $(document).delegate("#demander","click",function(e){
              $.post("./DemanderRetrait",{
                    montant:$("[id=montant]").val(),
                    facture:$("#nomFacture").text()
              },function(data, status){
                    //tablef.ajax.reload();
                    //$( "#listRetraits" ).load( "demanderetrait.blade.php #listRetraits" );
                    //swal("Ajouté !", data, "success");
                    $("#formDemande").trigger("reset");
              });
          });
      });
  </script>
@endsection