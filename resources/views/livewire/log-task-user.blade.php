<div>
    {{-- The best athlete wants his opponent at his best. --}}
    <div class="card-body">
        <div class="card-title mb-5">
            <h4 class="text-primary float-start m-0">📚 Activity</h4>
            <button wire:click="openModal" data-toggle="modal" data-target="#modalDaily" class="btn btn-sm btn-outline-primary float-end mb-3">Update</button>
            <table class="table">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Today</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tasks as $task)
                        <tr>
                            <td>{{ $task->user->name }}</td>
                            <td>{{ Str::limit($task->today, 35, '...') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div wire:ignore.self class="modal fade" id="modalDaily" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <form wire:submit.prevent="save">
                                <div class="form-group mb-3">
                                    <label for="today">Today</label>
                                    <input type="text" class="form-control" id="today" wire:model="today">
                                </div>
                                <button type="button" class="btn btn-secondary" wire:click="closeModal">Cancel</button>

                                <button type="submit" class="btn btn-primary">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
