<?php

// File: routes/web.php

use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Dashboard\ArtikelController as DashboardArtikelController;
use App\Http\Controllers\Dashboard\KegiatanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PendaftarController;
use App\Http\Controllers\StrukturController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SitemapController;

Route::get('/sitemap.xml', [SitemapController::class, 'index']);

Route::get('/cleanup-temp-data', function () {
    // 1. Truncate current tables to avoid conflicts and start completely fresh
    \App\Models\CatatanPerjalanan::truncate();
    \App\Models\Pengurus::truncate();

    // 2. Ensure Kegiatan 'Dikhir 2025' exists
    $kegiatan = \App\Models\Kegiatan::where('judul_kegiatan', 'like', '%Dikhir 2025%')->first();
    if (!$kegiatan) {
        $kegiatan = \App\Models\Kegiatan::create([
            'judul_kegiatan' => 'Dikhir 2025',
            'deskripsi' => 'Pendidikan dan Latihan Akhir Cakra Manggala 2025',
            'tanggal_kegiatan' => '2025-07-04',
            'lokasi' => 'Bade, Dagangan, Madiun',
            'status' => 'completed',
        ]);
    }
    $kegiatanId = $kegiatan->id;

    // 3. Insert 15 Pengurus from SK KEPENGURUSAN 2026
    $pengurusList = [
        [
            'nama' => 'Abdullah Ath Tholifuddin Al Chayan',
            'nim' => '243304061',
            'email' => 'chayan@cakramanggala.com',
            'jabatan' => 'Ketua Umum',
            'prodi_semester' => 'Teknik Komputer Kontrol',
            'urutan' => 1,
            'status' => 'active'
        ],
        [
            'nama' => 'Fiantika Sherly Apriyani',
            'nim' => '244112039',
            'email' => 'fiantika161@sma.belajar.id',
            'jabatan' => 'Sekretaris 1',
            'prodi_semester' => 'Pemasaran Digital',
            'urutan' => 2,
            'status' => 'active'
        ],
        [
            'nama' => 'Irham Najib Azimul Qowi',
            'nim' => '244311045',
            'email' => 'irhamnajib@gmail.com',
            'jabatan' => 'Sekretaris 2',
            'prodi_semester' => 'Teknologi Rekayasa Perangkat Lunak',
            'urutan' => 3,
            'status' => 'active'
        ],
        [
            'nama' => 'Reva Amelia Nurrohmah',
            'nim' => '244308114',
            'email' => 'revaamelian@gmail.com',
            'jabatan' => 'Bendahara',
            'prodi_semester' => 'Teknik Kereta Api',
            'urutan' => 4,
            'status' => 'active'
        ],
        [
            'nama' => 'Arif Murtadho',
            'nim' => '243101064',
            'email' => 'arifmurtadhooo@gmail.com',
            'jabatan' => 'Kepala Bidang Publikasi, Administrasi dan Dokumentasi',
            'prodi_semester' => 'Administrasi Bisnis',
            'urutan' => 5,
            'status' => 'active'
        ],
        [
            'nama' => 'Muhammad Dzakwan Alfaris',
            'nim' => '234311019',
            'email' => 'dzakwan@cakramanggala.com',
            'jabatan' => 'Anggota Bidang Publikasi, Administrasi dan Dokumentasi',
            'prodi_semester' => 'Teknologi Rekayasa Perangkat Lunak',
            'urutan' => 6,
            'status' => 'active'
        ],
        [
            'nama' => 'Akfin Lukman',
            'nim' => '243305002',
            'email' => 'akfinjr78@gmail.com',
            'jabatan' => 'Kepala Bidang Kaderisasi, Penelitian dan Pengembangan SDM',
            'prodi_semester' => 'Teknik Listrik',
            'urutan' => 7,
            'status' => 'active'
        ],
        [
            'nama' => 'Amay Dwi Azzahro',
            'nim' => '244112034',
            'email' => 'amaydwiazzahro74@gmail.com',
            'jabatan' => 'Anggota Bidang Kaderisasi, Penelitian dan Pengembangan SDM',
            'prodi_semester' => 'Pemasaran Digital',
            'urutan' => 8,
            'status' => 'active'
        ],
        [
            'nama' => 'Raditya Alfareza Purnama Putra',
            'nim' => '244311054',
            'email' => 'raditya@gmail.com',
            'jabatan' => 'Anggota Bidang Kaderisasi, Penelitian dan Pengembangan SDM',
            'prodi_semester' => 'Teknologi Rekayasa Perangkat Lunak',
            'urutan' => 9,
            'status' => 'active'
        ],
        [
            'nama' => 'Ahmad Naufal Addin',
            'nim' => '243304065',
            'email' => 'ahmadnaufaladdin@gmail.com',
            'jabatan' => 'Kepala Kordiv Gunung Hutan',
            'prodi_semester' => 'Teknik Komputer Kontrol',
            'urutan' => 10,
            'status' => 'active'
        ],
        [
            'nama' => 'Muhammad Fauzihand Purnomo',
            'nim' => '244308052',
            'email' => 'fauzihand2005@gmail.com',
            'jabatan' => 'Kepala Kordiv Rock Climbing',
            'prodi_semester' => 'Teknik Kereta Api',
            'urutan' => 11,
            'status' => 'active'
        ],
        [
            'nama' => 'Samsul Musadad',
            'nim' => '244314048',
            'email' => 'samsul@gmail.com',
            'jabatan' => 'Kepala Bidang Lingkungan dan Pengabdian Masyarakat',
            'prodi_semester' => 'Teknologi Rekayasa Elektronika',
            'urutan' => 12,
            'status' => 'active'
        ],
        [
            'nama' => 'Triana Rahmawati',
            'nim' => '243304059',
            'email' => 'triana@gmail.com',
            'jabatan' => 'Anggota Bidang Lingkungan dan Pengabdian Masyarakat',
            'prodi_semester' => 'Teknik Komputer Kontrol',
            'urutan' => 13,
            'status' => 'active'
        ],
        [
            'nama' => 'Ariel Maulana Hidayat',
            'nim' => '244308010',
            'email' => 'ariel@cakramanggala.com',
            'jabatan' => 'Kepala Bidang Perlengkapan dan Logistik',
            'prodi_semester' => 'Teknik Kereta Api',
            'urutan' => 14,
            'status' => 'active'
        ],
        [
            'nama' => 'Maulaya Ilyasa Jayamagusta',
            'nim' => '234308077',
            'email' => 'maulaya.ilyasa.234308077.tka@gmail.com',
            'jabatan' => 'Anggota Bidang Perlengkapan dan Logistik',
            'prodi_semester' => 'Teknik Kereta Api',
            'urutan' => 15,
            'status' => 'active'
        ],
    ];

    foreach ($pengurusList as $p) {
        \App\Models\Pengurus::create($p);
    }

    // 4. Insert 11 Catatan Perjalanan
    $logs = [
        [
            'penulis' => 'Triana Rahmawati',
            'judul' => 'Laporan Perjalanan Pendidikan dan Latihan Akhir Segulung Bade',
            'konten' => "Catatan Perjalanan Diklat Akhir Mapala Cakra Manggala \n \nTriana Rahmawati \nMinggu, 13 Juni 20025 \n \nEmpat hari di Segulung Bhade benar-benar jadi pengalaman yang nggak bakal aku lupain. \nDari bikin bivak, jelajah, materi rescue, kompas malam, sampai refling di air terjun—\nsemuanya bikin aku sadar bahwa alam itu nggak cuma indah, tapi juga bisa jadi guru paling \nkeras dan jujur. \nMomen yang paling berkesan buatku adalah saat refling di air terjun. Awalnya takut banget, \ntangan gemetar, tapi pas udah jalan dan turun perlahan, rasa takut itu berubah jadi rasa \ntakjub. Aku merasa kecil di hadapan alam, tapi juga pride bisa melewatinya. \nTapi malam terakhir jadi titik paling berat. Badan udah capek banget, dingin, dan akhirnya \naku sempat tumbang. Harus dirawat di tenda senior malam itu. Sedih sih, tapi dari situ aku \nngerasain banget gimana teman-teman dan panitia bener-bener saling jaga, saling peduli. \nDari semua ini, aku belajar satu hal penting: kebersamaan itu segalanya. Di alam, kita nggak \nbisa egois, nggak bisa sendiri. Harus saling bantu, saling ngertiin, dan saling kuatkan. \nCapek? Banget. Tapi aku juga bahagia dan pride udah sampai di titik ini. Terima kasih buat \nsemua yang udah jadi bagian dari perjalanan ini. Semoga ini jadi langkah awal yang baik \nsebagai anggota Cakra Manggala. \n \nWassalamualaikum wr. wb. \nTriana Rahmawati"
        ],
        [
            'penulis' => 'Muhammad Fauzihand Purnomo',
            'judul' => 'Laporan Perjalanan Pendidikan dan Latihan Akhir Angkatan 13',
            'konten' => "Catatan Perjalanan Pendidikan dan Latihan Akhir Cakra Manggala Angkatan 13.\n\nPelaksanaan: 4 - 7 Juli 2025\nLokasi: Bade, Segulung, Dagangan, Madiun\n\nKegiatan diklat akhir ini merupakan proses pembentukan karakter, mental, dan fisik kami sebagai calon anggota tetap UKM Cakra Manggala. Perjalanan dimulai dengan persiapan alat di kampus and keberangkatan menuju lokasi. Di lokasi perkemahan, kami langsung mendirikan bivak bersama-sama. Sepanjang empat hari, kami dibekali materi kompas malam, peta kompas navigasi darat, pembuatan harness, susur sungai, vertical rescue, dan canyonering/repling tebing air terjun.\n\nTantangan paling berat adalah saat hujan deras mengguyur perkemahan kami, yang menguji kekompakan dan ketahanan kami dari hipotermia. Namun, dengan saling membantu dan gotong royong, kami semua berhasil melaluinya dengan selamat. Perjalanan ini diakhiri dengan upacara pelantikan anggota baru di kampus. Terima kasih Cakra Manggala atas pengalaman dan pelajaran berharganya!"
        ],
        [
            'penulis' => 'Amay Dwi Azzahro',
            'judul' => 'Laporan Perjalanan Pendidikan dan Latihan Akhir Dusun Bade',
            'konten' => "CATATAN PERJALANAN DIKLAT AKHIR  \nUKM CAKRA MANGGALA \nBade, Kecamatan Dagangan, Kabupaten Madiun \n4 – 7 Juli 2025 \n \n \n \n \n \n \n \nDisusun Oleh Amay Dwi Azzahro \nNim 244112034 \nPemasaran Digital \n \n\n\nHari Pertama – Jumat, 4 Juli 2025 \nKegiatan diklat akhir dimulai pada Jumat pagi. Seluruh peserta dan panitia berkumpul di \nkampus untuk melakukan persiapan akhir dan apel pemberangkatan. rombongan \ndiberangkatkan menuju lokasi kegiatan di Dusun Bade, Kecamatan Dagangan, Kabupaten \nMadiun. Perjalanan memakan waktu sekitar 1 jam dengan kondisi medan menuju lokasi yang \ncukup menantang. \n \nSetibanya di lokasi, peserta melakukan packing ulang registrasi ulang bersama panitia serta \npengenalan lingkungan sekitar. Setelah ishoma siang, kegiatan dilanjutkan dengan memasang \nbivak di area camp hingga sore hari, lalu dilanya ishoma hingga malam.  \n \nMenjelang malam, peserta mempersiapkan diri untuk sesi navigasi malam menggunakan \nkompas, yang menjadi tantangan utama di hari pertama. Dalam suasana gelap dan sunyi \nhutan, peserta dilatih membaca arah menggunakan kompas, mengenali titik orientasi, serta \nbekerja sama dalam tim untuk menemukan koordinat. Kegiatan berakhir sekitar pukul 22.00 \nWIB dan ditutup dengan evaluasi singkat serta istirahat. \n \n \nHari Kedua – Sabtu, 5 Juli 2025 \nHari kedua dimulai dengan sarapan bersama pada pagi hari. Setelah itu, kami melakukan \npacking ulang seluruh perlengkapan, mulai dari bivak hingga peralatan pribadi. Setelah \nproses pengepakan selesai, seluruh peserta dikumpulkan untuk bersiap memulai perjalanan \npenjelajahan sekaligus mengikuti materi peta dan kompas. \n \nDalam sesi tersebut, peserta belajar membaca peta topografi, mengenali bentuk kontur, serta \nmenghubungkan antara informasi peta dengan kondisi nyata di lapangan. Kami juga \nmempraktikkan cara membidik posisi menggunakan kompas untuk mengetahui keberadaan \ntitik koordinat secara akurat. \n \nSelama penjelajahan, kami juga mempraktikkan penggunaan chest harness sebagai alat \nkeselamatan untuk melindungi tubuh bagian atas saat berada di medan terjal. Perjalanan \ndilanjutkan hingga siang hari. Di tengah perjalanan, kami beristirahat sejenak dan makan \nsiang untuk mengisi energi. \n\n \nSetelah itu, kami diarahkan untuk melakukan susur sungai, yang medannya cukup menantang \ndan terjal. Di salah satu titik, kami menjumpai tebing curam, sehingga perlu mempraktikkan \npenggunaan seat harness untuk memanjat tebing tersebut dengan aman dan sesuai prosedur \nkeselamatan. \n \nSetelah sesi susur sungai selesai, seluruh peserta dikumpulkan kembali untuk berganti \npakaian. Kemudian, kami bersama-sama membuat api unggun dan membangun bivak baru \nuntuk tempat istirahat sementara. Lalu kita beristirahat hingga pagi \n \n \nHari Ketiga – Minggu, 6 Juli 2025 \nLike biasa, hari dimulai dengan sarapan pagi. Setelah itu, kami kembali melakukan \npacking seluruh perlengkapan, termasuk bivak dan logistik pribadi. Setelah semua siap, kami \ndikumpulkan dan diarahkan untuk melanjutkan kegiatan penjelajahan. \n \nSetelah menempuh perjalanan yang cukup jauh, kami sampai di lokasi pelatihan vertical \nrescue yang berada di atas jurang. Di tempat ini, kami belajar dan mempraktikkan langsung \nteknik penyelamatan di medan terjal. Kami diajarkan bagaimana cara mengevakuasi korban \ndari ketinggian serta teknik dasar turun dan naik tali dengan prosedur keselamatan yang \nbenar. Ini menjadi salah satu pengalaman paling berkesan selama kegiatan, karena kami \nbenar-benar menuruni jurang yang curam dan penuh tantangan. \n \nSetelah sesi vertical rescue, kami melanjutkan perjalanan menuju area refling di air terjun. Di \nlokasi tersebut, kami mempraktikkan teknik menuruni tebing air terjun satu per satu dengan \nmenggunakan tali dan pengaman. Namun, di tengah pelaksanaan, hujan turun cukup deras. \nBeberapa peserta belum sempat melakukan refling, dan karena kondisi cuaca yang tidak \nmendukung, kegiatan dihentikan untuk menjaga keselamatan peserta. Jika dilanjutkan, \ndikhawatirkan akan membahayakan karena permukaan batu menjadi sangat licin. \n \nAfter itu, kami melanjutkan perjalanan kembali menuju area camp seperti malam \nsebelumnya. Kami kembali membangun bivak dan menyalakan api unggun. Namun, karena \nhujan sebelumnya, kayu yang tersedia dalam kondisi basah, sehingga menyalakan api \n\nmenjadi sangat sulit. Agar tidak mengalami hipotermia, kami bergantian mengganti pakaian \nbasah dengan yang kering, lalu beristirahat di dalam bivak yang telah dibangun. \n \nMenjelang malam, setelah istirahat sejenak, kami kembali dikumpulkan untuk mengikuti sesi \nsharing session bersama panitia di tempat yang telah disiapkan. Suasana malam itu penuh \nkehangatan, meskipun suhu udara dingin. Cerita, tawa, dan semangat dari para panitia serta \nsesama peserta menguatkan kami. Momen ini mempererat kebersamaan dan memperkuat \nsemangat kami sebagai calon anggota UKM Cakra Manggala. \n \n \nHari Keempat – Senin, 7 Juli 2025 \nHari terakhir dimulai dengan pembongkaran tenda dan pengecekan perlengkapan. Setelah \nsemua logistik dikemas dan area dibersihkan, peserta mengikuti evaluasi akhir dan apel \npenutupan. Pada sesi ini diumumkan bahwa seluruh peserta dinyatakan lulus dan resmi \nmenjadi anggota penuh UKM Cakra Manggala. \n \nSesi penutupan diwarnai dengan rasa haru dan bangga. Momen dokumentasi dilakukan \nbersama panitia, instruktur, dan seluruh peserta. Sekitar pukul 13.00 WIB, rombongan \nkembali ke kampus dengan membawa banyak pengalaman, pembelajaran, dan semangat baru \nsebagai kader muda UKM Cakra Manggala. \n \n \n \n \n \n \n \n \n \n \n\nRangkuman Perjalanan \n \nEmpat hari mengikuti Diklat Akhir bukan sekadar kegiatan luar ruang, tetapi sebuah \nperjalanan yang membentuk mental, mengasah kemampuan teknis, dan mempererat ikatan \nkebersamaan. Setiap harinya menyimpan pengalaman yang tidak hanya melelahkan secara \nfisik, tetapi juga menyentuh batin dan meninggalkan kesan mendalam. \n \nHari pertama dimulai dengan semangat yang menggebu. Setelah tiba di Bade, Dagangan, \nkami membangun bivak dan mempersiapkan diri untuk materi navigasi malam menggunakan \nkompas. Dalam gelapnya hutan, hanya bermodalkan cahaya senter dan kepercayaan satu \nsama lain, kami belajar membaca arah dan mencari titik koordinat. Malam itu menjadi awal \nkami belajar memimpin diri sendiri dan menjaga tim di tengah keterbatasan. \n \nHari kedua membawa kami pada materi peta dan kompas, dilanjutkan praktik membuat chest \nharness dan seat harness, lalu kami menyusuri sungai dengan jalur yang cukup terjal. Di \ntengah penjelajahan, kami harus memanjat tebing dengan bantuan tali—praktik nyata dari apa \nyang sebelumnya hanya kami pelajari di ruang kelas. Sore harinya kami membangun bivak \nkembali, and malamnya dihangatkan dengan sharing session bersama para senior. Dari \nmereka, kami mendengar cerita perjuangan, semangat, dan nilai kebersamaan yang tak \nternilai. \n \nHari ketiga adalah puncak ujian mental. Kami mempraktikkan vertical rescue di tebing \njurang—menuruni ketinggian dengan teknik evakuasi yang menegangkan tapi luar biasa \nmengesankan. Setelah itu kami menuju lokasi refling di air terjun, menuruni dinding batu \nbasah yang curam dengan sistem tali. Namun cuaca tidak bersahabat. Hujan turun deras, \nmembuat sebagian dari kami tidak bisa menyelesaikan refling karena alasan keselamatan. \nMeskipun kecewa, kami belajar bahwa keselamatan tim lebih utama dari ambisi pribadi. \nMalamnya, setelah susah payah menyalakan api unggun dengan kayu yang basah, kami tidur \nbergantian dalam bivak dengan baju kering seadanya, berusaha menghindari hipotermia. \n \nHari terakhir ditutup dengan evaluasi dan apel penutupan. Saat nama kami dipanggil satu per \nsatu dan dinyatakan lulus, rasa lelah berubah menjadi haru dan bangga. Kami bukan lagi \nhanya peserta, tapi telah menjadi bagian dari keluarga besar UKM Cakra Manggala. \n\n \nDiklat akhir ini meninggalkan lebih dari sekadar pengalaman teknis—ia menanamkan nilai \nkeberanian, tanggung jawab, solidaritas, and cinta terhadap alam. Dan yang terpenting, kami \npulang bukan sebagai orang yang sama seperti saat datang. Kami pulang dengan versi diri \nyang lebih kuat."
        ],
        [
            'penulis' => 'Raditya Alfareza Purnama Putra',
            'judul' => 'Laporan Perjalanan Pendidikan dan Latihan Akhir Angkatan XIII',
            'konten' => "Nggih pak sama sama\nPada Min, 20 Jul 2025 10.06, Anton Cahyo Saputro <anton@pnm.ac.id> menulis:\nTrims mas\nOn Sun, Jul 20, 2025, 4:11 AM MAULAYA ILYASA JAYAMAGUSTA <maulaya.ilyasa.234308077.tka@gmail.com> wrote:\nNama : RadityaAngkatan XIII"
        ],
        [
            'penulis' => 'Arif Murtadho',
            'judul' => 'Laporan Perjalanan Pembentukan Karakter dan Penguatan Mental Angkatan 13',
            'konten' => "Catatan Perjalanan Diklat Akhir Cakra Manggala Angkatan 13 \n \nPelaksanaan  : 4 - 7 Juli 2025 \nLokasi   : Bade, Segulung, Dagangan \n \nDiklat akhir Mahasiswa Pecinta Alam Cakra Manggala Angkatan 13 menjadi momen \nyang sangat berkesan bagi saya dan kami semua. Kegiatan ini bukan sekadar penutupan, tetapi \njuga menjadi proses pembentukan karakter, penguatan mental, serta pengalaman langsung \nhidup bersama alam dalam kondisi yang nyata, jauh dari kenyamanan sehari-hari. \nAlam memberi banyak pelajaran. Kami jadi tahu rasanya mencari air bersih, memasak \ndengan alat seadanya, atau menyalakan api saat kayu basah. Semua terasa sederhana, tapi \nsangat berarti. Kami belajar menghargai hal-hal kecil yang sering kami anggap biasa di \nkehidupan sehari-hari. \nYang paling berkesan bukan hanya pemandangan yang indah, tapi proses kami \nmelewatinya. Ada rasa ingin menyerah, ada juga saat-saat diam sambil menatap langit dan \nberpikir, \u201cKenapa aku di sini?\u201d Tapi perlahan, semua pertanyaan itu terjawab sendiri. Kami di \nsini untuk belajar menjadi lebih kuat. Menjadi bagian dari alam, bukan hanya sebagai \npenikmat. \nDiklat ini mungkin cuma berlangsung beberapa hari, tapi dampaknya akan terasa lama. \nKami pulang dengan badan letih, tapi hati penuh. Kami jadi lebih mengenal diri sendiri, lebih \nhargai kebersamaan, dan lebih peka terhadap lingkungan. \nTerima kasih, alam. Terima kasih, teman-teman. Terima kasih, Cakra Manggala. Kalian \nsemua membuat perjalanan ini luar biasa. \n \nNama  : Arif Murtadho \nProdi  : Administrasi Bisnis"
        ],
        [
            'penulis' => 'Akfin Lukman',
            'judul' => 'Laporan Perjalanan Kemah Pendidikan dan Latihan Akhir Kelompok 1',
            'konten' => "Catatan Perjalanan Kemah Diklat Akhir \n \nNama : Akfin Lukman , kelompok 1  \n- (-) Hari 1 – Persiapan Peking Kelompok, Hari Kamis, Pukul 10.00 WIB \nPersiapan kegiatan Peking kelompok kami dilaksanakan pada hari Kamis, dimulai pukul 10.00 \npagi. Kelompok saya terdiri dari 6 anggota, yang terdiri atas 4 laki-laki dan 2 perempuan. Sejak \npagi, anggota kelompok mulai datang satu per satu hingga hampir lengkap. Barang-barang yang \nwajib dibawa dalam kegiatan ini meliputi: pakaian ganti, alat tulis, survival kit, sleeping bag (SB), \ngolok , spirtus 2 botol serta air mineral sebanyak 3 botol ukuran 1,5 liter per orang. Persiapan \nawal dimulai dengan membuat kompor lapangan dari kaleng bekas, serta tinder buatan yang \nterbuat dari kapas dan lilin. Korlap (kompor lapangan) yang dibutuhkan untuk kegiatan kemah \nbesok minimal sebanyak 6 buah, dan tinder disiapkan sebanyak-banyaknya. Setelah pembuatan \nkorlap dan tinder selesai, kami melanjutkan dengan menyusun logistik yang akan dibawa. Hal \npertama yang menjadi perhatian kelompok adalah bagaimana membagi perlengkapan logistik \nsecara merata, terutama agar tas carrier perempuan tidak terlalu berat. Kami mulai \nmembongkar seluruh isi carrier kelompok, lalu menyusunnya kembali. Untuk tas carrier laki-laki, \nsleeping bag diletakkan di bagian paling bawah, diikuti dengan air minum dan barang bawaan \npribadi. Setelah itu, kami menambahkan perlengkapan kelompok seperti korlap, logistik \nmakanan kelompok, serta peralatan masak yang sebelumnya telah dikumpulkan menjadi satu, \nflysheet dan nesting masakan. Saya pribadi mendapatkan tanggung jawab untuk membawa \nlogistik makanan kelompok serta 4 botol air minum. Sementara itu, untuk anggota perempuan, \nmasing-masing hanya membawa 2 botol air minum ,tinder dan spirtus  agar beban tidak terlalu \nberat. Sebelum semua logistik dimasukkan ke dalam tas, saya juga mengingatkan seluruh \nanggota kelompok agar menyimpan pakaian ganti mereka di dalam kantong plastik or kresek, \nuntuk menghindari kemungkinan terkena air di perjalanan dan kegiatan berlangsung . Seluruh \npersiapan kelompok diselesaikan pada hari Jumat sebelum pukul 10.00 WIB, karena masih ada \nbeberapa peralatan yang belum dibawa or dibeli pada hari sebelumnya. \n \nHari 1 – Keberangkatan, Hari Pertama di Lokasi, Materi Malam hari  \nSekitar pukul 08.00–09.00 WIB, teman-teman sudah mulai berdatangan ke kampus dan \nlangsung menuju ruang sekretariat Cakra untuk memastikan barang bawaan masing-masing \nsudah lengkap. Kami melakukan pengecekan ulang dan menandai peralatan yang dibawa pada \ndaftar yang telah disiapkan oleh senior. Proses ini dilakukan satu per satu, meskipun ada \nbeberapa barang kecil yang ternyata tertinggal. Pada pukul 10.00 WIB, seluruh peserta satu \n\nangkatan dikumpulkan dan dibariskan oleh senior untuk pengecekan kehadiran. Dari kelompok \nsaya, masih ada satu teman perempuan yang belum hadir dikarenakan masih di  Puskesmas \nuntuk membuat surat sehaat.  Kami menunggu sekitar 10–15 menit, namun yang bersangkutan \nbelum juga tiba, sehingga acara tetap dilanjutkan sesuai dengan jadwal yang telah disusun. \nBarisan sebelumnya disiapkan senior kemudian dibubarkan dan kami diarahkan menuju area \nterbuka untuk membentuk barisan kembali. Setelah barisan terbentuk dengan rapi, senior \nmengambil alih untuk persiapan upacara pembukaan. Sebelum upacara dimulai, setiap \nkelompok diminta untuk memilih satu orang sebagai ketua kelompok, dan saya terpilih menjadi \nketua kelompok 1 . Setelah pemilihan selesai, kami bersiap dan melaksanakan upacara \npembukaan yang berlangsung secara khidmat selama kurang lebih 30 menit. Usai upacara, kami \nkembali dikumpulkan untuk mendapatkan arahan mengenai peraturan serta konsekuensi yang \nberlaku selama kegiatan kemah berlangsung. Dari pemberitahuan senior  pemberangkatan \nkemah dimulai jam 13.30 menuju lokasi kemah di Desa Segulung, Kabupaten Madiun. Setelah \nsesi pengarahan selama 15 menit selesai, seluruh peserta dibubarkan dan diberikan waktu \nbebas untuk berfoto dan mengabadikan momen bersama. Setelah itu, kami diarahkan kembali \nto tempat penyimpanan carrier untuk melakukan pengecekan terakhir atas perlengkapan yang \nakan dibawa. Teman teman laki-laki kemudian melaksanakan salat Jumat, sedangkan \nperempuan menyiapkan barang dan logistik untuk keberangkatan. Pada pukul 13.00 WIB, \nsemua peserta berkumpul kembali dan mulai menyiapkan perlengkapan serta pasangan \nboncengan sepeda motor. Diupayakan agar peserta perempuan dibonceng oleh peserta laki-\nlaki. Pukul 13.30 WIB, kami semua berangkat dari kampus menuju lokasi perkemahan. Kami tiba \ndi lokasi kemah menjelang sore hari. Setibanya di sana, kami segera menurunkan carrier dari \nmotor dan diarahkan ke aula yang telah disiapkan untuk menaruh cerier . Untuk sepeda motor \ndititipkan di rumah warga sekitar yang terletak di bawah area perkemahan. Teman teman  laki-\nlaki mengantar motor ke lokasi penitipan dan kemudian kembali ke perkemahan dengan \nbantuan senior. Setelah semua selesai, kami kembali dibariskan by senior di area lapangan voli \nuntuk mengikuti materi pertama, yaitu pengecekan barang bawaan. Satu per satu barang \ndikeluarkan dari carrier and dicocokkan dengan daftar yang telah dibawa. Di tengah sesi, hujan \nmulai turun, sehingga kami diarahkan untuk segera mengemasi barang dan pindah ke aula \nuntuk melanjutkan pengecekan. Beberapa peserta diketahui tidak membawa perlengkapan \nsecara lengkap. Setelah pengecekan selesai, kami kembali dibariskan dan diberikan instruksi \nuntuk segera mendirikan tenda di lokasi yang sudah disiapkan di sebelah lapangan voli.Saya \nmulai mengarahkan anggota kelompok untuk mengelompokkan carrier, mengambil \nperlengkapan seperti golok, sarung tangan, flysheet, dan tali perusik untuk membangun tenda. \nKami langsung bergerak dan membagi tugas: ada yang membersihkan rumput, menata \nbebatuan, menggali lubang untuk api unggun, serta mengumpulkan kayu bawaan . Menjelang \nmalam, tenda berhasil didirikan, dan persiapan api unggun pun selesai. Api unggun pun \ndinyalakan. Setelah itu, kami mulai memasukkan carrier ke dalam tenda dan menata matras \n\nuntuk beristirahat. Kami kemudian melaksanakan salat dan makan malam bersama di depan api \nunggun. Sekitar pukul 20.00 WIB, kami dikumpulkan kembali di lapangan voli untuk mengikuti \nmateri malam, yaitu Kompas Malam. Kami dibagi per kelompok dan mendapat penjelasan dari \nsenior mengenai arah mata angin dengan keadaan malam hari  dan cara penggunaannya. \nUrutan, kami langsung mempraktekkan materi tersebut. Senior menyebutkan beberapa \nderajat arah, dan kami menyusunnya menjadi pola yang telah disimulasikan. Dari kegiatan ini, \nkami belajar banyak hal, antara lain: pentingnya fokus, konsistensi, menghitung langkah untuk \nmengukur jarak, serta meningkatkan kekompakan dan koordinasi dalam kelompok. Setelah \nmateri selesai, kami diarahkan kembali ke tenda untuk beristirahat dengan satu syarat: api \nunggun harus tetap menyala semalaman dan dijaga secara bergantian oleh anggota kelompok. \n \n \n \nHari 2 – Materi , Perjalanan dan Pelatihan Mental  \nHari kedua merupakan hari yang cukup menguras tenaga. Setelah terdengar azan Subuh, \nsaya masih merasa cukup lelah karena malam sebelumnya saya bertugas menjaga shift awal \nhingga tengah malam. Namun, kegiatan tetap berjalan. Seluruh peserta satu angkatan memulai \nhari dengan melaksanakan salat Subuh berjemaah. Setelah itu, setiap kelompok mulai \nmenyiapkan sarapan secara bergiliran. Sebagian anggota memasak, dan sebagian lainnya \nmembereskan carrier agar rapi seperti semula. Setelah selesai makan, saya bergantian dengan \nteman lain untuk merapikan carrier hingga semua siap. Setelah semua kegiatan pagi selesai, \nsaya mengarahkan seluruh peserta untuk segera membongkar tenda dan memastikan area \ncamp bersih dari sampah dan sisa makanan. Kami membagi tugas secara bergiliran hingga \nsemua area benar-benar bersih. Saya lalu menginstruksikan agar seluruh perlengkapan carrier \ndan peralatan lainnya dikumpulkan di lapangan voli dan membentuk barisan per kelompok. \nSetelah semua siap, kami beristirahat sekitar 30 menit sambil menunggu arahan dari senior. \nSetelah waktu istirahat selesai, para senior datang dan mengumpulkan kami untuk melakukan \nsenam pagi. Usai senam, kami diberi arahan untuk berganti pakaian: bebas di bagian atas dan \n\n\ntetap mengenakan celana PDH. Setelah berganti pakaian, kami kembali dibariskan untuk mulai \nmenghafalkan yel-yel Cakra Manggala. Selanjutnya, kami dibentuk dalam satu banjar ke \nbelakang untuk mengikuti materi penjelajahan hutan. Dalam perjalanan, yel-yel juga terus kami \nnyanyikan. Di sepanjang perjalanan, kami diajarkan untuk saling membantu dan mengendalikan \nego. Di tengah perjalanan, kami berhenti sejenak untuk istirahat dan menerima materi tentang \ncara membidik kompas dan menentukan titik lokasi saat itu. Setelah titik lokasi berhasil \nditemukan (kami berada di Desa Doho), kami melanjutkan perjalanan menyusuri hutan jati \ndengan jalur yang naik turun dan berkelok-kelok. Selama perjalanan, saya juga mendapat \ninformasi bahwa tinder alami bisa berasal dari pelepah pohon jati. Maka dari itu, beberapa \nteman mengumpulkan pelepah tersebut untuk keperluan api unggun nanti. \nPerjalanan dilanjutkan dan kami kembali istirahat sejenak sambil membagi bekal makanan \nringan yang dibawa secara pribadi. Setelah istirahat, kami kembali melanjutkan perjalanan. Di \ntengah jalan, kami dihentikan untuk mengambil tali webbing dan membuat ikatan dada (chest \nharness). Setelah itu, kami kembali istirahat untuk makan siang. Di kelompok saya, memasak mi \ninstan dan makanan ringan guna mengisi kembali energi. Setelah 30 menit istirahat dan makan, \nkami beres-beres dan bersiap mengikuti kegiatan berikutnya: penyusuran sungai, didampingi \noleh para demisioner. Untuk peserta perempuan yang sedang menstruasi, mereka dipersilakan \nberpindah barisan. Di kelompok saya, seluruh perempuan mundur, sehingga hanya tersisa satu \nperempuan di kelompok sebelah. Saya mengatur formasi barisan dengan saya di depan, diikuti \noleh perempuan, lalu teman laki-laki yang berbadan besar, dan seterusnya. Saat menyusuri \nsungai, saya cukup terkejut dengan jalurnya. Banyak bebatuan licin dan tanah yang dalam, \nsehingga air bisa mencapai pinggang saya (yang cukup tinggi). Di salah satu titik, kami harus \nsaling membantu mengangkat carrier ke pundak teman karena tingginya air mencapai dada \nbeberapa peserta. Semua peserta basah kuyup. Namun, kami tetap bekerja sama hingga semua \nberhasil melewati jalur tersebut. Di tengah perjalanan, kami juga digigit pacet di kaki. Lalu kami \ndiarahkan untuk mengganti posisi tali webbing dari dada ke pinggul (menjadi seat harness). \nKami lalu melihat simulasi dari demisioner tentang cara memanjat tebing yang dialiri air (mirip \nair terjun) menggunakan tali yang ditarik dari atas sambil membawa carrier . Beberapa peserta \nsempat ragu dan mentalnya terguncang, tidak ingin naik. Saya berusaha meyakinkan mereka \nbahwa satu-satunya jalan hanyalah naik ke atas. Salah satu teman yang berbadan besar juga \nmengalami kesulitan dan tidak ingin naik. Saya menyemangatinya dan memberitahu bahwa ia \nakan dibantu oleh teman-teman. Dengan kerja sama, ia akhirnya berhasil naik: kaki kanan \nmenapak batu, kaki kiri saya bantu tempatkan di paha saya, dan teman-teman lainnya \nmendorong dari belakang sambil memberi semangat dari atas. Itu adalah momen yang paling \nmembekas. Akhirnya, satu per satu peserta berhasil naik dan perjalanan dilanjutkan. Kami tetap \nmenyanyikan yel-yel sambil berjalan. Di pertengahan jalan, kami menemui rintangan air terjun \nberbatu lagi, namun lebih mudah karena tali dari atas bisa digunakan untuk menarik carrier \n\nterlebih dahulu sebelum peserta naik. Kami kembali menolong satu sama lain dan melanjutkan \nperjalanan hingga menemukan batu besar yang harus dilewati menggunakan tali. Ini juga tidak \nterlalu sulit. Setelah semua naik, kami beristirahat sebentar karena tenaga benar-benar \nturkuras. Kemudian kami kembali dibariskan untuk melanjutkan perjalanan hingga sampai di \nlokasi akhir. Tak disangka, akhir dari susur sungai membawa kami ke tempat terbuka, di mana \ntiga teman perempuan kami sudah menunggu, menandakan bahwa kami akan istirahat. Kami \ndiminta mengganti pakaian basah dengan baju kering dan celana training, lalu beristirahat \nselama 45 menit. Setelah itu, kami kembali membentuk barisan untuk menerima materi tentang \npembuatan bivak. Kami diarahkan ke tempat yang lebih luas untuk melihat demonstrasi \nmembuat bivak dengan tiga pasak agar bisa berdiri dengan stabil. Setelah materi bivak selesai, \nkami juga menerima materi tentang penggunaan pemantik api (fire starter) dan tinder hingga \nberhasil menyalakan api. Semua materi hari itu selesai menjelang sore. Kami kemudian \ndibariskan kembali dan diarahkan ke area terbuka untuk beristirahat, membangun tenda, dan \nnyalakan api unggun. Sebelum matahari terbenam, tenda dan api unggun sudah siap. Saya \nsendiri memilih langsung beristirahat agar bisa menjaga shift malam, sementara beberapa \nteman saya saya tugaskan untuk memasak makan malam. Di tengah malam, saya dibangunkan \nuntuk makan malam dan menikmati kopi sambil bercanda di sekitar api unggun. Kami berjaga \nbersama hingga larut malam sambil menikmati kebersamaan. \nPembelajaraan Bagi Saya  \nHari kedua ini menjadi pengalaman yang sangat berkesan bagi saya. Saya belajar tentang arti \nkekompakan, saling tolong-menolong, melatih mental, dan bagaimana menghadapi titik \nkelelahan bersama-sama. Semua itu ditutup dengan momen hangat di sekitar api unggun, \nditemani secangkir kopi dan berbincang bincang . \n \n\n\n \n \nHari 3 – Jelajah , Evakuasi & Ujian Mental \nHari ketiga merupakan pengalaman pertama saya mengikuti aktivitas yang sebelumnya belum \npernah saya lakukan. Saat hari mulai terang, kami semua bangun dan bersiap memasak sarapan \npagi bersama-sama. Kami menyiapkan nasi, lauk, dan bekal makan siang sesuai arahan dari \nkakak demisioner yang menyampaikan bahwa hari ini kami harus membawa bekal sendiri. \nSetelah makanan matang, kami makan bersama-sama. Sebagian makanan kami sisihkan untuk \nbekal siang hari. Usai makan, kami mulai membereskan perlengkapan tidur seperti carrier dan \nalat masak. Saya memberikan arahan kepada kelompok saya untuk membagi tugas: ada yang \nmenata carrier, ada yang menurunkan dan merapikan tenda, serta ada yang membersihkan alat \nmasak. Semua sampah kami kumpulkan dan area sekitar tenda kami bersihkan hingga tidak ada \nsampah yang tersisa. \nSetelah beres, kami beristirahat sejenak selama 10 menit, kemudian kembali dibariskan by \nkakak demisioner untuk menerima materi tentang cara menggunakan tali webbing yang benar. \nSemua teman-teman diberi arahan dan latihan agar semakin paham penggunaan tali tersebut. \nSelesai materi, kami diarahkan oleh senior untuk berbaris membentuk satu banjar ke belakang \ndan bersiap melakukan perjalanan susur hutan kembali. Dalam perjalanan, saya berada di posisi \npaling depan. Saat berjalan, saya menemukan beberapa barang di pinggiran pohon, seperti \nhandlamp, slayer Cakra, baju lengan panjang, dan topi rimba. Semua barang tersebut langsung \nsaya masukkan ke dalam carrier. \nDi pertengahan perjalanan, kami diminta istirahat sejenak sambil makan makanan ringan dan \nmengatur napas, karena di depan ada jalur tanjakan yang harus dilalui dengan bantuan tali \nwebbing. Satu per satu teman naik secara bergantian hingga semuanya berhasil melewati rute \ntersebut. \nPerjalanan dilanjutkan selama kurang lebih 10 menit, lalu kami kembali diminta berbaris per \nkelompok karena akan menerima materi evakuasi korban jatuh dari jurang. Materi diawali \ndengan penjelasan mengenai cara melihat kondisi sekitar dan penggunaan webbing untuk \nevakuasi. Pelatih meminta empat relawan untuk mempraktikkan materi secara langsung, dan \nsaya menjadi salah satu yang maju. \nSaya turun ke dasar jurang menggunakan peralatan lengkap: seat harness dari webbing, helm, \nsarung tangan, dan carabiner yang telah terpasang. Saya juga ditugaskan membawa golok untuk \nmembuka jalur bagi teman-teman lain. Setelah jalur terbuka, saya melepas kaitan carabiner dan \nmulai menelusuri area sekitar, menemukan beberapa barang milik \"korban\" seperti kaus kaki \ndan sepatu, hingga akhirnya menemukan korban yang tergeletak di dekat aliran sungai. \nSaya segera kembali ke atas dan memberi tahu teman-teman bahwa korban telah ditemukan. \nSalah satu teman langsung menyusul saya ke bawah untuk memeriksa kondisi korban. Setelah \ndiperiksa, korban dinyatakan meninggal dunia. Kami segera memberi tahu teman-teman di atas \nagar menurunkan tandu yang sebelumnya sudah disiapkan. Setelah semua turun, kami \nmengamankan korban ke tandu menggunakan tali dan carabiner, lalu mulai proses evakuasi. \nEvakuasi korban ke atas merupakan proses yang sangat menguras tenaga karena jalurnya licin \ndan berbatu. Kami mengatur strategi dengan dua orang di depan dan dua orang di belakang \nmengangkat tandu. Dengan panduan pelatih, kami berhasil membawa korban hingga ke atas \ndan melepaskan semua perlengkapan. \nSetelahnya, kami beristirahat dan makan siang. Lalu, semua alat kembali dibereskan dan carrier \nkami tata rapi di dekat pohon. Setelah itu, kami kembali dibariskan dan melanjutkan perjalanan. \nKali ini jalur cukup teknikal karena menurun, licin, dan harus berpegangan pada tali webbing \nsambil membawa carrier. Setelah semua berhasil sampai di bawah, kami lanjut berjalan menuju \narea bebatuan. \nDi tengah perjalanan, kami diminta berhenti lagi karena akan turun menggunakan teknik repling \ndi jalur berbatu. Saat menunggu giliran, hujan mulai turun. Saat giliran saya hendak turun, \npelatih memberi arahan agar yang belum turun segera kembali to area istirahat karena kondisi \nhujan membahayakan untuk melanjutkan repling. \nSaya dan beberapa teman segera kembali ke atas dan membuat bivak darurat dari flysheet \nuntuk berteduh. Tak lama, teman-teman lain yang sudah turun ikut kembali dan membuat bivak \ntambahan. Setelah hujan mulai reda, kami kembali dibariskan untuk melanjutkan perjalanan \nkembali ke lokasi kemah malam sebelumnya. Setibanya di lokasi, kami diminta membuat bivak \nkembali. \nNamun, hujan kembali turun deras. Saya langsung mengambil inisiatif untuk mengatur teman-\nteman: sebagian membuat bivak dan tempat menyimpan barang, sebagian membuat jalur \naliran air, dan sebagian lagi mencoba menyalakan api unggun. Sayangnya, karena semua \nperlengkapan basah dan spiritus habis, api tidak menyala. Kondisi mulai darurat: banyak teman \nkedinginan dan pakaian basah kuyup. Saya menyuruh semua mengganti pakaian lengkap, \ntermasuk pakaian dalam, agar tidak mengalami hipotermia. Beberapa teman mulai menggigil. \nSaya mulai panik, tetapi tetap berusaha menenangkan kelompok. Saya menyarankan agar \nmereka menempelkan salonpas di hidung untuk menghangatkan diri. Setelah semua berganti \npakaian, kami berkumpul di dalam bivak berjumlah 9 orang. Dua teman kami lainnya sudah \n\nterlebih dahulu istirahat di tenda senior karena kondisi kesehatannya. Di dalam bivak, kami \nsaling menghangatkan dengan membuka sleeping bag dan tidur bersama agar tetap hangat. \nMalam pun tiba. Kami dibangunkan oleh senior dan diarahkan berpindah ke tenda mereka. \nDalam kondisi jalan berlumpur, kami melangkah perlahan menuju lokasi tenda senior. Kami \ndisambut hangat, diberi teh, makanan, dan menghangatkan diri di api unggun. Setelah itu, kami \nkembali diminta kembali to tenda awal. \nDi tengah perjalanan, salah satu teman perempuan saya tiba-tiba pingsan. Kami langsung \nmengangkatnya dan membawanya kembali to tenda senior untuk diberi pertolongan. Setelah \nkondisinya membaik, kami semua kembali ke lokasi kemah dan segera beristirahat karena \nkondisi fisik kami sudah sangat lelah. Saya mengambil sleeping bag dan langsung tidur di dekat \napi unggun yang mulai menyala. \nPembelajaran  \nHari ketiga ini benar-benar mengajarkan saya banyak hal: mulai dari pentingnya kerja sama tim, \npngalaman pertama evakuasi korban langsung, hingga bagaimana saya harus berpikir cepat \nagar teman-teman saya tidak terkena hipotermia dalam kondisi cuaca buruk dan kelelahan. \nSemua ini menjadi pengalaman berharga yang akan selalu saya ingat. \n \n \nHari 4 – Penutupan & Pulang \nPagi hari, kami semua mulai bangun satu per satu. Seperti biasa, kami langsung membagi tugas: \nada yang menyiapkan sarapan pagi, ada yang membereskan bivak, dan ada yang merapikan \nperalatan. Setelah semua kegiatan selesai, area sekitar dibersihkan dan sampah dikumpulkan ke \ndalam kantong plastik. \n\n\nSelanjutnya, kami dibariskan by senior membentuk satu banjar ke belakang untuk \nmelanjutkan perjalanan. Tujuan kami adalah menuju lokasi perkemahan senior, karena di sana \nakan dilaksanakan upacara penutupan kegiatan. \nSetibanya di lokasi, upacara penutupan dimulai dan berlangsung dengan khidmat. Di tengah \npelaksanaan upacara, saya tidak dapat menahan air mata dan merasa sangat terharu. Banyak \nhal yang membuat saya tersentuh—terutama mengenai arti pentingnya kebersamaan, saling \ntolong-menolong, serta nilai-nilai kepemimpinan yang saya rasakan selama mengikuti kegiatan \nkemah selama empat hari ini. \nSaya juga sangat berterima kasih kepada seluruh kakak senior, pelatih, demisioner, dan teman-\nteman seperjuangan yang telah berproses bersama hingga tiba di titik akhir kegiatan ini. \nSetelah upacara selesai, kami melanjutkan dengan sesi foto bersama dengan seluruh peserta \ndan panitia, lalu dilanjutkan makan bersama. Setelah itu, kami bersiap melanjutkan perjalanan \nkembali menuju titik penitipan motor. \nSekitar pukul 13.30 WIB, kami tiba di tempat penitipan dan beristirahat sejenak. Setelah itu, \nkami berpamitan satu sama lain dan bersiap untuk kembali menuju kampus."
        ],
        [
            'penulis' => 'Ahmad Naufal Addin',
            'judul' => 'Laporan Perjalanan Navigasi Darat dan Susur Sungai Angkatan 13',
            'konten' => "Nama : Ahmad Naufal Addin \nNIM : 243304065 \nAngkatan : 13 Cakra Manggala \n \nCatatan Perjalanan Diklat Akhir \n \nDiklat akhir dimulai dengan upacara pembukaan pada tanggal 4, di kampus 1 \nPoliteknik Negeri Madiun. Semua barang yang diperlukan dibawa, berangkat dengan \nmengendarai motor menuju desa Segulung kecamatan Dagangan. Peraturan dimulai, \nseperti memanggil kakak tingkat harus senior, demisioner dan alumni. Berbaris di \nlapangan dan di beri arahan untuk membersihkan area yang akan dijadikan tempat \nmembuat api dan bivak. Saat sudah malam diberikan materi mengenai cara \npenggunaan kompas dengan menargetkan objek, menggunakan berapa langkah dan \nderajat, lalu membentuk pola apa yang terbentuk dari perhitungan langkah dan derajat. \nKeesokannya pada tanggal 5 dipagi hari merapihkan bivak, bersiap untuk menjelajahi \nhutan dan susur sungai, dimulai dengan pemanasan, sesudah pemanasan, perjalanan \ndimulai. Setelah berjalan jauh diselingi dengan materi navigasi menggunakan kompas \ndan peta. Lalu menjelang sore hari saatnya susur sungai, disaat sudah setengah \nperjalanan susur sungai terdapat materi mengenai cara membuat seat harness untuk \nmemanjat bebatuan di sungai. Keesokannya pada tanggal 6 di pagi hari, bersiap dan \nmerapihkan. Sebelum berangkat, membuat chest harness terlebih dahulu, lalu \nberangkat. Setelah sampai terdapat materi mengenai evakuai korban. Lalu kembali \nketempat sebelumnya untuk beristirahat. Pada esok hari tanggal 7 pagi hari bersiap dan \nmerapihkan. Lalu upacara penutupan diklat akhir."
        ],
        [
            'penulis' => 'Reva Amelia Nurrohmah',
            'judul' => 'Laporan Perjalanan Pendidikan dan Latihan Akhir Basecamp Alam Bade',
            'konten' => "Catatan Perjalanan Penuh Tantangan dan Makna \nLokasi: Basecamp Alam Bade, Dagangan   \nWaktu Pelaksanaan: 4–7 Juli 2025   \n \nHari Pertama: Awal yang Dingin dan Misterius  \nJumat, 4 Juli 2025 \nPerjalanan dimulai pagi hari dengan penuh semangat. Setelah upacara pembukaan, kami langsung \nmenuju lokasi camping. Suasana masih santai, tapi ada sesuatu yang membuat bulu kuduk merinding \n- kamar mandi di sana terasa sangat angker! Kami mendirikan tenda di bawah pohon besar yang \nkonon dihuni makhluk tak kasat mata. Beberapa teman mengaku melihat penampakan, tapi anehnya \naku sama sekali tidak merasakan kehadirannya. Kondisi tubuhku sudah drop sejak awal, tapi tekadku \nuntuk mengikuti semua kegiatan tak tergoyahkan. Pada pagi hari di keesokannya, aku menggigil \nkedinginan karena salah memilih posisi tidur di bagian bivak yang terkena angin malam. Senior \nmemberiku obat dan memintaku beristirahat, tapi aku bersikeras ingin tetap ikut penjelajahan. \"Sakit \nboleh, tapi menyerah? Tidak!\"   \n \nHari Kedua: Kreativitas di Tengah Keterbatasan \nSabtu, 5 Juli 2025 \nHari ini kami berpindah ke lokasi camping di tengah hutan. Ada situasi unik: tiga dari kami \nperempuan sedang datang bulan, termasuk aku. Aturannya, kami tidak boleh ikut susur sungai. Alih- \nalih berdiam diri, kami justru mendapat tugas khusus: mengumpulkan kayu bakar .  Di sinilah ide gila \nmuncul! Aku menyulap tongkat dan tali menjadi tandu portable untuk mengangkut kayu bakar . \nTernyata inovasi sederhana ini sangat membantu dan mendapat pujian dari para senior . Pelajaran \nhari ini: keterbatasan bukan halangan untuk berkontribusi!   \n \nHari Ketiga: Ujian Nyali dan Kekompakan \nMinggu, 6 Juli 2025 \nHari paling menantang! Kami dalam kelompok berisi 11 orang untuk menjelajahi hutan lebih dalam. \nTujuannya jelas: menguatkan ikatan kekeluargaan. Medannya benar-benar menguji nyali - lereng \ncuram, jalur licin, dan teknik vertical rescue yang memacu adrenalin. Meski masih merasakan efek \nsakit, semangatku terus menyala melihat kebersamaan teman-teman. Malam penutupan diisi \ndengan sesi berbagi cerita yang menghangatkan hati di tengah dinginnya malam hutan.   \n \nHari Terakhir: Haru dan Kenangan yang Melekat \nMinggu, 7 Juli 2025 \nPagi itu, upacara penutupan berlangsung penuh emosi. Tak merasa air mata mengalir saat menyadari \npetualangan indah ini akan berakhir . Setelah makan siang bersama, kami kembali ke kampus dengan \nmembawa segudang kenangan. kegiatan terakhir adalah membersihkan peralatan. Setiap debu yang \nterhapus seolah mengingatkan pada setiap momen berharga yang kami alami bersama.   \n \nRefleksi Akhir: Lebih dari Sekadar Perjalanan   \nIni bukan sekadar kegiatan outdoor biasa. Setiap tantangan fisik ternyata menyimpan pelajaran hidup \nyang mendalam. Kami belajar tentang:   \n- Arti sebenarnya dari kerja tim   \n- Kekuatan tekad yang bisa mengalahkan keterbatasan fisik   \n- Keindahan berbagi dalam kesederhanaan   \n- Keberanian menghadapi ketakutan   \nMomen-momen seperti melihat bintang di tengah hutan, tertawa bersama mengusir dinginnya \nmalam, atau saling mendukung saat lelah - semua itu telah membentuk ikatan yang tak akan pernah \nterlupakan."
        ],
        [
            'penulis' => 'Fiantika Sherly Apriyani',
            'judul' => 'Laporan Perjalanan Diklat Akhir Bidang Navigasi Darat di Bade',
            'konten' => "Catatan perjalanan Diklat akhir Cakra Manggala\nLokasi : Bade, Dagangan 4 -7  juli 2025\n Jumat, 4 Juli 2025\nHari pertama kegiatan dimulai dengan keberangkatan dari kampus pukul 09.00 pagi untuk melakukan \npersiapan alat. Selanjutnya, seluruh peserta mengikuti upacara pembukaan pada pukul 10.00 pagi. \nSuasana terasa khidmat dan penuh semangat.\nSetelah upacara selesai, sekitar pukul 13.00 siang, kami berangkat menuju lokasi kegiatan di Bade, \nDagangan. Perjalanan memakan waktu sekitar dua jam dan kami tiba di sanggar dekat lapangan voli \nsekitar pukul 15.00 sore.\nSetibanya di sana, kami langsung dibagi ke dalam beberapa tim dan diberi tugas untuk membangun bivak \nsebagai tempat bermalam. Kami menggunakan \ufb02ysheet dan senior menyediakan terpal tambahan untuk \nmembuat bivack. Dua kelompok memutuskan untuk bergabung dan membangun satu bivak besar secara \nbersama-sama.\nMokum harinya, setelah waktu ishoma, kami menerima materi penggunaan kompas malam. Kegiatan ini \ncukup menantang karena dilakukan dalam kondisi gelap, namun sangat bermanfaat. Setelah itu, kami \nberistirahat untuk persiapan penjelajahan esok hari.\nSabtu, 5 Juli 2025\nHari kedua diawali dengan penjelajahan yang dimulai pagi hari. Jalur penjelajahan cukup beragam, \nmelintasi sungai, hutan, dan perkebunan karet. Sepanjang perjalanan, kami menerima materi navigasi \ndarat dan teknik penggunaan peta serta kompas.\nPada titik tertentu, kami menemui jalur yang curam, dan diminta menggunakan chest harness demi \nkeselamatan. Tantangan semakin terasa saat saya terpisah dari kelompok. Ketika kelompok saya \nmngikuti materi susur sungai, saya mendapat tugas untuk mengumpulkan kayu sepanjang jalan menuju \nlokasi kembali.\nSore harinya, seluruh peserta kembali berkumpul untuk mengikuti materi \ufb01re starter yang mengajarkan \ncara membuat api dari alam. Malam harinya diisi dengan ishoma dan istirahat.\nMinggu, 6 Juli 2025\nHari ketiga dimulai dengan penggunaan sit harness karena jalur yang akan ditempuh cukup curam. Kami \ndiberikan materi vertical rescue, yang sangat menarik dan memacu adrenalin.\nMenjelang sore, kami diarahkan untuk melewati sungai dan melakukan praktik repling. Sayangnya, cuaca \nkurang mendukung, sehingga hanya beberapa orang saja yang bisa melanjutkan kegiatan. Sebagian \npeserta lainnya diarahkan untuk kembali dan membangun bivak tambahan sebagai tempat berteduh.\n\nPada saat itu saya mulai merasa tidak enak badan dan jatuh sakit. Sementara itu, teman-teman saya tetap \nmelanjutkan kegiatan dan membangun bivak di tempat yang sama seperti malam sebelumnya. Saya baru \nkembali malam harinya untuk menjemput teman-teman yang sudah kedinginan.\nMalam ditutup dengan sesi sharing bersama senior, membahas pengalaman dan pelajaran yang diperoleh. \nSetelah itu kami melakukan ishoma dan istirahat.\n Senin, 7 Juli 2025\nHari terakhir kegiatan dimulai dengan upacara penutupan sekitar pukul 08.00 pagi. Suasana haru terasa \nsaat banyak dari kami menangis, terharu atas kebersamaan yang telah terjalin selama beberapa hari.\nSetelah upacara, kami menikmati makan bersama, lalu bersiap-siap untuk pulang ke kampus pada pukul \n13.00 siang. Sesampainya di kampus, kami langsung melanjutkan kegiatan dengan membersihkan seluruh \nalat dan perlengkapan bersama-sama sebagai penutup dari kegiatan yang luar biasa ini.\n Penutup\nKegiatan ini bukan hanya sekadar perjalanan \ufb01sik, tetapi juga perjalanan batin dan pembelajaran. \nKebersamaan, kerja tim, semangat pantang menyerah, dan pengalaman menghadapi tantangan alam akan \nmenjadi kenangan tak terlupakan."
        ],
        [
            'penulis' => 'Irham Najib Azimul Qowi',
            'judul' => 'Laporan Perjalanan Pendidikan dan Latihan Akhir Hutan Karet Segulung',
            'konten' => "Catatan Perjalanan Diklat Akhir UKM \nCakra Manggala \nNama: Irham Najib Azimul Qowi \nTanggal: 4 – 7 Juli 2025 \nLokasi: Hutan Karet Segulung – Dagangan \n \nHari Pertama – Jumat, 4 Juli 2025 \nPagi itu saya memulai hari seperti biasa dengan menyelesaikan pekerjaan rumah. Karena \ncukup banyak hal yang harus dibereskan, saya terlambat menuju kampus. Kami \ndijadwalkan berkumpul pukul 08.30 WIB, tetapi saya baru tiba sekitar pukul 10.00.  \n \nSesampainya di kampus, saya baru menyadari beberapa hal penting belum saya siapkan: \nbekal makan siang, bekal sore, dan surat keterangan sehat. Karena terlalu fokus pada \nperlengkapan pribadi, saya terlambat mengurus surat sehat. Saat mencoba ke puskesmas, \nternyata mereka sudah tutup karena hanya buka hingga pukul 10.00 pada hari Jumat. Saya \npun tetap mengikuti diklat ta npa membawa surat sehat.  \n \nSetelah salat Jumat, kami mengikuti upacara pembukaan Diklat Akhir. Selesai upacara, kami \nbersiap menuju lokasi kegiatan di Segulung, Dagangan. Saya sempat ragu membawa motor \npribadi karena khawatir dengan kondisi jalan. Namun, se telah bertanya kepada salah satu \nsenior, Kak Jakwan, yang memastikan jalannya cukup baik, saya pun memutuskan \nbawa motor.  \n \nKami sempat menunggu salah satu peserta yang mengalami kendala dalam perjalanan. \nSetelah semuanya lengkap, kami berangkat bersama dan tiba sekitar pukul 15.00 WIB. Kami \nberhenti di dekat lapangan voli dan memutuskan untuk berkemah di sana untuk malam \npertama. \n \nSetiap tim membawa flysheet masing -masing dan diberikan tambahan terpal oleh senior. \nAlih-alih membuat bivak kecil per tim, k ami sepakat membangun satu bivak besar \nmenggunakan terpal, sedangkan flysheet digunakan sebagai alas luar. Sebelum membangun \nbivak, kami terlebih dahulu membersihkan area perkemahan.  \n \nSekitar pukul 17.00, warga sekitar mulai berdatangan untuk bermain voli.  Sambil \nmenikmati suasana, kami menyelesaikan pembangunan bivak dan diberi waktu istirahat \nhingga pukul 19.00. Kami memanfaatkan waktu tersebut untuk salat, beristirahat, dan \nmenikmati bekal.  \n \n\nMalam harinya, kami mendapatkan materi Kompas Malam. Kami diber i koordinat dan \ndiminta menelusuri jalur yang membentuk pola tertentu. Rencana awalnya kami akan \nbergantian menjaga api unggun, namun para senior memberi kami waktu istirahat penuh \nagar siap menghadapi hari berikutnya yang lebih berat. \nHari Kedua – Sabtu, 5 Juli 2025 \nPagi itu kami bersiap pindah to lokasi perkemahan yang lebih dalam, di tengah hutan karet. \nJalur yang kami lewati cukup menantang, dengan tanjakan dan turunan terjal. Sepanjang \nperjalanan, kami mendapatkan tugas -tugas seperti praktik navigasi d arat serta penggunaan \nchest harness dan sit harness dalam pembuatan alat pengaman.  \n \nSetelah perjalanan yang cukup panjang, kami berhenti untuk istirahat dan makan siang. \nSelanjutnya, kegiatan berlanjut dengan susur sungai bersama para demisioner. Teman -\nteman perempuan yang sedang haid diperbolehkan tidak mengikuti kegiatan ini. Hanya \nsatu dari empat peserta perempuan yang ikut serta.  \n \nKegiatan susur sungai berlangsung menantang dan menyenangkan. Kami harus menjaga \nkeseimbangan saat melewati jalur licin dan memastikan carrier tetap kering. Di tengah \nkegiatan, kami juga melakukan praktik rock climbing di dekat air terjun. Saya sempat \nkesulitan karena salah mencengkeram batu, sehingga harus dibantu teman dari atas untuk \nnaik. \n \nSetelah selesai, kami tiba di loka si perkemahan kedua dan diberi waktu untuk mengganti \npakaian. Karena kondisi tempat terbuka, kami harus kreatif menyusun strategi agar bisa \nberganti pakaian tanpa terlihat, sebuah tantangan yang tak terduga namun cukup \nmenghibur. \n \nSore harinya, kami mendap atkan materi pembuatan bivak dan penggunaan fire starter. \nMasing-masing tim membangun bivaknya sendiri untuk bermalam. \nHari Ketiga – Minggu, 6 Juli 2025 \nHari ketiga diisi dengan kegiatan Vertical Rescue, dan saya langsung mengajukan diri \nkarena sangat tert arik. Saya dan seorang peserta perempuan lainnya bertugas \nmengevakuasi \u201ckorban\u201d dari atas ketinggian menggunakan teknik penyelamatan.  \n \nDi sinilah saya benar -benar menguji ingatan terhadap simpul -simpul tali seperti simpul \njangkar dan simpul pengaman. Untun gnya pelatih turut serta mendampingi dan membantu \nmengingatkan simpul yang harus digunakan. Medan yang licin serta beratnya \u2018korban\u2019 \nmenjadi tantangan tersendiri, namun kami berhasil menyelesaikan misi.  \n \nRangkaian berikutnya adalah rappelling, namun hujan deras turun saat baru setengah \n\npeserta mencoba. Kami diarahkan ke kamp senior untuk berteduh dan beristirahat sambil \nmemakai ponco.  \n \nSetelah hujan mereda, kami kembali to kamp utama. Dalam perjalanan saya tidak sadar \ntelah meninggalkan slayer saya. Setiban ya di kamp, kami segera membangun dua bivak: \nsatu sebagai tempat tidur untuk dua tim, dan satu lagi untuk melindungi api unggun dari \nhujan. \n \nMalam itu hujan tidak berhenti. Kami tidak bisa menyalakan api unggun, sehingga memasak \npun tidak memungkinkan. Sem ua peserta berkumpul di dalam bivak untuk menghangatkan \ndiri, berbincang santai, dan makan camilan hingga pukul 22.00.  \n \nKemudian kami dipanggil ke kamp senior untuk sesi sharing. Kami ditanya alasan \nbergabung, kesan selama mengikuti kegiatan, dan refleksi pribadi. Setelah itu, kami kembali \nke bivak untuk beristirahat. \nHari Keempat – Senin, 7 Juli 2025 \nPagi itu menjadi momen penutup diklat. Kami mengikuti upacara penutupan dan \npenyematan, lalu dilanjutkan dengan makan bersama. Suasana begitu hangat, penuh ra sa \nsyukur karena seluruh peserta berhasil menyelesaikan rangkaian kegiatan.  \n \nMeski performa fisik saya belum maksimal karena sudah lama tidak berolahraga, saya \nsangat bersyukur dapat menyelesaikan diklat ini dengan baik. Banyak pelajaran berharga \nyang saya dapatkan, mulai dari teknis lapangan hingga kerja sama tim dan manajemen diri. \nPenutup \nDiklat akhir ini menjadi pengalaman yang sangat berarti. Tidak hanya menguatkan fisik dan \mental, tetapi juga mempererat rasa kebersamaan dan menumbuhkan cinta terhadap  alam. \nSaya merasa beruntung bisa menjadi bagian dari proses ini. Terima kasih, Cakra Manggala, \natas pengalaman luar biasa yang akan terus saya kenang."
        ],
        [
            'penulis' => 'Samsul Musadad',
            'judul' => 'Laporan Perjalanan Pendidikan dan Latihan Akhir Angkatan 13 di Bade',
            'konten' => "Laporan perjalanan\n\nPendidikan dan Latihan Akhir Cakra Manggala\n\nDisusun Oleh : \n\nSamsul musadad / 244314048 / TRE2B\n\nMAHASISWA PECINTA ALAM\n\nPOLITEKNIK NEGERI MADIUN\n\nLaporan perjalanan \n\n\tHaii sebelumnya perkenalkan nama saya Samsul Musadad. Saya adalah mahsiswa prodi D4 Teknologi Rekayasa Elektronika, Politeknik Negeri Madiun. Saya merupakan anggota muda Mahasiswa Pecinta Alam \u201cCakra Manggala\u201d dan setelah menulis laporan perjalanan ini saya resmi di lantik menjadi \u201cAngota Mahasiswa Pecinta Alam Cakra Manggala\u201d. Di acara diklat akhir ini di ikuti oleh 7 orang mahasiswa yaitu: Saya, Akfin, Fauzi, Reza, Najib, Noval, Arif. Dan ada 4 orang mahasiswi yaitu: Amay, Triana, Sherly, dan Reva. Disini saya akan menceritakan laporan perjalanan \u201cPendidikan dan Latihan Akhir Cakra Manggala Angkatan 13\u201d.\n\nJum\u2019at, 4 July 2025.\n\n\tPukul 09.35  WIB saya berangkat dari asrama menuju ke kampus Politeknik Negeri Madiun, setelah sampai disana saya langsung menuju ke sekertariat Cakra Manggala, disana sudah ada beberapa teman saya yang sudah sampai di antaranya yaitu Reza, Amay, dan Akfin dan beberapa senior. Dan setelah beberapa menit menunggu teman-teman saya mulai berdatangan. Saat pukul menunujukan 10.00 WIB dilakukan upacara pembukaan \u201cPendidikan dan Latihan Akhir Cakra Manggala Angkatan \u201d. Saat upacara berlangsung saya dan teman-teman mengikuti upacara secara khidmat. Setelah upacara pembukaan selesai, saya melaksanakan sholat jum\u2019at sebelum berangkat ke tempat diklat akhir. Tempat diklat akhir saya yang terletak di Bade, Segulung, Madiun. \n\n\tSetelah saya selesai solat jum\u2019at kami berkumpul lagi untuk segera menuju ke tempat diklat. Perjalanan di tempuh kurang lebih 2 jam dari kampus Politeknik Negeri Madiun. Setelahnya tiba di Bade saya dan teman-teman melakukan packing ulang barang untuk mengecek apakah ada barang yang tertinggal. Ketika waktu menunjukan pukul 16.00 WIB kami di beri waktu 1 jam oleh senior untuk membuat bivak dengan menggunakan terpal. Dan akhirnya bivak sudah berdiri dengan kokoh dan kita bisa menyinggahi bivak tersebut untuk makan malam bersama. Dan setelah selesai makan kamipun beristirahat untuk tidur.\n\n\tPada pukul 23.00 WIB kami di suruh berkumpul oleh senior untuk melakukan materi, materi pada malam hari itu adalah \u201cKompas Malam\u201d tujuan dari materi ini adalah untuk mengajarkan bagaimana menggunakan Kompas di minim cahaya atau di malam hari. Dan setelah materi Kompas selesai kami melanjutkan istirahat lagi.\n\nSabtu, 5 July 2025.\n\n\tPukul 04.00 WIB saya dan teman-teman di bangunkan oleh senior untuk segera solat subuh and mempersiapkan makan pagi dan pada saat pukul 05.30 WIB tempat kita untuk mendirikan bivak harus bersih dan tidak ada sampah yang tertinggal. Setelah itu kita melaksanakan pemanasan yaitu senam pagi, yang bertujuan untuk memperkuat sendi-sendi kita dan juga \u201csendiriannn\u201d hahaha. Yok lanjut, setelah melaksanakan senam pagi kita melanjutkan kegiatan jalan mengelilingi ladang warga dengan di damping senior Maul dan senior noval. Saya dan teman-teman menempuh kurang lebih 7 Km perjalanan dari mulai titik awal pesangrahan. Saat melakukan perjalanan di ladang warga kita juga bernyanyi lagu Cakra Manggala. Saya dan teman-teman bernyanyi dengan senang dan gembira.\n\n\tDi sela-sela perjalanan kami juga di beri materi navigasi dan juga materi membuat hardnes. Dan di pertengahan perjalanan kami istirahat makan siang. Di sini saya mengira akan melanjutkan jalan melewati ladang-ladang warga, ternyata perjalanan selanjutnya adalah menyusuri sungai di sini kami di temani oleh demisioner A\u2019nan, Ibnu, dan Lintang. Kami menyusuri sungai kurang lebih 1 Km. dengan medan bebatuan, dan melewati air terjun. Saat melewati air terjun kita di wajibkan untuk membuat \u201cbody hardness\u201d karena melewati air terjun sangat memerlukan body hardness. Ketika melewati sungai kita harus selalu tetap saling membantu sesame teman. Setelah menempuh susur sungai yang melelahkan dan seru akhirnya kita sampai pada camp sedawung. \n\n\tWaktu menunjukan pukul 14.45 WIB kami pun diberi waktu 30 menit untuk mendirikan bivak. Setelah bivak sudah berdiri kami di beri materi tentang fire starter, materi ini di sampaikan oleh Ketua Umum kami yaitu Senior Satria. Di sini kami mempelajari tentang segitiga api. Apa itu segitiga Api ? segitiga api merupakan model sederhana yang menggambarkan 3 unsur yang di perlukan untuk membuat api; panas, bahan bakar, dan oksigen. Ke 3 elemen tersebut harus ada secara bersamaan untuk menciptakan api. Setelah materi dari senior Satria selesai. Kami pun istirahat dan menyiapkan makan malam. Istirahat malam pada hari sabtu sangatlah Panjang di karenakan besok kita akan melakukan kegiatan yang sangat melelahkan dan seru.\n\nMinggu, 6 July 2025.\n\n \tPagi hari kita dibangunkan untuk membuat sarapan dan lanjut senam pagi dan ada sedikit hadiah dari senior hahaha. Kita menikmati senam pagi secara senang dan gembira. Setelah senam pagi senior memerintah kami untuk segera membersihkan tempat camp tanpa meninggalkan sampah sedikitpun. Dan kami melanjutkan perjalanan lagi sambil bernyanyi, setelah berjalan beberapa menit kita pun mendapatkan materi lagi yaitu \u201cVertical rescue\u201d, disini kita dilatih untuk menyelamatkan korban yang tersesat, saat perjalanan Sebagian teman-teman menemukan barang-barang korban, dari pakaian, slayer dan headlamp. Disini kami di bagi menjadi 2 kelompok. Kelompok 1 yang beranggota Arif, Triana, sherly, Noval dan saya mendapat perintah membuat tandu penolong. Dan kelompok 2 sebagai rescuer yang beranggota Akfin, najib, Reza dan Amay. dan tersisa 2 orang belayer orang yang bertugas sebagai penarik tali yaitu Fauzi dan Reva. Di sini kita dituntut untuk bekerja sama untuk menyelamatkan korban. Kegiatan ini sangatlah melelahkan dan seru lalu kamipun itirahat dan makan siang. \n\n\tSesudahnya makan siang kami berkemas dan mulai tracking. 10 menit dari tempat istirahat kami di tujukan pada air terjun untuk melakukan materi selanjutnya yaitu canyonering. Sebagian teman-teman saya sudah turun canyonering dikarenakan cuaca yang sangat buruk saya dan 5 teman saya tidak jadi untuk canyonering dan kamipun kembali to tempat istirahat saat itu hujan sudah membasahi badan kami, sesegera kami mendirikan bivak untuk berteduh dari guyuran air hujan. Di karenakan hujan yang tidak reda-reda kamipun di bawa ke basecamp induk tempat istirahat para senior-senior. Saya kira kami digiring kesana untuk istirahat, ternyata ada sedikit hadiah dari senior agar kami tidak terkena hipotermia karena kedinginan, maksud saya kami mengerjakan SET HAHAHA.\n\n\tDan akhirnya hujan pun mulai reda, kami pun di hantarkan ke tempat camp yaitu di sedawung. Kami di tuntut untuk membuat bivak dengan ke adaan basah kuyup, dan keadaan tanah di pelataran sedawung sangatlah becek. Dan sesegeralah kami mendirikan 1 bivak untuk beristirahat dan 1 bivak untuk di perapian. Setelah semua berdiri dengan kokoh kami mulai beristirahat dan memasak untuk makan malam. Mungkin sekitar pukul 21.00 WIB kami di undang di basecamp induk untuk sharing-sharing bersama senior. Di sana kami pun menikmati beberapa hidangan dari senior, kami pun menikmatinya dengan senang. Setelah beberapa lama sharing kamipun kembali to tempat camp untuk beristirahat.\n\n Senin, 7 July 2025.\n\n\tDan di senin pagi kami mulai dengan senam dan sedikit hadiah dari senior, setelah sedikit pemanasan kami mulai mempacking dan tidak meninggalkan sedikitpun sampah dan langsung di arahkan senior untuk menuju ke tempat basecamp induk. Di basecamp induk kami melaksanakan upacara penutupan dan pelantikan Anggota Cakra Manggala. Setelah saya di lantik tangis haru, suka cita menjadi satu. Dan rasa bangga bisa menjadi bagian dari Cakra manggala."
        ]
    ];

    $user = \App\Models\User::first();
    if (!$user) {
        $user = \App\Models\User::create([
            'name' => 'Admin Cakra Manggala',
            'email' => 'admin@cakramanggala.com',
            'password' => bcrypt('admin123'),
            'role' => 'admin',
        ]);
    }
    $userId = $user->id;

    foreach ($logs as $log) {
        \App\Models\CatatanPerjalanan::create([
            'judul' => $log['judul'],
            'penulis' => $log['penulis'],
            'angkatan' => 'Anggota Muda',
            'tanggal_perjalanan' => '2025-07-04',
            'lokasi' => 'Bade, Dagangan, Madiun',
            'deskripsi' => 'Catatan perjalanan oleh ' . $log['penulis'],
            'konten' => $log['konten'],
            'status' => 'published',
            'kegiatan_id' => $kegiatanId,
            'user_id' => $userId,
        ]);
    }

    return "SUCCESS: Database successfully synchronized with SK 2026/2027 and formal titles!";
});

