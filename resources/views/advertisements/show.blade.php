@extends('layouts.app')

@section('content')
<div class="container">



    <div class="card mb-3">
        <div class="row g-0">
            <div class="col-md-6 align-self-center">
                <div class="card-img-bottom">

                    @if (!empty($advertisement->photos))

                    @foreach (json_decode($advertisement->photos) as $photo)
                    <img class="img-fluid rounded m-2" src="{{ '/storage/'.($photo) }}" alt="Zdjęcie ogłoszenia">
                    @endforeach


                    @endif

                </div>
            </div>
            <div class="col-md-6 text-center p-4">
                <div class="card-body">
                    <h2 class="card-title pb-2">{{ $advertisement->title }}</h2>
                    <p class="card-text text-start">{{ $advertisement->description }}</p>
                    <h5 class="card-text"> Cena: {{ $advertisement->price }} zł</h5>
                    <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                </div>
                <a href="{{ route('advertisements.index', $advertisement->id) }}" class="btn btn-success">Ogłoszenia</a>
            </div>
            <div class="mb-3 d-flex justify-content-center">
                <a href="{{ route('advertisements.index', $advertisement->id) }}" class="btn btn-success me-1">Ogłoszenia</a>
                @if (auth()->id() === $advertisement->user_id)
                <a href="{{ route('advertisements.edit', $advertisement->id) }}" class="btn btn-primary me-1">Edytuj</a>
                <form method="POST" action="{{ route('advertisements.destroy', $advertisement->id) }}" class="text-center">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Czy na pewno chcesz usunąć to ogłoszenie?'.$photo)">Usuń</button>




                </form>
                @endif

            </div>



        </div>
    </div>



</div>
@endsection