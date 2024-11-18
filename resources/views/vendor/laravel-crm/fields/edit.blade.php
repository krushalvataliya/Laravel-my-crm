@extends('my-crm::layouts.app')

@section('content')

    <livewire:fields.create-or-edit :field="$field" />

@endsection