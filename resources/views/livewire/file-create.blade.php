<div>
    {{-- Success is as dangerous as failure. --}}
    <div class="row">
    <div class="col-md-12">
        <form method="post" enctype='multipart/form-data'>
            <label for="">Name</label>
            <input type="text" wire:model="name" class="form-control mb-3">
            <label for="">File</label>
            <input type="file" wire:model="attc" class="form-control mb-3">
            <button wire:click.prevent="uploadAttc({{$aid}})" class="btn btn-success" type="submit">Submit</button>
        </form>
    </div>
    <div class="col-md-12">
    @forelse($attcs as $attc)
        <div class="col-12 mt-3">
        <span class="circle-icon icon-big icon-danger float-start" wire:click="download({{$attc->id}})">
            <i class='bx bxs-download'></i>
        </span>
        <ul class="activity-ul ml-2">
            <li class="activity-li">
                <span class="circle-icon icon-primary bg-none"><i class='bx bx-user'></i></span>
                
                By {{$attc->user->name}}
            </li>
            <li class="activity-li">
            <span class="circle-icon icon-success bg-none"><i class='bx bx-calendar'></i></span>
                
            {{date('d F Y H:i', strtotime($attc->created_at))}}
            </li>
        </ul>
        <p class="ml-2">{{$attc->file}}</p>
        <p class="ml-2">{{$attc->note}}</p>
        <!-- <img src="{{asset('storage/app/public/attc/'.$attc->file)}}" alt="" style="width:50px;height:50px"> -->
        </div>

        
    @empty
        Belum ada file
    @endforelse
    </div>
    

    </div>
</div>
