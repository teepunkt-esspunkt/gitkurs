<x-layout title="Tasks">
    <h1>Tasks</h1>

    <p><a href="/tasks/create">+ Neue Aufgabe</a></p>
    <div class="row">
    <form action="/tasks" method="GET">
    <input name="suche" type="text" placeholder="Suche..." value="{{ request()->suche }}">
    <button type="submit">Suchen</button> <a href="/tasks">Alle anzeigen</a>
    </form> 
    </div>
    <table border="1" cellpadding="8" cellspacing="0" style="width:100%; border-collapse:collapse;">
        <thead>
            <tr>
                <th>Titel</th>
                <th>Status</th>
                <th>Fällig</th>
                <th>Aktionen</th>
            </tr>
        </thead>
        <tbody>
        @forelse($tasks as $task)
            <tr>
                <td>{{ $task->title }}</td>
                <td>{{ $task->status }}</td>
                <td>@isset($task->due_date)
                    {{ $task->due_date->format('d.m.Y') }}
                    @else
                    -
                    @endisset</td>
                <td style="white-space:nowrap;">
                    <a href="/tasks/{{$task->id}}">Show</a> |
                    <a href="/tasks/{{$task->id}}/edit">Edit</a> |
                    <form method="POST" action="/tasks/{{$task->id}}" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Wirklich löschen?')">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="4">Keine Tasks vorhanden.</td></tr>
        @endforelse
        </tbody>
    </table>

    <div style="margin-top:12px;">
        {{ $tasks->links() }}
    </div>
</x-layout>
