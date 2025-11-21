@extends('frontend.homepage.layout')

@section('content')
    <div class="compare-page page-body">
        <div class="uk-container uk-container-center">
            <div class="compare-head uk-text-center uk-margin-large">
                <h1>Bảng so sánh sản phẩm</h1>
                <p>
                    Đã chọn
                    <strong class="compare-total-text">{{ $compareTotal }}</strong> /
                    <strong>{{ $maxCompareItems }}</strong>
                    sản phẩm. Chạm vào dấu cộng để thêm sản phẩm cần so sánh.
                </p>
            </div>

            <div class="compare-table-card">
                <div class="compare-table-wrapper" data-compare-search="{{ route('product.compare.search') }}"
                    data-compare-add="{{ route('product.compare.add') }}"
                    data-compare-remove="{{ route('product.compare.remove') }}"
                    data-compare-list="{{ route('product.compare.list') }}" data-limit="{{ $maxCompareItems }}">
                    @include('frontend.product.catalogue.component.compare-table', [
                        'compareSlots' => $compareSlots,
                        'compareFields' => $compareFields,
                    ])
                </div>
            </div>
        </div>
    </div>

    <div id="compare-modal" class="uk-modal">
        <div class="uk-modal-dialog compare-modal">
            <a class="uk-modal-close uk-close"></a>
            <h3 class="uk-text-center">Chọn sản phẩm</h3>
            <div class="compare-search-box">
                <input type="text" id="compare-search-input" class="uk-width-1-1" placeholder="Nhập tên sản phẩm để tìm"
                    autocomplete="off">
            </div>
            <div class="compare-search-results" data-empty="Không tìm thấy sản phẩm phù hợp">
                <div class="compare-search-placeholder">
                    Gõ từ khóa để bắt đầu tìm kiếm.
                </div>
            </div>
        </div>
    </div>
@endsection

<style>
    .compare-page {
        padding: 40px 0 80px;
        background: #f5f5f9;
    }

    .compare-head h1 {
        font-size: 32px;
        margin-bottom: 12px;
    }

    .compare-table-card {
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 20px 45px rgba(23, 29, 71, 0.08);
        padding: 30px;
    }

    .compare-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }

    .compare-table thead th {
        text-align: center;
        background: transparent;
        border-bottom: 1px solid #f0f0f5;
        padding: 20px 10px;
    }

    .compare-title-col {
        width: 240px;
        text-align: left !important;
        font-weight: 600;
        color: #5a5278;
        font-size: 16px;
    }

    .compare-slot {
        width: calc((100% - 240px) / 4);
        vertical-align: top;
    }

    .compare-slot-header {
        display: flex;
        flex-direction: column;
        gap: 12px;
        position: relative;
        min-height: 220px;
        padding: 10px;
    }

    .compare-slot-thumb {
        width: 120px;
        height: 120px;
        margin: 0 auto;
        border-radius: 12px;
        overflow: hidden;
        background: #faf6ff;
    }

    .compare-slot-meta {
        text-align: center;
    }

    .compare-slot-name {
        display: block;
        font-weight: 600;
        font-size: 15px;
        color: #31135e;
        line-height: 1.4;
    }

    .compare-slot-price {
        width: 100%;
        display: flex;
        justify-content: center;
    }

    .compare-slot-price .price {
        width: 100%;
        justify-content: center;
    }

    .compare-slot-empty {
        width: 110px;
        height: 110px;
        border: 1px dashed #bba7ff;
        border-radius: 16px;
        /* background: #f7f2ff; */
        color: #6c4acb;
        font-size: 14px;
        font-weight: 600;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 6px;
        transition: all .2s ease;
    }

    .compare-slot-empty:hover {
        background: #eadfff;
    }

    .compare-plus {
        display: inline-flex;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        border: 2px solid #6c4acb;
        align-items: center;
        justify-content: center;
        font-size: 24px;
    }

    .compare-remove {
        position: absolute;
        top: 10px;
        right: 10px;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        border: 0;
        background: rgba(49, 19, 94, 0.08);
        color: #31135e;
        cursor: pointer;
        transition: background .2s ease;
    }

    .compare-remove:hover {
        background: rgba(247, 28, 82, 0.15);
        color: #f71c52;
    }

    .compare-table tbody th {
        font-weight: 600;
        color: #6f6a89;
        width: 240px;
        padding: 18px 16px;
    }

    .compare-table tbody td {
        text-align: center;
        font-size: 14px;
        color: #2b2b3c;
        padding: 18px 16px;
    }

    .compare-placeholder {
        color: #c9c5dc;
        font-style: italic;
    }

    .compare-modal {
        padding: 20px 25px;
        border-radius: 18px;
        max-width: 560px;
    }

    .compare-search-box {
        margin-bottom: 15px;
    }

    .compare-search-box input {
        border-radius: 12px;
        border: 1px solid #ece8ff;
        padding: 12px 15px;
    }

    .compare-search-results {
        max-height: 360px;
        overflow-y: auto;
    }

    .compare-search-option {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 12px;
        border-radius: 12px;
        border: 1px solid transparent;
        width: 100%;
        background: #faf9ff;
        margin-bottom: 10px;
        text-align: left;
        transition: all .2s ease;
    }

    .compare-search-option:hover {
        border-color: #d9ccff;
        background: #fff;
        box-shadow: 0 6px 18px rgba(47, 20, 126, 0.08);
    }

    .compare-search-thumb {
        width: 32px;
        height: 32px;
        border-radius: 12px;
        overflow: hidden;
        background: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .compare-search-thumb img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    .compare-search-content {
        flex: 1;
    }

    .compare-search-title {
        font-weight: 600;
        margin-bottom: 4px;
        color: #2c1f4a;
    }

    .compare-search-meta {
        font-size: 13px;
        color: #8a84a6;
    }

    .compare-search-placeholder {
        text-align: center;
        color: #8c85ad;
        padding: 40px 0;
    }

    @media (max-width: 1024px) {
        .compare-title-col {
            width: 180px;
        }

        .compare-table-card {
            padding: 20px;
        }
    }

    @media (max-width: 768px) {
        .compare-table {
            display: block;
            overflow-x: auto;
        }

        .compare-slot {
            min-width: 220px;
        }

        .compare-title-col {
            min-width: 140px;
        }
    }

    .compare-slot-header,
    .compare-slot-empty {
        min-height: 2o0px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
</style>
