@extends('layouts.layout')

@section('title', $room->name)

@section('content')
    <div class="row pb-5">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="h1">{{ $room->name }}</h1>

            <div class="d-flex justify-content-end align-items-center">
                <button class="d-flex justify-content-center align-items-center px-3 py-2 rounded-pill">
                    <i class="fa-regular fa-share-from-square"></i>
                    <span class="px-2">Share</span>
                </button>
            </div>
        </div>

        <div class="d-flex flex-row align-items-center mt-1">
            <p class="text-secondary" style="font-size: 1rem; font-weight: 300;"><i class="fa-solid fa-map-pin"
                    style="padding-right: 8px;"></i>Via Aurelia, Rome, Italy</p>
        </div>

        <div class="d-flex flex-row  flex-wrap align-items-center" style="column-gap: 12px;">
            <div class="d-flex align-items-center justify-content-between rm-bagde-primary">
                <span style="font-size: 14px; font-weight: 500; color: #93c54b">Available from now</span>
            </div>

            <div class="d-flex align-items-center justify-content-between rm-bagde" style="column-gap: 8px;">
                <i class="fa-solid fa-house"></i>
                <span style="font-size: 14px;">{{ $room->category->name }}</span>
            </div>

            <div class="d-flex align-items-center justify-content-between rm-bagde" style="column-gap: 8px;">
                <i class="fa-solid fa-house"></i>
                <span style="font-size: 14px;">{{ $room->area }} <span>m<sup>2</sup></span></span>
            </div>

            <div class="d-flex align-items-center justify-content-between rm-bagde" style="column-gap: 8px;">
                <i class="fa-solid fa-house"></i>
                <span style="font-size: 14px;">Apartment</span>
            </div>

        </div>

    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="d-flex flex-row" style="height: 350px; column-gap: 12px;">
                <div class="img-rounded-container" style="width: 65%;">
                    <img src="https://roomless-listing-images.s3.us-east-2.amazonaws.com/listing/cf/bf/4c/25/cfbf4c25-c4ff-4504-9ff1-2d207a5b907f.jpeg"
                        alt="">
                </div>

                <div class="d-flex flex-column" style="width: 35%; row-gap: 12px;">
                    <div class="img-rounded-container">
                        <img src="https://roomless-listing-images.s3.us-east-2.amazonaws.com/listing/cf/bf/4c/25/cfbf4c25-c4ff-4504-9ff1-2d207a5b907f.jpeg"
                            alt="">
                    </div>

                    <div class="img-rounded-container">
                        <img src="https://roomless-listing-images.s3.us-east-2.amazonaws.com/listing/cf/bf/4c/25/cfbf4c25-c4ff-4504-9ff1-2d207a5b907f.jpeg"
                            alt="">
                    </div>
                </div>
            </div>

            <ol class="d-flex flex-row align-items-center py-3"
                style="column-gap: 12px; list-style: none; font-size: 14px;">
                <li><a href="/"><i class="fa-solid fa-house"></i></a></li>

                <i class="fa-solid fa-greater-than"></i>
                <li><a href="#" class="text-decoration-none"><span>Room</span></a></li>

                <i class="fa-solid fa-greater-than" style="color: #002b3d;"></i>
                <li><a href="#" class="text-decoration-none"><span>Room</span></a></li>

                <i class="fa-solid fa-greater-than"></i>
                <li><a href="#" class="text-decoration-none"><span>Room</span></a></li>

            </ol>

            <div class="">
                <div class="card px-3 py-2">
                    <p class="card-title">Description</p>
                    <hr>
                    <p class="overflow-hidden" style="text-align: justify;">{{ $room->content }}</p>
                </div>
            </div>

        </div>

    </div>

@endsection
