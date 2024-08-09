@extends('admin.layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-4 col-sm-6">
        <div class="card card-border-shadow-primary h-100">
          <div class="card-body">
            <div class="d-flex align-items-center mb-2">
              <div class="avatar me-4">
                <span class="avatar-initial rounded bg-label-primary"><i class="bx bx-chat bx-lg"></i></span>
              </div>
              <h4 class="mb-0">{{ auth()->user()->formDatas()->count() }} Enquiries</h4>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-sm-6">
        <div class="card card-border-shadow-primary h-100">
          <div class="card-body">
            <div class="d-flex align-items-center mb-2">
              <div class="avatar me-4">
                <span class="avatar-initial rounded bg-label-primary"><i class="bx bx-code bx-lg"></i></span>
              </div>
              <h4 class="mb-0">{{ auth()->user()->domains()->count() }} Domains</h4>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-sm-6">
        <div class="card card-border-shadow-primary h-100">
          <div class="card-body">
            <div class="d-flex align-items-center mb-2">
              <div class="avatar me-4">
                <span class="avatar-initial rounded bg-label-primary"><i class="bx bx-desktop bx-lg"></i></span>
              </div>
              @php
                $forms = 0;
                $formDatas = auth()->user()->formDatas;
                // group by form_name and count
                $forms = $formDatas->groupBy('form_name')->count();

              @endphp
              <h4 class="mb-0">{{ $forms }} Froms</h4>
            </div>
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
            
        });
    </script>
@endpush







