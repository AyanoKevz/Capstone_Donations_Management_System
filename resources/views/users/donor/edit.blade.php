<!-- resources/views/testimonials/edit.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Testimonial</div>

                <div class="card-body">
                    <form action="{{ route('testimonials.update', $testimonial->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <textarea 
                                class="form-control" 
                                name="content" 
                                rows="4" 
                                required>{{ old('content', $testimonial->content) }}</textarea>
                            @error('content')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <input 
                                type="number" 
                                class="form-control" 
                                name="rating" 
                                min="1" 
                                max="5" 
                                value="{{ old('rating', $testimonial->rating) }}" 
                                required>
                            @error('rating')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Update Testimonial</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
</x
