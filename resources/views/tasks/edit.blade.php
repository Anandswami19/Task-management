<x-app-layout>
    <div class="container">
        <h2>Edit Task</h2>
        <div class="form-box">
            <form method="POST" action="{{ route('tasks.update', $task) }}">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Title</label>
                    <input type="text"
                           name="title"
                           value="{{ old('title', $task->title) }}">

                    @error('title')
                        <small style="color:red;">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description">{{ old('description', $task->description) }}</textarea>

                    @error('description')
                        <small style="color:red;">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Due Date</label>
                    <input type="date"
                           name="due_date"
                           value="{{ old('due_date', $task->due_date) }}">

                    @error('due_date')
                        <small style="color:red;">{{ $message }}</small>
                    @enderror
                </div>

                <button class="btn btn-success">Update Task</button>
                <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>

    </div>
</x-app-layout>
