@extends('layout')

@section('content')
    @foreach($family_members as $family_member)
            <p>{{ $family_member->name }}</p>
    @endforeach
    {{ $family_members->links() }}
@stop