<section class="container mx-auto px-4 py-8">
    <h2 class="text-center text-2xl font-bold mb-6">{{__('base.green_stock_100')}}<</h2>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 items-center">
        <!-- Image and Description -->
        <div>
            <img src="/images/trading-bull.jpg" alt="Trading Bull" class="rounded-lg shadow-md w-full">
        </div>
        <div>
            <h3 class="text-xl font-semibold">GreenStock-NAS100</h3>
            <p class="text-gray-600 text-sm mt-2">{{__('base.description_title_green_stock')}}
            
            </p>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
        <!-- Pie Chart -->
        <div class="bg-white p-4 shadow-md rounded-lg text-center">
            <h4 class="text-lg font-semibold mb-2">{{__('base.BUY')}} - {{__('base.CASH')}} - {{__('base.HOLD')}} - {{__('base.SELL')}}</h4>
            <img src="/images/pie-chart.png" alt="Pie Chart" class="mx-auto w-64 h-64">
        </div>

        <!-- Bar Chart -->
        <div class="bg-white p-4 shadow-md rounded-lg">
            <h4 class="text-lg font-semibold mb-2">{{__('base.DOWN')}} - {{__('base.GO_UP')}}</h4>
            <img src="/images/bar-chart.png" alt="Bar Chart" class="mx-auto w-full">
        </div>
    </div>
</section>