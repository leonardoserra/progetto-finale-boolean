@extends('layouts.app')

@section('content')
<script>
    var orderLabelsData = @json($labelsData);
    var orderLabelsYearData = @json($labelsYearsData);
</script>
      <div class="container-fluid">
            <div class="row">
                  <div class="col-2">
                        @include('ur.partials.sidebar')
                  </div>
                  <div class="col-9">
                    <div class="statistic">
                        <canvas id="myChart"></canvas>
                    </div>

                    <div class="statistic">
                        <canvas id="mySecondChart"></canvas>
                    </div>


                    <script src="{{ asset('/js/app.js') }}"></script>
                </div>
            </div>
      </div>
@endsection
