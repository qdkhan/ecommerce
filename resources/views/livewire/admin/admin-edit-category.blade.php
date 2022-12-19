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
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                Edit Category
                            </div>
                            <div class="col-md-d">
                                <a href="{{route('admin.category')}}" class="btn btn-success pull-right">All Category</a>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                    @if(session()->has('success_message'))
                        <div class="alert alert-success" id="success-alert">
                            <button type="button" class="close" data-dismiss="alert">x</button>
                            <strong>Success! </strong> {{session('success_message')}}
                        </div>
                    @endif
                        <form action="" class="form-horizontal" wire:submit.prevent="updateCategory">
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="name">Category Name</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control input-md" id="name" placeholder="Category Name" wire:model="name" wire:keyup="generateSlug()"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="slug">Category Slug</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control input-md" id="slug" placeholder="Category Slug" wire:model="slug"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label"></label>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>    
</div>
