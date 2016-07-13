@if (count($projects) > 0)
<ul>
    @foreach ($projects as $project)
    @include('partials.project', $project)
    @endforeach
</ul>
@else
@include('partials.projects-none')
@endif






partials/project.blade.php




<li>{{ $project['name'] }}</li>
@if (count($project['children']) > 0)
<ul>
    @foreach($project['children'] as $project)
    @include('partials.project', $project)
    @endforeach
</ul>
@endif


@include('layouts.partials.form.open', ['class' => 'form-horizontal'])
    <!-- Email -->
    @include('layouts.partials.form.input', [
    'name' => 'email', 
    'type' => 'email',
    'label' => 'Email:*',
    ])
    <!-- First Name -->
    @include('layouts.partials.form.input', ['name' => 'first_name','label' => 'First Name', 'disabled' => 'disabled'])
    @include('layouts.partials.form.textarea', ['lname' => 'last_name','value' => 'Last Name'])
    @include('layouts.partials.form.input', ['name' => 'first_name','label' => 'First Name','horizontal' => 'yes'])
    @include('layouts.partials.form.select', [
    'name' => 'size', 
    'values' => ['S' => 'Small', 'M' => 'Medium', 'L' => 'Large'],
    'label' => 'Shirts',
    'extra' => 'onchange="getval(this);"',
    ])