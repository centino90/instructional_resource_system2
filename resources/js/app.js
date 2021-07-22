require('./bootstrap')

const GLOBAL_RULES = {
    inputsWithoutButtons: ':input:not([type="button"], [type="submit"], [type="reset"], button)',
    invalidInputsWithoutButtons: ':input:not([type="button"], [type="submit"], [type="reset"], button).is-invalid'
}

setTabToggler($('.left-sidebar-nav-sub *[data-toggle="list"]'), '.dashboard-table')
setTabToggler($('.create-resource *[data-toggle="list"]'), '.instructional-tabpane')
setNavPill()
setModalTabpaneActions()
setResourceFormSubmit()
setSyllabusFormSubmitWithPdf()
$('.toast').toast('show')
// $('*[data-toggle="popover"]').popover()

// modal tabpane
function setModalTabpaneActions() {
    $('.tab-next').click(function () {
        $('.syllabus-tabs a[data-toggle="pill"].active').parent().next().children().tab('show')
    })
    $('.tab-prev').click(function () {
        $('.syllabus-tabs a[data-toggle="pill"].active').parent().prev().children().tab('show')
    })
}

// modal submit
function setResourceFormSubmit() {
    $('.resource-form button[type="submit"]').click(function (event) {
        event.preventDefault()
        let modal = $('.modal')
        let form = $('.modal .resource-form')
        let formAction = form.attr('action')
        let submitBtn = $(this)
        let formInputs = getValueOfInputsByFormAndAttribute($(form), 'name')
        console.log(formInputs)
        let formData = new FormData()
        Object.keys(formInputs).forEach(
            key => formData.append(key, formInputs[key])
        )

        $.ajax({
            url: formAction,
            method: "POST",
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function (xhr) {
                form.addClass('submitted-once')
                $(modal).find('.alert:eq(0)').hide()
                submitBtn.addClass('btn-loading')
            }
        })
            .done(function (data) {
                console.log(data)
                modal.find('.modal-body').html(data)
                if (data.message === 'success') {
                    location.reload();
                }
            })
            .fail(function (data) {
                console.log(data)
                if (data.status === 422) {
                    let response = $.parseJSON(data.responseText)

                    $(modal).find('.alert:eq(0)').fadeIn()
                    showBackendValidationErrors(form, $(response.errors))
                    checkInvalidTabPaneInputsAndShowTabpaneFeedback($('#modal-resource .tab-content:eq(0) .tab-pane'))
                }
            })
            .always(function () {
                setDefaultValidations(form)
                submitBtn.removeClass('btn-loading')
            });

    })
}
function setSyllabusFormSubmitWithPdf() {
    $('.syllabus-form button[type="submit"]').click(function (event) {
        let modal = $('.modal')
        let form = $('.modal .syllabus-form')
        let formAction = form.attr('action')
        let formSubmitBtn = $(this)
        let formInputs = getValueOfInputsByFormAndAttribute($(form), 'name')
        event.preventDefault()

        createPdf(formInputs)
            .then(res => {
                res.getBlob(blob => {
                    let formData = new FormData()

                    Object.keys(formInputs).forEach(
                        key => formData.append(key, formInputs[key])
                    )

                    formData.append('pdf_data', blob)
                    $.ajax({
                        url: formAction,
                        method: "POST",
                        data: formData,
                        enctype: 'multipart/form-data',
                        contentType: false,
                        processData: false,
                        beforeSend: function (xhr) {
                            form.addClass('submitted-once')
                            $(modal).find('.alert:eq(0)').hide()
                            formSubmitBtn.addClass('btn-loading')
                        }
                    })
                        .done(function (data) {
                            // modal.find('.modal-body').html(data)
                            if (data.message === 'success') {
                                location.reload();
                            }
                        })
                        .fail(function (data) {
                            // console.log(data)
                            // alert('error')
                            if (data.status === 422) {
                                let response = $.parseJSON(data.responseText)

                                $(modal).find('.alert:eq(0)').fadeIn()
                                showBackendValidationErrors(form, $(response.errors))
                                checkInvalidTabPaneInputsAndShowTabpaneFeedback($('#modal-resource .tab-content:eq(0) .tab-pane'))
                            }
                        })
                        .always(function () {
                            setDefaultValidations(form)
                            formSubmitBtn.removeClass('btn-loading')
                        });
                })
            })
    })
}

