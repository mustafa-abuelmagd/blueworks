<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     title="WorkerResource",
 *     description="Worker data",
 *     @OA\Xml(
 *         name="WorkerResource"
 *     )
 * )
 */
class ClockInResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array<string, mixed>
     *
     * @OA\Property(
     *     property="id",
     *     description="ID of the worker",
     *     type="integer",
     *     example="1"
     * )
     * @OA\Property(
     *     property="name",
     *     description="Name of the worker",
     *     type="string",
     *     example="John Doe"
     * )
     * @OA\Property(
     *     property="created_at",
     *     description="Date and time when the record was created",
     *     type="string",
     *     format="date-time",
     *     example="2022-01-28 15:00:00"
     * )
     * @OA\Property(
     *     property="updated_at",
     *     description="Date and time when the record was last updated",
     *     type="string",
     *     format="date-time",
     *     example="2022-01-28 15:01:00"
     * )
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }
}
