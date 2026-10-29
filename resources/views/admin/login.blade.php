<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <title>Masuk Admin | WARISAKU SAMBAS</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            background: #F7F0E3;
            font-family: system-ui, -apple-system, 'Segoe UI', sans-serif;
            color: #4A1C27;
        }
        .card {
            width: 100%;
            max-width: 400px;
            background: #FFFFFF;
            border-top: 6px solid #7B2435;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(74, 28, 39, .12);
        }
        h1 { font-size: 1.4rem; margin-bottom: .25rem; }
        .sub { font-size: .9rem; color: #244B3B; margin-bottom: 1.5rem; }
        label { display: block; font-size: .85rem; font-weight: 600; margin-bottom: .35rem; }
        input {
            width: 100%;
            padding: .7rem .85rem;
            margin-bottom: 1rem;
            border: 1px solid #d9cfba;
            border-radius: 8px;
            font-size: 1rem;
            background: #fffdf8;
        }
        input:focus { outline: 2px solid #D4AF5A; border-color: #D4AF5A; }
        button {
            width: 100%;
            padding: .8rem;
            border: 0;
            border-radius: 8px;
            background: #D4AF5A;
            color: #4A1C27;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
        }
        button:hover { filter: brightness(.95); }
        .error {
            background: #fdecea;
            color: #9b1c1c;
            border-radius: 8px;
            padding: .6rem .8rem;
            margin-bottom: 1rem;
            font-size: .85rem;
        }
    </style>
</head>
<body>
    <main class="card">
        <h1>WARISAKU SAMBAS</h1>
        <p class="sub">Masuk Admin</p>

        @if ($errors->any())
            <div class="error">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ url('/masuk-admin') }}">
            @csrf
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">

            <label for="password">Kata Sandi</label>
            <input type="password" id="password" name="password" required autocomplete="current-password">

            <button type="submit">Masuk</button>
        </form>
    </main>
</body>
</html>