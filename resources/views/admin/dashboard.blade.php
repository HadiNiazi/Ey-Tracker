@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('styles')
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          <!-- Small boxes (Stat box) -->



            @if ($currentStudentsCount > 0 || $waitingStudentsCount > 0 || $leavedStudentsCount > 0 || $graduatedStudentsCount > 0)

                <div class="row" style="background-color: white">
                    <div class="col-lg-8 offset-2">
                        <canvas id="myChart" ></canvas>
                    </div>

                </div>

            @else
              <div class="row">
                <div class="col-lg-12 col-12">
                    <h5 class="text-danger text-center">No Student added yet</h5>

                </div>
              </div>
            @endif


          </div>

</div>
</section>
@endsection

@section('scripts')
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

<script>
    var current = '{{ $currentStudentsCount ? $currentStudentsCount: 0 }}';
    var waiting = '{{ $waitingStudentsCount ? $waitingStudentsCount: 0 }}';
    var leaved = '{{ $leavedStudentsCount ? $leavedStudentsCount: 0 }}';
    var graduated = '{{ $graduatedStudentsCount ? $graduatedStudentsCount: 0 }}';

    var xValues = ["Leaved", "Current", "Gradudated", "Waiting"];
var yValues = [leaved, current, graduated, waiting];
var barColors = [
  "#b91d47",
  "#00aba9",
  "#2b5797",
  "#e8c3b9",
  "#1e7145"
];

new Chart("myChart", {
  type: "doughnut",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    title: {
      display: true,
      text: '{{ env('APP_NAME') }}' +' '+ "Students"
    }
  }
});
</script>

@endsection
