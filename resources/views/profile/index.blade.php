<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ auth()->user()->name }}
        </h2>
    </x-slot>

    @if($errors->any())
    <div class="flex items-center justify-center px-2 mb-6">
        <div class="bg-white w-full rounded-lg shadow-xl text-sm text-red-500 p-6">
            {!! implode('', $errors->all('<div>:message</div>')) !!}
        </div>
    </div>
    @endif


    <div class="flex items-center justify-center px-2">
        <div class="bg-white w-full rounded-lg shadow-xl">
            <div class="p-4 border-b">
                <h2 class="text-2xl ">
                    Setting
                </h2>
                <p class="text-sm text-gray-500">
                    Setting your profile
                </p>
            </div>
            <div>
                <form action="{{ route('profile.update',auth()->id()) }}" method="POST">
                    @method('PUT')
                    @csrf

                    <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                        <p class="text-gray-600">
                            Api Key
                        </p>
                        <input name="api_key"
                            class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                            id="inline-full-name" type="text" value="{{ old('api_key',optional($userApi)->api_key) }}">
                    </div>
                    <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                        <p class="text-gray-600">
                            Secret Key
                        </p>
                        <input name="secret_key"
                            class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                            id="inline-full-name" type="text"
                            value="{{ old('secret_key',optional($userApi)->secret_key) }}">
                    </div>
                    <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                        <p class="text-gray-600">
                            Amount per trade
                        </p>
                        <input name="amount_trade"
                            class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                            id="inline-full-name" type="text"
                            value="{{ old('amount_trade', optional($userSetting)->amount_trade) }}">
                    </div>
                    <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                        <p class="text-gray-600">
                            Take Profit
                        </p>
                        <input name="take_profit"
                            class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                            id="inline-full-name" type="text"
                            value="{{ old('take_profit', optional($userSetting)->take_profit) }}">
                    </div>
                    <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                        <p class="text-gray-600">
                            Stop Loss
                        </p>
                        <input name="stop_loss"
                            class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                            id="inline-full-name" type="text"
                            value="{{ old('stop_loss', optional($userSetting)->stop_loss) }}">
                    </div>

                    <x-button class="my-2 mx-2">Save</x-button>
                </form>
            </div>
        </div>
    </div>



</x-app-layout>