<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Data Asset</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            color: #111827;
        }

        h2,
        p {
            margin: 0;
            padding: 0;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h2 {
            font-size: 18px;
            margin-bottom: 5px;
        }

        .header p {
            font-size: 12px;
            color: #555;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #e5e7eb;
            font-weight: bold;
        }

        th,
        td {
            border: 1px solid #9ca3af;
            padding: 6px;
            text-align: left;
        }

        .status {
            text-transform: uppercase;
            font-weight: bold;
        }

        .footer {
            margin-top: 20px;
            font-size: 10px;
            text-align: right;
        }
    </style>
</head>

<body>

    <div class="header">
        <h2>LAPORAN DATA ASSET</h2>
        <p>Sistem Informasi Manajemen Asset</p>
        <p>Tanggal Cetak: {{ date('d-m-Y H:i') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Asset</th>
                <th>Nama Asset</th>
                <th>Kategori</th>
                <th>Lokasi</th>
                <th>Brand</th>
                <th>Model</th>
                <th>Serial Number</th>
                <th>Status</th>
                <th>Tanggal Beli</th>
                <th>Harga Beli</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($assets as $asset)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $asset->asset_code }}</td>
                    <td>{{ $asset->name }}</td>
                    <td>{{ $asset->category->name ?? '-' }}</td>
                    <td>{{ $asset->location->name ?? '-' }}</td>
                    <td>{{ $asset->brand ?? '-' }}</td>
                    <td>{{ $asset->model ?? '-' }}</td>
                    <td>{{ $asset->serial_number ?? '-' }}</td>
                    <td class="status">{{ str_replace('_', ' ', $asset->status) }}</td>
                    <td>{{ $asset->purchase_date ?? '-' }}</td>
                    <td>Rp {{ number_format($asset->purchase_price ?? 0, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Dicetak oleh sistem pada {{ date('d-m-Y H:i') }}
    </div>

</body>

</html>
