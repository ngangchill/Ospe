<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title"> 
            <span class="glyphicon glyphicon-user"></span>
            {!! $panel_title !!}</h3>
    </div>
    <div class="panel-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Group Name</th>
                    <th>Name</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                @if(isset($groups))
                @foreach($panel_body as $group)
                <tr>
                    <td>{!! $group->id !!}</td>
                    <td>{!! anchor('groups/users/'.$group->id,$group->name) !!}</td>
                    <td>{!! $group->description !!}</td>
                    <td>
                        {!! anchor(Route::named('groups').'/edit/'.$group->id, '<span class="glyphicon glyphicon-edit"></span> Edit ')!!}                           
                            @if(!in_array($group->name, array('admin','members')))
                            {!! anchor(Route::named('groups').'/delete/'.$group->id, '    <span class="glyphicon glyphicon-warning-sign"></span> Delete')!!}
                            @endif      
                    </td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td></td>
                    <td>sss</td>
                    <td></td>
                    <td></td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>