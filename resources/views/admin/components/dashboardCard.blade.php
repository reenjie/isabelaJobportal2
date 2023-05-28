<div class="dashboardCard mb-3 h-100" style="{{$style}}">
    <span class="icon"><i class="{{$iconClass}}"></i></span>
    <div class="card-body">
        <h5>{{$title}}
        @isset($extra)
            <br>
            <span style="font-size:12px;font-weight:normal">{{$extra}}</span>
        @endisset
        </h5>
        <span>{{$data}}</span>
    </div>
</div>