function showBackendValidationErrors(form, errors) {
    let inputs = $(form).find(GLOBAL_RULES.inputsWithoutButtons)
    $.each(inputs, function (index, input) {
        if (errors[0][$(input).attr('name')]) {
            $(input).addClass('is-invalid')
            $(input).next().text(errors[0][$(input).attr('name')])
        } else {
            $(input).removeClass('is-invalid')
        }
    })
}

function setDefaultValidations(form) {
    let inputs = form.find(GLOBAL_RULES.inputsWithoutButtons)
    $.each(inputs, function (index, input) {
        $(input).change(function () {
            if (!$(this).val()) {
                $(input).addClass('is-invalid')
                $(input).next().text('This field is required!')
            } else {
                $(input).removeClass('is-invalid')
                $(input).next().text('')
            }
        })
    })
}

$('#modal-resource').on('show.bs.modal', function (event) {
    let button = $(event.relatedTarget)
    let type = button.attr('modal-type')
    let route = button.attr('modal-route')
    let modalBody = $(this).find('.modal-body');
    let title = $(this).find('.modal-title');

    title.text(button.attr('modal-title'))

    $.ajax({
        method: "GET",
        url: route,
        data: {
            reqType: type
        },
        beforeSend: function (xhr) {
            xhr.overrideMimeType("text/plain; charset=x-user-defined");
            // modalBody.html(`<div class="my-5 py-5 text-center w-100">
            //                 <div class="spinner-grow text-primary" role="status">
            //                     <span class="sr-only">Loading...</span>
            //                 </div>
            //                 <br>
            //                 Loading...
            //             </div>
            //             `);
        }
    })
        .done(function (data) {
            // modalBody.html(data);

            // setTabToggler($('.create-resource *[data-toggle="list"]'), '.instructional-tabpane')
            // setNavPill()
            // setModalFormSubmit()
            // setModalTabpaneActions()
            $('#modal-resource *[data-toggle="list"]').on('show.bs.tab', function (event) {
                title.text($(this).attr('modal-title'))
                $('#modal-resource button[data-dismiss="modal"]').attr('data-original-title', '')
                $('#modal-resource button[data-dismiss="modal"]').html(
                    `
                    <i class="fas fa-chevron-left"></i>
                    <span>Create resource</span>
                    `
                )
            })

        })
        .fail(function () {
            alert("error");
        })
        .always(function () { });
})



// scroller
$(window).scroll(function (event) {
    let current_y_pos = event.currentTarget.scrollY
    if (current_y_pos >= 30) {
        $('html').addClass('window-scrolled')
    } else {
        $('html').removeClass('window-scrolled')
    }
});

// sidebar-nav-collapse (default)
if (window.innerWidth <= 1210) {
    $('html').addClass('left-sidebar-nav-main-collapsed')
}
// during screen-width change
$(window).resize(function (event) {
    if (window.innerWidth <= 1210) {
        $('html').addClass('left-sidebar-nav-main-collapsed')
    } else {
        $('html').removeClass('left-sidebar-nav-main-collapsed')
    }
})
// during sidebar btn trigger
$('.sidebar-nav-btn').click(function () {
    $('html').toggleClass('left-sidebar-nav-main-collapsed')
})

// activiate bs4 tooltip
$('[data-toggle="tooltip"]').tooltip()

// activate jquery datatable on multiple tables
$('.dashboard-table').each(function (index, element) {
    $(element).find('table').DataTable({
        "pageLength": 10,
        "language": {
            "paginate": {
                "previous": "<i class='fas fa-arrow-left'></i>",
                "next": "<i class='fas fa-arrow-right'></i>"
            },
            "lengthMenu": 'Display <select>' +
                '<option value="10">10</option>' +
                '<option value="25">20</option>' +
                '<option value="-1">All</option>' +
                '</select>'

        },
        "aaSorting": [],
        dom: '<"searchbar">Bilrtp',
        autofill: true
    });

    $("div.searchbar").html(
        `
            <div class="table-search-input form-group with-icon m-0">
                <i class="fa fa-search">
                </i>
                <input type="text" class="form-control form-control-sm w-sm" placeholder="search anything" autofocus>
            </div>
        `
    );

    $('.table-search-input input').on('keyup', function () {
        $('.dashboard-table:eq(0)').find('table').DataTable().search(this.value).draw();
    });
})

