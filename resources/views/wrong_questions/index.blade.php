<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            📖 {{ __('英単語登録フォーム') }}：{{ $student->name_kanji }} 
        </h2>
    </x-slot>

    @if (session('success'))
        <div 
            x-data="{ show: true }" 
            x-show="show"
            x-init="setTimeout(() => show = false, 3000)"
            class="max-w-7xl mx-auto mt-4"
        >
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">成功！</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        </div>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-900">
                    <form method="POST" action="{{ route('wrong_questions.store', ['student' => $student->id]) }}" x-data="{ showAll: false }">
                        @csrf
                        <table class="table-auto w-full border border-gray-300">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="px-4 py-2">Word</th>
                                    <th class="px-4 py-2">Translation</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($questions as $i => $q)
                                <tr>
                                    <td class="border px-4 py-2">
                                        <input type="text" name="word[]" value="{{ $q->word }}" class="w-full border rounded px-2 py-1">
                                    </td>
                                    <td class="border px-4 py-2">
                                        <input type="text" name="translation[]" value="{{ $q->translation }}" class="w-full border rounded px-2 py-1">
                                    </td>
                                </tr>
                            @endforeach

                            @for ($j = 0; $j < (20 - $questions->count()); $j++)
                                <tr>
                                    <td class="border px-4 py-2">
                                        <input type="text" name="word[]" value="" class="w-full border rounded px-2 py-1">
                                    </td>
                                    <td class="border px-4 py-2">
                                        <input type="text" name="translation[]" value="" class="w-full border rounded px-2 py-1">
                                    </td>
                                </tr>
                                @endfor
                            </tbody>
                        </table>

                        <div class="mt-4 text-right">
                            <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">保存</button>
                            <a href="{{ route('wrong_questions.pdf', ['student' => $student->id]) }}" onclick="return confirm('本当に出力しますか？');" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">テスト出力</a>                        
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>