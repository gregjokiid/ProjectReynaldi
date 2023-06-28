<div class="product__item">
    <a href="{{ $route }}">
        <div class="product__item__pic set-bg"
             data-setbg="{{ $image }}">
            @if(empty($stock))
                <div class="label stockout">Habis</div>
            @else
                <div class="label new">Baru</div>
            @endif
        </div>
    </a>
    <div class="product__item__text">
        <h6><a href="{{ $route }}">{{ $name }}</a></h6>
        <div class="rating">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
        </div>
        <div class="product__price">{{ rupiah($price) }}</div>
    </div>
</div>
