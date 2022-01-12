@push('after-css')
<style>
    .widget-stock{
        position: absolute;
        top: 0;
        right: 0;
        z-index: 9;

        background-color: #d68c0b;
        color: #fff;
        padding: 5px 12px;
        text-align: center;
        border-radius: 0 3px 0 40px;

        box-shadow: -8px 6px 8px -8px rgba(135,135,135,0.47);
        -webkit-box-shadow: -8px 6px 8px -8px rgba(135,135,135,0.47);
        -moz-box-shadow: -8px 6px 8px -8px rgba(135,135,135,0.47);
    }
</style>
@endpush
<span class="widget-stock"><p style="font-size: 10px;">Stocks <br> <strong style="font-size: 22px;">{{ $stock }}</strong></p></span>
