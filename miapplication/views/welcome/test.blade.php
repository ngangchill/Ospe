@extends('layouts.default')
	


	@section('content')

		<link href="{{ base_url() }}assets/trevor/sir-trevor.css" rel="stylesheet">
		<link href="{{ base_url() }}assets/trevor/sir-trevor-bootstrap.css" rel="stylesheet">
		<link href="{{ base_url() }}assets/trevor/sir-trevor-icons.css" rel="stylesheet">
		<link href="{{ base_url() }}assets/datepicker/jquery.datetimepicker.css" rel="stylesheet">	

		<form action="http://hoosk.dev/admin/posts/edited/1" id="contentForm" method="post" accept-charset="utf-8">
						<textarea name="content" cols="40" rows="10" id="content" class="js-st-instance" >{&quot;data&quot;:[{&quot;type&quot;:&quot;columns&quot;,&quot;data&quot;:{&quot;columns&quot;:[{&quot;width&quot;:6,&quot;blocks&quot;:[{&quot;type&quot;:&quot;text&quot;,&quot;data&quot;:{&quot;text&quot;:&quot;Brain freeze. Kinda hot in these rhinos. Here she comes to wreck the day. Brain freeze. Excuse me, I&#039;d like to ASS you a few questions. We&#039;re going for a ride on the information super highway. Your entrance was good, his was better. Kinda hot in these rhinos. It&#039;s because i&#039;m green isn&#039;t it! Here she comes to wreck the day. Alrighty Then Excuse me, I&#039;d like to ASS you a few questions. \n&quot;}}]},{&quot;width&quot;:6,&quot;blocks&quot;:[{&quot;type&quot;:&quot;text&quot;,&quot;data&quot;:{&quot;text&quot;:&quot;Your entrance was good, his was better. We got no food we got no money and our pets heads are falling off! Haaaaaaarry. Look at that, it&#039;s exactly three seconds before I honk your nose and pull your underwear over your head. It&#039;s because i&#039;m green isn&#039;t it! Hey, maybe I will give you a call sometime. Your number still 911? Excuse me, I&#039;d like to ASS you a few questions. \n&quot;}}]}],&quot;preset&quot;:&quot;columns-6-6&quot;}}]}</textarea>
					
                    <div class="form-actions">
                    <a class="btn btn-primary" data-toggle="modal" href="#attributes">Next</a>
					<a class="btn" href="http://hoosk.dev/admin/posts">Cancel</a>

					</div>
					</form>
	@endsection

	@section('footer')
	<script src="{{ base_url() }}assets/datepicker/jquery.datetimepicker.js"></script>
<script src="{{ base_url() }}assets/trevor/underscore.js"></script>
<script src="{{ base_url() }}assets/trevor/eventable.js"></script>
<script src="{{ base_url() }}assets/trevor/sortable.min.js"></script>
<script src="{{ base_url() }}assets/trevor/sir-trevor.js"></script>
<script src="{{ base_url() }}assets/trevor/sir-trevor-bootstrap.js"></script>
<script src="{{ base_url() }}assets/js/markdown.js"></script>

<script type="text/javascript">
	new SirTrevor.Editor({ el: $('.js-st-instance'),
  	blockTypes: ["Columns", "Heading", "Text", "ImageExtended", "Quote", "Accordion", "Button", "Video", "List", "Iframe","Markdown"]
	});
</script>
@endsection