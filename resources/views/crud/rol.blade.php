<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
  
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
<div class="container">

    <div class="row">
        <div class="col-sm-7">
            <h3>Laravel CRUD, Search, Sort - AJAX</h3>
        </div>
        <div class="col-sm-5">
            <div class="pull-right">
                <div class="input-group">
                    <input class="form-control" email="search"
                           value="{{ request()->session()->get('search') }}"
                           onkeydown="if (event.keyCode == 13) ajaxLoad('{{url('Usuarios')}}?search='+this.value)"
                           placeholder="Search email" name="search"
                           type="text" email="search"/>
                    <div class="input-group-btn">
                        <button type="submit" class="btn btn-primary"
                                onclick="ajaxLoad('{{url('Usuarios')}}?search='+$('#search').val())">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <table class="table">
        <thead>
        <tr>

            <th width="60px">No</th>
            <th>
                <a href="javascript:ajaxLoad('{{url('Usuarios?field=email&sort='.(request()->session()->get('sort')=='asc'?'desc':'asc'))}}')">Id_rol</a>
                {{request()->session()->get('field')=='description'?(request()->session()->get('sort')=='asc'?'&#9652;':'&#9662;'):''}}
            </th>

            <th style="vertical-align: middle">
                <a href="javascript:ajaxLoad('{{url('Usuarios?field=nombre&sort='.(request()->session()->get('sort')=='asc'?'desc':'asc'))}}')">
                    Descripcion
                </a>
                {{request()->session()->get('field')=='description'?(request()->session()->get('sort')=='asc'?'&#9652;':'&#9662;'):''}}
            </th>

            <th width="160px" style="vertical-align: middle">
                <a href="javascript:ajaxLoad('{{url('Usuarios/create')}}')"
                   class="btn btn-primary btn-xs"> <i class="fa fa-plus" aria-hidden="true"></i> New Post</a>
            </th>
        </tr>
        </thead>
        <tbody>
        @php
        $i=1;
        @endphp
        @foreach ($posts as $post)
        <tr>
            <th>{{$i++}}</th>
            <td>{{ $post->id_rol }}</td>
            <td >{{ $post->descripcion }}</td>

            <td>
                <a class="btn btn-info btn-xs" title="Show"
                   href="javascript:ajaxLoad('{{url('crud/show/'.$post->id_rol)}}')">
                    Show</a>
                <a class="btn btn-warning btn-xs" title="Edit"
                   href="javascript:ajaxLoad('{{url('crud/update/'.$post->id_rol)}}')">
                    Edit</a>
                <input type="hidden" name="_method" value="delete"/>
                <a class="btn btn-danger btn-xs" title="Delete"
                   href="javascript:if(confirm('Are you sure want to delete?')) ajaxDelete('{{url('crud/delete/'.$post->id_rol)}}','{{csrf_token()}}')">
                    Delete
                </a>
            </td>
        </tr>
        @endforeach

        </tbody>
    </table>
    
</div>
<script type=text/javascript>
$('.table').each(function () {
    window.dtDefaultOptions.processing = true;
    window.dtDefaultOptions.serverSide = true;
    $(this).DataTable(window.dtDefaultOptions);
});

</script>
