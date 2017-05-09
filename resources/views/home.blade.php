@extends('layouts.app')

@section('content')

<ul>
    @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
</ul>

<dashboard :init_boards="{{ $boards }}"></dashboard>

@endsection

@section('script')