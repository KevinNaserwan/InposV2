<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/hasil.css') }}" /> --}}
    <title>Berkas Formulir Proposal Pinjaman PT.Pusri</title>
</head>
<style>
    body {
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
        background-color: #FAFAFA;
        font: 12pt "Tahoma";
    }

    * {
        box-sizing: border-box;
        -moz-box-sizing: border-box;
    }


    .book {
        display: flex;
        align-items: center;
    }

    .page {
        width: 210mm;
        min-height: 297mm;
        padding: 20mm;
        margin: 10mm 10mm 10mm 70mm;
        /* margin: 10mm auto; */
        border: 1px #D3D3D3 solid;
        border-radius: 5px;
        background: white;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }

    .page-break {
        margin-top: 20mm;
    }

    .subpage {
        padding: 1cm;
        /* border: 5px #F15A2B solid; */
        height: 257mm;
        /* outline: 2cm #fcc9b9 solid; */
    }

    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .header img {
        width: 95px;
        height: 57px;
    }

    .header .right {
        display: flex;
        gap: 12px;
    }

    .header .right img {
        width: 43px;
        height: 33px;
    }

    .pembuka-surat {
        margin-top: 40px;
    }

    .pembuka-surat p {
        line-height: 8px;
    }

    .pembuka-surat .perihal {
        line-height: 19px;
        width: 63%;
    }

    .kepada {
        margin-top: 40px;
    }

    .kepada p {
        line-height: 6px;
    }

    .kepada .kepentingan {
        line-height: 24px;
        width: 38%;
    }

    .isi {
        margin-top: 40px;
        /* width: 80%; */
        text-align: justify;
    }

    .isi p {
        line-height: 20px;
        text-align: justify;
    }

    .tanda-tangan {
        margin-left: 355px;
        margin-top: 37px;
    }

    .tanda-tangan .kepala-detail {
        margin-left: 29px;
        margin-top: 80px;
    }

    .tanda-tangan .kepala-detail .nama {
        margin-left: 7px;
    }

    .tanda-tangan .kepala-detail p {
        line-height: 6px;
    }

    .tanda-tangan p {
        line-height: 9px;
    }

    @page {
        size: A4;
        margin: 0;
    }

    @media print {

        html,
        body {
            width: 210mm;
            height: 297mm;
        }

        .page {
            margin: 0;
            border: initial;
            border-radius: initial;
            width: initial;
            min-height: initial;
            box-shadow: initial;
            background: initial;
            page-break-after: always;
        }
    }

    .button {
        position: relative;
    }

    .button a {
        padding: 10px 20px;
        margin-bottom: 20px;
        background-color: green;
        color: white;
        border-radius: 5px;
        list-style: none;
        text-decoration: none;
    }

    .button1 {
        position: relative;
    }

    .button1 a {
        padding: 10px 20px;
        margin-bottom: 20px;
        background-color: green;
        color: white;
        border-radius: 5px;
        list-style: none;
        text-decoration: none;
        margin-right: 30px;
    }
</style>

<body>
    <div class="book">
        <div class="page">
            <div class="subpage">
                <div class="header">
                    <img src="{{ asset('assetsurat/posLogo.png') }}" alt="">
                    <div class="right">
                        <img src="{{ asset('assetsurat/pospay.png') }}" alt="">
                        <img src="{{ asset('assetsurat/posaja.jpg') }}" alt="">
                    </div>
                </div>
                <div class="pembuka-surat">
                    <p>Nomor :
                        @if ($isi_surat->status == 2)
                            <span>{{ $isi_surat->nomor_surat }}/KCU-Palembang/{{ $isi_surat->divisi }}/{{ date('Y', strtotime($isi_surat->tanggal)) }}</span>
                        @elseif ($isi_surat->status == 0 || 1)
                            <span>..... / ..... / ..... / .....</span>
                        @endif
                    </p>
                    <p>Lampiran : <span>1 (Satu) Berkas</span></p>
                    <p class="perihal">Perihal : <span>{{ $isi_surat->perihal }}</span></p>
                </div>
                <div class="kepada">
                    <p>Kepada</p>
                    <p class="kepentingan">
                        @if ($isi_surat->level == 0)
                            {{ $isi_surat->tujuan }}
                        @elseif (($isi_surat->level == 1))
                            {{ $user->jabatan }}
                        @endif
                    </p>
                    <p>Sdr. {{ $user->nama }}</p>
                    <p>Nippos. {{ $user->id_pos }}</p>
                </div>
                <div class="isi">
                    {{ htmlspecialchars_decode($isi_surat->isi_surat) }}
                </div>
                <div class="tanda-tangan">
                    <p>Palembang, {{ date('d M Y', strtotime($isi_surat->tanggal)) }}</p>
                    <p>EGM Kcu Palembang 30000</p>
                    <div class="kepala-detail">
                        <p class="nama">Fendi Anjasmara</p>
                        <p>Nippos:976363926</p>
                    </div>
                </div>
            </div>
        </div>
        @if (Session('level') == 2)
            @if ($isi_surat->status == 2)
            @elseif ($isi_surat->status == 1)
                <div class="button1">
                    <a href="/setujuisurat/{{ $isi_surat->nomor_surat }}" id="confrim">Setujui Surat</a>
                </div>
            @endif
        @elseif (Session('level') == 3)
            @if ($isi_surat->status == 2)
            @elseif ($isi_surat->status == 0)
                <div class="button1">
                    <a href="/kirimsurat/{{ $isi_surat->nomor_surat }}" id="confrim">Kirim</a>
                </div>
            @endif
        @elseif (Session('level') == 4)
            @if ($isi_surat->status == 2)
                <div class="button">
                    <a href="/export-pdf/{{ $isi_surat->nomor_surat }}">Download Surat</a>
                </div>
            @else
            @endif
        @endif
    </div>
    @include('sweetalert::alert')
</body>

</html>
