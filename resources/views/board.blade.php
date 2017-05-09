@extends('layouts.app')

@section('content')
<ul>
  @foreach($errors->all() as $error)
    <li>{{ $error }}</li>
  @endforeach
</ul>
<dragula :init_board="{{ $board }}" :init_lists="{{ $lists }}"></dragula>

@endsection

@section('script')