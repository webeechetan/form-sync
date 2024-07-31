@extends('admin.layouts.app')

@section('content')
<h1>
    hello {{  auth()->user()->name}}
</h1>
@endsection