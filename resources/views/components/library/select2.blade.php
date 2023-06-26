@push('after-styles')
<!-- Select2 Bootstrap 4 Core UI -->
<link href="{{ asset('vendor/select2/css/select2.min.css') }}" rel="stylesheet" />
@endpush

@push('after-scripts')
<!-- Select2 Bootstrap 4 Core UI -->
<script src="{{ asset('vendor/select2/js/select2.min.js') }}"></script>

<script type="text/javascript">
$(document).ready(function() {
    $('.select2').select2({
        theme: "bootstrap",
        placeholder: "-- Select an option --",
    });
});
</script>
@endpush
