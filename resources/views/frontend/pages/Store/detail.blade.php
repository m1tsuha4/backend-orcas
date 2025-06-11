@extends('frontend.layouts.app')

@section('title', 'Store | Basko Grand Mall')

@section('content')
    <main class="main">
      <!-- Portfolio Details Section -->
      <section id="portfolio-details" class="portfolio-details section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
          <div class="row gy-4">
            <div class="col-lg-6">
              <div class="portfolio-details-slider swiper init-swiper">
                <script type="application/json" class="swiper-config">
                  {
                    "loop": true,
                    "speed": 600,
                    "autoplay": {
                      "delay": 5000
                    },
                    "slidesPerView": "auto",
                    "pagination": {
                      "el": ".swiper-pagination",
                      "type": "bullets",
                      "clickable": true
                    }
                  }
                </script>

                <div class="swiper-wrapper align-items-center">
                    @foreach (explode(',', $store->img) as $listImage)
                        <div class="swiper-slide">
                            <img src="{{ asset('dist/assets/img/Stores/' . trim($listImage)) }}" alt="" />
                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
              </div>
            </div>

            <div class="col-lg-6">
              <div
                class="portfolio-description"
                data-aos="fade-up"
                data-aos-delay="300"
              >
                <p class="text-success small mb-1">{{ $store->rCategory->category ?? '' }}</p>
                <h2 style="font-size: 36px">{{ $store->title ?? '' }}</h2>
                <p class="mb-1 text-muted small">
                  <i class="bi bi-clock-fill text-danger me-1"></i>
                  {{ $store->open ? date('h:i A', strtotime($store->open)) : '' }} -
                  {{ $store->close ? date('h:i A', strtotime($store->close)) : '' }}
                </p>
                <p class="mb-1 text-muted small">
                  <i class="bi bi-geo-alt-fill text-danger me-1"></i> Location :
                  {{ $store->address ?? '' }}
                </p>
                <p class="mb-1 text-muted small">
                  <i class="bi bi-telephone-fill text-danger me-1"></i>
                  {{ $store->phone ?? '' }}
                </p>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- /Portfolio Details Section -->

      <!-- STORE -->
      <section id="clients" class="section clients">
        <div class="container section-title" data-aos="fade-up">
          <h2 style="font-size: 28px">OTHER STORE</h2>
        </div>

        <div class="container" data-aos="fade-up" data-aos-delay="100">
          <div class="swiper init-swiper">
            <script type="application/json" class="swiper-config">
              {
                "loop": true,
                "speed": 5000,
                "autoplay": {
                  "delay": 0,
                  "disableOnInteraction": false
                },
                "slidesPerView": "auto",
                "freeMode": true,
                "freeModeMomentum": false,
                "pagination": {
                  "el": ".swiper-pagination",
                  "type": "bullets",
                  "clickable": true
                },
                "breakpoints": {
                  "320": {
                    "slidesPerView": 1.2,
                    "spaceBetween": 16
                  },
                  "480": {
                    "slidesPerView": 2,
                    "spaceBetween": 20
                  },
                  "768": {
                    "slidesPerView": 3,
                    "spaceBetween": 30
                  },
                  "1024": {
                    "slidesPerView": 3,
                    "spaceBetween": 40
                  }
                }
              }
            </script>

            <div class="swiper-wrapper">
             @foreach ($stores as $item )
                  <!-- Slide 1 -->
                <div class="swiper-slide">
                    <div class="position-relative">
                    <!-- Gambar tenant -->
                    <a href="{{ route('front.store.show', $item->id) }}">
                        <img
                        src="{{ asset('dist/assets/img/Stores/'. explode(',', $item->img)[0] ?? '') }}"
                        class="img-fluid w-100 rounded"
                        alt="The Body Shop"
                        style="object-fit: cover; height: 250px"
                        />

                        <!-- Icon arrow di atas gambar pojok kanan -->
                        <a href="#" class="position-absolute top-0 end-0 m-2">
                        <img
                            src="{{ asset('dist_front/assets/img/rectangle.png') }}"
                            width="36"
                            alt="Lihat Detail"
                        />
                        </a>
                    </a>
                    </div>

                    <!-- Informasi teks -->
                    <div class="pt-3">
                    <p class="text-success small mb-1">{{ $item->rCategory->category ?? '' }}</p>
                    <h5 class="fw-bold mb-1">{{ $item->title ?? '' }}</h5>
                    <p class="mb-0 text-muted small">
                        <i class="bi bi-geo-alt-fill text-danger me-1"></i> Location
                        : {{ $item->address ?? '' }}
                    </p>
                    </div>
                </div>
             @endforeach
            </div>

            <div class="swiper-pagination mt-4"></div>
          </div>
        </div>
      </section>
    </main>
@endsection