// Fallback storage route to serve images on shared hosting where symbolic links might be missing
Route::get('/storage/{folder}/{filename}', function ($folder, $filename) {
    $path = storage_path('app/public/' . $folder . '/' . $filename);
    if (!file_exists($path)) {
        abort(404);
    }
    $file = file_get_contents($path);
    $type = mime_content_type($path);
    return response($file, 200)->header('Content-Type', $type);
})->where('folder', '[a-zA-Z0-9_\\-]+')->where('filename', '[a-zA-Z0-9_\\-\\.]+');

// Homepage routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('home.alt');

// Static pages routes
Route::get('/tentang-kami', [HomeController::class, 'about'])->name('about');
Route::get('/kegiatan', [HomeController::class, 'activities'])->name('activities');
Route::get('/kegiatan/{id}', [HomeController::class, 'activityDetail'])->name('activities.show');
Route::get('/bergabung', [HomeController::class, 'join'])->name('join');
Route::get('/kontak', [HomeController::class, 'contact'])->name('contact');
Route::post('/kontak/kirim', [HomeController::class, 'sendContact'])->name('contact.send');
Route::get('/struktur-kepengurusan', [StrukturController::class, 'index'])->name('struktur-kepengurusan');

// Pendaftaran routes
Route::post('/bergabung', [HomeController::class, 'storePendaftaran'])->name('join.store')->middleware('recaptcha');
Route::get('/bergabung/sukses/{id}', [HomeController::class, 'joinSuccess'])->name('join.success');

