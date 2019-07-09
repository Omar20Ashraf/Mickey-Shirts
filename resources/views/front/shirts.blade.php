@extends('main.master')

@section('title','Shirts')
@section('content')       
<!-- products listing -->
<!-- Latest SHirts -->

<div class="row">
    {{-- Shirts Came from home Page --}}
    @forelse($products as $product)
        <div class="small-3 columns">
            <div class="item-wrapper">
                <div class="img-wrapper">
                    <a href="{{ route('cart.addItem',$product->id) }}" class="button expanded add-to-cart">
                        Add to Cart
                    </a>
                    <a href="#">
                        <img src="/storage/photos/Products/{{$product->image}}"/>
                    </a>
                </div>
                <a href="{{route('shirt',$product->id)}}">
                    <h3>{{$product->name}} </h3>                          
                </a>

                <h5> ${{$product->price}} </h5>
                                                  
                <p> {{$product->description}} </p>   
            </div>
        </div>
    @empty
        <h3>No Shirts</h3>

    @endforelse

{{-- the Shirts Page --}}
    @forelse($shirts as $shirt)
        <div class="small-3 columns">
            <div class="item-wrapper">
                <div class="img-wrapper">
                    <a href="{{ route('cart.addItem',$shirt->id) }}" class="button expanded add-to-cart">
                        Add to Cart
                    </a>
                    <a href="#">
                        <img src="/storage/photos/shirts/{{$shirt->image}}"/>
                    </a>
                </div>
                <a href="{{route('shirt',$shirt->id)}}">
                    <h3>{{$shirt->name}} </h3>                          
                </a>

                <h5> ${{$shirt->price}} </h5>
                                                  
                <p> {{$shirt->description}} </p>   
            </div>
        </div>
    @empty
        <h3>No Shirts</h3>

    @endforelse

</div>
@endsection        