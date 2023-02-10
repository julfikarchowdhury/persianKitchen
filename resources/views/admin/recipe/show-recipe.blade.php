@extends('admin.layouts.master')

@section('content')
<?

use App\Models\User; ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-9 my-3">
            <div class="card">
                <div class="card-body">
                    <div class="container mt-3">
                        <u>
                            <h2 style="text-align: center; padding:10px;">{{ $recipe['title']}}</h2>
                        </u>

                        <div class="mb-3">
                            <h5 for="created_by">Recipe Image</h5>
                            <div class="border border-dark my-2 ">
                                <img style="width: 100%;height:250px" src="{{ asset('storage/admin/images/category-images/'.$recipe['image'])}}"></img>
                            </div>
                        </div>
                        <div class="mb-3">
                            <h5 for="created_by">recipe Video</h5>
                            <div>
                                <video class="border border-dark" width="100%" height="250" controls>
                                    <source src="{{ asset('storage/admin/images/category-images/'.$recipe['video'])}}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                        </div>
                        <!-- Nav tabs -->
                        <div class="row">
                            <div class="col-6 col-sm-12">
                                <ul class="nav nav-tabs " role="tablist">
                                    <li class="nav-item ">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#recipe_details">Details</a>
                                    </li>
                                    <li class="nav-item ">
                                        <a class="nav-link" data-bs-toggle="tab" href="#ingredients">Ingredients</a>
                                    </li>
                                    <li class="nav-item ">
                                        <a class="nav-link" data-bs-toggle="tab" href="#directions">Directions</a>
                                    </li>
                                    <li class="nav-item ">
                                        <a class="nav-link" data-bs-toggle="tab" href="#shoppings">Shoppings</a>
                                    </li>
                                    <li class="nav-item ">
                                        <a class="nav-link" data-bs-toggle="tab" href="#feedback">Feedbacks</a>
                                    </li>
                                    <li class="nav-item ">
                                        <a class="nav-link" data-bs-toggle="tab" href="#tags">Tags</a>
                                    </li>

                                </ul>
                            </div>
                            <!-- Tab panes -->
                            <div class="col-6 col-sm-12">
                                <div class="tab-content pb-1 mb-2 " style="background-color:#e6ffff;">
                                    <div id="recipe_details" class="container tab-pane active"><br>
                                        <p>{{$recipe['details']}}</p>
                                    </div>
                                    <div id="ingredients" class="container tab-pane fade"><br>
                                        <ul>
                                            <? $ingredients = $recipe->ingredients()->get() ?>
                                            @foreach($ingredients as $ingredient)
                                            <li>{{$ingredient['title']}}</li>
                                            @endforeach
                                        </ul>
                                        <p></p>
                                    </div>
                                    <div id="directions" class="container tab-pane fade"><br>
                                        <ul>
                                            <? $directions = $recipe->directions()->get() ?>
                                            @foreach($directions as $direction)
                                            <li>{{$direction['title']}}</li>
                                            @endforeach
                                        </ul>

                                    </div>
                                    <div id="shoppings" class="container tab-pane fade"><br>
                                        <ul>

                                            @foreach ($recipe->ingredients as $ingredient)
                                            @foreach ($ingredient->shoppings as $shopping)
                                            <li>{{ $shopping->note }}@if( ($shopping['status'])=="1")
                                                <i style="font-size:25px;color:green;float:right;" class="fas fa-check"></i>
                                                @else
                                                <i style="font-size:25px;color:red;float:right;" class="fas fa-xmark"></i>
                                                @endif
                                            </li>
                                            @endforeach

                                            @endforeach
                                        </ul>

                                    </div>
                                    <div id="feedback" class="container tab-pane fade"><br>
                                        <div>
                                            <? $feedbacks = $recipe->recipe_feedbacks()->get() ?>
                                            @foreach($feedbacks as $feedback)
                                            <h5>{{User::whereId($feedback['created_by'])->get()->value('name');}}</h5>
                                            <p>{{$feedback['feedback_message']}}</p>
                                            <p>Ratings: <? $rating = $feedback['recipe_rate'] ?>
                                                @for ($i = 0; $i < 5; $i++) @if ($i < $rating) <i class="fas fa-star"></i>
                                                    @else
                                                    <i class="far fa-star"></i>
                                                    @endif
                                                    @endfor

                                            </p>
                                            @endforeach
                                        </div>

                                    </div>
                                    <div id="tags" class="container tab-pane fade"><br>
                                        <div>
                                            <p>{{$recipe['tags']}}</p>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <h5 for="created_by">Status</h5>
                            <div style="background-color:#e6ffff">
                                @if (($recipe['status'])=="1")
                                <p class="fw-bolder text-success p-2">Published</p>
                                @else
                                <p class="fw-bolder text-danger p-2">Unpublished</p>
                                @endif
                            </div>
                        </div>
                        <div class="mb-3">
                            <h5 for="created_by">Estimeted Time</h5>
                            <div style="background-color:#e6ffff;padding:5px;">
                                <? $seconds = floor($recipe['set_time'] / 1000);

                                $real_time = gmdate('H', $seconds) . ' hours ' . gmdate("i", $seconds) . ' minutes ' . gmdate("s", $seconds) . ' seconds';
                                echo ($real_time) ?>
                            </div>
                        </div>
                        <div class="mb-3">
                            <h5 for="created_by">Serve For</h5>
                            <div style="background-color:#e6ffff;padding:5px;">
                                {{ $recipe['serving']}}&nbsp;person.
                            </div>
                        </div>
                        <div class="mb-3">
                            <h5 for="created_by">Created By</h5>
                            <div style="background-color:#e6ffff;padding:5px;">{{User::whereId($recipe['created_by'])->get()->value('name') }}&nbsp;at&nbsp;{{date('h:i A ', strtotime($recipe['created_at']))}}&nbsp;on&nbsp;
                                {{date('d-m-Y', strtotime($recipe['created_at']))}}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection