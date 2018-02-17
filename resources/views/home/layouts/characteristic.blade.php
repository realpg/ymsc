<div class="container line-height-40">
    商城 > <a href="{{URL::asset($column)}}">{{$channel['name']}}</a>
</div>
<div class="border-top-attribute">
    <div class="container">
        @foreach($attributes as $k=>$attribute)
            <div class="line-height-40 style-ellipsis-1 border-bottom-attribute">
                <span class="padding-right-10 border-right-attribute height-14">{{$attribute['name']}} </span>
                @if($k==0)
                    @if($s_attribute_id)
                        <a href="{{URL::asset($column.'/search/f/0/s/'.$s_attribute_id)}}?search={{$search}}" >
                    @else
                        <a href="{{URL::asset($column.'/search/')}}?search={{$search}}" >
                    @endif
                @else
                    @if($f_attribute_id)
                        <a href="{{URL::asset($column.'/search/f/'.$f_attribute_id.'/s/0')}}?search={{$search}}" >
                    @else
                        <a href="{{URL::asset($column.'/search/')}}?search={{$search}}" >
                    @endif
                @endif
                        <span class="margin-right-10 margin-left-10 padding-right-10 padding-left-10 radius-20 text-white background-navy-blue">全部</span>
                    </a>
                @foreach($attribute['attributes'] as $attribute['attribute'])
                    @if($k==0)
                        @if($s_attribute_id)
                            <a href="{{URL::asset($column.'/search/f/'.$attribute['attribute']['id'].'/s/'.$s_attribute_id)}}?search={{$search}}" >
                        @else
                            <a href="{{URL::asset($column.'/search/f/'.$attribute['attribute']['id'].'/s/0')}}?search={{$search}}" >
                        @endif
                    @else
                        @if($f_attribute_id)
                            <a href="{{URL::asset($column.'/search/f/'.$f_attribute_id.'/s/'.$attribute['attribute']['id'])}}?search={{$search}}" >
                        @else
                            <a href="{{URL::asset($column.'/search/f/0/s/'.$attribute['attribute']['id'])}}?search={{$search}}" >
                        @endif
                    @endif
                        @if($attribute['attribute']['id']==$f_attribute_id||$attribute['attribute']['id']==$s_attribute_id)
                            <span class="margin-right-10 text-red">{{$attribute['attribute']['name']}}</span>
                        @else
                            <span class="margin-right-10">{{$attribute['attribute']['name']}}</span>
                        @endif
                    </a>
                @endforeach
            </div>
        @endforeach
    </div>
</div>