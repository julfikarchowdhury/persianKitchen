@extends('admin.layouts.master')

@section('content')
<?

use App\Models\User; ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-8 grid-margin my-3">
            <div class="card">
                <div class="card-body ">
                    <h3 style="text-align:center; padding-bottom: 20px; text-decoration: underline;"><b>Category Details</b> </h3>
                    @if (session('success_message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong> {{ session('success_message')}}</strong>
                    </div>
                    @endif


                    <div class="mb-3">
                        <label class="mb-1" for="catagory_name">Category Name</label>
                        <div class="border border-dark p-2 rounded">{{$category->value('name')}}</div>
                    </div>
                    <div class="mb-3">
                        <label class="mb-1" for="image_url"> category Image</label>
                        <div class="border border-dark p-2 rounded">
                            <img style="width: 100%;height:300px" src="{{ asset('storage/admin/images/category-images/'.$category->value('image_url'))}}"></img>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="mb-1" for="details">Category Name</label>
                        <div class="border border-dark p-2 rounded">{{$category->value('details')}}</div>
                    </div>
                    <div class="mb-3">
                        <label class="mb-1" for="created_by">Created By</label>
                        <div class="border border-dark p-2 rounded">{{User::find($category->value('created_by'))->get()->value('name'); }}&nbsp;at&nbsp;{{date('h:i A ', strtotime($category->value('created_at')))}}&nbsp;on&nbsp;
                            {{date('d-m-Y', strtotime($category->value('created_at')))}}
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="mb-1" for="updated_by">updated By</label>
                        <div class="border border-dark p-2 rounded">
                            @if ($category->value('updated_at')=="")
                            Not Updated
                            @else
                            {{User::find($category->value('updated_by'))->get()->value('name'); }}&nbsp;at&nbsp;{{date('h:i A ', strtotime($category->value('updated_at')))}}&nbsp;on&nbsp;
                            {{date('d-m-Y', strtotime($category->value('updated_at')))}}
                            @endif
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="mb-1" for="status">Status</label>
                        <div class="border border-dark p-2 rounded">
                            @if (($category['status']->value)=="1")
                            Active
                            @else Inactive
                            @endif
                        </div>
                    </div>
                    <div class="mb-3 text-center">
                        <a href="{{ url('admin/category')}}" <button type="btn" class="btn btn-danger px-2 text-white">Return To All Category</button></a>
                        <a href="{{ url('admin/edit-category')}}" <button type="btn" class="btn btn-info px-5 ms-2 text-white">Edit</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection