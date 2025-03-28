@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-4">MY SAUCES</h1>

    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        {{ $message }}
    </div>
    @endif

    @if ($sauces->isEmpty())
    <div class="alert alert-info text-center">
        No sauce found.
        <a href="{{ route('sauces.create') }}">Add one here.</a>
        
    </div>
    @else
    <div class="row g-4">
        @foreach ($sauces as $sauce)
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card h-100 shadow-sm border-0 transition" style="width: 350px; margin: auto;">
                <div class="overflow-hidden" style="height: 100%;">
                    <img src="{{ $sauce->imageUrl }}" class="card-img-top" alt="{{ $sauce->name }}" style="object-fit: cover; height:350px; transition: transform 0.3s;">
                </div>
                <div class="card-body d-flex flex-column justify-content-between align-items-center text-center">
                    <h5 class="card-title 
                        @if ($sauce->heat < 3)
                            text-success
                        @elseif ($sauce->heat < 6)
                            text-warning
                        @else
                            text-danger
                        @endif">
                        {{ $sauce->name }}
                    </h5>

                    <div class="">
                        <p class="card-text">
                            <small class="
                            @if ($sauce->heat < 3)
                                text-success
                            @elseif ($sauce->heat < 6)
                                text-warning
                            @else
                                text-danger
                            @endif">
                                <i class="fas fa-fire"></i> {{ $sauce->heat }}/10🔥
                            </small>
                        </p>
                        <p class="card-text"><strong>Manufacturer:</strong> {{ $sauce->manufacturer }}</p>
                        <p class="card-text"><strong>Main Pepper:</strong> {{ $sauce->mainPepper }}</p>
                        <p class="card-text"><strong>Description:</strong><br> {{ $sauce->description }}</p>

                    </div>
                    <div class="d-flex justify-content-center my-2">
                        <form action="{{ route('sauces.like', $sauce->id) }}" method="POST" class="me-1">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm rounded-pill">
                                <i class="fas fa-thumbs-up"></i> {{ $sauce->likes }}👍
                            </button>
                        </form>
                        <form action="{{ route('sauces.dislike', $sauce->id) }}" method="POST" class="ms-1">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm rounded-pill">
                                <i class="fas fa-thumbs-down"></i> {{ $sauce->dislikes }}👎
                            </button>
                        </form>
                    </div>
                    <div class="d-flex flex-wrap justify-content-center gap-2 mt-3">
                        <a href="{{ route('sauces.edit', $sauce->id) }}" class="btn btn-warning btn-sm rounded-pill">
                            EDIT
                        </a>
                        <button type="button" class="btn btn-danger btn-sm rounded-pill" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $sauce->id }}">
                            DELETE
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center my-4">
        {{ $sauces->links('pagination::bootstrap-4') }}
    </div>
    @endif
</div>

<!-- Modale de confirmation de suppression -->
@foreach ($sauces as $sauce)
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
@endforeach

@endsection