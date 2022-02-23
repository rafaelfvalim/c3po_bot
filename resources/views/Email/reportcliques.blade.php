<div><p>#Report Clicks C-3PO</p></div>
<div>
    <table align="center" border="1" cellpadding="0" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Descrição</th>
            <th>Url</th>
            <th>Shorurl</th>
            <th>Clicks</th>
        </tr>
        </thead>
        <tbody>
        @foreach($posts as $post)
            <tr>
                <td>{{$post->descricao}} </td>
                <td><a href="{{$post->url}}">{{$post->url}}</a></td>
                <td><a href="{{$post->shorturl}}">{{$post->shorturl}}</a> </td>
                <td align="center">{{$post->clicks}} </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<div>
    <p>Ao seu dispor {{ config('app.name') }}</p>
</div>


