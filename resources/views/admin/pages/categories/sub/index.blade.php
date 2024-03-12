@extends('admin.layouts.side')
@section('admin.content')


<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary rounded p-4">
        <h6 class="mb-4">Sub Categories</h6>
        <form method="post" action="{{ route('subCategories.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">title</label>
                <input name="title" value="{{ old('title') }}" placeholder="Enter Title" type="text" class="form-control" id="title" aria-describedby="emailHelp">
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
            <select name="main_category_id" class="form-select form-select-sm mb-3" aria-label=".form-select-sm example">
                <option disabled selected>Open this select menu</option>
                @foreach($mainCats as $mainCat)
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
                        <input class="form-check-input" type="radio" name="status" id="gridRadios2" value="1" checked>
                        <label class="form-check-lael" for="gridRadios2">
                            Active
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="gridRadios1" value="0">
                        <label class="form-check-label" for="gridRadios1">
                            Disable
                        </label>
                    </div>
                </div>
            </fieldset>

            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
</div>





<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary rounded h-100 p-4">
        <h6 class="mb-4">Users Data</h6>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">title</th>
                        <th scope="col">image</th>
                        <th scope="col">main category</th>
                        <th scope="col">status</th>
                        <th scope="col">actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($subCats as $subCat)
                    <tr>
                        <td>{{ $subCat->title }}</td>
                        <td>
                        @if(count($subCat->getMedia('images')) > 0)
                        <img src="{{ $subCat->getFirstMedia('images')->getUrl() }}" alt="..." width="50">
                        @endif
                        </td>
                        <td>{{ $subCat->mainCategory->title }}</td>
                        <td>{{ $subCat->status === '1' ? 'active' : 'disabled' }}</td>
                        <td>
                            <a href="{{ route( 'subCategories.edit', $subCat->id ) }}" class="btn btn-outline-info m-2"><i class="fas fa-edit"></i></a>
                            <form class="d-inline-block" action="{{ route( 'subCategories.destroy', $subCat->id ) }}" method="post">
                            @method('delete')
                            @csrf
                            <button type="submit" class="btn btn-outline-danger m-2"><i class="fas fa-user-times"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>





@endsection