// Frontend Artikel routes (PUBLIC - no auth required)
Route::get('/artikel', [ArtikelController::class, 'index'])->name('artikel.index');
Route::get('/artikel/{slug}', [ArtikelController::class, 'show'])->name('artikel.show');

// Frontend Catatan Perjalanan routes (PUBLIC - no auth required)
Route::get('/catatan-perjalanan', [\App\Http\Controllers\CatatanPerjalananController::class, 'index'])->name('catatan-perjalanan.index');
Route::get('/catatan-perjalanan/tambah', [\App\Http\Controllers\CatatanPerjalananController::class, 'tambahForm'])->name('catatan-perjalanan.tambah');
Route::post('/catatan-perjalanan/tambah/kirim-otp', [\App\Http\Controllers\CatatanPerjalananController::class, 'kirimOtp'])->name('catatan-perjalanan.kirim-otp');
Route::post('/catatan-perjalanan/tambah/simpan', [\App\Http\Controllers\CatatanPerjalananController::class, 'simpanCatatan'])->name('catatan-perjalanan.simpan');
Route::post('/catatan-perjalanan/tambah/reset', [\App\Http\Controllers\CatatanPerjalananController::class, 'resetTambahForm'])->name('catatan-perjalanan.reset');
Route::get('/catatan-perjalanan/{slug}', [\App\Http\Controllers\CatatanPerjalananController::class, 'show'])->name('catatan-perjalanan.show');

// Authentication routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->middleware('recaptcha');
});

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard routes
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Dashboard Catatan Perjalanan CRUD (ADMIN & MODERATOR)
    Route::prefix('dashboard')->name('dashboard.')->middleware('role:admin,moderator')->group(function () {
        Route::resource('catatan-perjalanan', \App\Http\Controllers\Dashboard\CatatanPerjalananController::class);
        Route::patch('catatan-perjalanan/{catatan_perjalanan}/toggle-status', [\App\Http\Controllers\Dashboard\CatatanPerjalananController::class, 'toggleStatus'])
            ->name('catatan-perjalanan.toggle-status');
    });

    // Data Pendaftar routes (ADMIN ONLY - Sensitive Data)
    Route::middleware('role:admin')->group(function () {
        Route::get('/dashboard/pendaftar', [PendaftarController::class, 'index'])->name('dashboard.pendaftar');
        Route::get('/dashboard/pendaftar/export', [PendaftarController::class, 'export'])->name('dashboard.pendaftar.export');
        Route::get('/dashboard/pendaftar/export-simple', [PendaftarController::class, 'exportSimple'])->name('dashboard.pendaftar.exportSimple');
        Route::get('/dashboard/pendaftar/{pendaftar}', [PendaftarController::class, 'show'])->name('dashboard.pendaftar.show');
        Route::patch('/dashboard/pendaftar/{pendaftar}/approve', [PendaftarController::class, 'approve'])->name('dashboard.pendaftar.approve');
        Route::patch('/dashboard/pendaftar/{pendaftar}/reject', [PendaftarController::class, 'reject'])->name('dashboard.pendaftar.reject');
        Route::get('/dashboard/pendaftar/{pendaftar}/edit', [PendaftarController::class, 'edit'])->name('dashboard.pendaftar.edit');
        Route::put('/dashboard/pendaftar/{pendaftar}', [PendaftarController::class, 'update'])->name('dashboard.pendaftar.update');
        Route::delete('/dashboard/pendaftar/{pendaftar}', [PendaftarController::class, 'destroy'])->name('dashboard.pendaftar.destroy');
    });

    // Dashboard Routes (Authenticated & Role Protected)
    Route::prefix('dashboard')->name('dashboard.')->middleware('role:admin')->group(function () {
        // Artikel CRUD
        Route::resource('artikel', DashboardArtikelController::class);

        // Toggle status artikel (publish/unpublish)
        Route::patch('artikel/{artikel}/toggle-status', [DashboardArtikelController::class, 'toggleStatus'])
            ->name('artikel.toggle-status');

        // Kegiatan CRUD
        Route::resource('kegiatan', KegiatanController::class);

        // Pengurus CRUD (ADMIN ONLY)
        Route::resource('pengurus', \App\Http\Controllers\Dashboard\PengurusController::class)->middleware('role:admin');

        // Pesan Management
        Route::get('pesan', [DashboardController::class, 'messages'])->name('pesan');
        Route::get('pesan/{pesan}', [DashboardController::class, 'showMessage'])->name('pesan.show');
        Route::delete('pesan/{pesan}', [DashboardController::class, 'destroyMessage'])->name('pesan.destroy');

        // Inventaris (Equipment Management)
        Route::get('inventaris', [\App\Http\Controllers\Dashboard\InventoryController::class, 'index'])->name('inventaris.index');
        Route::get('inventaris/kegiatan/{id}', [\App\Http\Controllers\Dashboard\InventoryController::class, 'showKegiatan'])->name('inventaris.kegiatan');
    });

    // Future routes for dashboard modules
    // Route::get('/dashboard/galeri', [DashboardController::class, 'galeri'])->name('dashboard.galeri');
});
