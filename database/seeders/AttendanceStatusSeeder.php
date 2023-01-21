<?php

namespace Database\Seeders;

use App\Models\AttendanceStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttendanceStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $attendanceStatuses =
                            [
                                [
                                    'symbol' => '/',
                                    'status' => 'Present',
                                    'description' => 'Present',
                                    'is_frequent' => true
                                ],

                                [
                                    'symbol' => 'B',
                                    'status' => 'Present',
                                    'description' => 'Off-site educational activity',
                                    'is_frequent' => false
                                ],

                                [
                                    'symbol' => 'D',
                                    'status' => 'Present',
                                    'description' => 'Dual Registered - at another educational establishment',
                                    'is_frequent' => false
                                ],

                                [
                                    'symbol' => 'J',
                                    'status' => 'Present',
                                    'description' => 'At an interview with prospective employers, or another educational establishment',
                                    'is_frequent' => false
                                ],

                                [
                                    'symbol' => 'P',
                                    'status' => 'Present',
                                    'description' => 'Participating in a supervised sporting activity',
                                    'is_frequent' => false
                                ],

                                [
                                    'symbol' => 'V',
                                    'status' => 'Present',
                                    'description' => 'Educational visit or trip',
                                    'is_frequent' => false
                                ],

                                [
                                    'symbol' => 'W',
                                    'status' => 'Present',
                                    'description' => 'Work experience',
                                    'is_frequent' => false
                                ],

                                [
                                    'symbol' => 'C',
                                    'status' => 'Authorised Absence',
                                    'description' => 'Leave of absence authorised by the school',
                                    'is_frequent' => false
                                ],

                                [
                                    'symbol' => 'E',
                                    'status' => 'Authorised Absence',
                                    'description' => 'Excluded but no alternative provision made',
                                    'is_frequent' => false
                                ],

                                [
                                    'symbol' => 'H',
                                    'status' => 'Authorised Absence',
                                    'description' => 'Holiday authorised by the school',
                                    'is_frequent' => false
                                ],

                                [
                                    'symbol' => 'I',
                                    'status' => 'Authorised Absence',
                                    'description' => 'Illness (not medical or dental appointments)',
                                    'is_frequent' => true
                                ],

                                [
                                    'symbol' => 'L',
                                    'status' => 'Late',
                                    'description' => '',
                                    'is_frequent' => true
                                ],

                                [
                                    'symbol' => 'M',
                                    'status' => 'Authorised Absence',
                                    'description' => 'Medical or dental appointments',
                                    'is_frequent' => false
                                ],

                                [
                                    'symbol' => 'R',
                                    'status' => 'Authorised Absence',
                                    'description' => 'Religious observance',
                                    'is_frequent' => false
                                ],

                                [
                                    'symbol' => 'S',
                                    'status' => 'Authorised Absence',
                                    'description' => 'Study leave',
                                    'is_frequent' => false
                                ],

                                [
                                    'symbol' => 'T',
                                    'status' => 'Authorised Absence',
                                    'description' => 'Gypsy, Roma and Traveller absence',
                                    'is_frequent' => false
                                ],

                                [
                                    'symbol' => 'G',
                                    'status' => 'Unauthorised Absence',
                                    'description' => 'Holiday not authorised by the school or in excess of the period determined by the head teacher.',
                                    'is_frequent' => false
                                ],

                                [
                                    'symbol' => 'N',
                                    'status' => 'Unauthorised Absence',
                                    'description' => 'Reason for absence not yet provided',
                                    'is_frequent' => true
                                ],

                                [
                                    'symbol' => 'O',
                                    'status' => 'Unauthorised Absence',
                                    'description' => 'Absent from school without authorisation',
                                    'is_frequent' => false
                                ],

                                [
                                    'symbol' => 'U',
                                    'status' => 'Unauthorised Absence',
                                    'description' => 'Arrived in school after registration closed',
                                    'is_frequent' => false
                                ],

                                [
                                    'symbol' => 'X',
                                    'status' => 'Authorised Absence',
                                    'description' => 'not attending in circumstances relating to coronavirus (COVID-19) / Not required to be in school',
                                    'is_frequent' => true
                                ],

                                [
                                    'symbol' => 'Y',
                                    'status' => 'Authorised Absence',
                                    'description' => 'Unable to attend due to exceptional circumstances',
                                    'is_frequent' => false
                                ],

                                [
                                    'symbol' => 'Z',
                                    'status' => 'Authorised Absence',
                                    'description' => 'Pupil not on admission register',
                                    'is_frequent' => false
                                ],

                                [
                                    'symbol' => '#',
                                    'status' => 'Authorised Absence',
                                    'description' => 'Planned whole or partial school closure',
                                    'is_frequent' => false
                                ]

                            ];

        AttendanceStatus::insert($attendanceStatuses);
    }
}
