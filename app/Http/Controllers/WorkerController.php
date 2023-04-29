<?php

namespace App\Http\Controllers;

use App\Http\Requests\WorkerRequest;
use App\Models\Worker;
use Illuminate\Http\Request;

class WorkerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $workers = Worker::all();

        return response()->json([
            'status' => 'success',
            'data' => $workers
        ]);
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
    public function store(Request $request)
    {
        $worker = new Worker();
        $worker->name = $request->input('name');
        $worker->save();

        return response()->json([
            'status' => 'success',
            'data' => $worker
        ], 201);
    }
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $worker = Worker::findOrFail($id);

        return response()->json([
            'status' => 'success',
            'data' => $worker
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }


    /** * Remove the specified resource from storage.
     *
     * @param WorkerRequest $request
     *
     * @throws Some_Exception_Class If something interesting cannot happen
     * @return \Illuminate\Http\JsonResponse with status 200 of Ok or 404 if no worker with provided Id.
     */
    public function destroy($id)
    {
        $worker = Worker::findOrFail($id);
        $worker->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Worker deleted successfully'
        ]);
    }
}
