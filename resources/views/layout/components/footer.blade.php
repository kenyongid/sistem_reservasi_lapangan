<!-- footer -->
<footer class="footer-bg footer-p sportspace-footer"
    style="background-image:url('{{ asset('template/img/footer_bg_img.jpg') }}');">

    <div class="footer-top">

        <div class="container">

            <div class="row justify-content-center">

                <div class="col-xl-8 col-lg-9 col-md-10 col-12 text-center">

                    <div class="footer-widget">

                        {{-- LOGO --}}
                        <div class="footer-logo mb-25">

                            <a href="{{ route('home') }}">

                                <img src="{{ asset('template/img/logo/lg1.png') }}" alt="SportSpace"
                                    class="footer-sportspace-logo">

                            </a>

                        </div>


                        {{-- DESKRIPSI --}}
                        <div class="footer-text mb-25">

                            <p>
                                SportSpace adalah platform reservasi lapangan
                                olahraga yang memudahkan pengguna menemukan
                                lapangan, melihat jadwal, dan melakukan
                                reservasi secara praktis.
                            </p>

                        </div>


                        {{-- NAVIGASI --}}
                        <div class="footer-link">

                            <ul>

                                <li>
                                    <a href="{{ route('home') }}">
                                        Beranda
                                    </a>
                                </li>

                                <li>
                                    <a href="{{ route('lapangan.index') }}">
                                        Lapangan
                                    </a>
                                </li>

                                <li>
                                    <a href="{{ route('booking.index') }}">
                                        Reservasi
                                    </a>
                                </li>

                            </ul>

                        </div>


                        {{-- SOCIAL MEDIA --}}
                        <br>
                        <div class="footer-social sportspace-social">

                            <a href="#" aria-label="Facebook">
                                <i class="fab fa-facebook-f"></i>
                            </a>

                            <a href="#" aria-label="Instagram">
                                <i class="fab fa-instagram"></i>
                            </a>

                            <a href="#" aria-label="Email">
                                <i class="fas fa-envelope"></i>
                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- COPYRIGHT --}}
    <div class="copyright-wrap">

        <div class="container">

            <div class="row">

                <div class="col-12">

                    <div class="copyright-text text-center">

                        <p>
                            © {{ date('Y') }} SportSpace.
                            Seluruh hak cipta dilindungi.
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</footer>
<!-- footer-end -->