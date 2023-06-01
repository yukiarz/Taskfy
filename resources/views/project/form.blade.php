
<div class="form-group mb-2 {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="control-label">{{ 'Name' }}</label>
    <input class="form-control" name="name" type="text" id="name" value="{{ isset($project->name) ? $project->name : ''}}" >
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group mb-2 {{ $errors->has('description') ? 'has-error' : ''}}">
    <label for="description" class="control-label">{{ 'Description' }}</label>
    <textarea class="form-control" rows="5" name="description" type="textarea" id="description" >{{ isset($project->description) ? $project->description : ''}}</textarea>
    {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group mb-2 {{ $errors->has('start') ? 'has-error' : ''}}">
    <label for="start" class="control-label">{{ 'Start' }}</label>
    <input class="form-control" name="start" type="datetime-local" id="start" value="{{ isset($project->start) ? $project->start : ''}}" >
    {!! $errors->first('start', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group mb-2 {{ $errors->has('deadline') ? 'has-error' : ''}}">
    <label for="deadline" class="control-label">{{ 'Deadline' }}</label>
    <input class="form-control" name="deadline" type="datetime-local" id="deadline" value="{{ isset($project->deadline) ? $project->deadline : ''}}" >
    {!! $errors->first('deadline', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group mb-2 {{ $errors->has('deadline') ? 'has-error' : ''}}">
    <label for="deadline" class="control-label">Contributor</label>
    <select name="user_id[]" id="select-contributor" class="form-control" multiple="multiple">
    @forelse($users as $key => $user)
        <option value="{{$user->id}}">{{$user->name}}</option>
    @empty
        <option value="">{{ $formMode === 'edit' ? 'semua user sudah ditambahkan' : 'tambahkan user terlebih daulu' }}</option>
    @endforelse
</select>
</div>



<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
