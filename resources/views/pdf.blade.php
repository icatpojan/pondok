<!DOCTYPE html>
<html>

<head>
    <title>INVOICE OFFICE KAPAL PINTAR</title>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

</head>

<body>
    <div class="card-header py-3" style="background-color: rgb(3, 3, 122)">
        <div class="d-flex justify-content-between">
            <h1 style="color:white">INVOICE</h1>
            <img src="img/logo.png" alt="" class="float-right"
                style="max-width: 300px; background-color: rgb(233, 117, 8)">
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            {{-- <div class="table-responsive"> --}}
            <table class="table table-sm mb-4" style="border: none">
                <tr>
                    <td class="col-md-6" style="border-top: none">
                        <h5 class="card-title" style="margin: 0">{{ $Invoice->customer->name ?? 'tidak ada nama' }}
                        </h5>
                        <p class="card-text" style="margin: 0">{{ $Invoice->address }}</p>
                        <p class="card-text" style="margin: 0">
                            email:{{ $Invoice->customer->email ?? 'tidak ada email' }}</p>
                        <p class="card-text" style="margin: 0">
                            NPWP:{{ $Invoice->customer->npwp ?? 'tidak ada npwp' }}</p>
                    </td>
                    <td class="col-md-6" style="text-align: right; border: none">
                        <p style="margin: 0">
                            {{-- Tanggal Invoice : {{ $Invoice->tanggal->format('d F Y') ?? 'kosong' }} --}}
                        </p>
                        @if ($Invoice->status != 'PAID OFF')
                            <p style="margin: 0">
                                {{-- Batas Invoice : {{ $Invoice->due_date->format('d F Y') ?? 'kosong' }} --}}
                            </p>
                        @endif
                        <p style="margin: 0"> No Invoice : {{ $Invoice->invoice_no }}</p>
                        <p style="margin: 0"> Invoice Date : {{ $Invoice->created_at->format('d F Y') }}</p>
                        <p style="margin: 0"> Transfer Date : {{ $Invoice->transfer_date }}</p>
                    </td>
                </tr>
            </table>
            {{-- </div> --}}
            <table class="table table-bordered table-sm mb-4">
                <thead style="background-color: rgb(233, 117, 8)">
                    <tr>
                        <th scope="col">Description</th>
                        <th scope="col">Qtv</th>
                        <th scope="col">Price</th>
                        <th scope="col">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>NAMA KAPAL: {{ $Invoice->ship->name ?? 'kosong' }}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    @foreach ($Detail as $detail)
                        <tr>
                            <td>#{{ $detail->type->name ?? 'kosong' }}<br>ID:{{ $detail->product->id ?? 'kosong' }}<br>SN:{{ $detail->product->id ?? 'kosong' }}
                            </td>
                            <td>1</td>
                            <td>{{ number_format($detail->product->price) }}</td>
                            <td>{{ number_format($detail->product->price) }}</td>
                        </tr>
                    @endforeach
                    <tr style="border: none">
                        <td>NAMA KAPAL: {{ $Invoice->ship->name ?? 'kosong' }}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    @if ($Invoice->airtime != null)
                        <tr>
                            <td>
                                #Airtime VMS SMart One solar
                                <br>
                                ID : {{ $Invoice->airtime }}
                            </td>
                            <td>1</td>
                            <td>5.454.545</td>
                            <td>5.454.545</td>
                        </tr>
                        <tr>
                            <td>Periode:
                                {{ $Invoice->airtime_start ?? 'tidak ditentukan' }}{{ $Invoice->airtime_end ?? 'tidak ditentukan' }}
                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    @endif
                    @if ($Invoice->status != 'PAID OFF')
                        <tr>
                            <td>
                                {{-- Periode Airtime: {{ $Invoice->airtime_start->format('d F Y') }} -
                                {{ $Invoice->airtime_end->format('d F Y') }} --}}
                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    @endif
                    <tr>
                        <td></td>
                        <td></td>
                        <td>Sub Total</td>
                        @if ($Invoice->airtime != null)
                            <td>{{ number_format($Invoice->harga + 5454545) }}</td>
                        @else
                            <td>{{ number_format($Invoice->harga) }}</td>
                        @endif
                    </tr>
                    @if ($Invoice->discount != 0)
                        <tr>
                            <td></td>
                            <td></td>
                            <td>Discount</td>
                            @if ($Invoice->persen == 'persen')
                                <td>{{ $Invoice->discount }}%</td>
                            @elseif ($Invoice->persen == 'rupiah')
                                <td>Rp.{{ $Invoice->discount }}</td>
                            @endif
                        </tr>
                    @endif
                    @if ($Invoice->ppn != 0)
                        <tr>
                            <td></td>
                            <td></td>
                            <td>PPn 10%</td>
                            @if ($Invoice->airtime != null)
                                <td>{{ number_format($Invoice->ppn + 545454.5) }}</td>
                            @else
                                <td>{{ number_format($Invoice->ppn) }}</td>
                            @endif
                        </tr>
                    @endif

                    <tr>
                        <td></td>
                        <td></td>
                        <td>Total</td>
                        @if ($Invoice->airtime != null)
                            <td>{{ number_format($Invoice->harga_akhir + 5454545) }}</td>
                        @else
                            <td>{{ number_format($Invoice->harga_akhir) }}</td>
                        @endif
                    </tr>
                </tbody>
            </table>
            @if ($Invoice->status == 'PAID OFF')
                <h1 style="color: red; border: 1px">
                    <center>PAID OFF</center>
                </h1>
            @else
                <h1 style="color: red; border: 1px">
                    <center> NOT YET PAID OFF</center>
                </h1>
            @endif
            <div class="row">
                <div class="col">
                    notes :
                    <br><br><br>
                    Transfer your payment<br><b>PT.PINTAR INOVASI MANDIRI<br><b>BANK BCA -0353073639</b></b><br><b>BCA
                        CAB.KCU
                        SUDIRMAN</b>
                </div>
                <div class="col">
                    <img style="float: right" src="data:image/png;base64, {!! base64_encode(
    QrCode::format('png')->merge('img/1.png', 0.3, true)->size(200)->generate('https://office.kapalpintar.com/cetak/pdf/' . $Invoice->id),
) !!} ">
                </div>
            </div>
        </div>
    </div>
</body>
<style>
    @page {
        margin: 0px;
    }

    /* body {
        margin: 0px;
    } */

</style>

</html>
