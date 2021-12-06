<style>
.header-title {
    background-color: rgb(1, 1, 121);
}
.header-title-text {
    font-size: 20pt;
    font-family: Arial, Helvetica, sans-serif;
    color: #FFFFFF;
}
.info-gap-1 {
    width: 5%;
}
.info-gap-2 {
    width: 7.5%;
}
.info-gap-3 {
    width: 5%;
}
.info-perusahaan {
    width: 45%;
}
.info-perusahaan-nama {
    font-family: 'Times New Roman', Times, serif;
    font-size: 15pt;
    font-weight: bold;
}
.info-perusahaan-alamat,
.info-perusahaan-email,
.info-perusahaan-npwp {
    font-family: 'Times New Roman', Times, serif;
    font-size: 10pt;
}
.info-invoice {
    width: 37.5%;
}
.info-invoice-no-label,
.info-invoice-date-label,
.info-invoice-payment-label,
.info-invoice-status-label {
    width: 35%;
    font-family: 'Times New Roman', Times, serif;
    font-size: 13pt;
}
.info-invoice-no-sp,
.info-invoice-date-sp,
.info-invoice-payment-sp,
.info-invoice-status-sp {
    width: 5%;
    text-align: center;
    font-size: 13pt;
}
.info-invoice-no-value,
.info-invoice-date-value,
.info-invoice-payment-value,
.info-invoice-status-value {
    width: 60%;
    font-family: 'Times New Roman', Times, serif;
    font-size: 13pt;
}
.detail-gap {
    width: 5%;
}
.detail-content {
    width: 90%;
}
.description-label {
    width: 50%;
    border-top: 0.1pt solid #000000;
    border-right: 0.1pt solid #000000;
    border-bottom: 0.1pt solid #000000;
    border-left: 0.1pt solid #000000;
    background-color: #FF5C00;
    font-size: 10pt;
    font-family: 'Times New Roman', Times, serif;
    text-align: center;
    color: #FFFFFF;
}
.qty-label {
    width: 10%;
    border-top: 0.1pt solid #000000;
    border-right: 0.1pt solid #000000;
    border-bottom: 0.1pt solid #000000;
    background-color: #FF5C00;
    font-size: 10pt;
    font-family: 'Times New Roman', Times, serif;
    text-align: center;
    color: #FFFFFF;
}
.price-label {
    width: 20%;
    border-top: 0.1pt solid #000000;
    border-right: 0.1pt solid #000000;
    border-bottom: 0.1pt solid #000000;
    background-color: #FF5C00;
    font-size: 10pt;
    font-family: 'Times New Roman', Times, serif;
    text-align: center;
    color: #FFFFFF;
}
.amount-label {
    width: 20%;
    border-top: 0.1pt solid #000000;
    border-right: 0.1pt solid #000000;
    border-bottom: 0.1pt solid #000000;
    background-color: #FF5C00;
    font-size: 10pt;
    font-family: 'Times New Roman', Times, serif;
    text-align: center;
    color: #FFFFFF;
}
.dv {
    border-left: 0.1pt solid #000000;
    border-right: 0.1pt solid #000000;
    font-size: 10pt;
    font-family: 'Times New Roman', Times, serif;
}
.dv-main {
    font-size: 10pt;
    font-family: 'Times New Roman', Times, serif;
}
.dv-gap {
    width: 5%;
}
.dv-label {
    width: 15%;
    font-size: 10pt;
    font-family: 'Times New Roman', Times, serif;
}
.dv-sp {
    width: 5%;
    font-size: 10pt;
    font-family: 'Times New Roman', Times, serif;
}
.dv-value {
    width: 70%;
    font-size: 10pt;
    font-family: 'Times New Roman', Times, serif;
}
.qv {
    border-right: 0.1pt solid #000000;
    font-size: 10pt;
    font-family: 'Times New Roman', Times, serif;
    text-align: center;
}
.pv {
    border-right: 0.1pt solid #000000;
    font-size: 10pt;
    font-family: 'Times New Roman', Times, serif;
    text-align: right;
}
.av {
    border-right: 0.1pt solid #000000;
    font-size: 10pt;
    font-family: 'Times New Roman', Times, serif;
    text-align: right;
}
.dv-status {
    border-top: 0.1pt solid #000000;
    font-size: 10pt;
    font-family: 'Times New Roman', Times, serif;
    text-align: right;
}
.pv-status {
    border-top: 0.1pt solid #000000;
    border-right: 0.1pt solid #000000;
    border-left: 0.1pt solid #000000;
    font-size: 10pt;
    font-family: 'Times New Roman', Times, serif;
}
.av-status {
    border-top: 0.1pt solid #000000;
    border-right: 0.1pt solid #000000;
    font-size: 10pt;
    font-family: 'Times New Roman', Times, serif;
    text-align: right;
}
.bottom-status {
    border-bottom: 0.1pt solid #000000;
}
.qrcode {
    text-align: center;
}
.notes-gap {
    width: 5%;
}
.notes-content {
    width: 90%;
    font-family: 'Times New Roman', Times, serif;
    font-size: 13pt;
}
.notes-operator {
    width: 90%;
    font-family: 'Times New Roman', Times, serif;
    font-size: 13pt;
    text-align: center;
}
</style>

<table class="header" width="100%" cellpadding="0" cellspacing="0">
    <tr>
        <td><img width="612" height="72" src="../public/img/header-invoice.png" /></td>
    </tr>
</table>
<table>
    <tr><td>&nbsp;</td></tr>
