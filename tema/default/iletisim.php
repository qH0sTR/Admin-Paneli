<!--Section: Contact v.2-->
<section id="contact" class="mb-4">
<div class="col-10 offset-1">
    <h2 class="h1-responsive font-weight-bold text-center my-4 p-2">Bize ulaşın</h2>
    <!--Section description-->
    <p class="text-center w-responsive mx-auto mb-5">Herhangi bir sorunuz mu var? Bize sorabilirsiniz, en kısa sürede o soruyu aklınızdan silmeye hazırız!</p>
    <?php iletisim(); ?>
    <div class="row">
        <div class="col-md-9 mb-md-0 mb-5">
            <form action="" method="POST">
                <div class="row">
                    <div class="col-md-6">
                        <div class="md-form mb-0">
                            <label for="name" class=""><span>*</span>Adınız</label>
                            <input type="text" id="isim" name="isim" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="md-form mb-0">
                            <label for="email" class=""><span>*</span>E-postanız</label>
                            <input type="email" id="email" name="email" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="md-form mb-0">
                            <label for="subject" class=""><span>*</span>Konu</label>
                            <input type="text" id="konu" name="konu" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="md-form">
                            <label for="message"><span>*</span>Mesajınız</label>
                            <textarea style="resize: none;" rows="6" type="text" id="mesaj" name="mesaj" rows="2" class="form-control md-textarea"></textarea>
                        </div>
                    </div>
                </div>
                <div class="text-center text-md-left mt-3">
                    <button type="submit" class="btn btn-primary mb-md-5" onclick="">Gönder</button>
                </div>
            </form>
            <div class="status"></div>
        </div>
        <div class="col-md-3 text-left text-md-center ">
            <ul class="list-unstyled mb-0 ">
                <li ><i class="fa fa-map-marker fa-2x text"></i>
                    <p><?= $site; ?></p>
                </li>

                <li><i class="fa fa-phone mt-4 fa-2x"></i>
                    <p><?= $telefon; ?></p>
                </li>

                <li><i class="fa fa-envelope mt-4 fa-2x"></i>
                    <p><?= $email ; ?></p>
                </li>
            </ul>
        </div>
    </div>
</div>
</section>
<!--Section: Contact v.2-->