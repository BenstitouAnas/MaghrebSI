/* ------------------------------------------------------------------------------
 *
 *  # Basic datatables
 *
 *  Specific JS code additions for datatable_basic.html page
 *
 *  Version: 1.0
 *  Latest update: Aug 1, 2015
 *
 * ---------------------------------------------------------------------------- */

$(function() {


    // Table setup
    // ------------------------------

    // Setting datatable defaults

    $.extend($.fn.dataTable.defaults, {
        autoWidth: false,
        columnDefs: [{
            orderable: false,
            width: '100px',
            targets: [5]
        }],
        dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
        language: {
            search: '<span>Filtrer:</span> _INPUT_',
            lengthMenu: '<span>Afficher:</span> _MENU_',
            paginate: {
                'first': 'First',
                'last': 'Last',
                'next': '&rarr;',
                'previous': '&larr;'
            }
        },
        drawCallback: function() {
            $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group')
                .addClass('dropup');
        },
        preDrawCallback: function() {
            $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group')
                .removeClass('dropup');
        }
    });


    tablef = $('.datatable-basic2').DataTable({
        "columnDefs": [
            { "visible": false, "targets": 0 }
        ],
        "order": [
            [0, 'asc']
        ],
        processing: true,
        serverSide: true,
        ajax: './CommercialesData',
        columns: [
            { data: 'role', name: 'role' },
            { data: 'nom', name: 'nom' },
            { data: 'prenom', name: 'prenom' },
            { data: 'email', name: 'email' },
            { data: 'etat', name: 'etat' },
            { data: 'action', name: 'action' }
        ],
        "displayLength": 25,
        "drawCallback": function(settings) {
            var api = this.api();
            var rows = api.rows({ page: 'current' }).nodes();
            var last = null;

            api.column(0, { page: 'current' }).data().each(function(group, i) {
                if (last !== group) {
                    $(rows).eq(i).before(
                        '<tr class="bg-grey-300"><td colspan="5" style="text-shadow:0px 0px 4px rgba(0, 0, 0, 0.56); color:#fff; font-weight:500"><i></i>' + group + '</td></tr>'
                    );

                    last = group;
                }
            });
            $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').addClass('dropup');
        }
    });


    tablef2 = $('.datatable-basic22').DataTable({
        "columnDefs": [
            { "visible": false, "targets": 0 }
        ],
        "order": [
            [0, 'asc']
        ],
        processing: true,
        serverSide: true,
        ajax: './DemandesData',
        columns: [
            { data: 'role', name: 'role' },
            { data: 'nom', name: 'nom' },
            { data: 'prenom', name: 'prenom' },
            { data: 'email', name: 'email' },
            { data: 'etat', name: 'etat' },
            { data: 'action', name: 'action' }
        ],
        "displayLength": 25,
        "drawCallback": function(settings) {
            var api = this.api();
            var rows = api.rows({ page: 'current' }).nodes();
            var last = null;

            api.column(0, { page: 'current' }).data().each(function(group, i) {
                if (last !== group) {
                    $(rows).eq(i).before(
                        '<tr class="bg-grey-300"><td colspan="5" style="text-shadow:0px 0px 4px rgba(0, 0, 0, 0.56); color:#fff; font-weight:500"><i></i>' + group + '</td></tr>'
                    );

                    last = group;
                }
            });
            $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').addClass('dropup');
        }
    });



    // Alternative pagination
    $('.datatable-pagination').DataTable({
        pagingType: "simple",
        language: {
            paginate: {
                'Suivant': 'Next &rarr;',
                'Précédant': '&larr; Prev'
            }
        }
    });


    // Datatable with saving state
    $('.datatable-save-state').DataTable({
        stateSave: true
    });


    // Scrollable datatable
    $('.datatable-scroll-y').DataTable({
        autoWidth: true,
        scrollY: 300
    });



    // External table additions
    // ------------------------------

    // Add placeholder to the datatable filter option
    $('.dataTables_filter input[type=search]').attr('placeholder',
        'Taper pour chercher...');


    // Enable Select2 select for the length option
    $('.dataTables_length select').select2({
        minimumResultsForSearch: Infinity,
        width: 'auto'
    });

});