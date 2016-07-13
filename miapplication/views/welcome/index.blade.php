
    	@if(isset($posts))
        
    		@foreach($posts as $row)
            {{ $row->postTitle }}
                {{ dump($row->category->toArray())}}
            @endforeach
    	@endif
	