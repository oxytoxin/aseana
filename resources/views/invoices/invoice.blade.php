<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @hasSection('title')
    <title>@yield('title') - {{ config('app.name') }}</title>
    @else
    <title>{{ config('app.name') }}</title>
    @endif
    <link rel="shortcut icon" href="{{ url(asset('favicon.ico')) }}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;0,900;1,300;1,400;1,500;1,600;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ url(mix('css/app.css')) }}">
    <link rel="stylesheet" href="{{ asset('icofont/icofont.min.css') }}">
    <script src="{{ url(mix('js/app.js')) }}" defer></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        @page {
            size: landscape;
        }

    </style>
</head>

<body x-data x-init="window.print();" class="h-screen p-10 mx-auto text-gray-800">
    <div>
        <div class="flex items-center space-x-3">
            <img src="{{ asset('img/logo.png') }}" class="w-12 h-12" alt="logo">
            <h1 class="text-xl">ASEANA General Merchandise</h1>
        </div>
        <br class="my-20">
        <h1>Customer: Guest</h1>
        <h1>Branch: NDTC Centrum II</h1>
        <h1>Date: {{ $transaction->date_for_humans }}</h1>
    </div>
    <table class="table w-full my-5 text-center border-2 border-collapse table-auto">
        <thead class="border-2 divide-y">
            <tr class="divide-x-2">
                <th>Product</th>
                <th>Quantity</th>
                <th>SRP</th>
                <th>Sell Price</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody class="border-2 divide-x divide-y">
            @foreach ($transaction->products as $product)
            <tr class="divide-x-2">
                <td>{{ $product->name }}</td>
                <td>{{ $product->pivot->quantity }}</td>
                <td>&#8369; {{ number_format($product->srp,2) }}</td>
                <td>&#8369; {{ number_format($product->pivot->sell_price,2) }}</td>
                <td>&#8369; {{ number_format($product->pivot->subtotal,2) }}</td>
            </tr>
            @endforeach
            <tr class="divide-x-2">
                <td class="font-semibold" colspan="4">Total Discount</td>
                <td>&#8369; {{ number_format($transaction->total_discount,2) }}</td>
            </tr>
            <tr class="divide-x-2">
                <td class="font-semibold" colspan="4">Grand Total</td>
                <td>&#8369; {{ number_format($transaction->total_sales,2) }}</td>
            </tr>
            <tr class="divide-x-2">
                <td class="font-semibold" colspan="4">Amount Tendered</td>
                <td>&#8369; {{ number_format($transaction->amount_tendered,2) }}</td>
            </tr>
            <tr class="divide-x-2">
                <td class="font-semibold" colspan="4">Change</td>
                <td>&#8369; {{ number_format($transaction->change,2) }}</td>
            </tr>
        </tbody>
    </table>
    <div class="flex items-center justify-center my-20 space-x-5">
        <i class="text-2xl icofont-shopping-cart"></i>
        <h1 class="text-xl">Thank you for shopping with us! Please come again.</h1>
    </div>
</body>
</html>
