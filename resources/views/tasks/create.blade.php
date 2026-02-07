<x-app-layout>
    <div class="container">
        <h2>Create Task</h2>

        <div class="form-box">
            <form method="POST" action="{{ route('tasks.store') }}">
                @csrf

                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="title" value="{{ old('title') }}">
                     @error('title')
                        <small style="color:red;">{{ $message }}</small>
                    @enderror
                </div>

               <div class="form-group">
                    <label>Description</label>
                    <textarea name="description">{{ old('description') }}</textarea>
                    @error('description')
                        <small style="color:red;">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Due Date</label>
                    <input type="date" name="due_date" value="{{ old('due_date') }}">
                    @error('due_date')
                        <small style="color:red;">{{ $message }}</small>
                    @enderror
                </div>


                <button class="btn btn-success">Save Task</button>
                <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>

    </div>
</x-app-layout>
