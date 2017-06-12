@extends('layouts.prestataire')

@section('title',"Préstataire - Produits")

@section('js_css')
  <script type="text/javascript" src="{{asset('assets/js/plugins/forms/styling/uniform.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('assets/js/plugins/notifications/pnotify.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('assets/js/pages/form_input_groups.js')}}"></script>

  <script type="text/javascript" src="{{asset('assets/js/plugins/forms/inputs/touchspin.min.js')}}"></script>
@endsection

@section('content')
<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">Ajouter un produit</h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div>
    </div>

    <div class="panel-body">
     
        <div class="form-horizontal" id="formAjoutProduit">

            <div class="form-group">
                <label class="control-label col-lg-2">Nom du Produit</label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" placeholder="Nom du Produit ..." name="libelle">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-lg-2">Type</label>
                <div class="col-lg-10">
                    <select name="type" class="form-control" id="selectType">
                        <option value="article">Article E-commerce</option>
                        <option value="booking">Booking</option>
                        <option value="deal">Deal</option>
                        <option value="prestation">Préstation</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-lg-2">Catégorie</label>
                <div class="col-lg-10">
                    <select name="categorie" class="form-control" id="selectCategorie">
                        @foreach ($categories as $categorie)
                            <option value="{{$categorie->id}}">{{$categorie->titre}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-lg-2">Documentation Technique</label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" placeholder="Documentation technique ..." name="documentationTechnique">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-lg-2">Image Produit</label>
                <div class="col-lg-10">
                    <div class="uploader">
                        <input id="imageProduit" type="file" class="file-styled-primary" name="image">
                        <span class="filename" style="user-select: none;" id="imagep">Pas d'image</span>
                        <span class="action btn bg-blue" style="user-select: none;">Choisir Fichier</span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-lg-2">Prix</label>
                <div class="col-lg-10">
                    <div class="input-group">
                        <input type="text" value="0" class="touchspin-prefix" name="prix" id="prix">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-lg-2">Quantité</label>
                <div class="col-lg-10">
                    <div class="input-group">
                        <input type="text" value="1" class="touchspin-no-mousewheel" name="qte" id="qte">
                    </div>
                </div>
            </div>

            <div class="text-right">
                <button type="reset" class="btn btn-default">Annuler </button>
                <button type="submit" class="btn btn-primary actionbutton" id="ajouterArticle">Ajouter <i class="icon-arrow-right14 position-right"></i></button>
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
                        window.location.replace("ProduitsByID/"+data);
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
                        window.location.replace("ProduitsByID/"+data);
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

                        window.location.replace("ProduitsByID/"+data);
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
                        window.location.replace("ProduitsByID/"+data);
                        $("#formAjoutProduit").trigger("reset");
                    });
          });

      });
  </script>
@endsection
