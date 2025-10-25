<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('点数入力') }}：{{ $student->name_kanji }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-xl font-semibold mb-6">{{ $task->test_name }} 第{{ $index }}回</h2>
                    <p class="mb-4 text-gray-600 dark:text-gray-400">実施予定日: {{ $task->scheduled_date->format('Y年m月d日') }}</p>

                    <form method="POST" action="{{ route('students.task.store-score', ['student' => $student->id, 'task' => $task->id]) }}">
                        @csrf
                        
                        <div class="mb-6">
                            <label for="score" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                点数（0〜100）
                            </label>
                            <input 
                                type="number" 
                                id="score" 
                                name="score" 
                                min="0" 
                                max="100" 
                                required
                                class="mt-1 block w-full md:w-1/3 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                            >
                            @error('score')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex gap-4">
                            <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">
                                登録
                            </button>
                            <a href="{{ route('students.detail', ['student' => $student->id]) }}" 
                               class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600">
                                キャンセル
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
