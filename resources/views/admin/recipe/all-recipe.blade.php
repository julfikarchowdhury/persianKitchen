@extends('admin.layouts.master')

@section('content')



<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12 my-3">
            <div class="card">
                <div class="card-body">
                    <u>
                        <h2 style="text-align: center; padding:10px;">All Recipe</h2>
                    </u>
                    <div>
                        @if (session('success_message'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong> {{ session('success_message')}}</strong>
                        </div>
                        @endif
                    </div>
                    

                    <table class="table table-bordered mt-3 yajra-datatable">
                        <thead>
                            <tr style="text-align: center">
                                <th style="vertical-align: middle;" class="col-1">
                                    Id
                                </th>
                                <th style="vertical-align: middle;" class="col-2">
                                    category <br>Title
                                </th>
                                <th style="vertical-align: middle;" class="col-2">
                                    Recipe <br>title
                                </th>
                                <th style="vertical-align: middle;" class="col-3">
                                    Recipe <br>Details
                                </th>

                                <th style="vertical-align: middle;" class="col-1">
                                    created by
                                </th>
                                <th style="vertical-align: middle;" class="col-1">
                                    Status
                                </th>
                                <th style="vertical-align: middle;" class="col-2">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12 my-3">
            <div class="card">
                <div class="card-body">
                    <u>
                        <h2 style="text-align: center; padding:10px;">All Recipe</h2>
                    </u>
                    <div>
                        @if (session('success_message'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong> {{ session('success_message')}}</strong>
                        </div>
                        @endif
                    </div>
                    <div class="row justify-content-end me-2"><a style="max-width: 150px;float:right" href="
                    {{ url('/admin/add-recipe') }}" class="btn btn-block btn-primary">Add Recipe</a></div>
                    <div class="table-responsive pt-3">
                        <table id="empTable" class="table table-bordered table-hover">

                            <thead>
                                <tr style="text-align: center">
                                    <th style="vertical-align: middle;" class="col-1">
                                        Id
                                    </th>
                                    <th style="vertical-align: middle;" class="col-2">
                                        Recipe <br>Title
                                    </th>
                                    <th style="vertical-align: middle;" class="col-2">
                                        Recipe <br>Image
                                    </th>
                                    <th style="vertical-align: middle;" class="col-3">
                                        Recipe <br>Details
                                    </th>

                                    <th style="vertical-align: middle;" class="col-2">
                                        Updated at
                                    </th>
                                    <th style="vertical-align: middle;" class="col-1">
                                        Status
                                    </th>
                                    <th style="vertical-align: middle;" class="col-1">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($recipes) && count($recipes) === 0)
                                <tr>
                                    <td colspan="12" style="text-align: center; color:red;"><strong>SORRY!! </strong>No Categories are available.</b></td>
                                </tr>
                                @elseif(isset($recipes))
                                @foreach($recipes as $key => $recipe)
                                <tr style="text-align: center;">
                                    <td style="vertical-align: middle;">
                                        {{ $key+1}}
                                    </td>
                                    <td style="vertical-align: middle;">
                                        {{ $recipe['title']}}
                                    </td>
                                    <td style="vertical-align: middle;">
                                        <img style="height:100px; width: 150px;text-align: center" src="{{ asset('storage/admin/images/category-images/'.$recipe['image'])}}">
                                    </td>
                                    <td>
                                        <div style="width: 100%; height:130px;overflow-y: scroll;">
                                            {{ $recipe['details']}}
                                        </div>
                                    </td>

                                    <td style="vertical-align: middle;">
                                        @if ($recipe['updated_at']=="")
                                        Not Updated
                                        @else
                                        {{date('h:i A ', strtotime($recipe['updated_at']))}}<br>
                                        {{date('d-m-Y', strtotime($recipe['updated_at']))}} @endif
                                    </td>
                                    <td style="vertical-align: middle;">
                                        @if( ($recipe['status'])=="1")
                                        <i style="margin:10px;font-size:25px;text-align: center;color:green" class="fas fa-check" title="Edit"></i>

                                        @else
                                        <i style="margin:10px;font-size:25px;text-align: center;color:red" class="fas fa-xmark" title="Edit"></i>

                                        @endif
                                    </td>
                                    <td style="vertical-align: middle;">
                                        <a href="{{ url('admin/show-recipe/'.$recipe['id']) }}">
                                            <i style="margin:10px;font-size:25px;text-align: center" class="fas fa-eye" title="show detals"></i>
                                        </a>
                                        <a href="{{ url('admin/delete-category/'.$recipe['id']) }}">
                                            <i style="margin:10px;font-size:25px;text-align: center" class="fas fa-trash-can" title="Delete"></i>
                                        </a>
                                        <a href="{{ url('admin/edit-recipe/'.$recipe['id']) }}">
                                            <i style="margin:10px;font-size:25px;text-align: center" class="fas fa-pen" title="Edit"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                                @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->