$('#modal-resource').on('hide.bs.modal', function (event) {
    let targets = $('.instructional-tabpane')
    let firstTarget = $('.instructional-tabpane')[0]
    let target = $('.create-resource')

    if (firstTarget == target[0]) {
        return
    }

    event.preventDefault()

    $('#modal-resource *[data-toggle="list"]').removeClass('active')
    resetModalHeader('#modal-resource', 'Create resource')
    targets.hide()
    target.insertBefore(firstTarget).slideDown('slow');
})

function resetModalHeader(modal, modalTitle) {
    $(modal).find('.modal-title').text(modalTitle)
    $(modal).find('button[data-dismiss="modal"]').attr('data-original-title', 'Close modal')
    $(modal).find('button[data-dismiss="modal"]').html(`<i class="fas fa-times"></i>`)
}


// EVENT HOOKS

// list-group-action
$('*[data-toggle="list"]').on('shown.bs.tab', function (event) {
    let list_item = event.target.textContent

    $('.main-content .breadcrumb-item.active').text(list_item)

    // reset table search keyup listener
    // $('.table-search-input input').on('keyup', function () {
    //     $('.dashboard-table:eq(0)').find('table').DataTable().search(this.value).draw();
    // });
})

// nav-pill
function setNavPill() {
    $('a[data-toggle="pill"]').on('shown.bs.tab', function (event) {
        let form = $('#modal-resource form:eq(0)')
        let defaultFirstTabItem = $('.syllabus-tabs .nav-pills')
            .children(':first-child')[0]
        let defaultLastTabItem = $('.syllabus-tabs .nav-pills')
            .children(':last-child')[0]
        let currentTabLink = $(event.target)
        let currentTabItem = currentTabLink.parent()[0]
        let formSubmitBtn = $('#modal-resource .btn-submit:eq(0)');
        let previousTabLink = $(event.relatedTarget)
        let tabpane = $(previousTabLink.attr('href'))
        let invalidInputs = tabpane.find(GLOBAL_RULES.invalidInputsWithoutButtons)

        if (currentTabItem == defaultFirstTabItem) {
            $('.tab-prev').addClass('disabled')
            $('.tab-next').removeClass('disabled')
            $('.tab-next').fadeIn()
            formSubmitBtn.fadeOut(0)
        } else if (currentTabItem == defaultLastTabItem) {
            $('.tab-prev').removeClass('disabled')
            $('.tab-next').addClass('disabled')
            $('.tab-next').fadeOut(0)
            formSubmitBtn.fadeIn()
        }
        else {
            $('.tab-btn').removeClass('disabled')
            $('.tab-next').fadeIn()
            formSubmitBtn.fadeOut(0)
        }

        if (form.hasClass('submitted-once')) {
            if (invalidInputs.length > 0) {
                $(previousTabLink).addClass('invalid')
                $(previousTabLink).removeClass('valid')
            } else {
                $(previousTabLink).addClass('valid')
                $(previousTabLink).removeClass('invalid')
            }
        }

    })
}


// TRUE FUNCTIONS

