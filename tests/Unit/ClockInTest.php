<?php

namespace Tests\Unit;

use App\Models\Worker;
use Illuminate\Foundation\Testing\RefreshDatabase;
//use PHPUnit\Framework\TestCase;
use Tests\TestCase;
class ClockInTest extends TestCase
{
//    use RefreshDatabase;

    /**
     * Test clock in a worker
     *
     * @return void
     */
    public function testClockIn()
    {

        // Create a worker
        $worker = Worker::factory()->create([
            'name' => fake()->name(),
        ]);
//        error_log(time());


        // Make a clock-in request
        $response = $this->post('/api/worker/clock-in', [
            'worker_id' => $worker->id,
            'timestamp' => time(),
            'latitude' => 30.049615830963724,
            'longitude' => 31.220263684548171,
        ]);

        // Check if response is successful
        $response->assertStatus(200);

        // Check if worker has a new clock-in entry
        $this->assertEquals(1, Worker::find($worker->id)->clockIns()->count());
    }

    /**
     * Test clock in a worker with invalid location
     *
     * @return void
     */
    public function testClockInInvalidLocation()
    {
        // Create a worker
        $worker = Worker::factory()->create();

        // Make a clock-in request with invalid location
        $response = $this->postJson('/api/worker/clock-in', [
            'worker_id' => $worker->id,
            'timestamp' => time(),
            'longitude' => 31.220263684548171,
            'latitude' => 30.099615830963724,
        ]);

        // Check if response is unsuccessful
        $response->assertStatus(400);

        // Check if worker has no new clock-in entry
        $this->assertEquals(0, $worker->clockIns()->count());
    }

    /**
     * Test get clock-ins for a worker
     *
     * @return void
     */
    public function testGetClockIns()
    {
        // Create a worker with 2 clock-ins
        $worker = Worker::factory()
            ->hasClockIns(2)
            ->create();

        // Make a get clock-ins request
        $response = $this->getJson('/api/worker/clock-ins?worker_id=' . $worker->id);

        // Check if response is successful
        $response->assertStatus(200);

        // Check if the response has the correct number of clock-ins
        $this->assertCount(2, $response->json());
    }
}
