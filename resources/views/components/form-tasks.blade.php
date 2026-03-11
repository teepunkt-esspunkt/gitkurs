           <div style="display:grid; gap:12px; max-width:700px; margin: 12px 0;">
            <div>
                <label for="title">Titel *</label><br>
                <input id="title" name="title" type="text" value="{{ old('title', $task->title) }}" style="width:100%;">
                @error('title') <div style="color:#b00;">{{ $message }}</div> @enderror
            </div>

            <div>
                <label for="status">Status *</label><br>
                <select id="status" name="status">
                    <option value="open" @selected(old('status', $task->status ?? 'open') === 'open')>open</option>
                    <option value="done" @selected(old('status', $task->status ?? 'open') === 'done')>done</option>
                </select>
                @error('status') <div style="color:#b00;">{{ $message }}</div> @enderror
            </div>

            <div>
                <label for="due_date">Fällig am</label><br>
                <input id="due_date" name="due_date" type="date"
                    value="{{ old('due_date', $task->due_date?->format('Y-m-d')) }}">
                @error('due_date') <div style="color:#b00;">{{ $message }}</div> @enderror
            </div>
            
            <div>
                <label for="notes">Notizen</label><br>
                <textarea id="notes" name="notes" rows="4" style="width:100%;">{{ old('notes', $task->notes) }}</textarea>
                @error('notes') <div style="color:#b00;">{{ $message }}</div> @enderror
            </div>

           <div>
               <label for="users">Zugewiesene User</label><br>
               <select id="users" name="users[]" multiple style="width:100%" >
                  @foreach($users as $user)
                    <option value="{{$user->id}}" @selected(in_array($user->id,old('users',$task->users->pluck('id')->toArray())))>
                    {{$user->name}} - {{$user->email}}</option>
                  @endforeach
               </select>
           </div> 
        </div>