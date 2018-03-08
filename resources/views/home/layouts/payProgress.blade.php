<div class="container">
    <div class="style-home-header">
        <div class="col-xs-12 col-sm-4 col-lg-4 text-left">
            <img src="{{ URL::asset($common['base']['logo_page']) }}"  />
        </div>
        <div class="col-xs-12 col-sm-8 col-lg-8 text-right margin-top-5" id="pay_progress">
            @if($progress==1)
                <img src="{{ URL::asset('img/pay_1.png') }}"  />
            @elseif($progress==2)
                <img src="{{ URL::asset('img/pay_2.png') }}"  />
            @elseif($progress==3)
                <img src="{{ URL::asset('img/pay_3.png') }}"  />
            @endif
        </div>
    </div>
</div>