<?php

namespace App\Http\Controllers;

use App\Http\Requests\WorkerRequest;
use App\Http\Resources\WorkerResource;
use App\Models\Worker;
use Illuminate\Http\Request;

class WorkerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    /**
     * @OA\Get(
     *     path="/api/worker",
     *     summary="Get all workers",
     *     tags={"Workers"},
     *     @OA\Response(
     *         response="200",
     *         description="List of all workers",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/WorkerResource")
     *         )
     *     )
     * )
     *
     * Display a listing of the resource.
     *
     * @return WorkerResource
     */
    public function index()
    {
        $workers = Worker::all();

        return WorkerResource::make($workers);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    /**
     * @OA\Post(
     *     path="/api/worker",
     *     summary="Create a new worker",
     *     tags={"Workers"},
     *     @OA\RequestBody(
     *         required=true,
     *         description="Worker data",
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response="201",
     *         description="Worker created successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(
     *                 property="data",
     *                 ref="#/components/schemas/WorkerResource"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response="422",
     *         description="Validation error",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string"),
     *             @OA\Property(property="errors", type="object")
     *         )
     *     )
     * )
     *
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return WorkerResource
     */
    public function store(Request $request)
    {
        $worker = new Worker();
        $worker->name = $request->input('name');
        $worker->save();

        return WorkerResource::make($worker);
    }


}
