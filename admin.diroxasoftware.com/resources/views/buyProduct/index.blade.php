@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Buy a product ') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('product.confirmbuy') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="product" class="col-md-4 col-form-label text-md-right">{{ __('Product') }}</label>

                            <div class="col-md-6">
                            <select id="product" name="product" class="form-control">
                          
                          @foreach($allproducts as $allproducts)
                          <option selected >{{$allproducts->name}}</option>
                          @endforeach
                      </select>

                      Or<a href="/customer/new"> Register new customer now </a>

                                @error('client')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                   
                        <div class="form-group row">
                            <label for="price" class="col-md-4 col-form-label text-md-right">{{ __('Price') }}</label>

                            <div class="col-md-6">
                                <input id="price" type="price" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" required autocomplete="price">

                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="discount" class="col-md-4 col-form-label text-md-right">{{ __('Discount') }}</label>

                            <div class="col-md-6">
                                <input id="discount" type="discount" class="form-control @error('discount') is-invalid @enderror" name="discount" required autocomplete="new-discount">

                                @error('discount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                       
                        <br>                          
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-warning">
                                    {{ __('Buy') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
