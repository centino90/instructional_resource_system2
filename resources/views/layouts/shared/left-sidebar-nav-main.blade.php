<nav class="left-sidebar-nav-main">
    <header class="d-flex justify-content-between align-items-center mb-4 px-2">
        <span href="#" class="text-primary">Dean's Panel</span>
        <button type="button" class="sidebar-nav-btn btn" data-toggle="tooltip" title="Collapse sidebar">
            <i class="fa fa-bars"></i>
        </button>
    </header>
    <ul class="nav flex-column overflow-hidden">
        <li class="nav-item">
            <a class="nav-link px-2 pb-3 active" href="#">
                <i class="fa fa-home mr-2 text-center"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link px-2 py-3" href="#">
                <i class="fa fa-file-alt mr-2 text-center"></i>
                <span>Syllabus</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link px-2 py-3" href="#">
                <i class="fa fa-home mr-2 text-center"></i>
                <span>Resources</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link px-2 py-3" href="#">
                <i class="fa fa-folder mr-2 text-center"></i>
                <span>Subjects</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link px-2 py-3" href="#">
                <i class="fa fa-users mr-2 text-center"></i>
                <span>Teachers</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link px-2 py-3" href="#">
                <i class="fa fa-chart-bar mr-2 text-center"></i>
                <span>Reports</span>
            </a>
        </li>
    </ul>
    <ul class="account-nav nav flex-column overflow-hidden w-100">
        <li class="nav-item">
            <a class="nav-link px-2 py-3" href="#">
                <i class="fa fa-sign-out-alt mr-2 text-center"></i>
                <span>Signout</span>
            </a>
        </li>
        <a href="#" class="my-account d-flex btn btn-dark rounded-0 px-2 py-3">
            <div class="img-container rounded-circle overflow-hidden text-center">
                <img class="w-100" src="{{ asset('assets/tower.svg') }}" alt="">
            </div>
            <div class="details-container ml-2 text-left">
                <small class="d-block text-primary">Anthony Ansit (Dean)</small>
                <small class="d-block text-light">ansit101</small>
            </div>
        </a>
    </ul>
</nav>
