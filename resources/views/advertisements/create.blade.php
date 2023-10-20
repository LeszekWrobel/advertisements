@extends('layouts.app') <!-- Załóżmy, że masz dostępny layout o nazwie 'app' -->

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dodaj Ogłoszenie</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('advertisements.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="title">Tytuł</label>
                            <input type="text" name="title" id="title" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="description">Opis</label>
                            <textarea name="description" id="description" class="form-control" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="price">Cena</label>
                            <input type="number" name="price" id="price" class="form-control" required>
                        </div>

                        @if (!empty($advertisement->photos))
                        <ul id="sortable-list">
                            @foreach ($advertisement->photos as $photo)
                            <li data-id="{{ $photo->id }}">
                                <img src="{{ asset($photo->path) }}" alt="Zdjęcie">
                            </li>
                            @endforeach
                        </ul>

                        @endif

                        <div class="form-group mt-4">
                            <label for="photos">Zdjęcia</label>
                            <input type="file" name="photos[]" id="photos" class="form-control-file" multiple required>
                        </div>

                        <div class="form-group mt-4 float-end">
                            <button type="submit" class="btn btn-primary">Dodaj Ogłoszenie</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection