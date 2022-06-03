{% for banner in banners %}
<div class="intro-slide" style="background-image: url({{banner.picturePath}});">
    <div class="container intro-content">
        <div class="row">
            <div class="col-auto offset-lg-3 intro-col">
                <h3 class="intro-subtitle">{{ banner.subtitle }}</h3><!-- End .h3 intro-subtitle -->
                <h1 class="intro-title"><div>{{ v.bannerTitle(banner.title) }}</div>
                    <span>
                        {{v.bannerOldPrice(banner.oldPrice)}}
                        <span class="text-primary"> ${{ v.BannerNewPrice(banner.newPrice) }}</span>
                    </span>
                </h1><!-- End .intro-title -->

                <a href="category.html" class="btn btn-outline-primary-2">
                    <span>Shop Now</span>
                    <i class="icon-long-arrow-right"></i>
                </a>
            </div><!-- End .col-auto offset-lg-3 -->
        </div><!-- End .row -->
    </div><!-- End .container intro-content -->
</div>
{% endfor %}