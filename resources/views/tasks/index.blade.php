<x-app-layout>
    <div class="container">

        <h5 class="text-center">My Tasks</h5>
<br>
        @if(session('success'))
            <div class="flash-success">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('tasks.create') }}" class="btn btn-primary">
            + Create Task
        </a>
        <form method="GET" action="{{ route('tasks.index') }}" style="margin:15px 0;">
            <select name="status">
                <option value="">All Status</option>
                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>
                    Completed
                </option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>
                    Pending
                </option>
            </select>

            <select name="sort">
                <option value="">No Sorting</option>
                <option value="due_date" {{ request('sort') == 'due_date' ? 'selected' : '' }}>
                    Sort by Due Date
                </option>
            </select>

            <button type="submit" class="btn btn-secondary">
                Apply Filter
            </button>

            <a href="{{ route('tasks.index') }}" class="btn btn-secondary">
                Reset
            </a>
        </form>

        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Due Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse($tasks as $task)
                    <tr>
                        <td>{{ $task->title }}</td>
                        <td>{{ $task->description }}</td>
                        <td>{{ $task->due_date }}</td>
                        <td>
                            @if($task->is_completed)
                                <span class="status-complete">Completed</span>
                            @else
                                <span class="status-pending">Pending</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('tasks.edit', $task) }}" class="btn btn-warning">Edit</a>

                            <form action="{{ route('tasks.toggle', $task) }}" method="POST" style="display:inline;">
                                @csrf @method('PATCH')
                                <button class="btn btn-secondary">Toggle</button>
                            </form>

                            <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display:inline;">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger"
                                    onclick="return confirm('Delete this task?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">No tasks found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>
</x-app-layout>
