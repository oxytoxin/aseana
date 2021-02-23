<div class="w-3/4 p-5 mx-auto bg-white">
    <div class="flex flex-col items-center justify-center my-16 space-y-10 h-60">
        <h1 class="text-2xl">WELCOME TO</h1>
        <h1 class="text-6xl font-semibold">ASEANA General Merchandise</h1>
    </div>
    <div class="flex items-center justify-center mx-auto space-x-5">
        <x-link text="Point of Sales" class="bg-red-400" href="{{ route('pos.index') }}" />
        <x-link text="Products" class="bg-red-400" href="{{ route('products.index') }}" />
        <x-link text="Inventory" class="bg-red-400" href="{{ route('inventory.index') }}" />
        <x-link text="Reports" class="bg-red-400" href="{{ route('reports.index') }}" />
    </div>
    <hr class="my-4 border-t-4 border-gray-900">
    <div class="flex text-sm">
        <div class="w-1/2 p-5 bg-red-300 h-96">
            <h1 class="text-2xl font-semibold text-center">POPULAR PRODUCTS</h1>
            <div class="mx-auto my-4 space-y-3">
                @forelse ($popular as $pop_name => $pop)
                <div class="flex justify-between">
                    <h1 class="w-1/2 space-x-2"><span>&#x1F947;</span><span>{{ $pop_name }}</span></h1>
                    <h1>{{ $pop['quantity'] }} sold</h1>
                </div>
                @empty

                @endforelse

            </div>
        </div>
        <div class="flex flex-col w-1/2 p-5 bg-red-200 h-96">
            <h1 class="text-2xl font-semibold text-center">STOCKS WATCH</h1>
            <div class="flex flex-col flex-grow px-5 my-4 space-y-3 overflow-y-auto">
                @forelse ($warning as $warn)
                <div class="flex justify-between">
                    <h1 class="w-3/4 space-x-2"><i class="{{ $warn->stock->quantity === 0 ? 'text-red-600' : 'text-yellow-400' }} icofont-warning"></i><span>{{ $warn->name }}</span></h1>
                    <h1>{{ $warn->stock->quantity }} remaining</h1>
                </div>
                @empty

                @endforelse
            </div>
        </div>
    </div>
    <div class="p-5 my-5">
        <h1 class="my-3 text-3xl font-semibold text-center">This Week's Sales</h1>
        <div x-data="{chart:null}" x-init="
    chart = new Chart($refs.chartCvs, {
    type: 'bar',
    data: {
        labels: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
        datasets: [{
            label: 'Weekly Sales',
            data: @this.weekly_sales,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(180, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(180, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
">
            <canvas x-ref="chartCvs" id="myChart"></canvas>
        </div>
    </div>
</div>
