@extends('store.store')

@section('categories')
    @include('store.partial.categories')
@endsection

@section('content')
    <div class="col-sm-9 padding-right">
        <div class="product-details"><!--product-details-->
            <div class="col-sm-5">
                <div class="view-product">
                    @if(count($product->images))
                        <img src="{{ url('uploads/' . $product->images->first()->id . '.' . $product->images->first()->extension) }}" width="200" alt=""/>
                    @else
                        <img src="{{ url('images/no-img.jpg') }}" width="200" alt=""/>
                    @endif
                </div>
                <div id="similar-product" class="carousel slide" data-ride="carousel">
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <div class="item active">
                            @foreach($product->images as $image)
                                <img src="{{ url('uploads/' . $image->id . '.' . $image->extension) }}" width="80" alt=""/>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-7">
                <div class="product-information"><!--/product-information-->
                    <h2>{{ strtoupper($product->category->name) }} :: {{ $product->name }}</h2>
                    <p>{{ $product->description }}</p>
                    <span>
                        <span>$ {{ $product->price }}</span>
                            <a href="{{ route('cart.add', ['id' => $product->id]) }}" class="btn btn-fefault cart">
                                <i class="fa fa-shopping-cart"></i>
                                Add to cart
                            </a>
                    </span>
                    <p>
                        @foreach($product->tags as $tag)
                            <a href="{{ route('store.tag', ['id' => $tag->id]) }}">{{ $tag->name }}</a>,&nbsp;
                        @endforeach
                    </p>
                </div><!--/product-information-->
            </div>
        </div><!--/product-details-->
    </div>
@endsection