async function createPdf(inputs) {
    var docDefinition = {
        content: [
            {
                alignment: 'center',
                text: 'Syllabus Sample',
                style: 'header',
                fontSize: 20,
                bold: true,
                margin: [0, 10],
            },
            {
                style: 'tableExample',
                layout: {
                    fillColor: function (rowIndex, node, columnIndex) {
                        return (rowIndex === 0) ? '#c2dec2' : null;
                    }
                },
                table: {
                    widths: ['50%', '50%'],
                    headerRows: 1,
                    body: [
                        [
                            {
                                text: `${inputs.firstname} ${inputs.lastname}`,
                                bold: true,
                                colSpan: 2,
                                fontSize: 9,
                            },
                            {
                            }
                        ],
                        [
                            {
                                text: [
                                    'Email: ',
                                    {
                                        text: `${inputs.email}`,
                                        bold: false
                                    }
                                ],
                                fontSize: 9,
                                bold: true
                            },
                            {
                                text: [
                                    'Password: ',
                                    {
                                        text: `${inputs.password}`,
                                        bold: false
                                    }
                                ],
                                fontSize: 9,
                                bold: true
                            }
                        ],
                        [
                            {
                                text: [
                                    'Year level: ',
                                    {
                                        text: `${inputs.year_level}`,
                                        bold: false
                                    }
                                ],
                                fontSize: 9,
                                bold: true
                            },
                            {
                                text: [
                                    'Class description: ',
                                    {
                                        text: `${inputs.class_description}`,
                                        bold: false
                                    }
                                ],
                                fontSize: 9,
                                bold: true
                            }
                        ],
                        [
                            {
                                text: [
                                    'Grade 1st semester: ',
                                    {
                                        text: `${inputs.grade_first_sem}`,
                                        bold: false
                                    }
                                ],
                                fontSize: 9,
                                bold: true
                            },
                            {
                                text: [
                                    'Grade 2nd semester: ',
                                    {
                                        text: `${inputs.grade_second_sem}`,
                                        bold: false
                                    }
                                ],
                                fontSize: 9,
                                bold: true
                            }
                        ],
                        [
                            {
                                text: [
                                    'Section name: ',
                                    {
                                        text: `${inputs.section}`,
                                        bold: false
                                    }
                                ],
                                fontSize: 9,
                                bold: true
                            },
                            {
                                text: [
                                    'No. of students: ',
                                    {
                                        text: `${inputs.student_count}`,
                                        bold: false
                                    }
                                ],
                                fontSize: 9,
                                bold: true
                            }
                        ],
                        [
                            {
                                text: [
                                    'Room no: ',
                                    {
                                        text: `${inputs.room_no}`,
                                        bold: false
                                    }
                                ],
                                fontSize: 9,
                                bold: true
                            },
                            {
                                text: [
                                    'Building no: ',
                                    {
                                        text: `${inputs.building_no}`,
                                        bold: false
                                    }
                                ],
                                fontSize: 9,
                                bold: true
                            }
                        ]
                    ]
                }
            }
        ]
    }

    return pdfMake.createPdf(docDefinition)
}


function getBase64ImageFromURL(url) {
    return new Promise((resolve, reject) => {
        let img = new Image();
        img.setAttribute("crossOrigin", "anonymous");

        img.onload = () => {
            var canvas = document.createElement("canvas");
            canvas.width = img.width;
            canvas.height = img.height;

            var ctx = canvas.getContext("2d");
            ctx.drawImage(img, 0, 0);

            var dataURL = canvas.toDataURL("image/png");

            resolve(dataURL);
        };

        img.onerror = error => {
            reject(error);
        };

        img.src = url;
    });
}

function getValueOfInputsByFormAndAttribute(form, attribute) {
    if (!form || !attribute) {
        throw new Error('Custom error: parameters are required')
    }

    let formInputsWithoutButtons = form.find(GLOBAL_RULES.inputsWithoutButtons)
    let allInputs = {}
    console.log(formInputsWithoutButtons)
    formInputsWithoutButtons.map(function () {
        let attr = $(this).attr(attribute) ?? $(this).attr('id')

        if (!$(this).attr(attribute) && $(this).attr('type') !== 'file') {
            throw new Error(`Custom error: all selected inputs should have this attribute`)
        }

        if ($(this).attr('type') === 'file') {
            $.each(this.files, function (index, file) {
                Object.assign(allInputs, { [attr]: file })
            })
        } else {
            Object.assign(allInputs, { [attr]: $(this).val() })
        }
    })

    return allInputs
}

function checkInvalidTabPaneInputsAndShowTabpaneFeedback(tabPane) {
    $.each($(tabPane), function (index, element) {
        let idData = '#' + $(element).attr('aria-labelledby')
        let invalidInputs = $(element).find(':input:not([name="_token"]).is-invalid')

        if (invalidInputs.length > 0) {
            $(idData).addClass('invalid')
            $(idData).removeClass('valid')
        } else {
            $(idData).addClass('valid')
            $(idData).removeClass('invalid')
        }
    })
}

function setTabToggler(togglers, sharedId) {
    if (!togglers || !sharedId) {
        throw new Error('Custom error: parameters are required')
    }

    $.each($(togglers), function (index, element) {
        $(element).click(function () {
            let targetId = $(element).attr('href')
            let targets = $(sharedId)
            let target = $(sharedId + targetId)
            let firstTarget = $(targets[0])

            if (target[0] == targets[0]) return

            targets.hide()
            target.insertBefore(firstTarget).show('slow');
        })

    })
}



