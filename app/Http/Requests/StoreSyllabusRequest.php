<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
// use Symfony\Component\HttpFoundation\ParameterBag;

class StoreSyllabusRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email',
            'password' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',
            'grade_first_sem' => 'required|integer',
            'grade_second_sem' => 'required|integer',
            'class_description' => 'required',
            'year_level' => 'required',
            'section' => 'required',
            'student_count' => 'required|integer',
            'room_no' => 'required|integer',
            'building_no' => 'required|integer',
            'pdf_data' => 'required'
        ];
    }

    // public function getValidatorInstance()
    // {
    //     $validator = parent::getValidatorInstance();

    //     $this->request->merge([
    //         'pdf_data' => date('Ymd') . '-' . time() . '.pdf'
    //     ]);

    //     return $validator;
    // }

    // protected function formatPdfSrcPath()
    // {
    //     $this->request->merge([
    //         'pdf_data' => date('Ymd') . '-' . time() . '.pdf'
    //     ]);
    // }
}
