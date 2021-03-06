@extends('layouts.app')
@section('headerText')
    {{-- 結果タイトルにて、日付を指定したときは、その日付、何も指定していないときは「今日のライブ」を表示させる--}}
    @if(!empty($date))
        <h3>
            {{-- 日付のフォーマット変換--}}
            {{ date('m月d日',  strtotime($date)) }}のライブ
        </h3>
    @else
        <h3>
            今日のライブ
        </h3>
    @endif
@endsection
@section('content')
    <!-- Start Sample Area -->
    <div class="container box_1170">
        <div class="container">
            <div class="row">
                {{--レスポンシブデザインでデスクトップ中以上なら横に配置、未満なら上下に配置--}}
                <div class="col-md-8" id="map" style="height:500px"></div>
                <div class="col-md-4">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>title</th>
                            <th>アーティスト</th>
                            <th>会場</th>
                            <th>日にち</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($lives as $live)
                            <tr>
                                <td>{!! link_to_route('lives.show', $live->title, ['live' => $live->id]) !!}</td>
                                <td>{{ $live->artist }}</td>
                                <td>{{ $live->venue }}</td>
                                <td>{{ $live->date }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <br>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2>もう一度検索する</h2>
                    {!! Form::open(['route' => 'lives.result','method' => 'get']) !!}

                    <div class="form-group row">
                        {!! Form::label('freeword', 'フリーワード:',['class'=>"col-md-2 col-form-label"]) !!}
                        {!! Form::text('freeword', old('title'), ['class' => 'col-md-10 form-control','placeholder' => 'フリーワード']) !!}
                    </div>

                    {{--$dateで前検索で用いた日にちをデフォルトで表示させる--}}
                    <div class="form-group row">
                        {!! Form::label('date', '日にち:',['class'=>"col-md-2 col-form-label date"]) !!}
                        {!! Form::date('date', $date, ['class' => 'col-md-10 form-control']) !!}
                    </div>

                    {{--隠しフォームでlivescontrollerに位置情報を渡す--}}
                    {{--lat用--}}
                    {!! Form::hidden('lat','lat',['class'=>'lat_input']) !!}
                    {{--lng用--}}
                    {!! Form::hidden('lng','lng',['class'=>'lng_input']) !!}

                    {{--デフォルトで全カテゴリーを設定した状態で検索する--}}
                    <div class="form-group row">
                        {!! Form::label('category', 'カテゴリー:',['class'=>"col-md-2 col-form-label"]) !!}
                        {!! Form::select('category',
                            ['ポップス' => 'ポップス', 'ロック' => 'ロック', 'ヒップホップ' => 'ヒップホップ',
                             'レゲエ' => 'レゲエ','ジャズ' => 'ジャズ','パンク' => 'パンク','テクノ' => 'テクノ',
                             'ハウス' => 'ハウス','R&B' => 'R&B',
                             ] ,
                            old('category'), ['class' => 'col-md-10 form-control' ,'placeholder' => 'すべてのカテゴリー']) !!}
                    </div>
                    {{--setlocation.jsを読み込んで、位置情報取得するまで押せないようにdisabledを付与し、非アクティブにする。--}}
                    {{--その後、disableはfalseになるようにsetlocation.js内に記述した--}}
                    <div class="btn-wrapper">
                        {!! Form::submit('検索',['class' => 'btn btn-primary','disabled']) !!}
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('/js/SetLocation.js') }}"></script>
    <script>
        // result.jsで使用する定数livesに、controllerで定義した$livesの各要素を配列にして、json形式にし、result.jsに渡す
        const lives = @json($lives->toArray());

        // result.jsで使用する定数latに、controllerで定義した$latをいれて、result.jsに渡す
        const lat = {{ $lat }};

        // result.jsで使用する定数lngに、controllerで定義した$lngをいれて、result.jsに渡す
        const lng = {{ $lng }};
    </script>
    <script src="{{ asset('/js/result.js') }}"></script>
    {{--    上記の処理をしてから、googleMapを読み込まないとエラーが出てくる--}}
    <script
        src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key=AIzaSyAvw2VOhcVODwrVjPHQ5Q0kGxWKICqx2QA&callback=initMap"
        async defer></script>
@endsection
