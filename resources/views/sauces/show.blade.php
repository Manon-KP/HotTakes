@extends('layouts.app')

@section('content')
<div class="container">
    <div class="text-center mb-5 text-uppercase">
        <h1>
            DETAILS OF <br>
            <span class="text-uppercase 
                @if ($sauce->heat < 3)
                    text-success
                @elseif ($sauce->heat < 6)
                    text-warning
                @else
                    text-danger
                @endif">
                {{ $sauce->name }}
            </span>
        </h1>
    </div>

    <div class="d-flex justify-content-center">
        <div class="card border-0 transition" style="max-width: 500px; width: 100%;">
            <div class="overflow-hidden text-center">
                <img src="{{ asset($sauce->imageUrl) }}" class="card-img-top mx-auto"
                    alt="{{ $sauce->name }}"
                    style="object-fit: cover; height:auto; width: 250px;">
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-center my-2 gap-2 mb-5">
                    <form action="{{ route('sauces.like', $sauce->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success btn-sm shadow-sm rounded-pill">
                            <i class="fas fa-thumbs-up"></i> {{ $sauce->likes }}👍
                        </button>
                    </form>
                    <form action="{{ route('sauces.dislike', $sauce->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm shadow-sm rounded-pill">
                            <i class="fas fa-thumbs-down"></i> {{ $sauce->dislikes }}👎
                        </button>
                    </form>
                </div>
                <p class="card-text"><strong>Heat:</strong> {{ $sauce->heat }}/10🔥</p>
                <p class="card-text"><strong>Manufacturer:</strong> {{ $sauce->manufacturer }}</p>
                <p class="card-text"><strong>Main Pepper:</strong> {{ $sauce->mainPepper }}</p>
                <p class="card-text"><strong>Description:</strong><br> {{ $sauce->description }}</p>
                <p class="card-text"><strong>Author:</strong>
                    @if ($sauce->userId != Auth::id())
                    {{ $sauce->user->name }}
                    @else
                    You ({{$sauce->user->name}})
                    @endif
                </p>
                <!-- Boutons d'actions -->
                <div class="d-flex justify-content-center my-2 gap-2">
                    <a href="{{ route('sauces.index') }}" class="btn btn-info shadow-sm rounded-pill">
                        <i class="fas fa-arrow-left"></i> BACK
                    </a>
                    @if ($sauce->userId == Auth::id())
                    <a href="{{ route('sauces.edit', $sauce->id) }}" class="btn btn-warning shadow-sm rounded-pill">
                        <i class="fas fa-edit"></i> EDIT
                    </a>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-danger shadow-sm rounded-pill" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $sauce->id }}">
                        <i class="fas fa-trash"></i> DELETE
                    </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de confirmation de suppression -->
<div class="modal fade" id="deleteModal{{ $sauce->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $sauce->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel{{ $sauce->id }}">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete the sauce "{{ $sauce->name }}"?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <!-- Formulaire de suppression -->
                <form action="{{ route('sauces.destroy', $sauce->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">DELETE</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection