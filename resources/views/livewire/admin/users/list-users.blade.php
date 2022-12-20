<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">User</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">user list</li>
                </ol>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-end mb-2"><button wire:click.prevent="addNew"
                                    class="btn btn-primary"><i class="fa fa-plus-circle mr-2"></i>Add Users</button>
                            </div>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td><a href="" wire:click.prevent='edit({{ $user->id }})'><i
                                                        class="fa fa-edit mr-2"></i></a> <a href=""
                                                    wire:click.prevent="confirmUserRemoval({{ $user->id }})"><i
                                                        class="fa fa-trash text-danger"></i></a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog" role="document">
                <form autocomplete="off" wire:submit.prevent="{{ $showeditmodal ? 'updateUser' : 'createUsers' }}">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">
                                @if ($showeditmodal)
                                    <span>Edit User</span>
                                @else
                                    <span>Add New User</span>
                                @endif
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="exampleInputPassword1">User Name</label>
                                <input type="text" wire:model.defer='state.name'
                                    class="form-control @error('name')
                                    is-invalid
                                @enderror "
                                    id="name" placeholder="Enter User Name">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="email" wire:model.defer='state.email'
                                    class="form-control @error('email')
                                    is-invalid
                                @enderror"
                                    id="email" aria-describedby="emailHelp" placeholder="Enter email">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" wire:model.defer='state.password'
                                    class="form-control @error('password')
                                    is-invalid
                                @enderror"
                                    id="password" placeholder="Password">
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" wire:model.defer='state.password_confirmation'
                                    class="form-control" id="confirm_password" placeholder="Confirm Password">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                                    class="fa fa-times mr-2"></i> Cancel</button>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-save mr-2"></i>
                                @if ($showeditmodal)
                                    <span>Edit User</span>
                                @else
                                    <span>Save User</span>
                                @endif
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="confirmationmodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        Delete User
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this user?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                                class="fa fa-times mr-2"></i> Cancel</button>
                        <button wire:click.prevent="deleteUser" type="button" class="btn btn-danger"
                            data-dismiss="modal"><i class="fa fa-trash mr-2"></i> Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
