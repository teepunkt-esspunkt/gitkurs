<x-layout title="Task erstellen">
    <h1>Task erstellen</h1>

    @if($errors->any())
        <div style="padding:10px; border:1px solid #f3b; background:#ffe9ef; margin: 12px 0;">
            <strong>Bitte korrigieren:</strong>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="/tasks">
        @csrf
        <x-form-tasks :task="$task" :users="$users" />
        {{-- 
                <div style="display:grid; gap:12px; max-width:700px; margin: 12px 0;">
        <div>
            <label for="title">Titel *</label><br>
            <input id="title" name="title" type="text" value="{{ old('title') }}" style="width:100%;">
            @error('title') <div style="color:#b00;">{{ $message }}</div> @enderror
        </div>

        <div>
            <label for="status">Status *</label><br>
            <select id="status" name="status">
                <option value="open" @if(old('status') === 'open') selected @endif>open</option>
                <option value="done" @selected(old('status') === 'done')>done</option>
            </select>
            @error('status') <div style="color:#b00;">{{ $message }}</div> @enderror
        </div>

        <div>
            <label for="due_date">Fällig am</label><br>
            <input id="due_date" name="due_date" type="date"
                value="{{ old('due_date') }}">
            @error('due_date') <div style="color:#b00;">{{ $message }}</div> @enderror
        </div>

        <div>
            <label for="notes">Notizen</label><br>
            <textarea id="notes" name="notes" rows="4" style="width:100%;">{{ old('notes') }}</textarea>
            @error('notes') <div style="color:#b00;">{{ $message }}</div> @enderror
        </div>
    </div>
        --}}


        <button type="submit">Speichern</button>
        <a href="/tasks">Abbrechen</a>
    </form>
</x-layout>
