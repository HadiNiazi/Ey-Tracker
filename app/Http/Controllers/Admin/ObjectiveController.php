<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Objectives\Grades\CreateRequest;
use App\Models\Grade;
use App\Models\GradeSubObjective;
use App\Models\MainObjective;
use App\Models\Objective;
use App\Models\ObjectiveStatus;
use App\Models\Student;
use App\Models\StudentClass;
use App\Models\StudentDetail;
use App\Models\SubObjective;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class ObjectiveController extends Controller
{
    public function openObjectivePage(Request $request)
    {
        $grades = array();

        if ($request->ajax()) {

            if ($classId = $request->class_id) {

                // $students = Student::with('grade')->whereDoesntHave('grade', function($grade) use ($classId) {
                //     return $grade->where('student_class_id', $classId);
                // })->get();


                // $students = Student::with('grade')->whereHas('grade', function ($query) use ($classId) {
                //     $query->where('student_class_id', $classId);
                // })
                // ->doesntHave('grade')
                // ->get();

                 $students = Student::with('grade')->whereHas('grade', function ($query) use ($classId) {
                    $query->where('student_class_id', $classId);
                })
                ->get();

            }

            return Datatables::of($grades)
                ->addIndexColumn()

                ->addColumn('class', function($row){
                    if ($class = $row->class) {
                        return $class->name;
                    }
                })
                ->addColumn('objective_title', function($row){
                    if ($objective = $row->objective) {
                        return $objective->title;
                    }
                })
                ->make(true);
        }
        return view('admin.objectives.index');
    }

    public function createGradeObjective(Request $request)
    {
        $studentDetails = array();
        $classes = StudentClass::all();
        $mainObjectives = MainObjective::all();

        if ($request->class && $request->main_objective && $request->sub_objective && $request->objective) {
            $class = StudentClass::find($request->class);

            if ($class) {
                $class = StudentClass::with('students')->first();
                if ($class) {
                    $studentDetails = $class->students;

                    if (count($studentDetails) < 1) {
                        return back()->withErrors('Unable to find students, please add students and try again, if still problem persists contact with administrator');
                    }
                }
            }
        }

        return view('admin.objectives.grades.create', compact('mainObjectives', 'classes',
            'studentDetails'
        ));
    }

    public function storeGradeObjective(CreateRequest $request)
    {
        // dd($request->all());
        try {

            for($i = 0; $i < count($request->objective_achieved_date); $i++) {

                // dd($request->objective_achieved_date[1] == null);
                if ($request->objective_achieved_date[$i] == null) {
                    continue;
                }


                if (count($request->student_ids) > 0) {
                    for($i = 0; $i < count($request->student_ids); $i++) {

                        $grade = null;

                        if ($request->student_ids[$i] && $request->objective_achieved_date[$i]) {

                            $grade = Grade::where('student_id', $request->student_ids[$i])->first();

                            if ($grade) {

                                $grade->update([
                                    'student_class_id' => $request->class_id,
                                    'student_id' => $request->students,
                                    'objective_id' => $request->objective_id,
                                    'student_id' => $request->student_ids[$i],
                                    'objective_achieved' => array_key_exists($i, $request->objective_achieved_date) ? 1: 0,
                                    'objective_achieved_date' => array_key_exists($i, $request->objective_achieved_date) ? $request->objective_achieved_date[$i]: null
                                ]);

                                $subObjective = SubObjective::find($request->sub_objective_id);

                                if ($subObjective) {

                                    $subObjectiveDB = GradeSubObjective::where('grade_id', $grade->id)
                                    ->where('main_objective_id', $request->main_objective_id)->where('sub_objective_id', $subObjective->id)->first();

                                    if (! $subObjectiveDB) {

                                        GradeSubObjective::create([
                                            'grade_id' => $grade->id,
                                            'sub_objective_id' => $subObjective->id,
                                            'main_objective_id' => $request->main_objective_id
                                        ]);

                                    }

                                }
                            }
                            else {
                                $grade = Grade::create([
                                    'student_class_id' => $request->class_id,
                                    'student_id' => $request->students,
                                    'objective_id' => $request->objective_id,
                                    'student_id' => $request->student_ids[$i],
                                    'objective_achieved' => array_key_exists($i, $request->objective_achieved_date) ? 1: 0,
                                    'objective_achieved_date' => array_key_exists($i, $request->objective_achieved_date) ? $request->objective_achieved_date[$i]: null
                                ]);

                                $subObjective = SubObjective::find($request->sub_objective_id);

                                if ($subObjective) {
                                    GradeSubObjective::create([
                                        'grade_id' => $grade->id,
                                        'sub_objective_id' => $subObjective->id,
                                        'main_objective_id' => $request->main_objective_id
                                    ]);
                                }
                            }

                        }
                    }
                }






                return 'done';

            }

        }

        catch(\Exception $ex)
        {
            dd($ex->getMessage());
            return back()->withErrors($ex->getMessage(). ' Refresh the webpage and try again, if still problem persists contact with administrator');
        }

        $request->session()->flash('alert-success', 'Grade added successfully');
        return to_route('admin.objectives.grades.create');
    }

    public function getSubObjectives(Request $request)
    {
        $mainObjectiveId = $request->objective_id;
        $mainObjective = MainObjective::find($mainObjectiveId);

        if (! $mainObjective) {
            return response()->json([
                'error' => 'Unable to find records, please refresh webapge and try again, if still problem persists contact with administrator'
            ]);
        }

        if ($subObjectives = $mainObjective->subObjectives) {
            return $subObjectives;
        }
    }

    public function getAllClasses(Request $request)
    {
        $classes = StudentClass::all();

        if (count($classes) < 1) {
            return response()->json([
                'error' => 'Unable to find records, please add new ages and try again.'
            ], 404);
        }

        return $classes;
    }

    public function getClassStudents(Request $request)
    {
        dd($request->all());
        $class = StudentClass::find(1);

        if (! $class) {
            return response()->json([
                'error' => 'Unable to find records, please add student and try again.'
            ], 404);
        }

        if ($class->students) {
            $students = array();
            foreach ($class->students as $studentDetail) {
                // $students[][] = $studentDetail->student ? $studentDetail->student->id: '';
                $students[] = $studentDetail->student ? $studentDetail->student->id.'&&'.$studentDetail->student->surname.' '.$studentDetail->student->middlename.' '.$studentDetail->student->forename: '';
            }
        }

        return $students;
    }

    public function getClassObjectives($class_id)
    {
        $objectives = array();
        $class = StudentClass::find($class_id);

        if ($class) {
            $objectives = Objective::where('class_id', $class_id)->get();
        }

        if (count($objectives) < 1) {
            return response()->json([
                'error' => 'No objective found'
            ]);
        }

        return $objectives;
    }
}
