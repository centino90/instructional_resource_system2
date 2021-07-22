<?php

namespace App\Http\Controllers;

use App\Models\InstructionalResource;
use App\Models\TemporaryUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InstructionalResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);

        $temporaryFile = TemporaryUpload::where('folder_name', $request->file)->first();
        $fullPath = storage_path('app/public/syllabi/perm/' . $temporaryFile->file_name);

        if ($temporaryFile) {
            InstructionalResource::create([
                'resource_type' => $request->resource_type,
                'file' => $fullPath,
                'subject' => $request->subject,
                'description' => $request->description,
            ]);

            // Storage::deleteDirectory(storage_path('app/public/syllabi/tmp/' . $request->file));
            Storage::move('/syllabi/tmp/' . $request->file . '/' . $temporaryFile->file_name, '/syllabi/perm/' . $temporaryFile->file_name);
            rmdir(storage_path('app/public/syllabi/tmp/' . $request->file));
            $temporaryFile->delete();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function showResourceModal()
    {
        $listGroupActions = [
            'syllabus' => [
                'modalTitle' => 'Syllabus',
                'href' => '#syllabus',
                'img' => asset('assets/svg-syllabus.svg')
            ],
            'activity' => [
                'modalTitle' => 'Activity',
                'href' => '#activity',
                'img' => asset('assets/svg-activity.svg')
            ],
            'quiz' => [
                'modalTitle' => 'Quiz',
                'href' => '#quiz',
                'img' => asset('assets/svg-quiz.svg')
            ],
            'assignment' => [
                'modalTitle' => 'Assignment',
                'href' => '#assignment',
                'img' => asset('assets/svg-assignment.svg')
            ],
            'ppt' => [
                'modalTitle' => 'PPT',
                'href' => '#ppt',
                'img' => asset('assets/svg-ppt.svg')
            ],
            'exam' => [
                'modalTitle' => 'Exam',
                'href' => '#exam',
                'img' => asset('assets/svg-exam.svg')
            ],
        ];
        $listGroupActionsMarkup = '';
        foreach ($listGroupActions as $navPill => $value) {

            $listGroupActionsMarkup .= '<div class="col col-4 list-group-item-action" data-toggle="list" href="' . $value['href'] . '" role="tab" modal-title="' . $value['modalTitle'] . '">
                                            <img src="' . $value['img'] . '" alt="' . $value['modalTitle'] . '"
                                                class="img-fluid rounded mx-auto d-block">
                                            <span class="position-absolute">' . $value['modalTitle'] . '</span>
                                        </div>';
        }

        $navPillItems = [
            'Chapter 1' => [
                'id' => 'pills-chapter1-tab',
                'href' => '#pills-chapter1',
                'aria-controls' => 'pills-chapter1'
            ],
            'Chapter 2' => [
                'id' => 'pills-chapter2-tab',
                'href' => '#pills-chapter2',
                'aria-controls' => 'pills-chapter2'
            ],
            'Chapter 3' => [
                'id' => 'pills-chapter3-tab',
                'href' => '#pills-chapter3',
                'aria-controls' => 'pills-chapter3'
            ],
        ];
        $navPillItemsMarkup = '';
        foreach ($navPillItems as $list => $value) {
            $isActive = $list === 'Chapter 1' ? 'active' : '';
            $navPillItemsMarkup .= '<li class="nav-item small" role="presentation">
                                        <a class="nav-link ' . $isActive . '" id="' . $value['id'] . '" data-toggle="pill" href="' . $value['href'] . '" role="tab" aria-controls="' . $value['aria-controls'] . '" aria-selected="true">' . $list . '</a>
                                    </li>';
        }

        return  '<div class="create-resource instructional-tabpane container">
                    <div class="list-group flex-row row bg-light" role="tablist">
                        <div class="col list-group-item-action" data-toggle="list" href="#syllabus" role="tab" modal-title="Syllabus">
                            <img src="' . asset('assets/svg-syllabus.svg') . '" alt="syllabus"
                                class="img-fluid rounded mx-auto d-block">
                            <span class="position-absolute">Syllabus</span>
                        </div>
                        <div class="col list-group-item-action" data-toggle="list" href="#activity" role="tab" modal-title="Activity">
                            <img src="' . asset('assets/svg-activity.svg') . '" alt="activity"
                                class="img-fluid rounded mx-auto d-block" style="height: 100px;">
                            <span class="position-absolute">Activity</span>
                        </div>
                        <div class="col list-group-item-action" data-toggle="list" href="#quiz" role="tab" modal-title="Quiz">
                            <img src="' . asset('assets/svg-quiz.svg') . '" alt="quiz"
                                class="img-fluid rounded mx-auto d-block" style="height: 100px;">
                            <span class="position-absolute">Quiz</span>
                        </div>
                        <div class="w-100"></div>
                        <div class="col list-group-item-action" data-toggle="list" href="#assignment" role="tab" modal-title="Assignment">
                            <img src="' . asset('assets/svg-assignment.svg') . '" alt="assignment"
                                class="img-fluid rounded mx-auto d-block" style="height: 100px;">
                            <span class="position-absolute">Assignment</span>
                        </div>
                        <div class="col list-group-item-action" data-toggle="list" href="#ppt" role="tab" modal-title="PPT">
                            <img src="' . asset('assets/svg-ppt.svg') . '" alt="ppt"
                                class="img-fluid rounded mx-auto d-block" style="height: 100px;">
                            <span class="position-absolute">PPT</span>
                        </div>
                        <div class="col list-group-item-action" data-toggle="list" href="#exam" role="tab" modal-title="Exam">
                            <img src="' . asset('assets/svg-exam.svg') . '" alt="exam"
                                class="img-fluid rounded mx-auto d-block" style="height: 100px;">
                            <span class="position-absolute">Exam</span>
                        </div>
                    </div>
                </div>

                <section class="instructional-tabpane syllabus-tabs" id="syllabus" style="display: none">
                <div class="alert alert-warning rounded-0 collapse" role="alert" id="alert-warning">
                    <div class="alert-icon">
                        <i class="fa fa-exclamation-circle"></i>
                    </div>
                    <strong>There is a problem with some of your inputs.</strong> You should check in on
                    those
                    fields below.
                </div>
                    <ul class="nav nav-pills mb-4" id="pills-tab" role="tablist">
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
                    <form class="tab-content" id="pills-tabContent" method="POST" action="' . route('syllabus.store') . '" novalidate>
                        <input type="hidden" name="_token" value="' . csrf_token() . '">

                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                            aria-labelledby="pills-home-tab">
                            <div class="form-group row">
                                <label for="staticEmail"
                                    class="col-sm-2 col-form-label col-form-label-sm">Email</label>
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
                                    <textarea name="class_description" class="form-control form-control-sm"></textarea>
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
                    </form>
                    <div class="modal-footer px-0">
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
                </section>

                <section class="instructional-tabpane" id="activity" style="display: none">
                <div class="alert alert-warning rounded-0 collapse my-0" role="alert" id="alert-warning">
                    <div class="alert-icon">
                        <i class="fa fa-exclamation-circle"></i>
                    </div>
                    <strong>There is a problem with some of your inputs.</strong> You should check in on
                    those
                    fields below.
                </div>
                <form class="tab-content" id="pills-tabContent" novalidate>
                    <input type="hidden" name="_token" value="' . csrf_token() . '">
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
                </form>
                <div class="modal-footer px-0 mx-0">
                    <button type="submit" class="btn btn-primary btn-sm btn-submit">Submit</button>
                </div>
            </section>
                ';
    }
}
