@extends('layouts.layout')

@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12">
                <form action="{{ url('/upload-images') }}" method="post" enctype="multipart/form-data" id="images"
                    class="dropzone">
                    @csrf
                        <h4 class="text-center">Upload or Drag & Drop images</h4>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        Dropzone.autoDiscover = false;

        var dropzone = new Dropzone('#images', {
                    thumbnailWidth: 200,
                    maxFilesize: 2,
                    paramName: "images",
                    acceptedFiles: ".jpeg,.jpg,.png,.gif",

                    error: function(file, errorMessage) {
                        errors = true;
                    },
                    queuecomplete: function() {
                        var count = dropzone.files.length;
                        if (count == 1) {

                            setTimeout(function() {
                                dropzone.removeAllFiles();
                                alert("Image uploaded successfully");
                            }, 1000);

                        } else {

                            setTimeout(function() {
                                dropzone.removeAllFiles();
                                alert("Images uploaded successfully");
                            }, 1000);

                        }
                    }
    </script>
@endsection
