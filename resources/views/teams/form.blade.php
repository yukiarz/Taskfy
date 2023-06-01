<!-- <div class="form-group mt-b {{ $errors->has('user_id') ? 'has-error' : ''}}">
    <label for="user_id" class="control-label">{{ 'User Id' }}</label>
    <input class="form-control" name="user_id" type="number" id="user_id" value="{{ isset($target->user_id) ? $target->user_id : ''}}" >
    {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
</div> -->
<div class="form-group mb-3">
    <label for="name" class="control-label">Name</label>
    <input class="form-control" name="name" type="text" value="{{ isset($team->name) ? $team->name : ''}}" >
</div>
<div class="form-group mb-3">
    <label for="name" class="control-label">Email</label>
    <input class="form-control" name="email" type="text" value="{{ isset($team->email) ? $team->name : ''}}" >
</div>
<div class="form-group mb-3">
    <label for="name" class="control-label">Phone</label>
    <input class="form-control" name="phone" type="text" value="{{ isset($team->phone) ? $team->phone : ''}}" >
</div>
<div class="form-group mb-3">
    <label for="name" class="control-label">Posisition</label>
    <input class="form-control" name="posisition" type="text" value="{{ isset($team->posisition) ? $team->posisition : ''}}" >
</div>
<input name="level" type="hidden" value="{{ isset($team->level) ? $team->level : '1'}}" >


<div class="form-group ">
    <a href="{{ url('/target') }}" title="Back"><button class="btn btn-warning"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
