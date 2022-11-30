@extends('layout')

@section('content')
<div class="wrapper bg-white">
    @if (Session::get('done'))
			<div class="alert alert-success ">
				{{ Session::get('done') }}
			</div>
	@endif
    <div class="d-flex align-items-start justify-content-between">
        <div class="d-flex flex-column">
            <div class="h5">My Complated Todo's</div>
            <p class="text-muted text-justify">
                Here's a list of activities you have done
                <br>
                <a href="/todo/">Back</a>
            </p>
        </div>
        <div class="info btn ml-md-4 ml-0">
            <span class="fa-solid fa-check" title="complated"></span>
        </div>
    </div>
    <div class="work border-bottom pt-3">
        <div class="d-flex align-items-center py-2 mt-1">
            <div>
                <span class="text-muted fas fa-comment btn"></span>
            </div>
            <div class="text-muted">{{ !is_null($todos) ? count ($todos) : '-'}} complated todos</div>
            <button class="ml-auto btn bg-white text-muted fas fa-angle-down" type="button" data-toggle="collapse"
                data-target="#comments" aria-expanded="false" aria-controls="comments"></button>
        </div>
    </div>
    <div id="comments" class="mt-1">
        @foreach ($todos as $todo)
            <div class="comment d-flex align-items-start justify-content-between">
                <div class="mr-2">
                    {{-- <form action="/todo/complated/{{$todo['id']}}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="fas fa-check" style="background: rgb(255, 255, 255); padding:0% !importan;"></button>
                    </form> --}}
                    {{-- <label class="option">
                        <input type="checkbox">
                        <span class="checkmark"></span>
                    </label> --}}
                </div>
                <div class="d-flex flex-column w-75">
                    <a href="/todo/edit/{{$todo['id']}}"class="text-justify font-weight-bold text-decoration-none">
                      {{$todo['title']}}
                    </a>
                    <p class="text-muted"> {{$todo['status'] ? 'complated' : 'On-progres'}} <span class="date">{{\Carbon\Carbon::parse($todo['date'])->format('j F, Y')}}</span></p>
                </div>
                <div class="ml-auto">
                <form action="{{route('todo.delete', $todo['id'])}}" method="POST">
                    @csrf
                    @method('DELETE')
                <button type="submit" class="fas fa-trash text-danger btn"></button>
                </form>
                {{--<span class="fas fa-arrow-right btn"></span>--}}
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection