<div>
    {{-- Be like water. --}}

    
    <div wire:ignore.self class="modal fade" id="editActivity" tabindex="-1" role="dialog" aria-labelledby="editActivityModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editActivityModalLabel">Edit Activity</h5>
                    <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true close-btn">×</span>
                    </button> -->
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="activityTitle">Name</label>
                            <input type="text" class="form-control" id="activityTitle" wire:model="title" value="{{$data->name}}">
                        </div>
                        <div class="form-group mt-2">
                            <label for="activityDescription">Description</label>
                            <textarea class="form-control" id="activityDescription" wire:model="description" value="{{$data->description}}"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="closeActivityFormEdit" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>
                    <button type="button" wire:click.prevent="updatedActivity({{$data->id}})" class="btn btn-primary close-modal">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</div>
