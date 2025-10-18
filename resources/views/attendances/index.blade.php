<!-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('出席状況') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    生徒検索フォーム
                    <form method="GET" action="{{ route('attendances.search') }}" class="mb-6">
                        @csrf
                        <x-primary-button type="submit">{{ __('出席登録へ') }}</x-primary-button>
                    </form>
                    出席状況テーブル
                    <div class="mt-6">
                        @if ($attendances->count() > 0)
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead>
                                    <tr>
                                        <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left">
                                            <span class="text-xs leading-4 font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">生徒ID</span>
                                        </th>
                                        <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left">
                                            <span class="text-xs leading-4 font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">氏名</span>
                                        </th>
                                        <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left">
                                            <span class="text-xs leading-4 font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">出席状況</span>
                                        </th>
                                        <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left">
                                            <span class="text-xs leading-4 font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">備考</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach ($attendances as $attendance)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-no-wrap text-sm whitespace-nowrap">
                                                <span class="text-gray-900 dark:text-gray-100">{{ $attendance->student_id }}</span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-no-wrap text-sm whitespace-nowrap">
                                                <span class="text-gray-900 dark:text-gray-100">{{ $attendance->student->name_kanji }}</span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-no-wrap text-sm whitespace-nowrap">
                                                <span class="text-gray-900 dark:text-gray-100">{{ $attendance->status }}</span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-no-wrap text-sm whitespace-nowrap">
                                                <span class="text-gray-900 dark:text-gray-100">{{ $attendance->note }}</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p class="text-gray-500">{{ __('出席情報が見つかりません。') }}</p>
                        @endif

                        出席登録がまだの分
                        <div class="mt-6">
                            @foreach ($attendances as $attendance)
                                @if ($attendance == null)
                                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                        <thead>
                                            <tr>
                                                <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left">
                                                    <span class="text-xs leading-4 font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">生徒ID</span>
                                                </th>
                                                <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left">
                                                    <span class="text-xs leading-4 font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">氏名</span>
                                                </th>
                                                <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left">
                                                    <span class="text-xs leading-4 font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">出席登録</span>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700">
                                            <tr>
                                                <td class="px-6 py-4 whitespace-no-wrap text-sm whitespace-nowrap">
                                                    <span class="text-gray-900 dark:text-gray-100">{{ $attendance->student_id }}</span>
                                                </td>
                                                <td class="px-6 py-4 whitespace-no-wrap text-sm whitespace-nowrap">
                                                    <span class="text-gray-900 dark:text-gray-100">{{ $attendance->student->name_kanji }}</span>
                                                </td>
                                                <td class="px-6 py-4 whitespace-no-wrap text-sm whitespace-nowrap">
                                                    <a href="{{ route('attendances.create', ['student' => $attendance->student_id]) }}"
                                                        class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                                                        {{ __('出席登録') }}
                                                    </a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>                                    
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> -->