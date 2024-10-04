<?php

namespace Tests\Feature;

use App\Http\Resources\TruckResource;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Truck;

class TruckTest extends TestCase
{
    use RefreshDatabase;
 
    public function test_get_trucks(): void
    {
        $trucks = Truck::factory()->create();

        $response = $this->getJson('/api/trucks');

        $response->assertStatus(200);

        $this->assertDatabaseHas('trucks', [
            'id' => $trucks->id,
            'name' => $trucks->name,
            'year' => $trucks->year,
        ]);         
    }

    public function test_get_truck() : void
    {
        $truck = Truck::factory()->create();

        $response = $this->getJson("/api/trucks/{$truck->id}");

        $response->assertStatus(200)   
                 ->assertJsonFragment(['id' => $truck->id]);

       $this->assertDatabaseHas('trucks', $truck->toArray());     
    }

    public function test_post_truck_success() : void
    {    
        $request = [
            'name' => 'BA2567',
            'year' => 2021
        ];

        $response = $this->postJson("/api/trucks", $request);

        $response->assertStatus(201)   
                 ->assertJsonFragment(['name' => 'BA2567']);

        $this->assertDatabaseHas('trucks', $request);     
    }

    public function test_post_truck_failed() : void
    {    
        $request = [
            'name' => '',
            'year' => null
        ];

        $response = $this->postJson("/api/trucks", $request);

        $response->assertStatus(422)   
                 ->assertJsonValidationErrors(['name', 'year']);
    }

    public function test_update_truck_success() : void
    {    
        $truck = Truck::factory()->create();

        $request = [
            'name' => 'BA2567',
            'year' => 2021
        ];

        $response = $this->putJson("/api/trucks/{$truck->id}", $request);

        $response->assertStatus(200)   
                 ->assertJsonFragment(['name' => 'BA2567']);

        $this->assertDatabaseHas('trucks', $request);     
    }

    public function test_post_delete_success() : void
    {    
        $truck = Truck::factory()->create();

        $response = $this->deleteJson("/api/trucks/{$truck->id}");

        $response->assertStatus(204);

        $this->assertDatabaseMissing('trucks', [
            'id' => $truck->id,
            'name' => $truck->name,
            'year' => $truck->year,
            'notes' => $truck->note,
        ]);    
        $this->assertDatabaseCount('trucks', Truck::count());
    }
}
