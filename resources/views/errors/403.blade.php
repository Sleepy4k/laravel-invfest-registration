@extends('errors::minimal')

@section('title', 'Forbidden Access')
@section('code', '403')
@section('description', $exception->getMessage() ?: 'Forbidden Access due invalid credential or access')
