@extends('admin.layouts.master')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12 my-3">
            <div class="card">
                <div class="card-body">
                    <u>
                        <h2 style="text-align: center; padding:10px;">All Category</h2>
                    </u>
                    <div>
                        @if (session('success_message'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong> {{ session('success_message')}}</strong>
                        </div>
                        @endif
                    </div>
                    <div class="row justify-content-end me-2"><a style="max-width: 150px;float:right" href="
                {{ url('/admin/add-category') }}" class="btn btn-block btn-primary">Add Category</a></div>
                    <div class="table-responsive pt-3">
                        <table id="example" class="table table-bordered table-hover">

                            <thead>
                                <tr style="text-align: center">
                                    <th style="vertical-align: middle;" class="col-1">
                                        Id
                                    </th>
                                    <th style="vertical-align: middle;" class="col-2">
                                        Category <br>Name
                                    </th>
                                    <th style="vertical-align: middle;" class="col-2">
                                        Category <br>Image
                                    </th>
                                    <th style="vertical-align: middle;" class="col-3">
                                        Category <br>Details
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
                                @if (isset($categories) && count($categories) === 0)
                                <tr>
                                    <td colspan="12" style="text-align: center; color:red;"><strong>SORRY!! </strong>No Categories are available.</b></td>
                                </tr>
                                @elseif(isset($categories))
                                @foreach($categories as $key => $category)
                                <tr style="text-align: center;">
                                    <td style="vertical-align: middle;">
                                        {{ $key+1}}
                                    </td>
                                    <td style="vertical-align: middle;">
                                        {{ $category['name']}}
                                    </td>
                                    <td style="vertical-align: middle;">
                                        <img style="height:100px; width: 150px;text-align: center" src="{{ asset('storage/admin/images/category-images/'.$category['image_url'])}}">
                                    </td>
                                    <td>
                                        <div style="width: 100%; height:130px;overflow-y: scroll;">
                                            {{ $category['details']}}
                                        </div>
                                    </td>

                                    <td style="vertical-align: middle;">
                                        @if ($category['updated_at']=="")
                                        Not Updated
                                        @else
                                        {{date('h:i A ', strtotime($category['updated_at']))}}<br>
                                        {{date('d-m-Y', strtotime($category['updated_at']))}} @endif
                                    </td>
                                    <td style="vertical-align: middle;">
                                        @if( ($category['status']->value)=="1")
                                        <i style="margin:10px;font-size:25px;text-align: center;color:green" class="fas fa-check" title="Edit"></i>

                                        @else
                                        <i style="margin:10px;font-size:25px;text-align: center;color:red" class="fas fa-xmark" title="Edit"></i>

                                        @endif
                                    </td>
                                    <td style="vertical-align: middle;">
                                        <a href="{{ url('admin/show-category-details/'.$category['id']) }}">
                                            <i style="margin:10px;font-size:25px;text-align: center" class="fas fa-eye" title="show detals"></i>
                                        </a>
                                        <a href="{{ url('admin/delete-category/'.$category['id']) }}">
                                            <i style="margin:10px;font-size:25px;text-align: center" class="fas fa-trash-can" title="Delete"></i>
                                        </a>
                                        <a href="{{ url('admin/edit-category/'.$category['id']) }}">
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
</div>


@endsection