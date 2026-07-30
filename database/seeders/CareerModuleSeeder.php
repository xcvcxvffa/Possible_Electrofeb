<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CareerModuleSeeder extends Seeder
{
    public function run(): void
    {
        // Job Types
        $types = [
            ['name' => 'Full Time',  'color' => '#16a34a'],
            ['name' => 'Part Time',  'color' => '#2563eb'],
            ['name' => 'Internship', 'color' => '#7c3aed'],
            ['name' => 'Contract',   'color' => '#d97706'],
            ['name' => 'Remote',     'color' => '#0891b2'],
            ['name' => 'Hybrid',     'color' => '#db2777'],
            ['name' => 'On-Site',    'color' => '#374151'],
        ];

        foreach ($types as $type) {
            DB::table('job_types')->insertOrIgnore([
                'id'         => (string) Str::uuid(),
                'name'       => $type['name'],
                'color'      => $type['color'],
                'status'     => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Skills Master (technical / electrical domain)
        $skills = [
            ['name' => 'AutoCAD',               'category' => 'technical'],
            ['name' => 'Panel Design',          'category' => 'domain'],
            ['name' => 'PLC Programming',       'category' => 'technical'],
            ['name' => 'SCADA',                 'category' => 'technical'],
            ['name' => 'Electrical Wiring',     'category' => 'domain'],
            ['name' => 'SLD Design',            'category' => 'domain'],
            ['name' => 'Project Management',    'category' => 'soft'],
            ['name' => 'MS Office',             'category' => 'technical'],
            ['name' => 'Communication Skills',  'category' => 'soft'],
            ['name' => 'Quality Control',       'category' => 'domain'],
            ['name' => 'Switchgear',            'category' => 'domain'],
            ['name' => 'EPLAN',                 'category' => 'technical'],
            ['name' => 'HV Testing',            'category' => 'domain'],
            ['name' => 'BOM Estimation',        'category' => 'domain'],
            ['name' => 'Site Supervision',      'category' => 'soft'],
        ];

        foreach ($skills as $skill) {
            DB::table('skills')->insertOrIgnore([
                'name'       => $skill['name'],
                'slug'       => Str::slug($skill['name']),
                'category'   => $skill['category'],
                'status'     => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Default Departments
        $departments = [
            ['name' => 'Engineering & Design',  'sort_order' => 1],
            ['name' => 'Production',            'sort_order' => 2],
            ['name' => 'Quality Control',       'sort_order' => 3],
            ['name' => 'Sales & Marketing',     'sort_order' => 4],
            ['name' => 'Administration & HR',   'sort_order' => 5],
            ['name' => 'IT & Systems',          'sort_order' => 6],
        ];

        foreach ($departments as $dept) {
            DB::table('departments')->insertOrIgnore([
                'id'         => (string) Str::uuid(),
                'name'       => $dept['name'],
                'slug'       => Str::slug($dept['name']),
                'status'     => 1,
                'sort_order' => $dept['sort_order'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Default Locations
        $locations = [
            ['country' => 'India', 'state' => 'Gujarat', 'city' => 'Rajkot',     'office_name' => 'Head Office'],
            ['country' => 'India', 'state' => 'Gujarat', 'city' => 'Ahmedabad',  'office_name' => 'Branch Office'],
        ];

        foreach ($locations as $loc) {
            DB::table('job_locations')->insertOrIgnore([
                'id'          => (string) Str::uuid(),
                'country'     => $loc['country'],
                'state'       => $loc['state'],
                'city'        => $loc['city'],
                'office_name' => $loc['office_name'],
                'status'      => 1,
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        }
    }
}
