<div class="container line-height-40 style-ellipsis-1">
    {{--<div class="border-bottom-attribute">--}}
        <a href="{{URL::asset('/')}}">商城</a> > <a href="{{URL::asset($column)}}">{{$channel['parent_channel']['name']}}</a> > {{$channel['name']}}
    {{--</div>--}}
</div>
<div class="border-top-attribute">
{{--<div>--}}
    <div class="container">
        @foreach($attributes as $k=>$attribute)
            <div class="line-height-40 style-ellipsis-1 border-bottom-attribute">
                <span class="padding-right-10 border-right-attribute height-14">{{$attribute['name']}} </span>
                @if($k==0)
                    @if($s_attribute_id)
                        <a href="{{URL::asset($column.'/lists/'.$channel['id'].'/f/0/s/'.$s_attribute_id)}}" >
                    @else
                        <a href="{{URL::asset($column.'/lists/'.$channel['id'])}}" >
                    @endif
                @else
                    @if($f_attribute_id)
                        <a href="{{URL::asset($column.'/lists/'.$channel['id'].'/f/'.$f_attribute_id.'/s/0')}}" >
                    @else
                        <a href="{{URL::asset($column.'/lists/'.$channel['id'])}}" >
                    @endif
                @endif
                            <span class="margin-right-10 margin-left-10 padding-right-10 padding-left-10 radius-20 text-white background-navy-blue">全部</span>
                        </a>
                @foreach($attribute['attributes'] as $attribute['attribute'])
                    @if($k==0)
                        @if($s_attribute_id)
                            <a href="{{URL::asset($column.'/lists/'.$channel['id'].'/f/'.$attribute['attribute']['id'].'/s/'.$s_attribute_id)}}" >
                        @else
                            <a href="{{URL::asset($column.'/lists/'.$channel['id'].'/f/'.$attribute['attribute']['id'].'/s/0')}}" >
                        @endif
                    @else
                        @if($f_attribute_id)
                            <a href="{{URL::asset($column.'/lists/'.$channel['id'].'/f/'.$f_attribute_id.'/s/'.$attribute['attribute']['id'])}}" >
                        @else
                            <a href="{{URL::asset($column.'/lists/'.$channel['id'].'/f/0/s/'.$attribute['attribute']['id'])}}" >
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