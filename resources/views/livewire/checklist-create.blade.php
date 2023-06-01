<div>
    {{-- Care about people's approval and you will be their prisoner. --}}
    <div>
    {{-- Success is as dangerous as failure. --}}
    <button type="button" class="btn btn-primary float-end" data-toggle="modal" data-target="#addChecklist" wire:click="openChecklistForm">
	Add
    </button>

<!-- Modal -->
    <div wire:ignore.self class="modal fade" id="addChecklist" tabindex="-1" role="dialog" aria-labelledby="addActivityModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addActivityModalLabel">Add Checklist</h5>
                    <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true close-btn">×</span>
                    </button> -->
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="activityTitle">Name</label>
                            <input type="text" class="form-control" id="activityTitle" wire:model="title">
                        </div>
                        <div class="form-group mt-2">
                            <label for="activityDescription">Description</label>
                            <textarea class="form-control" id="activityDescription" wire:model="description"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="closeChecklistForm" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>
                    <button type="button" wire:click.prevent="storeChecklist({{$activity_id}})" class="btn btn-primary close-modal">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
