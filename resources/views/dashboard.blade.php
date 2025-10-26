<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            🏠 ホーム
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-gray-700 dark:to-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-8 text-gray-900 dark:text-gray-100">
                    <h3 class="text-3xl font-bold mb-2">👋 ようこそ、{{ Auth::user()->name }} さん</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-lg">生徒管理システムへようこそ！</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- クイックアクション1 -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border-t-4 border-blue-500">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-semibold mb-2">👥 生徒を選択</h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400">生徒を検索・選択して管理します</p>
                            </div>
                            <div class="text-4xl">👥</div>
                        </div>
                        <a href="{{ route('students.search') }}" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                            生徒選択へ →
                        </a>
                    </div>
                </div>

                <!-- クイックアクション2 -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border-t-4 border-green-500">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-semibold mb-2">➕ 生徒登録</h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400">新しい生徒情報を登録します</p>
                            </div>
                            <div class="text-4xl">➕</div>
                        </div>
                        <a href="{{ route('students.create') }}" class="mt-4 inline-block bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition">
                            生徒登録へ →
                        </a>
                    </div>
                </div>

                <!-- システム情報 -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border-t-4 border-purple-500">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-semibold mb-2">ℹ️ システム情報</h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">今日：{{ now()->format('Y年m月d日') }}</p>
                                <p class="text-xs text-gray-400">{{ now()->format('H:i') }}</p>
                            </div>
                            <div class="text-4xl">📅</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6 bg-blue-50 dark:bg-blue-900 border border-blue-200 dark:border-blue-700 rounded-lg p-4">
                <p class="text-blue-800 dark:text-blue-100">
                    💡 <strong>ヒント：</strong>「生徒選択」から目的の生徒を検索して、テスト記録や出席状況を管理できます。
                </p>
            </div>
        </div>
    </div>
</x-app-layout>
