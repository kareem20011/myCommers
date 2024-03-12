@extends('admin.layouts.side')
@section('admin.content')


<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary rounded p-4">
        <h6 class="mb-4">Edit Sub Categories</h6>
        <form method="post" action="{{ route('subCategories.update', $subCat->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="mb-3">
                <label for="title" class="form-label">title</label>
                <input value="{{ $subCat->title }}" name="title" type="text" class="form-control" id="title" aria-describedby="emailHelp">
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label">Upload Image</label>
                <input name="image" class="form-control bg-dark" type="file" id="formFile">
                @error('image')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <h6 class="mb-4">Select</h6>
            <select class="form-select form-select-sm mb-3" aria-label=".form-select-sm example" name="main_category_id">
                @foreach($mainCats as $mainCat)
                @if($mainCat->id === $subCat->mainCategory->id )
                    <option value="{{ $mainCat->id }}" selected>{{ $mainCat->title }}</option>
                @endif
                <option value="{{ $mainCat->id }}">{{ $mainCat->title }}</option>
                @endforeach
            </select>
            @error('main_category_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror

            <fieldset class="row mb-3">
                <legend class="col-form-label col-sm-2 pt-0">status</legend>
                <div class="col-sm-10">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="gridRadios2" value="1" {{ $subCat->status === '1'? 'checked' : '' }}>
                        <label class="form-check-label" for="gridRadios2">
                            Active
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="gridRadios1" value="0" {{ $subCat->status === '0'? 'checked' : '' }}>
                        <label class="form-check-label" for="gridRadios1">
                            Disable
                        </label>
                    </div>
                </div>
            </fieldset>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>





@endsection
