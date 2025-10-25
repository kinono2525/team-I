<x-app-layout>
	<x-slot name="header">
		<h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
			{{ __('生徒詳細') }}：{{ $student->name_kanji }}
		</h2>
	</x-slot>

	@if (session('success'))
		<div 
			x-data="{ show: true }" 
			x-show="show"
			x-init="setTimeout(() => show = false, 3000)"
			class="max-w-4xl mx-auto mt-4 px-6"
		>
			<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
				<strong class="font-bold">成功！</strong>
				<span class="block sm:inline">{{ session('success') }}</span>
			</div>
		</div>
	@endif

	<div class="py-12">
		<div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
			<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
				<div class="p-6 text-gray-900 dark:text-gray-100">
					<h2 class="text-xl font-semibold mb-4">タスク一覧</h2>

					@if($tasks->isEmpty())
						<p class="text-gray-500 dark:text-gray-400">現在、タスクはありません。</p>
					@else
						<table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
							<thead>
								<tr>
									<th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left">
										<span class="text-xs leading-4 font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">タスク名</span>
									</th>
									<th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left">
										<span class="text-xs leading-4 font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">期限</span>
									</th>
									<th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left">
										<span class="text-xs leading-4 font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">ステータス</span>
									</th>
									<th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left">
										<span class="text-xs leading-4 font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">操作</span>
									</th>
								</tr>
							</thead>
							<tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700">
								@foreach ($tasks as $task)
								<tr>
									<td class="px-6 py-4 whitespace-no-wrap text-sm">{{ $task['name'] }}</td>
									<td class="px-6 py-4 whitespace-no-wrap text-sm">{{ $task['deadline'] }}</td>
									<td class="px-6 py-4 whitespace-no-wrap text-sm">
										<span class="px-2 py-1 rounded {{ $task['status'] == '完了' ? 'bg-green-200 text-green-800' : 'bg-yellow-200 text-yellow-800' }}">
											{{ $task['status'] }}
										</span>
									</td>
									<td class="px-6 py-4 whitespace-no-wrap text-sm">
										@if($task['status'] == '未完了')
											<form method="POST" action="{{ route('students.task.complete', ['student' => $student->id, 'task' => $task['id']]) }}" style="display: inline;">
												@csrf
												@method('PATCH')
												<button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 text-xs"
													onclick="return confirm('このタスクを完了しますか？');">
													完了
												</button>
											</form>
										@endif
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					@endif
				</div>
			</div>
		</div>
	</div>
</x-app-layout>
