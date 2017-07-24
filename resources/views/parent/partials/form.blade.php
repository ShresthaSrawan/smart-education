<div id="userapp">
    <div class="form-group">
        <label for="title">Title</label>
        {{ Form::select('title', $titles ,old('title'), ['class' => 'form-control']) }}
    </div>
    <div class="form-group">
        <label for="first_name">First Name</label>
        {{ Form::text('first_name', old('first_name'), ['class' => 'form-control', 'placeholder' => 'First Name'] ) }}
    </div>
    <div class="form-group">
        <label for="last_name">Last Name</label>
        {{ Form::text('last_name', old('last_name'), ['class' => 'form-control', 'placeholder' => 'Last Name'] ) }}
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        {{ Form::text('email', old('email'), ['class' => 'form-control', 'placeholder' => 'Email'] ) }}
    </div>
    <div class="form-group">
        <label for="username">Username</label>
        {{ Form::text('username', old('username'), ['class' => 'form-control', 'placeholder' => 'Username'] ) }}
    </div>
    <div class="form-group">
        <div class="col-sm-6">
            <label for="password">Password</label>
            {{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']) }}
        </div>
        <div class="col-sm-6">
            <label for="password_confirmation">Confirm Password</label>
            {{ Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Confirm Password']) }}
        </div>
    </div>
    <div class="form-group">
        <label for="title">Children</label>
        {{ Form::select('children', $students ,old('children'), ['class' => 'form-control', 'multiple']) }}
    </div>
</div>