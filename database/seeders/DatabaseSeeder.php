<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\AttendanceStatus;
use App\Models\Family;
use App\Models\Language;
use App\Models\Student;
use App\Models\StudentDetail;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use PHPUnit\Framework\MockObject\Builder\Stub;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CountrySeeder::class,
            AttendanceStatusSeeder::class,
            UserSeeder::class,
            StudentClassSeeder::class,
            MainObjectiveSeeder::class,
            SubObjectiveSeeder::class,
            // ObjectiveSeeder::class
            // StudentSeeder::class,
            // StudentDetailSeeder::class,
            // StudentAddressSeeder::class,
            // StudentHealthDetailSeeder::class,
            // StudentSchoolSeeder::class,
            // StudentContactSeeder::class,
            // StudentParentSeeder::class,
            // StudentEmergencySeeder::class,
            // StudentPermissionSeeder::class
        ]);
    }
}
