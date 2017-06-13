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


    // Basic datatable
    tablef = $('.datatable-basic').DataTable({
        "columnDefs": [{
            "width": "150px",
            "targets": 2
        }],
        processing: true,
        serverSide: true,
        ajax: './CommandesData',
        columns: [{
                data: 'client_id',
                name: 'client_id'
            }, {
                data: 'precision',
                name: 'precision'
            }, {
                data: 'montantTotalHT',
                name: 'montantTotalHT'
            }, {
                data: 'created_at',
                name: 'created_at'
            }, {
                data: 'etat',
                name: 'etat'
            },
            {
                data: 'action',
                name: 'action'
            }
        ]
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