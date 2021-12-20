@extends('layout.app')

@section('content')
    <div class="starter-template">
        <h1>Confirm order:</h1>
        <div class="container">
            <div class="row justify-content-center">
                <p>Total cost: <b>{{ $order->getTotalSum() }} $.</b></p>
                <form action="{{route('order_post') }}" method="POST">
                    <div>
                        <p>Enter your name and phone number so that our manager can contact you:</p>
                        <div class="container">
                            <div class="form-group">
                                <label for="name" class="control-label col-lg-offset-3 col-lg-2">Name: </label>
                                <div class="col-lg-4">
                                    <input type="text" name="name" id="name" value="" class="form-control">
                                    @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <br>
                            <br>
                            <div class="form-group">
                                <label for="phone" class="control-label col-lg-offset-3 col-lg-2">
                                    Phone number:
                                </label>
                                <div class="col-lg-4">
                                    <input type="text" name="phone" id="phone" value="{{ old('phone') }}" class="form-control">
                                    @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <br>
                            <br>
                            <div class="form-group">
                                <label for="email" class="control-label col-lg-offset-3 col-lg-2">Email: </label>
                                <div class="col-lg-4">
                                    <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control">
                                </div>
                            </div>
                        </div>
                        <br>
                        @csrf
                        <input type="submit" class="btn btn-success" value="Confirm">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
