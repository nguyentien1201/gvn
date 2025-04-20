<section class="bg-green-900 py-12 text-white">
    <div class="container mx-auto text-center">
        <h2 class="text-2xl font-bold mb-6">Top signals in previous session</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($signals as $signal)
                <div class="bg-white text-gray-900 p-4 rounded-lg shadow-md text-center">
                    <img src="/images/logo.png" alt="Signal Logo" class="mx-auto w-10 h-10 mb-2">
                    <h3 class="text-lg font-semibold">'đâsd'</h3>
                    <p class="text-green-600 font-medium">đâs</p>
                    <p class="text-gray-500">Take Profit Sell:</p>
                    <p class="text-green-500 font-bold">{{ $signal['profit'] }}%</p>
                    <p class="text-gray-400 text-sm">đấ</p>
                </div>
            @endforeach
        </div>
    </div>
</section>
