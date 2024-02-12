@extends('errors.layouts')

@section('code', '404')
@section('title', __('Page Not Found'))

@section('image')
    <div style="background-image: url(https://img.freepik.com/premium-photo/anime-girl-with-question-mark-her-face-generative-ai_958124-30566.jpg);" class="absolute pin bg-cover bg-no-repeat md:bg-left lg:bg-center">
    </div>
@endsection

@section('message', __('Xin lỗi, trang bạn đang truy cập không được tìm thấy.'))
