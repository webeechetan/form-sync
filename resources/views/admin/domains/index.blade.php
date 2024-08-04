@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl">
                <div class="card mb-6">
                  <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Add domain here</h5> <small class="text-body float-end"></small>
                  </div>
                  <div class="card-body">
                    <form action="{{ route('domains.store') }}" method="POST">
                        @csrf
                      <div class="mb-6">
                        <label class="form-label" for="basic-default-fullname">Domain Name</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="example.com">
                        @error('name')
                            <x-error-component :message="$message" />
                        @enderror
                      </div>
                      
                      <button type="submit" class="btn btn-primary btn-sm mt-2">Add Domain</button>
                    </form>
                  </div>
                </div>
              </div>
        </div>
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Domains</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-responsive-sm">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Domain</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($domains as $domain)
                                        <tr>
                                            <td>{{ $domain->id }}</td>
                                            <td>{{ $domain->name }}</td>
                                            <td>{{ $domain->created_at->format('d-m-Y') }}</td>
                                            <td>
                                                
                                            
                                                {{-- <a class="btn btn-primary edit_domain" href="#" data-bs-toggle="modal" data-bs-target="#edit_domain_modal" data-id="{{ $domain->id }}" data-name="{{ $domain->name }}">Edit</a> --}}
                                                <a class="btn btn-primary edit_domain" href="#" data-bs-toggle="modal" data-bs-target="#edit_domain_modal" data-id="{{ $domain->id }}" data-name="{{ $domain->name }}">Edit</a>
                                                <form action="{{ route('domains.destroy', $domain->id) }}" method="POST" style="display: inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
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


    {{-- <div class="modal fade" id="edit_domain_modal" tabindex="-1" aria-modal="true" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel2">Domain</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST" id="domain_modal_form">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col mb-3">
                                <input id="domain_id" name="domain_name" class="form-control" placeholder="Type Here...">
                            </div>
                            <input type="hidden" id="id" name="id">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Domain</button>
                    </div>
                </form>
            </div>
        </div>
    </div> --}}

    <div class="modal fade" id="edit_domain_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Domain</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST" id="edit_domain_modal_form">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col mb-3">
                                <input id="domain_name" name="domain_name" class="form-control" placeholder="Type Here...">
                            </div>
                            <input type="hidden" id="id" name="id">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary save_btn">Save Domain</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
<script>
$(document).ready(function() {

    //Here I am setting the values in the modal
    $(".edit_domain").click(function(e){
        e.preventDefault();

        let id = $(this).data("id");
        let name = $(this).data("name");

        $('#id').val(id);
        $('#domain_name').val(name);
    });


    //Here I am updating the value in database using update method
    $('#edit_domain_modal_form').on('submit', function(e) {
        e.preventDefault();

        $('.save_btn').prop('disabled', true);
        let id = $('#id').val();
        let name = $('#domain_name').val();
        let _token = $('input[name=_token]').val();

        $.ajax({
            url: "{{ route('domains.update') }}",
            type: "POST",
            data: {
                id: id,
                name: name,
                _token: _token
            },
            success: function(response) {
                if (response.success) {
                    location.reload();
                    $('#edit_domain_modal_form')[0].reset();
                    $('#edit_domain_modal').modal('hide');
                    toast('Success', 'User Updated Successfully', 'success');
                    $('.update_btn').prop('disabled', false);
                }
            },
            error: function(response) {
                $('.update_btn').prop('disabled', false);
                toast('Error', 'Something Went Wrong', 'error');
            }
        });
    });


});
</script>
@endpush
 
