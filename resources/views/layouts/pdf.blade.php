<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>@yield('title')</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.8;
            margin: 0;
            padding: 0;
            font-size: 13px;
        }

        h3 {
            margin: 2px 0;
            font-size: 13px;
        }

        table.header-table {
            width: 100%;
            border-collapse: collapse;
        }

        .header-logo {
            width: 70px;
        }

        .header-text {
            text-align: left;
            text-transform: uppercase;
        }

        hr {
            height: 1px;
            background-color: black;
            border: none;
            margin: 10px 0;
        }
    </style>
</head>

<body>
    <table class="header-table">
        <tr>
            <td width="20%">
                <img src="{{ public_path('logo.jpg') }}" class="header-logo" alt="Logo">
            </td>
            <td class="header-text">
                <h3>PERPUSTAKAAN</h3>
                <h3>SDN TUGU UTARA 14 PAGI</h3>
                <h3>@yield('title')</h3>
            </td>
        </tr>
    </table>

    <hr>

    @yield('main')
</body>

</html>
