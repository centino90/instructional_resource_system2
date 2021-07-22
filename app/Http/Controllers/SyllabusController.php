<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreSyllabusRequest;
use App\Models\Syllabus;

class SyllabusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
    public function store(StoreSyllabusRequest $request)
    {
        $newFileName = date('Ymd') . '-' . time() . '.'  . $request->file('pdf_data')->extension();

        $validatedCollection = collect($request->validated());
        $mergedValidatedCollection = $validatedCollection->merge(['pdf_data' => $newFileName]);

        if(Syllabus::create($mergedValidatedCollection->all())) {
            $request->session()->flash('status', 'Syllabus was created successfully');
            $request->file('pdf_data')->storeAs('public', $newFileName);

            return response()->json(['message' => 'success'], 200);
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
        // file_put_contents('idol.pdf', $request->pdf_data);
        // $request->file->storeAs('public', 'idol.pdf');
        // $base64_decode = base64_decode($request->pdf_data);
        // $request->pdf_data->store('public');
        // if(Syllabus::create($request->validated())) {
        //     $request->session()->flash('status', 'Syllabus was created successfully');
        //     $base64_decode = base64_decode($request->pdf_data);

        //     // file_put_contents('file2.pdf', $base64_decode);
        //     $newFileName = 'file-' . time() . '-'  . '.pdf';
        //     // file_put_contents($newFileName, $base64_decode);
        //     $base64_decode->storeAs('public', $newFileName);

        //     return response()->json(['message' => 'success'], 200);
        // }

        // if (Storage::disk('public')->exists($file)) {
        //     return Storage::download('public/' . $file);
        // }
        // return redirect('/404');

        $syllabus = Syllabus::findOrFail($id);
        header('Content-Type: application/pdf');
        echo Storage::disk('public')->get($syllabus->pdf_data);

        // echo base64_decode($syllabus->pdf_data);
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
}
