<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AttendanceRequest;
use App\Models\AttendanceStatus;
use App\Models\Student;
use App\Models\StudentAttendance;
use App\Models\StudentClass;
use App\Models\StudentDetail;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $students = Student::all();
        $classes = StudentClass::all();
        $attendances = StudentAttendance::all();
        $attendanceStatuses = AttendanceStatus::all();

        if ($request->ajax()) {

            return Datatables::of($attendances)
                ->addIndexColumn()

                ->addColumn('status', function($row){
                    $status = null;

                    if ($row->status) {
                        $status = $row->status->symbol;
                    }

                    return $status;
                })
                ->addColumn('student', function($row){
                    if ($student = $row->student) {
                        return $student->surname. ' '. $student->middlename. ' '.$student->forename;
                    }
                })
                ->addColumn('date', function($row){
                    return date('d-m-Y', strtotime($row->date));
                })
                ->addColumn('note', function($row){
                    return Str::limit($row->note, 15);
                })
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" title="Edit" class="btn btn-sm btn-info edit editButton"> <i class="fas fa-edit"></i> </a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $studentAttendances = null;

        if ($request->student_name) {

            $studentId = $request->student_name;
            $date = $request->date;
            $time = $request->time;
            $class = $request->class;

            $studentAttendances = StudentAttendance::where('student_id', $studentId)->where('date', $date)->where('time', $time)->where('class_id', $class)->get();
        }

        return view('admin.attendances.index', ['students' => $students, 'studentAttendances' => $studentAttendances, 'attendanceStatuses' => $attendanceStatuses,
            'classes' => $classes
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classes = StudentClass::all();
        $defaultAttendanceStatus = AttendanceStatus::where('symbol', '/')->first();
        $attendanceStatuses = AttendanceStatus::all();
        $frequentAttendanceStatuses = AttendanceStatus::where('is_frequent', true)->get();
        $infrequentAttendanceStatuses = AttendanceStatus::where('is_frequent', false)->get();

        return view('admin.attendances.create', [
            'infrequentAttendanceStatuses' => $infrequentAttendanceStatuses,
            'classes' => $classes, 'frequentAttendanceStatuses' => $frequentAttendanceStatuses,
            'attendanceStatuses' => $attendanceStatuses, 'defaultAttendanceStatus' => $defaultAttendanceStatus
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AttendanceRequest $request)
    {
        $request->validated();

        $class = StudentClass::find($request->class);

        if (! $class)
        {
            return back()->withErrors('Unable to locate the class, please contact the administrator');
        }

        // $students = StudentDetail::with(['class', 'student'], function( $query, $class ) {
        //     $query->where('class_id', $class->id);
        // })->get();


        // $students = Student::whereHas('class', function( Builder $query ) use ($class) {
        //     $query->where('class_id', $class->id);
        // })->where('type', 'current')->get();

        // if (count($students) < 1)
        // {
        //     return back()->withErrors('Please register some students, and then mark the attendance');
        // }

        // DB::beginTransaction();

            // try {
            //     foreach ($students as $student) {
            //         StudentAttendance::create([
            //             'student_id' => $student->id,
            //             'attendance_status_id' => $request->status,
            //             'class_id' => $request->class,
            //             'date' => $request->date,
            //             'time' => $request->time,
            //             'note' => $request->note
            //         ]);
            //     }

            //     DB::commit();
            // }
            // catch(\Exception $ex) {
            //     return back()->withErrors($ex->getMessage());
            // }



        // $request->session()->flash('alert-success', 'Attendance Marked');

        // $attendanceStatus = AttendanceStatus::find($request->status);

        // if (! $attendanceStatus) {
        //     abort('404', 'No attendances found, please refresh the webpage and try again, if still problem exists, contact the administrator');
        // }

        // $classes = StudentClass::all();
        // $defaultAttendanceStatuses = AttendanceStatus::where('symbol', '/')->first();
        // $attendanceStatuses = AttendanceStatus::all();

        // $studentAttendances = StudentAttendance::with('student')->where('attendance_status_id', $attendanceStatus->id)
                                    // ->where('date', $request->date)->get();

        return view('admin.attendances.create', [
            'studentAttendances' => $studentAttendances, 'attendanceStatuses' => $attendanceStatuses,
            'defaultAttendanceStatuses' => $defaultAttendanceStatuses, 'classes' => $classes
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $attendance = StudentAttendance::find($id);

        if (! $attendance) {
            return response()->json([
                'error' => 'Unable to locate the attendance, please refresh the webpage and try again'
            ], 404);
        }

        $attendance = [
            'id' => $attendance->id,
            'note' => $attendance->note,
            'date' => $attendance->date,
            'time' => $attendance->time,
            'symbol' => $attendance->status->symbol,
            'attendance_status_id' => $attendance->status->id,
            'attendance_class_id' => $attendance->class_id,
            'attendance_class_name' => $attendance->class->name
        ];

        return response()->json($attendance, 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $attendance = StudentAttendance::find($id);

        if (! $attendance) {
            return response()->json([
                'error' => 'Unable to locate the attendance, please refresh the webpage and try again'
            ], 404);
        }

        $attendance->update([
            'attendance_status_id' => $request->attendance_symbol,
            'note' => $request->attendance_note,
            'date' => $request->attendance_date,
            'time' => $request->attendance_time,
            'class_id' => $request->attendance_class
        ]);

        return response()->json([
            'success' => 'Attendance Updated Successfully'
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $attendance = StudentAttendance::find($id);

        if (! $attendance) {
            abort(404);
        }

        $attendance->delete();

        return response()->json([
            'success' => 'Attendance Deleted Successfully'
        ], 201);
    }

    public function fetchClassStudents(Request $request)
    {
        $students = array();
        $time = $request->time;
        $date = $request->date;
        $status = $request->status;
        $class = $request->class;

        // dd($status);

        if ($class == null) {
            return back()->withErrors('Please choose class first');
        }

        $students = Student::whereHas('class', function(Builder $query) use ($class) {
            $query->where('class_id', $class);
        })->get();

        if (count($students) < 1) {
            return back()->withErrors('No student found');
        }

        DB::beginTransaction();

        if (! Session::has('alert-info')) {
            try {

                foreach ($students as $student) {

                    $attendance = StudentAttendance::where(['class_id' => $class, 'date' => $date, 'student_id' => $student->id])->first();

                    if ($attendance) {

                        $attendance->update([
                            'student_id' => $student->id,
                            'attendance_status_id' => $status,
                            'class_id' => $class,
                            'date' => $date,
                            'time' => $time
                        ]);
                    }
                    else {
                        StudentAttendance::create([
                            'student_id' => $student->id,
                            'attendance_status_id' => $status,
                            'class_id' => $class,
                            'date' => $date,
                            'time' => $time
                        ]);
                    }
                }

                DB::commit();

                $request->session()->flash('alert-success', 'Attendance marked successfully');

            }
            catch(\Exception $ex) {
                return response()->json([
                    'error' => $ex->getMessage()
                ], 500);
            }
        }

        $studentAttendances = array();

        foreach($students as $student) {
            $studentAttendances = StudentAttendance::where('date', $request->date)->where('class_id', $class)->get();
        }

        $classes = StudentClass::all();
        $attendanceStatuses = AttendanceStatus::all();
        $defaultAttendanceStatuses = AttendanceStatus::where('symbol', '/')->first();

        return view('admin.attendances.create')->with('classes', $classes)
            ->with('attendanceStatuses', $attendanceStatuses)->with('defaultAttendanceStatuses', $defaultAttendanceStatuses)
            ->with('studentAttendances', $studentAttendances);
    }

    public function editAttendancesStatus(Request $request)
    {
        $attendance = StudentAttendance::find($request->attendance_id);

        if (! $attendance) {
            return response()->json([
                'error' => 'Unable to locate the attendance, please refresh the webpage and try again'
            ], 404);
        }

        $attendance = [
            'id' => $attendance->id,
            'note' => $attendance->note,
            'date' => $attendance->date,
            'time' => $attendance->time,
            'symbol' => $attendance->status->symbol,
            'attendance_status_id' => $attendance->status->id,
            'attendance_class_id' => $attendance->class_id,
            'attendance_class_name' => $attendance->class->name
        ];

        return $attendance;
    }

    public function updateAttendancesStatus(Request $request)
    {
        $attendance = StudentAttendance::find($request->attendance_id);

        if (! $attendance) {
            return response()->json([
                'error' => 'Unable to locate the attendance, please refresh the webpage and try again'
            ], 404);
        }

        $attendance->update([
            'attendance_status_id' => intval($request->attendance_status)
        ]);

        $request->session()->flash('alert-info', 'Attendance updated successfully');

    }

}
