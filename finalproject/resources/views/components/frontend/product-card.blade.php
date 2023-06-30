<div class="product__item">
    <a href="{{ $route }}">
        <div class="product__item__pic set-bg"
             data-setbg="{{ $image }}">
        </div>
    </a>
    <div class="product__item__text">
        <h6><a href="{{ $route }}">{{ $name }}</a></h6>
        <div class="product__price">{{ rupiah($price) }}</div>
    </div>
</div>
