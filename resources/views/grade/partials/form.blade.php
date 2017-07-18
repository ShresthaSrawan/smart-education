<div id="userapp">
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" class="form-control" id="name" placeholder="Name">
    </div>
    <div class="form-group">
        <label for="class_teacher_id">Class Teacher</label>
        <select name="class_teacher_id" class="form-control" id="class_teacher_id">
            @foreach($teachers as $teacher)
                <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
            @endforeach
        </select>
    </div>
</div>