<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
    <div class="grid">
    <!-- <div class="col-md-4 col-sm-6 col-lg-3 mt-2">
        <form wire:submit.prevent="storeActivity">
            <label for="" class="mt-3">Title</label>
            <input type="text" class="form-control" wire:model="activityTitle">
            <label for="" class="mt-3">Description</label>
            <textarea rows="10" class="form-control" wire:model="activityDescription"></textarea>
            <button type="submit" class="btn btn-success mt-3">Add Activity</button>
        </form>
    </div> -->




    @foreach($activities as $activity)
    @php
    $checks = App\Models\Checklist::where('activity_id',$activity->id)->get();
        if($checks->count() == 0){
            $activityProgressList = 0;
        }else{ 
            $countTrue = App\Models\Checklist::where('activity_id',$activity->id)->where('status',1)->count();
            $countAll = App\Models\Checklist::where('activity_id',$activity->id)->count();
            $activityProgressList = round(($countTrue * 100) / $countAll);
        }
    @endphp
    <div class="grid-item">
        <div class="card">
            <div class="card-body">
                <b class="activity-title" wire:click="checklist({{$activity->id}})">{{$activity->name}}</b>
                <span class="dropdown-toggle hide-arrow extra-menu float-end" data-bs-toggle="dropdown" aria-expanded="false">
                          <i class="bx bx-dots-vertical-rounded"></i>
                          </span>
                  
                          <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                            <button class="dropdown-item" data-toggle="modal" data-target="#editActivity" wire:click="openActivityFormEdit({{$activity->id}})">Edit</button>
                            <button wire:click="deleteActivity({{ $activity->id }})" class="dropdown-item" data-toggle="modal" data-target="#deleteActivity">Delete</button>
                            <!-- <form method="POST" action="{{ url('activity' . '/' . $activity->id) }}" accept-charset="UTF-8" style="display:inline">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <button type="submit" class="dropdown-item" title="Delete Project" onclick="return confirm(&quot;Confirm delete?&quot;)">Delete</button>
                            </form> -->
                            </li>
                           
                          </ul>
                <div class="activity-progress">
                <div 
                    class="text-center mb-4 mt-4"
                    role="progress-radius" 
                    aria-valuenow="{{$activityProgressList}}" 
                    aria-valuemin="0" 
                    aria-valuemax="100" 
                    style="--value:{{$activityProgressList}}">
                </div>
                </div>
                <div>
                  
                    <ul class="activity-ul">
                        <li class="activity-li">
                            <span class="circle-icon icon-primary">
                                <i class='bx bx-user'></i>
                            </span>
                            {{$activity->user->name}}
                        </li>
                        <li class="activity-li">
                            <span class="circle-icon icon-success">
                                <i class='bx bx-check-double'></i>
                            </span>
                            {{$activity->checklist->count()}} Task
                        </li>
                        <li class="activity-li">
                            <span class="circle-icon icon-danger">
                                <i class='bx bx-file'></i>
                            </span>
                            {{$activity->attc->count()}} Files
                        </li>
                    </ul>
                </div>
                <p class="activity-description">{{$activity->description}}</p>
                
            </div>
        </div>
    </div>
    @endforeach
    </div>

    
    @if($show)
   
    <div class="pull" wire:transition.fade>
        <div class="pull__content">
            <button wire:click="$set('show',false)" class="btn rounded-pill btn-icon btn-danger l float-start">
                <i class='bx bx-plus' style="transform: rotate(45deg);"></i>
            </button>

            <livewire:checklist-create :activity_id="$act->id" />

            <div class="row mt-5 pt-3">
                <div class="col-md-12">
                    <h3>{{$act->name}}</h3>
                    <p>{{$act->description}}</p>
                </div>
            </div>
            <div class="progress h15 mt-3 mb-3">
                <div class="progress-bar h15 progress-bar-striped progress-bar-animated bg-success" 
                role="progressbar h15" 
                style="width: {{$activityProgress}}%;" 
                aria-valuenow="{{$activityProgress}}" 
                aria-valuemin="0" 
                aria-valuemax="100">
                {{$activityProgress}}%</div>
            </div>
            <livewire:checklist-component :activity_id="$act->id" />
         </div>
        <!-- <div class="pull__trigger">hover me!</div> -->
    </div>
    @endif
    
    @if($display)
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
                            <input type="text" class="form-control" id="activityTitle" wire:model="name">
                        </div>
                        <div class="form-group mt-2">
                            <label for="activityDescription">Description</label>
                            <textarea class="form-control" id="activityDescription" wire:model="description" ></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="closeActivityFormEdit" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>
                    <button type="button" wire:click.prevent="updateActivity({{$data->id}})" class="btn btn-primary close-modal">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    @endif
    
    @if($opacity)
    <div wire:ignore.self class="modal fade" id="deleteActivity" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Confirm</h5>
                </div>
                <div class="modal-body">
                    <p>Are you sure want to delete?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="closeDeleteActivity" class="btn btn-secondary close-btn" data-dismiss="modal">Cancel</button>
                    <button type="button" wire:click.prevent="delete({{$did}})" class="btn btn-danger close-modal" data-dismiss="modal">Yes, Delete</button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
