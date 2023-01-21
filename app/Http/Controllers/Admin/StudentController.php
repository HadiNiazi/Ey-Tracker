<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Student\CreateRequest;
use App\Http\Requests\Admin\Student\UpdateRequest;
use App\Models\Country;
use App\Models\Student;
use App\Models\StudentAddressDetail;
use App\Models\StudentClass;
use App\Models\StudentContact;
use App\Models\StudentDetail;
use App\Models\StudentEmergencyContact;
use App\Models\StudentHealthDetail;
use App\Models\StudentParentDetail;
use App\Models\StudentPermissionDetail;
use App\Models\StudentSchoolDetail;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $students = '';
        $betType = $request->type;

        if ( $request->ajax() ) {

            switch ($betType) {

                case 'current':
                    $students = Student::where('type', $betType)->select('id', 'surname', 'forename','dob', 'type')->get();
                    break;

                case 'graduated':
                    $students = Student::where('type', $betType)->select('id', 'surname', 'forename','dob', 'type')->get();
                break;

                case 'leaved':
                    $students = Student::where('type', $betType)->select('id', 'surname', 'forename','dob', 'type')->get();
                break;

                case 'waiting':
                    $students = Student::where('type', $betType)->select('id', 'surname', 'forename','dob', 'type')->get();
                break;

                default:
                    $students = Student::where('type', 'current')->select('id', 'surname', 'forename','dob', 'type')->get();
                break;

            }

            return Datatables::of($students)
                ->addIndexColumn()
                ->addColumn('dob', function($row){
                    return date('d-m-Y', strtotime($row->dob));
                })
                ->addColumn('status', function($row){
                    return $row->status;
                })
                ->addColumn('class', function($row){
                    if ($row->studentDetail) {
                        if ($row->studentDetail->class) {
                            return Str::limit($row->studentDetail->class->name, 10);
                        }
                    }
                })
                ->addColumn('action', function($row){
                    $btn = '
                    <a href="'.route('admin.students.show', $row->id).'" data-toggle="tooltip"  data-id="'.$row->id.'" title="Show" class="btn btn-sm btn-success show showButton inner"> <i class="fas fa-eye"></i> </a>
                    <a href="'.route('admin.students.edit', $row->id).'" data-toggle="tooltip"  data-id="'.$row->id.'" title="Edit" class="btn btn-sm btn-primary edit editButton inner"> <i class="fas fa-edit"></i> </a>
                    <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" title="Delete" class="btn btn-sm btn-danger del deleteButton inner"> <i class="fas fa-trash"></i> </a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.students.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::all();
        $classes = StudentClass::orderBy('name')->get();
        return view('admin.students.create', ['countries' => $countries, 'classes' => $classes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        $request->validated();

        DB::beginTransaction();

        try {

            $student = Student::create([
                'surname' => $request->surname,
                'middlename' => $request->middlename,
                'forename' => $request->forename,
                'dob' => $request->dob,
                'type' => isset($request->student_status) ? $request->student_status: 'current',
                'status_date' => $request->status_date
            ]);

            StudentDetail::create([
                'student_id' => $student->id,
                'gender' => $request->gender,
                'ethnicity' => $request->ethnicity,
                'other_ethnicity' => $request->other_ethnicity,
                'lives_with' => $request->lives_with,
                'pupil_lives_with' => $request->pupil_lives_with,
                'fsm' => $request->fsm,
                'eal' => $request->eal,
                'sen' => $request->sen,
                'class_id' => $request->class
            ]);

            StudentContact::create([
                'student_id' => $student->id,
                'email' => $request->student_email,
                'telephone' => $request->student_telephone,
                'mobile' => $request->student_mobile
            ]);

            StudentAddressDetail::create([
                'student_id' => $student->id,
                'country_id' => $request->country,
                'post_code' => $request->post_code,
                'address' => $request->address
            ]);

            StudentHealthDetail::create([
                'student_id' => $student->id,
                'doctor_name' => $request->doctor_name,
                'doctor_telephone' => $request->doctor_telephone,
                'doctor_address' => $request->doctor_address,
                'medical_condition' => $request->medical_condition
            ]);

            StudentEmergencyContact::create([
                'student_id' => $student->id,

                'name_1' => $request->emergency_contact_name_1,
                'phone_1' => $request->emergency_telephone_1,
                'relationship_1' => $request->emergency_relationship_to_pupil_1,

                'name_2' => $request->emergency_contact_name_2,
                'phone_2' => $request->emergency_telephone_2,
                'relationship_2' => $request->emergency_relationship_to_pupil_2,

                'name_3' => $request->emergency_contact_name_3,
                'phone_3' => $request->emergency_telephone_3,
                'relationship_3' => $request->emergency_relationship_to_pupil_3
            ]);

            StudentParentDetail::create([
                'student_id' => $student->id,

                'father_name' => $request->father_name,
                'father_home_telephone' => $request->father_home_telephone,
                'father_work_telephone' => $request->father_work_telephone,
                'father_mobile' => $request->father_mobile,
                'father_ocuupation' => $request->father_ocuupation,
                'father_address' => $request->father_address,

                'mother_name' => $request->mother_name,
                'mother_home_telephone' => $request->mother_home_telephone,
                'mother_work_telephone' => $request->mother_work_telephone,
                'mother_mobile' => $request->mother_mobile,
                'mother_ocuupation' => $request->mother_ocuupation,
                'mother_address' => $request->mother_address
            ]);

            StudentSchoolDetail::create([
                'student_id' => $student->id,

                'previous_school' => $request->previous_school,
                'previous_school_left_date' => $request->previous_school_left_date,
                'previous_school_address' => $request->previous_school_address,
                'reason_for_leaving' => $request->reason_for_leaving,

                'new_school' => $request->new_school,
                'new_school_address' => $request->new_school_address,

                'student_missing_status' => $request->student_missing_status,
                'student_la_contacted' => $request->student_la_contacted,
                'student_missing_note' => $request->student_missing_note,
                'student_missing_date' => $request->student_missing_date
            ]);

            StudentPermissionDetail::create([
                'student_id' => $student->id,
                'consent_1' => $request->consent_1,
                'consent_2' => $request->consent_2,
                'consent_3' => $request->consent_3,
                'consent_4' => $request->consent_4,
                'consent_5' => $request->consent_5,
                'consent_6' => $request->consent_6
            ]);

            DB::commit();

            $request->session()->flash('alert-success', 'Student Registered Successfully');
            return to_route('admin.students.index');
        }
        catch(\Exception $ex) {
            DB::rollback();
            return back()->withErrors($ex->getMessage());
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = Student::find($id)->load(['studentAddress', 'studentAttendance', 'studentContact', 'studentDetail', 'studentEmergency',
        'studentHealth', 'studentParent', 'studentPermission', 'studentSchool']);

        return view('admin.students.show', ['student' => $student]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = Student::find($id);
        $studentAddress = $student->studentAddress;
        $countries = Country::all();
        $classes = StudentClass::orderBy('name')->get();

        $student = Student::find($id)->load(['studentAddress', 'studentAttendance', 'studentContact', 'studentDetail', 'studentEmergency',
        'studentHealth', 'studentParent', 'studentPermission', 'studentSchool']);
        return view('admin.students.edit', ['student' => $student, 'countries' => $countries, 'classes' => $classes,
        'studentAddress' => $studentAddress]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        $student = Student::find($id);

        if (! $student) {
            abort(404);
        }

        try {
            DB::beginTransaction();

            $student->update([
                'surname' => $request->surname,
                'middlename' => $request->middlename,
                'forename' => $request->forename,
                'dob' => $request->dob,
                'type' => $request->student_status,
                'status_date' => $request->status_date
            ]);

            if ($student->studentDetail) {

                $student->studentDetail->update([
                    'gender' => $request->gender,
                    'ethnicity' => $request->ethnicity,
                    'other_ethnicity' => $request->other_ethnicity,
                    'lives_with' => $request->lives_with,
                    'pupil_lives_with' => $request->pupil_lives_with,
                    'fsm' => $request->fsm,
                    'eal' => $request->eal,
                    'sen' => $request->sen,
                    'class_id' => $request->class
                ]);

            }
            else {
                StudentDetail::create([
                    'student_id' => $student->id,
                    'gender' => $request->gender,
                    'ethnicity' => $request->ethnicity,
                    'other_ethnicity' => $request->other_ethnicity,
                    'lives_with' => $request->lives_with,
                    'pupil_lives_with' => $request->pupil_lives_with,
                    'fsm' => $request->fsm,
                    'eal' => $request->eal,
                    'sen' => $request->sen,
                    'class_id' => $request->class
                ]);
            }


            if ($student->studentContact) {

                $student->studentContact->update([
                    'email' => $request->student_email,
                    'telephone' => $request->student_telephone,
                    'mobile' => $request->student_mobile
                ]);

            }
            else {

                StudentContact::create([
                    'student_id' => $student->id,
                    'email' => $request->student_email,
                    'telephone' => $request->student_telephone,
                    'mobile' => $request->student_mobile
                ]);

            }

            if ($student->studentAddress) {

                $student->studentAddress->update([
                    'country_id' => $request->country,
                    'post_code' => $request->post_code,
                    'address' => $request->address
                ]);

            }
            else {

                StudentAddressDetail::create([
                    'student_id' => $student->id,
                    'country_id' => $request->country,
                    'post_code' => $request->post_code,
                    'address' => $request->address
                ]);
            }

            if ($student->studentHealth) {

                $student->studentHealth->update([
                    'doctor_name' => $request->doctor_name,
                    'doctor_telephone' => $request->doctor_telephone,
                    'doctor_address' => $request->doctor_address,
                    'medical_condition' => $request->medical_condition
                ]);

            }
            else {

                StudentHealthDetail::create([
                    'student_id' => $student->id,
                    'doctor_name' => $request->doctor_name,
                    'doctor_telephone' => $request->doctor_telephone,
                    'doctor_address' => $request->doctor_address,
                    'medical_condition' => $request->medical_condition
                ]);

            }

            if ($student->studentEmergency) {

                $student->studentEmergency->update([
                    'name_1' => $request->emergency_contact_name_1,
                    'phone_1' => $request->emergency_telephone_1,
                    'relationship_1' => $request->emergency_relationship_to_pupil_1,

                    'name_2' => $request->emergency_contact_name_2,
                    'phone_2' => $request->emergency_telephone_2,
                    'relationship_2' => $request->emergency_relationship_to_pupil_2,

                    'name_3' => $request->emergency_contact_name_3,
                    'phone_3' => $request->emergency_telephone_3,
                    'relationship_3' => $request->emergency_relationship_to_pupil_3
                ]);

            }
            else {

                StudentEmergencyContact::create([
                    'student_id' => $student->id,
                    'name_1' => $request->emergency_contact_name_1,
                    'phone_1' => $request->emergency_telephone_1,
                    'relationship_1' => $request->emergency_relationship_to_pupil_1,

                    'name_2' => $request->emergency_contact_name_2,
                    'phone_2' => $request->emergency_telephone_2,
                    'relationship_2' => $request->emergency_relationship_to_pupil_2,

                    'name_3' => $request->emergency_contact_name_3,
                    'phone_3' => $request->emergency_telephone_3,
                    'relationship_3' => $request->emergency_relationship_to_pupil_3
                ]);

            }

            if ($student->studentParent) {

                $student->studentParent->update([
                    'father_name' => $request->father_name,
                    'father_home_telephone' => $request->father_home_telephone,
                    'father_work_telephone' => $request->father_work_telephone,
                    'father_mobile' => $request->father_mobile,
                    'father_ocuupation' => $request->father_ocuupation,
                    'father_address' => $request->father_address,

                    'mother_name' => $request->mother_name,
                    'mother_home_telephone' => $request->mother_home_telephone,
                    'mother_work_telephone' => $request->mother_work_telephone,
                    'mother_mobile' => $request->mother_mobile,
                    'mother_ocuupation' => $request->mother_ocuupation,
                    'mother_address' => $request->mother_address
                ]);

            }
            else {

                StudentParentDetail::create([
                    'student_id' => $student->id,
                    'father_name' => $request->father_name,
                    'father_home_telephone' => $request->father_home_telephone,
                    'father_work_telephone' => $request->father_work_telephone,
                    'father_mobile' => $request->father_mobile,
                    'father_ocuupation' => $request->father_ocuupation,
                    'father_address' => $request->father_address,

                    'mother_name' => $request->mother_name,
                    'mother_home_telephone' => $request->mother_home_telephone,
                    'mother_work_telephone' => $request->mother_work_telephone,
                    'mother_mobile' => $request->mother_mobile,
                    'mother_ocuupation' => $request->mother_ocuupation,
                    'mother_address' => $request->mother_address
                ]);

            }

            if ($student->studentSchool) {

                $student->studentSchool->update([

                    'previous_school' => $request->previous_school,
                    'previous_school_left_date' => $request->previous_school_left_date,
                    'previous_school_address' => $request->previous_school_address,
                    'reason_for_leaving' => $request->reason_for_leaving,

                    'new_school' => $request->new_school,
                    'new_school_address' => $request->new_school_address,

                    'student_missing_status' => $request->student_missing_status,
                    'student_la_contacted' => $request->student_la_contacted,
                    'student_missing_note' => $request->student_missing_note,
                    'student_missing_date' => $request->student_missing_date
                ]);

            }
            else {

                StudentSchoolDetail::create([
                    'student_id' => $student->id,
                    'previous_school' => $request->previous_school,
                    'previous_school_left_date' => $request->previous_school_left_date,
                    'previous_school_address' => $request->previous_school_address,
                    'reason_for_leaving' => $request->reason_for_leaving,

                    'new_school' => $request->new_school,
                    'new_school_address' => $request->new_school_address,

                    'student_missing_status' => $request->student_missing_status,
                    'student_la_contacted' => $request->student_la_contacted,
                    'student_missing_note' => $request->student_missing_note,
                    'student_missing_date' => $request->student_missing_date
                ]);

            }

            if ($student->studentPermission) {

                $student->studentPermission->update([
                    'consent_1' => $request->consent_1,
                    'consent_2' => $request->consent_2,
                    'consent_3' => $request->consent_3,
                    'consent_4' => $request->consent_4,
                    'consent_5' => $request->consent_5,
                ]);

            }
            else {

                StudentPermissionDetail::create([
                    'student_id' => $student->id,
                    'consent_1' => $request->consent_1,
                    'consent_2' => $request->consent_2,
                    'consent_3' => $request->consent_3,
                    'consent_4' => $request->consent_4,
                    'consent_5' => $request->consent_5,
                ]);

            }


            DB::commit();

            $request->session()->flash('alert-success', 'Student Updated Successfully');
            return to_route('admin.students.index');
        }
        catch(\Exception $ex) {
            DB::rollBack();
            return back()->withErrors($ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $student = Student::find($id)->load(['studentAddress', 'studentAttendance', 'studentContact', 'studentDetail', 'studentEmergency',
        'studentFee', 'studentHealth', 'studentParent', 'studentPayment', 'studentPermission', 'studentSchool']);

        if (! $student) {
            return response()->json([
                'error' => 'Unable to locate student, please refresh webpage and try again.'
            ], 404);
        }

        try {

            if ($student->studentAddress) {
                $student->studentAddress->delete();
            }

            if ($student->studentAttendance) {
                $student->studentAttendance->delete();
            }
            if ($student->studentContact) {
                $student->studentContact->delete();
            }

            if ($student->studentDetail) {
                $student->studentDetail->delete();
            }

            if ($student->studentEmergency) {
                $student->studentEmergency->delete();
            }

            if ($student->studentHealth) {
                $student->studentHealth->delete();
            }

            if ($student->studentParent) {
                $student->studentParent->delete();
            }

            if ($student->studentPayment) {
                $student->studentPayment->delete();
            }

            if ($student->studentPermission) {
                $student->studentPermission->delete();
            }

            if ($student->studentSchool) {
                $student->studentSchool->delete();
            }

            $student->delete();

            return response()->json([
                'success' => 'Student Deleted Successfully'
            ], 201);
        }

        catch(\Exception $ex) {
            DB::rollBack();
            return back()->withErrors($ex->getMessage());
        }
    }

    public function fetchStudents(Request $request)
    {
        $students = array();
        $classId = $request->class_id;

        if ($classId) {

            $students = Student::whereHas('class', function(Builder $query) use ($classId) {
                $query->where('class_id', $classId);
            })->get();

            // dd($students);

        }
        return $students;
    }
}
