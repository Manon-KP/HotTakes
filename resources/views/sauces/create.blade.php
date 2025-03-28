@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-4">ADD A NEW SAUCE</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('sauces.store') }}" method="POST" class="needs-validation" novalidate enctype="multipart/form-data" style="width: 50%; margin: auto;">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <div class="mb-3">
            <label for="manufacturer" class="form-label">Manufacturer</label>
            <input type="text" class="form-control" id="manufacturer" name="manufacturer" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
        </div>

        <div class="mb-3">
            <label for="mainPepper" class="form-label">Main Pepper</label>
            <input type="text" class="form-control" id="mainPepper" name="mainPepper" required>
        </div>

        <!-- Image Upload -->
        <div class="mb-3">
            <label for="imageUrl" class="form-label">Image</label>
            <input type="file" class="form-control" id="imageUrl" name="imageUrl" accept="image/*" required>
            <div class="d-flex justify-content-center">
                <img id="imagePreview" class="img-fluid mt-2 d-none" alt="Preview Image" style="height:auto; width: 250px;">
            </div>
        </div>

        <!-- Heat Slider -->
        <div class="mb-3">
            <label for="heat" class="form-label">Heat (1-10): <span id="heatValue">5</span></label>
            <br>
            <input class="form-range" type="range" id="heat" name="heat" min="1" max="10" value="5" step="1" required>
        </div>

        <button type="submit" class="btn btn-primary shadow-sm rounded-pill px-4">SUBMIT</button>
    </form>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Slider
        var slider = document.getElementById("heat");
        var output = document.getElementById("heatValue");
        output.innerHTML = slider.value;

        slider.oninput = function() {
            output.innerHTML = this.value;
        }

        // Image Preview
        const imageInput = document.getElementById("imageUrl");
        const imagePreview = document.getElementById("imagePreview");

        imageInput.addEventListener("change", function(event) {
            const files = imageInput.files;
            if (files.length > 0) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.setAttribute('src', e.target.result);
                    imagePreview.classList.remove("d-none");
                };
                reader.readAsDataURL(files[0]); // Utiliser files[0] ici
            } else {
                imagePreview.setAttribute('src', "");
                imagePreview.classList.add("d-none");
            }
        });
    });
</script>

@endsection