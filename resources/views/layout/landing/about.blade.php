<!-- about-area -->
<section id="about" class="about-area about-p pt-120 pb-120 p-relative">

    <div class="container">

        <div class="row align-items-center">

            <div class="col-lg-6">

                <div class="about-content s-about-content pl-30">

                    <div class="about-title second-atitle">

                        <div class="text-outline wow fadeInUp animated" data-animation="fadeInUp animated"
                            data-delay=".2s">

                            <span>SportSpace</span>

                        </div>

                        <span class="wow fadeInUp animated" data-animation="fadeInUp animated" data-delay=".3s">

                            Tentang SportSpace

                        </span>

                        <h2 class="wow fadeInUp animated" data-animation="fadeInUp animated" data-delay=".4s">

                            Reservasi Lapangan Olahraga Lebih Mudah

                        </h2>

                        <h5 class="wow fadeInUp animated" data-animation="fadeInUp animated" data-delay=".5s">

                            <span></span>
                            Pilih lapangan dan jadwal sesuai kebutuhan Anda

                        </h5>

                    </div>

                    <div class="wow fadeInDown animated" data-animation="fadeInUp animated" data-delay=".2s">

                        <p>
                            SportSpace merupakan sistem reservasi lapangan olahraga
                            berbasis web yang membantu pengguna mencari dan melakukan
                            pemesanan lapangan secara lebih mudah.
                        </p>

                        <p>
                            Pengguna dapat melihat jenis olahraga, memilih lapangan,
                            menentukan tanggal dan waktu yang tersedia, kemudian
                            mengirimkan reservasi. Reservasi yang dikirim akan
                            diperiksa oleh admin sebelum mendapatkan status akhir.
                        </p>

                        <a href="{{ url('/lapangan') }}" class="btn mt-20">
                            <i class="far fa-calendar-check"></i>
                            Lihat Lapangan
                        </a>

                    </div>

                </div>

            </div>

            <div class="col-lg-6">

                <div class="s-video-wrap">

                    <video id="padelVideo" class="padel-video" preload="metadata">
                        <source src="{{ asset('template/img/padel/vd.mp4') }}" type="video/mp4">
                    </video>

                    <div class="s-video-content">

                        <a href="javascript:void(0);" id="padelPlay">
                            <i class="fas fa-play"></i>
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

@push('scripts')

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const video = document.getElementById('padelVideo');
            const button = document.getElementById('padelPlay');

            button.addEventListener('click', function () {

                video.play();

                button.style.display = 'none';

            });

        });
    </script>

@endpush
<!-- about-area-end -->