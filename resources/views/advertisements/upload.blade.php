<!-- resources/views/upload.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ route('upload') }}" method="POST" class="dropzone" id="my-dropzone">
            @csrf
        </form>
    </div>
@endsection
@push('scripts')
    <script>
        Dropzone.options.myDropzone = {
            paramName: "file", // Nazwa parametru pliku
            maxFilesize: 5,    // Maksymalny rozmiar pliku w MB
            acceptedFiles: ".jpg, .jpeg, .png, .gif", // Akceptowane rozszerzenia plików
            addRemoveLinks: true, // Dodaj linki do usuwania plików
            init: function () {
                this.on("complete", function (file) {
                    if (file.status === "success") {
                        // Plik został przesłany
                    }
                });
            }
        };
    </script>
@endpush
