<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClockInRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    /**
     * @OA\Schema(
     *     schema="ClockInRequest",
     *     title="ClockInRequest",
     *     description="ClockIn request body data",
     *     required={"worker_id", "timestamp", "latitude", "longitude"},
     *     @OA\Property(
     *         property="worker_id",
     *         type="integer",
     *         description="ID of the worker who is clocking in"
     *     ),
     *     @OA\Property(
     *         property="timestamp",
     *         type="integer",
     *         description="Unix timestamp when the worker clocked in"
     *     ),
     *     @OA\Property(
     *         property="latitude",
     *         type="string",
     *         description="Latitude of the location where the worker is clocking in"
     *     ),
     *     @OA\Property(
     *         property="longitude",
     *         type="string",
     *         description="Longitude of the location where the worker is clocking in"
     *     ),
     * )
     */
    public function rules(): array
    {
        return [
            'worker_id' => 'required|integer',
            'timestamp' => 'required|integer',
            'latitude' => ['required', 'regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
            'longitude' => ['required', 'regex:/^[-]?((1?[0-7]?|[0-9]?)[0-9]\.(\d+))|(180(\.0+)?)$/'],

        ];
    }
}
