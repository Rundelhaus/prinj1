<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
        $rules = [
            'list_name' => 'required|string|max:5'
        ];

        switch ($this->getMethod())
        {
            case 'POST':
                return $rules;
            case 'PATCH':
                return [
                    'list_id' => 'required|integer|exists:task_lists,id'
                ] + $rules;
            case 'DELETE':
                return[
                    'list_id' => 'required|integer|exists:task_lists,id'
                ];
        }



        return [
            //
        ];
    }

    public function all($keys = null)
    {
        $data = parent::all($keys);
        switch ($this->getMethod())
        {
            case 'PATCH':
                $data['list_id'] = $this->route('list_id');
            case 'DELETE':
                $data['list_id'] = $this->route('list_id');
        }
        return $data;
    }

    protected function formatErrors(Validator $validator)
    {
        return $validator->errors()->all();
    }
}
