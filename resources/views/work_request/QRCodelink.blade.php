<div class="card">
    <div class="card-body text-center"> 
        <div class="qr-main-image">
            <div class="qr-code-border">
                <img src="{{asset('public/custom/img/left-top.svg')}}" alt="left-top" class="img-fluid left-top-border">
                <img src="{{asset('public/custom/img/left-bottom.svg')}}" alt="left-bottom" class="img-fluid left-bottom-border">
                <img src="{{asset('public/custom/img/right-top.svg')}}" alt="right-top" class="img-fluid right-top-border">
                <img src="{{asset('public/custom/img/right-bottom.svg')}}" alt="right-bottom" class="img-fluid right-bottom-border">
            </div>
            <div class="qrcode"></div>
        </div>
        <div class="text">
            <p>{{__('Point your camera at the QR code, or visit')}}</p>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('.qrcode').qrcode("{{route('work_request.portal',\Illuminate\Support\Facades\Crypt::encrypt($id))}}");
</script>