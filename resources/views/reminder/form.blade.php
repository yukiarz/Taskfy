<!-- <div class="form-group {{ $errors->has('user_id') ? 'has-error' : ''}}">
    <label for="user_id" class="control-label">{{ 'User Id' }}</label>
    <input class="form-control" name="user_id" type="number" id="user_id" value="{{ isset($reminder->user_id) ? $reminder->user_id : ''}}" >
    {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
</div> -->
<div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
    <label for="text" class="control-label">{{ 'Text' }}</label>
    <textarea class="form-control" rows="5" name="description" type="textarea" id="description" >{{ isset($reminder->text) ? $reminder->text : ''}}</textarea>
    {!! $errors->first('text', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
