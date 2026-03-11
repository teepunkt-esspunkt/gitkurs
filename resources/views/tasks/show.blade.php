<x-layout :title="$task->title">{{-- Übergabe eines Variablenwertes --}}
    <h1>{{ $task->title }}</h1>

    <p><strong>Status:</strong> {{ $task->status }}</p>
    <p><strong>Fällig:</strong> 
    @isset($task->due_date)
    {{ $task->due_date->format('d.m.Y') }}
    @else
    -
    @endisset</p>
    <div class="">
        @foreach ($task->users as $user )
        <ul>    
        <li><span>{{ $user->name}}</span> (<a href="mailto:{{$user->email}}">{{$user->email}}</a>)</li>
        </ul>
        @endforeach
    </div>
    <p><strong>Notizen:</strong><br>{{ $task->notes ?? '—' }}</p>{{-- Null coalescing Operator --}}

    <p>
        <a href="/tasks">Zur Liste</a> |
        <a href="/tasks/{{ $task->id }}/edit">Bearbeiten</a>
    </p>
</x-layout>
