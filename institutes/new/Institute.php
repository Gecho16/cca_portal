<!DOCTYPE html>
<html lang="en">

  <head>

    <body style="background-color:rgb(3, 37, 16)";>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Template">
    <link rel="stylesheet" href="style.css">


    <title>City College of Angeles</title>

    <div class="container">
        <div class="card">
            <img src="images/icslis-logo.png" alt="ICSLIS">
            <div class="intro">
                <h3><a href="ICSLIS.php">Institute of Computing Studies and Library Information Science</a></h3>    
            </div>
        </div>
    </div>

    <div class="container">
        <div class="card">
            <img src="images/logo-ibm.png" alt="IBM">
            <div class="intro">
                <h3><a href="IBM.php">Institute of Business and Management</a></h3>   
            </div>
        </div>
    </div>

    <div class="container">
        <div class="card">
            <img src="images/logo-ieas.png" alt="IEAS">
            <div class="intro">
                <h3><a href="IEAS.php">Institute of Education, Arts & Science</a></h3>
                
            </div>
        </div>
    </div>
</li>
</ul>

                  
                  </nav>
              </div>
          </div>
      </div>
  </header>
  <!-- ***** Header Area End ***** -->

                 
                <!-- <div class="col-lg-4 templatemo-item-col all imp">
                  <div class="meeting-item">
                    <div class="thumb">
                      <div class="price">
                      </div>
                      <a href="bsis.php"><img src="assets/images/meeting-02.jpg" alt=""></a>
                    </div>
                    <div class="down-content-courses">
                      <div class="date">
                      </div>
                      <a href="bsis.php"><h4>BACHELOR OF SCIENCE IN INFORMATION SYSTEM</h4></a>
                    </div>
                  </div>
                </div> -->
                <!-- <div class="col-lg-4 templatemo-item-col all imp">
                  <div class="meeting-item">
                    <div class="thumb">
                      <div class="price">     
                      </div>
                            <a href="blis.php"><img src="assets/images/meeting-02.jpg" alt=""></a>
                    </div>
                    <div class="down-content-courses">
                      <div class="date">
                      </div>
                      <a href="blis.php"><h4>BACHELOR OF LIBRARY AND INFORMATION SCIENCE</h4></a>
                    </div>
                  </div>
                </div> -->
                <!-- <div class="col-lg-4 templatemo-item-col all imp">
                  <div class="meeting-item">
                    <div class="thumb">
                      <div class="price">
                     
                      </div>
                      <a href="iact.php"><img src="assets/images/meeting-02.jpg" alt=""></a>
                    </div>
                    <div class="down-content-courses">
                      <div class="date">
                     
                      </div>
                      <a href="iact.php"><h4>ASSOCIATE IN COMPUTER TECHNOLOGY</h4></a>
                    </div>
                  </div>
                </div> -->

              </div>
            </div>
            <div class="col-lg-12">
              <div class="pagination">
                <!-- <ul>
                  <li><a href="#">1</a></li>
                  <li class="active"><a href="#">2</a></li>
                  <li><a href="#">3</a></li>
                  <li><a href="#"><i class="fa fa-angle-right"></i></a></li>
                </ul> -->
              </div>
            </div>
          </div>
        </div>
      </div>
      <br>
      <br>
      <br>
    </div>
    <a href="#" id="back-to-top" title="Back to top">&uarr;</a>
    <footer>
        <div class="footer-main">
            <div class="container">
              <!-- <div class="row">
                <div class="col-lg-4 col-md-12 col-sm-12">
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12">
                    <img src="assets/images/cca-logo1.png">
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12">
                </div>
                </div> -->
                <div class="row" style="padding-top:10px;">
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="footer-widget">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
  </section>


  <!-- Scripts -->
  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="assets/js/isotope.min.js"></script>
    <script src="assets/js/owl-carousel.js"></script>
    <script src="assets/js/lightbox.js"></script>
    <script src="assets/js/tabs.js"></script>
    <script src="assets/js/slick-slider.js"></script>
    <script src="assets/js/custom.js"></script>
    <script>
        //according to loftblog tut
        $('.nav li:first').addClass('active');

        var showSection = function showSection(section, isAnimate) {
          var
          direction = section.replace(/#/, ''),
          reqSection = $('.section').filter('[data-section="' + direction + '"]'),
          reqSectionPos = reqSection.offset().top - 0;

          if (isAnimate) {
            $('body, html').animate({
              scrollTop: reqSectionPos },
            800);
          } else {
            $('body, html').scrollTop(reqSectionPos);
          }

        };

        var checkSection = function checkSection() {
          $('.section').each(function () {
            var
            $this = $(this),
            topEdge = $this.offset().top - 80,
            bottomEdge = topEdge + $this.height(),
            wScroll = $(window).scrollTop();
            if (topEdge < wScroll && bottomEdge > wScroll) {
              var
              currentId = $this.data('section'),
              reqLink = $('a').filter('[href*=\\#' + currentId + ']');
              reqLink.closest('li').addClass('active').
              siblings().removeClass('active');
            }
          });
        };

        $('.main-menu, .responsive-menu, .scroll-to-section').on('click', 'a', function (e) {
          e.preventDefault();
          showSection($(this).attr('href'), true);
        });

        $(window).scroll(function () {
          checkSection();
        });
    </script>


</body>


  </body>

</html>
