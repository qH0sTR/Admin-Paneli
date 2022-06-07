
    <div id="carouselExampleInterval" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <?php slider(); 
            $i="active";
            foreach(slider as $row){
                echo '<div class="carousel-item '.$i.'" data-interval="2000">
                <img src="'.$row["slider_resim"].'" class="d-block w-100" alt="...">
                </div>';
                $i="";
            }
            ?>
        </div>
        <button class="carousel-control-prev" type="button" data-target="#carouselExampleInterval" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-target="#carouselExampleInterval" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
        </button>
    </div>
        <div id="ekip" class="row row-cols-1 row-cols-md-2 mt-4">
            <?php
            $a = tablo("ekip");
            foreach(ekip as $row){
                echo '<a href="ekip/'.$row["ekip_link"].'">
                  <div class="col mb-4">
                    <div class="card">
                      <img src="'.$row["ekip_resim"].'" class="card-img-top" alt="...">
                      <div class="card-body">
                        <h5 class="card-title">'.$row["ekip_bilgi"].'</h5>
                        <p class="card-text">'.$row["ekip_anasayfa_aciklama"].'</p>
                      </div>
                    </div>
                  </div>
                </a>';
            }
            ?><br>
        </div>
