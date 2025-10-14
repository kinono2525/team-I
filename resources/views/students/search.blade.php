<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('生徒情報検索') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- 検索フォーム -->
                    <form method="GET" action="{{ route('students.search') }}" class="mb-6">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <x-input-label for="student_id" :value="__('学籍番号')" />
                                <x-text-input id="student_id" name="student_id" type="text" class="mt-1 block w-full" />
                            </div>
                            <div>
                                <x-input-label for="name" :value="__('氏名')" />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" />
                            </div>
                            <div>
                                <x-input-label for="class" :value="__('クラス')" />
                                <select id="class" name="class" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                    <option value="">選択してください</option>
                                    <option value="1A">1A</option>
                                    <option value="1B">1B</option>
                                    <option value="2A">2A</option>
                                    <option value="2B">2B</option>
                                    <option value="3A">3A</option>
                                    <option value="3B">3B</option>
                                </select>
                            </div>
                        </div>
                        <div class="mt-4">
                            <x-primary-button>{{ __('検索') }}</x-primary-button>
                        </div>
                    </form>

                    <!-- 検索結果テーブル（仮のデータ） -->
                    <div class="mt-6">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left">
                                        <span class="text-xs leading-4 font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">学籍番号</span>
                                    </th>
                                    <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left">
                                        <span class="text-xs leading-4 font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">氏名</span>
                                    </th>
                                    <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left">
                                        <span class="text-xs leading-4 font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">クラス</span>
                                    </th>
                                    <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left">
                                        <span class="text-xs leading-4 font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">操作</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700">
                                <!-- サンプルデータ -->
                                <tr>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm">
                                        <div class="text-gray-900 dark:text-gray-100">2025001</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm">
                                        <div class="text-gray-900 dark:text-gray-100">山田太郎</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm">
                                        <div class="text-gray-900 dark:text-gray-100">1A</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm">
                                        <x-primary-button>
                                            {{ __('テスト結果入力') }}
                                        </x-primary-button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm">
                                        <div class="text-gray-900 dark:text-gray-100">2025002</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm">
                                        <div class="text-gray-900 dark:text-gray-100">鈴木花子</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm">
                                        <div class="text-gray-900 dark:text-gray-100">1A</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm">
                                        <x-primary-button>
                                            {{ __('テスト結果入力') }}
                                        </x-primary-button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>