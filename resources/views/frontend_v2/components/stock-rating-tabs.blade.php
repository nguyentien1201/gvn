<section class="py-12">
    <div class="container mx-auto text-center">
        <h2 class="text-2xl font-bold mb-6">Top StockRating by GVN</h2>

        <!-- Tabs -->
        <div x-data="{ activeTab: 'nasdaq' }">
            <div class="flex justify-center space-x-4 mb-6">
                <button @click="activeTab = 'nasdaq'"
                    :class="activeTab === 'nasdaq' ? 'bg-green-600 text-white' : 'bg-gray-200 text-gray-800'"
                    class="px-4 py-2 rounded-md transition">Green Stock NAS100</button>
                <button @click="activeTab = 'vndex'"
                    :class="activeTab === 'vndex' ? 'bg-green-600 text-white' : 'bg-gray-200 text-gray-800'"
                    class="px-4 py-2 rounded-md transition">Green Stock VNDEX</button>
            </div>

            <!-- NASDAQ Table -->
            <div x-show="activeTab === 'nasdaq'">
                <table class="w-full border-collapse border border-gray-300">
                    <thead class="bg-green-600 text-white">
                        <tr>
                            <th class="p-2 border">Rating</th>
                            <th class="p-2 border">Stock</th>
                            <th class="p-2 border">Last Sale</th>
                            <th class="p-2 border">Trend</th>
                            <th class="p-2 border">Action</th>
                            <th class="p-2 border">Profit</th>
                            <th class="p-2 border">After Sell</th>
                            <th class="p-2 border">Price</th>
                            <th class="p-2 border">Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($nasdaqStocks as $stock)
                            <tr class="border text-center">
                                <td class="p-2">{{ $stock['rating'] }}</td>
                                <td class="p-2">{{ $stock['name'] }}</td>
                                <td class="p-2">{{ $stock['last_sale'] }}</td>
                                <td class="p-2">{{ $stock['trend'] }}</td>
                                <td class="p-2">{{ $stock['action'] }}</td>
                                <td class="p-2">{{ $stock['profit'] }}%</td>
                                <td class="p-2">{{ $stock['after_sell'] }}%</td>
                                <td class="p-2">{{ $stock['price'] }}</td>
                                <td class="p-2">{{ $stock['time'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- VNDEX Table -->
            <div x-show="activeTab === 'vndex'">
                <table class="w-full border-collapse border border-gray-300">
                    <thead class="bg-green-600 text-white">
                        <tr>
                            <th class="p-2 border">Rating</th>
                            <th class="p-2 border">Stock</th>
                            <th class="p-2 border">Last Sale</th>
                            <th class="p-2 border">Trend</th>
                            <th class="p-2 border">Action</th>
                            <th class="p-2 border">Profit</th>
                            <th class="p-2 border">After Sell</th>
                            <th class="p-2 border">Price</th>
                            <th class="p-2 border">Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($vndexStocks as $stock)
                            <tr class="border text-center">
                                <td class="p-2">{{ $stock['rating'] }}</td>
                                <td class="p-2">{{ $stock['name'] }}</td>
                                <td class="p-2">{{ $stock['last_sale'] }}</td>
                                <td class="p-2">{{ $stock['trend'] }}</td>
                                <td class="p-2">{{ $stock['action'] }}</td>
                                <td class="p-2">{{ $stock['profit'] }}%</td>
                                <td class="p-2">{{ $stock['after_sell'] }}%</td>
                                <td class="p-2">{{ $stock['price'] }}</td>
                                <td class="p-2">{{ $stock['time'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
