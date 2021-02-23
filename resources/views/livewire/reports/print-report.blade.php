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

<body x-data x-init="window.print();" class="p-10 mx-auto text-gray-800">
    <div>
        <div class="flex items-center space-x-3">
            <img src="{{ asset('img/logo.png') }}" class="w-12 h-12" alt="logo">
            <h1 class="text-xl">ASEANA General Merchandise</h1>
        </div>
        <div class="py-10">
            <h1>Branch: NDTC Centrum II</h1>
            <h1>Date: {{ now()->format('M d, Y') }}</h1>
        </div>
    </div>
    <div class="flex-grow w-full px-5 overflow-y-auto">
        <table class="table w-full text-sm text-center border-collapse table-auto">
            <thead class="text-white border">
                <tr class="border">
                    <th class="top-0 w-auto p-2 font-medium bg-red-600 border">Transaction Code</th>
                    <th class="top-0 p-2 font-medium bg-red-600 border">Date</th>
                    <th class="top-0 p-2 font-medium bg-red-600 border">Products</th>
                    <th class="top-0 p-2 font-medium bg-red-600 border">Quantity</th>
                    <th class="top-0 p-2 font-medium bg-red-600 border">SRP</th>
                    <th class="top-0 p-2 font-medium bg-red-600 border">Sell Price</th>
                    <th class="top-0 p-2 font-medium bg-red-600 border">Discount</th>
                    <th class="top-0 p-2 font-medium bg-red-600 border">Total Sales</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($transactions as $transaction)
                <tr>
                    <td class="p-2 border">{{ $transaction->code }}</td>
                    <td class="p-2 border">{{ $transaction->date_for_humans }}</td>
                    <td class="w-48 p-2 border">
                        @foreach ($transaction->products as $product)
                        <h1 class="text-sm">{{ $product->name }}</h1>
                        @endforeach
                    </td>
                    <td class="p-2 border">
                        @foreach ($transaction->products as $product)
                        <h1>{{$product->pivot->quantity }}</h1>
                        @endforeach
                    </td>
                    <td class="p-2 border">
                        @foreach ($transaction->products as $product)
                        <h1 class="text-sm">&#8369; {{ number_format($product->srp,2) }}</h1>
                        @endforeach
                    </td>
                    <td class="p-2 border">
                        @foreach ($transaction->products as $product)
                        <h1 class="text-sm">&#8369; {{ number_format($product->pivot->sell_price,2) }}</h1>
                        @endforeach
                    </td>
                    <td class="p-2 border">
                        @foreach ($transaction->products as $product)
                        <h1 class="text-sm">&#8369; {{ number_format($product->pivot->discount,2) }}</h1>
                        @endforeach
                    </td>
                    <td class="p-2 space-x-3 border">
                        <h1 class="text-sm">&#8369; {{ number_format($transaction->total_sales,2) }}</h1>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="p-2 text-center border">No transactions for this date range.</td>
                </tr>
                @endforelse
                <tr>
                    <td colspan="4" class="p-2 text-center border">Grand Total Sales</td>
                    <td colspan="4" class="p-2 text-center border">&#8369; {{ number_format($transactions->sum('total_sales'),2) }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="flex flex-col items-start justify-center">
        <h1 class="my-20">Prepared by:</h1>
        <div class="w-64 border-b-2 border-black"></div>
    </div>
</body>
</html>
