<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('出席状況確認') }}：{{ $student->name_kanji }}
        </h2>
    </x-slot>

    @if (session('success'))
        <div 
            x-data="{ show: true }" 
            x-show="show"
            x-init="setTimeout(() => show = false, 3000)"
            class="max-w-7xl mx-auto mt-4"
        >
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">成功！</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        </div>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <!-- 月選択 + 前半後半切り替え -->
                    <form method="GET" action="{{ route('attendances.index', ['student' => $student->id]) }}" class="mb-6">
                        <div class="flex items-center space-x-4">
                            <div>
                                <x-input-label for="month" :value="__('月選択')" />
                                <x-text-input id="month" name="month" type="month" class="mt-1 block w-full" value="{{ request('month', now()->format('Y-m')) }}" />
                            </div>
                            <div>
                                <x-input-label for="half" :value="__('前半・後半')" />
                                <select id="half" name="half" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                    <option value="1" {{ request('half', 1) == 1 ? 'selected' : '' }}>月前半 (1日〜15日)</option>
                                    <option value="2" {{ request('half') == 2 ? 'selected' : '' }}>月後半 (16日〜月末)</option>
                                </select>
                            </div>
                            <div class="self-end">
                                <x-primary-button class="px-8 py-3">{{ __('選択') }}</x-primary-button>
                            </div>
                        </div>
                    </form>
                    <!-- 出席一覧テーブル -->
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left">
                                    <span class="text-xs leading-4 font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">日付</span>
                                </th>
                                <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left">
                                    <span class="text-xs leading-4 font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">出席状況</span>
                                </th>
                                <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left">
                                    <span class="text-xs leading-4 font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">備考</span>
                                </th>
                                <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left">
                                    <span class="text-xs leading-4 font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">編集</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700">
                            @php
                                $current = $startDate->copy();
                            @endphp

                            @while($current <= $endDate)
                                @php
                                    $attendance = $attendances->get($current->toDateString());
                                @endphp
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $current->format('Y-m-d (D)') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($attendance)
                                            <span class="px-2 py-1 rounded {{ $attendance->status == '出席' ? 'bg-green-200 text-green-800' : ($attendance->status == '遅刻' ? 'bg-yellow-200 text-yellow-800' : 'bg-red-200 text-red-800') }}">
                                                {{ $attendance->status }}
                                            </span>
                                        @else
                                            <span class="text-gray-500">未登録</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $attendance->note ?? 'ー' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($current->lte(now()))
                                            @if ($attendance)
                                                <a href="{{ route('attendances.edit', ['student' => $student->id, 'attendance' => $attendance->id]) }}">
                                                    <x-primary-button class="px-6">
                                                        編集
                                                    </x-primary-button>
                                                </a>
                                            @else
                                                <div>ー</div>
                                            @endif
                                        @else
                                            <span class="text-gray-400"></span>
                                        @endif
                                    </td>
                                </tr>
                                @php
                                    $current->addDay();
                                @endphp
                            @endwhile
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>