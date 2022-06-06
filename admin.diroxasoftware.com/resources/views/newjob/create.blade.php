@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register new Service') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('newjob.store') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="client" class="col-md-4 col-form-label text-md-right">{{ __('Client') }}</label>

                            <div class="col-md-6">
                            <select id="client" name="client" class="form-control">
                          
                          @foreach($allcustomers as $allcustomerss)
                          <option selected >{{$allcustomerss->name}}</option>
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
                            <label for="machineName" class="col-md-4 col-form-label text-md-right">{{ __('machineName') }}</label>

                            <div class="col-md-6">
                                <input id="machineName" type="text" class="form-control @error('machineName') is-invalid @enderror" name="machineName" value="{{ old('machineName') }}" required autocomplete="machineName" autofocus>

                                @error('machineName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name of Service') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Type of Service') }}</label>

                            <div class="col-md-6">
                                <input id="type" type="type" class="form-control @error('type') is-invalid @enderror" name="type" value="{{ old('type') }}" required autocomplete="type">

                                @error('type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="about" class="col-md-4 col-form-label text-md-right">{{ __('About') }}</label>

                            <div class="col-md-6">
                                <input id="about" type="about" class="form-control @error('about') is-invalid @enderror" name="about" required autocomplete="new-about">

                                @error('about')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                       
                        <br>                          
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
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
