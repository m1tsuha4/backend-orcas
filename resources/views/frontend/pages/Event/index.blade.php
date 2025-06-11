@extends('frontend.layouts.app')

@section('title', 'Event | Basko Grand Mall')

@section('content')
    <main class="main">
      <!-- Page Title -->
      <div
        class="page-title text-center"
        data-aos="fade"
        style="background-image: url('{{ asset('dist_front/assets/img/title.png') }}')"
      >
        <div class="container">
          <h1 style="color: white">EVENT</h1>
        </div>
      </div>
      <!-- End Page Title -->

      <!-- Services Section -->
      <section id="portfolio" class="portfolio section">
        <div class="container">
            <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">
                <ul
                    class="portfolio-filters isotope-filters"
                    data-aos="fade-up"
                    data-aos-delay="100"
                >
                    <li data-filter="*" class="filter-active">All</li>
                    <li data-filter=".filter-ongoing">Ongoing Event</li>
                    <li data-filter=".filter-past">Past Event</li>
                </ul>

                @php
                    $ongoingEvents = $events->where('category', 'ongoing');
                    $pastEvents = $events->where('category', 'past');
                @endphp

                <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">

                    @if ($ongoingEvents->isEmpty() && $pastEvents->isEmpty())
                        <div class="col-12 portfolio-item isotope-item filter-ongoing filter-past">
                            <div class="d-flex justify-content-center">
                                <img src="{{ asset('dist_front/assets/img/nodata.jpg') }}" alt="No Data" class="img-fluid" style="max-height: 500px;">
                            </div>
                        </div>
                    @else
                        {{-- Tampilkan "No Data" jika Ongoing kosong --}}
                        @if ($ongoingEvents->isEmpty())
                        <div class="col-12 portfolio-item isotope-item filter-ongoing no-store">
                            <div class="d-flex justify-content-center">
                            <img src="{{ asset('dist_front/assets/img/nodata.jpg') }}" alt="No Data" class="img-fluid" style="max-height: 500px;">
                            </div>
                        </div>
                        @else
                        @foreach ($ongoingEvents as $event)
                            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-ongoing">
                            <a href="{{ route('front.event.show', $event->id) }}">
                                <div class="card h-100 border rounded shadow-sm" style="max-height: 19rem;">
                                {{-- Gambar dengan tanggal dan label --}}
                                <div class="position-relative">
                                    <img
                                    src="{{ asset('dist/assets/img/Events/' . explode(',', $event->img)[0] ?? '') }}"
                                    class="card-img-top"
                                    alt="Event Image"
                                    style="object-fit: cover; height: 200px"
                                    />

                                    {{-- Tanggal --}}
                                    <div class="position-absolute top-0 end-0 bg-white text-center px-2 py-1" style="margin: 10px; border-radius: 4px">
                                    <div class="fw-bold text-muted" style="font-size: 14px">
                                        {{ \Carbon\Carbon::parse($event->date_open)->format('d') }}
                                    </div>
                                    <div class="text-muted" style="font-size: 12px">
                                        {{ strtoupper(\Carbon\Carbon::parse($event->date_open)->format('M')) }}
                                    </div>
                                    </div>

                                    {{-- Label --}}
                                    <div class="position-absolute bottom-0 start-0 end-0 d-flex justify-content-center" style="margin-bottom: -12px">
                                    <div class="bg-success text-white px-3 py-1" style="border-radius: 2px; font-size: 14px; font-weight: 600;">
                                        ONGOING EVENT
                                    </div>
                                    </div>
                                </div>

                                {{-- Konten bawah --}}
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
                        @endif

                        {{-- Tampilkan "No Data" jika Past kosong --}}
                        @if ($pastEvents->isEmpty())
                        <div class="col-12 portfolio-item isotope-item filter-past no-store">
                            <div class="d-flex justify-content-center">
                            <img src="{{ asset('dist_front/assets/img/nodata.jpg') }}" alt="No Data" class="img-fluid" style="max-height: 500px;">
                            </div>
                        </div>
                        @else
                        @foreach ($pastEvents as $event)
                            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-past">
                            <a href="{{ route('front.event.show', $event->id) }}">
                                <div class="card h-100 border rounded shadow-sm" style="max-height: 19rem;">
                                {{-- Gambar dengan tanggal dan label --}}
                                <div class="position-relative">
                                    <img
                                    src="{{ asset('dist/assets/img/Events/' . explode(',', $event->img)[0] ?? '') }}"
                                    class="card-img-top"
                                    alt="Event Image"
                                    style="object-fit: cover; height: 200px"
                                    />

                                    {{-- Tanggal --}}
                                    <div class="position-absolute top-0 end-0 bg-white text-center px-2 py-1" style="margin: 10px; border-radius: 4px">
                                    <div class="fw-bold text-muted" style="font-size: 14px">
                                        {{ \Carbon\Carbon::parse($event->date_open)->format('d') }}
                                    </div>
                                    <div class="text-muted" style="font-size: 12px">
                                        {{ strtoupper(\Carbon\Carbon::parse($event->date_open)->format('M')) }}
                                    </div>
                                    </div>

                                    {{-- Label --}}
                                    <div class="position-absolute bottom-0 start-0 end-0 d-flex justify-content-center" style="margin-bottom: -12px">
                                    <div class="bg-success text-white px-3 py-1" style="border-radius: 2px; font-size: 14px; font-weight: 600;">
                                        PAST EVENT
                                    </div>
                                    </div>
                                </div>

                                {{-- Konten bawah --}}
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
                        @endif
                    @endif
                </div>
            </div>
        </div>
      </section>
      <!-- /Services Section -->
    </main>
@endsection
