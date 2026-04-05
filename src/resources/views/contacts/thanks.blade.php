@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/contacts/thanks.css') }}">
@endsection
@section('content')
    <div class="thanks__content">
        <div class="thanks__heading">
            <h1 class="thanks__heading-title">お問い合わせありがとうございました</h1>
        </div>
        <a href="{{ route('index') }}" class="thanks__button">HOME</a>
    </div>
@endsection
