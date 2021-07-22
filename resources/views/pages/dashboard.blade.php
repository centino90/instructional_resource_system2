@extends('layouts.app')

@section('nav-sub-list')
    <div class="col-12">
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
            </div>
            <div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list"></div>
            <div class="tab-pane fade" id="list-messages" role="tabpanel" aria-labelledby="list-messages-list">
            </div>
            <div class="tab-pane fade" id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">
            </div>
        </div>
    </div>
@endsection

@section('breadcrumb-item')
    <li class="breadcrumb-item">
        <a href="/" class="text-muted h5">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">All</li>
@endsection

@section('page-action')
    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-syllabus">
        <i class="fa fa-plus-circle pr-1"></i>
        Create something
    </button>
@endsection

@section('content')
    <div class="dashboard-table all" id="all">
        <table class="table table-borderless table-hover">
            <thead>
                <tr>
                    <th scope="col">ID.</th>
                    <th scope="col">Email</th>
                    <th scope="col">Submitter</th>
                    <th scope="col">Status</th>
                    <th scope="col">PDF</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($syllabi as $row)
                    <tr tabindex="0">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $row->email }}</td>
                        <td>{{ $row->firstname . $row->lastname }}</td>
                        <td>
                            <span class="badge badge-success p-1">CHECKED</span>
                        </td>
                        <td>
                            <form action="{{ route('file.download') }}" method="post">
                                @csrf
                                <input type="hidden" name="syllabus-file" value="{{ $row->pdf_data }}">
                                <button class="btn btn-sm btn-link" type="submit">
                                    {{ $row->pdf_data }}
                                </button>
                            </form>
                        </td>
                        <td>
                            <div>
                                <a href="{{ route('file.show', $row->pdf_data) }}" target="_blank"
                                    class="btn btn-light btn-sm">View</a>
                                <a href="#" class="btn btn-link btn-sm ml-2">Edit</a>
                                <a href="#" class="btn btn-link btn-sm ml-2">Delete</a>
                                <a href="#" class="btn btn-link btn-sm ml-2">Archive</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="dashboard-table report-summary" id="report-summary" style="display:none">
        <table class="table table-borderless table-hover">
            <thead>
                <tr>
                    <th scope="col">ID2.</th>
                    <th scope="col">Created2</th>
                    <th scope="col">Submitter2</th>
                    <th scope="col">Subject2</th>
                    <th scope="col">Status2</th>
                    <th scope="col">Actions2</th>
                </tr>
            </thead>
            <tbody>
                @for ($i = 0; $i < 15; $i++)
                    <tr tabindex="0">
                        <td scope="row">2</td>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                        <td>
                            <span class="badge badge-danger p-1">UNCHECKED</span>
                        </td>
                        <td>
                            <div>
                                <a href="#" class="btn btn-link btn-sm">View</a>
                                <a href="#" class="btn btn-link btn-sm ml-2">Edit</a>
                                <a href="#" class="btn btn-link btn-sm ml-2">Delete</a>
                                <a href="#" class="btn btn-link btn-sm ml-2">Archive</a>
                            </div>
                        </td>
                    </tr>
                @endfor
            </tbody>
        </table>
    </div>
    <div class="dashboard-table submissions" id="submissions" style="display:none">
        <table class="table table-borderless table-hover">
            <thead>
                <tr>
                    <th scope="col">ID3.</th>
                    <th scope="col">Created3</th>
                    <th scope="col">Submitter3</th>
                    <th scope="col">Subject3</th>
                    <th scope="col">Status3</th>
                    <th scope="col">Actions3</th>
                </tr>
            </thead>
            <tbody>
                @for ($i = 0; $i < 15; $i++)
                    <tr tabindex="0">
                        <td scope="row">3</td>
                        <td>Larry</td>
                        <td>the Bird</td>
                        <td>@twitter</td>
                        <td>
                            <span class="badge badge-warning p-1">ARCHIVED</span>
                        </td>
                        <td>
                            <div>
                                <a href="#" class="btn btn-link btn-sm">View</a>
                                <a href="#" class="btn btn-link btn-sm ml-2">Edit</a>
                                <a href="#" class="btn btn-link btn-sm ml-2">Delete</a>
                                <a href="#" class="btn btn-link btn-sm ml-2">Archive</a>
                            </div>
                        </td>
                    </tr>
                @endfor
            </tbody>
        </table>
    </div>
@endsection

@section('script')
    <script>

    </script>
@endsection
