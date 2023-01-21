@extends('layouts.admin')

@section('title', 'View Admission | Admin Dashboard')

@section('styles')
@endsection


@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Admissions</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.students.create') }}">New Admission</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="container-fluid">
            <div class="card">
                <!-- /.card-header -->
                <div class="card-body">
                    <h3 class="heading">General Details</h3>
                    <table class="table">
                        <tr>
                            <th>Surname</th>
                            <td>{{ $student->surname ? $student->surname: '' }}<td>
                        </tr>
                        <tr>
                            <th>Middle Name</th>
                            <td>{{ $student->middlename ? $student->middlename: '' }}</td>
                        </tr>
                        <tr>
                            <th>Forename</th>
                            <td>{{ $student->forename ? $student->forename: '' }}</td>
                        </tr>
                        <tr>
                            <th>Date of Birth</th>
                            <td>{{ date('d-m-Y', strtotime($student->dob)) }}</td>
                        </tr>
                        <tr>
                            <th>Gender</th>
                            <td>{{ $student->studentDetail ? $student->studentDetail->gender: '' }}</td>
                        </tr>
                        <tr>
                            <th>Ethnicity</th>
                            <td>{{ $student->studentDetail ? ucfirst(str_replace('-', ' ', $student->studentDetail->ethnicity)) : '' }}</td>
                        </tr>
                        <tr>
                            <th>Other Ethnicity</th>
                            <td>{{ $student->studentDetail ? $student->studentDetail->other_ethnicity: '' }}</td>
                        </tr>

                        <tr>
                            <th>Status</th>
                            <td>{{ ucfirst($student->type) }}</td>
                        </tr>
                        <tr>
                            <th>Status Date</th>
                            <td>{{ date('d-m-Y', strtotime($student->status_date)) }}</td>
                        </tr>
                        <tr>
                            <th>Class</th>
                            <td>
                                @if($student->studentDetail)
                                    @if($student->studentDetail->class)
                                        {{ $student->studentDetail->class->name }}
                                    @endif
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>

            <div class="card">
                <div class="card-body">
                    <h3 class="heading">Additional Details</h3>
                    <table class="table">
                        <tr>
                            <th>Email</th>
                            <td>{{ $student->studentContact ? $student->studentContact->email: '' }}<td>
                        </tr>
                        <tr>
                            <th>Telephone</th>
                            <td>{{ $student->studentContact ? $student->studentContact->telephone: '' }}</td>
                        </tr>
                        <tr>
                            <th>Mobile</th>
                            <td>{{ $student->studentContact ? $student->studentContact->mobile: '' }}</td>
                        </tr>
                        <tr>
                            <th>FSM</th>
                            <td>{{ $student->studentDetail ? $student->studentDetail->fsm == 1 ? 'Yes' : 'No' : '' }}</td>
                        </tr>
                        <tr>
                            <th>EAL</th>
                            <td>{{ $student->studentDetail ? $student->studentDetail->eal == 1 ? 'Yes' : 'No' : '' }}</td>
                        </tr>
                        <tr>
                            <th>SEN</th>
                            <td>{{ $student->studentDetail ? $student->studentDetail->sen == 1 ? 'Yes' : 'No' : '' }}</td>
                        </tr>
                        <tr>
                            <th>Country</th>
                            <td>
                                @if ($student->studentAddress)
                                    @if ($student->studentAddress->country)
                                        {{ $student->studentAddress->country->name }}
                                    @endif
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Lives with</th>
                            <td>{{ $student->studentDetail ? ucfirst($student->studentDetail->lives_with) : '' }}</td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td>{{ $student->studentAddress ? Str::limit($student->studentAddress->address, 50) : '' }}</td>
                        </tr>
                        <tr>
                            <th>Post Code</th>
                            <td>{{ $student->studentAddress ? $student->studentAddress->post_code: '' }}</td>
                        </tr>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>

            <div class="card">
                <div class="card-body">
                    <h3 class="heading">Health Details</h3>
                    <table class="table">
                        <tr>
                            <th>Doctor/Surgery Name</th>
                            <td>{{ $student->studentHealth ? $student->studentHealth->doctor_name: '' }}<td>
                        </tr>
                        <tr>
                            <th>Telephone</th>
                            <td>{{ $student->studentHealth ? $student->studentHealth->doctor_telephone: '' }}</td>
                        </tr>
                        <tr>
                            <th>Doctor Address</th>
                            <td>{{ $student->studentHealth ? $student->studentHealth->doctor_address: ''}}</td>
                        </tr>
                        <tr>
                            <th>Medical Condition</th>
                            <td>{{ $student->studentHealth ? $student->studentHealth->medical_condition: '' }}</td>
                        </tr>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>

            <div class="card">
                <div class="card-body">
                    <h3 class="heading">Emergency Contact Details</h3>
                    <h6 class="mt-4"><strong>Priority 1</strong></h6>
                    <table class="table">
                        <tr>
                            <th>Contact Name</th>
                            <td>{{ $student->studentEmergency ? $student->studentEmergency->name_1: '' }}<td>
                        </tr>
                        <tr>
                            <th>Relationship to pupil</th>
                            <td>{{ $student->studentEmergency ? $student->studentEmergency->relationship_1: '' }}</td>
                        </tr>
                        <tr>
                            <th>Contact Number</th>
                            <td>{{ $student->studentEmergency ? $student->studentEmergency->phone_1: '' }}</td>
                        </tr>
                    </table>
                    <hr>

                    <h6 class="mt-4"><strong>Priority 2</strong></h6>
                    <table class="table">
                        <tr>
                            <th>Contact Name</th>
                            <td>{{ $student->studentEmergency ? $student->studentEmergency->name_2: '' }}<td>
                        </tr>
                        <tr>
                            <th>Relationship to pupil</th>
                            <td>{{ $student->studentEmergency ? $student->studentEmergency->relationship_2: '' }}</td>
                        </tr>
                        <tr>
                            <th>Contact Number</th>
                            <td>{{ $student->studentEmergency ? $student->studentEmergency->phone_2: '' }}</td>
                        </tr>
                    </table>
                    <hr>

                    <h6 class="mt-4"><strong>Priority 3</strong></h6>
                    <table class="table">
                        <tr>
                            <th>Contact Name</th>
                            <td>{{ $student->studentEmergency ? $student->studentEmergency->name_3: '' }}<td>
                        </tr>
                        <tr>
                            <th>Relationship to pupil</th>
                            <td>{{ $student->studentEmergency ? $student->studentEmergency->relationship_3: '' }}</td>
                        </tr>
                        <tr>
                            <th>Contact Number</th>
                            <td>{{ $student->studentEmergency ? $student->studentEmergency->phone_3: '' }}</td>
                        </tr>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>

            <div class="card">
                <div class="card-body">
                    <h3 class="heading">Parent Details</h3>
                    <h6 class="mt-4"><strong>Father Details</strong></h6>
                    <table class="table">
                        <tr>
                            <th>Name</th>
                            <td>{{ $student->studentParent ? $student->studentParent->father_name: '' }}<td>
                        </tr>
                        <tr>
                            <th>Home telephone</th>
                            <td>{{ $student->studentParent ? $student->studentParent->father_home_telephone: '' }}</td>
                        </tr>
                        <tr>
                            <th>Work telephone</th>
                            <td>{{ $student->studentParent ? $student->studentParent->father_work_telephone: '' }}</td>
                        </tr>
                        <tr>
                            <th>Mobile</th>
                            <td>{{ $student->studentParent ? $student->studentParent->father_mobile: '' }}</td>
                        </tr>
                        <tr>
                            <th>Occupation</th>
                            <td>{{ $student->studentParent ? $student->studentParent->father_ocuupation: '' }}</td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td>{{ $student->studentParent ? $student->studentParent->father_address: '' }}</td>
                        </tr>
                    </table>

                    <h6 class="mt-4"><strong>Mother Details</strong></h6>
                    <table class="table">
                        <tr>
                            <th>Name</th>
                            <td>{{ $student->studentParent ? $student->studentParent->mother_name: '' }}<td>
                        </tr>
                        <tr>
                            <th>Home telephone</th>
                            <td>{{ $student->studentParent ? $student->studentParent->mother_home_telephone: '' }}</td>
                        </tr>
                        <tr>
                            <th>Work telephone</th>
                            <td>{{ $student->studentParent ? $student->studentParent->mother_work_telephone: '' }}</td>
                        </tr>
                        <tr>
                            <th>Mobile</th>
                            <td>{{ $student->studentParent ? $student->studentParent->mother_mobile: '' }}</td>
                        </tr>
                        <tr>
                            <th>Occupation</th>
                            <td>{{ $student->studentParent ? $student->studentParent->mother_ocuupation: '' }}</td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td>{{ $student->studentParent ? $student->studentParent->mother_address: '' }}</td>
                        </tr>
                    </table>

                </div>
                <!-- /.card-body -->
            </div>

            <div class="card">
                <div class="card-body">
                    <h3 class="heading">School Details</h3>
                    <h6 class="mt-4"><strong>Previous School Details</strong></h6>
                    <table class="table">
                        <tr>
                            <th>Name</th>
                            <td>{{ $student->studentSchool ? $student->studentSchool->previous_school: '' }}<td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>{{ ucfirst($student->studentSchool ? $student->studentSchool->status: '') }}</td>
                        </tr>
                        <tr>
                            <th>Status Date</th>
                            <td>{{ date('d-m-Y', strtotime($student->studentSchool ? $student->studentSchool->previous_school_left_date: '')) }}</td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td>{{ $student->studentSchool ? $student->studentSchool->previous_school_address: '' }}</td>
                        </tr>
                        <tr>
                            <th>Reason For Leaving</th>
                            <td>{{ $student->studentSchool ? $student->studentSchool->reason_for_leaving: '' }}</td>
                        </tr>
                    </table>
                    <hr>

                    <h6 class="mt-4"><strong>New School Details</strong></h6>
                    <table class="table">
                        <tr>
                            <th>Name</th>
                            <td>{{ $student->studentSchool ? $student->studentSchool->new_school: '' }}<td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td>{{ $student->studentSchool ? $student->studentSchool->new_school_address: '' }}</td>
                        </tr>
                    </table>

                </div>
                <!-- /.card-body -->
            </div>

            <div class="card">
                <div class="card-body">
                    <h3 class="heading">Missing Details</h3>
                    <table class="table">
                        <tr>
                            <th>Missing Status</th>
                            <td>{{ $student->studentSchool ? $student->studentSchool->student_missing_status == 1 ? 'Yes': 'No' : '' }}<td>
                        </tr>
                        <tr>
                            <th>Local Authority</th>
                            <td>{{ $student->studentSchool ? $student->studentSchool->student_la_contacted == 1 ? 'Yes': 'No' : '' }}</td>
                        </tr>
                        <tr>
                            <th>Date LA Contacted</th>
                            <td>{{ $student->studentSchool ? date('d-m-Y', strtotime($student->studentSchool->student_missing_date)) : '' }}</td>
                        </tr>
                        <tr>
                            <th>Note</th>
                            <td>{{ $student->studentSchool ? $student->studentSchool->student_missing_note : '' }}</td>
                        </tr>
                    </table>


                </div>
                <!-- /.card-body -->
            </div>

            <div class="card">
                <div class="card-body">
                    <h3 class="heading">Permission from parents</h3>
                    <table class="table">
                        <tr>
                            <th>I give consent to the school to seek medical treatment or advice, for my child in any case of emergency for my child.</th>
                            <td>{{ $student->studentPermission ? $student->studentPermission->consent_1 == 1 ? 'Yes': 'No' : '' }}<td>
                        </tr>
                        <tr>
                            <th>I give consent to the school to take my child for visits in the local area with appropriate adult supervision.</th>
                            <td>{{ $student->studentPermission ? $student->studentPermission->consent_2 == 1 ? 'Yes': 'No' : '' }}</td>
                        </tr>
                        <tr>
                            <th>I give consent for my child’s photograph/video to be taken/uploaded for the following: (Photographs will only be taken for educational / Ofsted purposes)</th>
                            <td>{{ $student->studentPermission ? $student->studentPermission->consent_3 == 1 ? 'Yes': 'No' : '' }}</td>
                        </tr>
                        <tr>
                            <th>School Website</th>
                            <td>{{ $student->studentPermission ? $student->studentPermission->consent_4 == 1 ? 'Yes': 'No' : '' }}</td>
                        </tr>
                        <tr>
                            <th>School Social Media Accounts</th>
                            <td>{{ $student->studentPermission ? $student->studentPermission->consent_5 == 1 ? 'Yes': 'No' : '' }}</td>
                        </tr>
                    </table>


                </div>
                <!-- /.card-body -->
            </div>

        </div>
    <!-- /.content -->
  </div>
@endsection

@section('scripts')
@endsection
