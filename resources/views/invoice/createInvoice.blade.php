@extends('layouts.app')
@section('content')
    @include('invoice.plot.description')
@endsection
@section('script')
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
    <script>
        $('#stempel').on('change', function() {
            axios.post('{{ route('invoice.stempel') }}', {
                    id: $(this).val()
                })
                .then(function(response) {
                    let data = response.data.data
                    $('#nomer_invoice').val(data);
                });
        });
    </script>
@endsection
