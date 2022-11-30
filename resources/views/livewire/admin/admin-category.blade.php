<div>
    <style>
        nav svg{
            height: 20px;
        }
        nav .hidden{
            display: block !important;
        }
    </style>
    <div class="container" style="padding:30px 0;">
        <div class="row">
        @if(session()->has('success_message'))
            <div class="alert alert-success" id="success-alert">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <strong>Success! </strong> {{session('success_message')}}
            </div>
        @endif
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">All Categories</div>
                            <div class="col-md-6"><a href="{{route('admin.categoryadd')}}" class="btn btn-success pull-right">Add New<a></div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Category Name</th>
                                    <th>Slug</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $category)
                                    <tr>
                                        <th>{{$category->id}}</th>
                                        <th>{{$category->name}}</th>
                                        <th>{{$category->slug}}</th>
                                        <td></td>
                                    </tr>
                                @endforeach
                            </tbody>               
                        </table>
                        {{$categories->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>    
</div>
