<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Employee::create([
            'name' => 'Bagus Puji Rahardjo',
            'email' => 'bagusrahardjo6@gmail.com',
            'address' => 'Margonda Residence, Depok',
            'phone' => '087873870194'
        ]);
    }
}
