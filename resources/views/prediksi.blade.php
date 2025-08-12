<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Prediksi Karier Alumni</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container mt-5 mb-5">
        <div class="card shadow p-4">
            <h2 class="text-center text-primary mb-4">Prediksi Karier Alumni</h2>

            <form action="{{ route('predictOutcome') }}" method="POST">
                @csrf
                <h5 class="text-secondary mb-3">🧠 <strong>Penilaian Kemampuan Teknis (1–6)</strong></h5>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Computer Architecture</label>
                        <input type="number" name="discrete1" class="form-control" min="1" max="6"
                            value="{{ old('discrete1', 3) }}" required>
                        <small class="text-muted">Nilai 1 (sangat rendah) – 6 (sangat tinggi)</small>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Programming Skill</label>
                        <input type="number" name="discrete2" class="form-control" min="1" max="6"
                            value="{{ old('discrete2', 3) }}" required>
                        <small class="text-muted">Nilai 1 (sangat rendah) – 6 (sangat tinggi)</small>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Project Management</label>
                        <input type="number" name="discrete3" class="form-control" min="1" max="6"
                            value="{{ old('discrete3', 3) }}" required>
                        <small class="text-muted">Nilai 1 (sangat rendah) – 6 (sangat tinggi)</small>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Communication Skill</label>
                        <input type="number" name="discrete4" class="form-control" min="1" max="6"
                            value="{{ old('discrete4', 3) }}" required>
                        <small class="text-muted">Nilai 1 (sangat rendah) – 6 (sangat tinggi)</small>
                    </div>
                </div>

                <hr class="my-4">
                <h5 class="text-secondary mb-3">💡 <strong>Aspek Kepribadian (0.00–1.00)</strong></h5>

                <div class="row">
                    @php
                        $labels = [
                            'Keterbukaan',
                            'Conscientiousness',
                            'Extraversion',
                            'Agreebleness',
                            'Emotionalness',
                            'Conversation',
                            'Openness to change',
                            'Hedonism',
                            'Self Enhancement',
                            'Self Transcendence',
                        ];
                    @endphp

                    @foreach ($labels as $i => $label)
                        <div class="col-md-6 mb-3">
                            <label class="form-label">{{ $label }}</label>
                            <input type="number" name="continuous{{ $i + 5 }}" class="form-control"
                                step="0.01" min="0" max="1"
                                value="{{ old('continuous' . ($i + 5), 0.5) }}" required>
                            <small class="text-muted">Nilai antara 0.00 (rendah) – 1.00 (tinggi)</small>
                        </div>
                    @endforeach
                </div>

                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-primary px-5">🔍 Prediksi</button>
                </div>
            </form>

            @isset($prediction)
                <div class="alert alert-success text-center mt-4">
                    <h5 class="mb-2">🔮 Hasil Prediksi Karier Anda:</h5>
                    <h3 class="fw-bold text-success">{{ $prediction }}</h3>
                </div>
            @endisset

            @if (session('error'))
                <div class="alert alert-danger text-center mt-4">
                    {{ session('error') }}
                </div>
            @endif
        </div>
    </div>

</body>

</html>
