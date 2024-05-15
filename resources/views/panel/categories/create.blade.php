@extends("panel.app")

@section("content")
    <div class="card">
        <div class="card-header">
            <h3>Kategori Oluştur</h3>
        </div>
        <div class="card-body">
            <form action="{{route("add_category")}}" method="post">
                @csrf
                <div class="form-floating d-flex mb-3">

                    <textarea class="form-control me-3" name="category_name" placeholder="Bir kategori giriniz" id="floatingTextarea" style="resize: none"></textarea>
                    <label for="floatingTextarea">Kategori Adı</label>

                </div>

                <div class="form-floating d-flex mb-3">

                    <select class="form-select py-3 w-25" name="status">
                        <option disabled selected>Lütfen bir durum seçiniz</option>
                        <option value="0">Pasif</option>
                        <option value="1">Aktif</option>
                    </select>

                </div>

                <button class="btn btn-success" type="submit">Oluştur</button>
            </form>
    </div>
@endsection
