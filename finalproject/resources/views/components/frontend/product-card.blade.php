<div class="product__item">
    <div class="product__item__pic set-bg"
        data-setbg="{{ $image }}">
        @if(empty($stock))
            <div class="label stockout">Stockout</div>
        @else
            <div class="label new">New</div>
        @endif
        <ul class="product__hover">
            <li><a href="{{ $image }}"
                    class="image-popup"><span class="arrow_expand"></span></a></li>
            <li><a href="{{ $route }}"><span><i class="fa fa-eye"></i></span></a></li>
        </ul>
    </div>
    <div class="product__item__text">
        <h6><a href="{{ $route }}">{{ $name }}</a></h6>
        <div class="rating">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
        </div>
        <div class="product__price">{{ $price }}</div>
    </div>
</div>
