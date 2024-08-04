@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
       
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Users</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-responsive-sm">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->created_at->format('d-m-Y') }}</td>
                                            <td>
                                                <a href="" class="btn btn-primary">Edit</a>
                                                <form action="{{ route('user.destroy', $user )}}" method="POST" style="display: inline-block">
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