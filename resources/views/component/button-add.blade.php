<button class="btn btn-success btn-round" id="btnCreate" @if(Session::has('display')) style="margin-bottom: 20px; display: none;" @else style="margin-bottom: 20px; display: block;" @endif><i
        class="fa fa-plus"></i>&nbsp;&nbsp; <strong>@yield('button-title')</strong> </button>