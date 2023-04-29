<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClockInRequest;
use App\Models\ClockIn;
use App\Models\Worker;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Carbon\Carbon;

class ClockInController extends Controller
{

    /** * process a new check-in request
     *
     * @param ClockInRequest $request
     *
     * @return \Illuminate\Http\JsonResponse with status 200 of Ok or 422 otherwise
     * @throws Some_Exception_Class If something interesting cannot happen
     */


    /**
     * @OA\Info(
     * version="1.0.0",
     * title="Clock In API",
     * description="API documentation for the Clock In app",
     * )
     * @OA\Post(
     *      path="/api/worker/clock-in",
     *      summary="Clock-in a worker",
     *      description="Clock-in a worker at the specified location",
     *      operationId="clockIn",
     *      tags={"Clock-in"},
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/ClockInRequest")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="Worker has successfully clocked in."
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="error",
     *                  type="string",
     *                  example="Worker is not within 2km of the specified location."
     *              )
     *          )
     *      ),
     *      security={
     *         {"bearerAuth": {}}
     *      }
     * )
     *
     * @param \App\Http\Requests\ClockInRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \InvalidArgumentException
     */
    public function clockIn(ClockInRequest $request): \Illuminate\Http\JsonResponse
    {
        $workerLatitude = $request->input('latitude');
        $workerLongitude = $request->input('longitude');
        $distance = $this->calculateDistance($workerLatitude, $workerLongitude);
        if ($distance > 2000) {
            return response()->json(['error' => 'Worker is not within 2km of the specified location.'], 400);
        }

        // Save the clock-in data to the database
        ClockIn::create([
            'worker_id' => $request['worker_id'],
            'timestamp' => $request['timestamp'],
            'latitude' => $request['latitude'],
            'longitude' => $request['longitude'],
        ]);
        return response()->json(['message' => 'Worker has successfully clocked in.']);
    }


    /** * Get clock-ins for a worker
     *
     * @param ClockInRequest $request
     *
     * @return \Illuminate\Http\JsonResponse with status 200 of Ok or 404 if no worker with provided Id.
     * @throws Some_Exception_Class If something interesting cannot happen
     */
    public function getClockIns(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'worker_id' => 'required|integer',
        ]);
        $worker = Worker::findOrFail($validatedData['worker_id']);

        // Retrieve the clock-ins for the specified worker
        $clockIns = ClockIn::where('worker_id', $worker->id)->get();

        return response()->json($clockIns);
    }

    /**
     * Calculate the distance between two points using the haversine formula
     *
     * @param float $latitude2
     * @param float $longitude2
     * @return float
     */
    private function calculateDistance(float $latitude2, float $longitude2): float|int
    {
        $radiusOfEarth = 6371000;
        $locationLatitude = 30.049615830963724;
        $locationLongitude = 31.240263684548175;
        $latFrom = deg2rad($latitude2);
        $lonFrom = deg2rad($longitude2);
        $latTo = deg2rad($locationLatitude);
        $lonTo = deg2rad($locationLongitude);

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $a = sin($latDelta / 2) * sin($latDelta / 2) + cos($latFrom)
            * cos($locationLatitude) * sin($lonDelta / 2) * sin($lonDelta / 2);

        $c = 2 * asin(sqrt($a));
        $distance = $radiusOfEarth * $c;
        error_log($distance);

        return $distance;
    }
//{


//$angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
//cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
//return $angle * $earthRadius;
//}
}
