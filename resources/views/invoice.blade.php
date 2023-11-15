<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - {{$invoice->invoice_number}}</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            font-size: 14px;
            color: #333;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .logo {
            font-size: 30px;
            font-weight: bold;
            color: #007bff;
            margin: 1rem 0;
        }

        .invoice-info {
            font-size: 14px;
            color: #777;
        }
        .description {
            font-size: 14px;
            margin: 0.5rem 0;
        }

        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        .invoice-table th,
        .invoice-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }

        .invoice-table th {
            background-color: #f2f2f2;
        }

        .total-row {
            font-weight: bold;
            background-color: #f2f2f2;
        }

        .footer {
            margin-top: 30px;
            text-align: left;
            color: #777;
            font-size: 14px;
        }
        .footer > span {
            text-decoration: underline;
        }
        .customer-info > p {
            line-height: 0.2;
        }
    </style>
</head>
<body>
<?php
    $words = new NumberFormatter( 'en_US', NumberFormatter::SPELLOUT );
?>
<div class="container">
    <div class="header">
    <img class="logo" src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('storage/'.$invoice->image))) }}" width="25%" height="auto" alt="logo">

        
        <div class="invoice-info">
            <strong>Invoice</strong><br>
            Ref: {{$invoice->invoice_number}}<br>
            {{ \Carbon\Carbon::parse($invoice->invoice_date)->format('F d, Y')}}
        </div>
    </div>

    <div class="customer-info">
        <p><strong>Bill To:</strong></p>
        <p>{{$invoice->customer->name}}</p>
        <p>{{$invoice->customer->phone}}</p>
        <p>{{$invoice->customer->address}}</p>
    </div>

    <div class="description">
        <p><strong>Description</strong></p>
        <p>{{$invoice->description}}</p>
    </div>

    <table class="invoice-table">
        <thead>
        <tr>
            <th>Service</th>
            <th>Currency</th>
            <th>Rate</th>
            <th>Amount</th>
        </tr>
        </thead>
        <tbody>
        @foreach($invoice->invoiceItems as $item)
            <tr>
                <td>{{$item->item->name}}</td>
                <td>{{$item->item->unit}}</td>
                <td>{{$item->rate}}</td>
                <td>{{$item->amount}}</td>
            </tr>
        @endforeach
        <tr class="total-row">
            <td></td>
            <td></td>
            <td><strong>Total</strong></td>
            <td><strong>{{$invoice->amount}}</strong></td>
        </tr>
        </tbody>
    </table>

    <div class="footer">
        <strong>Amount </strong> <span>{{$words->format($invoice->amount) }}</span> only.
    </div>
</div>

</body>
</html>
