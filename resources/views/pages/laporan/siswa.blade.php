<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan PassID Siswa</title>
    <style>
        @page{
            margin:5 20px;
            padding: 5;
            font-family: Arial, Helvetica, sans-serif;
        }
        h1, h2, h3, h4 {
            margin:0;
            padding: 0;
        }

        table {
            border-collapse: collapse;
        }
        table tr td {
            padding: 2px 5px;
        }
    </style>
</head>
<body>

    <table>
        <tr>
            <td><h3>DAFTAR PASSID KELAS XII</h3></td>
        </tr>
        <tr>
            <td><h3>SMKN 1 GUNUNG KIJANG</h3></td>
        </tr>
    </table>

    <table border="1" width="100%">
        <tr>
            <th width="5px">No</th>
            <th>Nama</th>
            <th>PassID</th>
        </tr>

        @php
            $a = 0;
            $b = 0;
            $c = 0;
            $d = 0;
        @endphp
        @foreach ($siswa as $item)

            @if ($item->idjurusan == 1 && $a<1)
            <tr>
                <td colspan="3" style="background: rgba(130, 236, 130, 0.527)">{{ $item->jurusan->namajurusan }}</td>
            </tr>
            @php
                $a++;
            @endphp
            @endif
            @if ($item->idjurusan == 2 && $b<1)
            <tr>
                <td colspan="3" style="background: rgba(130, 236, 130, 0.527)">{{ $item->jurusan->namajurusan }}</td>
            </tr>
            @php
                $b++;
            @endphp
            @endif
            @if ($item->idjurusan == 3 && $c<1)
            <tr>
                <td colspan="3" style="background: rgba(130, 236, 130, 0.527)">{{ $item->jurusan->namajurusan }}</td>
            </tr>
            @php
                $c++;
            @endphp
            @endif
            @if ($item->idjurusan == 4 && $d<1)
            <tr>
                <td colspan="3" style="background: rgba(130, 236, 130, 0.527)">{{ $item->jurusan->namajurusan }}</td>
            </tr>
            @php
                $d++;
            @endphp
            @endif


            @if ($item->idjurusan == 1)
                <tr>
                    <td align="center">{{ $loop->iteration }}</td>
                    <td>{{ $item->nama }}</td>
                    <td align="center"><b>{{ $item->nis }}</b></td>
                </tr>
            @elseif ($item->idjurusan == 2)
            <tr>
                <td align="center">{{ $loop->iteration }}</td>
                <td>{{ $item->nama }}</td>
                <td align="center"><b>{{ $item->nis }}</b></td>
            </tr>
            @elseif ($item->idjurusan == 3)
            <tr>
                <td align="center">{{ $loop->iteration }}</td>
                <td>{{ $item->nama }}</td>
                <td align="center"><b>{{ $item->nis }}</b></td>
            </tr>
            @elseif ($item->idjurusan == 4)
            <tr>
                <td align="center">{{ $loop->iteration }}</td>
                <td>{{ $item->nama }}</td>
                <td align="center"><b>{{ $item->nis }}</b></td>
            </tr>
            @endif

        @endforeach
    </table>


</body>
</html>
