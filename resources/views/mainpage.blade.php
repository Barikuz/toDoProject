@extends('panel.app')
@section('content')

    <div class="container ">
        <!--Header-->
        <div class="d-flex justify-content-center">
            <h2 style="font-size: 40px">Görevler</h2>
        </div>
        <!--Header-->

        <!--Tasks Area-->
        @foreach($tasks as $task)
        <div class="row mb-3 justify-content-center">
            <div class="w-25">
                <div class="form-check d-flex">
                    <input class="form-check-input me-1" style="margin-top: 6px" type="checkbox" value="" id="flexCheckDefault">

                    <label class="form-check-label" for="flexCheckDefault">
                        <div>
                            <h3 class="mb-1">{{$task->Title}}</h3>

                            <div class="d-flex flex-column ms-1">
                                {{$task->Content}}

                                @switch($task->Status)
                                    @case(0)
                                        <div>
                                            <b>Durum: </b>Seçilmedi
                                        </div>
                                        @break
                                    @case(1)
                                        <div>
                                            <b>Durum: </b>Yapılmadı
                                        </div>
                                        @break
                                    @case(2)
                                        <div>
                                            <b>Durum: </b>Yapılıyor
                                        </div>
                                        @break
                                    @case(3)
                                        <div>
                                            <b>Durum: </b>Yapıldı
                                        </div>
                                        @break
                                    @case(4)
                                        <div>
                                            <b>Durum: </b>Ertelendi
                                        </div>
                                        @break
                                @endswitch
                                @if($task->Deadline == null)
                                    <div>
                                        <b>Bitiş Tarihi: </b>Seçilmedi
                                    </div>
                                @else
                                    <div>
                                        <b>Bitiş Tarihi: </b>{{$task->Deadline}}
                                    </div>
                                @endif

                                @foreach($categories as $category)
                                    @if($category->id == $task->category_id)
                                        <div>
                                            <b>Kategori: </b>{{$category->Name}}
                                        </div>
                                    @endif
                                @endforeach

                            </div>


                        </div>

                    </label>
                </div>
            </div>

        </div>
        @endforeach
        <!--Tasks Area-->

        <!--Add Task Area-->
        <hr>
        <div class="row">
            <div class="d-flex justify-content-center mt-1">
                <form action="{{route('store')}}"  method="post" class="w-75">
                    @csrf

                    <!--Header-->
                    <div class="d-flex justify-content-center">
                        <h2 style="font-size: 40px">Görev Ekle</h2>
                    </div>
                    <!--Header-->

                    <div class="form-floating d-flex mb-3">

                        <textarea class="form-control me-3" name="task" placeholder="Göreve bir başlık verin" id="floatingTextarea" style="resize: none"></textarea>
                        <label for="floatingTextarea">Görev Başlığı</label>

                    </div>

                    <div class="form-floating d-flex mb-3">

                        <textarea class="form-control me-3" name="description" placeholder="Görevi açıklayın" id="floatingTextarea" style="resize: none"></textarea>
                        <label for="floatingTextarea">Görev Açıklaması</label>

                    </div>

                    <div class="d-flex flex-row justify-content-between mb-3">

                        <select class="form-select py-3 w-25" name="status">
                            <option disabled selected>Lütfen bir durum seçiniz</option>
                            <option value="1">Yapılmadı</option>
                            <option value="2">Yapılıyor</option>
                            <option value="3">Yapıldı</option>
                            <option value="4">Ertelendi</option>
                        </select>


                        <select class="form-select py-3 w-25" name="category_id">
                            <option disabled selected>Lütfen bir kategori seçiniz</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->Name}}</option>
                            @endforeach
                        </select>

                        <input class="form-control w-25 me-3" name="deadline" type="datetime-local">

                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-success my-1 me-3" style="width: 13%">Ekle</button>
                    </div>

                    @if(session("success"))
                        <div class="alert alert-success alert-dismissible" role="alert">
                            {{session("success")}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @elseif($errors->any())
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            @foreach($errors->all() as $error)
                                {{$error}}
                            @endforeach
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif


                </form>
            </div>
        </div>
        <!--Add Task Area-->
    </div>

    <!--It is providing doesn't resubmit the form when refresh the page-->
    <script>
        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }
    </script>

@endsection
