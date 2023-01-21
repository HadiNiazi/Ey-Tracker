@extends('layouts.admin')

@section('title', 'Summaries | Admin Dashboard')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<style>
    .primary-bg-color {
        background-color: #006A9E;
        color: #ffffff;
    }
    .text-font {
        /* font-family: 'Quatro Slab', 'Regular' !important; */
    }
</style>
@endsection


@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-2">
            <h1>Summaries</h1>
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

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="mt-3 mb-4">
                    <form method="Get" action="{{ route('admin.analysis.summaries.index') }}">
                        <div class="form-group">
                            <label>Classes</label>
                            <select name="class" class="form-control">
                                <option value="" disabled selected>Choose Option</option>
                                @if (count($classes) > 0)
                                    @foreach ($classes as $class)
                                        <option value="{{ $class->id }}">{{ $class->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Topics</label>
                            <select name="main_objective" class="form-control">
                                <option value="" disabled selected>Choose Option</option>
                                @if (count($mainObjectives) > 0)
                                    @foreach ($mainObjectives as $objective)
                                        <option value="{{ $objective->id }}">{{ $objective->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <button class="btn btn-info btn-sm mt-2 primary-bg-color">Find Results</button>
                    </form>
                </div>

                <div class="card">
                    <div class="card-header primary-bg-color">
                      <h3 class="card-title">{{ $mainObjective ? $mainObjective->name: '' }}</h3>
                    </div>

                      <div class="card-body">
                    @if (count($students) > 0)
                        <table class="table table-bordered">
                            <thead>
                                <th>Student Name</th>
                                @if ($mainObjective)
                                    @foreach ($mainObjective->subObjectives as $objective)
                                        <th>{{ $objective->name }}</th>
                                    @endforeach
                                @endif
                                <th>Total Completed</th>
                                <th>% Completed</th>
                            </thead>
                            <tbody>

                                @php
                                    $selfRegulationCount = 0;
                                    $managingSelfCount = 0;
                                    $buildingRelationshipCount = 0;
                                @endphp

                                @foreach ($students as $key => $student)

                                    <tr>
                                        <td>{{ $student->surname }}</td>
                                        <td>
                                            @if ($grade = $student->grade)
                                                @if ($objectives = $grade->objectives)

                                                    @foreach ($objectives as $objective)
                                                    {{-- @dd($objective)
                                                    @dd($objective->sub_objective_id) --}}
                                                        @if($subObjective = $objective->pivot_sub_objective_id)
                                                            @if ($subObjective->id == 1)
                                                                @php $selfRegulationCount++; @endphp
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                    {{ $selfRegulationCount }}
                                                @endif
                                            @else
                                                0
                                            @endif
                                        </td>

                                        <td>
                                            @if ($grade = $student->grade)
                                                @if ($objectives = $grade->objectives)

                                                    @foreach ($objectives as $objective)

                                                        @if($subObjective = $objective->subObjective)
                                                            @if ($subObjective->name == 'Managing Self')
                                                                @php $managingSelfCount++; @endphp
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                    {{ $managingSelfCount }}
                                                @endif
                                            @else
                                                0
                                            @endif
                                        </td>


                                        <td>
                                            @if ($grade = $student->grade)
                                                @if ($objectives = $grade->objectives)

                                                    @foreach ($objectives as $objective)

                                                        @if($subObjective = $objective->subObjective)
                                                            @if ($subObjective->name == 'Building Relationships')
                                                                @php $buildingRelationshipCount++; @endphp
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                    {{ $buildingRelationshipCount }}
                                                @endif
                                            @else
                                                0
                                            @endif
                                        </td>

                                    </tr>

                                {{-- <tr>
                                    <td>{{ $detail->student ? $detail->student->surname: '' }}</td>
                                    <td>
                                        @if ($student = $detail->student)
                                            @if ($grade = $student->grade)
                                                @if ($grade->subObjective)
                                                    @if($grade->subObjective->name == 'Self-Regulation')
                                                        {{ $grade->subObjective->name == 'Self-Regulation' ? 'Yes': 'No' }}
                                                    @elseif($grade->subObjective->name == 'Comprehension')
                                                        {{ $grade->subObjective->name == 'Comprehension' ? 'Yes': 'No' }}
                                                    @elseif($grade->subObjective->name == 'Past and Present')
                                                        {{ $grade->subObjective->name == 'Past and Present' ? 'Yes': 'No' }}
                                                    @elseif($grade->subObjective->name == 'Listening, Attention and Understanding')
                                                        {{ $grade->subObjective->name == 'Listening, Attention and Understanding' ? 'Yes': 'No' }}
                                                    @elseif($grade->subObjective->name == 'Number')
                                                        {{ $grade->subObjective->name == 'Number' ? 'Yes': 'No' }}
                                                    @elseif($grade->subObjective->name == 'Creating with Materials')
                                                        {{ $grade->subObjective->name == 'Creating with Materials' ? 'Yes': 'No' }}
                                                    @elseif($grade->subObjective->name == 'Gross Motor Skills')
                                                        {{ $grade->subObjective->name == 'Gross Motor Skills' ? 'Yes': 'No' }}
                                                    @else
                                                        No
                                                    @endif
                                                @endif

                                            @else
                                                No
                                            @endif
                                        @else
                                            No
                                        @endif
                                    </td>

                                    <td>
                                        @if ($student = $detail->student)
                                            @if ($grade = $student->grade)

                                                @if ($grade->subObjective)
                                                    @if($grade->subObjective->name == 'Managing Self')
                                                        {{ $grade->subObjective->name == 'Managing Self' ? 'Yes': 'No' }}
                                                    @elseif($grade->subObjective->name == 'Word Reading')
                                                        {{ $grade->subObjective->name == 'Word Reading' ? 'Yes': 'No' }}
                                                    @elseif($grade->subObjective->name == 'People, Culture and Communities')
                                                        {{ $grade->subObjective->name == 'People, Culture and Communities' ? 'Yes': 'No' }}
                                                    @elseif($grade->subObjective->name == 'Speaking')
                                                        {{ $grade->subObjective->name == 'Speaking' ? 'Yes': 'No' }}
                                                    @elseif($grade->subObjective->name == 'Numerical Patterns')
                                                        {{ $grade->subObjective->name == 'Numerical Patterns' ? 'Yes': 'No' }}
                                                    @elseif($grade->subObjective->name == 'Being Imaginative and Expressive')
                                                        {{ $grade->subObjective->name == 'Being Imaginative and Expressive' ? 'Yes': 'No' }}
                                                    @elseif($grade->subObjective->name == 'Fine Motor Skills')
                                                        {{ $grade->subObjective->name == 'Fine Motor Skills' ? 'Yes': 'No' }}
                                                    @else
                                                        No
                                                    @endif
                                                @endif

                                            @else
                                                No
                                            @endif
                                        @else
                                            No
                                        @endif
                                    </td>

                                    @if ($student = $detail->student)
                                        @if ($grade = $student->grade)
                                            @if ($grade->subObjective)

                                                @if ($grade->subObjective->name == 'Self-Regulation' || $grade->subObjective->name == 'Managing Self' || $grade->subObjective->name == 'Building Relationships' ||
                                                    $grade->subObjective->name == 'Comprehension' || $grade->subObjective->name == 'Word Reading' || $grade->subObjective->name == 'Writing' ||
                                                    $grade->subObjective->name == 'Past and Present' || $grade->subObjective->name == 'People, Culture and Communities' || $grade->subObjective->name == 'The Natural World'
                                                )

                                                <td>
                                                    @if ($student = $detail->student)
                                                        @if ($grade = $student->grade)
                                                            @if ($grade->subObjective)
                                                                @if($grade->subObjective->name == 'Building Relationships')
                                                                    {{ $grade->subObjective->name == 'Building Relationships' ? 'Yes': 'No' }}
                                                                @elseif($grade->subObjective->name == 'Writing')
                                                                    {{ $grade->subObjective->name == 'Writing' ? 'Yes': 'No' }}
                                                                @elseif($grade->subObjective->name == 'The Natural World')
                                                                    {{ $grade->subObjective->name == 'The Natural World' ? 'Yes': 'No' }}
                                                                @else
                                                                    No
                                                                @endif
                                                            @endif
                                                        @else
                                                            No
                                                        @endif
                                                    @else
                                                        No
                                                    @endif
                                                </td>

                                                @endif

                                            @endif
                                        @endif
                                    @endif

                                    <td>
                                        @php $count = 0 @endphp
                                        @if ($student = $detail->student)
                                            @if ($grade = $student->grade)
                                                @php
                                                    $count += $grade->subObjective->name == 'Self-Regulation' ? 1: 0;
                                                    $count += $grade->subObjective->name == 'Managing Self' ? 1: 0;
                                                    $count += $grade->subObjective->name == 'Building Relationships'  ? 1: 0;

                                                    $count += $grade->subObjective->name == 'Comprehension' ? 1: 0;
                                                    $count += $grade->subObjective->name == 'Word Reading'  ? 1: 0;
                                                    $count += $grade->subObjective->name == 'Writing'  ? 1: 0;

                                                    $count += $grade->subObjective->name == 'Past and Present' ? 1: 0;
                                                    $count += $grade->subObjective->name == 'People, Culture and Communities'  ? 1: 0;
                                                    $count += $grade->subObjective->name == 'The Natural World'  ? 1: 0;

                                                    $count += $grade->subObjective->name == 'Listening, Attention and Understanding' ? 1: 0;
                                                    $count += $grade->subObjective->name == 'Speaking' ? 1: 0;

                                                    $count += $grade->subObjective->name == 'Number' ? 1: 0;
                                                    $count += $grade->subObjective->name == 'Numerical Patterns'  ? 1: 0;

                                                    $count += $grade->subObjective->name == 'Creating with Materials' ? 1: 0;
                                                    $count += $grade->subObjective->name == 'Being Imaginative and Expressive' ? 1: 0;

                                                    $count += $grade->subObjective->name == 'Gross Motor Skills' ? 1: 0;
                                                    $count += $grade->subObjective->name == 'Fine Motor Skills' ? 1: 0;


                                                    echo $count;
                                                @endphp
                                            @endif
                                        @endif
                                    </td>

                                        <td>{{ $count ? number_format( ($count / $totalObjectivesCount) * 100)  : 0 }}</td>

                                </tr> --}}
                                @endforeach

                            </tbody>
                        </table>
                        @else
                        <h3 class="text-center text-danger text-bold">No Student found</h3>
                    @endif
                      </div>
                </div>


                <!-- /.cards -->
                </div>
            </div>
            <!-- /.row -->
          </div>

    </section>
    <!-- /.content -->
  </div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<script src="{{ asset('assets/admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script>
    $(document).ready(function() {

        $('#objective').change(function() {

            $('#sub_objective').empty();
            $("<option/>", {
                value: '',
                text: 'Choose Option',
                // disabled: 'disabled'
            }).appendTo('#sub_objective');

            var objective_id = this.value;

            $.ajax({
                url: "{{ route('admin.get.sub-objectives') }}",
                type: "GET",
                data: { objective_id },
                success: function (response) {

                    $.each(response, function(index, value){
                        $("<option/>", {
                            value: value.id,
                            text: value.name
                        }).appendTo('#sub_objective');

                        $('.selectpicker').selectpicker('refresh')

                        });

                },
                error: function (error) {
                    toastr["error"]('Something went wrong, please refresh the webpage and try again, if still problem persists, contact with administrator');
                }
            });

        })

        $('#sub_objective').change(function() {

            var sub_objective_id = this.value;

            $('#classes').empty();
            $("<option/>", {
                value: '',
                text: 'Choose Option',
                // disabled: 'disabled'
            }).appendTo('#classes');



            $.ajax({
                url: "{{ route('admin.get.classes') }}",
                type: "GET",
                data: { sub_objective_id },
                success: function (response) {

                    $.each(response, function(index, value){
                        $("<option/>", {
                            value: value.id,
                            text: value.name
                        }).appendTo('#classes');

                        $('.selectpicker').selectpicker('refresh')

                        });

                },
                error: function (error) {

                    if (error.responseJSON) {
                        toastr["error"](error.responseJSON.error);
                    }
                    else {
                       toastr["error"]('Something went wrong, please refresh the webpage and try again, if still problem persists, contact with administrator');
                    }

                }
            });

        });

    });
</script>
@endsection
