<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            📝 {{ __('点数一覧') }}：{{ $student->name_kanji }}
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
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- 指定された生徒の点数一覧 -->
                        @foreach($test_types as $test_type)
                            <div class="mb-10 p-4 shadow-sm dark:shadow-gray-800 dark:bg-gray-700 rounded-lg border-l-4 border-blue-500">
                                <h4 class="text-lg font-semibold mx-4 text-blue-600 dark:text-blue-400">🎓 {{ $test_type }} テスト</h4>
                                <div class="my-4 overflow-x-auto">
                                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                        <thead>
                                            <tr>
                                                <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left whitespace-nowrap">
                                                    <span class="text-xs leading-4 font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">回</span>
                                                </th>
                                                @for ($i = 1; $i <= $columns[$test_type]; $i++)
                                                    <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left whitespace-nowrap">
                                                        <span class="text-sm leading-4 font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">{{ $i }}</span>
                                                    </th>
                                                @endfor
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700">
                                            <tr>
                                                <td class="px-6 py-4 whitespace-no-wrap text-sm whitespace-nowrap">
                                                    <span class="text-gray-900 dark:text-gray-900">点数</span>
                                                </td>
                                                @for ($i = 1; $i <= $columns[$test_type]; $i++)
                                                    @php
                                                        $test = $tests->where('test_name', $test_type)->skip($i - 1)->first();
                                                    @endphp
                                                    <td class="px-6 py-4 whitespace-no-wrap text-md whitespace-nowrap">
                                                        @if ($test)
                                                            <a href="{{ route('tests.edit', ['student' => $student->id, 'test' => $test->id]) }}"
                                                            class="text-gray-900 hover:underline">
                                                                {{ $test->score }}
                                                            </a>
                                                        @else
                                                            <div class="text-gray-400"></div>
                                                        @endif
                                                    </td>
                                                @endfor
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                
                                <div>
                                    @php
                                        // 現在の登録数
                                        $count = $tests->where('test_name', $test_type)->count();
                                        // 上限（ここでは $columns に一致させてOK）
                                        $limit = $columns[$test_type];
                                    @endphp

                                    <!-- 追加ボタン -->
                                    @if ($count < $limit)
                                        <a href="{{ route('tests.create', ['student' => $student->id, 'type' => $test_type]) }}"
                                            class="bg-blue-500 text-white px-6 py-2 ml-4 rounded-md hover:bg-blue-600 transition duration-200 shadow-md">
                                            ➕ 追加
                                        </a>
                                    @else
                                        <button
                                            class="bg-gray-400 text-white px-6 py-2 ml-4 rounded-md cursor-not-allowed opacity-60"
                                            disabled
                                        >
                                            追加
                                        </button>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>