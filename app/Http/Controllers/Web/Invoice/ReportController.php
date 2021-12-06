<?php

namespace App\Http\Controllers\Web\Invoice;

use App\Http\Controllers\Controller;
use App\Models\Detail;
use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Models\Product;
use TCPDF;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $Invoice = Invoice::where('status', 'invoice')->orderby('created_at', 'DESC');
        if ($request->awal || $request->akhir) {
            $Invoice->whereBetween('created_at', [$request->awal, $request->akhir]);
        }
        if ($request->awal) {
            $Invoice->where('created_at', 'LIKE', "$request->awal%");
        }
        $Invoice = $Invoice->get();
        $title = "Report";
        return view('report.report', compact('title', 'Invoice'));
    }

    public function cetak_pdf($id)
    {
        $Invoice = Invoice::where('id', $id)->with(['customer', 'ship'])->first();
        $Detail = Detail::where('transaksi_id', $Invoice->id)->with(['product'])->get();

        QrCode::format('png')
            ->merge('/public/img/qrcode.png', .3)
            ->size(420)
            ->margin(1)
            ->generate('https://office.kapalpintar.co.id/cetak/pdf/1', base_path('public/pdf/1.png'));

        $invoiceHtml = view('invoice', compact('Invoice', 'Detail'))->render();
        $invoicePdf = $this->generate(
            $invoiceHtml, TRUE, 0, 100, 'FOLIO', array(
                'left' => 0,
                'top' => 0,
                'right' => 0
            )
        );

		$invoicePdf->Output($_SERVER['DOCUMENT_ROOT'] . 'pdf/test.pdf', 'F');
		$invoicePdf->Output('Invoice.pdf', 'I');
    }

	private function generate($html, $watermark = FALSE, $watermark_x = 120, $watermark_y = 330, $paper_size = 'FOLIO', $margin = array('left' => 25, 'top' => 30, 'right' => 25))
	{
		$pdf = new TCPDF('P', 'pt', $paper_size, true, 'UTF-8', false);

		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
		$pdf->SetAutoPageBreak(TRUE, 0);
		$pdf->SetMargins($margin['left'], $margin['top'], $margin['right'], true);
		$pdf->SetFooterMargin(0);
		$pdf->AddPage();

		if ($watermark) {
			$pdf->Image(base_path('public/img/logo-watermark.png'), $watermark_x, $watermark_y, 640, 720, '', '', '', false, false, '', false, false, 0);
			$pdf->setPageMark();
		}

		$pdf->writeHTML($html, true, false, true, false, '');

		return $pdf;
	}

    public function delete($id)
    {
        $Invoice = Invoice::find($id);
        $Detail = Detail::where('transaksi_id', $Invoice->id)->get();
        foreach ($Detail as $value) {
            $Product = Product::where('id', $value->produk_id)->first();
            $Product->status_id = 1;
            $Product->update();
            $value->delete();
        }
        $Invoice->delete();
        alert()->success('Sukses', 'Berhasil menghapus dan mengembalikan status produk');
        return back();
    }
}
