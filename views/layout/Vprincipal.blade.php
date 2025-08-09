@include('layout.heder')

<main id="main">
    <section id="visor" class="contact">
        <div class="container">
            <div class="section-title">
                <h2>Modulo principal</h2>
            </div>

            <div class="row" data-aos="fade-in">

                <div class="col-lg-12 mt-12 mt-lg-12 d-flex align-items-stretch">
                    <form  method="POST"  class="form-control">
                        <div style="font-size: 15px"> 
                            <?php
                            echo session('sesionUser');
                            ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- ======= Contact Section ======= -->
</main>

@include('layout.footer')