<x-header />
<x-navbar />
<body>
    <div class="text-center page">
        <h1 class="text-center">Edit Task</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session()->get('mssg'))
            <div class="alert alert-primary my-5" role="alert">{{session()->get('mssg')}}</div>
        @endif
        <form action="{{url('/Task/'.$data->id)}}" method="post" enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="form-group my-4">
                <label>Title</label>
                <input class="form-control  mx-auto"  placeholder="enter your name" name="title" value={{ $data->title }}>
            </div>

            <div class="form-group my-4">
                <label>Content</label>
                <input class="form-control  mx-auto"  placeholder="enter your email" name="content" value={{ $data->content }}>
            </div>

            <div class="form-group my-4">
                <label>Start Date</label>
                <input class="form-control  mx-auto"  type="date" name="startDate" value={{ $data->startDate }}>
            </div>

            <div class="form-group my-4">
                <label>End Date</label>
                <input class="form-control  mx-auto"  type="date" name="endDate" value={{ $data->endDate }}>
            </div>

            <div class="form-group my-4">
                <label>Image</label>
                <img width="100" height="100" src="{{ asset('/uploads/' . $data->image) }}">
                <input class="form-control  mx-auto"  type="file" name="image" >
            </div>

            <button class="btn btn-primary my-5">Edit Task</button>
        </form>
    </div>
</body>
<x-footer />
