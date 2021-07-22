<nav class="left-sidebar-nav-sub">
    <header class="dropright d-flex justify-content-between align-items-center mb-4 px-2">
        Filters
        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-resource" modal-type="create"
            modal-title="Create resource" modal-route="{{ route('instructionalResource.showResourceModal') }}">
            NEW
            <i class="fa fa-chevron-circle-down pl-1"></i>
        </button>
        <div class="dropdown-menu dropdown-menu-right">
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal-subject">New
                Subject</a>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal-teacher">New
                Teacher</a>
        </div>
    </header>

    <section class="navs-wrapper">
        <ul class="nav list-group" role="tablist">
            <li class="nav-item">
                <a class="nav-link list-group-item-action p-2 active" data-toggle="list" href="#all" role="tab"
                    aria-controls="home">
                    <i class="fa fa-home mr-2 text-center"></i>
                    All
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link list-group-item-action p-2" data-toggle="list" href="#report-summary" role="tab"
                    aria-controls="home">
                    <i class="fa fa-home mr-2 text-center"></i>
                    Reports Summary
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link list-group-item-action p-2" data-toggle="list" href="#submissions" role="tab"
                    aria-controls="profile">
                    <i class="fa fa-home mr-2 text-center"></i>
                    Submissions
                </a>
            </li>
        </ul>

        <hr>

        @yield('nav-sub-list')
    </section>
</nav>
