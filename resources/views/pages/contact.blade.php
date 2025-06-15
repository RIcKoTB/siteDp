@extends('layouts.app')

@section('title', 'Зв’язатися з нами')

@section('content')
    <section class="section alt-bg">
        <div class="container" style="max-width: 700px; margin: 0 auto;">
            <h2 class="section-title">Зв’язатися з нами</h2>
            <p class="section-text">Маєте запитання, пропозиції або хочете долучитися до нашої діяльності? Заповніть форму нижче:</p>

            @if(session('success'))
                <div class="alert alert-success" style="margin-top: 20px;">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('contact.submit') }}" style="margin-top: 30px;">
                @csrf

                <div class="form-group" style="margin-bottom: 15px;">
                    <label for="name">Ваше ім’я:</label>
                    <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
                    @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="form-group" style="margin-bottom: 15px;">
                    <label for="phone">Телефон:</label>
                    <input type="text" name="phone" class="form-control" required value="{{ old('phone') }}">
                    @error('phone') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="form-group" style="margin-bottom: 15px;">
                    <label for="email">Email:</label>
                    <input type="email" name="email" class="form-control" required value="{{ old('email') }}">
                    @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="form-group" style="margin-bottom: 15px;">
                    <label for="message">Повідомлення:</label>
                    <textarea name="message" rows="5" class="form-control" required>{{ old('message') }}</textarea>
                    @error('message') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <button type="submit" class="btn btn-primary" style="padding: 10px 30px;">Надіслати</button>
            </form>
        </div>
    </section>
@endsection
