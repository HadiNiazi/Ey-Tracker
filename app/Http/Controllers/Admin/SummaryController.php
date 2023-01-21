<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\MainObjective;
use App\Models\Objective;
use App\Models\Student;
use App\Models\StudentClass;
use App\Models\StudentDetail;
use App\Models\SubObjective;
use Illuminate\Http\Request;

class SummaryController extends Controller
{
    public function index(Request $request)
    {
        $listeningId = 0;
        $listeningObjectiveCount = 0;
        $speakingId = 0;
        $speakingObjectiveCount = 0;
        $selfRegulationId = 0;
        $selfRegulationObjectiveCount = 0;
        $managingSelfId = 0;
        $managingSelfObjectiveCount = 0;
        $buildingRelationshipId = 0;
        $buildingRelationshipObjectiveCount = 0;
        $comprehensionId = 0;
        $comprehensionObjectiveCount = 0;
        $wordReadingId = 0;
        $wordReadingObjectiveCount = 0;
        $writingId = 0;
        $writingObjectiveCount = 0;
        $pastPresentId = 0;
        $pastPresentObjectiveCount = 0;
        $peopleCCId = 0;
        $peopleCCObjectiveCount = 0;
        $naturalWorldId = 0;
        $naturalWorldObjectiveCount = 0;
        $numberId = 0;
        $numberObjectiveCount = 0;
        $numericalPatternId = 0;
        $numericalPatternObjectiveCount = 0;
        $materialId = 0;
        $materialObjectiveCount = 0;
        $imaginativeExpenssiveId = 0;
        $imaginativeExpenssiveObjectiveCount = 0;
        $grossMotorSkillId = 0;
        $grossMotorSkillObjectiveCount = 0;
        $fineMotorSkillId = 0;
        $fineMotorSkillObjectiveCount = 0;

        $personalSocialCompletedCount = 0;
        $personalSocialPercentage = 0;
        $literacyCompletedCount = 0;
        $literacyPercentage = 0;

        $understandingTheWorldCompletedCount = 0;
        $understandingTheWorldPercentage = 0;
        $communicationLangugeCompletedCount = 0;
        $communicationLangugePercentage = 0;
        $mathCompletedCount = 0;
        $mathPercentage = 0;
        $artDesignCompletedCount = 0;
        $artDesignPercentage = 0;
        $personalDevelopmentCompletedCount = 0;
        $personalDevelopmentPercentage = 0;


        $classes = StudentClass::all();
        $mainObjectives = MainObjective::all();

        $mainObjective = null;
        $subObjectives = null;
        $grades = array();

        $subObjectivesCount = array();
        $totalCompletedCount = 0;
        $totalPercentageCount = 0;

        $totalObjectivesCount = null;
        $students = array();

        if ($classId = $request->class && $mainObjectiveId = $request->main_objective) {

            $totalObjectivesCount = Objective::where('class_id', $classId)->count();
            $mainObjective = MainObjective::find($request->main_objective);

            if (! $mainObjective) {
                return back()->withErrors('Unable to find main objective, Please refresh the webpage and try again, if still problem persists, contact with administrator');
            }

            // $grades = Grade::select(['student_id', 'sub_objective_id'])->where('student_class_id', $request->class)->where('main_objective_id', $mainObjective->id)
            // ->distinct('student_id')
            // ->get();

            $mainObjectiveId = $mainObjective->id;

            $studentDetails = array();

            // $studentDetails = StudentDetail::with(['student', 'grade'])->whereHas('grade', function( $query ) use ( $mainObjectiveId ) {
            //     return $query->where('main_objective_id', $mainObjectiveId);
            // })->where('class_id', $request->class)->get();

            $students = Student::with(['grade'])->get();


            // foreach ($mainObjective->subObjectives as $subObjective) {
            //     $subObjectiveFilterByStudent[] = Grade::with(['student'], function( $query ) use ($students, $count, $subObjective) {
            //     })
            //     ->where('student_class_id', $request->class)->where('main_objective_id', $mainObjective->id)
            //     ->where('sub_objective_id', $subObjective->id)
            //     ->where('student_id', $students[$count]->id)
            //     ->count();
            // }

            // $students = Student::whereHas('grade' , function( $query ) use ( $mainObjective ) {
            //     $query->where('main_objective_id', $mainObjective->id);
            //     $query->where('sub_objective_id', $mainObjective->id);

            // })->get();

            // dd($students);

            $totalPercentageCount = $totalCompletedCount != 0 ? number_format(( $totalCompletedCount / $totalObjectivesCount ) * 100) : '';

            // $studentId = null;

            // $selfRegulation = SubObjective::where('name', 'Self-Regulation')->first();
            // if ($selfRegulation) {
            //     $selfRegulationId = $selfRegulation->id;
            //     $selfRegulationGrade = Grade::where('student_id', $studentId)->where('sub_objective_id', $selfRegulationId)->select('objective_id')->whereNotNull('objective_status_id')->distinct()->get();

            //     if ($selfRegulationGrade) {
            //         $selfRegulationObjectiveCount = $selfRegulationGrade->count();
            //     }
            // }

            // $managingSelf = SubObjective::where('name', 'Managing Self')->first();
            // if ($managingSelf) {
            //     $managingSelfId = $managingSelf->id;
            //     $managingSelfGrade = Grade::where('student_id', $studentId)->where('sub_objective_id', $managingSelfId)->select('objective_id')->whereNotNull('objective_status_id')->distinct()->get();

            //     if ($managingSelfGrade) {
            //         $managingSelfObjectiveCount = $managingSelfGrade->count();
            //     }
            // }

            // $buildingRelationship = SubObjective::where('name', 'Building Relationships')->first();
            // if ($buildingRelationship) {
            //     $buildingRelationshipId = $buildingRelationship->id;
            //     $buildingRelationshipGrade = Grade::where('student_id', $studentId)->where('sub_objective_id', $buildingRelationshipId)->select('objective_id')->whereNotNull('objective_status_id')->distinct()->get();

            //     if ($buildingRelationshipGrade) {
            //         $buildingRelationshipObjectiveCount = $buildingRelationshipGrade->count();
            //     }
            // }

            // $personalSocialCompletedCount = $selfRegulationObjectiveCount + $managingSelfObjectiveCount + $buildingRelationshipObjectiveCount;
            // $personalSocialPercentage = ($personalSocialCompletedCount / $totalObjectivesCount) * 100;

            // $comprehension = SubObjective::where('name', 'Comprehension')->first();
            // if ($comprehension) {
            //     $comprehensionId = $comprehension->id;
            //     $comprehensionGrade = Grade::where('student_id', $studentId)->where('sub_objective_id', $comprehensionId)->select('objective_id')->whereNotNull('objective_status_id')->distinct()->get();

            //     if ($comprehensionGrade) {
            //         $comprehensionObjectiveCount = $comprehensionGrade->count();
            //     }
            // }

            // $wordReading = SubObjective::where('name', 'Word Reading')->first();
            // if ($wordReading) {
            //     $wordReadingId = $wordReading->id;
            //     $wordReadingGrade = Grade::where('student_id', $studentId)->where('sub_objective_id', $wordReadingId)->select('objective_id')->whereNotNull('objective_status_id')->distinct()->get();

            //     if ($wordReadingGrade) {
            //         $wordReadingObjectiveCount = $wordReadingGrade->count();
            //     }
            // }

            // $writing = SubObjective::where('name', 'Writing')->first();
            // if ($writing) {
            //     $writingId = $writing->id;
            //     $writingGrade = Grade::where('student_id', $studentId)->where('sub_objective_id', $writingId)->select('objective_id')->whereNotNull('objective_status_id')->distinct()->get();

            //     if ($writingGrade) {
            //         $writingObjectiveCount = $writingGrade->count();
            //     }
            // }

            // $literacyCompletedCount = $comprehensionObjectiveCount + $wordReadingObjectiveCount + $writingObjectiveCount;
            // $literacyPercentage = ($literacyCompletedCount / $totalObjectivesCount) * 100;

            // $pastPresent = SubObjective::where('name', 'Past and Present')->first();
            // if ($pastPresent) {
            //     $pastPresentId = $pastPresent->id;
            //     $pastPresentGrade = Grade::where('student_id', $studentId)->where('sub_objective_id', $pastPresentId)->select('objective_id')->whereNotNull('objective_status_id')->distinct()->get();

            //     if ($pastPresentGrade) {
            //         $pastPresentObjectiveCount = $pastPresentGrade->count();
            //     }
            // }


            // $peopleCC = SubObjective::where('name', 'People, Culture and Communities')->first();
            // if ($peopleCC) {
            //     $peopleCCId = $peopleCC->id;
            //     $peopleCCGrade = Grade::where('student_id', $studentId)->where('sub_objective_id', $peopleCCId)->select('objective_id')->whereNotNull('objective_status_id')->distinct()->get();

            //     if ($peopleCCGrade) {
            //         $peopleCCObjectiveCount = $peopleCCGrade->count();
            //     }
            // }

            // $naturalWorld = SubObjective::where('name', 'The Natural World')->first();
            // if ($naturalWorld) {
            //     $naturalWorldId = $naturalWorld->id;
            //     $naturalWorldGrade = Grade::where('student_id', $studentId)->where('sub_objective_id', $naturalWorldId)->select('objective_id')->whereNotNull('objective_status_id')->distinct()->get();

            //     if ($naturalWorldGrade) {
            //         $naturalWorldObjectiveCount = $naturalWorldGrade->count();
            //     }
            // }


            // $understandingTheWorldCompletedCount = $comprehensionObjectiveCount + $wordReadingObjectiveCount + $writingObjectiveCount;
            // $understandingTheWorldPercentage = ($understandingTheWorldCompletedCount / $totalObjectivesCount) * 100;


            // $listening = SubObjective::where('name', 'Listening, Attention and Understanding')->first();
            // if ($listening) {
            //     $listeningId = $listening->id;
            //     $listeningGrade = Grade::where('student_id', $studentId)->where('sub_objective_id', $listeningId)->select('objective_id')->whereNotNull('objective_status_id')->distinct()->get();

            //     if ($listeningGrade) {
            //         $listeningObjectiveCount = $listeningGrade->count();
            //     }
            // }

            // $speaking = SubObjective::where('name', 'Speaking')->first();
            // if ($speaking) {
            //     $speakingId = $speaking->id;
            //     $speakingGrade = Grade::where('student_id', $studentId)->where('sub_objective_id', $speakingId)->select('objective_id')->whereNotNull('objective_status_id')->distinct()->get();

            //     if ($speakingGrade) {
            //         $speakingObjectiveCount = $speakingGrade->count();
            //     }
            // }

            // $communicationLangugeCompletedCount = $listeningObjectiveCount + $speakingObjectiveCount;
            // $communicationLangugePercentage = ($communicationLangugeCompletedCount / $totalObjectivesCount) * 100;

            // $number = SubObjective::where('name', 'Number')->first();
            // if ($number) {
            //     $numberId = $number->id;
            //     $numberGrade = Grade::where('student_id', $studentId)->where('sub_objective_id', $numberId)->select('objective_id')->whereNotNull('objective_status_id')->distinct()->get();

            //     if ($numberGrade) {
            //         $numberObjectiveCount = $numberGrade->count();
            //     }
            // }

            // $numericalPattern = SubObjective::where('name', 'Numerical Patterns')->first();
            // if ($numericalPattern) {
            //     $numericalPatternId = $numericalPattern->id;
            //     $numericalPatternGrade = Grade::where('student_id', $studentId)->where('sub_objective_id', $numericalPatternId)->select('objective_id')->whereNotNull('objective_status_id')->distinct()->get();

            //     if ($numericalPatternGrade) {
            //         $numericalPatternObjectiveCount = $numericalPatternGrade->count();
            //     }
            // }

            // $mathCompletedCount = $numberObjectiveCount + $numericalPatternObjectiveCount;
            // $mathPercentage = ($mathCompletedCount / $totalObjectivesCount) * 100;

            // $material = SubObjective::where('name', 'Creating with Materials')->first();
            // if ($material) {
            //     $materialId = $material->id;
            //     $materialGrade = Grade::where('student_id', $studentId)->where('sub_objective_id', $materialId)->select('objective_id')->whereNotNull('objective_status_id')->distinct()->get();

            //     if ($materialGrade) {
            //         $materialObjectiveCount = $materialGrade->count();
            //     }
            // }

            // $imaginativeExpenssive = SubObjective::where('name', 'Being Imaginative and Expressive')->first();
            // if ($imaginativeExpenssive) {
            //     $imaginativeExpenssiveId = $imaginativeExpenssive->id;
            //     $imaginativeExpenssiveGrade = Grade::where('student_id', $studentId)->where('sub_objective_id', $imaginativeExpenssiveId)->select('objective_id')->whereNotNull('objective_status_id')->distinct()->get();

            //     if ($imaginativeExpenssiveGrade) {
            //         $imaginativeExpenssiveObjectiveCount = $imaginativeExpenssiveGrade->count();
            //     }
            // }

            // $artDesignCompletedCount = $materialObjectiveCount + $imaginativeExpenssiveObjectiveCount;
            // $artDesignPercentage = ($artDesignCompletedCount / $totalObjectivesCount) * 100;

            // $grossMotorSkill = SubObjective::where('name', 'Gross Motor Skills')->first();
            // if ($grossMotorSkill) {
            //     $grossMotorSkillId = $grossMotorSkill->id;
            //     $grossMotorSkillGrade = Grade::where('student_id', $studentId)->where('sub_objective_id', $grossMotorSkillId)->select('objective_id')->whereNotNull('objective_status_id')->distinct()->get();

            //     if ($grossMotorSkillGrade) {
            //         $grossMotorSkillObjectiveCount = $grossMotorSkillGrade->count();
            //     }
            // }

            // $fineMotorSkill = SubObjective::where('name', 'Fine Motor Skills')->first();
            // if ($fineMotorSkill) {
            //     $fineMotorSkillId = $fineMotorSkill->id;
            //     $fineMotorSkillGrade = Grade::where('student_id', $studentId)->where('sub_objective_id', $fineMotorSkillId)->select('objective_id')->whereNotNull('objective_status_id')->distinct()->get();

            //     if ($fineMotorSkillGrade) {
            //         $fineMotorSkillObjectiveCount = $fineMotorSkillGrade->count();
            //     }
            // }

            // $personalDevelopmentCompletedCount = $grossMotorSkillObjectiveCount + $fineMotorSkillObjectiveCount;
            // $personalDevelopmentPercentage = ($personalDevelopmentCompletedCount / $totalObjectivesCount) * 100;


            // $listeningObjectivePercentage = $listeningObjectiveCount != 0 ? number_format(($listeningObjectiveCount / $totalObjectivesCount) * 100): 0;

        }

        return view('admin.analysis.summaries.index', compact(
            'totalObjectivesCount',
            'listeningId', 'listeningObjectiveCount', 'speakingId', 'speakingObjectiveCount',
            'selfRegulationId', 'selfRegulationObjectiveCount', 'managingSelfId', 'managingSelfObjectiveCount',
            'buildingRelationshipId', 'buildingRelationshipObjectiveCount', 'comprehensionId',
            'comprehensionObjectiveCount', 'wordReadingId', 'wordReadingObjectiveCount', 'writingId',
            'writingObjectiveCount', 'pastPresentId', 'pastPresentObjectiveCount', 'peopleCCId',
            'peopleCCObjectiveCount', 'naturalWorldId', 'naturalWorldObjectiveCount', 'numberId',
            'numberObjectiveCount', 'numericalPatternId', 'numericalPatternObjectiveCount', 'materialId',
            'materialObjectiveCount', 'imaginativeExpenssiveId', 'imaginativeExpenssiveObjectiveCount',
            'grossMotorSkillId', 'grossMotorSkillObjectiveCount', 'fineMotorSkillId',
            'fineMotorSkillObjectiveCount',

            'personalSocialCompletedCount', 'personalSocialPercentage', 'literacyCompletedCount', 'literacyPercentage',
            'communicationLangugePercentage', 'communicationLangugeCompletedCount', 'personalDevelopmentCompletedCount',
            'personalDevelopmentPercentage', 'mathCompletedCount', 'mathPercentage', 'understandingTheWorldCompletedCount',
            'understandingTheWorldPercentage', 'artDesignCompletedCount', 'artDesignPercentage',

            'classes', 'mainObjectives', 'mainObjective', 'subObjectives',
            'subObjectivesCount', 'totalObjectivesCount', 'students'
        ));
    }
}
