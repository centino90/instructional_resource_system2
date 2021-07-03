import $ from "jquery"
import popper from "popper.js"
import bootstrap from "bootstrap"
import fa from "@fortawesome/fontawesome-free"

import pdfMake from 'pdfmake';
import pdfFonts from 'pdfmake/build/vfs_fonts';
pdfMake.vfs = pdfFonts.pdfMake.vfs;

import dt from 'datatables.net-dt';
require('datatables.net-autofill-dt');
require('datatables.net-buttons/js/buttons.colVis.js');
require('datatables.net-buttons/js/buttons.html5.js');
require('datatables.net-buttons/js/buttons.print.js');
require('datatables.net-fixedheader-dt');
require('datatables.net-keytable-dt');
require('datatables.net-responsive-dt');
require('datatables.net-rowreorder-dt');
require('datatables.net-scroller-dt');
require('datatables.net-searchbuilder-dt');
require('datatables.net-searchpanes-dt');
require('datatables.net-select-dt');

// pdfmake
var docDefinition = {
    content: [
        'This paragraph fills full width, as there are no columns. Next paragraph however consists of three columns',
        {
            columns: [
                {
                    // auto-sized columns have their widths based on their content
                    width: 'auto',
                    text: 'First column'
                },
                {
                    // star-sized columns fill the remaining space
                    // if there's more than one star-column, available width is divided equally
                    width: '*',
                    text: 'Second column'
                },
                {
                    // fixed width
                    width: 100,
                    text: 'Third column'
                },
                {
                    // % width
                    width: '20%',
                    text: 'Fourth column'
                }
            ],
            // optional space between columns
            columnGap: 10
        },
        'This paragraph goes below all columns and has full width'
    ]
};

// pdfMake.createPdf(docDefinition).download()

// modal tabpane
$('.tab-prev').click(function () {
    $('.syllabus-tabs a[data-toggle="pill"].active').parent().prev().children().tab('show')
})
$('.tab-next').click(function () {
    $('.syllabus-tabs a[data-toggle="pill"].active').parent().next().children().tab('show')
})
$('a[data-toggle="pill"]').on('shown.bs.tab', function (event) {
    let currentTabLink = $(event.target)
    // event.relatedTarget // previous active tab

    let currentTabItem = currentTabLink.parent()[0]
    let firstTabItem = $('.syllabus-tabs .nav-pills').children(':first-child')[0]
    let lastTabItem = $('.syllabus-tabs .nav-pills').children(':last-child')[0]

    if (currentTabItem == firstTabItem) {
        $('.tab-prev').addClass('disabled')
        $('.tab-next').removeClass('disabled')
        $('.tab-next').fadeIn()
        $('#modal-syllabus .btn-submit').fadeOut(0)
    } else if (currentTabItem == lastTabItem) {
        $('.tab-prev').removeClass('disabled')
        $('.tab-next').addClass('disabled')
        $('.tab-next').fadeOut(0)
        $('#modal-syllabus .btn-submit').fadeIn()
    }
    else {
        $('.tab-btn').removeClass('disabled')
        $('.tab-next').fadeIn()
        $('#modal-syllabus .btn-submit').fadeOut(0)
    }
})

// scroller
$(window).scroll(function (event) {
    let current_y_pos = event.currentTarget.scrollY
    if (current_y_pos >= 30) {
        $('html').addClass('scrolled')
    } else {
        $('html').removeClass('scrolled')
    }
});

// activiate bs4 tooltip
$(function () {
    $('[data-toggle="tooltip"]').tooltip()
})

// trigger bs4 toast
$('.toast').toast('show')

// sidebar-nav-collapse

//default
if (window.innerWidth <= 1210) {
    $('html').addClass('sidebar-nav-collapsed')
}
//during screen-width change
$(window).resize(function (event) {
    if (window.innerWidth <= 1210) {
        $('html').addClass('sidebar-nav-collapsed')
    } else {
        $('html').removeClass('sidebar-nav-collapsed')
    }
})
//during sidebar btn trigger
$('.sidebar-nav-btn').click(function () {
    $('html').toggleClass('sidebar-nav-collapsed')
})


$('.dashboard-table').each(function (index, element) {
    $(element).find('table').DataTable({
        // responsive: true,
        "pageLength": 10,
        "language": {
            "paginate": {
                "previous": "<i class='fas fa-arrow-left'></i>",
                "next": "<i class='fas fa-arrow-right'></i>"
            }
        },
        "aaSorting": [],
        dom: '<"toolbar">Bilrtp',
        autofill: true,
    });

    $("div.toolbar").html(
        `
            <div class="table-search-input form-group with-icon m-0">
            <i class="fa fa-search">
            </i>
            <input type="text" class="form-control form-control-sm" placeholder="search anything">
            </div>
            `
    );

    $('.table-search-input input').on('keyup', function () {
        $('.dashboard-table:eq(0)').find('table').DataTable().search(this.value).draw();
    });
})

{/* <div class="table-search-input input-group input-group-sm">
<div class="input-group-prepend">
    <span class="input-group-text bg-white border-right-0">
        <i class="fa fa-search"></i>
    </span>
</div>
<input type="text" class="form-control border-left-0" placeholder="search by any">
</div> */}

// list-group-actions
$('a[data-toggle="list"]').on('shown.bs.tab', function (event) {
    let list_item = event.target.textContent

    $('.main-content .breadcrumb-item.active').text(list_item)

    // reset table search keyup listener
    $('.table-search-input input').on('keyup', function () {
        $('.dashboard-table:eq(0)').find('table').DataTable().search(this.value).draw();
    });
})

// list-group-actions + tabs
$('a[data-toggle="list"]:eq(0)').click(function () {
    if (repeatsPosition($(".dashboard-table.all")[0])) return

    $(".dashboard-table.all").insertBefore($(".dashboard-table:eq(0)")).hide().show('slow');
    $(".dashboard-table:eq(1)").hide()
    $(".dashboard-table:eq(2)").hide()
})
$('a[data-toggle="list"]:eq(1)').click(function () {
    if (repeatsPosition($(".dashboard-table.report-summary")[0])) return

    $(".dashboard-table.report-summary").insertBefore($(".dashboard-table:eq(0)")).hide().show('slow');
    $(".dashboard-table:eq(1)").hide()
    $(".dashboard-table:eq(2)").hide()
})
$('a[data-toggle="list"]:eq(2)').click(function () {
    if (repeatsPosition($(".dashboard-table.report-summary2")[0])) return

    $(".dashboard-table.report-summary2").insertBefore($(".dashboard-table:eq(0)")).hide().show('slow');
    $(".dashboard-table:eq(1)").hide()
    $(".dashboard-table:eq(2)").hide()
})

function repeatsPosition(firstPosition) {
    let secondPosition = $('.dashboard-table')[0];
    if (firstPosition == secondPosition) {
        return true
    }
}
