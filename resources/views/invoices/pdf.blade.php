<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice #{{ $invoice->invoice_number ?? $invoice->id }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 12px;
            color: #333;
            line-height: 1.6;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 40px;
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            margin-bottom: 30px;
            border-radius: 10px;
        }
        .header h1 {
            font-size: 32px;
            margin-bottom: 5px;
        }
        .header p {
            font-size: 14px;
            opacity: 0.9;
        }
        .invoice-info {
            display: table;
            width: 100%;
            margin-bottom: 30px;
        }
        .invoice-info > div {
            display: table-cell;
            width: 50%;
            vertical-align: top;
        }
        .info-box {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 15px;
        }
        .info-box h3 {
            font-size: 11px;
            color: #666;
            text-transform: uppercase;
            margin-bottom: 10px;
            font-weight: bold;
        }
        .info-box p {
            margin: 5px 0;
        }
        .customer-name {
            font-size: 18px;
            font-weight: bold;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        table th {
            background: #f8f9fa;
            padding: 12px;
            text-align: left;
            font-weight: bold;
            border-bottom: 2px solid #dee2e6;
        }
        table td {
            padding: 12px;
            border-bottom: 1px solid #dee2e6;
        }
        .text-right {
            text-align: right;
        }
        .totals {
            margin-left: auto;
            width: 300px;
        }
        .totals table td {
            border: none;
            padding: 8px 12px;
        }
        .total-row {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            font-size: 16px;
            font-weight: bold;
        }
        .total-row td {
            padding: 15px 12px !important;
        }
        .notes {
            background: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 15px;
            margin-top: 30px;
            border-radius: 5px;
        }
        .notes h4 {
            font-size: 12px;
            font-weight: bold;
            margin-bottom: 8px;
            color: #856404;
        }
        .notes p {
            color: #856404;
        }
        .footer {
            margin-top: 50px;
            text-align: center;
            color: #666;
            font-size: 11px;
            border-top: 1px solid #dee2e6;
            padding-top: 20px;
        }
        .badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .badge-pending {
            background: #fff3cd;
            color: #856404;
        }
        .badge-paid {
            background: #d4edda;
            color: #155724;
        }
        .badge-cancelled {
            background: #f8d7da;
            color: #721c24;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <table width="100%">
                <tr>
                    <td>
                        <h1>INVOICE</h1>
                        <p>Laundry Ukhuwah</p>
                    </td>
                    <td style="text-align: right;">
                        <p style="font-size: 12px; margin-bottom: 3px;">Invoice #</p>
                        <p style="font-size: 24px; font-weight: bold;">{{ $invoice->invoice_number ?? $invoice->id }}</p>
                    </td>
                </tr>
            </table>
        </div>

        <!-- Invoice Info -->
        <div class="invoice-info">
            <div style="padding-right: 15px;">
                <div class="info-box">
                    <h3>Kepada:</h3>
                    <p class="customer-name">{{ $invoice->customer_name }}</p>
                    @if($invoice->customer_whatsapp)
                    <p>WhatsApp: {{ $invoice->customer_whatsapp }}</p>
                    @endif
                </div>
            </div>
            <div style="padding-left: 15px;">
                <div class="info-box">
                    <h3>Detail Invoice:</h3>
                    <table width="100%" style="margin: 0;">
                        <tr>
                            <td style="border: none; padding: 3px 0;">Tanggal:</td>
                            <td style="border: none; padding: 3px 0; font-weight: bold;">{{ $invoice->created_at->format('d M Y') }}</td>
                        </tr>
                        <tr>
                            <td style="border: none; padding: 3px 0;">Status:</td>
                            <td style="border: none; padding: 3px 0;">
                                <span class="badge badge-{{ $invoice->status }}">{{ ucfirst($invoice->status) }}</span>
                            </td>
                        </tr>
                        @if($invoice->paid_at)
                        <tr>
                            <td style="border: none; padding: 3px 0;">Dibayar:</td>
                            <td style="border: none; padding: 3px 0; font-weight: bold;">{{ \Carbon\Carbon::parse($invoice->paid_at)->format('d M Y') }}</td>
                        </tr>
                        @endif
                    </table>
                </div>
            </div>
        </div>

        <!-- Order Details -->
        @if($invoice->order)
        <div class="info-box">
            <h3>Detail Pesanan:</h3>
            <table width="100%" style="margin: 0;">
                <tr>
                    <td style="border: none; padding: 5px 0; width: 33%;">
                        <strong>Layanan:</strong><br>
                        {{ $invoice->order->layanan }}
                    </td>
                    <td style="border: none; padding: 5px 0; width: 33%;">
                        <strong>Berat:</strong><br>
                        {{ $invoice->order->berat }} Kg
                    </td>
                    <td style="border: none; padding: 5px 0; width: 33%;">
                        <strong>Status:</strong><br>
                        {{ ucfirst($invoice->order->status) }}
                    </td>
                </tr>
            </table>
        </div>
        @endif

        <!-- Pricing Details -->
        <div style="margin-top: 30px;">
            <h3 style="font-size: 14px; margin-bottom: 15px; color: #666; text-transform: uppercase;">Rincian Biaya:</h3>
            <table class="totals">
                <tr>
                    <td>Subtotal</td>
                    <td class="text-right" style="font-weight: bold;">Rp {{ number_format($invoice->subtotal, 0, ',', '.') }}</td>
                </tr>
                @if($invoice->discount > 0)
                <tr>
                    <td style="color: #dc3545;">Diskon</td>
                    <td class="text-right" style="font-weight: bold; color: #dc3545;">- Rp {{ number_format($invoice->discount, 0, ',', '.') }}</td>
                </tr>
                @endif
                @if($invoice->tax > 0)
                <tr>
                    <td>Pajak</td>
                    <td class="text-right" style="font-weight: bold;">Rp {{ number_format($invoice->tax, 0, ',', '.') }}</td>
                </tr>
                @endif
                <tr class="total-row">
                    <td>TOTAL</td>
                    <td class="text-right">Rp {{ number_format($invoice->total, 0, ',', '.') }}</td>
                </tr>
            </table>
        </div>

        <!-- Notes -->
        @if($invoice->notes)
        <div class="notes">
            <h4>Catatan:</h4>
            <p>{{ $invoice->notes }}</p>
        </div>
        @endif

        <!-- Footer -->
        <div class="footer">
            <p><strong>Laundry Ukhuwah</strong></p>
            <p>Jl. Mawar No.12, Tegal</p>
            <p>WhatsApp: +62 853-2890-1924</p>
            <p style="margin-top: 10px;">Terima kasih atas kepercayaan Anda!</p>
        </div>
    </div>
</body>
</html>
