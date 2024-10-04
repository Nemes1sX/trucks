<?php

namespace Tests\Feature;

use App\Models\SubUnit;
use App\Models\Truck;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;

class SubUnitTest extends TestCase
{
    use RefreshDatabase;
 
    public function test_create_subunit_success(): void
    {
        Truck::factory()->count(5)->create();
        $request = [
            'sub_unit' => 2,
            'main_truck' => 5,
            'start_date'=> "2024-10-05",
            'end_date'=> "2024-10-08"
        ];

        $response = $this->postJson('/api/subunits', $request);

        $response->assertStatus(201);
        $this->assertDatabaseHas('sub_units', $request);
    }

     public function test_create_subunit_failed_main_truck_overlap() : void
     {
        $trucks = Truck::factory()->count(5)->create();
        SubUnit::create([
            'main_truck' => $trucks[0]->id,
            'sub_unit' => $trucks[1]->id,
            'start_date' => "2024-10-04",
            'end_date' => "2024-10-06",            
        ]);
        $request = [
            'sub_unit' => 10,
            'main_truck' => 6,
            'start_date'=> "2024-10-05",
            'end_date'=> "2024-10-08"
        ];

        $response = $this->postJson('/api/subunits', $request);

        $response->assertStatus(422)
                  ->assertJson([
                    'errors' => [
                        'main_truck' => ['Main truck already has a subunit or being subunit itself for your selected period'],
                    ],
                  ]);
     } 
   
     public function test_create_subunit_failed_sub_unit_overlap() : void
     {
        $trucks = Truck::factory()->count(5)->create();
        SubUnit::create([
            'main_truck' => $trucks[0]->id,
            'sub_unit' => $trucks[1]->id,
            'start_date' => "2024-10-04",
            'end_date' => "2024-10-06",            
        ]);
        $request = [
            'sub_unit' => $trucks[1]->id,
            'main_truck' => $trucks[3]->id,
            'start_date'=> "2024-10-05",
            'end_date'=> "2024-10-08"
        ];

        $response = $this->postJson('/api/subunits', $request);

        $response->assertStatus(422)
                  ->assertJson([
                    'errors' => [
                        'sub_unit' => ['Subunit already have been for main truck or subunit for selected period'],
                    ],
                  ]);
     } 

     public function test_create_subunit_failed_same_trucks() : void
     {
        $trucks = Truck::factory()->count(5)->create();
        $request = [
            'sub_unit' => $trucks[0]->id,
            'main_truck' => $trucks[0]->id,
            'start_date'=> "2024-10-05",
            'end_date'=> "2024-10-08"
        ];

        $response = $this->postJson('/api/subunits', $request);

        $response->assertStatus(422)
                  ->assertJson([
                    'errors' => [
                        'sub_unit' => ['The sub unit field and main truck must be different.'],
                    ],
                  ]);
     } 
}   
