@extends('frontend.layouts.app')

@section('title', 'Home | Basko Grand Mall')

@section('content')
<style>
    /* .suggestion-section {
        background-image: url('{{ asset('dist_front/assets/img/bgsuggest.png') }}');
        margin-bottom: -20px;
        background-size: 120%;
        background-position: bottom center;
        background-repeat: no-repeat;
    } */

    .suggestion-section {
        position: relative;
        margin-bottom: -20px;
        z-index: 1;
        overflow: hidden;
    }

    .bg-image {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: bottom center;
    transform: scale(1.1);
    z-index: 0;
    pointer-events: none;
    }

    /* ini penting */
    .suggestion-section .container {
    position: relative;
    z-index: 2;
    }

    @media (max-width: 768px) {
        .suggestion-section {
            min-height: 100vh;
        }
    }
    .custom-hr {
        width: 80%; /* atau 100% kalau ingin penuh */
        max-width: 800px; /* batas maksimal */
        height: 2px;
        margin: 30px auto;
        background: linear-gradient(to right, transparent, yellow, transparent);
        border-radius: 50px;
        opacity: 0.8;
    }

    .fade-up {
        opacity: 0;
        transform: translateY(30px); /* sedikit lebih jauh untuk efek dramatis */
        transition-property: opacity, transform;
        transition-duration: 0.8s; /* durasi lebih panjang */
        transition-timing-function: cubic-bezier(0.25, 0.1, 0.25, 1); /* lebih lembut */
    }

    .fade-up.animate {
        opacity: 1;
        transform: translateY(0);
    }

    /* Delay classes */
    .delay-1 {
        transition-delay: 0.2s;
    }

    .delay-2 {
        transition-delay: 0.8s;
    }
</style>
    <main class="main">
      <!-- Hero Section -->
      <section id="hero" class="hero section d-flex">
        <div class="hero-carousel-wrapper">
          <div
            id="hero-carousel"
            class="carousel slide carousel-fade"
            data-bs-ride="carousel"
            data-bs-interval="1500"
          >
            {{-- <div class="carousel-item active">
              <img src="{{ asset('dist_front/assets/img/hero-carousel/hero.png') }}" alt="" />
            </div>
            <div class="carousel-item">
              <img src="{{ asset('dist_front/assets/img/hero-carousel/hero1.jpg') }}" alt="" />
            </div>
            <div class="carousel-item">
              <img src="{{ asset('dist_front/assets/img/hero-carousel/hero4.jpg') }}" alt="" />
            </div> --}}
            @foreach ($banners as $index => $banner)
                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                    <img src="{{ asset('dist/assets/img/Medias/' . ($banner->img ?? '')) }}" alt="" />
                </div>
            @endforeach

            <a
              class="carousel-control-prev"
              href="#hero-carousel"
              role="button"
              data-bs-slide="prev"
            >
              <span
                class="carousel-control-prev-icon bi bi-chevron-left"
                aria-hidden="true"
              ></span>
            </a>
            <a
              class="carousel-control-next"
              href="#hero-carousel"
              role="button"
              data-bs-slide="next"
            >
              <span
                class="carousel-control-next-icon bi bi-chevron-right"
                aria-hidden="true"
              ></span>
            </a>
          </div>
        </div>

        <div class="hero-promo">
          <div class="promo-content">
            <img src="{{ asset('dist_front/assets/img/basko2.jpg') }}" alt="" />
          </div>
        </div>
      </section>
      <!-- /Hero Section -->

      {{-- LOGO --}}
      <section id="clients" class="section clients">
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
                "grabCursor": false,
                "pagination": {
                  "el": ".swiper-pagination",
                  "type": "bullets",
                  "clickable": true
                },
                "breakpoints": {
                  "320": {
                    "slidesPerView": 2,
                    "spaceBetween": 40
                  },
                  "480": {
                    "slidesPerView": 3,
                    "spaceBetween": 60
                  },
                  "640": {
                    "slidesPerView": 4,
                    "spaceBetween": 80
                  },
                  "992": {
                    "slidesPerView": 6,
                    "spaceBetween": 120
                  }
                }
              }
            </script>

            <div class="swiper-wrapper align-items-center">
              @foreach ($logos as $logo)
                <div class="swiper-slide">
                    <img
                    src="{{ asset('dist/assets/img/Medias/' . $logo->img ?? '') }}"
                    class="img-fluid"
                    alt=""
                    />
                </div>
              @endforeach
            </div>
          </div>
        </div>
      </section>

      <div class="custom-hr"></div>

      <!-- STORE -->
      <section id="clients" class="section clients fade-up delay-1">
        <div class="container section-title">
          <h2>STORE</h2>
          <p class="text-success mb-3">
            <a href="{{ route('front.store.index') }}">VIEW MORE STORE</a>
          </p>
        </div>

        <div class="container fade-up delay-2">
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

            @if ($stores->isEmpty())
                <div class="row">
                    <div class="col col-12 text-center">
                        <img src="{{ asset('dist_front/assets/img/nodata.jpg') }}" alt="No Data" class="img-fluid" style="max-height: 500px;">
                    </div>
                </div>
            @else
                <div class="swiper-wrapper">
                    @foreach ($stores as $store)
                        <!-- Slide 1 -->
                    <div class="swiper-slide">
                        <div class="position-relative">
                        <!-- Gambar tenant -->
                        <a href="{{ route('front.store.show', $store->id) }}">
                            <img
                            src="{{ asset('dist/assets/img/Stores/'. explode(',', $store->img)[0] ?? '') }}"
                            class="img-fluid w-100 rounded"
                            alt="The Body Shop"
                            style="object-fit: cover; height: 250px"
                            />

                            <!-- Icon arrow di atas gambar pojok kanan -->
                            <a href="{{ route('front.store.show', $store->id) }}" class="position-absolute top-0 end-0 m-2">
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
                        <p class="text-success small mb-1">{{ $store->rCategory->category ?? '' }}</p>
                        <h5 class="fw-bold mb-1">{{ $store->title ?? '' }}</h5>
                        <p class="mb-0 text-muted small">
                            <i class="bi bi-geo-alt-fill text-danger me-1"></i> Location
                            : {{ $store->address ?? '' }}
                        </p>
                        </div>
                    </div>
                    @endforeach
                </div>
            @endif
            <div class="swiper-pagination mt-4"></div>
          </div>
        </div>
      </section>

      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-4" style="padding: 0%">
            <img
              src="{{ asset('dist_front/assets/img/tagline/tagline1.png') }}"
              style="width: 100%; height: 100%"
              alt=""
            />
          </div>
          <div class="col-lg-4" style="padding: 0%">
            <img
              src="{{ asset('dist_front/assets/img/tagline/tagline3.png') }}"
              style="width: 100%; height: 100%"
              alt=""
            />
          </div>
          <div class="col-lg-4" style="padding: 0%">
            <img
              src="{{ asset('dist_front/assets/img/tagline/tagline2.png') }}"
              style="width: 100%; height: 100%"
              alt=""
            />
          </div>
        </div>
      </div>

      <!-- EVENT -->
      <section id="clients" class="section clients fade-up delay-1">
        <div class="container section-title">
          <h2>EVENT</h2>
          <p class="text-success mb-3">
            <a href="{{ route('front.event.index') }}">VIEW MORE EVENT</a>
          </p>
        </div>

        <div class="container fade-up delay-2">
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

            @if ($events->isEmpty())
                <div class="row">
                    <div class="col col-12 text-center">
                        <img src="{{ asset('dist_front/assets/img/nodata.jpg') }}" alt="No Data" class="img-fluid" style="max-height: 500px;">
                    </div>
                </div>
            @else
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
                                        <div class="fw-bold text-muted" style="font-size: 14px">
                                        {{ \Carbon\Carbon::parse($event->date_open)->format('d') }}
                                        </div>
                                        <div class="text-muted" style="font-size: 12px">
                                        {{ strtoupper(\Carbon\Carbon::parse($event->date_open)->format('M')) }}
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
            @endif

            <div class="swiper-pagination mt-4"></div>
          </div>
        </div>
      </section>

      <!-- Contact Section -->
      <section id="contact" class="contact section suggestion-section">
        <img src="{{ asset('dist_front/assets/img/bgsuggest.png') }}" alt="Background" class="bg-image" />
        <div class="container">
          <div class="row gy-4 mt-1">
            <div class="col-lg-6 fade-up delay-1">
              <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.323678118577!2d100.3509004!3d-0.9022173!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2fd4b8b2dcb9087b%3A0x94c699783594e421!2sBasko%20Grand%20Mall!5e0!3m2!1sid!2sid!4v1744649168684!5m2!1sid!2sid"
                frameborder="0"
                style="border: 0; width: 100%; height: 500px"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
              ></iframe>
            </div>
            <!-- End Google Maps -->

            <div class="col-lg-6">
              <div class="container section-title-2" data-aos="fade-up">
                <h2
                  style="
                    font-family: 'DM Sans';
                    font-size: 22px;
                    color: #7c877f;
                    padding-bottom: 0;
                  "
                >
                  Suggestion
                </h2>
              </div>
              <h2 style="font-size: 50px">
                <strong>HELP BASKO GROW BETTER</strong> FOR YOU
              </h2>
              <form
                action="{{ route('store.suggestion') }}"
                method="post"
                class="fade-up delay-2"
              >
              @csrf
                <div class="row gy-4">
                  <div class="col-md-6">
                    <input
                      type="text"
                      name="name"
                      class="form-control"
                      placeholder="Your Name"
                      required=""
                    />
                  </div>

                  <div class="col-md-6">
                    <input
                      type="email"
                      class="form-control"
                      name="email"
                      placeholder="Your Email"
                      required=""
                    />
                  </div>

                  <div class="col-md-12">
                    <input
                      type="text"
                      class="form-control"
                      name="subject"
                      placeholder="Subject"
                      required=""
                    />
                  </div>

                  <div class="col-md-12">
                    <textarea
                      class="form-control"
                      name="message"
                      rows="6"
                      placeholder="Message"
                      required=""
                    ></textarea>
                  </div>

                  <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-success">
                      Send Message
                    </button>
                  </div>
                </div>
              </form>
            </div>
            <!-- End Contact Form -->
          </div>
        </div>
      </section>
      <!-- /Contact Section -->
    </main>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const elements = document.querySelectorAll(".fade-up");

            const observer = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("animate");
                    // Kalau animasi hanya sekali, stop observing
                    observer.unobserve(entry.target);
                }
                });
            },
            {
                threshold: 0.1,
            }
            );

            elements.forEach((el) => observer.observe(el));
        });
    </script>

@endsection
