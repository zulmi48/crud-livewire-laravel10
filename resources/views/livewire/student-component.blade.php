<div>
    <div class="container">
        <div class="row py-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h5>All Students Data</h5>
                        <button class="btn btn-outline-info btn-sm" wire:click="create()">New Data</button>
                    </div>
                    <div class="card-body p-3">
                        @if (session()->has('message'))
                            <div class="alert alert-success text-center">{{ session('message') }}</div>
                        @endif
                        <div class="my-2">
                            <table class="table table-stripped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Student ID</th>
                                        <th>Name</th>
                                        {{-- <th>Email</th>
                                        <th>Phone</th> --}}
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($students as $index => $student)
                                        <tr>
                                            <td>{{ $index+1 }}</td>
                                            <td>{{ $student->student_id }}</td>
                                            <td>{{ $student->name }}</td>
                                            {{-- <td>{{ $student->email }}</td>
                                            <td>{{ $student->phone }}</td> --}}
                                            <td class="text-center">
                                                <button class="btn btn-sm btn-outline-secondary" wire:click="show({{ $student->id }})">Show</button>
                                                <button class="btn btn-sm btn-outline-warning" wire:click="edit({{ $student->id }})">Edit</button>
                                                <button class="btn btn-sm btn-outline-danger" wire:click="deleteConirmation({{ $student->id }})">Delete</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

  <!-- Modal New Data -->
  <div wire:ignore.self class="modal fade" id="createStudent" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Student Data</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form wire:submit.prevent="store">
            <div class="mb-3">
                <label for="student-id" class="form-label">Student ID</label>
                <input type="text" class="form-control" id="student-id" wire:model="student_id">
                @error('student_id')
                    <p class="text-danger fs-6">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" wire:model="name">
                @error('name')
                    <p class="text-danger fs-6">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" id="email" wire:model="email">
                @error('email')
                    <p class="text-danger fs-6">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" class="form-control" id="phone" wire:model="phone">
                @error('phone')
                    <p class="text-danger fs-6">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3 d-flex justify-content-center">
                <button type="submit" class="btn btn-sm btn-primary">Add</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Edit Data -->
  <div wire:ignore.self class="modal fade" id="editStudent" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Student Data</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form wire:submit.prevent="update">
            <div class="mb-3">
                <label for="student-id" class="form-label">Student ID</label>
                <input type="text" class="form-control" id="student-id" wire:model="student_id">
                @error('student_id')
                    <p class="text-danger fs-6">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" wire:model="name">
                @error('name')
                    <p class="text-danger fs-6">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" id="email" wire:model="email">
                @error('email')
                    <p class="text-danger fs-6">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" class="form-control" id="phone" wire:model="phone">
                @error('phone')
                    <p class="text-danger fs-6">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3 d-flex justify-content-center">
                <button type="submit" class="btn btn-sm btn-primary">Update</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Delete Data -->
  <div wire:ignore.self class="modal fade" id="deleteStudent" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Confirmation</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row px-4">
                <span class="fs-5">Are you sure? You want to delete this data!</span><br>
                <strong>Student ID : {{ $student_id }}</strong>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-success btn-sm" wire:click="destroy()">Yes, I do!</button>
            <button class="btn btn-danger btn-sm" data-bs-dismiss="modal">No, I think not!</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Show Data -->
  <div wire:ignore.self class="modal fade" id="showStudent" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Student</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row px-4">
                <div class="col-12 mx-auto">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td><strong>Student ID</strong></strong></td>
                                <td>{{ $student_id }}</td>
                            </tr>
                            <tr>
                                <td><strong>Name</strong></strong></td>
                                <td>{{ $name }}</td>
                            </tr>
                            <tr>
                                <td><strong>Email</strong></strong></td>
                                <td>{{ $email }}</td>
                            </tr>
                            <tr>
                                <td><strong>Phone</strong></strong></td>
                                <td>{{ $phone }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>



</div>

@push('script')
    <script>
        window.addEventListener('close-modal', event => {
            $('#createStudent').modal('hide')
            $('#editStudent').modal('hide')
            $('#deleteStudent').modal('hide')
        })

        window.addEventListener('open-create-modal', event => {
            $('#createStudent').modal('show')
        })
        window.addEventListener('open-edit-modal', event => {
            $('#editStudent').modal('show')
        })
        window.addEventListener('open-delete-modal', event => {
            $('#deleteStudent').modal('show')
        })
        window.addEventListener('open-show-modal', event => {
            $('#showStudent').modal('show')
        })
    </script>
@endpush
