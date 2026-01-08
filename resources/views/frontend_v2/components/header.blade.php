<!-- resources/views/components/header.blade.php -->
<header class="bg-white shadow-md fixed top-0 left-0 w-full z-50">
    <div class="container mx-auto flex items-center justify-between p-4">
        <!-- Logo -->
        <a href="#" class="text-green-600 font-bold text-xl">FinTrade</a>

        <!-- Navigation -->
        <nav class="hidden md:flex space-x-6">
            <a href="#" class="hover:text-green-600">{{__('base.Mainpage')}}</a>
            <a href="#" class="hover:text-green-600">{{__('base.Systems')}}</a>
            <a href="#" class="hover:text-green-600">{{__('base.Mission')}}</a>
            <a href="#" class="hover:text-green-600">{{__('base.Product')}}</a>
            <a href="#" class="hover:text-green-600">{{__('base.Contact')}}</a>
        </nav>

        <!-- Actions -->
        <div class="flex items-center space-x-4">
             <div class="dropdown ml-2">
                        @php
                            $locale = session('locale', config('app.locale'));
                            $flags = ['en' => 'flag-icon-gb', 'vi' => 'flag-icon-vn'];
                            $flagClass = $flags[$locale] ?? 'flag-icon-gb';
                        @endphp
                        <div class="dropdown-toggle" id="langDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="flag-icon {{ $flagClass }}"></span>
                        </div>
                        <div class="dropdown-menu dropdown-menu" aria-labelledby="langDropdown">
                            <form action="{{ route('changeLanguage') }}" method="POST" id="language-form">
                                @csrf
                                <button type="submit" name="language" value="en" class="dropdown-item">
                                    <span class="flag-icon flag-icon-gb"></span> English
                                </button>
                                <button type="submit" name="language" value="vi" class="dropdown-item">
                                    <span class="flag-icon flag-icon-vn"></span> Vietnam
                                </button>
                            </form>
                        </div>
                    </div>
            <button class="text-gray-600 hover:text-green-600">🌍</button>
            <a href="#" class="text-gray-700 hover:text-green-600">Log in</a>
            <a href="#" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">Sign up</a>
        </div>
    </div>
</header>
