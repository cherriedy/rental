@extends('errors.layouts')

@section('code', '403')
@section('title', __('Page Not Found'))

@section('image')
    <div style="background-image: url(https://external-preview.redd.it/VNfYgsb6Pqn4xlEBpYl11534fIpOfN1XeMe7NrzgmQs.png?auto=webp&s=f3f1b4dd4b8bd103781b0898a96a30fe838b040b);" class="absolute pin bg-cover bg-no-repeat md:bg-left lg:bg-center">
    </div>
@endsection

@section('message', __('Xin lỗi, bạn không có quyền truy cập vào trang này.'))
