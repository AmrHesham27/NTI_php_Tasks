<x-header />
<x-navbar />
<div class="page">
<h1 class="text-center">My Tasks</h1>
@if (session()->get('mssg'))
    <div class="alert alert-primary my-5" role="alert">{{session()->get('mssg')}}</div>
@endif

<table class="table table-striped table-bordered">
    @if ( count($data) == 0 )
        <p>you do not have tasks yet.</p>
    @else
        <thead>
            <tr>
                <th scope="col">Title</th>
                <th scope="col">Content</th>
                <th scope="col">Start Date</th>
                <th scope="col">End Date</th>
                <th scope="col">Image</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($data as $task)
            <tr scope="row">
                <td>{{ $task->title }}</td>
                <td>{{ $task->content }}</td>
                <td>{{ $task->startDate }}</td>
                <td>{{ $task->endDate }}</td>
                <td> <img width="100" height="100" src={{ asset('uploads/'.$task->image) }}> </td>
                <td class="d-flex flex-row">
                    <a href={{'Task/'.$task->id.'/edit'}} class="btn btn-primary mx-2">Edit</a>
                    <form action={{ url('/Task/' . $task->id) }} method="post" class="mx-2">
                        @method('delete')
                        @csrf
                        <input type="hidden" name="endDate" value={{$task->endDate}} readonly>
                        <button class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    @endif
</table>
</div>
<x-footer/>


