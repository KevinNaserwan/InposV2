// Mendapatkan elemen dengan class "isi"
var isiElement = document.querySelector('.isi');

// Mendapatkan teks di dalam elemen "isi"
var isiText = isiElement.textContent;

// Mengecek apakah teks melebihi 1750 kata
if (isiText.split(' ').length > 1750) {
    // Membagi teks menjadi beberapa bagian dengan maksimal 1750 kata
    var bagianTeks = isiText.match(/[^\.!\?]+[\.!\?]+/g);

    // Menghapus elemen "isi" yang ada
    isiElement.parentNode.removeChild(isiElement);

    // Membuat elemen subpage baru
    var subpageElement = document.createElement('div');
    subpageElement.classList.add('subpage');

    // Menambahkan elemen subpage ke dalam elemen "page"
    document.querySelector('.page').appendChild(subpageElement);

    // Mengisi setiap subpage dengan teks yang telah dibagi
    var subpageCounter = 1;
    var subpageText = '';
    bagianTeks.forEach(function (bagian) {
        subpageText += bagian;
        if (subpageText.split(' ').length > 1750) {
            // Membuat elemen isi baru di dalam subpage
            var isiBaruElement = document.createElement('div');
            isiBaruElement.classList.add('isi');
            isiBaruElement.innerHTML = '<p>' + subpageText + '</p>';

            // Menambahkan elemen isi baru ke dalam subpage
            subpageElement.appendChild(isiBaruElement);

            // Membuat subpage baru
            subpageElement = document.createElement('div');
            subpageElement.classList.add('subpage');

            // Menambahkan elemen subpage baru ke dalam "page"
            document.querySelector('.page').appendChild(subpageElement);

            // Mengatur teks awal di subpage baru
            subpageText = bagian;
            subpageCounter++;
        }
    });

    // Membuat elemen tanda-tangan baru
    var tandaTanganElement = document.createElement('div');
    tandaTanganElement.classList.add('tanda-tangan');

    // Mengisi elemen tanda-tangan baru dengan konten yang ada
    tandaTanganElement.innerHTML = document.querySelector('.tanda-tangan').innerHTML;

    // Menghapus elemen tanda-tangan yang ada
    document.querySelector('.tanda-tangan').parentNode.removeChild(document.querySelector('.tanda-tangan'));

    // Menambahkan elemen tanda-tangan baru di bawah subpage terakhir
    document.querySelectorAll('.subpage')[subpageCounter - 1].appendChild(tandaTanganElement);
}
