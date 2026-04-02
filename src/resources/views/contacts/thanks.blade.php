@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/contacts/thanks.css') }}">
@endsection
@section('content')
    <div class="thanks__content">
        <div class="thanks__heading">
            <h1 class="thanks__heading-title">お問い合わせありがとうございました</h1>
        </div>
        <form action="{{ route('index') }}" class="thanks-form" method="GET">
            <button class="thanks-form__button">HOME</button>
        </form>
    </div>
@endsection
