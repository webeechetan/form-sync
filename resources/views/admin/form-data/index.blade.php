@extends('admin.layouts.app')
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <h5 class="card-header">Form Datas</h5>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr>
                        @php
                        $allKeys = collect($formDatas)->flatMap(function ($item) {
                        return array_keys(json_decode($item->data, true));
                        })->unique();
                        @endphp

                        @foreach ($allKeys as $key)
                            <th>{{ $key }}</th>
                        @endforeach
                        <th>Form Name</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($formDatas as $formData)
                        <tr>
                            @php
                                $data = json_decode($formData->data, true);
                            @endphp
                            @foreach ($allKeys as $key)
                                @php
                                $value = $data[$key] ?? '';
                                @endphp
                                @if (is_string($value) && preg_match('/\.(jpg|jpeg|png|gif)$/i', $value))
                                    <td><img src="{{ $value }}" alt="Uploaded Image" width="100"></td>
                                @else
                                    <td>{{ is_string($value) ? $value : json_encode($value) }}</td>
                                @endif
                            @endforeach
                            <td>{{ $formData->form_name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection