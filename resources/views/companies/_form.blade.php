@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>{{ $title }}</h3>
        </div>
        <div class="card-body">
            <form action="{{ $action }}" method="POST">
                @csrf
                @if($method ?? false)
                    @method($method)
                @endif

                @foreach($fields as $field)
                    <div class="mb-3">
                        <label class="form-label">{{ $field['label'] }}</label>
                        <input type="{{ $field['type'] }}"
                               name="{{ $field['name'] }}"
                               class="form-control @error($field['name']) is-invalid @enderror"
                               value="{{ old($field['name'], $model->{$field['name']} ?? '') }}">
                        @error($field['name'])
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                @endforeach

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
