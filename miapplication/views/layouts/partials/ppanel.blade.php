<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title"> 
            <span class="glyphicon glyphicon-globe"></span>
            {!! $ppanel_title !!}</h3>
    </div>
    <div class="panel-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Parent</th>
                    <th>Order</th>
                    <th>Name</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ppanel_body as $row)
                <tr>
                    <td>{{ $row->id }}</td>
                    <td>{{ $row->inherit_id or 'No parent' }}</td>
                    <td>{{ $row->order }}</td>
                    <td>{{ $row->name }}</td>
                    <td>{{ $row->description }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>