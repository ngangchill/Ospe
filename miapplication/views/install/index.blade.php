{{ dump($posts) }}

@foreach($posts['articles'] as $row)
	<h2> {{ $row->postTitle }} ({{ $row->id }}) </h2>
	<p>CatId: {{ $row->category_id }} | UserId {{ $row->user_id }} | CatName: {{ $row->category->getCatName() }} | Tags: {{ dump($row->tags->toArray()) }}</p>
	<p>{{ $row->user_id }}</p>
	<p>{{ $row->postExcerpt }}</p>
	<p>{{ $row->uri }}</p>
	<p>{!! Md::toHtml($row->postContent) !!}</p>
@endforeach

{!! $posts['links'] !!}