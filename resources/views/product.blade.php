@extends('layouts.layout')

@section('content')

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    @productGroup($product)
  </ol>
</nav>

<h1>{{ $product->name }}</h1>
<h3>Цена: {{ number_format($product->price->price, 0, ',', ' ') }} ₽</h3>


@endsection
