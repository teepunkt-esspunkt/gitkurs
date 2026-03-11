<x-layout title="Task bearbeiten">
    <h1>Task bearbeiten</h1>

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

    <form method="POST" action="/tasks/{{ $task->id }}">
        @csrf
        @method('PUT')
       <x-form-tasks :task="$task" :users="$users" />
        <button type="submit">Aktualisieren</button>
        <a href="/tasks/{{ $task->id }}">Abbrechen</a>
    </form>
</x-layout>
