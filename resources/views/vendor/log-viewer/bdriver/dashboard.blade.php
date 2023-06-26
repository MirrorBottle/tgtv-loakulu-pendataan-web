{{-- Extends layout --}}
@extends('layout.default', ['page_title' => 'Log Viewer'])



{{-- Content --}}
@section('content')
            <!-- row -->
<div class="container-fluid">
	<div class="row mt-4">
        <div class="col-md-6 col-lg-3">
            <canvas id="stats-doughnut-chart" height="300" class="mb-3"></canvas>

            <hr>
            <a class="btn btn-primary btn-lg btn-block" href="{{ route('log-viewer::logs.list') }}" type="button">
                <i class="fas fa-list-ol"></i> @lang('Logs by Date')
            </a>
        </div>

        <div class="col-md-6 col-lg-9">
            <div class="row">
                @foreach($percents as $level => $item)
                    <div class="col-sm-6 col-md-12 col-lg-4 mb-3">
                        <div class="box level-{{ $level }} {{ $item['count'] === 0 ? 'empty' : '' }}">
                            <div class="box-icon">
                                {!! log_styler()->icon($level) !!}
                            </div>

                            <div class="box-content">
                                <span class="box-text">{{ $item['name'] }}</span>
                                <span class="box-number">
                                    {{ $item['count'] }} entries - {!! $item['percent'] !!} %
                                </span>
                                <div class="progress" style="height: 3px;">
                                    <div class="progress-bar" style="width: {{ $item['percent'] }}%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection

@push('after-styles')
@include('log-viewer::bdriver.partials.style')
@endpush

@push('after-scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
<script>
    $(function() {
        new Chart(document.getElementById("stats-doughnut-chart"), {
            type: 'doughnut',
            data: {!! $chartData !!},
            options: {
                legend: {
                    position: 'bottom'
                }
            }
        });
    });
</script>
@endpush
