@extends('layouts.admin')

@section('title', 'Edit Admission | Admin Dashboard')

@section('styles')
@endsection


@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Admissions</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Edit Admission</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="container-fluid">
            <div class="row">
              <!-- left column -->
              <div class="col-md-12">
                <!-- jquery validation -->
                <div class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title">Edit Student</h3>
                  </div>
                  <!-- /.card-header -->

                   @if ($errors->any())
                    <div class="alert alert-danger mt-3">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                  <!-- form start -->
                  <form method="post" action="{{ route('admin.students.update', $student->id, $student->test) }}" id="quickForm" novalidate="novalidate">
                    @csrf
                    @method('PUT')

                    <div class="card-body">

                      <h5 class="mt-4 mb-2"><b>General Details</b></h5>
                      <div class="row">
                          <div class="col-md-4">
                              <div class="form-group">
                                  <label class="col-form-label">Surname <span style="color:red;"> *</span> </label>
                                  <input autocomplete="no" class="form-control m-input col-md-12" name="surname" value="{{ old('surname', $student->surname) }}" type="text" placeholder="Surname" required="">
                              </div>
                          </div>
                          <div class="col-md-4">
                              <div class="form-group">
                                  <label class="col-form-label">Middle Name </label>
                                  <input autocomplete="no" class="form-control m-input col-md-12" name="middlename" value="{{ old('middlename', $student->middlename) }}" placeholder="Middle Name" type="text">
                              </div>
                          </div>
                          <div class="col-md-4">
                              <div class="form-group">
                                  <label class="col-form-label">Forename <span style="color:red;"> *</span></label>
                                  <input autocomplete="no" class="form-control m-input col-md-12" name="forename" value="{{ old('forename', $student->forename) }}" type="text" placeholder="Forename" required="">
                              </div>
                          </div>
                      </div>

                      <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="col-form-label">Gender <span style="color:red;"> *</span> </label>
                                <select name="gender" class="form-control">
                                    <option disabled value="" selected>Choose Option</option>
                                  <option @selected(old('gender', $student->studentDetail ? $student->studentDetail->gender: '') == 'male' ) value="male">Male</option>
                                  <option @selected(old('gender', $student->studentDetail ? $student->studentDetail->gender: '') == 'female' ) value="female">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                              <label class="col-form-label">Date of Birth <span style="color:red;"> *</span> </label>
                              <input autocomplete="no" class="form-control m-input col-md-12" name="dob" type="date" value="{{ old('dob', $student->dob) }}" required="">
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label class="col-form-label">Ethnicity <span style="color:red;"> *</span></label>
                            <select class="form-control m-input col-md-12" name="ethnicity" id="ethnicity">
                              <option disabled selected>Select Option</option>
                              <option value="{{ $student->studentDetail ? $student->studentDetail->ethnicity: '' }}" selected>{{ $student->studentDetail ? ucfirst(str_replace('-', ' ', $student->studentDetail->ethnicity)) : '' }}</option>
                              <option value="white-irish">White Irish</option>
                              <option value="white-british">White British</option>
                              <option value="mixed-white/Black Caribbean">Mixed White/Black Caribbean</option>
                              <option value="mixed-white/Black African">Mixed White/Black African</option>
                              <option value="mixed-white/Indian">Mixed White/Indian</option>
                              <option value="mixed-white/Pakistani">Mixed White/Pakistani</option>
                              <option value="mixed-white/Bangladeshi">Mixed White/Bangladeshi</option>
                              <option value="mixed-white/Chinese">Mixed White/Chinese</option>
                              <option value="asian-indian">Asian Indian</option>
                              <option value="asian-pakistani">Asian Pakistani</option>
                              <option value="asian-bangladeshi">Asian Bangladeshi</option>
                              <option value="asian-chinese">Asian Chinese</option>
                              <option value="black-african">Black African</option>
                              <option value="black-caribbean">Black Caribbean</option>
                              <option value="arab">Arab</option>
                              <option value="other">Other</option>
                          </select>
                          </div>
                      </div>


                    <div class="col-md-12" id="other_ethnicity_div">
                        <div class="form-group">
                            <label class="col-form-label">Other Ethnicity</label>
                            <input autocomplete="no" class="form-control m-input col-md-12" name="other_ethnicity" type="text" value="{{ old('other_ethnicity', $student->studentDetail ? $student->studentDetail->other_ethnicity : '') }}" placeholder="Other Ethnicity">
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-form-label">Class</label>
                            <select name="class" class="form-control">
                                <option value="" disabled selected>Choose Option</option>
                                @if (count($classes) > 0)
                                    @foreach ($classes as $class)
                                        <option @selected(old('class', $class->id)) value="{{ $class->id }}">{{ $class->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                       </div>

                      <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-form-label">Student Status</label>
                            <select name="student_status" id="student_status" class="form-control">
                              <option disabled selected>Choose Option</option>
                              <option @selected($student->type == 'current') value="current">Current</option>
                              <option @selected($student->type == 'waiting') value="waiting">Waiting</option>
                              <option @selected($student->type == 'leaved') value="leaved">Leaved</option>
                              <option @selected($student->type == 'graduated') value="graduated">Graduated</option>
                            </select>
                        </div>
                      </div>

                      <div class="col-md-12" id="status_date_div">
                        <div class="form-group">
                            <label class="col-form-label" id="status_date_label"></label>
                            <input type="date" name="status_date" id="status_date" class="form-control" value="{{ old('status_date', $student->status_date) }}">
                        </div>
                      </div>

                    </div>

                    <h5 class="mt-4 mb-2"><b>Additional Details</b></h5>

                    <div class="row">
                      <div class="col-md-4">
                          <div class="form-group">
                              <label class="col-form-label">Email <span style="color:red;"> *</span> </label>
                              <input autocomplete="no" class="form-control m-input col-md-12" name="student_email" value="{{ old('student_email', $student->studentContact ? $student->studentContact->email : '') }}" placeholder="Email" type="email" required="">
                          </div>
                      </div>
                      <div class="col-md-4">
                          <div class="form-group">
                              <label class="col-form-label">Telephone <span style="color:red;"> *</span> </label>
                              <input autocomplete="no" class="form-control m-input col-md-12" name="student_telephone" id="student_telephone" value="{{ old('student_telephone', $student->studentContact ? $student->studentContact->telephone: '') }}" placeholder="Telephone" type="text">
                              <span style="color: gray" value="copy" onclick="copyToClipboard('student_telephone')"> <i class="fas fa-clipboard"></i> </span> <span id="student_telephone_copied_msg" style="float: right" class="text-success"></span>
                          </div>
                      </div>
                      <div class="col-md-4">
                          <div class="form-group">
                              <label class="col-form-label">Mobile <span style="color:red;"> *</span></label>
                              <input autocomplete="no" class="form-control m-input col-md-12" name="student_mobile" id="student_mobile" value="{{ old('student_mobile', $student->studentContact ? $student->studentContact->mobile: '') }}" placeholder="Mobile" type="text" required="">
                              <span style="color: gray" value="copy" onclick="copyToClipboard('student_mobile')"> <i class="fas fa-clipboard"></i> </span> <span id="student_mobile_copied_msg" style="float: right" class="text-success"></span>
                          </div>
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-md-4">
                          <div class="form-group">
                              <label class="col-form-label">FSM </label>
                              <select name="fsm" class="form-control">
                                <option value="" disabled selected>Choose Option</option>
                                <option value="1" @selected(old('fsm', $student->studentDetail ? $student->studentDetail->fsm: '') == 1)>Yes</option>
                                <option value="0" @selected(old('fsm', $student->studentDetail ? $student->studentDetail->fsm: '') == 0)>No</option>
                              </select>
                          </div>
                      </div>
                      <div class="col-md-4">
                          <div class="form-group">
                              <label class="col-form-label">EAL </label>
                              <select name="eal" class="form-control">
                                <option value="" disabled selected>Choose Option</option>
                                <option value="1" @selected(old('eal', $student->studentDetail ? $student->studentDetail->eal: '') == 1)>Yes</option>
                                <option value="0" @selected(old('eal', $student->studentDetail ? $student->studentDetail->eal: '') == 0)>No</option>
                              </select>
                          </div>
                      </div>
                      <div class="col-md-4">
                          <div class="form-group">
                              <label class="col-form-label">SEN</label>
                              <select name="sen" class="form-control">
                                <option value="" disabled selected>Choose Option</option>
                                <option value="1" @selected(old('sen', $student->studentDetail ? $student->studentDetail->sen: '') == 1)>Yes</option>
                                <option value="0" @selected(old('sen', $student->studentDetail ? $student->studentDetail->sen: '') == 0)>No</option>
                              </select>
                          </div>
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-md-4">
                          <div class="form-group">
                              <label class="col-form-label">Country </label>
                              <select name="country" class="form-control">
                                <option disabled selected>Choose Option</option>
                                @if (count($countries) > 0)
                                    @foreach ($countries as $country)
                                        <option @selected(old('country', $studentAddress->country ? $studentAddress->country->id: '' ) == $country->id) value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                @endif
                              </select>
                          </div>
                      </div>

                      <div class="col-md-4">
                          <div class="form-group">
                              <label class="col-form-label">Lives With <span style="color:red;"> *</span></label>
                              <select name="lives_with" id="lives_with" class="form-control">
                                <option value="" disabled selected>Choose Option</option>
                                <option @selected(old('lives_with', $student->studentDetail ? $student->studentDetail->lives_with: '') == 'both_parents') value="both_parents">Both Parents</option>
                                <option @selected(old('lives_with', $student->studentDetail ? $student->studentDetail->lives_with: '') == 'mum') value="mum">Mum</option>
                                <option @selected(old('lives_with', $student->studentDetail ? $student->studentDetail->lives_with: '') == 'dad') value="dad">Dad</option>
                                <option @selected(old('lives_with', $student->studentDetail ? $student->studentDetail->lives_with: '') == 'other') value="other">Other</option>
                              </select>
                          </div>
                      </div>
                      <div class="col-md-4" id="pupil_lives_with">
                        <div class="form-group">
                            <label class="col-form-label">Pupil </label>
                            <input type="text" name="pupil_lives_with" class="form-control" value="{{ old('pupil_lives_with', $student->studentDetail ? $student->studentDetail->pupil_lives_with: '') }}" placeholder="Pupil Lives With">
                        </div>
                      </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-form-label">Address <span style="color:red;"> *</span> </label>
                                <textarea name="address" id="address" class="form-control" cols="30" rows="3" placeholder="Enter address here..." style="resize: none">{{ old('address', $student->studentAddress ? $student->studentAddress->address: '') }}</textarea>
                                <span style="color: gray" value="copy" onclick="copyToClipboard('address')"> <i class="fas fa-clipboard"></i> </span> <span id="address_copied_msg" style="float: right" class="text-success"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-form-label">Post Code <span style="color:red;"> *</span> </label>
                                <input autocomplete="no" class="form-control m-input col-md-12" name="post_code" value="{{ old('post_code', $student->studentAddress ? $student->studentAddress->post_code: '') }}" placeholder="Post code" type="text">
                            </div>
                        </div>
                    </div>

                    <h5 class="mt-4 mb-2"><b>Health Details</b></h5>

                    <div class="row">
                      <div class="col-md-6">
                          <div class="form-group">
                              <label class="col-form-label">Doctor/Surgery Name <span style="color:red;"> *</span> </label>
                              <input autocomplete="no" class="form-control m-input col-md-12" name="doctor_name" value="{{ old('doctor_name', $student->studentHealth ? $student->studentHealth->doctor_name: '') }}" placeholder="Email" type="text" required="">
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-group">
                              <label class="col-form-label">Telephone <span style="color:red;"> *</span> </label>
                              <input autocomplete="no" class="form-control m-input col-md-12" name="doctor_telephone" value="{{ old('doctor_telephone', $student->studentHealth ? $student->studentHealth->doctor_telephone: '') }}" placeholder="Telephone" type="text">
                          </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-12">
                          <div class="form-group">
                              <label class="col-form-label">Doctor Address <span style="color:red;"> *</span> </label>
                              <textarea name="doctor_address" class="form-control" cols="30" rows="3" style="resize: none">{{ old('doctor_address', $student->studentHealth ? $student->studentHealth->doctor_address: '') }}</textarea>
                          </div>
                      </div>
                      <div class="col-md-12">
                          <div class="form-group">
                              <label class="col-form-label">Medical Condition </label>
                              <textarea name="medical_condition" class="form-control" cols="30" rows="3" style="resize: none">{{ old('medical_condition', $student->studentHealth ? $student->studentHealth->medical_condition: '') }}</textarea>
                          </div>
                      </div>
                    </div>



                    <h5 class="mt-4 mb-2"><b>Emergency Contact Details</b></h5>

                    <h6 class="mt-2">Priority 1</h6>
                    <div class="row">
                      <div class="col-md-4">
                          <div class="form-group">
                              <label class="col-form-label">Contact Name<span style="color:red;"> *</span> </label>
                              <input autocomplete="no" class="form-control m-input col-md-12" name="emergency_contact_name_1" value="{{ old('emergency_contact_name_1', $student->studentEmergency ? $student->studentEmergency->name_1: '') }}" placeholder="Contact name" type="text" required="">
                          </div>
                      </div>
                      <div class="col-md-4">
                          <div class="form-group">
                              <label class="col-form-label">Relationship to pupil <span style="color:red;"> *</span> </label>
                              <input autocomplete="no" class="form-control m-input col-md-12" name="emergency_relationship_to_pupil_1" value="{{ old('emergency_relationship_to_pupil_1', $student->studentEmergency ? $student->studentEmergency->relationship_1: '') }}" placeholder="Relationship" type="text">
                          </div>
                      </div>
                      <div class="col-md-4">
                          <div class="form-group">
                              <label class="col-form-label">Contact Number<span style="color:red;"> *</span></label>
                              <input autocomplete="no" class="form-control m-input col-md-12" name="emergency_telephone_1" value="{{ old('emergency_telephone_1', $student->studentEmergency ? $student->studentEmergency->phone_1: '') }}" placeholder="Contact number" type="text" required="">
                          </div>
                      </div>
                    </div>

                    <h6 class="mt-2">Priority 2</h6>
                    <div class="row">
                      <div class="col-md-4">
                          <div class="form-group">
                              <label class="col-form-label">Contact Name<span style="color:red;"> *</span> </label>
                              <input autocomplete="no" class="form-control m-input col-md-12" name="emergency_contact_name_2" value="{{ old('emergency_contact_name_2', $student->studentEmergency ? $student->studentEmergency->name_2: '') }}" placeholder="Contact name" type="text" required="">
                          </div>
                      </div>
                      <div class="col-md-4">
                          <div class="form-group">
                              <label class="col-form-label">Relationship to pupil <span style="color:red;"> *</span> </label>
                              <input autocomplete="no" class="form-control m-input col-md-12" name="emergency_relationship_to_pupil_2" value="{{ old('emergency_relationship_to_pupil_2', $student->studentEmergency ? $student->studentEmergency->relationship_2: '') }}" placeholder="Relationship" type="text">
                          </div>
                      </div>
                      <div class="col-md-4">
                          <div class="form-group">
                              <label class="col-form-label">Contact Number<span style="color:red;"> *</span></label>
                              <input autocomplete="no" class="form-control m-input col-md-12" name="emergency_telephone_2" value="{{ old('emergency_telephone_2', $student->studentEmergency ? $student->studentEmergency->phone_2: '') }}" placeholder="Contact number" type="text" required="">
                          </div>
                      </div>
                    </div>

                    <h6 class="mt-2">Priority 3</h6>
                    <div class="row">
                      <div class="col-md-4">
                          <div class="form-group">
                              <label class="col-form-label">Contact Name<span style="color:red;"> *</span> </label>
                              <input autocomplete="no" class="form-control m-input col-md-12" name="emergency_contact_name_3" value="{{ old('emergency_contact_name_3', $student->studentEmergency ? $student->studentEmergency->name_3: '') }}" placeholder="Contact name" type="text" required="">
                          </div>
                      </div>
                      <div class="col-md-4">
                          <div class="form-group">
                              <label class="col-form-label">Relationship to pupil <span style="color:red;"> *</span> </label>
                              <input autocomplete="no" class="form-control m-input col-md-12" name="emergency_relationship_to_pupil_3" value="{{ old('emergency_relationship_to_pupil_3', $student->studentEmergency ? $student->studentEmergency->relationship_3: '') }}" placeholder="Relationship" type="text">
                          </div>
                      </div>
                      <div class="col-md-4">
                          <div class="form-group">
                              <label class="col-form-label">Contact Number<span style="color:red;"> *</span></label>
                              <input autocomplete="no" class="form-control m-input col-md-12" name="emergency_telephone_3" value="{{ old('emergency_telephone_3', $student->studentEmergency ? $student->studentEmergency->phone_3: '') }}" placeholder="Contact number" type="text" required="">
                          </div>
                      </div>
                    </div>


                    <h5 class="mt-4 mb-2"><b>Parent Details</b></h5>
                    <h6 class="mt-3" style="font-weight: 600">Father / Guardian Details</h6>
                    <div class="row">
                      <div class="col-md-4">
                          <div class="form-group">
                              <label class="col-form-label">Name<span style="color:red;"> *</span> </label>
                              <input autocomplete="no" class="form-control m-input col-md-12" name="father_name" value="{{ old('father_name', $student->studentParent ? $student->studentParent->father_name: '') }}" placeholder="Name" type="text" required="">
                          </div>
                      </div>
                      <div class="col-md-4">
                          <div class="form-group">
                              <label class="col-form-label">Home telephone <span style="color:red;"> *</span> </label>
                              <input autocomplete="no" class="form-control m-input col-md-12" name="father_home_telephone" value="{{ old('father_home_telephone', $student->studentParent ? $student->studentParent->father_home_telephone: '') }}" placeholder="Telephone" type="text">
                          </div>
                      </div>
                      <div class="col-md-4">
                          <div class="form-group">
                              <label class="col-form-label">Work telephone</label>
                              <input autocomplete="no" class="form-control m-input col-md-12" name="father_work_telephone" value="{{ old('father_work_telephone', $student->studentParent ? $student->studentParent->father_work_telephone: '') }}" placeholder="Telephone" type="text">
                          </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-4">
                          <div class="form-group">
                              <label class="col-form-label">Mobile<span style="color:red;"> *</span> </label>
                              <input autocomplete="no" class="form-control m-input col-md-12" name="father_mobile" value="{{ old('father_mobile', $student->studentParent ? $student->studentParent->father_mobile: '') }}" placeholder="Mobile" type="text" required="">
                          </div>
                      </div>
                      <div class="col-md-4">
                          <div class="form-group">
                              <label class="col-form-label">Occupation <span style="color:red;"> *</span> </label>
                              <input autocomplete="no" class="form-control m-input col-md-12" name="father_ocuupation" value="{{ old('father_ocuupation', $student->studentParent ? $student->studentParent->father_ocuupation: '') }}" placeholder="Occupation" type="text">
                          </div>
                      </div>
                      <div class="col-md-4">
                          <div class="form-group">
                              <label class="col-form-label">Address<span style="color:red;"> *</span></label>
                              <input autocomplete="no" class="form-control m-input col-md-12" name="father_address" id="father_address" value="{{ old('father_address', $student->studentParent ? $student->studentParent->father_address: '') }}" placeholder="Address" type="text" required="">
                              <span style="color: gray" value="copy" onclick="copyToClipboard('father_address')"> <i class="fas fa-clipboard"></i> </span> <span id="father_address_copied_msg" style="float: right" class="text-success"></span>
                          </div>
                      </div>
                    </div>


                    <h6 class="mt-3" style="font-weight: 600">Mother / Guardian Details</h6>
                    <div class="row">
                      <div class="col-md-4">
                          <div class="form-group">
                              <label class="col-form-label">Name<span style="color:red;"> *</span> </label>
                              <input autocomplete="no" class="form-control m-input col-md-12" name="mother_name" value="{{ old('mother_name', $student->studentParent ? $student->studentParent->mother_name: '') }}" placeholder="Name" type="text" required="">
                          </div>
                      </div>
                      <div class="col-md-4">
                          <div class="form-group">
                              <label class="col-form-label">Home telephone<span style="color:red;"> *</span></label>
                              <input autocomplete="no" class="form-control m-input col-md-12" name="mother_home_telephone" value="{{ old('mother_home_telephone', $student->studentParent ? $student->studentParent->mother_home_telephone: '') }}" placeholder="Telephone" type="text">
                          </div>
                      </div>
                      <div class="col-md-4">
                          <div class="form-group">
                              <label class="col-form-label">Work telephone</label>
                              <input autocomplete="no" class="form-control m-input col-md-12" name="mother_work_telephone" value="{{ old('mother_work_telephone', $student->studentParent ? $student->studentParent->mother_work_telephone: '') }}" placeholder="Telephone" type="text">
                          </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-4">
                          <div class="form-group">
                              <label class="col-form-label">Mobile<span style="color:red;"> *</span> </label>
                              <input autocomplete="no" class="form-control m-input col-md-12" name="mother_mobile" value="{{ old('mother_mobile', $student->studentParent ? $student->studentParent->mother_mobile: '') }}" placeholder="Mobile" type="text" required="">
                          </div>
                      </div>
                      <div class="col-md-4">
                          <div class="form-group">
                              <label class="col-form-label">Occupation<span style="color:red;"> *</span></label>
                              <input autocomplete="no" class="form-control m-input col-md-12" name="mother_ocuupation" value="{{ old('mother_ocuupation', $student->studentParent ? $student->studentParent->mother_ocuupation: '') }}" placeholder="Occupation" type="text">
                          </div>
                      </div>
                      <div class="col-md-4">
                          <div class="form-group">
                              <label class="col-form-label">Address<span style="color:red;"> *</span></label>
                              <input autocomplete="no" class="form-control m-input col-md-12" name="mother_address" value="{{ old('mother_address', $student->studentParent ? $student->studentParent->mother_address: '') }}" placeholder="Address" type="text" required="">
                          </div>
                      </div>
                    </div>



                    <h5 class="mt-4 mb-2"><b>School Details</b></h5>
                    <h6 class="mt-3" style="font-weight: 600">Previous School Details</h6>

                    <div class="row">
                      <div class="col-md-6">
                          <div class="form-group">
                              <label class="col-form-label">Name <span style="color:red;"> *</span></label>
                              <input autocomplete="no" class="form-control m-input col-md-12" name="previous_school" value="{{ old('previous_school', $student->studentSchool ? $student->studentSchool->previous_school: '') }}" placeholder="Previous School" type="text">
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-group">
                              <label class="col-form-label">Left Date</label>
                              <input autocomplete="no" class="form-control m-input col-md-12" name="previous_school_left_date" value="{{ old('previous_school_left_date', $student->studentSchool ? $student->studentSchool->previous_school_left_date: '') }}" type="date">
                          </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-form-label">Reason For Leaving <span style="color:red;"> *</span></label>
                            <input type="text" name="reason_for_leaving" class="form-control" placeholder="Reason for leaving..." value="{{ old('reason_for_leaving', $student->studentSchool ? $student->studentSchool->reason_for_leaving: '') }}">
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-form-label">Address<span style="color:red;"> *</span></label>
                            <textarea name="previous_school_address" class="form-control" cols="30" rows="3" placeholder="Enter previous school address" required>{{ old('previous_school_address', $student->studentSchool ? $student->studentSchool->previous_school_address: '') }}</textarea>
                        </div>
                      </div>
                    </div>


                    <h6 class="mt-3" style="font-weight: 600">New School Details</h6>

                    <div class="row">
                      <div class="col-md-12">
                          <div class="form-group">
                              <label class="col-form-label">Name</label>
                              <input autocomplete="no" class="form-control m-input col-md-12" name="new_school" value="{{ old('new_school', $student->studentSchool ? $student->studentSchool->new_school: '') }}" placeholder="New School" type="text">
                          </div>
                      </div>
                    </div>

                    <div class="row">

                      <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-form-label">Address</label>
                            <textarea name="new_school_address" class="form-control" cols="30" rows="3" placeholder="Enter New school address">{{ old('new_school_address', $student->studentSchool ? $student->studentSchool->new_school_address: '') }}</textarea>
                        </div>
                      </div>

                    </div>


                    <h6 class="mt-3" style="font-weight: 600">Student Missing Details</h6>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-form-label">Missing</label>
                            <select name="student_missing_status" class="form-control">
                                <option value="" disabled selected>Choose Option</option>
                                <option @selected($student->studentSchool ? $student->studentSchool->student_missing_status: '' == 1) value="1">Yes</option>
                                <option @selected($student->studentSchool ? $student->studentSchool->student_missing_status: '' == 0) value="0">No</option>
                            </select>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-form-label">Local Authority</label>
                            <select name="student_la_contacted" class="form-control">
                                <option value="" disabled selected>Choose Option</option>
                                <option @selected($student->studentSchool ? $student->studentSchool->student_la_contacted: '' == 1) value="1">Yes</option>
                                <option @selected($student->studentSchool ? $student->studentSchool->student_la_contacted: '' == 0) value="0">No</option>
                            </select>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-form-label">Date LA Contacted</label>
                            <input autocomplete="no" class="form-control m-input col-md-12" name="student_missing_date" value="{{ old('student_missing_date', $student->studentSchool ? $student->studentSchool->student_missing_date: '') }}" type="date">
                        </div>
                    </div>
                      <div class="col-md-6">
                          <div class="form-group">
                              <label class="col-form-label">Note </label>
                              <input autocomplete="no" class="form-control m-input col-md-12" name="student_missing_note" value="{{ old('student_missing_note', $student->studentSchool ? $student->studentSchool->student_missing_note: '') }}" placeholder="Missing note" type="text" required="">
                          </div>
                      </div>

                    </div>



                    <h5 class="mt-4 mb-2"><b>Permission from parents</b></h5>

                    <div class="row">
                      <div class="col-md-12">
                        <table class="table table-striped table-bordered table-hover">
                          <thead>
                          <tr>
                              <th>
                                Permissions
                              </th>
                              <th>
                                  Yes
                              </th>
                              <th>
                                  No
                              </th>
                          </tr>
                          </thead>
                          <tbody>
                          <tr>
                              <td>
                                  I give consent to the school to seek medical treatment or advice, for my child in any case of emergency for my child.
                              </td>

                                @if ($student->studentPermission)
                                    <td>
                                        <input type="radio" @checked($student->studentPermission ? $student->studentPermission->consent_1: '' == 1) value="1" name="consent_1" required="" class="form-control" style="height: 15px;">
                                    </td>
                                    <td>
                                        <input type="radio" @checked($student->studentPermission ? $student->studentPermission->consent_1: 0 == 0) value="0" name="consent_1" required="" class="form-control" style="height: 15px;">
                                    </td>
                                @else
                                <td>
                                    <input type="radio" value="1" name="consent_1" required="" class="form-control" style="height: 15px;">
                                </td>
                                <td>
                                    <input type="radio" value="0" name="consent_1" required="" class="form-control" style="height: 15px;">
                                </td>
                                @endif

                          </tr>
                          <tr>
                              <td>
                                  I give consent to the school to take my child for visits in the local area with appropriate adult supervision.
                              </td>
                              @if ($student->studentPermission)
                              <td>
                                  <input type="radio" @checked($student->studentPermission ? $student->studentPermission->consent_2: '' == 1) value="1" name="consent_2" required="" class="form-control" style="height: 15px;">
                              </td>
                              <td>
                                  <input type="radio" @checked($student->studentPermission ? $student->studentPermission->consent_2: '' == 0) value="0" name="consent_2" required="" class="form-control" style="height: 15px;">
                              </td>
                                @else
                                <td>
                                    <input type="radio" value="1" name="consent_2" required="" class="form-control" style="height: 15px;">
                                </td>
                                <td>
                                    <input type="radio" value="0" name="consent_2" required="" class="form-control" style="height: 15px;">
                                </td>
                                @endif
                          </tr>

                          <tr>
                              <td>
                                  I give consent for my child’s photograph/video to be taken/uploaded for the following: (Photographs will only be taken for educational / Ofsted purposes)
                              </td>
                              @if ($student->studentPermission)
                                    <td>
                                        <input type="radio" @checked($student->studentPermission ? $student->studentPermission->consent_3: '' == 1) value="1" name="consent_3" required="" class="form-control" style="height: 15px;">
                                    </td>
                                    <td>
                                        <input type="radio" @checked($student->studentPermission ? $student->studentPermission->consent_3: '' == 0) value="0" name="consent_3" required="" class="form-control" style="height: 15px;">
                                    </td>
                                @else
                                <td>
                                    <input type="radio" value="1" name="consent_3" required="" class="form-control" style="height: 15px;">
                                </td>
                                <td>
                                    <input type="radio" value="0" name="consent_3" required="" class="form-control" style="height: 15px;">
                                </td>
                                @endif
                          </tr>

                          <tr>
                              <td>
                                  School Website
                              </td>
                              @if ($student->studentPermission)
                                    <td>
                                        <input type="radio" @checked($student->studentPermission ? $student->studentPermission->consent_4: '' == 1) value="1" name="consent_4" required="" class="form-control" style="height: 15px;">
                                    </td>
                                    <td>
                                        <input type="radio" @checked($student->studentPermission ? $student->studentPermission->consent_4: '' == 0) value="0" name="consent_4" required="" class="form-control" style="height: 15px;">
                                    </td>
                                @else
                                <td>
                                    <input type="radio" value="1" name="consent_4" required="" class="form-control" style="height: 15px;">
                                </td>
                                <td>
                                    <input type="radio" value="0" name="consent_4" required="" class="form-control" style="height: 15px;">
                                </td>
                                @endif
                          </tr>
                          <tr>
                              <td>
                                  School Social Media Accounts
                              </td>

                                @if ($student->studentPermission)
                                    <td>
                                        <input type="radio" @checked($student->studentPermission ? $student->studentPermission->consent_5: '' == 1) value="1" name="consent_5" required="" class="form-control" style="height: 15px;">
                                    </td>
                                    <td>
                                        <input type="radio" @checked($student->studentPermission ? $student->studentPermission->consent_5: '' == 0) value="0" name="consent_5" required="" class="form-control" style="height: 15px;">
                                    </td>
                                @else
                                <td>
                                    <input type="radio" value="1" name="consent_5" required="" class="form-control" style="height: 15px;">
                                </td>
                                <td>
                                    <input type="radio" value="0" name="consent_5" required="" class="form-control" style="height: 15px;">
                                </td>
                                @endif

                          </tr>

                          </tbody>
                      </table>
                      </div>
                    </div>


                    <div class="container-fluid">
                      <div class="row">
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </div>
                    </div>


                    </div>
                    <!-- /.card-body -->
                  </form>
                </div>
                <!-- /.card -->
                </div>
              <!--/.col (left) -->
              <!-- right column -->
              <div class="col-md-6">

              </div>
              <!--/.col (right) -->
            </div>
            <!-- /.row -->
          </div>

    </section>
    <!-- /.content -->
  </div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {


        var lives_with = '{{ $student->studentDetail ? $student->studentDetail->lives_with: '' }}';
        if(lives_with == 'other') {
            $('#pupil_lives_with').show();
        }
        else {
            $('#pupil_lives_with').hide();
        }

        var ethnicity = '{{ $student->studentDetail ? $student->studentDetail->ethnicity: '' }}';
        if(ethnicity == 'other') {
            $('#other_ethnicity_div').show();
        }
        else {
            $('#other_ethnicity_div').hide();
        }

        $('#ethnicity').change(function() {
            var ethnicity = this.value;
            if (ethnicity === 'other') {
                $('#other_ethnicity_div').show();
            }
            else {
                $('#other_ethnicity_div').hide();
            }
        });

        // display pupil lives with when other is choosen
        $('#lives_with').change(function() {
            var lives_with = this.value;

            if (lives_with === 'other') {
                $('#pupil_lives_with').show();
            }
            else {
                $('#pupil_lives_with').hide();
            }
        });

        // Student Status Date Displayer
        var status = '{{ $student->type }}';

        if (status == 'current') {
            $('#status_date_label').html('Start Date <span style="color:red;"> *</span>');
        }
        if (status == 'waiting') {
            $('#status_date_label').html('Waiting Date <span style="color:red;"> *</span>');
        }
        if (status == 'graduated') {
            $('#status_date_label').html('Graduation Date <span style="color:red;"> *</span>');
        }
        if (status == 'leaved') {
            $('#status_date_label').html('Left Date <span style="color:red;"> *</span>');
        }

        $('#student_status').change(function() {
            var status = this.value;
            $('#status_date').val('');

            if (status == 'current') {
                $('#status_date_label').html('Start Date <span style="color:red;"> *</span>');
            }
            if (status == 'waiting') {
                $('#status_date_label').html('Waiting Date <span style="color:red;"> *</span>');
            }
            if (status == 'graduated') {
                $('#status_date_label').html('Graduation Date <span style="color:red;"> *</span>');
            }
            if (status == 'leaved') {
                $('#status_date_label').html('Left Date <span style="color:red;"> *</span>');
            }

        });
    })
</script>

<script>
    function copyToClipboard(id) {
        document.getElementById(id).select();
        document.execCommand('copy');

        if( id == 'address' ) {
            $('#address_copied_msg').html('Text copied');

            setTimeout( function() {
                $('#address_copied_msg').html('');
            }, 3000)
        }

        if( id == 'student_telephone' ) {
            $('#student_telephone_copied_msg').html('Text copied');

            setTimeout( function() {
                $('#student_telephone_copied_msg').html('');
            }, 3000)
        }

        if( id == 'student_mobile' ) {
            $('#student_mobile_copied_msg').html('Text copied');

            setTimeout( function() {
                $('#student_mobile_copied_msg').html('');
            }, 3000)
        }

        if( id == 'father_address' ) {
            $('#father_address_copied_msg').html('Text copied');

            setTimeout( function() {
                $('#father_address_copied_msg').html('');
            }, 3000)
        }
    }
</script>
@endsection
