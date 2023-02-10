@extends('admin.layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-8 grid-margin pt-4">
            <div class="card mb-3">
                <div class="card-body ">
                    <h2 class="text-center">Edit Recipe</h2>
                    <!-- resources/views/recipes/edit.blade.php -->

                    <form action="{{ url('admin/edit-recipe/'.$recipe['id']) }}" method="post" enctype="multipart/form-data">@csrf
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-select" id="status" aria-label=".form-select multiple" name="status">
                                @if (($recipe['status'])=="1")
                                <option value="1" selected>Published</option>
                                <option value="0">Unpublished</option>
                                @else
                                <option value="1">Published</option>
                                <option value="0" selected>Unpublished</option>
                                @endif

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" class="form-control" value="{{ $recipe->title }}">
                        </div>

                        <div class="form-group">
                            <label for="details">Details</label>
                            <textarea name="details" id="details" class="form-control">{{ $recipe->details }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="serving">Serving</label>
                            <input type="number" name="serving" id="serving" class="form-control" value="{{ $recipe->serving }}">
                        </div>

                        <div class="form-group">
                            <label for="set_time">Set Time</label>
                            <input type="number" name="set_time" id="set_time" class="form-control" value="{{ $recipe->set_time }}">
                        </div>

                        <div class="form-group">
                            <label for="tags">Tags</label>
                            <input name="tags" id="tags" class="form-control" value="{{ $recipe->tags }}">

                        </div>

                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" name="image" id="image" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="video">Video</label>
                            <input type="file" name="video" id="video" class="form-control">
                        </div>
                        <div class="row">
                            <div class="col-6 col-sm-12">
                                <ul class="nav nav-tabs " role="tablist">
                                    <li class="nav-item ">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#ingredients">Ingredients</a>
                                    </li>
                                    <li class="nav-item ">
                                        <a class="nav-link" data-bs-toggle="tab" href="#directions">Directions</a>
                                    </li>
                                    <li class="nav-item ">
                                        <a class="nav-link" data-bs-toggle="tab" href="#shoppings">Shoppings</a>
                                    </li>


                                </ul>
                            </div>
                            <!-- Tab panes -->
                            <div class="col-6 col-sm-12">
                                <div class="tab-content pb-1 mb-2 " style="background-color:#e6ffff;">
                                    <div id="ingredients" class="container tab-pane active"><br>
                                        <label for="ingredients">Ingredients</label>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Title</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($recipe->ingredients as $ingredient)
                                                <tr>
                                                    <td><input type="text" name="ingredients[{{ $loop->index }}][title]" value="{{ $ingredient->title }}"></td>
                                                    <td><a href="#" class="btn btn-danger btn-sm delete-ingredient">Delete</a></td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div id="directions" class="container tab-pane fade"><br>
                                        <label for="direction">Directions</label>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Title</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($recipe->directions as $direction)
                                                <tr>
                                                    <td><input type="text" name="directions[{{ $loop->index }}][title]" value="{{ $direction->title }}"></td>
                                                    <td><a href="#" class="btn btn-danger btn-sm delete-ingredient">Delete</a></td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div id="shoppings" class="container tab-pane fade "><br>
                                        <label for="shoppings">Shoppings</label>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Title</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($recipe->ingredients as $key=> $ingredient)
                                                @foreach ($ingredient->shoppings as $shopping)
                                                <tr>
                                                    <td><input type="text" name="shoppings[{{ $key }}][note]" value="{{ $shopping->note }}"></td>
                                                    <td><a href="#" class="btn btn-danger btn-sm delete-ingredient">Delete</a></td>
                                                </tr>
                                                @endforeach
                                                @endforeach
                                            </tbody>
                                        </table>

                                    </div>



                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection