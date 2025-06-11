@extends('frontend.layouts.app')

@section('title', 'Store | Orcas')

@section('content')
    <main class="main">
      <!-- Page Title -->
      <div
        class="page-title text-center"
        data-aos="fade"
        style="background-image: url('{{ asset('dist_front/assets/img/title.png') }}')"
      >
        <div class="container">
          <h1 style="color: white">STORE</h1>
        </div>
      </div>
      <!-- End Page Title -->

      <!-- Portfolio Section -->
      <section id="portfolio" class="portfolio section">
        <div class="container">
          <div
            class="isotope-layout"
            data-default-filter="*"
            data-layout="masonry"
            data-sort="original-order"
          >
            <ul
              class="portfolio-filters isotope-filters"
              data-aos="fade-up"
              data-aos-delay="100"
            >
              <li data-filter="*" class="filter-active">All</li>
              @foreach ( $categories as $category )
                  <li data-filter=".filter-{{ $category->id ?? '' }}">{{ $category->category ?? '' }}</li>
              @endforeach
            </ul>
            <!-- End Portfolio Filters -->

            <div
              class="row gy-4 isotope-container"
              data-aos="fade-up"
              data-aos-delay="200"
            >
            @if ($stores->isEmpty())
                <div class="col-12 portfolio-item isotope-item filter-*">
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset('dist_front/assets/img/nodata.jpg') }}" alt="No Data" class="img-fluid" style="max-height: 500px;">
                    </div>
                </div>
            @else
                @foreach ($stores as $store)
                <div
                    class="col-lg-4 col-md-6 portfolio-item isotope-item filter-{{ $store->rCategory->id ?? '' }}"
                >
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
                    <p class="text-success small mb-1">{{ $store->rCategory->category ?? '' }}</p>
                    <h5 class="fw-bold mb-1">{{ $store->title ?? '' }}</h5>
                    <p class="mb-0 text-muted small">
                        <i class="bi bi-geo-alt-fill text-danger me-1"></i> Location
                        : {{ $store->address ?? '' }}
                    </p>
                    </div>
                </div>
                @endforeach
            @endif

            @foreach ($categories as $category)
                @php
                    $categoryStores = $stores->where('category_id', $category->id);
                @endphp

                @if ($categoryStores->isEmpty())
                    <div class="col-12 portfolio-item isotope-item filter-{{ $category->id }} no-store">
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset('dist_front/assets/img/nodata.jpg') }}" alt="No Data" class="img-fluid" style="max-height: 500px;">
                    </div>
                    </div>
                @endif
            @endforeach

              <!-- End Portfolio Item -->
            </div>
            <!-- End Portfolio Container -->
          </div>
        </div>
      </section>
      <!-- /Portfolio Section -->
    </main>
@endsection
