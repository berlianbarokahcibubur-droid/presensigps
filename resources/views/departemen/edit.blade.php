<form action="/departemen/{{ $departemen->kode_dept }}/update" method="POST">
    @csrf

    <div class="mb-3">
        <label>Kode Departemen</label>
        <input type="text"
               name="kode_dept"
               class="form-control"
               value="{{ $departemen->kode_dept }}"
               readonly>
    </div>

    <div class="mb-3">
        <label>Nama Departemen</label>
        <input type="text"
               name="nama_dept"
               class="form-control"
               value="{{ $departemen->nama_dept }}">
    </div>

    <button type="submit" class="btn btn-primary w-100">
        Update
    </button>
</form>