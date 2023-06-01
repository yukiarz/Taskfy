<div>
    {{-- The best athlete wants his opponent at his best. --}}


    <div class="nav-align-top mb-4">
      <ul class="nav nav-pills mb-3 nav-fill" role="tablist">
        <li class="nav-item">
          <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#checklist" aria-controls="navs-pills-justified-profile" aria-selected="false">
          <i class='bx bx-check-double'></i>Task
        </button>
        </li>
        <li class="nav-item">
          <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#file" aria-controls="navs-pills-justified-messages" aria-selected="false">
          <i class='bx bx-file' ></i> Attachment
        </button>
        </li>
      </ul>

      <div class="tab-content">
        <div class="tab-pane fade active show" id="checklist" role="tabpanel">

            @forelse($checks as $check)
            <div class="col-12">
                <div class="body">
                    <div class="card-body">
                        <div class="checklist">
                            <input 
                            @if($check->status == 1)
                            checked
                            @endif
                            wire:click.prevent="checklistUpdate({{$check->id}})" 
                            name="checkList" 
                            type="checkbox" 
                            value="{{$check->id}}" 
                            id="id-{{$check->id}}"
                            />

                            <label id="id-{{$check->id}}">{{$check->name}}</label>
                        </div>
                        
                        <p class="ml-3">
                            {{$check->description}}
                            <br>{{$check->createdBy->name}}
                        </p>
                    </div>
                </div>
            </div>
            @empty
            belum ada data lohhh
            
            @endforelse
        </div>
        <div class="tab-pane fade" id="file" role="tabpanel">
          <livewire:file-create :aid="$aid" />
        </div>
      </div>
    </div>

    <div class="row">
   
    </div>
</div>
