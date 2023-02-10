@extends('admin.layouts.master')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-8 grid-margin pt-4">
            <div class="card ">
                <div class="card-body ">
                    <h3 style="text-align:center; padding-bottom: 20px; text-decoration: underline;"><b>Edit Category</b> </h3>
                    @if (session('success_message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong> {{ session('success_message')}}</strong>
                    </div>
                    @endif

                    <form class="forms-sample" action="{{ url('admin/add-edit-category/'.$category['id']) }}" method="post" enctype="multipart/form-data">@csrf

                        <div class="form-group mb-3">
                            <label for="category_name">Category Name</label>
                            <input type="text" class="form-control" id="category_name" placeholder="Enter catagory name" name="category_name" value="{{ $category['name'] }}" value="{{ $category->name }}">
                            @if ($errors->has('category_name'))
                            <span class="text-danger">{{ $errors->first('category_name') }}</span>
                            @endif
                        </div>
                        <div class="form-group mb-3">
                            <label for="image">Catagory Image</label>
                            <input class="form-control" type="file" id="image" placeholder="Enter Image" name="image">
                            <label class="mt-3" for="image">Present Catagory Image</label>
                            <div class=" text-center border border-dark rounded p-2">
                                <img style="height:150px; width: 250px;border:1px solid black" src="{{ asset('storage/admin/images/category-images/'.$category['image_url'])}}">
                            </div>
                            @if ($errors->has('image'))
                            <span class="text-danger">{{ $errors->first('image') }}</span>
                            @endif
                        </div>

                        <div class="form-group mb-3">
                            <label for="details">Catagory details</label>
                            <textarea type="text" name="details" id="details" class="form-control" rows="5">{{ $category['details'] }}</textarea>
                            @if ($errors->has('details'))
                            <span class="text-danger">{{ $errors->first('details') }}</span>
                            @endif
                        </div>
                        <div class="form-group mb-3">
                            <label for="status">status</label>
                            <select class="form-select" id="status" aria-label=".form-select multiple" name="status">
                                @if (($category['status']->value)=="1")
                                <option value="Active" selected>Active</option>
                                <option value="Inactive">Inactive</option>
                                @else
                                <option value="Active">Active</option>
                                <option value="Inactive" selected>Inactive</option>
                                @endif

                            </select>
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                            <button type="reset" class="btn btn-danger">Reset</button>

                            <a href="{{ url('admin/category')}}" <button type="btn" class="btn btn-danger px-2 text-white float-end">Return To All Category</button></a>

                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection