@extends('panel.app')

@section('content')
    <div class="card">
        <div class="card-header">
            @if($errors->any())
                <div class="alert alert-danger alert-dismissible" role="alert">
                    @foreach($errors->all() as $error)
                        {{$error}}
                    @endforeach
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <h3>Kategori Güncelle</h3>
        </div>
        <div class="card-body">
            <form action="{{route("remake_category")}}" method="post">
                @csrf

                <input type="hidden" name="id" value="{{$category->id}}">

                <div class="form-floating d-flex mb-3">

                    <input class="form-control me-3" value="{{$category->Name}}" name="category_name" placeholder="Bir kategori giriniz" id="floatingTextarea">
                    <label for="floatingTextarea">Kategori Adı</label>

                </div>

                <div class="form-floating d-flex mb-3">
                    <select class="form-select py-3 w-25" name="status">
                        <option value="0" @if($category->Is_Active == 0) selected @endif>Pasif</option>
                        <option value="1" @if($category->Is_Active == 1) selected @endif>Aktif</option>
                    </select>

                </div>

                <button class="btn btn-success" type="submit">Güncelle</button>
            </form>
        </div>
@endsection
