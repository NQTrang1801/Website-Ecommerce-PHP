@extends('layouts.app-home')

@section('styles')
    <base href="/public">
    <link rel="stylesheet" href="home/styles/pages/product-detail.css">
@endsection

@section('content')
    <main class="main-product-detail">
        <div class="button-back">
            <i class="ri-arrow-left-line"></i>
            Back
        </div>
        <div class="product-detail-container">
            @include('home.product detail.products-detail-data')
            @include('home.product detail.products-details-partner')
            <div></div>
            @include('home.product detail.products-detail-exploring')
        </div>
    </main>

@endsection

@section('scripts')
    <script type="module" src="home/scripts/index.js"></script>
    <script type="module" src="home/scripts/product-detail.js"></script>
    <script>
        $(document).ready(function() {
            let selectedColorId = '';
            let selectedSizeId = '';
            let productId = $('#product-id').data('product-id');
            console.log(productId);
            $('.block-color').click(function () {
                $('.block-color').removeClass('active-color').css('opacity', '0.5');
                $(this).addClass('active-color').css('opacity', '1');

                const selectedColorId = $(this).find('img').attr('data-color-id');
                const selectedColorName = $(this).find('img').attr('data-content');
                colorId = selectedColorId;
                $('#active-color-name').text(selectedColorName);
                $('.product-size > div').hide();
                $(`.group-color-${selectedColorId}`).show();
                const defaultSize = $(`.group-color-${selectedColorId} > div:first-child`);
                defaultSize.click();
            });

            $('.color-selector').click(function() {
                let colorId = $(this).data('color-id');
                selectedColorId = colorId;
                selectedSizeId = '';
                let colorName = $(this).data('color-name');
                let colorCode = $(this).data('color-code');
                $(this).css('border-bottom', `2px solid ${colorCode}`);
                $('#color-name').html(colorName);
                console.log(productId + " :: " + colorId);
                $.ajax({
                    type: 'GET',
                    url: '/get-sizes-by-color/' + productId + '/' + colorId, 
                    success: function(data) {
                            var sizelist =  $('#size-list');
                            sizelist.empty();
                            console.log(data['sizes']);
                            
                            $.each(data['sizes'], function(index, value) {
                                sizelist.append(`<div class="group-color-${colorId}" data-size-id=${value.id}>` + value.name + '</div>');
                            });
                            
                            $(`.group-color-${colorId}`).click(function() {
                                $(`.group-color-${colorId}`).css('border-bottom', `1px solid`);
                                $(this).css('border-bottom', `2px solid ${colorCode}`);
                                selectedSizeId = $(this).data('size-id');
                            });

                    },
                    error: function(xhr, status, error) {
                        console.error('Lỗi khi lấy sizes: ' + error);
                    }
                });
            });

            $(`.js-btn-add-cart`).click(function() {
                if (selectedColorId != '')
                {
                    if (selectedSizeId != '')
                    {
                        console.log(productId + " " + selectedColorId + " " + selectedSizeId);
                        addToCart(productId, selectedColorId, selectedSizeId);
                    }
                    else
                    {
                        alert('please select size!');
                    }
                }
                else
                {
                    alert('please select color!');
                }
            });
        
    });
    </script>
@endsection