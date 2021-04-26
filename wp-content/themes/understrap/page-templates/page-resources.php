<?php
/**
 * Template Name: Resources
 * description: >-
 * Customer Portal Template
 * @package  uwd_wp_theme
 */


get_header();
?>

	<main id="resources" class="site-main">
		<div class="container-fluid px-0 parallax" data-speed="10">
			<div class="parallax-container">
				<div class="parallax parallax-hero" data-speed="30">
					<div class="hero-graphic ">
						<!--           <img alt="satified customer" src="https://assets.codepen.io/3058793/uwd-hero-graphic.png" /> -->
						<img id="quote-top" class="quotes" src="https://assets.codepen.io/3058793/quotes.svg" alt="Quote Graphic" />
						<h1 class="hero-text display-3">
							I love my windows!
						</h1>
						<div class="btn hero-btn">learn more</div>
						<img id="quote-bottom" class="quotes" src="https://assets.codepen.io/3058793/quotes.svg" alt="Quote Graphic" />

					</div>
				</div>
			</div>

			<div id="parallelogram" class="parallelogram-company container-shadow">
				<div class="container">
					<div class="statement row my-4 mx-0">
						<div class="statement-container container-shadow w-100">
							<h3 class="text-center">Why</h3>
							<h1 class="text-center">Universal Windows Direct?</h1>
							<p class="text-center">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem orci pharetra in proin ultrices at.</p>
						</div>
					</div>
					<div class="reviews row">
						<div class="review">
							<img id="quote-top" class="quotes" src="https://assets.codepen.io/3058793/quotes.svg" alt="Quote Graphic" />
							<img class="review-stars" src="https://assets.codepen.io/3058793/review-stars.png" alt="Review Stars" />
							<h3 class="review-text">
								The initial consultation was prompt,
								courteous, kind, and the sales
								representative was extremely
								knowledgable.

							</h3>
							<p class="review-author">- Howard in Ohio</p>
							<img id="quote-bottom" class="quotes" src="https://assets.codepen.io/3058793/quotes.svg" alt="Quote Graphic" />
						</div>
					</div>
					<h1 class="recognition">Trusted to get the job done right.</h1>
					<div class="recognition-carousel row text-center container">
						
						<div id="recognitionCarousel" class="carousel slide" data-ride="carousel" data-interval="false">
							<ol class="carousel-indicators">
								<li data-target="#recognitionCarousel" data-slide-to="0" class="active"></li>
								<li data-target="#recognitionCarousel" data-slide-to="1"></li>
								<li data-target="#recognitionCarousel" data-slide-to="2"></li>
							</ol>
							<div class="carousel-inner" role="listbox">
								<div class="carousel-item row active">
									<div class="col-1 float-left"></div>
									<div class="col-10 float-left"><img class="carousel-img" src="https://assets.codepen.io/3058793/weatherhead2018.jpg"></div>
									<div class="col-1 float-right"><img class="carousel-img right" src="https://assets.codepen.io/3058793/qr2019.jpg"></div>
								</div>
								<div class="carousel-item row">
									<div class="col-1 float-left"><img class="carousel-img left" src="https://assets.codepen.io/3058793/weatherhead2018.jpg"></div>
									<div class="col-10 float-left"><img class="carousel-img " src="https://assets.codepen.io/3058793/qr2019.jpg"></div>
									<div class="col-1 float-right"><img class="carousel-img right" src="https://assets.codepen.io/3058793/top_workplaces_2019.jpg"></div>
								</div>
								<div class="carousel-item row">
									<div class="col-1 float-left"><img class="carousel-img left" src="https://assets.codepen.io/3058793/qr2019.jpg"></div>
									<div class="col-10 float-left"><img class="carousel-img" src="https://assets.codepen.io/3058793/top_workplaces_2019.jpg"></div>
									<div class="col-1 float-right"></div>
								</div>
							</div>
							<a class="carousel-control-prev" href="#recognitionCarousel" role="button" data-slide="prev">
								<!--             <span class="carousel-control-prev-icon" aria-hidden="true"></span> -->
								<span class="sr-only">Previous</span>
							</a>
							<a class="carousel-control-next" href="#recognitionCarousel" role="button" data-slide="next">
								<!--             <span class="carousel-control-next-icon" aria-hidden="true"></span> -->
								<span class="sr-only">Next</span>
							</a>
						</div>
					</div>
				</div>
			</div>

			<div class="parallax-container section-container">
				<div class="parallax parallax-section " data-speed="30"></div>
				<!--  TODO: CTA PARALLAX OVER IMG    -->
			</div>

			<div id="parallelogram1" class="parallelogram-products container-shadow">
				<div class="container">
					<div class="products row">
						<h3 class="display-6">Our</h3>
						<h1 class="text-center display-3 text-shadow" data-text="Products">Products</h1>
					</div>
					<div class="product-carousel row text-center container">
						<div id="productCarousel" class="carousel slide" data-ride="carousel" data-interval="false">
							<ol class="carousel-indicators">
								<li data-target="#productCarousel" data-slide-to="0" class="active"></li>
								<li data-target="#productCarousel" data-slide-to="1"></li>
								<li data-target="#productCarousel" data-slide-to="2"></li>
							</ol>
							<div class="carousel-inner" role="listbox">
								<div class="carousel-item row active">
									<div class="col-1 float-left"></div>
									<div class="col-10 float-left"><img class="carousel-img" src="https://assets.codepen.io/3058793/uwd-carousel2.png"><h1 class="carousel-statement">Windows</h1></div>
									<div class="col-1 float-right"><img class="carousel-img right" src="https://assets.codepen.io/3058793/uwd-carousel3.png"><h1 class="carousel-statement">Siding</h1></div>
								</div>
								<div class="carousel-item row">
									<div class="col-1 float-left"><img class="carousel-img left" src="https://assets.codepen.io/3058793/uwd-carousel2.png"><h1 class="carousel-statement">Windows</h1></div>
									<div class="col-10 float-left"><img class="carousel-img" src="https://assets.codepen.io/3058793/uwd-carousel3.png"><h1 class="carousel-statement">Siding</h1></div>
									<div class="col-1 float-right"><img class="carousel-img right" src="https://assets.codepen.io/3058793/uwd-carousel1.png"><h1 class="carousel-statement">Doors</h1></div>
								</div>
								<div class="carousel-item row">
									<div class="col-1 float-left"><img class="carousel-img left" src="https://assets.codepen.io/3058793/uwd-carousel3.png"><h1 class="carousel-statement">Siding</h1></div>
									<div class="col-10 float-left"><img class="carousel-img" src="https://assets.codepen.io/3058793/uwd-carousel1.png"><h1 class="carousel-statement">Doors</h1></div>
									<div class="col-1 float-right"></div>
								</div>
							</div>
							<a class="carousel-control-prev" href="#productCarousel" role="button" data-slide="prev">
								<!--             <span class="carousel-control-prev-icon" aria-hidden="true"></span> -->
								<span class="sr-only">Previous</span>
							</a>
							<a class="carousel-control-next" href="#productCarousel" role="button" data-slide="next">
								<!--             <span class="carousel-control-next-icon" aria-hidden="true"></span> -->
								<span class="sr-only">Next</span>
							</a>
						</div>
					</div>
					<div class="finance-cta row">
						<div class="cta-container">
							<img class="finance-cta--graphic top" src="https://assets.codepen.io/3058793/uwd-graphic.svg" />
							<h3 class="pre-text">Buy One Window Get One</h3>
							<h1 class="banner-text">FREE!</h1>
							<h4 class="sub-text">Buy 4, Get 4! Buy 8, Get 8!</h4>
							<h3 class="sub-text">There’s No Limit! </h3>
							<div class="cta-btn">Get started</div>
							<img class="finance-cta--graphic bottom" src="https://assets.codepen.io/3058793/uwd-graphic.svg" />
						</div>
					</div>
					<div class="careers row">
						<h3 class="pre-text career-text">Ready for something different?</h3>
						<h3 class="pre-text career-text">Check out one of our many career paths today.</h3>
						<div class="cta-btn career-btn">Join our team</div>
					</div>
				</div>
			</div>

			<div id="parallelogram2" class="parallelogram-services service-section">
				<div class="container">
					<div class="resources row">
						<h3 class="text-center display-6">Our</h3>
						<h1 class="text-center display-3 text-shadow resource-text" data-text="Resources">Resources</h1>
					</div>
					<div class="service-guide row my-0">
						<img class="w-100" alt="guides" src="https://assets.codepen.io/3058793/uwd-Guide+index+-+horizontal.png" />
					</div>
					<div class="sweeps row w-100">
						<img class="sweeps-img" src="https://assets.codepen.io/3058793/Sweeps.png" />
						<div class="sweeps-btn cta-btn">Enter now!</div>
					</div>
					<div class="inspire row my-0">
						<h3 class="text-center display-6">Get</h3>
						<h1 class="display-3 text-shadow" data-text="Inspired">Inspired</h1>
					</div>
					<div class="inspire-carousel row text-center container">
						<div id="inspireCarousel" class="carousel slide" data-ride="carousel" data-interval="false">
							<ol class="carousel-indicators">
								<li data-target="#inspireCarousel" data-slide-to="0" class="active"></li>
								<li data-target="#inspireCarousel" data-slide-to="1"></li>
								<li data-target="#inspireCarousel" data-slide-to="2"></li>
							</ol>
							<div class="carousel-inner" role="listbox">
								<div class="carousel-item row active">
									<div class="col-1 float-left"></div>
									<div class="col-10 float-left"><img class="carousel-img" src="https://assets.codepen.io/3058793/uwd-carousel2.png"></div>
									<div class="col-1 float-right"><img class="carousel-img right" src="https://assets.codepen.io/3058793/uwd-carousel3.png"></div>
								</div>
								<div class="carousel-item row">
									<div class="col-1 float-left"><img class="carousel-img left" src="https://assets.codepen.io/3058793/uwd-carousel2.png"></div>
									<div class="col-10 float-left"><img class="carousel-img" src="https://assets.codepen.io/3058793/uwd-carousel3.png"></div>
									<div class="col-1 float-right"><img class="carousel-img right" src="https://assets.codepen.io/3058793/uwd-carousel1.png"></div>
								</div>
								<div class="carousel-item row">
									<div class="col-1 float-left"><img class="carousel-img left" src="https://assets.codepen.io/3058793/uwd-carousel3.png"></div>
									<div class="col-10 float-left"><img class="carousel-img" src="https://assets.codepen.io/3058793/uwd-carousel1.png"></div>
									<div class="col-1 float-right"></div>
								</div>
							</div>
							<a class="carousel-control-prev" href="#inspireCarousel" role="button" data-slide="prev">
								<!--             <span class="carousel-control-prev-icon" aria-hidden="true"></span> -->
								<span class="sr-only">Previous</span>
							</a>
							<a class="carousel-control-next" href="#inspireCarousel" role="button" data-slide="next">
								<!--             <span class="carousel-control-next-icon" aria-hidden="true"></span> -->
								<span class="sr-only">Next</span>
							</a>
						</div>
					</div>
				</div>
			</div>

			<div class="parallax-container office-container">
				<div class="parallax parallax-office" data-speed="30"></div>
				<div class="container h-100">
					<div class="row h-100">
						<div class="col-12 my-auto text-center text-white">

						</div>
					</div>
				</div>
			</div>

			<div id="parallelogram3" class="parallelogram-footer footer-section container-shadow">
				<div class="footer-cta  my-0">
					<img class="footer-cta--graphic top" src="https://assets.codepen.io/3058793/uwd-graphic.svg" />
					<h3 class="sub-text">Exclusive savings with</h3>
					<h1 class="banner-text">Free Estimate</h1>
					<div class="cta-btn">Get Started</div>
					<img class="footer-cta--graphic bottom" src="https://assets.codepen.io/3058793/uwd-graphic.svg" />
				</div>
			</div>

		</div>
		Modal
		<div id="myModalLeft" class="modal fade modal-left" tabindex="-1" role="dialog">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Modal left</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<p>Lorem ipsum dolor sit amet, no fugit quidam eirmod qui, tacimates argumentum ius ad. Ei has adhuc nihil. Idque lorem cu per, omnes delenit percipitur cum an, mei voluptua hendrerit ei. Qui ex justo abhorreant efficiantur. Soleat malorum cu sit.</p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
		<div id="alert" class="banner-container">
			<div class="alert">
				<form class="form-inline">
					<label class="sr-only" for="inlineFormInputName2">Name</label>
					<input type="text" class="form-control mb-2 mr-1" id="inlineFormInputName2" placeholder="Jane Doe">
					<label class="sr-only" for="inlineFormInputName2">Phone</label>
					<input type="text" class="form-control mb-2 mr-1" id="inlineFormInputPhone2" placeholder="(555)867-5309">
					<button type="submit" class="btn btn-primary mb-2">Submit</button>
				</form>
			</div>
		</div>
		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
// get_sidebar();
get_footer();
