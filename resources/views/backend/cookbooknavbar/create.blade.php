@extends('backend.layouts.app')
@push('styles')

@endpush
@section('content')
    <div class="right_col" role="main">
        <h1 class="mt-3">Create NavBar Item <a href="{{ route('cookbooknavbar.index') }}" class="btn btn-primary btn-sm">
                <i class="fa fa-eye" aria-hidden="true"></i> View NavBar Items</a></h1>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card mt-3">
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="{{ route('cookbooknavbar.store') }}" method="POST" class="bg-light p-3"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('POST')
                                        <div class="form-group">
                                            <label for="navbar_item">NavBar Item Title: </label>
                                            <input type="text" name="navbar_item" class="form-control" value="{{ @old('navbar_item') }}"
                                                placeholder="Enter Title">
                                            @error('navbar_item')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="icon">Icon: </label>
                                            <input type="file" name="icon" class="form-control">
                                            @error('icon')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="row mt-4">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="status">Status: </label>
                                                    <input type="radio" name="status" value="1"> Active
                                                    <input type="radio" name="status" value="0"> Inactive
                                                    @error('status')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-success">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

    </div>

@endsection
@push('scripts')

@endpush
