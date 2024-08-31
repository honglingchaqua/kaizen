@extends('layouts.vertical', ['title' => 'Swiper', 'sub_title' => 'Extended', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('css')
<!-- Swiper slider css -->
@vite(['node_modules/swiper/swiper-bundle.min.css'])
@endsection

@section('content')
<div class="flex justify-center items-center ">
    <!-- Card 1 -->
    <div class="card w-96">
        <div class="card-header flex justify-center items-center">
            <h4 class="card-title">Body Paint Promo</h4>
        </div>
        <div class="px-2 py-2">
            <div class="swiper pagination-dynamic-swiper rounded">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <img src="/images/small/img-7.jpg" alt="">
                    </div>
                    <div class="swiper-slide">
                        <img src="/images/small/img-8.jpg" alt="">
                    </div>
                    <div class="swiper-slide">
                        <img src="/images/small/img-9.jpg" alt="">
                    </div>
                </div>
                <div class="swiper-pagination dynamic-pagination"></div>
            </div>
        </div>
    </div>

    <!-- Card 2 -->
    <div class="card w-96">
        <div class="card-header flex justify-center items-center">
            <h4 class="card-title">Body Paint Promo</h4>
        </div>
        <div class="px-2 py-2">
            <div class="swiper pagination-dynamic-swiper rounded">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <img src="/images/small/img-7.jpg" alt="">
                    </div>
                    <div class="swiper-slide">
                        <img src="/images/small/img-8.jpg" alt="">
                    </div>
                    <div class="swiper-slide">
                        <img src="/images/small/img-9.jpg" alt="">
                    </div>
                </div>
                <div class="swiper-pagination dynamic-pagination"></div>
            </div>
        </div>
    </div>

    <!-- Card 3 -->
    <div class="card w-96">
        <div class="card-header flex justify-center items-center">
            <h4 class="card-title">Body Paint Promo</h4>
        </div>
        <div class="px-2 py-2">
            <div class="swiper pagination-dynamic-swiper rounded">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <img src="/images/small/img-7.jpg" alt="">
                    </div>
                    <div class="swiper-slide">
                        <img src="/images/small/img-8.jpg" alt="">
                    </div>
                    <div class="swiper-slide">
                        <img src="/images/small/img-9.jpg" alt="">
                    </div>
                </div>
                <div class="swiper-pagination dynamic-pagination"></div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<!-- Swiper slider js -->
@vite(['resources/js/pages/extended-swiper.js'])
@vite(['resources/js/pages/highlight.js'])
@endsection
