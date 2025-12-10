<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
    AOS.init({
    });
  });
</script>
<script>
	$(document).ready(function () {
		$('.blog-carousel').owlCarousel({
			loop: true,
			margin: 20,
			nav: true,
			dots: false,
			autoplay: true,
			autoplayTimeout: 4000,
			autoplayHoverPause: true,
			navText: [
				'<span class="carousel-nav prev">‹</span>',
				'<span class="carousel-nav next">›</span>'
			],
			responsive: {
				0: { items: 1 },
				768: { items: 2 },
				992: { items: 2 }
			}
		});
	});
</script>
<script>
	$(document).ready(function () {
		$('.media-carousel').owlCarousel({
			loop: true,
			margin: 20,
			nav: true,
			dots: false,
			autoplay: true,
			autoplayTimeout: 4000,
			autoplayHoverPause: true,
			navText: [
				'<span class="carousel-nav prev">‹</span>',
				'<span class="carousel-nav next">›</span>'
			],
			responsive: {
				0: { items: 1 },
				768: { items: 2 },
				992: { items: 3 }
			}
		});
	});
</script>
<script>
	$(document).ready(function () {
		$('.image-slider').slick({
			dots: false,
			arrows: false,
			infinite: true,
			speed: 500,
			autoplay: true,
			autoplaySpeed: 1500,

		});

		$('.video-slider').slick({
			dots: false,
			arrows: false,
			infinite: true,
			speed: 500,
			autoplay: true,
			autoplaySpeed: 1000,
		});
	});
</script>
<script>
	$(".vertical-tab .each-tab").on("click", function (e) {
		var dis = $(this),
			dataTarget = dis.data("target");
		dis.addClass("active").siblings(".each-tab").removeClass("active");
		$(".vertical-tab-wrapper .vertical-tab-content").hide();
		$(dataTarget).show().addClass("active").siblings().removeClass("active");
	});
</script>
<script>
	function togglePaymentFields() {
		const payment = document.getElementById("paymentMode").value;
		document.getElementById("qrSection").style.display = payment === "qr" ? "block" : "none";
		document.getElementById("bankSection").style.display = payment === "bank" ? "block" : "none";
	}
</script>
<script>
  // Show button after scrolling down 200px
  window.onscroll = function () {
    const scrollBtn = document.getElementById("scrollTopBtn");
    if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
      scrollBtn.style.display = "block";
    } else {
      scrollBtn.style.display = "none";
    }
  };

  // Scroll to top smoothly
  function scrollToTop() {
    window.scrollTo({
      top: 0,
      behavior: "smooth"
    });
  }
</script><?php /**PATH /home/rtpltechin/dbta.rtpltech.in/resources/views/front/elements/script.blade.php ENDPATH**/ ?>