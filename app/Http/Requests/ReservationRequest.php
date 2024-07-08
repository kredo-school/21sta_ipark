<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'cartype' => 'required',
            'date' => 'required|date',
            'from_hour' => 'required|integer|min:0|max:23',
            'from_minute' => 'required|in:00,30',
            'to_hour' => 'required|integer|min:0|max:24',
            'to_minute' => 'required|in:00,30',
            // toの時間がfromの時間よりも後であることを確認
            'to_hour' => [
                function ($attribute, $value, $fail) {
                    $fromTime = \Carbon\Carbon::createFromTime($this->from_hour, $this->from_minute);
                    $toTime = \Carbon\Carbon::createFromTime($value, $this->to_minute);
                    if ($toTime->lte($fromTime) ) {
                        $fail('The To time must be after the From time.');
                    }
                },
            ],
        ];
}
    
}
