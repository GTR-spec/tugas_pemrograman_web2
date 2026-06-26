<?php
require_once('vendor/autoload.php');
include 'koneksi.php';

date_default_timezone_set('Asia/Jakarta');

$pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8', false);
$pdf->setCreator(PDF_CREATOR);
$pdf->setTitle("Laporan Data Inventaris");

$pdf->setFont('helvetica', '', 10);

$pdf->setHeaderData('', 0, 'LAPORAN DATA INVENTARIS', "Surface Head Office\nDicetak pada: " . date('d-m-Y'));
$pdf->setHeaderFont(Array('helvetica', '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array('helvetica', '', PDF_FONT_SIZE_DATA));

$pdf->setMargins(15, 30, 15);
$pdf->setHeaderMargin(10);
$pdf->setFooterMargin(10);

$pdf->setAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->AddPage();

$query = "SELECT * FROM tb_inventori";
$result = mysqli_query($koneksi, $query);

$html = '<h2 style="text-align: center; color: #333; font-family: helvetica;">DAFTAR ASET INVENTARIS</h2>';
$html .= '<table border="1" cellpadding="6" cellspacing="0" style="width: 100%; border-collapse: collapse; font-family: helvetica; font-size: 9pt;">';
$html .= '<thead style="background-color: #f2f2f2; font-weight: bold; text-align: center;">
            <tr>
                <th style="width: 4%;">No</th>
                <th style="width: 15%;">Nomor Inventaris</th>
                <th style="width: 15%;">Gambar</th>
                <th style="width: 18%;">Nama Barang</th>
                <th style="width: 12%;">Kondisi</th>
                <th style="width: 12%;">Tgl Pembelian</th>
                <th style="width: 12%;">Divisi</th>
                <th style="width: 12%;">Keterangan</th>
            </tr>
          </thead>
          <tbody>';

$no = 1;
while ($row = mysqli_fetch_assoc($result)) {
    $no_inv   = htmlspecialchars($row['nomor_inventaris']);
    $nama     = htmlspecialchars($row['nama_barang']);
    $kondisi  = htmlspecialchars($row['kondisi_barang']);
    $tgl_beli = ($row['tgl_pembelian'] && $row['tgl_pembelian'] !== '0000-00-00') ? date('d-m-Y', strtotime($row['tgl_pembelian'])) : '-';
    $divisi   = htmlspecialchars($row['divisi']);
    $keterangan   = htmlspecialchars($row['keterangan']);
    
    $gambar_file = 'uploads/' . $row['gambar'];
    $img_html = '-';
    
    if (!empty($row['gambar']) && file_exists($gambar_file)) {
        $abs_path = realpath($gambar_file);
        $img_html = '<img src="' . $abs_path . '" width="60" height="45" align="middle" />';
    }

    $warna_kondisi = (strcasecmp($kondisi, 'Normal') === 0) ? 'color: #008000;' : 'color: #FF0000;';

    $html .= '<tr>
                <td style="text-align: center; width: 4%;">' . $no++ . '</td>
                <td style="width: 15%;">' . $no_inv . '</td>
                <td style="text-align: center; width: 15%; vertical-align: middle;">' . $img_html . '</td>
                <td style="width: 18%;">' . $nama . '</td>
                <td style="text-align: center; ' . $warna_kondisi . ' width: 12%;"><strong>' . $kondisi . '</strong></td>
                <td style="text-align: center; width: 12%;">' . $tgl_beli . '</td>
                <td style="width: 12%;">' . $divisi . '</td>
                <td style="width: 12%;">' . $keterangan . '</td>
              </tr>';
}

$html .= '</tbody></table>';

if (ob_get_contents()) ob_end_clean();

$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Output('laporan_inventaris_' . date('Ymd') . '.pdf', 'I');
?>
