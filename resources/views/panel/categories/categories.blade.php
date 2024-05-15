@extends("panel.app")

@section("content")
    <div class="card">

        <div class="card-header">
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
            <h3 class="ms-1">Kategoriler</h3>
            <a href="{{route("create_categories")}}" class="btn btn-success btn-md ">Yeni Kategori Oluştur</a>
        </div>

        <div class="card-body">
            @if($categories->first() != null)
                <div class="card">
                    <h5 class="card-header">Kategori Listesi</h5>
                    <div class="table-responsive text-nowrap">
                        <table class="table">
                            <thead>
                            <tr>
                                <th style="padding: 0.625rem 37px">Kategori</th>
                                <th>Durum</th>
                                <th>Oluşturulma Tarihi</th>
                                <th>İşlemler</th>
                            </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                            @foreach($categories as $category)
                                <tr @if($category->deleted_at != null) style="background-color: #e0e0e0;color:#a3a3a3" @endif>
                                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$category->Name}}</strong></td>
                                    <td>
                                        @if($category->deleted_at != null)
                                            Silindi
                                        @elseif($category->Is_Active == 1)
                                            Aktif
                                        @else
                                            Pasif
                                        @endif
                                    </td>
                                    <td>
                                        {{$category->created_at->diffForHumans()}}
                                    </td>
                                    <td>
                                        <a  @if($category->deleted_at != null) style="visibility: hidden" @endif href="{{route("update_categories",$category->id)}}" class="btn btn-info">Güncelle</a>
                                        <a  @if($category->deleted_at != null) style="visibility: hidden" @endif href="{{route("delete_categories",$category->id)}}" class="btn btn-danger">Sil</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                <p class="mb-0 ms-1">Henüz hiç kategori oluşturmadınız.</p>
            @endif
        </div>
    </div>
@endsection
