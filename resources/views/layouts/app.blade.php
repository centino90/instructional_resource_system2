<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
        crossorigin="anonymous" />

    <script>
        let currentUser = 1
        if (currentUser === 1) {
            document.documentElement.style.setProperty('--sidebar-bg', '#202434', 'important')
        } else {
            document.documentElement.style.setProperty('--sidebar-bg', '#49112d', 'important')
        }

    </script>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
    <style>

    </style>
</head>

<body>
    <div class="wrapper">
        <aside class="left-sidebar sticky-top">
            @include('layouts.shared.left-sidebar-nav-main')
            @include('layouts.shared.left-sidebar-nav-sub')
        </aside>
        <main class="main-content">
            <header class="sticky-top bg-light d-flex justify-content-between align-items-center mb-4 px-3 py-4">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb align-items-center p-0 m-0 bg-transparent">
                        @yield('breadcrumb-item')
                    </ol>
                </nav>
                <div class="page-actions-container">
                    @yield('page-action')
                </div>
            </header>
            <section class="mb-5 px-3">
                @yield('content')
            </section>
        </main>
    </div>


    <!-- OFFSCREENS -->

    <!-- Toasts -->

    @if ($errors->any())
        <div class="toast toast-danger hide" role="alert" aria-live="assertive" aria-atomic="true" id="liveToast"
            data-delay='4000'>
            <div class="toast-body">
                @foreach ($errors->all() as $error)
                    <span>{{ $error }}</span>
                    <br>
                @endforeach
            </div>
        </div>
    @endif

    @if (session('status'))
        <section class="toast-wrapper">
            <div class="toasts">
                <div class="toast toast-success hide" role="alert" aria-live="assertive" aria-atomic="true"
                    id="liveToast" data-delay='6000'>
                    <div class="toast-body">
                        {{ session('status') }}
                    </div>
                </div>
            </div>
        </section>
    @endif
    <!-- Modals -->

    <div class="modal" id="modal-resource" tabindex="-1" aria-hidden="true" data-backdrop="static"
        data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header py-4">
                    <h5 class="modal-title">Create resource</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" data-toggle="tooltip"
                        data-placement="right" title="Close modal">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="create-resource instructional-tabpane container">
                        <div class="list-group flex-row row bg-light" role="tablist">
                            <div class="col list-group-item-action border p-4" data-toggle="list" href="#syllabus"
                                role="tab" modal-title="Syllabus">
                                <img src="{{ asset('assets/svg-syllabus.svg') }}" alt="syllabus"
                                    class="img-fluid rounded mx-auto d-block">
                                <span class="position-absolute">Syllabus</span>
                            </div>
                            <div class="col list-group-item-action border p-4" data-toggle="list" href="#activity"
                                role="tab" modal-title="Activity">
                                <img src="{{ asset('assets/svg-activity.svg') }}" alt="activity"
                                    class="img-fluid rounded mx-auto d-block" style="height: 100px;">
                                <span class="position-absolute">Activity</span>
                            </div>
                            <div class="col list-group-item-action border p-4" data-toggle="list" href="#activity"
                                role="tab" modal-title="Quiz">
                                <img src="{{ asset('assets/svg-quiz.svg') }}" alt="quiz"
                                    class="img-fluid rounded mx-auto d-block" style="height: 100px;">
                                <span class="position-absolute">Quiz</span>
                            </div>

                            <div class="w-100"></div>

                            <div class="col list-group-item-action border p-4" data-toggle="list" href="#activity"
                                role="tab" modal-title="Assignment">
                                <img src="{{ asset('assets/svg-assignment.svg') }}" alt="assignment"
                                    class="img-fluid rounded mx-auto d-block" style="height: 100px;">
                                <span class="position-absolute">Assignment</span>
                            </div>
                            <div class="col list-group-item-action border p-4" data-toggle="list" href="#activity"
                                role="tab" modal-title="PPT">
                                <img src="{{ asset('assets/svg-ppt.svg') }}" alt="ppt"
                                    class="img-fluid rounded mx-auto d-block" style="height: 100px;">
                                <span class="position-absolute">PPT</span>
                            </div>
                            <div class="col list-group-item-action border p-4" data-toggle="list" href="#activity"
                                role="tab" modal-title="Exam">
                                <img src="{{ asset('assets/svg-exam.svg') }}" alt="exam"
                                    class="img-fluid rounded mx-auto d-block" style="height: 100px;">
                                <span class="position-absolute">Exam</span>
                            </div>
                        </div>
                    </div>

                    <section class="instructional-tabpane syllabus-tabs" id="syllabus" style="display: none">
                        <ul class="main-tablist nav nav-pills bg-light border-bottom overflow-hidden px-3"
                            role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link py-2 active" id="pills-home-tab" data-toggle="pill"
                                    href="#pills-home" role="tab" aria-controls="pills-home"
                                    aria-selected="true">Chapter 1</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link py-2" id="pills-profile-tab" data-toggle="pill" href="#pills-profile"
                                    role="tab" aria-controls="pills-profile" aria-selected="false">Chapter 2</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link py-2" id="pills-contact-tab" data-toggle="pill" href="#pills-contact"
                                    role="tab" aria-controls="pills-contact" aria-selected="false">Chapter 3</a>
                            </li>
                        </ul>

                        <div class="alert alert-danger mx-3 mt-3 mb-0 collapse" role="alert" id="alert-warning">
                            <div class="alert-icon">
                                <i class="fa fa-exclamation-circle"></i>
                            </div>
                            <strong>There is a problem with some of your inputs.</strong> You should check in on
                            those
                            fields below.
                        </div>

                        <form class="syllabus-form tab-content px-3 py-4" method="POST"
                            action="{{ route('syllabus.store') }}" novalidate>
                            @csrf
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                aria-labelledby="pills-home-tab">
                                <h6 class="mb-4">Chapter 1</h6>
                                <div class="form-group row">
                                    <label for="staticEmail"
                                        class="col-sm-2 col-form-label col-form-label-sm small">Email</label>
                                    <div class="col-sm-10">
                                        <input name="email" type="email" class="form-control form-control-sm" required>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword"
                                        class="col-sm-2 col-form-label col-form-label-sm">Password</label>
                                    <div class="col-sm-10">
                                        <input name="password" type="password" class="form-control form-control-sm">
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label col-form-label-sm">Firstname</label>
                                    <div class="col-sm-10">
                                        <input name="firstname" type="text" class="form-control form-control-sm">
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label col-form-label-sm">Lastname </label>
                                    <div class="col-sm-10">
                                        <input name="lastname" type="text" class="form-control form-control-sm">
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade show" id="pills-profile" role="tabpanel"
                                aria-labelledby="pills-profile-tab">
                                <h6 class="mb-4">Chapter 2</h6>
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Your
                                        grade 1st semester</label>
                                    <div class="col-sm-9">
                                        <input name="grade_first_sem" type="text" class="form-control form-control-sm">
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-3 col-form-label col-form-label-sm">Your
                                        grade 2nd semester</label>
                                    <div class="col-sm-9">
                                        <input name="grade_second_sem" type="text" class="form-control form-control-sm">
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label col-form-label-sm">Class
                                        description</label>
                                    <div class="col-sm-9">
                                        <textarea name="class_description"
                                            class="form-control form-control-sm"></textarea>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label col-form-label-sm">Year level </label>
                                    <div class="col-sm-9">
                                        <select name="year_level" class="form-control form-control-sm" required>
                                            <option value="" disabled selected>choose a year level</option>
                                            <option>First Year</option>
                                            <option>Second Year</option>
                                            <option>Third Year</option>
                                            <option>Fourth Year</option>
                                        </select>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade show" id="pills-contact" role="tabpanel"
                                aria-labelledby="pills-contact-tab">
                                <h6 class="mb-4">Chapter 3</h6>
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Section
                                        name</label>
                                    <div class="col-sm-9">
                                        <input name="section" type="text" class="form-control form-control-sm">
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">No.
                                        of students</label>
                                    <div class="col-sm-9">
                                        <input name="student_count" type="number" class="form-control form-control-sm">
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-3 col-form-label col-form-label-sm">Room
                                        No.</label>
                                    <div class="col-sm-9">
                                        <input name="room_no" type="number" class="form-control form-control-sm">
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label col-form-label-sm">Building No.</label>
                                    <div class="col-sm-9">
                                        <input name="building_no" type="number" class="form-control form-control-sm">
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer pt-4">
                                <button type="button" class="btn btn-light btn-sm tab-btn tab-prev disabled">
                                    <i class="fa fa-arrow-left pr-1"></i>
                                    Previous
                                </button>
                                <button type="button" class="btn btn-primary btn-sm tab-btn tab-next">
                                    <i class="fa fa-arrow-right pr-1"></i>
                                    Next
                                </button>
                                <button type="submit" class="btn btn-primary btn-sm btn-submit" style="display:none">
                                    <i class="fa fa-file-upload pr-1"></i>
                                    Save
                                </button>
                            </div>
                        </form>
                    </section>

                    <section class="instructional-tabpane border-top" id="activity" style="display: none">

                        <div class="alert alert-danger mx-3 mt-3 mb-0 collapse" role="alert" id="alert-warning">
                            <div class="alert-icon">
                                <i class="fa fa-exclamation-circle"></i>
                            </div>
                            <strong>There is a problem with some of your inputs.</strong> You should check in on
                            those
                            fields below.
                        </div>

                        <form class="resource-form tab-content px-3 py-4 mt-2"
                            action="{{ route('instructionalResource.store') }}" novalidate>
                            @csrf

                            <div class="form-group row collapse">
                                <div class="col-sm-10">
                                    <select name="resource_type" class="form-control form-control-sm" hidden>
                                        <option value="activity"></option>
                                        <option value="quiz"></option>
                                        <option value="assignment"></option>
                                        <option value="ppt"></option>
                                        <option value="exam"></option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-2 col-form-label col-form-label-sm">Files</label>
                                <div class="col-sm-10">
                                    <input type="file" name="file" class="filepond" id="resource-file-input"
                                        data-allow-reorder="true" data-max-files="3" multiple>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail"
                                    class="col-sm-2 col-form-label col-form-label-sm">Subject</label>
                                <div class="col-sm-10">
                                    <input name="subject" type="text" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword"
                                    class="col-sm-2 col-form-label col-form-label-sm">Password</label>
                                <div class="col-sm-10">
                                    <textarea name="description" class="form-control form-control-sm"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer pt-3">
                                <button type="button" class="btn-cancel btn btn-sm">
                                    Cancel
                                </button>
                                <button type="submit" class="btn-submit btn btn-primary btn-sm">
                                    <i class="fa fa-file-upload pr-1"></i>
                                    Save
                                </button>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="modal fade" id="modal-syllabus" tabindex="-1" aria-hidden="true" data-backdrop="static"
        data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title form-title">Create Syllabus</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" data-toggle="tooltip"
                        data-placement="right" title="Close modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <section class="syllabus-tabs">
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item small" role="presentation">
                                <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home"
                                    role="tab" aria-controls="pills-home" aria-selected="true">Chapter 1</a>
                            </li>
                            <li class="nav-item small" role="presentation">
                                <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile"
                                    role="tab" aria-controls="pills-profile" aria-selected="false">Chapter 2</a>
                            </li>
                            <li class="nav-item small" role="presentation">
                                <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact"
                                    role="tab" aria-controls="pills-contact" aria-selected="false">Chapter 3</a>
                            </li>
                        </ul>
                        <form class="tab-content" id="pills-tabContent">
                            <div class="alert alert-warning alert-dismissible collapse" role="alert" id="alert-warning">
                                <div class="alert-icon">
                                    <i class="fa fa-exclamation-circle"></i>
                                </div>
                                <strong>There is a problem with some of your inputs.</strong> You should check in on
                                those
                                fields below.
                                <button type="button" class="close" data-toggle="collapse" data-target="#alert-warning"
                                    aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                aria-labelledby="pills-home-tab">
                                <div class="form-group row">
                                    <label for="staticEmail"
                                        class="col-sm-2 col-form-label col-form-label-sm">Email</label>
                                    <div class="col-sm-10">
                                        <input name="email" type="email" class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword"
                                        class="col-sm-2 col-form-label col-form-label-sm">Password</label>
                                    <div class="col-sm-10">
                                        <input name="password" type="password" class="form-control form-control-sm">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label col-form-label-sm">Firstname</label>
                                    <div class="col-sm-10">
                                        <input name="fname" type="text" class="form-control form-control-sm">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label col-form-label-sm">Lastname </label>
                                    <div class="col-sm-10">
                                        <input name="lname" type="text" class="form-control form-control-sm">
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade show" id="pills-profile" role="tabpanel"
                                aria-labelledby="pills-profile-tab">
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Your
                                        grade 1st semester</label>
                                    <div class="col-sm-9">
                                        <input name="grade1" type="text" class="form-control form-control-sm">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-3 col-form-label col-form-label-sm">Your
                                        grade 2nd semester</label>
                                    <div class="col-sm-9">
                                        <input name="grade2" type="text" class="form-control form-control-sm">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label col-form-label-sm">Class
                                        description</label>
                                    <div class="col-sm-9">
                                        <textarea name="description" class="form-control form-control-sm"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label col-form-label-sm">Year level </label>
                                    <div class="col-sm-9">
                                        <select name="level" class="form-control form-control-sm" required>
                                            <option value="" disabled selected>choose a year level</option>
                                            <option>First Year</option>
                                            <option>Second Year</option>
                                            <option>Third Year</option>
                                            <option>Fourth Year</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade show" id="pills-contact" role="tabpanel"
                                aria-labelledby="pills-contact-tab">
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Section
                                        name</label>
                                    <div class="col-sm-9">
                                        <input name="sectionName" type="text" class="form-control form-control-sm">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">No.
                                        of students</label>
                                    <div class="col-sm-9">
                                        <input name="studentNo" type="number" class="form-control form-control-sm">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-3 col-form-label col-form-label-sm">Room
                                        No.</label>
                                    <div class="col-sm-9">
                                        <input name="roomNo" type="number" class="form-control form-control-sm">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label col-form-label-sm">Building No.</label>
                                    <div class="col-sm-9">
                                        <input name="buildingNo" type="number" class="form-control form-control-sm">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </section>
                    <div class="modal-footer px-0 mx-0">
                        <button type="button" class="btn btn-light btn-sm tab-btn tab-prev disabled">
                            <i class="fa fa-arrow-left"></i>
                            Previous
                        </button>
                        <button type="button" class="btn btn-primary btn-sm tab-btn tab-next">
                            Next
                            <i class="fa fa-arrow-right"></i>
                        </button>
                        <button type="submit" class="btn btn-primary btn-sm btn-submit"
                            style="display:none">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-subject" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title form-title">Create Subject</h5>
                    <button type="button" class="close" data-dismiss="modal" data-toggle="tooltip"
                        data-placement="right" title="Close modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" class="was-validated">
                    <div class="modal-body">
                        <!-- <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <div class="alert-icon">
                                <i class="fa fa-exclamation-circle"></i>
                            </div>
                            <strong>There is a problem with some of your inputs.</strong> You should check in on those
                            fields below.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div> -->
                        <div class="form-group with-icon">
                            <i class="fa fa-folder">
                            </i>
                            <input type="text" class="form-control form-control-sm w-sm" placeholder="subject name"
                                required>
                        </div>
                        <hr>
                        <div class="form-group with-icon">
                            <i class="fa fa-list-ol">
                            </i>
                            <select name="" class="form-control form-control-sm w-sm" required>
                                <option value="" disabled selected>choose a year level</option>
                                <option>First Year</option>
                                <option>Second Year</option>
                                <option>Third Year</option>
                                <option>Fourth Year</option>
                            </select>
                        </div>
                        <div class="form-group with-icon">
                            <i class="fa fa-sort-amount-down">
                            </i>
                            <select name="" class="form-control form-control-sm w-sm" required>
                                <option value="" disabled selected>select a term</option>
                                <option>First Term</option>
                                <option>Second Term</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-light btn-sm btn-loading">Reset</button>
                        <button type="submit" class="btn btn-primary btn-sm btn-loading">Submit subject</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-teacher" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create Teacher</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" data-toggle="tooltip"
                        data-placement="right" title="Close modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="spinner">
                        <span class="spinner-grow text-primary" role="status">
                        </span>
                        <span class="spinner-grow text-primary" role="status">
                        </span>
                        <span class="spinner-grow text-primary" role="status">
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <script src="{{ asset('js/app.js') }}"></script>
    @yield('script')
    <script>
        $(document).ready(function() {
            let resourceFilePond = FilePond.create(
                $('#resource-file-input')[0]
            )
            resourceFilePond.setOptions({
                labelIdle: 'Drag & Drop your files or <span class="filepond--label-action"> Browse </span><br><i class="fas fa-cloud-upload-alt"></i>',
                allowMultiple: true,
                credits: false,
                server: {
                    url: 'http://localhost:8000',
                    process: {
                        url: '/uploadTemporaryFiles',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    },
                    revert: (uniqueFileId, load, error) => {
                        $.ajax({
                                url: `/uploadTemporaryFiles/${uniqueFileId}`,
                                method: "DELETE",
                                data: {
                                    _token: '{{ csrf_token() }}'
                                }
                            })
                            .done(function(data) {
                                console.log(data)
                            })

                        error('oh my goodness')
                        load()
                    },
                }
            })
        })

    </script>
</body>

</html>
