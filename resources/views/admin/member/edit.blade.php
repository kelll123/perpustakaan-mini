<!DOCTYPE html>
<html lang="id">

<head>
    <title>Edit Member</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow col-md-6 mx-auto">
            <div class="card-header bg-warning text-dark">
                <h5 class="mb-0">Edit Data Member</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('members.update', $member->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label>Nama Lengkap</label>
                        <input type="text" name="name" class="form-control" value="{{ $member->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="{{ $member->email }}" required>
                    </div>
                    <div class="mb-3">
                        <label>Password (Kosongkan jika tidak ingin mengganti)</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Update Data</button>
                    <a href="{{ route('members.index') }}" class="btn btn-link w-100 mt-2">Batal</a>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
