<?php

use Illuminate\Database\Seeder;

class RelationshipTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $relationships_parent = [
            'Father', 
            'Mother', 
        ];

        $relationships_guardian = [
            'Father', 
            'Mother', 
            'Aunt', 
            'Uncle'
        ];

        foreach ($relationships_parent as $relationship) {
            App\Relationship::create([
                'relationship' => $relationship,
                'type_of_rel' => 'parent',
            ]);
        }

        foreach ($relationships_guardian as $relationship) {
            App\Relationship::create([
                'relationship' => $relationship,
                'type_of_rel' => 'guardian',
            ]);
        }
    }
}
