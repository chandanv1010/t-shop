<div class="uk-overflow-container">
    <table class="uk-table uk-table-striped uk-table-middle compare-table">
        <thead>
            <tr>
                <th class="compare-title-col">Sản phẩm</th>
                @foreach ($compareSlots as $slot)
                    <th class="compare-slot" data-position="{{ $slot['position'] }}">
                        @if ($slot['product'])
                            <div class="compare-slot-header uk-flex uk-flex-column uk-flex-center">
                                <button type="button" class="compare-remove uk-position-absolute"
                                    data-rowid="{{ $slot['rowId'] }}" data-position="{{ $slot['position'] }}"
                                    aria-label="Bỏ sản phẩm">
                                    <i class="fa fa-times"></i>
                                </button>
                                <div class="compare-slot-thumb image img-scaledown uk-margin-small-bottom">
                                    <img src="{{ $slot['product']['image'] }}" alt="{{ $slot['product']['name'] }}">
                                </div>
                                <div class="compare-slot-meta uk-width-1-1">
                                    <a href="{{ $slot['product']['canonical'] }}"
                                        class="compare-slot-name uk-display-block uk-text-center" target="_blank"
                                        rel="noopener">
                                        {{ $slot['product']['name'] }}
                                    </a>
                                    <div class="compare-slot-price uk-flex uk-flex-center uk-width-1-1">
                                        {!! $slot['product']['price_html'] !!}
                                    </div>
                                </div>
                            </div>
                        @else
                            <button type="button"
                                class="compare-slot-empty open-compare-modal uk-flex uk-flex-column uk-flex-center uk-flex-middle"
                                data-position="{{ $slot['position'] }}">
                                <span class="compare-plus uk-display-inline-flex uk-flex-center uk-flex-middle">+</span>
                                <span>Thêm sản phẩm</span>
                            </button>
                        @endif
                    </th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($compareFields as $field)
                <tr>
                    <th class="uk-text-left">{{ $field['label'] }}</th>
                    @foreach ($compareSlots as $slot)
                        <td class="uk-text-center">
                            @if ($slot['product'] && isset($slot['product']['fields'][$field['key']]))
                                <div class="compare-field-content">
                                    @if (($field['type'] ?? 'text') === 'html')
                                        {!! $slot['product']['fields'][$field['key']] !!}
                                    @else
                                        {{ $slot['product']['fields'][$field['key']] }}
                                    @endif
                                </div>
                            @else
                                <span class="compare-placeholder">—</span>
                            @endif
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

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
        table-layout: fixed;
    }

    .compare-table thead th {
        text-align: center;
        background: transparent;
        border-bottom: 1px solid #f0f0f5;
        padding: 20px 10px;
        vertical-align: top;
    }

    .compare-title-col {
        width: 240px !important;
        min-width: 240px;
        max-width: 240px;
        text-align: left !important;
        font-weight: 600;
        color: #5a5278;
        font-size: 16px;
    }

    .compare-slot {
        width: calc((100% - 240px) / 4) !important;
        min-width: calc((100% - 240px) / 4);
        max-width: calc((100% - 240px) / 4);
        vertical-align: top;
        padding: 10px !important;
    }

    .compare-slot-header {
        display: flex;
        flex-direction: column;
        gap: 12px;
        position: relative;
        min-height: 280px;
        padding: 10px;
        align-items: center;
        justify-content: flex-start;
        width: 100%;
    }

    .compare-slot-thumb {
        width: 120px;
        height: 120px;
        margin: 0 auto;
        border-radius: 12px;
        overflow: hidden;
        background: #faf6ff;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .compare-slot-thumb img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    .compare-slot-meta {
        text-align: center;
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 8px;
    }

    .compare-slot-name {
        display: block;
        font-weight: 600;
        font-size: 15px;
        color: #31135e;
        line-height: 1.4;
        width: 100%;
        word-wrap: break-word;
        overflow-wrap: break-word;
        hyphens: auto;
    }

    .compare-slot-price {
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .compare-slot-price .price {
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-wrap: wrap;
        gap: 8px;
    }

    .compare-slot-price .price>* {
        display: inline-flex;
        justify-content: center;
    }

    .compare-slot-empty {
        width: 100%;
        min-height: 280px;
        border: 1px dashed #bba7ff;
        border-radius: 16px;
        background: transparent;
        color: #6c4acb;
        font-size: 14px;
        font-weight: 600;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 6px;
        transition: all .2s ease;
        cursor: pointer;
    }

    .compare-slot-empty:hover {
        background: #eadfff;
    }

    .compare-plus {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        border: 2px solid #6c4acb;
        font-size: 24px;
        line-height: 1;
    }

    .compare-remove {
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
        z-index: 10;
    }

    .compare-remove:hover {
        background: rgba(247, 28, 82, 0.15);
        color: #f71c52;
    }

    .compare-table tbody th {
        font-weight: 600;
        color: #6f6a89;
        width: 240px !important;
        min-width: 240px;
        max-width: 240px;
        padding: 18px 16px;
    }

    .compare-table tbody td {
        text-align: center;
        font-size: 14px;
        color: #2b2b3c;
        padding: 18px 16px;
        vertical-align: middle;
        width: calc((100% - 240px) / 4) !important;
        min-width: calc((100% - 240px) / 4);
        max-width: calc((100% - 240px) / 4);
    }

    .compare-field-content {
        width: 100%;
        word-wrap: break-word;
        overflow-wrap: break-word;
        hyphens: auto;
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
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
        cursor: pointer;
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

    .price-old {
        text-decoration: line-through;
        margin: 0 5px
    }

    @media (max-width: 1024px) {

        .compare-title-col,
        .compare-table tbody th {
            width: 180px !important;
            min-width: 180px;
            max-width: 180px;
        }

        .compare-slot,
        .compare-table tbody td {
            width: calc((100% - 180px) / 4) !important;
            min-width: calc((100% - 180px) / 4);
            max-width: calc((100% - 180px) / 4);
        }

        .compare-table-card {
            padding: 20px;
        }
    }

    @media (max-width: 768px) {
        .compare-slot {
            min-width: 220px !important;
        }

        .compare-title-col {
            min-width: 140px !important;
        }
    }
</style>
