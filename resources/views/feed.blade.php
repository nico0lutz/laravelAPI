@extends('layouts.app')

<style>

.feed {
    margin: auto;
    width: 50%;
}

#feed_header {
    text-align: center;
}

tr, td {
    border: 1px solid black;
    padding: 20px;
}

</style>

@section('content')
<div class="feed">
    <h1 id="feed_header"><b>Feed</b></h1><br>
    <table>
        <?php
            $posts = App\Post::orderBy('created_at', 'desc')->get();
        ?>
        @foreach ($posts as $p)
            <tr>
            <td>
                <h5>{{ $p->author }}</h5>
                <h4><b>{{ $p->title }}</b></h4>
                <p>{{ $p->content }}</p>
                <p>{{ $p->created_at }}</p>  
            </td>
            </tr>
        @endforeach
    </table>
</div>

@endsection