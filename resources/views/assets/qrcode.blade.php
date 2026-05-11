<!DOCTYPE html>
<html>

<head>
    <title>QR Code Asset - {{ $asset->asset_code }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 40px;
        }

        .card {
            border: 1px solid #ddd;
            width: 350px;
            margin: auto;
            padding: 25px;
            border-radius: 10px;
        }

        .code {
            font-size: 18px;
            font-weight: bold;
            margin-top: 15px;
        }

        .name {
            margin-top: 5px;
            color: #555;
        }

        @media print {
            button {
                display: none;
            }
        }
    </style>
</head>

<body>

    <div class="card">
        <h2>QR Code Asset</h2>

        {!! QrCode::size(220)->generate(route('assets.show', $asset->id)) !!}

        <div class="code">
            {{ $asset->asset_code }}
        </div>

        <div class="name">
            {{ $asset->name }}
        </div>

        <p>
            Scan QR untuk membuka detail asset.
        </p>
    </div>

    <br>

    <button onclick="window.print()">
        Print QR Code
    </button>

</body>

</html>
