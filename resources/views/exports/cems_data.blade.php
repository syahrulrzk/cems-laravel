<table>
    <thead>
        <tr>
            <th colspan="10" style="text-align: center; font-weight: bold; font-size: 16pt;">LAPORAN MONITORING CEMS</th>
        </tr>
        <tr>
            <th colspan="10" style="text-align: center; font-weight: bold; font-size: 14pt;">{{ \App\Helpers\CemsHelper::company() }}</th>
        </tr>
        <tr>
            <th colspan="10" style="text-align: center;">Periode: {{ $fromdate }} s/d {{ $todate }}</th>
        </tr>
        <tr></tr>
        <tr style="background-color: #f2f2f2; font-weight: bold; border: 1px solid #000;">
            <th style="border: 1px solid #000; text-align: center;">No.</th>
            <th style="border: 1px solid #000; text-align: center;">Cerobong</th>
            <th style="border: 1px solid #000; text-align: center;">Parameter</th>
            <th style="border: 1px solid #000; text-align: center;">Value</th>
            <th style="border: 1px solid #000; text-align: center;">Waktu</th>
            <th style="border: 1px solid #000; text-align: center;">Laju Alir (m3/s)</th>
            <th style="border: 1px solid #000; text-align: center;">Status</th>
            <th style="border: 1px solid #000; text-align: center;">Bahan Bakar</th>
            <th style="border: 1px solid #000; text-align: center;">Beban Produksi</th>
            <th style="border: 1px solid #000; text-align: center;">Status SISPEK</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $index => $item)
            <tr>
                <td style="border: 1px solid #000; text-align: center;">{{ $index + 1 }}</td>
                <td style="border: 1px solid #000;">{{ $item->cerobong_name }}</td>
                <td style="border: 1px solid #000; text-align: center;">{{ $item->parameter }}</td>
                <td style="border: 1px solid #000; text-align: center;">{{ $item->value }}</td>
                <td style="border: 1px solid #000; text-align: center;">{{ $item->waktu }}</td>
                <td style="border: 1px solid #000; text-align: center;">{{ $item->laju_alir }}</td>
                <td style="border: 1px solid #000; text-align: center;">{{ $item->status }}</td>
                <td style="border: 1px solid #000; text-align: center;">{{ $item->fuel }}</td>
                <td style="border: 1px solid #000; text-align: center;">{{ $item->load }}</td>
                <td style="border: 1px solid #000; text-align: center;">{{ $item->status_sispek }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
