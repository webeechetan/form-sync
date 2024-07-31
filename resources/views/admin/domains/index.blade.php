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
                                                <a href="{{ route('domains.edit', $domain->id) }}" class="btn btn-primary">Edit</a>
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

@endsection