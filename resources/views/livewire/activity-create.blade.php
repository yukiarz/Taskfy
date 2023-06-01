<div>
    {{-- Success is as dangerous as failure. --}}
    <div class="btn rounded-pill btn-outline-primary float-end btn-sm" style="margin-left:15px;"> {{$complete}} / {{$process}}</div>
    <div class="progress h15 mt-3 mb-3">
        <div class="progress-bar h15 progress-bar-striped progress-bar-animated bg-success" 
        role="progressbar h15" 
        style="width: {{$projectProgress}}%;" 
        aria-valuenow="{{$projectProgress}}" 
        aria-valuemin="0" 
        aria-valuemax="100">{{$projectProgress}}%</div>
    </div>
    <livewire:contributor-component :project_id="$project_id" />
    <button type="button" class="btn btn-primary float-end mt-4" data-toggle="modal" data-target="#addActivity" wire:click="openActivityForm">
	Add Activity
    </button>

<!-- Modal -->
    <div wire:ignore.self class="modal fade" id="addActivity" tabindex="-1" role="dialog" aria-labelledby="addActivityModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addActivityModalLabel">Add Activity</h5>
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
                    <button type="button" wire:click="closeActivityForm" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>
                    <button type="button" wire:click.prevent="storeActivity({{$project_id}})" class="btn btn-primary close-modal">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</div>
