@extends('layouts.admin')

@section('title', 'Admissions | Admin Dashboard')

@section('styles')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection


@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Admissions</h1>

            {{-- <a href="{{ route('admin.students.create') }}" class="btn btn-info mt-3">Add New</a> --}}

          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Admissions</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="card card-primary card-outline">
        <div class="card-body">
          <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active currentStudents" id="custom-content-below-currentStudents-tab" data-toggle="pill" href="#custom-content-below-currentStudents" role="tab" aria-controls="custom-content-below-currentStudents" aria-selected="false">Current</a>
            </li>
            <li class="nav-item">
              <a class="nav-link  waitingStudents" id="custom-content-below-waitingStudents-tab" data-toggle="pill" href="#custom-content-below-waitingStudents" role="tab" aria-controls="custom-content-below-waitingStudents" aria-selected="false">Waiting</a>
            </li>
            <li class="nav-item">
              <a class="nav-link graduateStudents" id="custom-content-below-graduateStudents-tab" data-toggle="pill" href="#custom-content-below-graduateStudents" role="tab" aria-controls="custom-content-below-graduateStudents" aria-selected="false">Graduates</a>
            </li>
            <li class="nav-item">
              <a class="nav-link leaveStudents" id="custom-content-below-leaveStudents-tab" data-toggle="pill" href="#custom-content-below-leaveStudents" role="tab" aria-controls="custom-content-below-leaveStudents" aria-selected="true">Leavers</a>
            </li>
          </ul>
          <div class="tab-content" id="custom-content-below-tabContent">
            <div class="tab-pane fade show active" id="custom-content-below-currentStudents" role="tabpanel" aria-labelledby="custom-content-below-currentStudents-tab">



              <div class="card">
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="example" class="table table-bordered table-striped example">
                    <thead>
                      <tr>
                        <th>Surname</th>
                        <th>Forename</th>
                        <th>Date of Birth</th>
                        <th>Class</th>
                        <th>Status</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Surname</th>
                        <th>Forename</th>
                        <th>Date of Birth</th>
                        <th>Class</th>
                        <th>Status</th>
                        <th>Actions</th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->

          </div>
        </div>
        <!-- /.card -->
      </div>

    </section>
    <!-- /.content -->
  </div>
@endsection

@section('scripts')
<!-- DataTables  & Plugins -->
<script src="{{ asset('assets/admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>

<script src="{{ asset('assets/admin/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>

<script src="{{ asset('assets/admin/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

<script>
  $(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var betType = 'current';
    var table = $("#example").DataTable({
              processing: true,
              serverSide: true,
              ajax: "{{ route('admin.students.index', '') }}"+ '?type=' + betType,
              columns: [
                  {data: 'surname'},
                  {data: 'forename'},
                  {data: 'dob'},
                  {data: 'class'},
                  {data: 'type'},
                  {data: 'action', name: 'action', orderable: false, searchable: false},
              ]
    })


    $('.currentStudents').click(function() {

      betType = 'current';
      $("#example").DataTable().destroy();
      var table = $("#example").DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.students.index', '') }}"+ '?type=' + betType,
                columns: [
                    {data: 'surname'},
                    {data: 'forename'},
                    {data: 'dob'},
                    {data: 'class'},
                    {data: 'type'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                  ]
      });

    });

    $('.waitingStudents').click(function() {

      betType = 'waiting';
      $("#example").DataTable().destroy();
        var table = $("#example").DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.students.index', '') }}"+ '?type=' + betType,
                columns: [
                    {data: 'surname'},
                    {data: 'forename'},
                    {data: 'dob'},
                    {data: 'class'},
                    {data: 'type'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                  ]
      });

    });

    $('.leaveStudents').click(function() {

      betType = 'leaved';
      $("#example").DataTable().destroy();
        var table = $("#example").DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.students.index', '') }}"+ '?type=' + betType,
                columns: [
                    {data: 'surname'},
                    {data: 'forename'},
                    {data: 'dob'},
                    {data: 'class'},
                    {data: 'type'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                  ]
      });

    });

    $('.graduateStudents').click(function() {
      betType = 'graduated';

      $("#example").DataTable().destroy();
        var table = $("#example").DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.students.index', '') }}"+ '?type=' + betType,
                columns: [
                    {data: 'surname'},
                    {data: 'forename'},
                    {data: 'dob'},
                    {data: 'class'},
                    {data: 'type'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                  ]
      });

    });


    // Deleting Bet Type
    $('body').on('click', '.deleteButton', function () {

      var studentId = $(this).data("id");

      if(confirm("Are you sure want to delete !")){
          $.ajax({
          type: "DELETE",
          url: "{{ route('admin.students.destroy', '') }}" +'/'+ studentId,
          success: function (data) {
            toastr['info'](data.success)
              table.draw();
          },
          error: function (data) {

              if(data.error){
                 toastr['error'](data.error)
              }
              else {
                toastr['error']('Something went wrong, please refresh webpage and try again.')
              }
          }
          });
      }

      });


  });

</script>
@endsection
