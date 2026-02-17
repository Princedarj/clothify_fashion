@extends('layouts.admin')

@section('content')

<div class="container py-4">

    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-dark text-white rounded-top-4">
            <h4 class="mb-0">🛍 Add New Product</h4>
        </div>

        <div class="card-body p-4">

            {{-- Validation Errors --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.products.store') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf

                {{-- Product Name --}}
                <div class="mb-3">
                    <label class="form-label fw-bold">Product Name</label>
                    <input type="text"
                           name="name"
                           class="form-control form-control-lg"
                           placeholder="Enter product name"
                           required>
                </div>

                {{-- Price --}}
                <div class="mb-3">
                    <label class="form-label fw-bold">Price (₹)</label>
                    <input type="number"
                           name="price"
                           step="0.01"
                           class="form-control form-control-lg"
                           placeholder="Enter price"
                           required>
                </div>

                {{-- Description --}}
                <div class="mb-3">
                    <label class="form-label fw-bold">Description</label>
                    <textarea name="description"
                              rows="4"
                              class="form-control"
                              placeholder="Enter product description"></textarea>
                </div>

                {{-- Image --}}
                <div class="mb-4">
                    <label class="form-label fw-bold">Product Image</label>
                    <input type="file"
                           name="image"
                           class="form-control"
                           accept=".jpg,.jpeg,.png,.pdf">
                    <small class="text-muted">
                        Allowed formats: JPG, JPEG, PNG, PDF (Max 2MB)
                    </small>
                </div>

                {{-- Buttons --}}
                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.products.index') }}"
                       class="btn btn-outline-secondary px-4">
                        ← Back
                    </a>

                    <button type="submit"
                            class="btn btn-success px-4">
                        💾 Save Product
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>

@endsection