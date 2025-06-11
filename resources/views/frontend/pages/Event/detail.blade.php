@extends('frontend.layouts.app')

@section('title', 'Event | Basko Grand Mall')

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
                    @foreach (explode(',', $event->img) as $listImage)
                        <div class="swiper-slide">
                            <img src="{{ asset('dist/assets/img/Events/' . trim($listImage)) }}" alt="" />
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
                <p class="text-success small mb-1">
                    @if ($event->category == 'ongoing')
                        Ongoing Event
                    @else
                        Past Event
                    @endif
                </p>
                <h2 style="font-size: 36px">
                  {{ $event->title ?? '' }}
                </h2>
                <p class="mb-1 text-muted small">
                  <i class="bi bi-clock-fill text-danger me-1"></i>
                  {{ $event->open ? date('h:i A', strtotime($event->open)) : '' }} -
                  {{ $event->close ? date('h:i A', strtotime($event->close)) : '' }}
                </p>
                <p class="mb-1 text-muted small">
                  <i class="bi bi-geo-alt-fill text-danger me-1"></i> Location :
                  {{ $event->address ?? '' }}
                </p>
                <p class="mb-3 text-muted small">
                  <i class="bi bi-telephone-fill text-danger me-1"></i>
                  {{ $event->phone ?? '' }}
                </p>
                <p class="mt-2">
                  {!! $event->desc !!}
                </p>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- /Portfolio Details Section -->

      <!-- EVENT -->
      <section id="clients" class="section clients">
        <div class="container section-title" data-aos="fade-up">
          <h2 style="font-size: 28px">OTHER EVENT</h2>
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
              @foreach ($events as $event)
                <!-- Slide 1 -->
                <div class="swiper-slide">
                    <a href="{{ route('front.event.show', $event->id) }}">
                        <div class="card h-100 border rounded shadow-sm" style="max-height: 19rem;">
                        <!-- Gambar dengan tanggal dan label -->
                        <div class="position-relative">
                            <img
                            src="{{ asset('dist/assets/img/Events/' . explode(',', $event->img)[0] ?? '') }}"
                            class="card-img-top"
                            alt="The Body Shop"
                            style="object-fit: cover; height: 200px"
                            />

                            <!-- Tanggal di pojok kanan atas -->
                            <div
                            class="position-absolute top-0 end-0 bg-white text-center px-2 py-1"
                            style="margin: 10px; border-radius: 4px"
                            >
                            <div
                                class="fw-bold text-muted"
                                style="font-size: 14px"
                            >
                               {{ \Carbon\Carbon::parse($event->date)->format('d') }}
                            </div>
                            <div class="text-muted" style="font-size: 12px">
                                {{ strtoupper(\Carbon\Carbon::parse($event->date)->format('M')) }}
                            </div>
                            </div>

                            <!-- Label event -->
                            <div
                            class="position-absolute bottom-0 start-0 end-0 d-flex justify-content-center"
                            style="margin-bottom: -12px"
                            >
                            <div
                                class="bg-success text-white px-3 py-1"
                                style="
                                border-radius: 2px;
                                font-size: 14px;
                                font-weight: 600;
                                "
                            >
                                @if ($event->category == 'ongoing')
                                    ONGOING EVENT
                                @else
                                    PAST EVENT
                                @endif
                            </div>
                            </div>
                        </div>

                        <!-- Konten bawah -->
                        <div class="card-body text-center pt-4">
                            <h5 class="card-title fw-bold mb-2">
                            {!! \Illuminate\Support\Str::words($event->title ?? '', 4, '...') !!}
                            </h5>
                            <p class="card-text text-muted small">
                            {!! \Illuminate\Support\Str::words($event->desc ?? '', 5, '...') !!}
                            </p>
                        </div>
                        </div>
                    </a>
                </div>
              @endforeach
            </div>

            <div class="swiper-pagination mt-4"></div>
          </div>
        </div>
      </section>
    </main>
@endsection
