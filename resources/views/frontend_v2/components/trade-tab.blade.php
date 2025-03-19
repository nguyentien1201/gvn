<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<!-- resources/views/components/trade-tab.blade.php -->
<div x-data="{ tab: 'beta' }" class="container mx-auto p-8">
    <!-- Tab Buttons -->
    <div class="flex justify-center space-x-4">
        <button @click="tab = 'beta'" :class="tab === 'beta' ? 'bg-green-600 text-white' : 'bg-gray-200 text-gray-600'"
            class="px-6 py-2 rounded-lg shadow-md">
            Trading on Green Beta
        </button>
        <button @click="tab = 'alpha'" :class="tab === 'alpha' ? 'bg-green-600 text-white' : 'bg-gray-200 text-gray-600'"
            class="px-6 py-2 rounded-lg shadow-md">
            Trading on Green Alpha
        </button>
    </div>

    <!-- Green Beta Content -->
    <div x-show="tab === 'beta'" class="mt-8">
        <div class="grid md:grid-cols-2 gap-6 items-center">
            <div>
                <p class="text-gray-700">
                    Green Beta’s trading method is Position Trading, which is to find the points with the highest
                    probability of winning and hold that position in the medium and long term until the market signals
                    take profit and stop loss.
                </p>
                <p class="text-green-600 font-semibold mt-4">
                    Searching for cash flow movement, searching for the advantage of increasing your assets!
                </p>
            </div>
            <img src="/images/robot-beta.png" alt="Green Beta Robot" class="rounded-lg shadow-lg">
        </div>
        <div class="mt-6">
            <img src="/images/chart-beta.png" alt="Green Beta Chart" class="w-full rounded-lg shadow-lg">
        </div>
    </div>

    <!-- Green Alpha Content -->
    <div x-show="tab === 'alpha'" class="mt-8">
        <div class="grid md:grid-cols-2 gap-6 items-center">
            <img src="/images/robot-alpha.png" alt="Green Alpha Robot" class="rounded-lg shadow-lg">
            <div>
                <p class="text-gray-700">
                    Green Alpha is an intelligent automated trading robot, designed to maximize short-term trading
                    opportunities in the market.
                </p>
                <p class="text-gray-700 mt-2">
                    With the ability to analyze multiple levels of short-term indicators, Green Alpha helps investors
                    find entry points with high and stable winning probability.
                </p>
            </div>
        </div>
        <div class="mt-6">
            <img src="/images/chart-alpha.png" alt="Green Alpha Chart" class="w-full rounded-lg shadow-lg">
        </div>
    </div>
</div>
