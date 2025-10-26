<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            ✏️ {{ __('点数入力フォーム') }}：{{ $student->name_kanji }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-xl font-semibold mb-6"> {{ $testType }} 第{{$index}}回</h2>

                    <form method="POST" action="{{ route('tests.store', ['student' => $student->id]) }}">
                        @csrf
                        <input type="hidden" name="test_name" value="{{ $testType }}">
                        <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                            登録
                        </button>
                        <label class='mr-3 ml-6'>点数</label>
                        <input type="number" name="score" class="dark:text-gray-900" required>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>