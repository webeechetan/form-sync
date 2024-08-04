@extends('admin.layouts.app')

@section('content')
<div class="row">
    <div class="col-xxl-12 mb-12 order-0">
      <div class="card">
        <div class="card-header">
           <input type="text" class="form-control script-tag" value="<script src='{{ env('APP_URL') }}/js/save-data.js'></script>" name="" id="">
        </div>
        <div class="card-body">
            <p class="card-text">
                Copy the script tag and paste it in your website to track the data.
            </p>
        </div>
      </div>
    </div>
</div>
@endsection

@push('styles')
@endpush

@push('scripts')
    <script>
        $(document).ready(function(){
            $('.script-tag').click(function(){
                $(this).select();
                alert('Copy the selected script');
            });
        });
    </script>
@endpush

