<div class="form-group">
    <label for="name">Name (required)</label>
    <input id="name" type="text" name="name" class="form-control">
</div>
<div class="form-group">
    <label for="teacher_id">Teacher (required)</label>
    <select id="teacher_id" name="teacher_id" class="form-control">
        @foreach($teachers as $id => $teacher)
            <option value="{{ $id }}">{{ $teacher }}</option>
        @endforeach
    </select>
</div>