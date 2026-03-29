@extends('layouts.user')

@section('content')
<div class="container">
    <h2>{{ __('messages.Checkout') }}</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('order.place') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>{{ __('messages.Name') }}</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>{{ __('messages.Email') }}</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>{{ __('messages.Phone') }}</label>
            <input type="text" name="phone" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>{{ __('messages.Address') }}</label>
            <textarea name="address" class="form-control" required></textarea>
        </div>

        <div class="mb-3">
            <label>{{ __('messages.Pincode') }}</label>
            <input type="text" name="pincode" class="form-control" required>
        </div>

        <button class="btn btn-success">
            {{ __('messages.Place Order') }}
        </button>
    </form>
</div>

@include('layouts.footer')
@endsection