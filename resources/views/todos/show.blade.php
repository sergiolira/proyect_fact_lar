@extends('app')
@section('content')
    <div class="container w-25 border p-4 mt-4">
        <form method="POST" action="{{ route('todos-update', ['id' => $todo->id]) }}">
            @method('PATCH')
            @csrf
            @if (session('success'))
                <h6 class="alert alert-success">{{ session('success') }}</h6>
            @endif

            @error('title')
            <h6 class="alert alert-danger">{{ $message }}</h6>
            @enderror
            <div class="mb-3">
                <label for="title" class="form-label">Titulo de la tarea</label>
                <input type="text" class="form-control" name='title' id="title" value="{{ $todo->title }}">
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">Categoria de la tarea</label>
                <select name="category_id" id="category_id" class="form-control">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" 
                            {{ $todo->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>                         
                    @endforeach
                </select>                
            </div>
        
            <button type="submit" class="btn btn-primary">Actualizar tarea</button>
        </form>
    </div>
@endsection  