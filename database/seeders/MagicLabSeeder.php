<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MagicLabSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Mentalism',
                'slug' => 'mentalism',
                'description' => 'Seni membaca pikiran, memprediksi masa depan, dan menjelajahi batas psikis manusia.',
                'history' => 'Mentalism adalah salah satu aliran seni pertunjukan paling memukau dan misterius di dunia. Seorang mentalist tampaknya memiliki kemampuan supranatural — mampu membaca pikiran orang lain, memprediksi kejadian sebelum terjadi, bahkan memengaruhi keputusan seseorang tanpa mereka sadari.

Akar mentalism bisa ditelusuri hingga abad ke-18, ketika para "mesmeris" seperti Franz Anton Mesmer mengklaim memiliki kekuatan magnetis untuk memengaruhi tubuh dan pikiran manusia. Dari sana, lahirlah pertunjukan-pertunjukan yang memadukan hipnosis, telepati palsu, dan psikologi.

Di era modern, mentalism meledak popularitasnya lewat sosok-sosok seperti Derren Brown, Uri Geller, dan Max Maven. Mereka membuktikan bahwa tanpa satu pun "kekuatan nyata", seorang mentalist bisa membuat ribuan orang merasa benar-benar dibaca pikirannya.

Teknik inti mentalism meliputi: cold reading (membaca seseorang dari isyarat visual), hot reading (riset diam-diam sebelum pertunjukan), misdirection psikologis, dan penggunaan prinsip-prinsip statistik. Hasilnya? Pengalaman yang terasa supernatural, tapi sepenuhnya berbasis ilmu pengetahuan tentang perilaku manusia.',
                'image_path' => null,
            ],
            [
                'name' => 'Card Magic',
                'slug' => 'card-magic',
                'description' => 'Manipulasi kartu yang memadukan kecepatan tangan, ilusi visual, dan keanggunan artistik.',
                'history' => 'Card magic — atau sering disebut cardistry ketika berbicara soal manipulasi visual — adalah salah satu tradisi sulap tertua dan paling dihormati dalam dunia ilusi. Sebuah deck 52 kartu sederhana menjadi senjata paling kuat di tangan seorang master.

Sejarahnya dimulai di Eropa abad ke-15, ketika kartu remi pertama kali masuk ke benua itu dari dunia Arab dan Cina. Para penipu jalanan segera menyadari potensi kartu sebagai alat manipulasi. Tapi baru di abad ke-19 lah card magic mencapai bentuk artistiknya yang sesungguhnya, berkat Herrmann the Great dan Jean Robert-Houdin.

Abad ke-20 menyaksikan revolusi card magic lewat Dai Vernon — dijuluki "The Professor" — yang menghabiskan hidupnya menyempurnakan teknik-teknik yang bahkan bisa menipu Houdini. Lalu muncul Juan Tamariz dari Spanyol, yang mengangkat card magic ke level filsafat dan puisi.

Dalam card magic modern, teknik seperti false shuffle, double lift, palming, dan card control dikombinasikan dengan presentasi psikologis yang kuat. Hasilnya bukan sekadar trik — melainkan sebuah pengalaman yang membuat penonton mempertanyakan realita yang mereka lihat.',
                'image_path' => null,
            ],
            [
                'name' => 'Stage Illusion',
                'slug' => 'stage-illusion',
                'description' => 'Ilusi berskala besar di atas panggung — menghilangkan gajah, memotong manusia, dan teleportasi spektakuler.',
                'history' => 'Stage illusion adalah puncak dari seni pertunjukan sulap — spektakel megah yang dirancang untuk memukau ratusan bahkan ribuan penonton sekaligus. Inilah dunia di mana manusia dipotong dua, wanita melayang di udara, dan gajah menghilang di depan mata.

Era keemasan stage illusion dimulai pada akhir abad ke-19 dengan John Nevil Maskelyne dan David Devant di London. Mereka adalah pionir yang mengubah sulap dari pertunjukan jalanan menjadi teater mewah berkelas tinggi. Robert-Houdin sebelumnya telah memperkenalkan konsep magician sebagai "gentleman illusionist" — tampil elegan, bukan sebagai penipu jalanan.

Harry Houdini, meski lebih dikenal sebagai escape artist, membawa stage illusion ke level sensasi massa yang belum pernah ada sebelumnya. Kemudian di akhir abad ke-20, muncul David Copperfield yang membawa Patung Liberty menghilang dan berjalan menembus Tembok Besar China — mengukuhkan stage illusion sebagai seni global.

Di era modern, Siegfried & Roy, Criss Angel, dan Dynamo mengeksplorasi batas-batas stage illusion hingga ke luar ruangan — jalanan kota, tebing gunung, bahkan di atas air. Teknologi modern, engineering presisi, dan psikologi penonton digabung untuk menciptakan momen yang tidak akan terlupakan seumur hidup.',
                'image_path' => null,
            ],
            [
                'name' => 'Close-Up Magic',
                'slug' => 'close-up-magic',
                'description' => 'Keajaiban yang terjadi tepat di depan mata Anda — tak ada jarak, tak ada tempat untuk bersembunyi.',
                'history' => 'Close-up magic — juga dikenal sebagai table magic atau strolling magic — adalah bentuk sulap yang paling intim dan paling jujur sekaligus. Tidak ada panggung besar, tidak ada pencahayaan dramatis, tidak ada asap. Hanya seniman, penonton, dan jarak beberapa sentimeter yang memisahkan keduanya.

Justru karena itulah, close-up magic dianggap sebagai ujian sesungguhnya seorang pesulap. Tidak ada yang bisa disembunyikan. Teknik harus sempurna, presentasi harus memikat, dan penonton ada tepat di depan mata — bisa menyentuh, bisa memeriksa, bisa mengawasi setiap gerakan.

Legenda close-up magic dimulai dari Dai Vernon, si "Professor", yang menghabiskan puluhan tahun menyempurnakan setiap detail teknik hingga benar-benar tak terdeteksi. Kemudian Slydini mengajarkan dunia bahwa misdirection sejati tidak terjadi di tangan — tapi di mata dan pikiran penonton.

Di era kontemporer, tokoh seperti Lennart Green dengan gaya chaotic-nya, Jason Burak dengan elegance modernnya, dan Richard Turner yang tampil sempurna meski buta — membuktikan bahwa close-up magic adalah seni yang tak terbatas. Sebuah koin, sebuah kartu, sebuah uang kertas — di tangan yang tepat, benda paling biasa bisa berubah menjadi jendela menuju dunia yang tidak masuk akal.',
                'image_path' => null,
            ],
            [
                'name' => 'Escape Art',
                'slug' => 'escape-art',
                'description' => 'Seni meloloskan diri dari borgol, rantai, peti terkunci, dan segala bentuk belenggu yang mustahil.',
                'history' => 'Escape art adalah genre sulap yang lahir dari satu nama: Harry Houdini. Pria bernama asli Ehrich Weiss ini mengubah konsep "meloloskan diri" dari sebuah trik menjadi sebuah drama manusia yang menggetarkan jiwa — pertarungan antara tubuh manusia melawan batas fisik yang tampak mustahil.

Houdini memulai kariernya di akhir abad ke-19 dengan escape sederhana dari borgol polisi. Tapi ambisinya tak terbatas. Ia kemudian menghadapi tantangan yang semakin ekstrem: dikubur hidup-hidup, digantung terbalik dalam straitjacket di ketinggian gedung, dikunci dalam Chinese Water Torture Cell yang diisi penuh air.

Apa yang membuat Houdini — dan para escape artist sejatinya — begitu memukau bukan sekadar teknik. Ini soal drama. Soal pertaruhan nyawa yang terasa nyata. Soal satu momen di mana penonton benar-benar tidak tahu apakah sang performer akan selamat atau tidak.

Setelah Houdini, escape art terus berevolusi. Dorothy Dietrich menjadi wanita pertama yang melakukan bullet catch di mulut sambil terikat straitjacket. Criss Angel mengeksekusi escape-escape ekstrem di depan jutaan penonton live TV. Di era digital, escape art menjadi konten viral — tapi esensinya tetap sama: manusia melawan ketidakmungkinan, dan menang.',
                'image_path' => null,
            ],
            [
                'name' => 'Levitation & Manipulation',
                'slug' => 'levitation-manipulation',
                'description' => 'Melayang di udara, bola kristal yang berdansa, dan objek yang bergerak seolah memiliki jiwa sendiri.',
                'history' => 'Levitation dan manipulation adalah dua sisi dari koin yang sama — seni membuat objek (atau bahkan manusia) bergerak, melayang, dan menari seolah gravitasi adalah opsional dan materi memiliki kesadaran sendiri.

Levitation manusia pertama yang tercatat secara luas adalah trik "Levitation of Princess Karnac" yang dipopulerkan oleh John Nevil Maskelyne pada 1875. Sejak itu, berbagai mekanisme cerdas dikembangkan untuk membuat tubuh manusia tampak melayang — dari yang menggunakan sandaran tersembunyi hingga teknologi magnet dan kabel optis yang hampir tak kasat mata.

Sementara itu, contact juggling dan ball manipulation — terutama dengan crystal ball — memiliki akar yang lebih tua, berasal dari tradisi akrobatik Asia dan circus Eropa. Michael Moschen di era 80-an membawa contact juggling ke level seni murni yang menghipnotis.

Di dunia contemporary magic, levitation telah berevolusi menjadi street levitation yang dipopulerkan Dynamo dan David Blaine — berdiri di jalanan, terangkat beberapa sentimeter dari tanah, disaksikan orang-orang yang merekam dengan ponsel mereka.',
                'image_path' => null,
            ],
            [
                'name' => 'Coin Magic',
                'slug' => 'coin-magic',
                'description' => 'Satu koin di jari yang tepat bisa menghilang, berpindah, dan berkembang biak di depan mata.',
                'history' => 'Coin magic adalah salah satu bentuk sulap paling universal di dunia. Tidak ada alat yang lebih mudah dijangkau daripada uang koin — dan tidak ada benda yang lebih sulit dikuasai oleh seorang pesulap pemula.

Sejarah manipulasi koin bisa ditelusuri ke Yunani Kuno, di mana para street performer menggunakan logam kecil untuk permainan tebak-tebakan. Pada abad ke-19, seni ini mencapai puncak tekniknya di tangan T. Nelson Downs — "The King of Koins" — yang mampu membuat koin muncul, menghilang, dan bertransformasi dengan kecepatan yang tidak bisa diikuti mata manusia.

Teknik inti coin magic meliputi: French Drop, Retention Vanish, Muscle Pass, dan berbagai jenis palming yang membutuhkan latihan ribuan jam untuk dikuasai. David Roth dan Derek Dingle kemudian mengangkat coin magic ke level seni performance yang sangat dihormati.

Di era modern, tokoh seperti Shoot Ogawa dari Jepang membawa estetika unik ke coin magic — memadukan origami, origami, dan manipulation dalam satu pertunjukan yang sempurna.',
                'image_path' => null,
            ],
            [
                'name' => 'Hypnosis Stage',
                'slug' => 'hypnosis-stage',
                'description' => 'Menundukkan kesadaran penonton dan memimpin mereka ke dunia di antara tidur dan terjaga.',
                'history' => 'Hypnosis stage adalah salah satu pertunjukan yang paling kontroversial sekaligus paling memukau dalam dunia hiburan. Seorang stage hypnotist mampu membuat sukarelawan dari penonton tertidur, merespons sugesti, dan melakukan hal-hal yang tidak akan pernah mereka lakukan dalam keadaan sadar.

Akar hipnosis modern bermula dari Franz Anton Mesmer di abad ke-18 dengan teori "animal magnetism" nya — meskipun kelak terbukti tidak ilmiah, praktiknya membuka jalan bagi penelitian tentang sugesti dan kondisi trance. James Braid kemudian memberikan nama "hypnosis" dan mulai mempelajarinya secara ilmiah.

Pada akhir abad ke-19, hipnosis memasuki panggung hiburan bersamaan dengan bangkitnya music hall dan vaudeville di Eropa. Ormond McGill — "The Dean of American Hypnotists" — kemudian mengkodifikasi teknik-teknik stage hypnosis dalam bukunya yang menjadi referensi para hypnotist seluruh dunia.

Stage hypnosis modern adalah perpaduan antara psikologi, teknik induksi, dan entertainment. Hypnotist seperti Paul McKenna dan Derren Brown membuktikan bahwa pikiran manusia adalah panggung yang paling tak terduga.',
                'image_path' => null,
            ],
            [
                'name' => 'Pickpocket Art',
                'slug' => 'pickpocket-art',
                'description' => 'Mengambil jam tangan, dompet, dan ikat pinggang seseorang tanpa mereka menyadarinya — sebagai seni panggung.',
                'history' => 'Pickpocket art — atau theatrical pickpocketing — adalah cabang sulap yang berdiri di garis tipis antara kejahatan dan seni. Di tangan seorang performer, kemampuan mencopet bukan untuk mencuri, tapi untuk menciptakan momen yang membuat penonton tertawa sekaligus merinding.

Apollo Robbins adalah nama paling penting dalam sejarah pickpocket art. Dijuluki "The Gentleman Thief," ia mampu mengambil jam tangan, pena, dompet, bahkan sabuk seseorang dalam hitungan detik — lalu mengembalikannya dengan senyum. Penelitian tentang tekniknya bahkan dipublikasikan dalam jurnal ilmiah tentang perhatian dan persepsi visual manusia.

Teknik pickpocketing artistik bergantung sepenuhnya pada misdirection — mengalihkan perhatian target ke satu titik sementara tangan bekerja di titik lain. Sentuhan harus natural, gerakan harus percaya diri, dan timing harus sempurna.

Bob Arno, James Freedman, dan Young & Strange adalah beberapa nama lain yang membawa pickpocket art ke televisi dan panggung internasional, membuktikan bahwa seni ini jauh lebih dari sekadar trik jalanan.',
                'image_path' => null,
            ],
            [
                'name' => 'Rope & Silk Magic',
                'slug' => 'rope-silk-magic',
                'description' => 'Tali yang terputus menyambung kembali, sutra yang menembus logam — keajaiban dari benda yang paling sederhana.',
                'history' => 'Rope magic dan silk magic mungkin terlihat sederhana di permukaan, tapi keduanya adalah fondasi dari banyak prinsip sulap paling fundamental yang ada. Dari sehelai tali atau kain, seorang pesulap bisa membangun pertunjukan yang membingungkan secara intelektual dan memukau secara visual.

Rope magic memiliki sejarah yang sangat panjang — berakar dari tradisi juggling dan street performance di Asia Tengah dan Timur Tengah sejak berabad-abad silam. The Cut & Restored Rope — tali dipotong dua lalu menyambung kembali — adalah trik yang sudah ada sebelum era moderen tapi tetap memukau hingga hari ini.

Silk magic, di sisi lain, mencapai puncaknya di era vaudeville Amerika ketika Cardini dan Channing Pollock memadukan manipulasi sutra dengan keanggunan akting panggung. Sutra yang berwarna-warni, ringan, dan mudah digenggam menjadi medium sempurna untuk ilusi visual.

Di era modern, tokoh seperti Eugene Burger mengangkat rope magic ke level storytelling — setiap tali yang dipotong dan menyambung menjadi sebuah metafora tentang kehidupan, kematian, dan harapan.',
                'image_path' => null,
            ],
            [
                'name' => 'Fire & Danger Acts',
                'slug' => 'fire-danger-acts',
                'description' => 'Api, pisau terbang, dan peluru — pertunjukan yang bermain dengan bahaya nyata sebagai kanvasnya.',
                'history' => 'Fire magic dan danger acts adalah genre pertunjukan yang paling membangkitkan adrenalin di seluruh spektrum seni sulap. Ketika api menyala di tangan seorang performer, batas antara seni dan bahaya menjadi sangat tipis — dan justru itulah yang membuat penonton tidak bisa mengedipkan mata.

Fire eating dan fire breathing telah ada sejak zaman kuno — ditemukan dalam tradisi festival di berbagai budaya Afrika, Asia, dan Polinesia, di mana api dianggap memiliki kekuatan spiritual. Ketika praktik ini masuk ke sirkus Eropa abad ke-18, ia berevolusi menjadi pertunjukan yang lebih teatrikal dan terstruktur.

Bullet catch — menangkap peluru yang ditembakkan dengan gigi — adalah salah satu aksi paling berbahaya dalam sejarah pertunjukan. Tercatat setidaknya 12 pesulap tewas dalam percobaan trik ini. Tapi bagi mereka yang berhasil menguasainya — seperti Penn & Teller — ini menjadi simbol keberanian dan kepercayaan yang paling dramatis.

Di era kontemporer, Cirque du Soleil mengintegrasikan fire acts ke dalam produksi teater besar-besaran. Sementara street performer modern menggabungkan fire manipulation dengan musik elektronik dan light show untuk menciptakan pengalaman multi-sensori yang benar-benar tak terlupakan.',
                'image_path' => null,
            ],
            [
                'name' => 'Street Magic',
                'slug' => 'street-magic',
                'description' => 'Membawa keajaiban keluar dari panggung teater, langsung ke aspal jalanan dan kerumunan tak terduga.',
                'history' => 'Street magic adalah bentuk sulap paling purba sekaligus paling modern. Jauh sebelum ada teater megah dengan pencahayaan dramatis, pesulap pertama adalah penghibur jalanan yang harus bertarung merebut perhatian pejalan kaki hanya bermodalkan karisma dan beberapa alat sederhana.

Tradisi ini bisa dilacak ke Cups and Balls yang dimainkan di jalanan Mesir kuno dan Eropa abad pertengahan. Para pesulap jalanan harus memiliki kemampuan unik: mereka harus bisa mengumpulkan massa (crowd building), menjaga massa agar tidak pergi (crowd control), dan yang paling penting, membuat massa bersedia membayar setelah pertunjukan selesai (passing the hat).

Revolusi besar street magic terjadi di akhir 1990-an ketika David Blaine muncul di televisi. Ia mengubah format pertunjukan: alih-alih fokus pada trik sang pesulap, kamera fokus pada reaksi jujur, terkejut, dan histeris dari penonton jalanan. Konsep "guerilla magic" ini mengubah wajah sulap selamanya.

Di masa kini, street magic sering beririsan dengan prank dan social experiment. Tanpa panggung, tanpa sudut kamera yang diatur, street magic tetap menjadi arena pembuktian paling brutal bagi seorang pesulap.',
                'image_path' => null,
            ],
            [
                'name' => 'Bizarre Magic',
                'slug' => 'bizarre-magic',
                'description' => 'Menyelami tema horor, okultisme, dan misteri gelap. Sulap yang ditujukan untuk merinding, bukan tertawa.',
                'history' => 'Bizarre magic (atau Bizarre Magick) adalah sub-genre sulap yang menggunakan teknik ilusi untuk menceritakan kisah-kisah gelap, horor, atau okultisme. Di sini, pesulap tidak tampil sebagai penghibur berjas rapi, melainkan sebagai seorang cenayang, pencerita kisah horor, atau penjaga artefak terkutuk.

Gerakan ini dimulai pada akhir 1960-an oleh tokoh-tokoh seperti Tony Andruzzi (Masklyn ye Mage) dan Charles Cameron. Mereka muak dengan sulap kotak bulu berwarna-warni dan kelinci dari topi yang dianggap kekanak-kanakan. Bizarre magic dirancang khusus untuk orang dewasa, bertujuan menyentuh emosi manusia yang paling primitif: rasa takut dan takjub pada hal gaib.

Pertunjukan bizarre magic jarang menggunakan kartu remi standar atau koin. Sebagai gantinya, mereka menggunakan boneka voodoo, tarot tua, pendulum berkarat, paku, peti mati kecil, dan darah palsu. Atmosfer adalah segalanya — pencahayaan redup, lilin, dan storytelling yang sangat kuat.

Meskipun audiensnya sangat tersegmentasi, Bizarre Magic sangat dihormati di kalangan pesulap. Ia membuktikan bahwa sulap bisa diangkat menjadi teater psikologis yang mendalam dan meninggalkan bekas permanen di pikiran penontonnya.',
                'image_path' => null,
            ],
        ];

        foreach ($categories as $cat) {
            \App\Models\Category::updateOrCreate(
                ['slug' => $cat['slug']],
                $cat
            );
        }
    }
}