</table>
<table class="info">
    <tr>
        <td class="info-gap-1"></td>
        <td class="info-perusahaan">
            <table>
                <tr><td class="info-perusahaan-nama">{{ $invoice->customer->name }}</td></tr>
                <tr><td class="info-perusahaan-alamat">{{ $invoice->address }}</td></tr>
                <tr><td class="info-perusahaan-email">Email: {{ $invoice->customer->email ?: '-' }}</td></tr>
                <tr><td class="info-perusahaan-npwp">NPWP: {{ $invoice->customer->npwp ?: '-' }}</td></tr>
            </table>
        </td>
        <td class="info-gap-2"></td>
        <td class="info-invoice">
            <table width="100%" cellpadding="0">
                <tr>
                    <td class="info-invoice-no-label">Invoice No</td>
                    <td class="info-invoice-no-sp">:</td>
                    <td class="info-invoice-no-value">{{ $invoice->invoice_no }}</td>
                </tr>
                <tr>
                    <td class="info-invoice-date-label">Invoice Date</td>
                    <td class="info-invoice-date-sp">:</td>
                    <td class="info-invoice-date-value">{{ $invoice->tanggal }}</td>
                </tr>
                <tr>
                    <td class="info-invoice-payment-label">Payment Date</td>
                    <td class="info-invoice-payment-sp">:</td>
                    <td class="info-invoice-payment-value">{{ $invoice->transfer_date }}</td>
                </tr>
                <tr>
                    <td class="info-invoice-status-label">Invoice Status</td>
                    <td class="info-invoice-status-sp">:</td>
                    <td class="info-invoice-status-value">Unit & Airtime</td>
                </tr>
            </table>
        </td>
        <td class="info-gap-3"></td>
    </tr>
</table>
<table>
    <tr><td>&nbsp;</td></tr>
</table>
<table class="detail">
    <tr>
        <td class="detail-gap"></td>
        <td class="detail-content">
            <table width="100%;" cellpadding="10pt">
                <tr>
                    <td class="description-label">DESCRIPTION</td><td class="qty-label">QTY</td><td class="price-label">PRICE</td><td class="amount-label">AMOUNT</td>
                </tr>
                <tr>
                    <td class="dv">{{ $invoice->ship->name }}</td>
                    <td class="qv"></td>
                    <td class="pv"></td>
                    <td class="av"></td>
                </tr>
                @foreach ($detail as $item)
                <tr>
                    <td class="dv">
                        <table>
                            <tr><td class="dv-main" colspan="3"># {{ $item->type->nama ?: '-' }}</td></tr>
                            <tr><td class="dv-gap"></td><td class="dv-label">ID</td><td class="dv-sp">:</td><td class="dv-value">{{ $item->product->id ?: '-' }}</td><td class="dp-gap"></td></tr>
                            <tr><td class="dv-gap"></td><td class="dv-label">SN</td><td class="dv-sp">:</td><td class="dv-value">{{ $item->sn ?: '-' }}</td><td class="dp-gap"></td></tr>
                        </table>
                    </td>
                    <td class="qv">1</td>
                    <td class="pv">Rp. {{ number_format($item->price) }}</td>
                    <td class="av">Rp. {{ number_format($item->price) }}</td>
                </tr>
                @endforeach
                @if ( ! is_null($invoice->airtime))
                <tr>
                    <td class="dv">
                        <table>
                            <tr><td class="dv-main" colspan="3"># Airtime VMS SMart One solar</td></tr>
                            <tr><td class="dv-gap"></td><td class="dv-label">ID</td><td class="dv-sp">:</td><td class="dv-value">{{ $invoice->airtime ?: '-' }}</td><td class="dp-gap"></td></tr>
                            <tr><td class="dv-gap"></td><td class="dv-label">Periode</td><td class="dv-sp">:</td><td class="dv-value">{{ $invoice->airtime_start }} to {{ $invoice->airtime_start }}</td><td class="dp-gap"></td></tr>
                        </table>
                    </td>
                    <td class="qv">1</td>
                    <td class="pv">Rp. {{ number_format($item->price) }}</td>
                    <td class="av">Rp. {{ number_format($item->price) }}</td>
                </tr>
                @endif
                <tr>
                    <td class="dv-status" rowspan="4" colspan="2">
                    @if ($invoice->status == 'PAID OFF')
                    <img height="100" src="../public/img/paid.png">
                    @endif
                    </td>
                    <td class="pv-status">Sub Total</td>
                    <td class="av-status">{{ number_format($subtotal) }}</td>
                </tr>
                <tr>
                    <td class="pv-status">PPn 10%</td>
                    <td class="av-status">{{ number_format($ppn) }}</td>
                </tr>
                <tr>
                    <td class="pv-status bottom-status">Total</td>
                    <td class="av-status bottom-status">Rp. {{ number_format($total) }}</td>
                </tr>
                <tr>
                    <td class="qrcode" colspan="2"><img height="100" src="../public/pdf/qrcode/{{ $invoice->id }}.png" /></td>
                </tr>
            </table>
        </td>
        <td class="detail-gap"></td>
    </tr>
</table>
<table class="notes">
    <tr>
        <td class="notes-gap"></td>
        <td class="notes-content">Notes:<br/>Transfer your payment<br/><b>PT.PINTAR INOVASI MANDIRI</b><br/><b>BANK BCA - 0353073639</b></td>
        <td class="notes-gap"></td>
    </tr>
    <tr>
        <td class="notes-gap"></td>
        <td class="notes-operator">&nbsp;&nbsp;&nbsp;<br/><br/><br/><br/>(Nama Operator)</td>
        <td class="notes-gap"></td>
    </tr>
</table>
