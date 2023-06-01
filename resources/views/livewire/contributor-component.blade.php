<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
        <div class="float-start">
                <h5>Contributor : </h5>
            <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center mb-2">

                @forelse($contributors as $contributor)
                <li
                    data-bs-toggle="tooltip"
                    data-popup="tooltip-custom"
                    data-bs-placement="top"
                    class="avatar avatar-md pull-up"
                    title="{{$contributor->user->name}}"
                >
                    @if(!$contributor->user->profile)
                    <img src="{{asset('launch/img/avatar/cat.png')}}" alt="Avatar" class="rounded-circle" />

                    @else

                    @endif
                </li>
                @empty


                @endforelse


                <li>
               
                </li>
                </ul>  
               <span class="cursor-pointer" wire:click="sidePanelContributor({{ $project_id }})">More</span>
            </div>
            @if($showContributorPanel)
            <div class="pull" id="contributor-panel">
                <div class="pull__content">
                    <button wire:click="$set('showContributorPanel',false)" class="btn rounded-pill btn-icon btn-danger l float-start">
                        <i class='bx bx-plus' style="transform: rotate(45deg);"></i>
                    </button>
                    <h3>Contributor</h3>

                    <form>
                        <div class="input-group">
                            <select wire:model="cid" class="form-control" >
                                <option value="1" selected>Add Contributor</option>
                                @forelse($addContributors as $key => $addContributor)
                                    <option value="{{$addContributor->id}}">{{$addContributor->name}}</option>
                                @empty
                                    <option value="">Semua user sudah di tambahkan</option>
                                @endforelse
                            </select>
                            <button type="button" class="btn btn-primary" wire:click.prevent="storeContributor({{$project_id}})">Add</button>
                        </div>
                    </form>
                @forelse($contributors as $contributor)
                <div class="col-12 mt-2" style="display:flow-root">
                {{$contributor->user->name}}
                        @if(!$contributor->user->profile)
                            <img src="{{asset('launch/img/avatar/cat.png')}}" alt="Avatar" class="rounded-circle float-start profile-50" />
                        @else

                        @endif
                </div>
                   
                @empty

                @endforelse
                </div>
            </div>

            @endif

@push('select2')
<script>
$(document).ready(function() {
    $('#select-contributor').select2();
        window.livewire.on('loadSelect2', () => {
        $('#select-contributor').select2({
            dropdownParent: $('#contributor-panel'),
        });
    });
});
    // Livewire.on('storeContributor', contributors_id => {
    //     @this.storeContributor(contributors_id);
    // });

// $(document).ready(function() {
//     window.initSelectContributor=()=>{
//         $('#select-contributor').select2({
//             placeholder: 'Contributor',
//             allowClear: true});
//     }
//     initSelectContributor();
//     $('#select-contributor').on('change', function (e) {
//         livewire.emit('selectedContributor', e.target.value)
//     });
//     window.livewire.on('select2',()=>{
//         initSelectContributor();
//     });

// });
</script>

@endpush

</div>
