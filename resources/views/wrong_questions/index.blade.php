<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('英単語登録フォーム') }}：{{ $student->name_kanji }} 
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
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
                                @for ($i = 0; $i < 20; $i++)
                                    <tr
                                        x-show="{{ $i < 8 ? 'true' : 'showAll' }}" 
                                        x-transition
                                    >
                                        <td class="border px-4 py-2">
                                            <input type="text" name="word[]" class="w-full border rounded px-2 py-1">
                                        </td>
                                        <td class="border px-4 py-2">
                                            <input type="text" name="translation[]" class="w-full border rounded px-2 py-1">
                                        </td>
                                    </tr>
                                @endfor
                            </tbody>
                        </table>

                        <div class="mt-4 text-center space-x-4">
                            <button 
                                type="button"
                                class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400"
                                x-show="!showAll"
                                @click="showAll = true"
                            >
                                &#9660; さらに入力欄を表示
                            </button>

                            <button 
                                type="button"
                                class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400"
                                x-show="showAll"
                                @click="showAll = false"
                            >
                                &#9650; 入力欄を閉じる
                            </button>
                        </div>


                        <div class="mt-4 text-right">
                            <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">保存</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>