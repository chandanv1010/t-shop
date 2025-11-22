<form action="{{ route('order.index') }}">
    <div class="filter-wrapper">
        <div class="uk-flex uk-flex-middle uk-flex-space-between">
            <div class="uk-flex uk-flex-middle">
                @include('backend.dashboard.component.perpage')
                <div class="date-item-box">
                    <input type="type" name="created_at" readonly
                        value="{{ request('created_at') ?: old('created_at') }}" class="rangepicker form-control"
                        placeholder="Click chọn ngày">
                </div>
            </div>
            <div class="action">
                <div class="uk-flex uk-flex-middle">
                    <div class="mr10">
                        <button data-toggle="modal" data-target="#exportExcelBtn" type="button" name=""
                            class="btn btn-primary mr10">
                            <i class="fa fa-file-excel-o mr5"></i>Xuất Excel
                        </button>
                        @foreach (__('cart') as $key => $val)
                            @php
                                ${$key} = request($key) ?: old($key);
                            @endphp
                            <select name="{{ $key }}" class="form-control setupSelect2 ml10">
                                @foreach ($val as $index => $item)
                                    <option {{ ${$key} == $index ? 'selected' : '' }} value="{{ $index }}">
                                        {{ $item }}</option>
                                @endforeach
                            </select>
                        @endforeach
                    </div>
                    @include('backend.dashboard.component.keyword')
                </div>
            </div>
        </div>
    </div>
</form>
<div id="exportExcelBtn" class="modal fade">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Dữ liệu đơn hàng</h3>
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span
                    class="sr-only">Close</span></button>
        </div>
        <div class="date-inputs">
            <div class="date-input-group">
                <label for="startDate">Từ ngày</label>
                <input type="date" name="startDate" id="startDate" required>
            </div>
            <div class="date-input-group">
                <label for="endDate">Đến ngày</label>
                <input type="date" name="endDate" id="endDate" required>
            </div>
        </div>
        <div class="modal-actions">
            <button type="button" class="btn btn-white" data-dismiss="modal">Hủy</button>
            <button class="btn btn-excel" id="confirmExport" data-model="Order">
                <i class="fa fa-download"></i> Xuất Excel
            </button>
        </div>
    </div>
</div>
<script>
    document.getElementById('startDate').valueAsDate = new Date();
    document.getElementById('endDate').valueAsDate = new Date();
</script>
