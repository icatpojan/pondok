@extends('layouts.app')
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
    @include('invoice.cards.detail')
    <form action="{{ route('edit.performa', $Invoice->id) }}" method="post">
        @csrf
        @include('invoice.cards.invoiceinfo')
        @include('invoice.cards.customerinfo')
        @include('invoice.cards.transferinfo')
        @if ($Invoice->type == 'AIRTIME' || $Invoice->type == 'VMS dan AIRTIME')
            @include('invoice.cards.airtimeinfo')
        @endif
        @include('invoice.cards.userinfo')
    </form>
@endsection
@section('script')
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
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
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
        $('#customer').on('change', function() {
            axios.post('{{ route('customer.show') }}', {
                    id: $(this).val()
                })
                .then(function(response) {
                    console.log(response);
                    $('#address').val(response.data.data.address);
                    $('#npwp').val(response.data.data.npwp);
                });
        });
    </script>
@endsection
