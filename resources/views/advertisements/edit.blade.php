@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">


                <div class="card-header">Edycja Ogłoszenie</div>
                <div class="card-body">



                    <form method="POST" action="{{ route('advertisements.update', $advertisement->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <!--  Dodaj pola do edycji ogłoszenia -->

                        <div class="form-group">
                            <label for="title">Tytuł</label>
                            <input type="text" name="title" id="title" class="form-control" value="{{ $advertisement->title }}" required>
                        </div>

                        <div class="form-group">
                            <label for="description">Opis</label>
                            <textarea name="description" id="description" class="form-control" required>{{ $advertisement->description }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="price">Cena</label>
                            <input type="number" name="price" id="price" class="form-control" value="{{ $advertisement->price }}" required>
                        </div>



                        <div class="form-group mt-4">
                            <label for="photos">Zdjęcia</label>
                            <input type="file" name="photos[]" id="photos" class="form-control-file" multiple {{-- required --}}>
                        </div>



                        @if (!empty($advertisement->photos))

                        @foreach (json_decode($advertisement->photos) as $photo)

                        <div class="photo-container">
                            <img class="img-fluid rounded m-2" src="{{ '../../storage/'.($photo) }}" width="145" alt="Zdjęcie ogłoszenia">

                            <div class="photo-actions">

<!--
                                @if (auth()->id() === $advertisement->user_id)
                                <form method="POST" action="{{ route('photos.deleteFile', $advertisement->id) }}" class="text-center mt-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="photo-action fa fa-times-circle fa-2x" style="color: #ed6307;" data-action="deleteFile" data-photo-path="{{ $photo }}" onclick="return confirm('Czy na pewno chcesz usunąć to zdjęcie?" {{ $photo }}")">
                                    </button>

                                    </a>
                                </form>
                                @endif
-->

                                <a href="# " class="photo-action" data-action="delete" data-photo-path="{{ $photo }}">
                                    <i class="fa fa-times-circle fa-2x" style="color: #ed6307;"></i>
                                </a>
                                <a href="#" class="photo-action" data-action="rotate" data-photo-path="{{ $photo }}">
                                    <i class="fa fa-repeat fa-2x" style="color: black;"></i>
                                </a>



                            </div>

                           
                        </div>


                        @endforeach
                        <div>
                            <label for="photo">Ścieżki :</label>
                            <input type="text" name="photo" id="photo" class="form-control" value=" {{$advertisement->photos}} " required>
                        </div>
                        @endif

                        <div class="form-group mt-4 float-end">
                            <button type="submit" class="btn btn-primary">Zapisz zmiany</button>
                            <a href="{{ route('advertisements.index', $advertisement->id) }}" class="btn btn-success">Ogłoszenia</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<script>



</script>
@endsection